<?php
session_start();
require_once('conexao.php');

$financa = [];

if (!isset($_GET['id'])) {
    header('Location: index.php');
} else {
    $financaId = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT 
            t.id,
            t.description,
            c.name AS category, 
            t.category_id as tid,
            m.id as month_id,
            m.month, 
            m.year,
            t.created_at as date,
            t.type AS transaction, 
            t.value, 
            t.created_at 
        FROM transaction t
        INNER JOIN category c ON t.category_id = c.id
        INNER JOIN month m ON t.month_id = m.id  WHERE t.id = '{$financaId}'";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $financa = mysqli_fetch_array($query);
    }

    $sql_categories = "SELECT * FROM category";
    $categories = mysqli_query($conn, $sql_categories);
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar - Finanças</title>
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
                            Editar Finanças <i class="bi bi-person-fill-gear"></i>
                            <a href="financa.php?id=<?php echo $financa['month_id'] ?>" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($financa) :
                        ?>
                            <form action="acoes.php" method="POST">
                                <input type="hidden" name="financa_id" value="<?= $financa['id'] ?>">
                                <input type="hidden" name="month_id" value="<?= $financa['month_id'] ?>">
                                <label for="txtCategory">Categoria</label>

                                <select name="txtCategory" id="txtCategory" class="form-select">
                                    <?php foreach ($categories as $category): ?>
                                        <option <?php echo $financa['tid'] == $category['id'] ? "selected" : "" ?> value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="mb-3">
                                    <label for="txtDate">Data</label>
                                    <input type="date" name="txtDate" id="txtDate" value="<?= $financa['date'] ?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="txtValue">Valor</label>
                                    <input type="text" name="txtValue" id="txtValue" value="<?= $financa['value'] ?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="txtDescription">Descrição</label>
                                    <input type="text" name="txtDescription" id="txtDescription" value="<?= $financa['description'] ?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="txtTransaction">Transação</label>
                                    <select name="txtTransaction" id="txtTransaction" class="form-select">
                                        <option value="Entrada" <?= $financa['transaction'] == 'Entrada' ? 'selected' : "" ?>>Entrada</option>
                                        <option value="Saída" <?= $financa['transaction'] == 'Saída' ? 'selected' : "" ?>>Saída</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="edit_financa" class="btn btn-primary float-end">Salvar</button>
                                </div>
                            </form>
                        <?php
                        else:
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                Finança não encontrada
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>