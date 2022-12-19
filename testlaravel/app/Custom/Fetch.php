<?php 
namespace App\Custom;

use Illuminate\Support\Facades\Http;

class Fetch {

    public function get($url) 
    {
        $response = Http::get($url);
        return $response->json();
    }
}
