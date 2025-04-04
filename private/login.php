<?php
    include("../config/database.php");

    session_start();

    $usuario_email = $_POST['usuario_email'];
    $usuario_senha = $_POST['usuario_senha'];
    
    try {
        $stmt = $pdo->prepare(
            "SELECT email, senha FROM vendedores WHERE email = ?"
        );
        $stmt->execute([$usuario_email]);
    
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if(password_verify($usuario_senha, $row['senha'])) {
                $_SESSION['logado'] = "true";
                header("Location: ../public/index.php");
            } else {
                echo "Senha incorreta!";
            }
        }
    } catch(Exception $erro) {
        echo "Erro ao fazer consulta: " . $erro->getMensagem();
        require_once("voltar_5_seg.php");
    }
?>