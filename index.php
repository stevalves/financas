<?php
session_start();
require_once("conexao.php");

$sql = "SELECT * FROM month";
$meses = mysqli_query($conn, $sql);

$sql_amount_meses = "SELECT 
                        m.id AS monthId,
                        COALESCE(SUM(CASE WHEN t.type = 'Entrada' THEN t.value ELSE 0 END), 0) 
                        - COALESCE(SUM(CASE WHEN t.type = 'Saída' THEN t.value ELSE 0 END), 0) AS amount
                    FROM month m
                    INNER JOIN transaction t ON t.month_id = m.id
                    GROUP BY m.id;";

$amount_meses = mysqli_query($conn, $sql_amount_meses);

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle - Finanças</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="globalStyles.css">
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Controle de Finanças
                            <a href="create_month.php" class="btn btn-primary float-end">Adicionar Mês</a>
                            <a href="category.php" class="btn btn-primary float-end mx-4">Categorias</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php include('mensagem.php'); ?>
                        <div class="container">
                            <div class="row">
                                <?php
                                $counter = 0;
                                foreach ($meses as $mes):
                                    if ($counter % 3 == 0 && $counter != 0) {
                                        echo '</div><div class="row">';
                                    }
                                ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="border border-dark p-3 rounded">
                                            <div class="d-flex justify-content-between w-100">
                                                <h4>
                                                    <?php echo $mes['year']; ?>
                                                </h4>
                                                <a href="financa.php?id=<?= $mes['id'] ?>" class="btn btn-light">
                                                    <i class="bi bi-box-arrow-up-right h4"></i>
                                                </a>
                                            </div>
                                            <h6>
                                                <?php echo $mes['month']; ?>
                                            </h6>
                                            <div class="d-flex d-grid justify-content-between align-items-center">
                                                <?php foreach ($amount_meses as $amount):
                                                    if ($amount['monthId'] == $mes['id']) {
                                                        if ($amount['amount'] > 0) {
                                                            echo "<h5 class='text-success' style='height: fit-content; margin: 0;'>R$ " . number_format($amount['amount'], 2) . "</h5>";
                                                        } else if ($amount['amount'] < 0) {
                                                            echo "<h5 class='text-danger' style='height: fit-content; margin: 0;'>R$ " . number_format($amount['amount'], 2) . "</h5>";
                                                        } else {
                                                            echo "<h5 class='text-warning' style='height: fit-content; margin: 0;'>R$ 0.00</h5>";
                                                        }
                                                    }
                                                endforeach ?>
                                                <p></p>
                                                <div class="g-2">
                                                    <a href="edit_month.php?id=<?= $mes['id'] ?>" class="btn btn-secondary btn-sm"><i class="bi bi-pencil-fill"></i></a>
                                                    <form action="acoes.php" method="POST" class="d-inline">
                                                        <button onclick="return confirm('Tem certeza que deseja excluir?')" name="delete_month" type="submit" value="<?= $mes['id'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $counter++;
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>