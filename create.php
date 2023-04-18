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

    <title>Create To-Do</title>
</head>
<header>
    <nav class="navbar">

        <div class="max-width">
            <div class="logo">
                <a href="index.html">To-do</a>
            </div>
            <ul class="menu" id="menu-site">
                <a class="menu" href="index.php">| Listar |</a>
                <a class="menu" href="data.php">| Pesquisa por Data | </a>
                <a class="menu" href="status.php">| Pesquisa por Status |</a>
                <a class="menu" href="create.php">| Cadastrar |</a>
            </ul>
            <div class="menu-btn" id="menu-btn">
                <i class="fa-solid fa-bars" id="menu-icon"></i>
            </div>
    </nav>
</header>
<br><br><br><br><br><br>

<body>


    <h1>Cadastrar To-Do</h1>
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

    <form name="CreateTodo" method="POST" action="">
        <label>Data: </label>
        <input class="calendario" type="datetime-local" name="data" required /><br><br>

        <label>Tarefa </label>
        <input class="entrada" type="text" name="tarefa" placeholder="Escreca a sua Tarefa" required /><br><br>

        <input type="submit" value="Cadastrar" name="SendTodo" />
    </form>
</body>

</html>