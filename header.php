
<header class='w-full bg-black p-2 text-white flex justify-between items-center justify-items-center'>
    <h1 class='text-3xl font-extrabold'>Simple Users app</h1>   
    <?php

    if (isset($_SESSION['user'])) {
        include 'logout.php';
    }
    ?>

    
</header>
