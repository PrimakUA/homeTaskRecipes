<?php
session_start();
require_once('Connection.php');

$connection = Connection::getInstance();
$allInDatabase = $connection->getAll();
$quantity = count($allInDatabase);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Recipes</title>
</head>

<body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<div class="container-left shadow-none p-3 mb-5 bg-light rounded">
    <div class="row">
        <div class="col">
            <h1>Recipes</h1>
        </div>
    </div>
</div>
<div class="container-left">
    <div class="row">
        <div class="col-2">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">My recipes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Ingredients</a>
                </li>
            </ul>
        </div>
        <div class="col-10 row">
            <div class="container">
                <div class="container shadow-none p-3 mb-5 rounded">
                    <div class="row">
                        <div class="col-md-3">
                            <h2>My recipes</h2>
                        </div>
                        <div class="col-md-2 ml-auto">
                            <a class="btn btn-outline-secondary" href="addNewRecipes.php" role="button">add recipes</a>
                        </div>
                    </div>
                </div>
                <div>
                    <?php
                    if (isset($_SESSION['success'])) {
                        echo '<p class="text-success">' . $_SESSION['success'] . '</p>';
                        unset($_SESSION['success']);
                    }
                    ?>
                </div>
                <table class="table table table-sm table-hover" width="80%" border="1">
                    <thead>
                    <tr>
                        <th scope="col" width="35%">Recipes</th>
                        <th scope="col" width="60%">Description</th>
                        <th scope="col" width="5%">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    for ($i = 0; $i < $quantity; $i++) {
                        $row = $allInDatabase["$i"];
                        echo '<tr>
                                <td>' . $row['name'] . '</td>
                                <td>' . $row['description'] . '</td>
                                <td>
                                <a href="view.php?id=' . $row['id'] . '">V</a>
                                <a href="addNewRecipes.php?id=' . $row['id'] . '">E</a>
                                <a href="#" onclick="if(window.confirm(\'Are you sure you want to delete the recipe?\')) { window.location = \'deleteRecipe.php?id='. $row['id'] . '\'; } return false;">D</a>
                            </td>
                        </tr>';
                    }
                    ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
</body>
</html>