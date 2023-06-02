<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class WebserviceController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function allMembers(Request $request)
    {
        $page = $request->query('page');
        if ($page == null) {
            $page = 1;
        }

        $client = new Client(); 
        try {
            $response = $client->get("http://localhost:1337/api/clanis?populate=*&pagination[page]={$page}&pagination[pageSize]=28&sort[0]=Ime%3Aasc");
            
            $data = json_decode($response->getBody()->getContents(), true);

            $members = $data['data'];
            $pagination = $data['meta']['pagination'];
            
            $currentPage = $pagination['page'];
            $totalPages = $pagination['pageCount'];
    
            $perPage = 28; 
            $totalItems = $pagination['total'];
            $membersCollection = collect($members);
            $membersPaginated = new LengthAwarePaginator(
                $membersCollection,
                $totalItems,
                $perPage,
                $currentPage,
                ['path' => url()->current()]
            );
    
            return view('members', [
                'members' => $membersPaginated,
                'currentPage' => $currentPage,
                'totalPages' => $totalPages,
            ]);
    
        } catch (\Exception $e) {
            return view('error', ['error' => $e->getMessage()])->status(500);
        }
    }
    
    public function getMember($id)
    {
        $client = new Client(); 
        try {
            $response = $client->get("http://localhost:1337/api/clanis/{$id}?populate=*");        
            $data = json_decode($response->getBody()->getContents(), true);
    
            return view('singlemember', compact('data')); 
        
        } catch (\Exception $e) {
            return view('error', ['error' => $e->getMessage()])->status(500);
        }
    }

    public function allBooks(Request $request)
    {
        $page = $request->query('page');
        if ($page == null) {
            $page = 1;
        }

        $client = new Client(); 
        try {
            $response = $client->get("http://localhost:1337/api/knjige?populate=*&pagination[page]={$page}&pagination[pageSize]=28&sort[0]=Stevilka_knjige%3Adesc");
            
            $data = json_decode($response->getBody()->getContents(), true);

            $members = $data['data'];
            $pagination = $data['meta']['pagination'];
            
            $currentPage = $pagination['page'];
            $totalPages = $pagination['pageCount'];
    
            $perPage = 28; 
            $totalItems = $pagination['total'];
            $membersCollection = collect($members);
            $membersPaginated = new LengthAwarePaginator(
                $membersCollection,
                $totalItems,
                $perPage,
                $currentPage,
                ['path' => url()->current()]
            );
            return view('books', [
                'members' => $membersPaginated,
                'currentPage' => $currentPage,
                'totalPages' => $totalPages,
            ]);
    
        } catch (\Exception $e) {
            return view('error', ['error' => $e->getMessage()])->status(500);
        }
    }

    public function getBook($id)
    {
        $client = new Client(); 
        try {
            $response = $client->get("http://localhost:1337/api/knjige/{$id}?populate=*");        
            $data = json_decode($response->getBody()->getContents(), true);
    
            return view('singlebook', compact('data')); 
        
        } catch (\Exception $e) {
            return view('error', ['error' => $e->getMessage()])->status(500);
        }
    }

    public function getCitalnica()
    {
            return view('spletnacitalnica'); 
        
    }

    public function getClankiPerBook($id)
    {
        $client = new Client();
    
        try {
            $url = "http://localhost:1337/api/clanki";
            $queryParams = [
                'filters' => ['Stevilka_knjige' => ['$eq' => $id]],
                'populate' => '*',
                'pagination' => ['pageSize' => 1000],
                'sort' => ['Strani_od:asc']
            ];
    
            $response = $client->get($url, ['query' => $queryParams]);
            $data = json_decode($response->getBody()->getContents(), true);

          
            $filteredData = array_map(function ($item) {
                return [
                    'id' => $item['id'],
                    'pdf' =>  "http://localhost:1337".$item['attributes']['Clanek']['data']['attributes']['url'],
                    'clan_id' => $item['attributes']['clan_id'],
                    'page_start' =>  $item['attributes']['Strani_od'],
                ];
            }, $data['data']);
            
            return view('pdfReader', compact('filteredData'));
        } catch (RequestException $e) {
            $errorMessage = $e->getMessage();
            return view('error', ['error' => $errorMessage])->status(500);
        }
    }
}
