<?php
require_once("banco.php");
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="stylelogin.css">
</head>
<body>
    <div class="back">
        <img src="login.jpg" alt="">
        <div class="div1">
            <h1 class="login">Login</h1>
            <form action="" method="POST">
                <input type="email" name="email" class="email" id="email" required placeholder="Email">
                <input type="password" name="senha" class="senha" id="senha" required placeholder="Senha"><br>
                <button type='submit' class="botao">Entrar</button>
                <a href="cadastrar.php"><input type="button" value="Cadastrar" class="botao"></a>
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST["email"] ?? '';
                $senha = $_POST["senha"] ?? '';

                if (!empty($email) && !empty($senha)) {
                    try {
                        $query = $pdo->prepare("SELECT * FROM terapeutas WHERE email_terapeuta = :email AND senha_terapeuta = :senha");
                        $query->execute(["email" => $email, "senha" => $senha]);

                        if ($query->rowCount() > 0) {
                            $_SESSION["email_terapeuta"] = $email;  
                            header("Location: user.php");
                            exit();
                        } else {
                            echo "Usuário ou senha inválidos.";
                            echo "<a href='cadastrar.php'>Cadastrar</a>";
                        }
                    } catch (Exception $e) {
                        echo "Erro: " . $e->getMessage();
                    }
                } else {
                    echo "Por favor, preencha todos os campos.";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
