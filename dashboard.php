<script src="https://cdn.tailwindcss.com"></script>
<!-- <script>
    document.getElementById("delete_button").addEventListener("click", function(event){
    event.preventDefault();
    if(confirm("Are you sure you want to delete this item?")){
        // Run the delete routine
        console.log(event);
    }
});
</script> -->

<?php

include 'constants.php';
const conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB);


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
        $_SESSION["profile_pic"] = $result["profile_pic"];
        $_SESSION["username"] = $result['username'];
    } else {
        header('Location:index.php');
    }
}
// echo "<br>";


if (isset($_SESSION['username'])) {
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

?>

<div class="container mx-auto px-4">
        <table class="table-auto w-full mt-10">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Username</th>
                    <th class="px-4 py-2 text-left">Profile_Pic</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $rows = $_SESSION['result'];

                foreach ($rows as $row) {
                    echo "<tr>";
                    echo "<td class='border px-4 py-2'>" . $row["id"] . "</td>";
                    echo "<td class='border px-4 py-2'>" . $row["email"] . "</td>";
                    echo "<td class='border px-4 py-2'>" . $row["username"] . "</td>";
                    echo "<td class='border px-4 py-2'>" . $row["profile_pic"] . "</td>";
                    echo "<td class='border px-4 py-2'>" . "<a href ='edit.php?id={$row["id"]}'><button class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>Edit</button></a>" . "</td>";
                    // echo "<td class='border px-4 py-2'>" . "<a id='delete_button' '><button id = 'delete_button' class='bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded'>Delete</button></a>" . "</td>";
                    echo "<td class='border px-4 py-2'>" . "<a href ='delete.php?id={$row["id"]}'><button class='bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded'>Delete</button></a>" . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="createuser.php">
            <button class="font-semibold p-2 bg-gray-400 text-white rounded-md mt-2 hover:bg-black">
                Add new user
            </button>
        </a>
    </div>


