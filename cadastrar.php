<?php

require_once("./banco.php");
session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="stylelogin.css">
</head>
<body>
<div class="back" >
        <img src="login.jpg" alt="">
            <div class="div1"><br><br>        
            <center><h1>Cadastro</h1></center>
            <form action="" method="POST">          
            <input type="text" name='nome' id="nome" class="email" required placeholder="Nome completo"><br>
            <input type="email" name='email' id="email" class="email" required placeholder="Email"><br>
            <input type="password" name='senha' id="senha" class="senha" required placeholder="Senha">
            <button type="submit" class="botao">Cadastrar</button><br><br>

            </form>

            <?php

        if($_SERVER["REQUEST_METHOD"] == "POST"){

            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $senha = $_POST["senha"];

            try{
                // Prepara a query com placeholders
                $query = $pdo->prepare("INSERT INTO terapeutas (nome_terapeuta, email_terapeuta, senha_terapeuta) VALUES (:nome, :email, :senha)");
                
                // Executa a query passando os valores como um array associativo
                $query->execute(["nome" => $nome, "email" => $email, "senha" => $senha]);

                if($query){
                    echo "<center>Usuário Cadastrado!</center>";
                
                    echo "<a href='login.php'><button class='botao'>Logar</button></a>";
                }else{
                    echo "Erro ao cadastrar o usuário";
                }

            }catch(Exception $e){
                echo "Erro: " . $e->getMessage();
            }

        }

        ?>


    </div>
</div>

</body>
</html>

