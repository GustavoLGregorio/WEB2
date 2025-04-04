<?php
    include("../config/database.php");

    $consulta_id = $_GET['consulta_id'];

    try {
        $stmt = $pdo->prepare(
            "DELETE FROM vendas WHERE id = ?"
        );
        $stmt->execute([$consulta_id]);

        echo "Sucesso ao deletar venda: " . $consulta_id . "!";

    } catch(Exception $erro) {
        echo "Erro ao deletar venda: " . $erro->getMessage();
    }

?>