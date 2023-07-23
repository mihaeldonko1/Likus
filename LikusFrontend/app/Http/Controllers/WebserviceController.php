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
use Illuminate\Support\Facades\Config;

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
            $apiUrl = Config::get('likusConfig.likus_api_url');
            $response = $client->get("$apiUrl/clanis?populate=*&pagination[page]={$page}&pagination[pageSize]=28&sort[0]=Priimek%3Aasc");

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
            $apiUrl = Config::get('likusConfig.likus_api_url');
            $response = $client->get("$apiUrl/clanis/{$id}?populate=*");
            $data = json_decode($response->getBody()->getContents(), true);
    
            $dodatneObjaveIds = $data['data']['attributes']['dodatne_objave']['data'];
            $fullData = [];
            
            

            foreach ($dodatneObjaveIds as $objectId) {
                $fullId = $objectId['id'];

                $response = $client->get("$apiUrl/dodatne-objave/{$fullId}?populate=*");
                $objectData = json_decode($response->getBody()->getContents(), true);
                if(isset($objectData['data']['attributes']['natecaj']['data']['id'])){
                    $natecajId = $objectData['data']['attributes']['natecaj']['data']['id'];
                    $responseNatecaj = $client->get("$apiUrl/natecaji/{$natecajId}?populate=*");
                    $objectDataNatecaj = json_decode($responseNatecaj->getBody()->getContents(), true);
                    $objectData['data']['attributes']['natecaj'] = $objectDataNatecaj['data'];
                }
                $fullData[] = $objectData;
            }
            
            $data['data']['attributes']['dodatne_objave']['data'] = $fullData;

           // dd($data);
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
            $apiUrl = Config::get('likusConfig.likus_api_url');
            $response = $client->get("$apiUrl/knjige?populate=*&pagination[page]={$page}&pagination[pageSize]=28&sort[0]=Stevilka_knjige%3Adesc");

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

    public function allNatecaji(Request $request)
    {
        $page = $request->query('page');
        if ($page == null) {
            $page = 1;
        }

        $client = new Client();
        try {
            $apiUrl = Config::get('likusConfig.likus_api_url');
            $response = $client->get("$apiUrl/natecaji?populate=*&pagination[page]={$page}&pagination[pageSize]=28");

            $data = json_decode($response->getBody()->getContents(), true);

            //dd($data);
            
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
            return view('natecaji', [
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
            $apiUrl = Config::get('likusConfig.likus_api_url');
            $response = $client->get("$apiUrl/knjige/{$id}?populate=*");
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
            $apiUrl = Config::get('likusConfig.likus_api_url');
            $apiUrlMain = Config::get('likusConfig.likus_api_urlMain');
            $url = "$apiUrl/clanki";
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
                    'pdf' => "$apiUrlMain" . $item['attributes']['Clanek']['data']['attributes']['url'],
                    'clan_id' => $item['attributes']['clan_id'],
                    'page_start' => $item['attributes']['Strani_od'],
                ];
            }, $data['data']);

            return view('pdfReader', compact('filteredData'));
        } catch (RequestException $e) {
            $errorMessage = $e->getMessage();
            return view('error', ['error' => $errorMessage])->status(500);
        }
    }
}
