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


class CmsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public static function getImages($id)
    {
        $error = "id se ne ujema z bazo podatkov";
    
        $client = new Client();
    
        try {
            $apiUrl = Config::get('likusConfig.likus_api_url');
            $response = $client->get("$apiUrl/galerije/{$id}?populate=*");        
            $data = json_decode($response->getBody()->getContents(), true);
            
            $dataAttributes = $data['data']['attributes'];
            $galerijaSlikData = $dataAttributes['Galerija_slik']['data'];
            $naslovnaSlikaData = $dataAttributes['Naslovna_slika']['data']['attributes']['url'];
    
            $allImages = [];
    
            foreach ($galerijaSlikData as $slika) {
                $allImages[] = $slika['attributes']['url'];
            }
    
            $fullGallery = [
                'naslovnaSlika' => $naslovnaSlikaData,
                'vseSlike' => $allImages,
            ];
    
            return $fullGallery; 
    
        } catch (\Exception $e) {
            return $error;
        }
    }

    public static function getNatecaji($id)
    {
        $error = "id se ne ujema z bazo podatkov";

        Log::info($id);
    
        $client = new Client();
    
        try {
            $response = $client->get("http://localhost:1337/api/natecaji/{$id}?populate=*");        
            $data = json_decode($response->getBody()->getContents(), true);
            Log::info("asdasdghagsdjghagjhsdghjasgjdh");
            Log::info($data); 
    
            return $data; 
    
        } catch (\Exception $e) {
            return $error;
        }
    }
    

 
}
