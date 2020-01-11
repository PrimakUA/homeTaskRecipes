<?php
session_start();
require_once('Connection.php');

$connection = Connection::getInstance();
$table = 'ingredients';
$id = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $getOne = $connection->getItem($table, $id);
    $getItem = $getOne[0];
    $name = $getItem['name'];
} else {
    $name = '';
}
if (isset($_POST['nameingredient'])) $name = $_POST['nameingredient'];

if (isset($_POST['send'])) {

    if ($_POST['send'] != 0) {
        $id = $_POST['send'];
        $edit = $connection->edit("UPDATE `$table` SET `name`='$name' WHERE `id`='$id'");
        if ($edit == true) {
            $_SESSION['success'] = "$name" . " Successfully edited";
            Header('Location: ingredients.php');
            exit;
        }
    } else {
        $save = $connection->save("INSERT INTO `$table` (`name`) VALUE ('$name')");
        if ($save == true) {
            $_SESSION['success'] = "$name" . " Successfully save";
            Header('Location: ingredients.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Add ingredient</title>
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
                    <a class="nav-link" href="ingredients.php">Ingredients</a>
                </li>
            </ul>
        </div>
        <div class="col-10 row">
            <div class="container">
                <h1>Add ingredient</h1>

                <form method="post" action="addNewingredient.php">
                    <input type="hidden" name="send" value="<?php echo $id; ?>">
                    <div class="form-group row">
                        <label for="nameRecipes" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Name ingredient" name="nameingredient"
                                   value="<?php echo $name; ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>