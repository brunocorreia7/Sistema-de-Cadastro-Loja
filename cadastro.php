<?php
session_start();
require 'conexao.php'; 
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Loja SB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style> 
        body {
            background-color: lightblue;
        }
    </style>
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container mt-4">
        <?php include('mensagem.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Loja SB
                            <a href="cadastro-create.php" class="btn btn-primary float-end">Cadastrar Item</a>
                        </h4>
                    </div>
                    <form method="GET" class="d-flex mt-3" style="width: 400px; margin-left: 20px;">
                        <input class="form-control me-2" type="search" name="search" placeholder="Pesquisar" aria-label="Search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        <button class="btn btn-outline-primary" type="submit">Buscar</button>
                    </form>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Descrição</th>
                                    <th>Quantidade</th>
                                    <th>Preço</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $search = isset($_GET['search']) ? trim($_GET['search']) : null;

                                // Verifica se a pesquisa foi feita
                                if ($search !== null) {
                                    try {
                                        if ($search === '') {
                                            // Exibe todos os registros
                                            $sql = "SELECT * FROM cadastro WHERE ativo = 1";
                                            $stmt = $pdo->query($sql);
                                        } else {
                                            // Pesquisa com base no termo informado
                                            $sql = "SELECT * FROM cadastro WHERE ativo = 1 AND descrição LIKE :search";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
                                            $stmt->execute();
                                        }

                                        
                                        if ($stmt->rowCount() > 0) {
                                            while ($usuario = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($usuario['id']) ?></td>
                                    <td><?= htmlspecialchars($usuario['descrição']) ?></td>
                                    <td><?= htmlspecialchars($usuario['quantidade']) ?></td>
                                    <td><?= number_format($usuario['preço'], 2, ',', '.') ?></td>
                                    <td>
                                        <!-- Botão para abrir o modal -->
                                        <a href="#" 
                                           data-bs-toggle="modal" 
                                           data-bs-target="#VizualizarModal<?= $usuario['id'] ?>" 
                                           class="btn btn-secondary btn-sm">
                                            <span class="bi-eye-fill"></span>&nbsp;Visualizar
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" 
                                             id="VizualizarModal<?= $usuario['id'] ?>" 
                                             tabindex="-1" 
                                             aria-labelledby="ModalLabel<?= $usuario['id'] ?>" 
                                             aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="ModalLabel<?= $usuario['id'] ?>">Visualizar</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label>Descrição</label>
                                                            <p class="form-control"><?= htmlspecialchars($usuario['descrição']) ?></p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Quantidade</label>
                                                            <p class="form-control"><?= htmlspecialchars($usuario['quantidade']) ?></p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Preço</label>
                                                            <p class="form-control"><?= number_format($usuario['preço'], 2, ',', '.') ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Botão de editar -->
                                        <a href="cadastro-edit.php?id=<?= $usuario['id'] ?>" class="btn btn-success btn-sm">
                                            <span class="bi-pencil-fill"></span>&nbsp;Editar
                                        </a>

                                        <!-- Botão de excluir -->
                                        <form action="acoes.php" method="POST" class="d-inline">
                                            <button onclick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_usuario" value="<?= $usuario['id'] ?>" class="btn btn-danger btn-sm">
                                                <span class="bi-trash3-fill"></span>&nbsp;Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                            }
                                        } else {
                                            echo '<tr><td colspan="5" class="text-center">Nenhum item encontrado</td></tr>';
                                        }
                                    } catch (PDOException $e) {
                                        echo '<tr><td colspan="5" class="text-center">Erro ao buscar itens: ' . $e->getMessage() . '</td></tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="5" class="text-center">Pesquise para exibir os itens</td></tr>';
                                }
                                ?>
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
