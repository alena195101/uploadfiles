<?php
session_start();
$flag = 5;
if (isset($_POST["flag"])) // проверяем, существует ли переменная $flag в массиве POST
{
    $input = $_POST["input"];
    $flag = $_POST["flag"];
}
if ($flag == 1) // кнопка «Отправить» нажата
{
    if (isset($_SESSION['captcha_string']) && $input == $_SESSION['captcha_string'])
    // пользовательское значение и реальное значение капчи совпали
    { 
    	echo '
        <h5>Капча введена верно!</h5>
        <form action="file.php" method="post" enctype="multipart/form-data">
		<p>Изображения:
		<br><input type="file" name="pictures[]" />
		<br><input type="file" name="pictures[]" />
		<br><input type="file" name="pictures[]" />

	    <p><br><input type="submit" name="submit" value="Отправить файлы" /></p>
		</p> </form>';
      } else // если ответ неверный, капча показывается снова
      { 
      	echo '
          <h5>Ваш ответ неправильный!<br>Пожалуйста, попробуйте снова.</h5>';
        $image = imagecreatetruecolor(200, 50);

		imagefilledrectangle($image,0,0,205,55,0x000000);
		imagefilledrectangle($image,2,2,197,47,0xFFFFE0);//рисуем поле капчи

		$line_color = imagecolorallocate($image, 64,64,64);//создаем шум
		  for($i=0;$i<10;$i++) {
		     imageline($image,0,rand()%50,200,rand()%50,$line_color);
			}

		$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';//задание текста
		 $len = strlen($letters);
		 $letter = $letters[rand(0, $len-1)];
		 $text_color = imagecolorallocate($image, 0,0,0);
		 
		 for ($i = 0; $i< 3; $i++) {
		     $letter = $letters[rand(0, $len-1)];
		     imagestring($image, 5,  5+($i*30), 20, $letter, $text_color);
		     $word.=$letter;
		 }
		$_SESSION['captcha_string'] = $word;

		imagepng($image, "image.png");

	     echo '
			<form action="file.php" method="post" enctype="multipart/form-data">
			<h5>ВВЕДИТЕ ТЕКСТ, ИЗОБРАЖЕННЫЙ НА КАРТИНКЕ</h5>
			<div style="display:block;margin-bottom:20px;margin-top:20px;">
		     	<img src="image.png">
		    </div> 
		    <input type="text" name="input"/>
		    <br><input type="hidden" name="flag" value="1"/>
		    <input type="submit" name="submit" value="Проверить" />
			</p> </form>
		';
      }
  } else {// страница загружается снова 
       $image = imagecreatetruecolor(200, 50);

		imagefilledrectangle($image,0,0,205,55,0x000000);
		imagefilledrectangle($image,2,2,197,47,0xFFFFE0);//рисуем поле капчи

		$line_color = imagecolorallocate($image, 64,64,64);//создаем шум
		  for($i=0;$i<10;$i++) {
		     imageline($image,0,rand()%50,200,rand()%50,$line_color);
			}

		$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';//задание текста
		 $len = strlen($letters);
		 $letter = $letters[rand(0, $len-1)];
		 $text_color = imagecolorallocate($image, 0,0,0);
		 
		 for ($i = 0; $i< 3; $i++) {
		     $letter = $letters[rand(0, $len-1)];
		     imagestring($image, 5,  5+($i*30), 20, $letter, $text_color);
		     $word.=$letter;
		 }
		$_SESSION['captcha_string'] = $word;

		imagepng($image, "image.png");

	     echo '
			<form action="file.php" method="post" enctype="multipart/form-data">
			<h5>ВВЕДИТЕ ТЕКСТ, ИЗОБРАЖЕННЫЙ НА КАРТИНКЕ</h5>
			<div style="display:block;margin-bottom:20px;margin-top:20px;">
		     	<img src="image.png">
		    </div> 
		    <input type="text" name="input"/>
		    <br><input type="hidden" name="flag" value="1"/>
		    <input type="submit" name="submit" value="Проверить" />
			</p> </form>
		';
 }

// Сначала создаем наше изображение штампа вручную с помощью GD
$stamp = imagecreatetruecolor(130, 70);
imagefilledrectangle($stamp, 0, 0, 129, 60, 0x0000FF);
imagefilledrectangle($stamp, 9, 9, 120, 59, 0xE0FFFF);
imagestring($stamp, 5, 20, 20, 'CATIMHO', 0x0000FF);


// Установка полей для штампа и получение высоты/ширины штампа
$marge_right = 10;
$marge_bottom = 10;
$sx = imagesx($stamp);
$sy = imagesy($stamp);

if ( isset ( $_POST['submit'] ) ) {
	print "<pre>";
	foreach ($_FILES["pictures"]["error"] as $key => $error) {
	    if ($error == UPLOAD_ERR_OK) {
	        $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
	        // basename() может спасти от атак на файловую систему;
	        // может понадобиться дополнительная проверка/очистка имени файла
	        $name = basename($_FILES["pictures"]["name"][$key]);
	        if ((mime_content_type($tmp_name )=='image/png')||(mime_content_type($tmp_name )=='image/jpeg')){
	        	 $im = imagecreatefromjpeg($tmp_name);
				// Слияние штампа с фотографией. Прозрачность 50%
				imagecopymerge($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp), 40);

				// Сохранение фотографии в файл и освобождение памяти
				imagepng($im, $tmp_name);
				imagedestroy($im);
	        	move_uploaded_file($tmp_name, "/Applications/MAMP/htdocs/upload/$name");
	        	echo(" файл загружен $name\n");	


		    }
	        else echo(" файл $name не соответсвует типу jpeg и png \n ");
	    }
	    else echo(" файл $name не загрузился\n");
	}
	
	print "</pre>";
}
?>