import requests
import os
import concurrent.futures
from functools import partial

def fetch(url, file_path, file_name):
    with open(file_path, 'rb') as file_object:
        file_data = {'files.Cela_knjiga': file_object}
        form_data = {'data': (None, '{}', 'application/json')}  # passing an empty JSON object

        response = requests.put(url, files={**file_data, **form_data})

    if response.ok:
        print(f"File {file_name} uploaded successfully.")
    else:
        print(f"Error uploading file {file_name}. Status: {response.status_code}")

def prepare_data(file_name, folder_input, base_url):
    file_path = os.path.join(folder_input, file_name)

    if os.path.isfile(file_path):
        memberId = file_name[0:1]
        url = base_url + memberId

        fetch(url, file_path, file_name)
    else:
        print(f"Skipping folder: {file_name}")

def upload_files():
    folder_input = 'knjige2'
    base_url = 'http://localhost:1337/api/knjige/'
    
    files = os.listdir(folder_input)

    with concurrent.futures.ThreadPoolExecutor() as executor:
        executor.map(partial(prepare_data, folder_input=folder_input, base_url=base_url), files)

upload_files()
