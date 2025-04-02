<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PDV - WEB2</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <!--
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
        -->
    </head>
    <body class="bg-[#ddd] flex justify-center">
        <div class="w-[678px] bg-[#eee] rounded-xl shadow-xl mt-8">
            <header>
                <div class="uppercase flex bg-[green] text-white p-2 rounded-t-xl items-center gap-x-2">
                    <h1 class="text-[1.5rem]">
                        <a href="../public/index.php">pdv <span>empresa</span></a>
                    </h1>
                    <span class="text-[1.25rem]">&ndash;</span>
                    <h2 class="text-[1.25rem]">venda</h2>
                </div>
                <nav>
                    <ul class="uppercase flex justify-center gap-x-4 py-4 shadow-md rounded-b-xl">
                        <li><a class="text-[white] cursor-default bg-[#ccc] border-[1px] border-[#bbb] py-2 px-4 rounded-lg">venda</a></li>
                        <li><a href="../views/consulta.php" class="text-[white] bg-[lightblue] hover:bg-[skyblue] py-2 px-4 rounded-lg">consulta</a></li>
                        <li><a href="../views/estoque.php" class="text-[white] bg-[lightblue] hover:bg-[skyblue] py-2 px-4 rounded-lg">estoque</a></li>
                    </ul>
                </nav>
            </header>
            <main class="h-[60dvh] p-4 shadow-sm" id="conteudo">
                <form class="bg-[#ddd] rounded-sm p-2" action="../venda.php" method="post">
                    <label>Nome do Cliente
                        <input class="w-full h-8 bg-[#eee] border-[1px] border-[#bbb] rounded-sm" type="text" name="cliente_nome">
                    </label>
                    <label>CPF do Cliente
                        <input class="w-full h-8 bg-[#eee] border-[1px] border-[#bbb] rounded-sm" type="text" name="cliente_cpf">
                    </label>
                    
                    <label>Produto*
                        <input class="w-full h-8 bg-[#eee] border-[1px] border-[#bbb] rounded-sm" type="text" name="produto_nome">
                    </label>
                    <label>QTD*
                        <input class="w-full h-8 bg-[#eee] border-[1px] border-[#bbb] rounded-sm" type="text" name="produto_qtd">
                    </label>
    
                    <div class="flex mt-4 justify-center gap-x-4">
                        <button class="uppercase bg-[orange] hover:bg-[darkred] text-white py-2 px-4 rounded-md" type="submit">finalizar venda</button>
                    </div>
                </form>

                <button class="uppercase cursor-pointer text-[#333] bg-[#ccc] hover:bg-[#aaa] py-2 px-4 rounded-lg">nova consulta+</button>
            </main>
            <footer class="text-center p-4">
                <small>&copy; copyright 2025 | Gustavo Luiz Gregorio</small>
            </footer>
        </div>
    </body>
</html>