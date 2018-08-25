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
// mail('onlinedesign.stud@gmail.com', 'Заказ сайта', $message);
mail('alfred.hendrikson@list.ru', 'Заказ сайта', $message);


 
$mainMessage='<b>Здравствуйте!</b>
<br><br>
Меня зовут Владислав. <br>
Спасибо за проявленный интерес к нашей продукции. <br>

Предлагаем ознакомиться с актуальным предложением по нашему ассортименту детских головных уборов. <br>
Мы работаем на следующих условиях: <br>
1. Минимальная сумма заказа <b>от 8000 руб</b>. <br>
2. Предоплата <b>100% </b><br>
3. Доставка в черте города Санкт-Петербурга до КАД бесплатно. <br>
4. Доставка до транспортной компании (Деловые Линии) бесплатно. Другая транспортная компания оговаривается отдельно. 
 <br>
 <br>
Если Вас заинтересовало наше предложение, ожидаем информации по заказу. <br>
Вы можете заполнить бланк заказа и выслать нам на почту. <br>
Вопросы, касающиеся оплаты заказа, доставки и другие вопросы сотрудничества, с радостью готовы обсудить с Вами лично по электронной почте или по телефону. <br>
 <br>
Также вы можете просмотреть модели наших шапок по ссылке:  <br>
https://yadi.sk/d/5sk2znk33aGQox
<br>
<br>
<br>
'; 


$file = "./order_blank.xlsx";
  $testexcel =  $file;

    $to      = $email;
    $subject = 'Заявка на КП';

    $message = $mainMessage;

send_mail($to, $subject, $message,  $testexcel, 'order_blank.xlsx');

function send_mail($to, $subject, $message, $path, $realname)
  {
    $fp = fopen($path,"r");
    if (!$fp)
    {
      print "Файл $path не может быть прочитан";
      exit();
    }
    $file = fread($fp, filesize($path));
    fclose($fp);

    $boundary = "--".md5(uniqid(time())); // генерируем разделитель
    // $headers2 = "MIME-Version: 1.0\n"; 
    $headers2 .='From: alfred.hendrikson@list.com' . "\r\n" .
    $headers2 .="Content-Type: multipart/mixed; boundary=\"$boundary\"\n";
    $multipart .= "--$boundary\n"; 
    $kod = 'utf-8'; 
    $multipart .= "Content-Type: text/html; charset=$kod\n"; 
    $multipart .= "Content-Transfer-Encoding: Quot-Printed\n\n";
    $multipart .= "$message\n\n";
    //Блок файла 1
    $message_part .= "--$boundary\n";
    $message_part .= "Content-Type: application/xls; name=\"".$realname."\"\n";
    $message_part .= "Content-Transfer-Encoding: base64\n";
    $message_part .= "Content-Disposition: attachment; filename = \"".$realname."\"\n\n";
    $message_part .= chunk_split(base64_encode($file))."\n";

 
    //Итоги
    $multipart .= $message_part."--$boundary--\n";
 
    if(!mail($to, $subject, $multipart, $headers2)){
      echo "К сожалению, письмо не отправлено";
      exit();
    }
  }