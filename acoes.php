<?php
session_start();
require 'conexao.php';


function sanitizeInput($data) {
    return htmlspecialchars(trim($data));
}

// Criar item
if (isset($_POST['create_usuario'])) {
    $descrição = sanitizeInput($_POST['descrição']);
    $quantidade = intval($_POST['quantidade']);
    $preço = floatval(str_replace(',', '.', str_replace('.', '', $_POST['preço'])));

    if (empty($descrição) || $quantidade <= 0 || $preço <= 0) {
        $_SESSION['mensagem'] = 'Preencha todos os campos corretamente!';
        header('Location: cadastro.php');
        exit;
    }

    $sql = "INSERT INTO cadastro (descrição, quantidade, preço) VALUES (:descricao, :quantidade, :preco)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':descricao', $descrição);
    $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
    $stmt->bindParam(':preco', $preço);

    if ($stmt->execute()) {
        $_SESSION['mensagem'] = 'Item cadastrado com sucesso';
    } else {
        $_SESSION['mensagem'] = 'Erro ao cadastrar item: ' . implode(' ', $stmt->errorInfo());
    }

    
    if (headers_sent()) {
        echo 'Cabeçalhos já enviados!';
        exit;
    }

    header('Location: cadastro.php');
    exit;
}

// Atualizar item
if (isset($_POST['update_usuario'])) {
    $usuario_id = intval($_POST['usuario_id']);
    $descrição = sanitizeInput($_POST['descrição']);
    $quantidade = intval($_POST['quantidade']);
    $preço = floatval(str_replace(',', '.', str_replace('.', '', $_POST['preço'])));

  

    if (empty($descrição) || $quantidade <= 0 || $preço <= 0) {
        $_SESSION['mensagem'] = 'Preencha todos os campos corretamente!';
        header('Location: cadastro-edit.php?id=' . $usuario_id);
        exit;
    }

    $sql = "UPDATE cadastro SET descrição = :descricao, quantidade = :quantidade, preço = :preco WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':descricao', $descrição);
    $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
    $stmt->bindParam(':preco', $preço);
    $stmt->bindParam(':id', $usuario_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['mensagem'] = 'Item atualizado com sucesso';
    } else {
        $_SESSION['mensagem'] = 'Erro ao atualizar item: ' . implode(' ', $stmt->errorInfo());
    }

    
    if (headers_sent()) {
        echo 'Cabeçalhos já enviados!';
        exit;
    }

    header('Location: cadastro.php');
    exit;
}

// Deletar item
if (isset($_POST['delete_usuario'])) {
    $usuario_id = intval($_POST['delete_usuario']);

    $sql = "UPDATE cadastro SET ativo = 0 WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $usuario_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['mensagem'] = 'Item deletado com sucesso';
    } else {
        $_SESSION['mensagem'] = 'Erro ao deletar item: ' . implode(' ', $stmt->errorInfo());
    }

    
    if (headers_sent()) {
        echo 'Cabeçalhos já enviados!';
        exit;
    }

    header('Location: cadastro.php');
    exit;
}
?>

