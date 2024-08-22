<?php
    include("database.php");

    //Funçaõ que permitirá o armazenamento e o transporte de dados entre páginas.
    session_start();
?>

<?php

    //Variável do tipo boolean, que possibilitará a troca entre os botões login e logout.
    $mostrarBotao = false;

    //Condicional que confere se a $_SESSION da sessão foi preenchida.
    if(isset($_SESSION["usuario_session"])){
        
        //Se tudo ocorrer bem nossa variável boolean é ativada.
        $mostrarBotao = true;
        
        //E alguns textos, contendo também os dados registrados na sessão, são imprimidos na tela.
        echo "Bem vindo(a), " . $_SESSION["usuario_session"] . "!<br>",
        "Aqui está seu e-mail: " . $_SESSION["email_session"] . "<br>",
        "e aqui está a data do seu ingresso na nossa rede: " . $_SESSION["data_reg_session"];
    }
    else{
        echo"Você não está logado.";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fakebook Home Page</title>
</head>
<body>
    
<!-- Trecho de código PHP que confere o estado da variável boolean definida anteriormente. -->
    <?php if($mostrarBotao == true): ?>
        
        <!-- Caso o valor seja true, imprimimos
         o form (com o auto endereçamento e filtro
         de caracteres) mostrando o botão logout -->
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
    
        <?php else: ?>
            
            <!-- Caso o valor seja false, imprimimos
            o form mostrando o botão login -->
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                <button type="submit" name="login">Login</button>
            </form>
    
    <?php endif; ?>

</body>
</html>

<?php
    
    //Condicional que observa o POST do botão da página.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        //Caso ativado, a sessão é esvaziada e destruida.
        session_unset();
        session_destroy();
        
        //E o usuário redirecionado para a página de login.
        echo"Você será redirecionado em alguns insantes.
            <script>
                setTimeout(function(){
                window.location.href = 'login.php';
                }, 2400);
            </script>";
    }

    mysqli_close($conn);
?>