<?php

    //Variáveis necessáris para configurar nosso banco de dados.
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_nome = "fakebook";
    $conn = "";
    
    /*Função mysqli_connect, que serve para estabelecer
    a conexão com o bd. O try/ catch serve para evitar
    grandes textos de erro, caso a conexão não ocorra.*/
    try{
        $conn = mysqli_connect($db_server,
                                $db_user,
                                $db_pass,
                                $db_nome);
    }
    catch(mysqli_sql_exception){
        echo"Erro na conexão!";
    }
?>


