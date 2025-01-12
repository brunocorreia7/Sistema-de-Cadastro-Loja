<?php
session_start(); 


require 'conexao.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    
    if (!empty($username) && !empty($password)) {
        try {
            
            $sql = "SELECT * FROM users WHERE username = :username";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            
            if ($user) {
                // Verifica se a senha fornecida corresponde à armazenada no banco
                if (password_verify($password, $user['password'])) {
                    
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['user_id'] = $user['id'];

                    

                    
                    header("Location: cadastro.php");
                    exit();  
                } else {
                    echo "Senha incorreta!";
                }
            } else {
                echo "Usuário não encontrado!";
            }
        } catch (PDOException $e) {
            echo "Erro ao conectar no banco de dados: " . $e->getMessage();
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>
