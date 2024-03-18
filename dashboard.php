 <?php
 // echo phpinfo();
// die();
 ?> 
<script src="https://cdn.tailwindcss.com"></script>

<?php

include 'constants.php';

$usernameErr = $passwordErr = "";
if (isset($_POST["logout"])) {
    // echo "loggintout";
    unset($_SESSION['username']);
    session_destroy();
    header("Location:index.php");
} else if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    // echo $email , $password;
    $sql_query = "SELECT * from demo_table WHERE email='$email' AND password='$password'";
    $result = conn->query($sql_query)->fetch_assoc();
    // print_r($result);
    if ($result) {
        // $_SESSION["user"] = $result["profile_pic"];
        $_SESSION["user"] = array(
            "username" => $result["username"],
            "uid" => $result["id"],
            "profile_pic" => $result["profile_pic"],
            "type" => $result["type"],
        );
        // $_SESSION["username"] = $result['username'];
    } else {
        header('Location:index.php');
    }
}


if (isset($_SESSION['user']['username'])) {
    include 'header.php';
    $sql_query = "SELECT * from demo_table";
    $result = conn->query($sql_query);

    if ($result->num_rows > 0) {
        $_SESSION["result"] = $result;
    } else {
        echo "0 results";
    }

} else {
    header("Location: index.php");
}
include 'listing.php';

?>
