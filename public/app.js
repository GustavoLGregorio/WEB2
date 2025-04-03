const containerVenda = document.getElementById("container_venda")
const containerConsulta = document.getElementById("container_consulta")
const containerEstoque = document.getElementById("container_estoque")
const arrAbas = document.getElementById("lista_abas").querySelectorAll("a")
const arrConsulta = document.querySelectorAll(".consulta_venda")
const botaoImprimir = document.querySelector(".botao_imprimir")




arrAbas.forEach((el, index) => {
    el.addEventListener("click", () => {
        switch(index) {
            case 0:
                containerVenda.style.display = "block"
                containerConsulta.style.display = ""
                containerEstoque.style.display = ""
                break;
            case 1:
                containerVenda.style.display = ""
                containerConsulta.style.display = "block"
                containerEstoque.style.display = ""
                break;
            case 2:
                containerVenda.style.display = ""
                containerConsulta.style.display = ""
                containerEstoque.style.display = "block"
                break;
        }
    })
})

arrConsulta.forEach((el, _) => {
    el.addEventListener("click", () => {
        const consultaId = el.querySelector(".cod_venda").innerText
        receberConsulta(consultaId)
    })
})
try {
} catch(erro) {}

function receberConsulta(consultaId) {
    fetch(`../private/consulta_individual.php?consulta_id=${consultaId}`, { method: "GET" })
    .then(response => response.text()) // Resposta do PHP
    .then(data => {
        containerConsulta.innerHTML = data // Exibe mensagem
    })
    .catch(erro => console.error("Erro: ", erro));
}

/*
const checkBotao = setInterval(() => {
    if(document.querySelector(".consulta_individual") != null) {
        let botao = document.querySelector(".consulta_individual")
        sessionStorage.setItem("consulta_impressao_disponivel", "true")
        clearInterval(checkBotao)
    }
}, 500)

try {
    if( sessionStorage.getItem("consulta_impressao_disponivel") == "true" ) {
        let botao = document.querySelector(".consulta_individual")
        botao.addEventListener("click", () => {
            console.log("click")
        })
    }
} catch(erro) {}
*/