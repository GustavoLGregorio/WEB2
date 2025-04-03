<?php
    session_start();
    
    if(isset($_SESSION['logado']) && $_SESSION['logado'] == "true") {
        header("Location: index.php");
    }
?>
<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PDV - LOGIN</title>
        <link rel="stylesheet" href="global.css">
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script src="app.js" defer></script>
    </head>
    <body class="bg-[#222831] flex justify-center">
        <div class="w-[678px] bg-[#EEEEEE] rounded-xl shadow-xl mt-8">
            </header>
            <main class="h-[100dvh] max-h-[500px] p-4 shadow-sm">
                <div class="h-full flex items-center">
                    <form class="w-md mx-auto h-[300px] bg-[#393E46] p-8 rounded-xl shadow-xl text-[#EEEEEE] font-medium" action="../private/login.php" method="post">
                        <h1 class="text-[1.5rem] text-center bg-[#222831] uppercase p-2 rounded-md">PDV - pagina de login</h1>
                        <div class="w-full mt-4 grid gap-y-2]">
                            <label class="block w-full">Email:</label>
                            <input class="block w-full text-[#393E46] h-10 bg-[#EEEEEE] rounded-md border border-[#393E46]" type="email" name="usuario_email" required>
                            <label class="block w-full">Senha:</label>
                            <input class="block w-full text-[#393E46] h-10 bg-[#EEEEEE] rounded-md border border-[#393E46]" type="password" name="usuario_senha" required>
                            <div class="flex justify-center mt-2 w-full">
                                <input class="py-2 px-4 text-[#EEEEEE] rounded-md shadow-md cursor-pointer bg-[#00ADB5] hover:bg-[#393E46]" type="submit" value="entrar">
                            </div>
                        </div>
                    </form>
                </div>
            </main>
            <footer class="text-center p-4">
                <small>&copy; copyright 2025 | Gustavo Luiz Gregorio</small>
            </footer>
        </div>
    </body>
</html>