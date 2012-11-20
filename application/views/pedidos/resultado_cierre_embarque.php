<h1>Resultado</h1>
<?php
	if($res == 0){
?>

<p class="message success">Cerrado Correctamente !</p>

<?php
	}elseif($res == 1){
?>

<p class="message error">No se puede procesar por su Status.</p>

<?php
	}elseif($res == 2){
?>

<p class="message error">No se puede actualizar el pedidos con los datos proporcionados.</p>

<?php
	}elseif($res == 3){
?>

<p class="message error">No se puede actualizar el pedidos con los datos proporcionados.</p>

<?php
	}
?>