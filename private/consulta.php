<?php
    include("../config/database.php");

    try {
        $stmt = $pdo->query(
            "SELECT
                lojas.nome AS loja_nome,
                lojas.endereco AS loja_endereco,
                vendas.id AS venda_id,
                vendas.data_venda AS venda_data,
                vendedores.nome AS vendedor_nome,
                clientes.nome AS cliente_nome,
                clientes.cpf AS cliente_cpf,
                produtos.id AS produto_id,
                produtos.nome AS produto_nome,
                vendas_produtos.preco_unitario AS produto_preco,
                vendas_produtos.valor_final AS valor_final
            FROM
                vendas
            JOIN vendedores ON vendedores.id = vendas.vendedor_id
            JOIN clientes ON clientes.id = vendas.cliente_id
            JOIN vendas_produtos ON vendas_produtos.venda_id = vendas.id
            JOIN produtos ON produtos.id = vendas_produtos.produto_id
            JOIN lojas ON vendedores.loja_id = lojas.id
            ORDER BY venda_id DESC
            LIMIT 10"
        );

        foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            mostrarResultado($row);
        }
    } catch(Exception $erro) {
        echo "Erro ao fazer consulta: " . $erro->getMensagem();
        require_once("voltar_5_seg.php");
    }

    function mostrarResultado($row) {
?>
    <div
        style="display: grid; grid-auto-flow: column; grid-template-rows: 1; grid-template-columns: repeat(1fr, 5); column-gap: 1rem;"
        class="consulta_venda text-center rounded-xl shadow-md p-2 bg-[#dedede] hover:bg-[#ccc] cursor-pointer mb-2"
    >
        <span class="cod_venda"><?= $row['venda_id']?></span>
        <span><?= $row['venda_data']?></span>
        <span><?= $row['cliente_nome']?></span>
        <span><?= $row['produto_nome']?></span>
        <span><?= $row['valor_final']?></span>
    </div>
<?php
    }
?>