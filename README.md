# Размещение  и запуск
Всю внутреннюю часть кроме .insomnia папки необходимо переместить в localhost (я разрабатывал на OpenServer)
В .env файл необходимо ввести актуальные для вашей машины значения хоста, имени базы, пользователя и пароля. Для разработки использовался MySql.
!Обязательно выполнить первый роут из списка тестирования, для загрузки дампа базы данных (load db_dump)

# Тестирование
Для тестирования я использовал insomnia (не работал с postman). Если у вас есть инсомния можно просто открыть папку .insomnia в Insomnia и откроются использованные мной шаблоны запросов.
Если же у вас нету Insomnia далее идет описание роутов приложения:

## load db_dump (загрузка дампа бд)
Необходимо выполнить перед дальнейшим тестированием апи.
```
Get - http://localhost/api/config/start.php
Response:
200 OK Success
```

## Create (создание/добавление книги)
```
POST - http://localhost/api/book/create.php
Body - JSON:
{
  "name":"Лисья нора",
  "year":"2019",
  "author":"Нора Сакович"
}
Response: 
201 Created {"message": "Книга была создана."},
503 Service Unavailable {"message":"Невозможно создать книгу."},
400 Bad Request {"message":"Невозможно создать книгу. Данные неполные."}
```

## List (Список книг)
```
GET - http://localhost/api/book/read.php
Response:
200 OK
{
  "records":[
	{
	  "id":"",
	  "name":"",
	  "year":"",
	  "author":""
	},
	{...},
	...
	]
},
404 Not Found {"message": "Книги не найдены."}

## Update (Обновление книги)
PUT - http://localhost/api/book/update.php
Body - JSON:
{
  "id":"1",
  "name":"name",
  "year":"2019",
  "author":"author"
}
Response:
200 OK {"message": "Книга была обновлена"},
503 Service Unavailable {"message":"Невозможно обновить книгу"}
```

## Search (Поиск книг по 1 из параметров Название/Год издания/Автор)
```
GET - http://localhost/api/book/search.php?s=Булгаков
Response:
200 OK
{
  "records":[
	{
	  "id":"",
	  "name":"",
	  "year":"",
	  "author":""
	},
	{...},
	...
	]
},
404 Not Found
{ "message": "Книги не найдены. }
```

## Delete (Удаление книги по id)
```
DELETE - http://localhost/api/book/delete.php
Body - JSON:
{
  "id":"1"
}
Response:
200 OK {"message": "Книга была удалена"},
503 Service Unavailable {"message":"Не удалось удалить книгу"}
```
