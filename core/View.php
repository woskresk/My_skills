<?php 

namespace Core;

class View
{


    public function render($array)
    {

        /*
        * $data 
        * $check_admin 
        * $pageCount 
        */
        foreach ($array as $key=>$value) {  // Цикл выводит все переданные через массив переменные, с любым названием.
            ${$key} = $value;
        }
        
       
        require_once $_SERVER['DOCUMENT_ROOT'] . "/project/view/$view.php";
    
    }
}
