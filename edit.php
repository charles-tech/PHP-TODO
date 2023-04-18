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
    <title>To do - Editar</title>
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


    <h1>Editar o To do</h1>

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    //Incluir os arquivos
    require './Conn.php';
    require './Todo.php';

    //Receber os dados do formulario
    $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    //Verificar se o usuario clicou no botao
    if (!empty($formData['SendTodo'])) {
        //var_dump($formData);
        $editTodo = new Todo();
        $editTodo->formData = $formData;
        $value = $editTodo->edit();
        if($value){
            $_SESSION['msg'] = "<p style='color: white;'>To do editado com sucesso!</p><br>";
            header("Location: index.php");
        }else{
            echo "<p style='color: #f00;'>Erro: To do não editado com sucesso!</p>";
        }
    }

    //Verificar se o id possui valor
    if (!empty($id)) {
        

        //Instanciar a classe e criar o objeto
        $viewTodo = new Todo();

        //Enviando o id para o atributo id da classe User
        $viewTodo->id = $id;

        //Instanciando o metodo visualizar
        $valueTodo = $viewTodo->view();

        //var_dump($valueUser);
        extract($valueTodo);

    ?>
    <form name="EditTodo" method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>" />

        <label>Data: </label>
        <input type="datetime-local" name="data" required /><br><br>

        <label>Tarefa </label>
        <input type="text" name="tarefa" placeholder="Escreca a sua Tarefa" required /><br><br>



        <label for="cars">Status:</label>

        <select name="status" id="status">
            <option value="Feito">Feito</option>
            <option value="Aguardando">Aguardando</option>
        </select>


        <br><br>


        <input type="submit" value="Cadastrar" name="SendTodo" />
    </form>
    <?php


    } else {
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: To do não encontrado!</p>";
        header("Location: index.php");
    }
    ?>

</body>

</html>