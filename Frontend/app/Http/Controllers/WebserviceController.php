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
            $response = $client->get("http://localhost:1337/api/clanis?populate=*&pagination[page]={$page}&pagination[pageSize]=28");
            
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

    public function pdfreader(){
        return view('pdfreader');
    }
    public function getMember($id)
    {
        $client = new Client(); 
        try {
            $response = $client->get("http://localhost:1337/api/clanis/{$id}?populate=*");
            
            $data = json_decode($response->getBody()->getContents(), true);
            Log::info($data);
    
            return view('singlemember', compact('data')); 
        
        } catch (\Exception $e) {
            return view('error', ['error' => $e->getMessage()])->status(500);
        }
    }
    

}
