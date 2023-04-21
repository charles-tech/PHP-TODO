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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <title>Celke - Visualizar</title>
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