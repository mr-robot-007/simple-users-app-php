<script src="https://cdn.tailwindcss.com"></script>


<?php
include 'constants.php';
include 'header.php';


const conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB);


function test_input($input, $id)
{
    $sql_query = "SELECT * from demo_table WHERE username='$input' AND id!='$id'";
    $result = conn->query($sql_query)->fetch_assoc();
    print_r($result);
    if ($result === null) {
        return false;
    } else {
        return true;
    }

}

$usernameErr = $_GET['usernameErr'] ?? "";
$passwordErr = $_GET['passwordErr'] ?? "";

if (isset($_POST["edituser"])) {
    $id = $_POST["id"];

    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else if (test_input($_POST["username"], $id)) {
        $usernameErr = "username already exists";
    }
    if (empty($_POST["password"])) {
        $passwordErr = "Password can't be empty";
    }
    echo strlen($usernameErr) . strlen($passwordErr);
    if (strlen($usernameErr) > 0 || strlen($passwordErr) > 0) {
        header("Location:edit.php?id={$id}&usernameErr={$usernameErr}&passwordErr={$passwordErr}");
        die();
    } else {

        $email = $_POST["email"];
        $password = $_POST["password"];
        $username = $_POST["username"];
        $image_data = $_FILES["image"];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        if($target_file === $target_dir) $target_file="Not available";

        $sql_query = "UPDATE demo_table SET username = '$username' , password = '$password',profile_pic= '$target_file' WHERE email='$email'";
        conn->query($sql_query);




        header('Location:dashboard.php');
    }

}
$_id = $_GET['id'];
$sql_query = "SELECT * from demo_table WHERE id='$_id' ";
$result = conn->query($sql_query)->fetch_assoc();
echo '
<div>
    <a href="dashboard.php">

        <button class="p-4 hover:text-blue-600 hover:font-semibold">🔙Go back</button>
    </a>
    <form action="edit.php" method="POST" enctype="multipart/form-data" class=" rounded-lg flex flex-col mx-[10%] bg-gray-100 p-4 mt-8 gap-2 items-center 
    ">
    <h1 class="font-bold text-xl">Edit user</h1>
    <input type = "hidden" name = "edituser" value = "true"/>
    <div class="flex gap-2 w-[60%] justify-between">
        <label for="email">Email : </label>
        <div>
        <input type = "email" name="email" disabled  class="px-1 rounded-md outline outline-2"value = "' . $result["email"] . '" />
        </div>
        <input type = "hidden" name="email"   class=" rounded-md outline outline-2"value = "' . $result["email"] . '" />
        <input type = "hidden" name="id"   class=" rounded-md outline outline-2"value = "' . $result["id"] . '" />
    </div>
    <div  class="flex gap-2 w-[60%] justify-between">
        <label for="username">Username : </label>
        <div class="flex flex-col">
        <input type = "username" name="username"  class="px-1 rounded-md outline outline-2"value = "' . $result["username"] . '" />
        <span class="error text-red-800 text-xs">' . $usernameErr . '</span>
        </div>
    </div>
    <div  class="flex gap-2 w-[60%] justify-between">
        <label for="password">Password : </label>
        <div class="flex flex-col">
        <input type = "text" name="password"  class="px-1 rounded-md outline outline-2" value ="' . $result["password"] . '"/>
        <span class="error text-red-800 text-xs">' . $passwordErr . '</span>
        </div>
    </div>
    <div  class="flex gap-2 w-[60%] justify-between">
        <label for="image">Image : </label>
        <input type = "file" name="image"  class="p-0 rounded-md outline outline-2" />
    </div>
    <button type = "submit" class="w-[60%] bg-black text-white rounded-xl p-2 hover:bg-gray-700 ">Save</button>
</form>
</div>

';