
<?php
print "<pre>";
	$dir="/Applications/MAMP/htdocs/upload/";
	if(is_dir($dir)){
		if ($handle = opendir($dir))
		{	
			$files = scandir($dir);

			while (($entry = readdir($handle))!== false)
			{
				if ($entry != "." && $entry != "..")
				{
					if(is_file($dir . $entry)){
						$i++;
						echo $i."\t".$entry . "\t file\n";
					}
					elseif ((is_dir($dir . $entry))){
						$i++;
						echo $i."\t".$entry . "\t dir\n";
					}
				}
			}
			echo '<form action="wokrcatalog.php" method="post">
				<h5>ВВЕДИТЕ НОМЕР ФАЙЛА, КОТОРЫЙ ХОТИТЕ УДАЛИТЬ<h5> 
				<br><input type="text" name="idfile"/>
				<br><input type="submit" name="submit" value="Удалить" />
				</form>;
			';
			if ( isset ( $_POST['submit'] ) ) {
				$id = $_POST['idfile']+1;
				$name = $files[$id];
				if(is_file($dir . $name))
					if(unlink($dir.$name)){
						echo ("\n Файл $name удален\n");
						header("location: wokrcatalog.php");
					}
					else 
						echo ("\nФайл $name не удален");
				elseif ((is_dir($dir . $entry)))
					echo ("Нельзя удаласть дериктории");

				}
			closedir($handle);
		}
	}

print "</pre>";
?>