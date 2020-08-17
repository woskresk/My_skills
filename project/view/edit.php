<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Document</title>
  </head>
  <body>


      <a href="/">Вернутся на главную</a>
      <br> 
   <form method="post" action="/insertitem">
      
  <input type="hidden" name="id" value="<?=  $data['id'];  ?>">
      <label>Введите задачу</label>
      <input type="text" name="textt" value="<?=  $data['textt'];  ?>">

     
      <input type="submit" value="отправить">
    </form>

  </body>
  </html>