<?php
	session_start();

	include("connection.php");

	$content = mysqli_real_escape_string($link, $_POST['diary']);

	$query = "UPDATE users SET diary='".$content."' WHERE id='".$_SESSION['id']."' LIMIT 1";

	mysqli_query($link, $query);

?>

<!-- <form method="post">

	<input name="diary" />
	<input type="submit" />
</form> -->