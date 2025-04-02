<?php
    include("config/database.php");

    $cliente_nome = $_POST['cliente_nome'];
    $cliente_cpf = $_POST['cliente_cpf'];
    $produto_nome = $_POST['produto_nome'];
    $produto_qtd = $_POST['produto_qtd'];

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

?>