<script src="https://cdn.tailwindcss.com"></script>
<?php 

include 'constants.php';
include 'header.php';
const conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB);


function test_input($input)
{
    $sql_query = "SELECT * from demo_table WHERE email='$input' OR username='$input'";
    $result = conn->query($sql_query)->fetch_assoc();
    if ($result) {
        return false;
    } else {
        return true;
    }

}

$usernameErr = $emailErr = $passwordErr = "";
if (isset($_POST["createuser"])) {

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else if (!test_input($_POST["email"])) {
        $emailErr = "Email already exists";
    }
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else if (!test_input($_POST["username"])) {
        $usernameErr = "username already exists";
    }
    if (empty($_POST["password"])) {
        $passwordErr = "Password can't be empty";
    }
    if (!strlen($usernameErr) && !strlen($emailErr)) {

        $email = $_POST["email"];
        $password = $_POST["password"];
        $username = $_POST["username"];
        $image_data = $_FILES["image"];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);



        // header('Location:dashboard.php');

        $sql_query = "SELECT * from demo_table WHERE email='$email' OR username='$username'";
        $result = conn->query($sql_query)->fetch_assoc();
        // print_r($result);
        if ($result) {
            header("Location:createuser.php");
        } else {

            $sql_query = "INSERT into demo_table (username,email,profile_pic,password) VALUES ('$username','$email','$target_file','$password')";
            if (conn->query($sql_query)) {
                echo "New user created successfully. <br>";
                header("Location:dashboard.php");

            }
        }
    }
}
?>


<div>
    <a href="dashboard.php">

        <button class="p-4 hover:text-blue-600 hover:font-semibold">🔙Go back</button>
    </a>
    <form action="createuser.php" enctype="multipart/form-data" method="POST" class=" rounded-lg flex flex-col mx-[10%] bg-gray-100 p-4 mt-8 gap-2 items-center 
    ">
    <h1 class="font-bold text-xl">Add new user</h1>
    <input type = 'hidden' name = 'createuser' value = 'true'/>
    <div class="flex gap-2 w-full justify-between">
        <label for="email">Email : </label>
        <div class="flex flex-col">

            <input type = "email" name="email" class="px-1 rounded-md outline outline-2" />
            <span class="error text-red-800 text-xs"><?php if ($emailErr)
                echo $emailErr; ?></span>
            </div>
    </div>
    <div  class="flex gap-2 w-full justify-between">
        <label for="username">Username : </label>
        <div class="flex flex-col">

            <input type = "username" name="username" class="px-1 rounded-md outline outline-2" />
            <span class="error text-red-800 text-xs"><?php if ($usernameErr)
                echo $usernameErr; ?></span>
        </div>
    </div>
    <div  class="flex gap-2 w-full justify-between">
        <label for="password">Password : </label>
        <div class="flex flex-col">

            <input type = "password" name="password"  class="px-1 rounded-md outline outline-2" />
            <span class="error text-red-800 text-xs"><?php if ($usernameErr)
                echo $passwordErr; ?></span>
        </div>
    </div>
    <div  class="flex gap-2 w-full justify-between">
        <label for="image">Image : </label>
        <input type = "file" name="image"  class="px-1 rounded-md outline outline-2" />
    </div>
    <button type = "submit" class="w-full bg-black text-white rounded-xl p-2 hover:bg-gray-700 ">Create user</button>
</form>
</div>