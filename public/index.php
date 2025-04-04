<?php
    session_start();

    if(!isset($_SESSION['logado']) || $_SESSION['logado'] != "true") {
        header("Location: login.php");
    }
?>
<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PDV - WEB2</title>
        <!-- tailwind -->
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <!-- chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- js -->
        <script src="app.js" defer></script>
    </head>
    <body class="bg-[#222831] flex justify-center">
        <div class="w-[768px] min-w-[526px] bg-[#EEEEEE] rounded-xl shadow-xl mt-8">
            <header>
                <div class="uppercase flex bg-[#00ADB5] text-white p-2 rounded-t-xl items-center gap-x-2">
                    <h1 class="text-[1.5rem]">
                        <a href="../public/index.php">pdv - voltar</a>
                    </h1>
                </div>
                <nav>
                    <ul id="lista_abas" class="flex justify-center flex-wrap h-[100%] uppercase d-grid gap-x-4 gap-y-6 py-4 shadow-md rounded-b-xl">
                        <li><a class="py-2 px-4 text-[#EEEEEE] rounded-md shadow-md cursor-pointer bg-[#00ADB5] hover:bg-[#00ADB5]">venda</a></li>
                        <li><a class="py-2 px-4 text-[#EEEEEE] rounded-md shadow-md cursor-pointer bg-[#393E46] hover:bg-[#00ADB5]">consulta</a></li>
                        <li><a class="py-2 px-4 text-[#EEEEEE] rounded-md shadow-md cursor-pointer bg-[#393E46] hover:bg-[#00ADB5]">modificar venda</a></li>
                        <li><a class="py-2 px-4 text-[#EEEEEE] rounded-md shadow-md cursor-pointer bg-[#393E46] hover:bg-[#00ADB5]">grafico vendas</a></li>
                        <li><a class="py-2 px-4 text-[#EEEEEE] rounded-md shadow-md cursor-pointer bg-[#393E46] hover:bg-[#00ADB5]">produtos</a></li>
                    </ul>
                </nav>
            </header>
            <main class="h-[100dvh] max-h-[500px] p-4 shadow-sm">
                <div id="container_venda" class="block shadow-md h-full">
                    <form class="bg-[#ddd] rounded-sm p-2" action="../private/venda.php" method="post">
                        <label>ID do Vendedor (1 por padrão)*
                            <input class="w-full h-8 indent-2 bg-[#eee] border-[1px] border-[#bbb] rounded-sm" type="text" value="1" name="vendedor" required>
                        </label>
                        <label>Nome do Cliente*
                            <input class="w-full h-8 indent-2 bg-[#eee] border-[1px] border-[#bbb] rounded-sm" type="text" name="cliente_nome" required>
                        </label>
                        <label>CPF do Cliente*
                            <input class="w-full h-8 indent-2 bg-[#eee] border-[1px] border-[#bbb] rounded-sm" type="text" name="cliente_cpf" required>
                        </label>
                        <label>ID do Produto*
                            <input class="w-full h-8 indent-2 bg-[#eee] border-[1px] border-[#bbb] rounded-sm" type="text" name="produto_nome" required>
                        </label>
                        <label>Quantidade*
                            <input class="w-full h-8 indent-2 bg-[#eee] border-[1px] border-[#bbb] rounded-sm" type="text" value="1" name="produto_qtd" required>
                        </label>
                        <div class="flex mt-4 justify-center gap-x-4">
                            <button class="py-2 px-4 text-[#EEEEEE] rounded-md shadow-md cursor-pointer bg-[#00ADB5] hover:bg-[#393E46]" type="submit">finalizar venda</button>
                        </div>
                    </form>
                </div>
                <div id="container_consulta" class="hidden shadow-md h-full">
                    <div class="flex justify-between w-full mb-2 uppercase px-4 text-[1.2rem]">
                        <span>cod</span>
                        <span>data</span>
                        <span>cliente</span>
                        <span>produto</span>
                        <span>valor</span>
                    </div>
                    <div class="overflow-y-scroll h-[100%] max-h-[430px]">
                        <?php require("../private/consulta.php") ?>
                    </div>
                </div>
                <div id="container_grafico" class="hidden shadow-md h-full">
                    <canvas id="grafico" class="h-full"></canvas>
                </div>
                <div id="container_produtos" class="hidden shadow-md h-full">
                    <div class="flex justify-between w-full mb-2 uppercase px-4 text-[1.2rem]">
                        <span>cod</span>
                        <span>produto</span>
                        <span>preço</span>
                        <span>estoque</span>
                    </div>
                    <div class="overflow-y-scroll h-[100%] max-h-[430px]">
                        <?php require_once("../private/produtos.php") ?>
                    </div>
                </div>
            </main>
            <footer class="text-center p-4">
                <small>&copy; copyright 2025 | Gustavo Luiz Gregorio</small>
            </footer>
        </div>
    </body>
</html>