<?php
    include("../config/database.php");

    
    try {
        $consulta_id = $_GET['consulta_id'];
        $vendedor_nome = $_GET['vendedor_nome'];
        $cliente_nome = $_GET['cliente_nome'];
        $cliente_cpf = $_GET['cliente_cpf'];
        $produto_id = $_GET['produto_id'];
        $produto_quantidade = $_GET['produto_quantidade'];
        // Início da transação
        $pdo->beginTransaction();
    
        // Recupera ID do cliente baseado no CPF
        $stmt = $pdo->prepare("SELECT id FROM clientes WHERE cpf = ?");
        $stmt->execute([$cliente_cpf]);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($cliente) {
            $cliente_id = $cliente['id'];
        } else {
            // Caso não exista, cria um novo cliente
            $stmt = $pdo->prepare("INSERT INTO clientes (nome, cpf) VALUES (?, ?)");
            $stmt->execute([$cliente_nome, $cliente_cpf]);
            $cliente_id = $pdo->lastInsertId();
        }
    
        // Recupera ID do vendedor
        $stmt = $pdo->prepare("SELECT id FROM vendedores WHERE nome = ?");
        $stmt->execute([$vendedor_nome]);
        $vendedor = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($vendedor) {
            $vendedor_id = $vendedor['id'];
        } else {
            throw new Exception("Vendedor não encontrado.");
        }
    
        // Recupera o preço do produto
        $stmt = $pdo->prepare("SELECT preco FROM produtos WHERE id = ?");
        $stmt->execute([$produto_id]);
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);
        $preco_unitario = $produto ? $produto['preco'] : 0;
    
        // Atualiza a venda existente
        $stmt = $pdo->prepare(
            "UPDATE vendas 
            SET cliente_id = ?, vendedor_id = ? 
            WHERE id = ?"
        );
        $stmt->execute([$cliente_id, $vendedor_id, $consulta_id]);
    
        // Atualiza os produtos vendidos na venda
        $stmt = $pdo->prepare(
            "UPDATE vendas_produtos 
            SET produto_id = ?, quantidade = ?, preco_unitario = ? 
            WHERE venda_id = ?"
        );
        $stmt->execute([$produto_id, $produto_quantidade, $preco_unitario, $consulta_id]);
    
        // Atualiza o estoque do produto
        $stmt = $pdo->prepare(
            "UPDATE produtos 
            SET qtd_estoque = qtd_estoque - ? 
            WHERE id = ?"
        );
        $stmt->execute([$produto_quantidade, $produto_id]);
    
        // Confirma a transação
        $pdo->commit();
    
        echo "Atualização realizada com sucesso.";
        require_once("voltar_5_seg.php");
    } catch (Exception $e) {
        // Em caso de erro, desfaz a transação
        $pdo->rollBack();
        echo "Erro: " . $e->getMessage();
        require_once("voltar_5_seg.php");
    }
?>