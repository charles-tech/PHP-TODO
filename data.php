<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
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

    <title>Data</title>
</head>

<body>

    <h1>Pesquisa por Data</h1><br>


    <form name="ListeTodo" method="POST" action="">
        <label>Data: </label>
        <input type="datetime-local" name="data" required /><br><br>



        <input type="submit" value="Pesquisar" name="SendData" />
    </form>



</body>

</html>