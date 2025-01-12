<?php
session_start();
require 'conexao.php';
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro - Editar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style> 
        body {
            background-color: lightblue;
        }
    </style>
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar cadastro
                            <a href="cadastro.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            $usuario_id = intval($_GET['id']); 
                            $sql = "SELECT * FROM cadastro WHERE id = :id";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':id', $usuario_id, PDO::PARAM_INT);
                            $stmt->execute();

                            if ($stmt->rowCount() > 0) {
                                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <form action="acoes.php" method="POST">
                            <input type="hidden" name="usuario_id" value="<?=$usuario['id']?>">
                            <div class="mb-3">
                                <label>Descrição</label>
                                <input type="text" name="descrição" value="<?=$usuario['descrição']?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Quantidade</label>
                                <input type="text" name="quantidade" value="<?=$usuario['quantidade']?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Preço</label>
                                <input type="text" name="preço" value="<?=number_format($usuario['preço'], 2, ',', '.')?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="update_usuario" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                        <?php
                            } else {
                                echo "<h5>Usuário não encontrado</h5>";
                            }
                        } else {
                            echo "<h5>ID inválido</h5>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
