<?php
    include("../config/database.php");

    $vendedor_id = $_POST['vendedor'];
    $cliente_nome = $_POST['cliente_nome'];
    $cliente_cpf = $_POST['cliente_cpf'];
    $produto_id = $_POST['produto_nome'];
    $produto_qtd = $_POST['produto_qtd'];

    try {
        // inicio da transacao de queries
        $pdo->beginTransaction();

        // recupera id em base do cpf
        $stmt = $pdo->prepare("SELECT id FROM clientes WHERE cpf = ?");
        $stmt->execute([$cliente_cpf]);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // checa se o cliente ja esta cadastrado (via id)
        if ($cliente) {
            // ja existe, entao so seleciona ele
            $cliente_id = $cliente['id'];
        } else {
            // nao existe, entao adiciona um novo
            $stmt = $pdo->prepare("INSERT INTO clientes (nome, cpf) VALUES (?, ?)");
            $stmt->execute([$cliente_nome, $cliente_cpf]);
            $cliente_id = $pdo->lastInsertId();
        }
    
        // insere uma venda
        $stmt = $pdo->prepare("INSERT INTO vendas (cliente_id, vendedor_id) VALUES (?, ?)");
        $stmt->execute([$cliente_id, $vendedor_id]);
        $venda_id = $pdo->lastInsertId();
    
        // obtem preco do produto em base do id/nome
        $stmt = $pdo->prepare("SELECT preco FROM produtos WHERE id = ?");
        $stmt->execute([$produto_id]);
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);
        // recupera o preco ou zera caso nao encontre
        $preco_unitario = $produto ? $produto['preco'] : 0;
    
        // insere produto vendido
        $stmt = $pdo->prepare("INSERT INTO vendas_produtos (venda_id, produto_id, quantidade, preco_unitario) VALUES (?, ?, ?, ?)");
        $stmt->execute([$venda_id, $produto_id, $produto_qtd, $preco_unitario]);

        $stmt = $pdo->prepare("UPDATE produtos SET qtd_estoque = qtd_estoque - ? WHERE id = ?");
        $stmt->execute([$produto_qtd, $produto_id]);
    
        $pdo->commit();
        
        header("Location: ../public/index.php");

    } catch(Exception $erro) {
        $pdo->rollback();
        echo "Erro ao inserir dados: " . $erro->getMessage();
        require_once("voltar_5_seg.php");
    }
?>

