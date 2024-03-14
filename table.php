
<div class="container mx-auto px-4">
        <table class="table-auto w-full mt-10">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Username</th>
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
                    echo "<td class='border px-4 py-2'>" . "<a href='edit.php'>Edit it</a>" . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>