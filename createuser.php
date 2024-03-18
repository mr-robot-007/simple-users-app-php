<script src="https://cdn.tailwindcss.com"></script>
<?php

include 'constants.php';
include 'header.php';


function test_input_create($input)
{
    $sql_query = "SELECT * from demo_table WHERE email='$input' OR username='$input'";
    $result = conn->query($sql_query)->fetch_assoc();
    if ($result) {
        return false;
    } else {
        return true;
    }

}

function test_input_edit($input, $id)
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

$emailErr = $_GET['emailErr'] ?? "";
$usernameErr = $_GET['usernameErr'] ?? "";
$passwordErr = $_GET['passwordErr'] ?? "";


if (isset($_POST["createuser"]) && $_POST["id"] != "") {
    $id = $_POST["id"];

    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else if (test_input_edit($_POST["username"], $id)) {
        $usernameErr = "username already exists";
    }
    if (empty($_POST["password"])) {
        $passwordErr = "Password can't be empty";
    }
    echo strlen($usernameErr) . strlen($passwordErr);
    if (strlen($usernameErr) > 0 || strlen($passwordErr) > 0) {
        header("Location:edit.php?id={$id}&usernameErr={$usernameErr}&passwordErr={$passwordErr}");
    } else {

        $email = $_POST["hidden_email"];
        $password = $_POST["password"];
        $username = $_POST["username"];
        $image_data = $_FILES["image"];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        if ($target_file === $target_dir)
            $target_file = "Not available";

        $sql_query = "UPDATE demo_table SET username = '$username' , password = '$password',profile_pic= '$target_file' WHERE email='$email'";
        conn->query($sql_query);




        header('Location:dashboard.php');
    }

} else if (isset($_POST["createuser"])) {


    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else if (!test_input_create($_POST["email"])) {
        $emailErr = "Email already exists";
    }
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else if (!test_input_create($_POST["username"])) {
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
$_id = '';
if (isset($_GET['id'])) {
    $_id = $_GET['id'];
}

$sql_query = "SELECT * from demo_table WHERE id='$_id' ";
$result = conn->query($sql_query)->fetch_assoc();
?>


<div>
    <a href="dashboard.php">

        <button class="p-4 hover:text-blue-600 hover:font-semibold">🔙Go back</button>
    </a>
    <form action="createuser.php" enctype="multipart/form-data" method="POST" class=" rounded-lg flex flex-col mx-[10%] bg-gray-100 p-4 mt-8 gap-2 items-center 
    ">
    <h1 class="font-bold text-xl">
        <?php echo $_id ? "Edit User" : "Add user"; ?>
    </h1>
    <input type = 'hidden' name = 'createuser' value = 'true'/>
    <div class="flex gap-2 w-full justify-between">
        <label for="email">Email : </label>
        <div class="flex flex-col">

            <input type = "email" name="email" <?php if ($result)
                echo "disabled"; ?> class="px-1 rounded-md outline outline-2"  value = "<?php if ($result)
                       echo $result["email"]; ?>" />
            <input type = "email" name="hidden_email" hidden class="px-1 rounded-md outline outline-2"  value = "<?php if ($result)
                echo $result["email"]; ?>" />
            <input type = "hidden" name="id"   class=" rounded-md outline outline-2" value = "<?php if ($result)
                echo $result["id"]; ?>" />
            <span class="error text-red-800 text-xs"><?php if ($emailErr)
                echo $emailErr; ?></span>
            </div>
    </div>
    <div  class="flex gap-2 w-full justify-between">
        <label for="username">Username : </label>
        <div class="flex flex-col">

            <input type = "username" name="username" class="px-1 rounded-md outline outline-2" value = "<?php if ($result)
                echo $result["username"]; ?>"  />
            <span class="error text-red-800 text-xs"><?php if ($usernameErr)
                echo $usernameErr; ?></span>
        </div>
    </div>
    <div  class="flex gap-2 w-full justify-between">
        <label for="password">Password : </label>
        <div class="flex flex-col">

            <input type = "text" name="password"  class="px-1 rounded-md outline outline-2" value = "<?php if ($result)
                echo $result["password"]; ?>"  />
            <span class="error text-red-800 text-xs"><?php if ($usernameErr)
                echo $passwordErr; ?></span>
        </div>
    </div>
    <div  class="flex gap-2 w-full justify-between">
        <label for="image">Image : </label>
        <input type = "file" name="image"  class="px-1 rounded-md outline outline-2" />
    </div>
    <button type = "submit" class="w-full bg-black text-white rounded-xl p-2 hover:bg-gray-700 ">
    <?php echo $_id ? "Save changes" : "Create new user"; ?>
    </button>
</form>
</div>