<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client;

class WebserviceController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public static function test()
    {
        $client = new Client(); 
        try {
            $response = $client->get('http://localhost:1337/api/clanki/38?populate=*');
            $data = $response->getBody()->getContents();

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
