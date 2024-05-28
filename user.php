<?php 

require("./banco.php");
session_start();

if (!isset($_SESSION["email_terapeuta"]) || $_SESSION["email_terapeuta"] == null) {
    header("Location: login.php");
    exit();
}

$query = $pdo->prepare("SELECT * FROM terapeutas WHERE email_terapeuta = :email");
$query->execute(["email" => $_SESSION["email_terapeuta"]]);

$row = $query->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Plano</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3 class="mb-4">Cadastrar Plano</h3>
            <form action="" method="GET">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" value="<?php echo htmlspecialchars($row['nome_terapeuta']); ?>" required readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($row['email_terapeuta']); ?>" required readonly>
                </div>
                <div class="form-group">
                    <label for="planos">Plano:</label><br>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="planoStandard" name="planos" value="Standard" required>
                        <label class="form-check-label" for="Standard">Standard</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="planoPremium" name="planos" value="Premium">
                        <label class="form-check-label" for="Premium">Premium</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Assinar</button>
                <br>
                <a href="logout.php" class="mt-2">SAIR</a>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php 

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET["planos"])) {
    $plano = $_GET["planos"];
    
    try {
        $query = $pdo->prepare("UPDATE terapeutas SET id_plano = (SELECT id_plano FROM planos WHERE tipo_plano = :plano) WHERE email_terapeuta = :email");
        $query->execute(["plano" => $plano, "email" => $_SESSION["email_terapeuta"]]);

        if ($query) {
            echo "<div class='container mt-3'><div class='alert alert-success'>Plano atualizado com sucesso!</div></div>";
        } else {
            echo "<div class='container mt-3'><div class='alert alert-danger'>Erro ao atualizar o plano.</div></div>";
        }
    } catch (Exception $e) {
        echo "<div class='container mt-3'><div class='alert alert-danger'>Erro: " . $e->getMessage() . "</div></div>";
    }
}

?>

