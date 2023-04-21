<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <title>Create To-Do</title>
</head>
<header>
    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Organizador de Tarefas To Do</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">To Do</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Listar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="data.php">Pesquisar</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="create.php">Cadastrar</a>
                        </li>



                    </ul>

                </div>
            </div>
        </div>
    </nav>
</header>
<br><br><br><br><br><br>

<body>


    <br>

    <?php

require './Conn.php';
require './Todo.php';
$formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);    

if(!empty($formData['SendTodo'])){

    $createTodo = new Todo();
        $createTodo->formData = $formData;
        $value = $createTodo->create();

        if($value){
            $_SESSION['msg'] = "<p style='color: white;'>To-do cadastrado com sucesso!</p><br>";
            header("Location: index.php");
        }else{
            echo "<p style='color: #f00;'>Erro: To-do não cadastrado com sucesso!</p>";
        }

}



    ?>

    <div class="container">
        <h1>Cadastrar To-Do</h1><br>




        <form name="CreateTodo" method="POST" action="">
            <label>Data: </label>
            <input class=" form-control" type="datetime-local" name="data" required /><br><br>

            <label>Tarefa </label>
            <input class=" form-control" type="text" name="tarefa" placeholder="Escreva a sua Tarefa"
                required /><br><br>

            <input type="submit" value="Cadastrar" name="SendTodo" />
        </form>
    </div>
</body>

</html>