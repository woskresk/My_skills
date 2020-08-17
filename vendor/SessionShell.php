<?php 

namespace Vendor;

  class SessionShell
  {
    // Удобно стартуем сессию в конструкторе класса:
    public function __construct()
    {
      if (!isset($_SESSION)) {
        session_start();
      }
      return $this;
    }
    
    //Установить переменную в сессию
    public function set($name, $value)
    {
       $_SESSION[$name] = $value;
       return $this;
    }
     // получить значение переменной их сессии
    public function get($name)
    {
      return $_SESSION[$name];
    }
    
    // удалить переменную их сессии
    public function del($name)
    {
      unset($_SESSION[$name]);
      return $this;
    }
    
    //проверить существование переменной
    public function exists($name)
    {
      if (isset($_SESSION[$name])) {
          return true;
      }
      return false;
    }
    
    public function destroy()
    {
      session_destroy(); 
    }
  }