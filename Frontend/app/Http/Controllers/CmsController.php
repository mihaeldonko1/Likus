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


class CmsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function getImages($id)
    {
        $client = new Client(); 
        try {
            $response = $client->get("http://localhost:1337/api/galerije/{$id}?populate=*");        
            $data = json_decode($response->getBody()->getContents(), true);
            
            return $data; 
        
        } catch (\Exception $e) {
            return view('error', ['error' => $e->getMessage()])->status(500);
        }
    }

 
}
