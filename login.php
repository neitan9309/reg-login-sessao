<?php
    include("database.php");
    
    //Funçaõ que permitirá o armazenamento e o transporte de dados entre páginas.
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça seu login no Fakebook!</title>
</head>
<body>

    <!-- Formulário simples com uma auto referência ("PHP_SELF") protegida por um filtro de caracteres. -->
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <h2>Faça seu login no Fakebook!</h2>
        email:<br>
        <input type="email" name="email"><br>
        senha:<br>
        <input type="password" name="senha"><br>
        <a href="index.php">registre-se</a>
        <input type="submit" name="login" value="login">
    </form>    

</body>
</html>
<?php

    //Condição if que observa a ação POST do formulário.
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        //Variáveis que recebem os dados inseridos no formulário. Um filtro básico para evitar injeções foi adicionado.
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_SPECIAL_CHARS);

        //Comando SQL, serve para resgatar os dados principais e os adicionais criados no momento do registro do usuário.
        $sql_login = "SELECT id, usuario, senha, data_reg FROM usuarios WHERE email = '$email'";
        $resultado = mysqli_query($conn, $sql_login);

        //Algumas condições aninhadas para evitar que o script seja concluído com algum campo vazio.
        if(empty($email)){
            echo"Por favor, insira um email." . "<br>";
        }
        elseif(empty($senha)){
            echo"Por favor, insira uma senha." . "<br>";
        }
        elseif((mysqli_num_rows($resultado)) > 0){
            
            //Try/ catch para evitar textos longos de erro na tela do cliente.
            try{

                /*Variável com a função mysqli_fetch_assoc
                (e a variável que contém a array com os dados
                do banco), iniciamos a comunicação com o servidor.*/
                $linha = mysqli_fetch_assoc($resultado);
                
                //Condicional que roda a função responsável por comparar a senha inserida com a senha encriptada.
                if(password_verify($senha, $linha['senha'])){
                    
                    /*A $_SESSION guarda dados e nos permite usá-los
                    em outras páginas. Ela ajudará a transportar os
                    dados que nos interessam para a página home.php*/
                    $_SESSION["usuario_session"] = $linha["usuario"];
                    $_SESSION["email_session"] = $email;
                    $_SESSION["data_reg_session"] = $linha["data_reg"];
                    
                    //Script que redireciona o usuário à proxima página. O timer foi adicionado por pura curiosidade.
                    echo"Login concluído! Você será redirecionado em alguns instantes...
                        <script>
                        setTimeout(function(){
                        window.location.href = 'home.php';
                        }, 2400);
                        </script>";
                }
                else{
                    echo"Senha inválida.";
                }
            }
            catch(mysqli_sql_exception){
                echo"Erro na conexão.";
            }
        }
        else{
            echo"Email inválido.";
        }
    }

    mysqli_close($conn);
?>