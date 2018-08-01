<?php 

$name = $_GET['name'];
$company = $_GET['company'];
$city = $_GET['city'];
$email = $_GET['email'];

$message = "
Имя {$name} \n
Компания {$company} \n
email {$email} \n
Город {$city} \n
";


mail('vip.41243@gmail.com', 'Заказ сайта', $message);