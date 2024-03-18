


<div class="container mx-auto px-4">
        <table class="table-auto w-full mt-10">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Username</th>
                    <th class="px-4 py-2 text-left">Profile_Pic</th>
                    <?php if ($_SESSION['user']['type'] === 'admin') {
                        echo '
                        <th class="px-4 py-2 text-left">Actions</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                        ';
                    } ?>
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
                    if ($_SESSION['user']['type'] === 'admin') {
                        echo "<td class='border px-4 py-2'>" . "<a href ='createuser.php?id={$row["id"]}'><button class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>Edit</button></a>" . "</td>";
                        // echo "<td class='border px-4 py-2'>" . "<a id='delete_button' '><button id = 'delete_button' class='bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded'>Delete</button></a>" . "</td>";
                        echo "<td class='border px-4 py-2'>" . "<a href ='delete.php?id={$row["id"]}'><button class='bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded'>Delete</button></a>" . "</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php if ($_SESSION['user']['type'] === 'admin') {
            echo '
                <a href="createuser.php">
                <button class="font-semibold p-2 bg-gray-400 text-white rounded-md mt-2 hover:bg-black">
                Add new user
                </button>
                </a>
            ';
        } ?>
    </div>


