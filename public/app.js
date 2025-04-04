const containerVenda = document.getElementById("container_venda")
const containerConsulta = document.getElementById("container_consulta")
const containerEstoque = document.getElementById("container_estoque")
const containerGrafico = document.getElementById("container_grafico")

const arrAbas = document.getElementById("lista_abas").querySelectorAll("a")
const arrConsulta = document.querySelectorAll(".consulta_venda")
const arrUpdate = document.querySelectorAll(".update_venda")

const botaoImprimir = document.querySelector(".botao_imprimir")

setInterval(() => {
    sessionStorage.getItem("aba")
}, 500)

arrAbas.forEach((el, index) => {
    el.addEventListener("click", () => {

        switch(index) {
            case 0:
                containerVenda.style.display = "block"
                containerConsulta.style.display = "none"
                containerGrafico.style.display = "none"
                sessionStorage.setItem("aba", "0")
                break;
            case 1:
                containerVenda.style.display = "none"
                containerConsulta.style.display = "block"
                containerGrafico.style.display = "none"
                sessionStorage.setItem("aba", "1")
                break;
            case 2:
                containerVenda.style.display = "none"
                containerConsulta.style.display = "block"
                containerGrafico.style.display = "none"
                sessionStorage.setItem("aba", "2")
                break;
            case 3:
                containerVenda.style.display = "none"
                containerConsulta.style.display = "none"
                containerGrafico.style.display = "block"
                sessionStorage.setItem("aba", "3")
                break;
        }
    })
})


arrConsulta.forEach((el, index) => {
    el.addEventListener("click", () => {
        if(sessionStorage.getItem("aba") == "1") {
            const consultaId = el.querySelector(".cod_venda").innerText
            receberConsulta(consultaId)
        } else if(sessionStorage.getItem("aba") == "2") {
            const consultaId = el.querySelector(".cod_venda").innerText
            updateConsulta(consultaId)
        }
    })
})

function receberConsulta(consultaId) {
    fetch(`../private/consulta_individual.php?consulta_id=${consultaId}`, { method: "GET" })
    .then(response => response.text())
    .then(data => {
        containerConsulta.innerHTML = data
    })
    .catch(erro => console.error("Erro: ", erro));
}
function updateConsulta(consultaId) {
    fetch(`../private/alterar_venda.php?consulta_id=${consultaId}`, { method: "GET" })
    .then(response => response.text())
    .then(data => {
        containerConsulta.innerHTML = data
    })
    .catch(erro => console.error("Erro: ", erro));
}

function fazerGrafico() {
    const grafico = document.getElementById('grafico');

    try {
        fetch(`../private/recuperar_vendas.php`, { method: "POST" })
        .then(response => response.json())
        .then(data => {
            const arrDatas = []

            data.forEach((value, index) => {
                arrDatas.push(value['data_venda'].substring(0, 10))
            })

            const arrDatasRepetidas = []
            arrDatas.forEach((_, index) => {
                let ard = arrDatas.filter((value, _) => arrDatas[index] == value)
                arrDatasRepetidas.push(ard[0])
            })

            const setDatas = new Set(arrDatasRepetidas)
            
            console.log(setDatas)

            new Chart(grafico, {
                type: 'line',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(erro => console.error("Erro: ", erro));

    } catch(erro) {
        console.log("Erro ao recuperar dados: ", erro)
    }


}
fazerGrafico()