<?php
	
	return [// URI, Контроллер, Метод
				['/', 'Hello', 'one'], // Главная страница
				['/login', 'Hello', 'logIn'],  // Войти в аккаунт
				['/logout', 'Hello', 'logOut'], // Выход
				['/insertbd', 'Hello', 'insertBd'],  // Вставить задачу в БД
				['/edititem', 'Hello', 'editItem'],  // Редактировать задачу (админ)
				['/insertitem', 'Hello', 'insertItem'],  // Вставить задачу (админ)
				['/insertdone', 'Hello', 'insertDone']  // Вставить задачу (админ)
				
	];
