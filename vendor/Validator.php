<?php 

namespace Vendor;

  class Validator
  {
    protected $err = [];
    
    public function __construct()
    {
      
    }
    
    public function isEmail($str)
    {
      if (filter_var($str, FILTER_VALIDATE_EMAIL))  // True если правильный email
      {
        //все ОК, email правильный
      }
      else
      {
         $this->err[] = 'email введён не прравильно';
        
      }
      return $this;
    }
    
    public function isDomain($str)
    {
      // проверяет строку на то, что она корректное имя домена
      if (filter_var($str, FILTER_VALIDATE_URL))  // True если правильный email
      {
        //все ОК, email правильный
      }
      else
      {
       $this->err[] = 'домен введён не правильно';
        
      }
      return $this;
    }


    // проверяет число на то, что оно входит в диапазон
    public function inRange($num, $from, $to, $for)
    {
      if ($num > $from and $num < $to) {
       
      }else{
        $this->err[] = "длинна $for не соответствует";
        
      }
      return $this;
    }
    
    public function inLength($str, $from, $to, $for)
    {
      // проверяет строку на то, что ее длина входит в диапазон
      $num = strlen($str);
      // var_dump($num);
      return $this->inRange($num, $from, $to, $for);
    }


    public function result()
    {
        if (empty($this->err)) {
          return 1;
        }else{
          return $this->err;
        }
    }

    public function xssFilter()
    {
      $post = [];
      foreach ($_POST as $key=>$value) {
        
        $post["$key"] = strip_tags($value);
      }
      return $post;
    }
  }