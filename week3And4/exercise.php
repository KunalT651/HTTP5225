<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users from JSONPlaceholder API</title>
</head>
<body>
    <?php
//Function to fetch user data from the JSONPlaceholder API
function getUsers() {
    $url = "https://jsonplaceholder.typicode.com/users";
    $data = file_get_contents($url);
    return json_decode($data, true);
}

//Get the list of users
$users = getUsers();

    // Use a for loop to display user information
    for ($i = 0; $i < count($users); $i++) 
    {
        echo "<div style='margin-bottom: 20px;'>";
        echo "<strong>Name:</strong> " . $users[$i]['name'] . "<br>";
        echo "<strong>Username:</strong> " . $users[$i]['username'] . "<br>";
        echo "<strong>Email:</strong> " . $users[$i]['email'] . "<br>";
        echo "<strong>City:</strong> " . $users[$i]['address']['city'] . "<br>";
        echo "<strong>Company:</strong> " . $users[$i]['company']['name'] . "<br>";
        echo "</div>";
    }
    ?>

</body>
</html>
