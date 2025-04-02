<?php
    include("config/database.php");

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
            vendas_produtos.preco_unitario AS produto_preco
        FROM
            vendas
        JOIN vendedores ON vendedores.id = vendas.vendedor_id
        JOIN clientes ON clientes.id = vendas.cliente_id
        JOIN vendas_produtos ON vendas_produtos.venda_id = vendas.id
        JOIN produtos ON produtos.id = vendas_produtos.produto_id
        JOIN lojas ON vendedores.loja_id = lojas.id"
    );
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        mostrarResultado($row);
    }

    function mostrarResultado($row) {
        echo "Lojas: " . $row['loja_nome'] . "<br>";
        echo "Endereço: " . $row['loja_endereco'] . "<br>";
        echo "Identificador da venda: " . $row['venda_id'] . "<br>";
        echo "Data da venda: " . $row['venda_data'] . "<br>";
        echo "Nome do vendedor: " . $row['vendedor_nome'] . "<br>";
        echo "Nome do cliente: " . $row['cliente_nome'] . "<br>";
        echo "CPF do cliente: " . $row['cliente_cpf'] . "<br>";
        echo "Produto: " . $row['produto_nome'] . "<br>";
        echo "Código do produto: " . $row['produto_id'] . "<br>";
        echo "Preço unitário: " . $row['produto_preco'] . "<br>";
    }
?>