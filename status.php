<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">

    <title>Pesquisa Status</title>
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

    <h1>Pesquisa por Status</h1><br>


    <form name="ListeTodo" method="POST" action="">
        <label>Data: </label>
        <select name="status" id="status">
            <option value="Feito">Feito</option>
            <option value="Aguardando">Aguardando</option>
        </select>
        <input type="submit" value="Pesquisar" name="SendData" />

    </form>
    <br><br>
    <?php


       
    require './Conn.php';
    require './Todo.php';

    $listtodos = new Todo();
    $listtodos->status =$status;
    $result_todos = $listtodos->listStatus();

    foreach($result_todos as $row_todo){
        extract($row_todo);
        echo "Data:" .date('d/m/Y H:i:s', strtotime($data)) . " <br>";
        echo "Tarefa: $tarefa <br>";
        echo "Status: $status <br>";
        echo "<hr>";


        echo "<a href='view.php?id=$id'>Visualizar</a><br>";
        echo "<a href='edit.php?id=$id'>Editar</a><br>";
        echo "<a href='delete.php?id=$id'>Apagar</a><br>";
        echo "<hr>";
    }


    ?>


</body>

</html>