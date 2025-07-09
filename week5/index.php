<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 5 Colors</title>
</head>
<body>
<?php
$connectionToColorsDatabase = mysqli_connect("localhost", "root", "", "colors");

if ($connectionToColorsDatabase) 
{
    $qry = "SELECT * FROM colors";
    $colorsData = mysqli_query($connectionToColorsDatabase, $qry);

    if ($colorsData) 
    {
        while ($row = mysqli_fetch_array($colorsData))
        {
            echo "<div style='background: " . $row['Hex'] . "; color:white; padding: 10px; margin: 5px 0;'>";
            echo $row['Name'];
            echo "</div>";
        }
    } 
    else 
    {
        echo "No data fetched";
    }
} 
else 
{
    die("Connection failed: " . mysqli_connect_error());
}
?>
</body>
</html>