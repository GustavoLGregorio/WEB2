<?php

    $pag_atual = "inicio";
    /*
    if(header("Location: ../../index.php")) {
        $pag_atual = "inicio";
    } else if(header("Location: venda.php")) {
        $pag_atual = "venda";
    }
    */

    echo
        '<header>
            <div class="uppercase flex bg-[green] text-white p-2 rounded-t-xl items-center gap-x-2">
                <h1 class="text-[1.5rem]">
                    <a href="../public/index.php">pdv <span>empresa</span></a>
                </h1>
                <span class="text-[1.25rem]">&ndash;</span>
                <h2 class="text-[1.25rem]">'. $pag_atual .'</h2>
            </div>
            <nav>
                <ul class="uppercase flex justify-center gap-x-4 py-4 shadow-md rounded-b-xl">
                    <li><a href="../views/venda.php" class="text-[white] bg-[lightblue] hover:bg-[skyblue] py-2 px-4 rounded-lg">venda</a></li>
                    <li><a href="../views/consulta.php" class="text-[white] bg-[lightblue] hover:bg-[skyblue] py-2 px-4 rounded-lg">consulta</a></li>
                    <li><a href="../views/estoque.php" class="text-[white] bg-[lightblue] hover:bg-[skyblue] py-2 px-4 rounded-lg">estoque</a></li>
                </ul>
            </nav>
        </header>';
?>