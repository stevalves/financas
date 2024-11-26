<?php
session_start();
require_once('conexao.php');

$category = [];

if (!isset($_GET['id'])) {
    header('Location: index.php');
} else {
    $categoryId = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM category WHERE id = '{$categoryId}'";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $category = mysqli_fetch_array($query);
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar - Categoria</title>
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
                            Editar Categoria
                            <a href="category.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($category) :
                        ?>
                            <form action="acoes.php" method="POST">
                                <input type="hidden" name="category_id" value="<?= $category['id'] ?>">
                                <div class="mb-3">
                                    <label for="txtName">Categoria</label>
                                    <input type="text" name="txtName" id="txtName" value="<?= $category['name'] ?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="edit_category" class="btn btn-primary float-end">Salvar</button>
                                </div>
                            </form>
                        <?php
                        else:
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                Categoria não encontrada
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