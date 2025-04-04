<?php
    include("../config/database.php");

    try {

        $stmt = $pdo->query(
            "SELECT
                id,
                data_venda
            FROM
                vendas
            ORDER BY id"
        );

        $grafico_arr = [];

        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

            array_push($grafico_arr, $row);
        }

        echo json_encode($grafico_arr);
    } catch(Exception $erro) {
        echo "Erro ao fazer consulta: " . $erro->getMensagem();
    }

?>