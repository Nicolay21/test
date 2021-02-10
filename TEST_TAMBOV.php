<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>Решение</title>
 </head>
 <body>

<?php
// 1. Создать SQL таблицу "Products" с полями "ID", "PRODUCT_ID", 
//"PRODUCT_NAME", "PRODUCT_PRICE", "PRODUCT_ARTICLE", 
//"PRODUCT_QUANTITY", "DATE_CREATE"

/*CREATE TABLE `Products` (
`ID` int NOT NULL,
`PRODUCT_ID` int NOT NULL,
`PRODUCT_NAME` varchar(20) NOT NULL,
`PRODUCT_PRICE` DECIMAL(10,2) NOT NULL,
`PRODUCT_ARTICLE` varchar(100),
`PRODUCT_QUANTITY`varchar(10) NOT NULL,
`DATE_CREATE` DATE  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Products`
           (`ID`,
`PRODUCT_ID`,
`PRODUCT_NAME`,
`PRODUCT_PRICE`,
`PRODUCT_ARTICLE`,
`PRODUCT_QUANTITY`,
`DATE_CREATE`)
     VALUES
            (1,'20','Сыр',100,'Твёрдый','10','2021-02-09'),
             (2,'30','Плавленный сыр',120,'Плавленный','15','2021-02-09'),
              (3,'40','Сыр белый',100,'Твёрдый','20','2021-02-09'),
               (4,'50','Тульский пряник',80,'С мёдом','30','2021-02-09'),
                (5,'60','Тульский пряник',80,'С повидлом','30','2021-02-09')*/

//2. На PHP написать функцию которая возвращает массив товаров из таблицы "Products".
//Функция должна содержать, как минимум, 1 параметр, который отвечает за ограничение количества выводимых товаров.

function output ($a)
{
	require_once 'connect.php'; // подключаем скрипт данных сервера

// подключаемся к серверу
	$link = mysqli_connect($host, $user, $password, $database) 
		or die("Ошибка " . mysqli_error($link));

 
// выполняем операции с базой данных
	$query = "SELECT `ID`, `PRODUCT_ID`,`PRODUCT_NAME`, `PRODUCT_PRICE`, `PRODUCT_ARTICLE`, `PRODUCT_QUANTITY`, `DATE_CREATE` FROM `products`";
		$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
		$array = mysqli_fetch_all($result, MYSQLI_ASSOC);

for($i= 0; $a < count($array); $i++)
array_pop($array);

/*if($array) // вывод массива на экран
{
    echo "Выполнение запроса прошло успешно";
	 echo "<pre>";
	print_r ($array);
	 echo "</pre>";
}*/
	return $array;

	mysqli_close($link);// закрываем подключение
}
/*$n = output (4);//вывод массива на экран
 echo "<pre>";
print_r($n);
echo "</pre>";*/

//3. Создать страничку, на которой будет выводиться html таблица с актуальными 
//товарами, отсортированными по дате создания (по убыванию).

function output_table ()
{
	require_once 'connect.php'; // подключаем скрипт данных сервера

// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

// выполняем операции с базой данных
$sort = "SELECT * FROM `products` ORDER BY `DATE_CREATE` desc";// сортируем по убыванию и заносим в переменную
 $result_sort = mysqli_query($link, $sort) or die("Ошибка " . mysqli_error($link)); 
$array = mysqli_fetch_all($result_sort, MYSQLI_ASSOC);

/*if($array)
{
    echo "Выполнение запроса прошло успешно";
	 echo "<pre>";
	print_r ($array);
	 echo "</pre>";
}*/

// закрываем подключение
mysqli_close($link);

// создаём таблицу
$a = $array;

$cols = 7; // количество столбцов, td

$table = '<table border="1">';
$table .= '<tr><th>ID</th><th>ID Продукта</th><th>Название</th><th>Цена</th><th>Описание</th><th>Колличество</th><th>Дата</th></tr>';

	 $table .= '<tr>';
	
	foreach ($a as $key_k => $value_v)
	{
		$cols_v = 0;
		foreach ($value_v as $key => $value)
		{
		$table .= '<td>'. $value .'</td>';
		
		$cols_v++;
		
			if($cols_v ==$cols)
			{
				break;
			}
		}
		
	 $table .= '</tr>';
	}

    $table .= '</tr>'; 

echo $table; //выводим таблицу
}
output_table ();

//4. В каждой строке таблицы товаров в последней колонке добавить кнопку "Скрыть"



function output_table4 ()
{
	$host = 'localhost'; // адрес сервера 
$database = 'mysql'; // имя базы данных
$user = 'root'; // имя пользователя
$password = '12345'; // пароль

// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

// выполняем операции с базой данных
$sort = "SELECT * FROM `products` ORDER BY `DATE_CREATE` desc";// сортируем по убыванию и заносим в переменную
 $result_sort = mysqli_query($link, $sort) or die("Ошибка " . mysqli_error($link)); 
$array = mysqli_fetch_all($result_sort, MYSQLI_ASSOC);

/*if($array)
{
    echo "Выполнение запроса прошло успешно";
	 echo "<pre>";
	print_r ($array);
	 echo "</pre>";
}*/

// закрываем подключение
mysqli_close($link);

// создаём таблицу
$a = $array;

$cols = 7; // количество столбцов, td

$table = '<table border="1">';
$table .= '<tr><th>ID</th><th>ID Продукта</th><th>Название</th><th>Цена</th><th>Описание</th><th>Колличество</th><th>Дата</th></tr>';

	 $table .= '<br><tr>';
	
	foreach ($a as $key_k => $value_v)
	{
		$cols_v = 0;
		foreach ($value_v as $key => $value)
		{
		$table .= '<td>'. $value .'</td>';
		
		$cols_v++;
		
			if($cols_v ==$cols)
			{
				$table .= '<td><input type="button" value=" Скрыть "></td>';
				break;
			}
		}
		
	 $table .= '</tr>';
	}

    $table .= '</tr>'; 

echo $table; //выводим таблицу
}
output_table4 ();

//5. С помощью чистого JavaScript или библиотеки JQuery реализовать функционал:
//по клику на кнопку "Скрыть" скрывать всю строку с товаром.

$host = 'localhost'; // адрес сервера 
$database = 'mysql'; // имя базы данных
$user = 'root'; // имя пользователя
$password = '12345'; // пароль

// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

 
// выполняем операции с базой данных

$query = "SELECT `ID`, `PRODUCT_ID`,`PRODUCT_NAME`, `PRODUCT_PRICE`, `PRODUCT_ARTICLE`, `PRODUCT_QUANTITY`, `DATE_CREATE` FROM `products`";
 $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
$array = mysqli_fetch_all($result, MYSQLI_ASSOC);
	?>
<table border="1">
		<br><tr><th>ID</th><th>ID Продукта</th><th>Название</th><th>Цена</th><th>Описание</th><th>Колличество</th><th>Дата</th></tr>
	<?php
	for($i =0; $i < count($array);$i++)
	{
		$key = "key";
		$val = "$i";
		$key =$key.$val;
		echo '<tr id="$key">';
		?>
		
		<td><?php echo $array[$i]['ID'] ?> <td>
			<?php echo $array[$i]['PRODUCT_ID'] ?><td> 
			<?php echo $array[$i]['PRODUCT_NAME'] ?> <td>
			<?php echo $array[$i]['PRODUCT_PRICE']?><td> 
			<?php echo $array[$i]['PRODUCT_ARTICLE'] ?><td>
			<?php echo $array[$i]['PRODUCT_QUANTITY']?><td>
			<?php echo $array[$i]['DATE_CREATE']?> <td>
		<input type="button"  name="button" value = "Скрыть"    onclick="(document.getElementById('$key').style.display='none', data)"></input><tr>
	<?php	
	}?>
	</table>
 <?php
 //6. Написать класс "CProducts", в нем реализовать метод, описанный во втором пункте.
 
 class CProducts
	{
	public $a, $arr;
	
	function output ($a)
	{
		$this->a =$a;
		
		$host = 'localhost'; // адрес сервера 
		$database = 'mysql'; // имя базы данных
		$user = 'root'; // имя пользователя
		$password = '12345'; // пароль
		// подключаемся к серверу
	$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

	// выполняем операции с базой данных

$query = "SELECT `ID`, `PRODUCT_ID`,`PRODUCT_NAME`, `PRODUCT_PRICE`, `PRODUCT_ARTICLE`, `PRODUCT_QUANTITY`, `DATE_CREATE` FROM `products`";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
		$array = mysqli_fetch_all($result, MYSQLI_ASSOC);

	for($i= 0; $a < count($array); $i++)
		array_pop($array);


$this->arr = $array;

// закрываем подключение
mysqli_close($link);
}
}
$class = new CProducts;
$class-> output(3);
echo "<pre>";
print_r ($class->arr);
echo "</pre>";
 
 ?>
 </body>
</html>