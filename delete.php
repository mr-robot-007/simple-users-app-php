<?php
include 'constants.php';
$conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB);
$_id = $_GET['id'];
$sql_query = "DELETE from demo_table WHERE id='$_id' ";
$conn->query($sql_query);
header("Location:dashboard.php");