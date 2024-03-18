

<form method="POST" action="dashboard.php" class='items-center  justify-items-center flex gap-2 p-0 m-0'>
    <input type = "hidden" name ="logout" value="true" />
    <a class="flex items-center hover:bg-gray-700 rounded-lg p-1" href = "<?php echo 'createuser.php?id=' . $_SESSION['user']['uid']; ?>">
        <img class=" rounded-full h-8 pr-2" src= <?php echo $_SESSION["user"]["profile_pic"] ?> alt="img" />
        <h3 class='text-white font-semibold  '>Hii, <?php echo $_SESSION["user"]["username"] ?></h3>
    </a>
    <button class='bg-gray-500 rounded-md p-1 text-white'>Logout</button>
    </form>