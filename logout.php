<form method="POST" action="dashboard.php" class='items-center flex gap-2 item-center p-0 m-0'>
        <input type = "hidden" name ="logout" value="true" />
        <img class=" rounded-full h-12 pr-2" src= <?php echo $_SESSION["profile_pic"] ?> alt="img" />
        <h3 class='text-white font-semibold '>Hii, <?php echo $_SESSION["username"] ?></h3>
        <button class='bg-gray-500 rounded-md p-2 text-white mt-2'>Logout</button>
    </form>