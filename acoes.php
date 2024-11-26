<?php
session_start();
require_once('conexao.php');

if (isset($_POST['create_month'])) {
    $year = trim($_POST['txtYear']);
    $month = trim($_POST['txtMonth']);

    $sql = "INSERT INTO month (year, month) VALUES('$year', '$month')";

    mysqli_query($conn, $sql);

    header('Location: index.php');
    exit();
}

if (isset($_POST['delete_month'])) {
    $monthId = mysqli_real_escape_string($conn, $_POST['delete_month']);
    $sql = "DELETE FROM month WHERE id = '$monthId'";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Mês com ID {$monthId} excluído com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Ops! Não foi possível excluir o mês";
        $_SESSION['type'] = 'error';
    }

    header('Location: index.php');
    exit;
}

if (isset($_POST['create_category'])) {
    $year = trim($_POST['txtName']);

    $sql = "INSERT INTO category (name) VALUES('$name')";

    mysqli_query($conn, $sql);

    header('Location: category.php');
    exit();
}

if (isset($_POST['delete_category'])) {
    $categoryId = mysqli_real_escape_string($conn, $_POST['delete_category']);
    $sql = "DELETE FROM category WHERE id = '$categoryId'";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Categoria com ID {$categoryId} excluída com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Ops! Não foi possível excluir a categoria";
        $_SESSION['type'] = 'error';
    }

    header('Location: index.php');
    exit;
}

if (isset($_POST['edit_month'])) {
    $monthId = mysqli_real_escape_string($conn, $_POST['month_id']);
    $year = mysqli_real_escape_string($conn, $_POST['txtYear']);
    $month = mysqli_real_escape_string($conn, $_POST['txtMonth']);

    $sql = "UPDATE month SET year = '{$year}', month = '{$month}' WHERE id = '{$monthId}'";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Mês {$monthId} atualizado com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Não foi possível atualizar o mês {$monthId}";
        $_SESSION['type'] = 'error';
    }

    header("Location: index.php");
    exit;
}

if (isset($_POST['create_financa'])) {
    $monthId = trim($_POST['month_id']);
    $category = trim($_POST['txtCategory']);
    $year = trim($_POST['txtYear']);
    $value = trim($_POST['txtValue']);
    $transaction = trim($_POST['txtTransaction']);

    $sql = "INSERT INTO transaction (type, value, created_at, month_id, category_id) VALUES('$transaction', '$value', '$year', '$monthId', '1')";

    mysqli_query($conn, $sql);

    header("Location: financa.php?id=$monthId");
    exit();
}

if (isset($_POST['edit_financa'])) {
    $financaId = mysqli_real_escape_string($conn, $_POST['financa_id']);
    $category = mysqli_real_escape_string($conn, $_POST['txtCategory']);
    $month = mysqli_real_escape_string($conn, $_POST['txtMonth']);
    $year = mysqli_real_escape_string($conn, $_POST['txtYear']);
    $value = mysqli_real_escape_string($conn, $_POST['txtValue']);
    $transaction = mysqli_real_escape_string($conn, $_POST['txtTransaction']);

    // arrumar update com outra tabela
    $sql = "UPDATE financa SET category = '{$category}', month = '{$month}', year = '{$year}', value = '{$value}', transaction = '{$transaction}' WHERE id = '{$financaId}'";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Finança {$financaId} atualizada com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Não foi possível atualizar a finança {$financaId}";
        $_SESSION['type'] = 'error';
    }

    header("Location: index.php");
    exit;
}

if (isset($_POST['edit_category'])) {
    $categoryId = mysqli_real_escape_string($conn, $_POST['category_id']);
    $name = mysqli_real_escape_string($conn, $_POST['txtName']);

    $sql = "UPDATE category SET name = '{$name}' WHERE id = '{$categoryId}'";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Categoria {$categoryId} atualizada com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Não foi possível atualizar a categoria {$categoryId}";
        $_SESSION['type'] = 'error';
    }

    header("Location: index.php");
    exit;
}

if (isset($_POST['delete_financa'])) {
    $financaId = mysqli_real_escape_string($conn, $_POST['delete_financa']);
    $monthId = mysqli_real_escape_string($conn, $_POST['monthId']);
    $sql = "DELETE FROM transaction WHERE id = '$financaId'";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Finança com ID {$financaId} excluída com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Ops! Não foi possível excluir a finança";
        $_SESSION['type'] = 'error';
    }

    header("Location: financa.php?id=$monthId");
    exit;
}
