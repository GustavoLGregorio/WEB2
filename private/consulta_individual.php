<?php
    include("../config/database.php");
    $consulta_id = $_GET['consulta_id'];
    // $_GET['consulta_id'] 

    try {
        $stmt = $pdo->prepare(
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
                vendas_produtos.quantidade AS produto_quantidade,
                vendas_produtos.valor_final AS valor_final
            FROM
                vendas
            JOIN vendedores ON vendedores.id = vendas.vendedor_id
            JOIN clientes ON clientes.id = vendas.cliente_id
            JOIN vendas_produtos ON vendas_produtos.venda_id = vendas.id
            JOIN produtos ON produtos.id = vendas_produtos.produto_id
            JOIN lojas ON vendedores.loja_id = lojas.id
            WHERE vendas.id = ?"
        );
        $stmt->execute([$consulta_id]);
    
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            mostrarResultado($row);
        }
    } catch(Exception $erro) {
        echo "Erro ao fazer consulta: " . $erro->getMensagem();
    }

    function mostrarResultado($row) {
?>
        <div id="consulta_individual" class="grid gap-y-2 bg-[#dedede] p-2 uppercase font-[monospace] text-justify text-[1.1rem]">
            <p class="w-full">Loja: <?= $row['loja_nome']?></p>
            <p class="w-full">Endereco: <?= $row['loja_endereco']?></p>
            <p class="w-full">Data: <?= $row['venda_data']?></p>
            <hr>
            <p class="w-full">Vendedor: <?= $row['vendedor_nome']?></p>
            <p class="w-full">COD venda: <?= $row['venda_id']?></p>

            <p class="w-full">Cliente: <?= $row['cliente_nome']?></p>
            <p class="w-full">CPF: <?= $row['cliente_cpf']?></p>
            <p class="w-full">Produto: <?= $row['produto_nome']?></p>
            <p class="w-full">QTD: <?= $row['produto_quantidade']?>x</p>
            <p class="w-full">Valor final: <?= $row['valor_final']?></p>
        </div>

        <div class="w-full flex justify-center mt-6">
            <button
                onclick="
                    let conteudo = document.getElementById('consulta_individual').innerHTML
                    let janela = window.open()
                    janela.document.write(`<html><head><title class='text-center'>Impressão</title></head><body>`)
                    janela.document.write(conteudo)
                    janela.document.write('</body></html>')
                    janela.document.close()
                    janela.print()"
                class="botao_imprimir py-2 px-4 text-[#EEEEEE] rounded-md shadow-md cursor-pointer bg-[#00ADB5] hover:bg-[#393E46]"
                type="button"
            >imprimir recibo</button>
        </div>
<?php
    }
?>