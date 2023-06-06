import requests
import os
import json
import concurrent.futures

def fetch(url, file_path, file_name, data):
    file_data = {'files.Clanek': open(file_path, 'rb')}
    form_data = {'data': json.dumps(data)}

    response = requests.post(url, files=file_data, data=form_data)

    if response.ok:
        print(f"File {file_name} uploaded successfully.")
    else:
        print(f"Error uploading file {file_name}. Status: {response.status_code}")

def prepare_data(file_name, folder_input, url):
    file_path = os.path.join(folder_input, file_name)

    if os.path.isfile(file_path):
        year = file_name[4:6]
        book_number = file_name[6:9]
        pages = file_name[9:16][1:]
        pages_start = pages[:3]
        pages_finish = pages[3:]

        data = {
            'Letnica_zbornika': year,
            'Stevilka_knjige': book_number,
            'Strani_od': pages_start,
            'Strani_do': pages_finish,
            'clan_id': file_name[:4],
            'clan': file_name[:4],
            'tip_datoteke': os.path.splitext(file_name)[1]
        }

        fetch(url, file_path, file_name, data)
    else:
        print(f"Skipping folder: {file_name}")

def upload_files():
    folder_input = 'pdfsLikus'
    url = 'http://localhost:1337/api/clanki/'

    files = os.listdir(folder_input)

    with concurrent.futures.ThreadPoolExecutor() as executor:
        executor.map(prepare_data, files, [folder_input]*len(files), [url]*len(files))

upload_files()

