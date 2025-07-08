<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

$currentHour = date("G"); 

$animalMealType = "";
$mealMenu = "";

if ($currentHour >= 5 && $currentHour < 9)
{
    $animalMealType = "Breakfast";
    $mealMenu = "Bananas, Apples, and Oats";
} 
else if ($currentHour >= 12 && $currentHour < 14) 
{
    $animalMealType = "Lunch";
    $mealMenu = "Fish, Chicken, and Vegetables";
}
else if ($currentHour >= 19 && $currentHour < 21)
{
    $animalMealType = "Dinner";
    $mealMenu = "Steak, Carrots, and Broccoli";
} 
else 
{
    echo "The animals are not being fed at this time.";
    return;
}

echo "Current time is . $currentHour .  So its a . $animalMealType  time. Feed them . $mealMenu";

/* Challenge 2 */
$userInput = rand(1, 10);//(int) readline('Enter a number: ');;

if ($userInput % 3 == 0 && $userInput % 5 == 0)
{
    echo "The magic number is FizzBuzz.";
} 
elseif ($userInput % 3 == 0)
{
    echo "The magic number is Fizz.";
} 
elseif ($userInput % 5 == 0)
{
    echo "The magic number is Buzz.";
} 
else 
{
    echo "The magic number is $userInput.";
}
?>
</body>
</html>