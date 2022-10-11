<?php 

function createConnection(): PDO
{
    return new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USER, PASSWORD);
}

// Fetching all recipes from database - assuming the database is okay
function getAllRecipes(): array
{
    $connection = createConnection();

    $statement = $connection->query('SELECT id, title FROM recipe');
    $recipes = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $recipes;
}

// Fetching a recipe
function getRecipeById(int $id): array
{
    $connection = createConnection();

    $query = 'SELECT title, description FROM recipe WHERE id=:id';
    $statement = $connection->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $recipe = $statement->fetch(PDO::FETCH_ASSOC);

    return $recipe;
}

//Add a recipe
function addRecipe(array $recipe):void
 {
    $title = $recipe['title'];
    $description = $recipe['description'];
    $connection = createConnection();
    $query = "INSERT INTO recipe (title, description ) VALUES (:title, :description)";
    $statement=$connection->prepare($query);
    $statement->bindValue(':title', $title, PDO::PARAM_STR);
    $statement->bindValue(':description', $description, PDO::PARAM_STR);
    $statement->execute();
 }