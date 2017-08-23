<!DOCTYPE html>
<html>
<head>
	<title>Pruebas</title>
</head>
<body>
	<form method='POST' onsubmit="return document.getElementByID('test').value!=''">
		<input type="text" name="test" id='test'>
		<input type="submit" value="Buscar">
	</form>
	<br>
	<?php
		if(isset($_POST['test'])&&($_POST['test']!='')){
			require 'bd.php';
			$test=start();
			try{
				$search="%".$_POST['test']."%";
				$stm=$test->prepare('SELECT nombre FROM peliculas WHERE nombre LIKE ?');
				$stm->bindValue(1,$search);
				$stm->execute();
				while($row=$stm->fetch()){
					echo "Pelicula: ".$row->nombre."<br>";
				}
			}catch(PDOException $e){
				echo "Error";
			}
		} 
?>
</body>
</html>