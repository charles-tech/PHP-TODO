<?php
session_start();

ob_start();

//Receber o id do usuario
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
?>
<!DOCTYPE html>
<html lang="pt-br">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>


<head>
    <meta charset="UTF-8">
    <title>To do - Editar</title>
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
                    <form class="d-flex mt-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</header>
<br><br><br><br><br><br>

<body>



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

       //var_dump($valueTodo);
      // extract($valueTodo);
        
    ?>
    <div class="container">
        <h1>Editar o To do</h1><br>


        <form name="EditTodo" method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />




            <label>Data: </label>
            <input type="datetime-local" name="data" required /><br><br>

            <?php
        $tarefa = "";
        if (isset($valueTodo['tarefa'])) {
            $tarefa = $valueTodo['tarefa'];
        }
        ?>

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
    </div>

</body>

</html>