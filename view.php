<?php
session_start();

ob_start();

//Receber o id do usuario
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
?>
<!DOCTYPE html>
<html lang="pt-br">
<link rel="stylesheet" href="estilos.css">


<head>
    <meta charset="UTF-8">
    <title>Celke - Visualizar</title>
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



    <h1>Detalhes do Usuário</h1>

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    //Verificar se o id possui valor
    if (!empty($id)) {
        //Incluir os arquivos
        require './Conn.php';
        require './Todo.php';

        //Instanciar a classe e criar o objeto
        $viewTodo = new Todo();
        
        //Enviando o id para o atributo id da classe User
        $viewTodo->id = $id;

        //Instanciando o metodo visualizar
        $valueTodo = $viewTodo->view();
        
        //var_dump($valueUser);
        extract($valueTodo);
        echo "Id do usuário: $id <br>";
        echo "Data: " . date('d/m/Y H:i:s', strtotime($data)) . " <br>";
        echo "Tarefa: $tarefa <br>";
        echo "Cadastrado: " . date('d/m/Y H:i:s', strtotime($created)) . " <br>";

       ;

    } else {
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
        header("Location: index.php");
    }



    ?>

</body>

</html>