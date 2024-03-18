<?php
ob_start();
session_start();
define("SERVER_NAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DB", "testDB");


const conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB);