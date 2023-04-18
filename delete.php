<?php

session_start();
ob_start();

//Receber o id da URL
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//Verificar se o ID possui valor
if (!empty($id)) {
    //Incluir os arquivos
    require './Conn.php';
    require './Todo.php';

    //Instanciar a classe e criar o objeto
    $deleteTodo = new Todo();

    //Enviar o id para o atributo da classe User
    $deleteTodo->id = $id;

    //Instanciar o método apagar
    $value = $deleteTodo->delete();

    if ($value) {
        $_SESSION['msg'] = "<p style='color: white;'>To do apagado com sucesso!</p>";
        header("Location: index.php");
    } else {
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: To do não apagado com sucesso!</p>";
        header("Location: index.php");
    }
} else {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: To do não encontrado!</p>";
    header("Location: index.php");
}