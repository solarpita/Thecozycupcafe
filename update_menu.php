<?php
require_once __DIR__ . '/../app/Config/Database.php';

use App\Config\Database;

$database = new Database();
$conn = $database->getConnection();

$updates = [
    'Espresso' => 'coffe1.jpg',
    'Latte' => 'coffe2.jpg',
    'Mocha' => 'coffe3.jpg',
    'Americano' => 'coffe4.jpg',
    'Croissant' => 'pastries1.jpg',
    'Muffin' => 'cake.jpg',
    'Cookie' => 'cookies.jpg',
    'Sandwich' => 'sandwich.jpg',
    'Franchis' => 'franchis.jpg',
    'Garlic-Bread' => 'garlic-bread.jpg',
    'Margarita-Pizza' => 'pizza.jpg',
    'Maggie' => 'maggie.jpg'
];

foreach ($updates as $name => $image) {
    if ($name === 'Margarita-Pizza' || $name === 'Garlic-Bread') {
         // handle hyphenated names if needed, but DB says 'Margarita-Pizza'
    }
    
    $sql = "UPDATE menu SET image = :image WHERE name = :name";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':name', $name);
    
    if($stmt->execute()) {
        echo "Updated $name to $image\n";
    } else {
        echo "Failed to update $name\n";
    }
}

echo "Update complete.\n";
