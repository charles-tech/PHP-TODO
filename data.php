<?php
session_start();
ini_set("display_errors", 1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <title>To Do</title>
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



    <br><br>



    <?php
    require './Conn.php';
    require './Todo.php';

    $listarstatus = new Todo();
    $result_status =$listarstatus->listStatus();

   


    ?>

    <div class="container">
        <h1>Listar To-do</h1><BR></BR>


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Data</th>
                    <th scope="col">Tarefa</th>
                    <th scope="col">Status</th>
                    <th scope="col">Botão</th>


                </tr>
            </thead>
            <tbody class="table-group-divider">


                <?php

    foreach($result_status as $row_status){

        extract($row_status);
        $dataBr = "Data: " .date('d/m/Y H:i:s', strtotime($data)) . " <br>";

      


        echo "
        <tr>
        <th scope='row'>{$id}</th>
        <td>{$dataBr}</td>
        <td>{$tarefa}</td>
        <td>{$status}</td>
        <td>
        
        <a href='view.php?id=$id' type='button' class='btn btn-outline-primary'>Visualizar</a>
        <a href='edit.php?id=$id' type='button' class='btn btn-outline-success'>Editar</a>
        <a href='delete1.php?id=$id' type='button' class='btn btn-outline-danger'>Deletar</button>
    </td>
    </tr>
        ";
        
    }
    ?>
            </tbody>
        </table>



    </div>



</body>

</html>