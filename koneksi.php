<?php
$server   = 'localhost';
$username = 'root';
$password = '';
$database = 'uas_1707';

$conn = new mysqli($server, $username, $password, $database);

if($conn->connect_error)
{
	die('gagal terhubung'. $conn->connect_error);

}
else
{
	echo '<h3>berhasil terhubung</h3>';

}

?>