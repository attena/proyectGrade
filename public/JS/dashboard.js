
$(function () {

    //guardar()

    let palabras = { "hola": 90, "malo": 50, "Excelente": 30, "dañado": 200, }

    graphLine('satisfecho')
    graphLine('insatisfecho')
    graphLine('enojado')
    graphLine('nps')
    graphPie('pie')
    npsForQustion()
    graficaDeciciones();
    drawWordCloudAll(palabras, 'nube', 490, 400)
})

function prepareFilters() {

}

function graphLine(id, response, labeles) {

    var ctx2 = document.getElementById(id).getContext("2d");
    var myBarChart = new Chart(ctx2, {
        type: "line",
        data: {
            labels: labeles,
            datasets: response
        },
        options: {
            responsive: true,
            drawOnChartArea: false,
            plugins: {
                legend: {
                    position: "bottom"
                }
            }
        }
    });
}

function guardar() {

    let data = {
        "name": "test 1 cambiado",
        "questions": [
            {
                id: 1,
                question: "pregunta 5",
                type: "1"
            },
            {
                id: 2,
                question: "pregunta 2",
                type: "1"
            },
            {
                id: 3,
                question: "pregunta 3",
                type: "1"
            }
        ]
    }

    let data2 = {
        "idPoll": 3,
        "feeling": 1,
        "questions": [
            {
                id: 10,
                response: 1
            },
            {
                id: 11,
                response: 1
            },
            {
                id: 12,
                response: 1
            }
        ]
    }

    let getData = getDataAjax(
        "/api/send-poll",
        "post",
        data2
    );
    getData.done(function (response) {
        console.log(response)
    })
}

function graphPie(id, response) {

    let getData = getDataAjax(
        "/happindex/dashboard/feelGroup",
        "get",
        prepareFilters()
    );
    //getData.done(function (response) {

    let labels = [];
    let data = [];
    let colors = [];

    // Object.values(response.data).forEach(element => {
    //     labels.push(element.label)
    //     colors.push(element.borderColor)
    //     data.push(element.data)
    // });

    var ctx2 = document.getElementById('graphPie').getContext("2d");
    var myBarChart = new Chart(ctx2, {
        type: "pie",
        data: {
            labels: ['Satisfecho', 'Insatisfecho', 'enojado'],
            datasets: [
                {
                    label: 'Sentimientos',
                    data: [60, 30, 10],
                    backgroundColor: ["#09DE9D", "#FFC141", "#892000"]
                },
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "top"
                }
            }
        }
    });
    //});

}

function npsForQustion() {
    let getData = getDataAjax(
        "/happindex/dashboard/npsForQuestion",
        "get",
        prepareFilters()
    );
    setTimeout(() => {
        //getData.done(function (response) {

        var ctx2 = document.getElementById("nide").getContext("2d");
        var myChart2 = new Chart(ctx2, {
            type: "horizontalBar",
            data: {
                labels: ['Pregunta1', 'Pregunta 2', 'Pregunta 3'],
                datasets: [
                    {
                        label: "Completamente en desacuerdo",
                        backgroundColor: "#892000",
                        data: [10, 60, 8]
                    },
                    {
                        label: "En desacuerdo",
                        backgroundColor: "#E55D0C",
                        data: [15, 20, 50]
                    },

                    {
                        label: "Ni de acuerdo, ni en desacuerdo",
                        backgroundColor: "#FFC141",
                        data: [8, 30, 50]
                    },

                    {
                        label: "De acuerdo",
                        backgroundColor: "#008489",
                        data: [6, 25, 60]
                    },
                    {
                        label: "Completamente de acuerdo",
                        backgroundColor: "#09DE9D",
                        data: [30, 15, 38]
                    }
                ]
            },
            options: {
                cornerRadius: 20,
                fullCornerRadius: true,
                stackedRounded: true,
                legend: {
                    display: true,
                    position: "bottom",
                    padding: 50
                },
                scales: {
                    xAxes: [
                        {
                            display: false,
                            stacked: true,
                            barPercentage: 1,
                            gridLines: {
                                display: false
                            },
                            scaleLabel: {
                                display: false
                            },
                            ticks: {
                                autoSkip: true,
                                maxRotation: 20,
                                minRotation: 0
                            }
                        }
                    ],
                    yAxes: [
                        {
                            display: true,
                            stacked: true,
                            barPercentage: 1.0,
                            gridLines: {
                                display: false
                            },
                            scaleLabel: {
                                display: true
                            }
                        }
                    ]
                }
            }
        });
        //});
    }, 1000);
}

function npsForQustion() {
    let getData = getDataAjax(
        "/happindex/dashboard/npsForQuestion",
        "get",
        prepareFilters()
    );
    setTimeout(() => {
        //getData.done(function (response) {

        var ctx2 = document.getElementById("nide").getContext("2d");
        var myChart2 = new Chart(ctx2, {
            type: "horizontalBar",
            data: {
                labels: ['Pregunta1', 'Pregunta 2', 'Pregunta 3'],
                datasets: [
                    {
                        label: "Completamente en desacuerdo",
                        backgroundColor: "#892000",
                        data: [10, 60, 8]
                    },
                    {
                        label: "En desacuerdo",
                        backgroundColor: "#E55D0C",
                        data: [15, 20, 50]
                    },

                    {
                        label: "Ni de acuerdo, ni en desacuerdo",
                        backgroundColor: "#FFC141",
                        data: [8, 30, 50]
                    },

                    {
                        label: "De acuerdo",
                        backgroundColor: "#008489",
                        data: [6, 25, 60]
                    },
                    {
                        label: "Completamente de acuerdo",
                        backgroundColor: "#09DE9D",
                        data: [30, 15, 38]
                    }
                ]
            },
            options: {
                cornerRadius: 20,
                fullCornerRadius: true,
                stackedRounded: true,
                legend: {
                    display: true,
                    position: "bottom",
                    padding: 50
                },
                scales: {
                    xAxes: [
                        {
                            display: false,
                            stacked: true,
                            barPercentage: 1,
                            gridLines: {
                                display: false
                            },
                            scaleLabel: {
                                display: false
                            },
                            ticks: {
                                autoSkip: true,
                                maxRotation: 20,
                                minRotation: 0
                            }
                        }
                    ],
                    yAxes: [
                        {
                            display: true,
                            stacked: true,
                            barPercentage: 1.0,
                            gridLines: {
                                display: false
                            },
                            scaleLabel: {
                                display: true
                            }
                        }
                    ]
                }
            }
        });
        //});
    }, 1000);
}

function graficaDeciciones() {
    let getData = getDataAjax(
        "/happindex/dashboard/npsForQuestion",
        "get",
        prepareFilters()
    );
    setTimeout(() => {
        //getData.done(function (response) {

        var ctx2 = document.getElementById("sino").getContext("2d");
        var myChart2 = new Chart(ctx2, {
            type: "horizontalBar",
            data: {
                labels: ['Pregunta1', 'Pregunta 2', 'Pregunta 3'],
                datasets: [
                    {
                        label: "Si",
                        backgroundColor: "#09DE9D",
                        data: [10, 60, 8]
                    },
                    {
                        label: "No",
                        backgroundColor: "#892000",
                        data: [15, 20, 50]
                    },
                ]
            },
            options: {
                cornerRadius: 20,
                fullCornerRadius: true,
                stackedRounded: true,
                legend: {
                    display: true,
                    position: "bottom",
                    padding: 50
                },
                scales: {
                    xAxes: [
                        {
                            display: false,
                            stacked: true,
                            barPercentage: 1,
                            gridLines: {
                                display: false
                            },
                            scaleLabel: {
                                display: false
                            },
                            ticks: {
                                autoSkip: true,
                                maxRotation: 20,
                                minRotation: 0
                            }
                        }
                    ],
                    yAxes: [
                        {
                            display: true,
                            stacked: true,
                            barPercentage: 1.0,
                            gridLines: {
                                display: false
                            },
                            scaleLabel: {
                                display: true
                            }
                        }
                    ]
                }
            }
        });
        //});
    }, 1000);
}

function drawWordCloudAll(text_string, location, width, height) {

    var svg_location = "#" + location;
    var width = width;
    var height = height;
    var fill = d3.scale.category20();
    var word_entries = d3.entries(text_string);

    var xScale = d3.scale
        .linear()
        .domain([
            0,
            d3.max(word_entries, function (d) {
                return d.value;
            })
        ])
        .range([10, 100]);

    d3.layout
        .cloud()
        .size([width, height])
        .timeInterval(20)
        .words(word_entries)
        .fontSize(function (d) {
            return xScale(+d.value);
        })
        .text(function (d) {
            return d.key;
        })
        .rotate(function () {
            return ~~(Math.random() * 2) * 90;
        })
        .font("Impact")
        .on("end", draw)
        .start();

    function draw(words) {
        d3.select(svg_location)
            .append("svg")
            .attr("width", width)
            .attr("height", height)
            .append("g")
            .attr("transform", "translate(" + [width >> 1, height >> 1] + ")")
            .selectAll("text")
            .data(words)
            .enter()
            .append("text")
            .style("font-size", function (d) {
                return xScale(d.value) + "px";
            })
            .style("font-family", "Impact")
            .style("fill", function (d, i) {
                return fill(i);
            })
            .attr("text-anchor", "middle")
            .attr("transform", function (d) {
                return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
            })
            .text(function (d) {
                return d.key;
            });
    }
    d3.layout.cloud().stop();
}