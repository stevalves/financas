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