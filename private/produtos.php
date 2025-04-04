<?php
    include("../config/database.php");

    try {
        $stmt = $pdo->query(
            "SELECT * FROM produtos LIMIT 50"
        );

        $grafico_arr = [];

        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            mostrarProduto($row);
        }
    } catch(Exception $erro) {
        echo "Erro ao fazer consulta: " . $erro->getMensagem();
        require_once("voltar_5_seg.php");
    }

    function mostrarProduto($row) {
?>
    <div
        style="display: grid; grid-auto-flow: column; grid-template-rows: 1; grid-template-columns: repeat(1fr, 4); column-gap: 1rem;"
        class="rounded-xl shadow-md p-2 bg-[#dedede] hover:bg-[#ccc] cursor-pointer mb-2"
    >
        <span class="text-start"><?= $row['id']?></span>
        <span class="text-center"><?= $row['nome']?></span>
        <span class="text-center"><?= $row['preco']?></span>
        <span class="text-end"><?= $row['qtd_estoque']?></span>
    </div>
<?php
    }
?>