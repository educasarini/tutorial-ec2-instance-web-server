<?php
// Configurações do Banco de Dados
$host = 'tutorial-db-instance.cxcwoc40i59h.us-east-1.rds.amazonaws.com';
$user = 'tutorial_user';
$pass = 'EAC04052007eac';
$db   = 'inventario';

// Conexão
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Lógica de Inserção (Create)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $qtd = (int)$_POST['quantidade'];
    $preco = (float)$_POST['preco'];

    $stmt = $conn->prepare("INSERT INTO produtos (nome, quantidade, preco) VALUES (?, ?, ?)");
    $stmt->bind_param("sid", $nome, $qtd, $preco);
    $stmt->execute();
    $stmt->close();
    
    // Evita reenvio de formulário ao atualizar a página
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventário Integrado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; padding-top: 2rem; }
        .card { box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: none; }
        .header-title { color: #2c3e50; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center header-title mb-4">Gerenciamento de Inventário (EC2 + RDS)</h2>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card p-4 mb-4">
                <h4>Adicionar Produto</h4>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">Nome do Produto</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantidade</label>
                        <input type="number" name="quantidade" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Preço (R$)</label>
                        <input type="number" step="0.01" name="preco" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card p-4">
                <h4>Produtos Cadastrados</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-hover mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Qtd</th>
                                <th>Preço</th>
                                <th>Data Cadastro</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Lógica de Listagem (Read)
                            $sql = "SELECT id, nome, quantidade, preco, data_cadastro FROM produtos ORDER BY id DESC";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>" . $row["id"] . "</td>
                                            <td>" . htmlspecialchars($row["nome"]) . "</td>
                                            <td>" . $row["quantidade"] . "</td>
                                            <td>R$ " . number_format($row["preco"], 2, ',', '.') . "</td>
                                            <td>" . date('d/m/Y H:i', strtotime($row["data_cadastro"])) . "</td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>Nenhum produto cadastrado.</td></tr>";
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>