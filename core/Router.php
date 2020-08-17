<?php 

namespace Core;

class Router
{


    public function getTrack($array)
    {

        $uris = $_SERVER['REQUEST_URI'];
        $uri = preg_replace('#\?.+#', '', $uris);

        foreach ($array as $value) {

            if ($uri == $value[0]) {

                $fullName = "\\Project\\Controllers\\".$value[1]."Controller";
        
               return ( new $fullName )->{$value[2]}();

                // return $multi_data;

            }
        }
        echo '404 неправильно введён адрес'; 
    
    }
}
