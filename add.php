<?php

require_once 'config.php';
require __DIR__ . '/src/models/recipe_model.php';

$errors = $recipe = [];

 //function test champs
 function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $recipe['title'] = test_input($_POST['title']);
    $recipe['description'] = test_input($_POST['description']);
    
if (empty( $recipe['title'])) {
    echo "empty title" . PHP_EOL;
} 
 if (empty( $recipe['description'])) {
 echo "empty description". PHP_EOL; 
}
 if (!empty($recipe['title']) && !empty($recipe['description'])){
        addRecipe($recipe);
        header('Location: /');
    }
}

require __DIR__ . '/src/views/form.php';