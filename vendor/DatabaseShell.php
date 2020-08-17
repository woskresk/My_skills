<?php

namespace Vendor;

  class DatabaseShell
  {

    private $link;
    
    public function __construct()
    {
      $this->link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
      mysqli_query($this->link, "SET NAMES 'utf8'"); // устанавливаем кодировку
    }

    // сохраняет запись в базу
    public function save($table, $data)
    {
      $i = 0;
        $query ="INSERT INTO $table SET";
      foreach ($data as $key=>$value) {
          if ($i == 0) {
            $query .= " $key='$value'";
          }else{
        $query .= ", $key='$value'";
            }
        $i++;
          
      }
       $result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
        return $result;
      

    }

    // удаляет запись по ее id
    public function del($table, $id)
    {
      $query = "DELETE FROM $table WHERE id = $id";
      $result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
      return $result;
    }

    // удаляет записи по их id
    public function delAll($table, $ids)
    {
      
      foreach ($ids as $value) {
        $this->del($table, $value);
          
      }
    }

    // получает одну запись по ее id
    public function get($table, $id)
    {
      
       $query = "SELECT * FROM $table WHERE id = $id";
       $result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
       $row = mysqli_fetch_assoc($result);
      return $row;
    }

    // получает массив записей по их id
    public function getAll($table, $ids)
    {
      
      $data = [];
      foreach ($ids as $value) {
          $data[] = $this->get($table, $value);

      }
      return $data;
    }

    // получает массив записей по условию
    public function selectAll($table, $sort, $pagin, $limit)
    {
      $query = "SELECT * FROM $table ORDER BY $sort LIMIT $pagin, $limit";
      $result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
      for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
        // var_dump($data);
      $multi_data['data'] =  $data;
    
        $query = "SELECT COUNT(*) as count FROM $table"; 
        $result = mysqli_query($this->link, $query) or die( mysqli_error($this->link));
        $count = mysqli_fetch_assoc($result);
        $pageCount = ceil($count['count'] / $limit); // кол-во страниц пагинации
        $multi_data['pageCount'] =  $pageCount;
        return $multi_data;
    }

    // Обновляем запись
    public function updateItem($array)
    {
      $id = $array['id'];
      unset($array['id']);
      $i = 0;
        $query ="UPDATE tasks SET";
      foreach ($array as $key=>$value) {
          if ($i == 0) {
            $query .= " $key='$value'";
          }else{
        $query .= ", $key='$value'";
            }
        $i++;
      }
      $query .= " WHERE id = $id";
        $result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
    }


    // получает одну запись по ее имени
    public function byName($table, $name)
    {
      
      $query = "SELECT * FROM $table WHERE name = '$name'";
      $result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
      $row = mysqli_fetch_assoc($result);
      return $row;
    }
  }