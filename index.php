<?php 
	
// ВКЛЮЧАЕМ АВТОЗАГРУЗКУ КЛАССОВ

    // spl_autoload_register(); // включаем автозагрузку
	
	spl_autoload_register(function($class) {
		preg_match('#(.+)\\\\(.+?)$#', $class, $match);
		
		$nameSpace = str_replace('\\', DIRECTORY_SEPARATOR, strtolower($match[1]));
		$className = $match[2];
		
		$path = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $nameSpace . DIRECTORY_SEPARATOR . $className . '.php';
		
		if (file_exists($path)) {
			require_once $path;
			
			if (class_exists($class, false)) {
				return true;
			} else {
				throw new \Exception("Класс $class не найден в файле $path");
			}
		} else {
			throw new \Exception("Для класса $class не найден файл $path");
		}
	});
		    
// ПОДКЛЮЧЕНИЕ К БД

    require_once $_SERVER['DOCUMENT_ROOT'] . '/project/config/connection.php';

// ЗАПУСК РОУТЕРА

    $routers = require_once $_SERVER['DOCUMENT_ROOT'] . '/project/config/routers.php';
    echo ( new Core\Router )->getTrack($routers);
