<?php

namespace App\Controllers;

class CURLController{
    private $key ;

    public function __construct(
    )
    {
        $this->key = $_ENV['GOOGLE_API_KEY'];
    }

    public function index () {
        echo '<pre>';
        
        $handle = curl_init();

        $url = 'https://api.spotify.com/v1/search/2TpxZ7JUBn3uw46aR7qd6V?limit=2';

        curl_setopt($handle , CURLOPT_URL , $url);
        curl_setopt($handle , CURLOPT_RETURNTRANSFER , true);

        $content = curl_exec($handle);

        print_r(curl_getinfo($handle));

        echo curl_error($handle) ?'error is : '  . curl_error($handle) : ' no error <br/>' ;

        if($content != null){
            print_r(json_decode($content));
        }
        
        curl_close($handle);

        echo $this->key;
        echo '</pre>';
    }
}