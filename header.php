
<header class='w-full bg-black p-2 text-white flex justify-between items-center justify-items-center'>
    <h1 class='text-3xl font-extrabold'>Simple Users app</h1>   
    <?php

    if (isset($_SESSION['username'])) {
        include 'logout.php';
        // echo '
        // <form method="POST" action="dashboard.php" class="items-center flex gap-2 item-center p-0 m-0">
        // <input type = "hidden" name ="logout" value="true" />
        // <img class=" rounded-full h-12 pr-2" src=" '. $_SESSION["profile_pic"] .'" alt="img" />
        // <h3 class="text-white font-semibold ">Hii,' . $_SESSION["username"] . '</h3>
        // <button class="bg-gray-500 rounded-md p-2 text-white mt-2">Logout</button>
        // </form> ';
    }
    ?>

    
</header>
