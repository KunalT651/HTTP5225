<?php
require('connect.php');

// Fetch data
$result = mysqli_query($connect, "SELECT * FROM schools");
$schools = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>School List</title>
  <link rel="stylesheet" href="styles.css">

</head>
<body>
  <h2>School List</h2>
  <br>
  <a class="btn" href="add.php">Add New School</a>
  <br>
  <table border="1" cellpadding="5">
    <tr>
      <th>ID</th>
      <th>School Name</th>
      <th>Board Name</th>
      <th>Actions</th>
    </tr>
    <?php foreach ($schools as $school): ?>
      <tr>
        <td><?php echo htmlspecialchars($school['id']); ?></td>
        <td><?php echo htmlspecialchars($school['School Name']); ?></td>
        <td><?php echo htmlspecialchars($school['Board Name']); ?></td>
        <td>
          <a class="btn" href="update.php?id=<?php echo $school['id']; ?>">Edit</a>
          <a class="btn" href="delete.php?id=<?php echo $school['id']; ?>">Delete</a>

        </td>
      </tr>
    <?php endforeach; ?>
  </table>


</body>
</html>
