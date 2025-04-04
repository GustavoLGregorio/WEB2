<?php
    include("../config/database.php");
    $consulta_id = $_GET['consulta_id'];

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
        require_once("voltar_5_seg.php");
    }

    function mostrarResultado($row) {
?>
        <div id="consulta_individual" class="flex gap-x-4 bg-[#dedede] p-2 capitalize text-[0.8rem]">
            <div class="w-1/2">
                <h2 class="text-center mb-4 text-[1.1rem] uppercase">Valores Atuais</h2>
                <div class="p-2 ">
                    <p class="w-full">Loja: <?= $row['loja_nome']?></p>
                    <p class="w-full">Endereco: <?= $row['loja_endereco']?></p>
                    <p class="w-full">Data: <?= $row['venda_data']?></p>
                    <hr>
                    <p class="w-full">Vendedor: <?= $row['vendedor_nome']?></p>
                    <p class="w-full">COD venda: <span id="consultaId"><?= $row['venda_id']?></span></p>
        
                    <p class="w-full">Cliente: <?= $row['cliente_nome']?></p>
                    <p class="w-full">CPF: <?= $row['cliente_cpf']?></p>
                    <p class="w-full">Produto: <?= $row['produto_nome']?></p>
                    <p class="w-full">QTD: <?= $row['produto_quantidade']?>x</p>
                    <p class="w-full">Valor final: <?= $row['valor_final']?></p>
                </div>
            </div>
            <div class="w-1/2">
                <h2 class="text-center mb-4 text-[1.1rem] uppercase">Novos Valores</h2>
                <form class="grid gap-y-1" action="../private/atualizar_venda.php" method="get">
                    <div>
                        <input
                            type="text"
                            class="hidden"
                            value="<?= $row['venda_id']?>"
                            name="consulta_id"
                        >
                        <label for="aVendedorNome">Nome do vendedor:</label>
                        <input
                            id="aVendedorNome"
                            type="text"
                            class="w-full bg-[#EEEEEE] border border-[#222831] rounded-sm indent-2"
                            value="<?= $row['vendedor_nome']?>"
                            name="vendedor_nome"
                        >
                    </div>
                    <div>
                        <label for="aClienteNome">Nome do cliente:</label>
                        <input
                            id="aClienteNome"
                            type="text"
                            class="w-full bg-[#EEEEEE] border border-[#222831] rounded-sm indent-2"
                            value="<?= $row['cliente_nome']?>"
                            name="cliente_nome"
                        >
                    </div>
                    <div>
                        <label for="aClienteCpf">CPF do Cliente:</label>
                        <input
                            id="aClienteCpf"
                            type="text"
                            class="w-full bg-[#EEEEEE] border border-[#222831] rounded-sm indent-2"
                            value="<?= $row['cliente_cpf']?>"
                            name="cliente_cpf"
                        >
                    </div>
                    <div>
                        <label for="aProdutoId">Produto (id):</label>
                        <input
                            id="aProdutoId"
                            type="text"
                            class="w-full bg-[#EEEEEE] border border-[#222831] rounded-sm indent-2"
                            value="<?= $row['produto_id']?>"
                            name="produto_id"
                        >
                    </div>
                    <div>
                        <label for="aProdutoQuantidade">Quantidade:</label>
                        <input
                            id="aProdutoQuantidade"
                            type="text"
                            class="w-full bg-[#EEEEEE] border border-[#222831] rounded-sm indent-2"
                            value="<?= $row['produto_quantidade']?>"
                            name="produto_quantidade"
                        >
                    </div>
                    <div class="grid justify-center mt-2">
                        <input
                            type="submit"
                            value="atualizar venda"
                            class="py-2 px-4 text-[#EEEEEE] rounded-md shadow-md cursor-pointer bg-[#00ADB5] hover:bg-[#393E46]">
                    </div>
                </form>
            </div>
        </div>

        <div class="w-full flex gap-x-4 justify-center mt-6">
            <button
                onclick="
                    let consultaId = document.querySelector('#consultaId').innerText
                    fetch(`../private/apagar_venda.php?consulta_id=${consultaId}`, { method: 'GET' })
                    .then(response => response.text())
                    .then(data => {
                        document.write(data)
                    })
                    .catch(erro => document.write('Erro: ', erro))
                "
                class="botao_imprimir py-2 px-4 text-[#EEEEEE] rounded-md shadow-md cursor-pointer bg-[red] hover:bg-[#393E46]"
                type="button"
            >apagar venda</button>
        </div>
<?php
    }
?>