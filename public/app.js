const containerVenda = document.getElementById("container_venda")
const containerConsulta = document.getElementById("container_consulta")
const containerEstoque = document.getElementById("container_estoque")
const containerGrafico = document.getElementById("container_grafico")
const containerProdutos = document.getElementById("container_produtos")


const arrAbas = document.getElementById("lista_abas").querySelectorAll("a")
const arrConsulta = document.querySelectorAll(".consulta_venda")
const arrUpdate = document.querySelectorAll(".update_venda")

const botaoImprimir = document.querySelector(".botao_imprimir")

// atualiza a variavel da aba atual na secao
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
                containerProdutos.style.display = "none"

                arrAbas[0].style.backgroundColor = "#00ADB5"
                arrAbas[1].style.backgroundColor = "#393E46"
                arrAbas[2].style.backgroundColor = "#393E46"
                arrAbas[3].style.backgroundColor = "#393E46"
                arrAbas[4].style.backgroundColor = "#393E46"

                sessionStorage.setItem("aba", "0")
                break;
            case 1:
                containerVenda.style.display = "none"
                containerConsulta.style.display = "block"
                containerGrafico.style.display = "none"
                containerProdutos.style.display = "none"

                arrAbas[0].style.backgroundColor = "#393E46"
                arrAbas[1].style.backgroundColor = "#00ADB5"
                arrAbas[2].style.backgroundColor = "#393E46"
                arrAbas[3].style.backgroundColor = "#393E46"
                arrAbas[4].style.backgroundColor = "#393E46"

                sessionStorage.setItem("aba", "1")
                break;
            case 2:
                containerVenda.style.display = "none"
                containerConsulta.style.display = "block"
                containerGrafico.style.display = "none"
                containerProdutos.style.display = "none"

                arrAbas[0].style.backgroundColor = "#393E46"
                arrAbas[1].style.backgroundColor = "#393E46"
                arrAbas[2].style.backgroundColor = "#00ADB5"
                arrAbas[3].style.backgroundColor = "#393E46"
                arrAbas[4].style.backgroundColor = "#393E46"

                sessionStorage.setItem("aba", "2")
                break;
            case 3:
                containerVenda.style.display = "none"
                containerConsulta.style.display = "none"
                containerGrafico.style.display = "block"
                containerProdutos.style.display = "none"

                arrAbas[0].style.backgroundColor = "#393E46"
                arrAbas[1].style.backgroundColor = "#393E46"
                arrAbas[2].style.backgroundColor = "#393E46"
                arrAbas[3].style.backgroundColor = "#00ADB5"
                arrAbas[4].style.backgroundColor = "#393E46"

                sessionStorage.setItem("aba", "3")
                break;
            case 4:
                containerVenda.style.display = "none"
                containerConsulta.style.display = "none"
                containerGrafico.style.display = "none"
                containerProdutos.style.display = "block"

                arrAbas[0].style.backgroundColor = "#393E46"
                arrAbas[1].style.backgroundColor = "#393E46"
                arrAbas[2].style.backgroundColor = "#393E46"
                arrAbas[3].style.backgroundColor = "#393E46"
                arrAbas[4].style.backgroundColor = "#00ADB5"

                sessionStorage.setItem("aba", "4")
                break;
        }
    })
})

arrConsulta.forEach((el, _) => {
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

            // criando array de datas (somente aaaa/mm/dd)
            const tempDatas = []
            data.forEach((value, _) => {
                tempDatas.push(value['data_venda'].substring(0, 10))
            })

            const arrDatas = tempDatas.sort((a, b) => new Date(a) - new Date(b))

            // criando e retornando um set de datas e suas ocorrencias
            const setDatas = new Set()
            arrDatas.forEach((_, index) => {
                const ard = arrDatas.filter((value, _) => arrDatas[index] == value)
                const temp = `${ard[0]}/${ard.length}`
                setDatas.add(temp)
            })

            // criando array e retornando outro array via map
            // para separar corretamente datas e ocorrencias
            const mapDatas = new Array(...setDatas)
            const datas = mapDatas.map((value, _) => {
                return value.split("/")
            })

            // cria o grafico (biblioteca chart.js)
            new Chart(grafico, {
                type: 'line',
                data: {
                    // usa as datas retornadas pelo map "datas"
                    labels: datas.map((value, _) => {return value[0]}),
                    datasets: [{
                        label: 'vendas por dia',
                        // usa as ocorrencias retornadas pelo map "datas"
                        data: datas.map((value, _) => {return value[1]}),
                        borderWidth: 4,
                        // retorna a mesma cor para todos os itens
                        backgroundColor: datas.map(() => {return "#00ADB5"}),
                        tension: 0.2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
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