<?php
    include("../config/database.php");

    
    try {
        $consulta_id = $_GET['consulta_id'];
        $vendedor_nome = $_GET['vendedor_nome'];
        $cliente_nome = $_GET['cliente_nome'];
        $cliente_cpf = $_GET['cliente_cpf'];
        $produto_id = $_GET['produto_id'];
        $produto_quantidade = $_GET['produto_quantidade'];


        $pdo->beginTransaction();

        $stmt = $pdo->prepare(
            "SELECT
                vendas.id,
                vendedores.nome,
                clientes.nome,
                clientes.cpf,
                produtos.id,
                vendas_produtos.quantidade
            FROM
                vendas
            JOIN vendedores ON vendedores.id = vendas.vendedor_id
            JOIN clientes ON clientes.id = vendas.cliente_id
            JOIN vendas_produtos ON vendas_produtos.venda_id = vendas.id
            JOIN produtos ON produtos.id = vendas_produtos.produto_id
            WHERE vendas.id = ?"
        );
        $stmt->execute([$consulta_id]);

        $stmt = $pdo->prepare(
            "UPDATE clientes SET clientes.nome = ?, clientes.cpf = ?
            WHERE clientes.id = ?"
        );
        $stmt->execute([$cliente_nome, $cliente_cpf]);

        $pdo->commit();
    } catch(Exception $erro) {
        echo "Erro ao fazer consulta: " . $erro->getMensagem();
    }
?>