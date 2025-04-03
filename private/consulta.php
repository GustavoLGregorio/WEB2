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
    }

    function mostrarResultado($row) {
?>
    <div class="consulta_venda flex gap-x-2 rounded-xl shadow-md p-2 bg-[#dedede] hover:bg-[#ccc] cursor-pointer mb-2">
        <span>COD venda: <span class="cod_venda"><?= $row['venda_id']?></span></span>
        <span>Data: <?= $row['venda_data']?></span>
        <span>Cliente: <?= $row['cliente_nome']?></span>
        <span>Produto: <?= $row['produto_nome']?></span>
        <span>Valor: <?= $row['valor_final']?></span>
    </div>
<?php
    }
?>