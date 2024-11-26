<?php
session_start();
require_once('conexao.php');
$monthId = mysqli_real_escape_string($conn, $_GET['month_id']);

$sql = "SELECT * FROM category";
$categories = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar - Finança</title>
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
                            Adicionar Finança</i>
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="acoes.php" method="POST">
                            <input type="hidden" name="month_id" value="<?= $monthId ?>">
                            <div class="mb-3">
                                <label for="txtCategory">Categoria</label>
                                <select name="txtCategory" id="txtCategory" class="form-select">
                                    <option selected disabled>Selecione uma categoria</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="txtDate">Data</label>
                                <input type="date" name="txtDate" id="txtDate" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="txtDescription">Descrição</label>
                                <input type="text" name="txtDescription" id="txtDescription" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="txtValue">Valor</label>
                                <input type="number" name="txtValue" id="txtValue" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="txtTransaction">Transação</label>
                                <select name="txtTransaction" id="txtTransaction" class="form-select">
                                    <option>Entrada</option>
                                    <option>Saída</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="create_financa" class="btn btn-primary float-end">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>