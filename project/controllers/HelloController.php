<?php
namespace Project\Controllers;
use Vendor\DatabaseShell;
use Vendor\SessionShell;
use Vendor\Validator;
use Core\View;


class HelloController
{

    // Главная страница с пагинацией и сортировкой по полям
  	public function one($arrayOne = []) {
  		$check_admin = $this->sessionStart();

  		if (isset($_POST['sort'])) {
  			$sort = $_POST['sort'];
  		} elseif (isset($_GET['sort'])) {
  			$sort =$_GET['sort'];
  		} else {$sort = 'name';}


  		if (isset($_GET['page'])) {
  			$page = $_GET['page'];
  		}else{
  			$page = 1;
  		}

  		$numSort = ($page - 1) * 3;

  		$multi_data = (new DatabaseShell)->selectAll('tasks', $sort, $numSort, 3);

      if (!empty($arrayOne)) {
        foreach ($arrayOne as $key=>$value) {
            $multi_data[$key] = $value;
        }
      }
  		$multi_data['view'] = 'main';
      $multi_data['check_admin'] = $check_admin;
      $multi_data['page'] = $page;
      $multi_data['sort'] = $sort;
      // var_dump($multi_data);

      (new View)->render($multi_data);
  	}


    // Вспомогательная ф-ция для one()
    public function sessionStart()
    {
      if((new SessionShell)->exists('auth')){
        $check_admin = 1;
      }else{
        $check_admin = 0;
      }
      return $check_admin;
    }


    // Вставка задачи в Базу Данных с главной страницы
    public function insertBd()
    {
      if (isset($_POST['name']) and isset($_POST['textt']) and isset($_POST['email'])){
       $post = ( new Validator )->xssFilter();
      // var_dump($post);
        $err = (new Validator)->inLength($post['name'], 0, 1000, 'name')->inLength($post['email'], 0, 1000, 'email')->isEmail($post['email'])->result();
        // var_dump($err);
          $multi_data['err'] = $err;
        if ($err == 1) {
          $resultPast = (new DatabaseShell)->save('tasks', $post);

          // var_dump($resultPast);
          if ($resultPast) {
            $multi_data['resultPast'] = $resultPast;
          }
        }
        return $this->one($multi_data);
        
      }else{
        $this->one();
      }
    }


    /*
    *АДМИНКА:
    * 
    *
    */ 
    //Вход в админку
    public function logIn()
    {  
      if (!empty($_POST['name']) and !empty($_POST['pass'])) {
        $post = ( new Validator )->xssFilter();

        if ($this->checkPasword($post['name'], $post['pass'])) {
          return $this->one();
          
        }else{ 
          // header( 'Location: http://google.ru/search?q=redirect' );
          require_once $_SERVER['DOCUMENT_ROOT'] . '/project/view/exit.php';
        }
      }else{
        
        if (isset($_POST['name'])) {
          $errorsForm = (new Validator)->inLength($_POST['name'], 0, 1000, 'name')->inLength($_POST['pass'], 0, 1000, 'pass')->result();
        }
        require_once $_SERVER['DOCUMENT_ROOT'] . '/project/view/form.php';
      }
    }
    

    // Выход 
    public function logOut()
      {
        (new SessionShell)->del('auth');
        return $this->one();
      }


    // Вспомогательная ф-ция для LogIn()
    public function checkPasword($name, $pass)
    {
    $data = (new DatabaseShell)->byName('admin', $name);
      if ($pass == $data['pass']) {
        (new SessionShell)->set('auth', 1);
        return true;
      } 
      return false;
    }


    // Форма редактирования задачи по id 
    public function editItem()
    {
         $bool = (new SessionShell)->exists('auth');
         if ($bool) {
          
         if (isset($_GET['id'])) {
            $id_m = $_GET['id'];
            $data = (new DatabaseShell)->get('tasks', $id_m);
            require_once $_SERVER['DOCUMENT_ROOT'] . '/project/view/edit.php';
        } 
      }else{ return $this->one();}
    }


    // Изменение значения текста задачи
    public function insertItem()
    {
      $bool = (new SessionShell)->exists('auth');
         if ($bool) {
          if (isset($_POST['textt'])) {
                  

            $post = ( new Validator )->xssFilter();
            $post['edit'] = 1;
            (new DatabaseShell)->updateItem($post);
          }
          return $this->one();
          }else{ return $this->one();}

    }


    // Изменение Статуса задачи на "Выполненно"
    public function insertDone()
    {
      $bool = (new SessionShell)->exists('auth');
         if ($bool) {
          if (!empty($_GET)) {
                  
            $post['id'] = $_GET['id'];
            $post['status'] = 1;
            (new DatabaseShell)->updateItem($post);
          }
          return $this->one();
          }else{ return $this->one();}

    }

  	
  }
