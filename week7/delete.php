<?php
if (isset($_GET['id'])) {
    require('connect.php');
    $id = $_GET['id'];
    $query = "DELETE FROM schools WHERE `id` = $id";
    $result = mysqli_query($connect, $query);
}
header('Location: index.php');
exit();
