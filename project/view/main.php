<?php

?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style.css">
  <style type="text/css">.active{color: red;}</style>
    <title>Document</title>
  </head>
  <body>
    
 
    <div class="container">
      <br><p style="font-size: 10px;">Весь код написан исключительно для собеседования (исключая классы DatabaseShell, SessionShell, Validator, но и  они тоже написанны автором), автор постарался разнообразить исполнение типовых задач для лучшей презентации своих знаний. Спасибо! </p><hr>

      <H3> <?php 
      if ($check_admin == 1){echo "<a href=\"/logout\">Выйти</a>"; }else{echo "<a href=\"/login\">Войти</a>";} ?></H3>
    </div>


<div class="container">
  <h1>Таблица задач</h1>
    <form method="post" action="/">

      <div class="form-group" style="display: inline-block;">
        <label for="exampleFormControlSelect1">Сортировать по </label>
          <select class="form-control" id="exampleFormControlSelect1" name="sort">

              <?php 
              $arrayEx = ['name'=>'Имени', 'email'=>'Email', 'status'=>'Статусу'];
              foreach ($arrayEx as $key=>$value) {
                if ($key == $sort) {
                  echo "<option value=\"$key\" selected>$value</option>";
                }else{
                  echo "<option value=\"$key\">$value</option>";
                }
              }
              ?>

          </select>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>


<!-- ТАБЛИЦА -->

<table class="table">
  <thead>
    <tr>
      <th scope="col">Имя</th>
      <th scope="col">Задача</th>
      <th scope="col">Email</th>
      <th scope="col">Выполнение</th>
      <th scope="col">Отредактированно </th>
      <th scope="col">Редактировать</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach ($data as $value) {?>

    <tr>
      <th scope="row"><?= $value['name']; ?></th>
      <td><?= $value['textt']; ?></td>
      <td><?= $value['email']; ?></td>
      <!-- Это то что задача готова -->
      <td><?php if ($value['status'] == 1) {echo 'Выполненно!';}else{
        if ($check_admin == 1) {
        echo "<a href=\"/insertdone?page=$page&sort=$sort&id={$value['id']}\"> &#10004;</a>";
      }else{echo 'НЕ выполненно!';}

      }?></td> 
      <!-- Это то что задача отредактированнна  -->
      <td><?php if ($value['edit'] == 1) {echo 'Админом';}?></td>
      <td><?php if ($check_admin == 1) {echo "<a href=\"/edititem?id={$value['id']}\"> Редактировать</a>";} ?></td>
    </tr>

      <?php } ?>
  </tbody>
</table>

    <?php for ($i=1; $i <= $pageCount ; $i++) { 

                    if ($i == $page) {
                      $class = ' class="active"';
                    }else{
                      $class = '';
                    }
                    echo "<a href=\"/?page=$i&sort=$sort\"$class>$i</a>";
                  }?> 
</div>


<HR>
<br>


<div class="container">
       <h1>Добавить задачу </h1>

       <?php if (isset($resultPast)) {
         echo '<h3 style="color: green;"> Задача добавлена!</h3>';
       }   
      // var_dump($err);
        if (is_array($err)) {
        $summaErrors = '<h3 style="color: red;">';
         foreach ($err as $value) {
             $summaErrors .= " $value<br>";
         }
         $summaErrors .= "</h3>";
         echo $summaErrors;
       }
       ?>
  <form method="POST" action="/insertbd">

    <div class="form-group">
      <label for="exampleInputPassword1">Имя</label>
      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Имя" name="name">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Текст</label>
      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Задача" name="textt">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Email</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
  </html>

