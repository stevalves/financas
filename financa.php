<?php
session_start();
require_once("conexao.php");

$sql = "SELECT 
            t.id, 
            c.name AS category, 
            m.month, 
            m.year,
            t.type AS transaction, 
            t.value, 
            t.created_at 
        FROM transaction t
        INNER JOIN category c ON t.category_id = c.id
        INNER JOIN month m ON t.month_id = m.id";

$financas = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle - Finanças</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Controle de Finanças
                            <a href="financa-create.php" class="btn btn-primary float-end">Adicionar</a>
                            <a href="index.php" class="btn btn-danger float-end mx-2">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php include('mensagem.php'); ?>
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Id</th>
                                    <th>Categoria</th>
                                    <th>Mês</th>
                                    <th>Ano</th>
                                    <th>Valor</th>
                                    <th>Transação</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($financas as $financa): ?>
                                    <tr>
                                        <td><?php echo $financa['id']; ?></td>
                                        <td><?php echo $financa['category']; ?></td>
                                        <td><?php echo $financa['month']; ?></td>
                                        <td><?php echo $financa['year']; ?></td>
                                        <td><?php echo $financa['value']; ?></td>
                                        <td><?php echo $financa['transaction']; ?></td>
                                        <td>
                                            <a href="financa-edit.php?id=<?=$financa['id']?>" class="btn btn-secondary btn-sm"><i class="bi bi-pencil-fill"></i></a>
                                            <form action="acoes.php" method="POST" class="d-inline">
                                                <button onclick="return confirm('Tem certeza que deseja excluir?')" name="delete_financa" type="submit" value="<?=$financa['id']?>" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>