let promoterGeneral;
let detractorGeneral;
let neutralGeneral
$(function () {

    GetDataReports();
    getPollsReports();

    $('input[name=init]').on('change', function () {

        if ($('input[name=end]').val() === "") {
            $('input[name=end]').addClass('is-invalid')
            $('.date-end').removeClass('d-none')
        } else {

            $('input[name=end]').removeClass('is-invalid')
            $('.date-end').addClass('d-none')
        }

        if ($(this).val() != "") {
            $('input[name=init]').removeClass('is-invalid')
            $('.date-init').addClass('d-none')
        } else {
            $('input[name=init]').addClass('is-invalid')
            $('.date-init').removeClass('d-none')
        }

        if ($(this).val() == "" && $('input[name=init]').val() == "") {
            $('input[name=end]').removeClass('is-invalid')
            $('.date-end').addClass('d-none')
            $('input[name=init]').removeClass('is-invalid')
            $('.date-init').addClass('d-none')
            GetDataReports();
        }

        if ($(this).val() != "" && $('input[name=end]').val() != "") {
            $('input[name=end]').removeClass('is-invalid')
            $('.date-end').addClass('d-none')
            $('input[name=init]').removeClass('is-invalid')
            $('.date-init').addClass('d-none')

            GetDataReports();
        }
    })

    $('input[name=end]').on('change', function () {

        if ($('input[name=init]').val() === "") {
            $('input[name=init]').addClass('is-invalid')
            $('.date-init').removeClass('d-none')
        } else {
            $('input[name=init]').removeClass('is-invalid')
            $('.date-init').addClass('d-none')
        }

        if ($(this).val() != "") {
            $('input[name=end]').removeClass('is-invalid')
            $('.date-end').addClass('d-none')

        } else {
            $('input[name=end]').addClass('is-invalid')
            $('.date-end').removeClass('d-none')
        }

        if ($(this).val() == "" && $('input[name=init]').val() == "") {
            $('input[name=end]').removeClass('is-invalid')
            $('.date-end').addClass('d-none')
            $('input[name=init]').removeClass('is-invalid')
            $('.date-init').addClass('d-none')

            GetDataReports();
        }

        if ($(this).val() != "" && $('input[name=init]').val() != "") {
            $('input[name=end]').removeClass('is-invalid')
            $('.date-end').addClass('d-none')
            $('input[name=init]').removeClass('is-invalid')
            $('.date-init').addClass('d-none')

            GetDataReports();
        }
    })

    $(".polls-reports").on('change', function () {

        //if ($(this).val() !== "") {
            GetDataReports();
        //}
    })

})




function GetDataReports() {

    let getData = getDataAjax(
        "/api/reports",
        "get",
        prepareFilters()
    );


    getData.done(function (response) {

        $('.promoteres').html(response.promotorGeneral)
        $('.neutral').html(response.neutralGeneral)
        $('.detractor').html(response.detractorGeneral)

        $('.npsgeneral').html(parseInt(response.promotorGeneral-response.detractorGeneral)+'%')


        graphLine('satisfecho', response.satisfecho, '#6CFF00', 'Satisfecho')
        graphLine('insatisfecho', response.insatisfecho, '#FFCD00', 'Insatisfecho')
        graphLine('enojado', response.enojado, '#FF0000', 'Enojado')
        graphPie('pie', response.satisfechoPie, response.insatisfechoPie, response.enojadoPie)
        graphLineNps('nps', response.promoter, response.neutral, response.detractor)
        npsForQustion(response.ta, response.deac, response.nidd, response.ds, response.tds)
        graficaDeciciones(response.yes, response.no);

        let palabras = { "hola": 90, "malo": 50, "Excelente": 30, "dañado": 200, }
        drawWordCloudAll(response.words, 'nube', 490, 400)
    });
}

function prepareFilters() {

    let parameters = {};

    parameters = {
        poll: $('.polls-reports').val(),
        init: $('input[name=init]').val(),
        end: $('input[name=end]').val()
    };
    return parameters;
}

function getPollsReports() {

    let getData = getDataAjax(
        "/api/polls",
        "get",
        null
    );
    getData.done(function (response) {


        $(".polls-reports")
            .empty()
            .append(
                $("<option>", {
                    text: 'Seleccionar encuesta...',
                    value: ""
                }).attr("selected", "selected")
            );
        $.each(response[1], function (i, row) {
            $(".polls-reports").append(
                $("<option>", { value: row.idPolls, text: row.name })
            );
        });

    });


}



function graphLine(id, response, color, label) {

    let total = []
    let date = []

    response.forEach(element => {
        total.push(element.total)
        date.push(element.date)
    });
    var ctx2 = document.getElementById(id).getContext("2d");
    var myBarChart = new Chart(ctx2, {
        type: "line",
        data: {
            labels: date,
            datasets: [{
                label: label,
                data: total,
                borderColor: color,
                backgroundColor: "rgba(255,255,255,0)",
            }]
        },
        options: {
            responsive: true,
            drawOnChartArea: false,
            plugins: {
                legend: {
                    position: "top"
                }
            }
        }
    });
}

function graphLineNps(id, promotor, neutral, detractor) {


    let totalP = []
    let dateP = []

    let totalN = []
    let dateN = []

    let totalD = []
    let dateD = []



    promotor.forEach(element => {
        totalP.push(element.total)
        dateP.push(element.date)
    });

    neutral.forEach(element => {
        totalN.push(element.total)
        dateN.push(element.date)
    });


    detractor.forEach(element => {
        totalD.push(element.total)
        dateD.push(element.date)
    });

    let labels = new Set(dateP, dateN, dateD)

    var ctx2 = document.getElementById(id).getContext("2d");
    var myBarChart = new Chart(ctx2, {
        type: "line",
        data: {
            labels: [...labels],
            datasets: [
                {
                    label: 'Promotor',
                    data: totalP,
                    borderColor: '#6CFF00',
                    backgroundColor: "rgba(255,255,255,0)",
                },
                {
                    label: 'Neutral',
                    data: totalN,
                    borderColor: '#FFCD00',
                    backgroundColor: "rgba(255,255,255,0)",
                },
                {
                    label: 'Detractor',
                    data: totalD,
                    borderColor: '#FF0000',
                    backgroundColor: "rgba(255,255,255,0)",
                }]
        },
        options: {
            responsive: true,
            drawOnChartArea: false,
            plugins: {
                legend: {
                    position: "top"
                }
            }
        }
    });
}

function graphPie(id, satisfecho, insatisfecho, enojado) {

    if (satisfecho == 0 && insatisfecho == 0 && enojado == 0) {
        $('.mg').empty()
        $('.mg').append('<p class="mt-5 mb-5 pb-5 pt-5 mg-text">No hay resultados</p>')
    } else {
        $('.mg').empty()
        $('.mg').append('<canvas id="graphPie" class="mt-4" width="100" height="45"></canvas>')


        var ctx2 = document.getElementById('graphPie').getContext("2d");
        var myBarChart = new Chart(ctx2, {
            type: "pie",
            data: {
                labels: ['Satisfecho', 'Insatisfecho', 'enojado'],
                datasets: [
                    {
                        label: 'Sentimientos',
                        data: [satisfecho, insatisfecho, enojado],
                        backgroundColor: ["#6CFF00", "#FFCD00", "#FF0000"]
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
    }

}

function npsForQustion(ta, deac, nidd, ds, tds) {


    if (ta.length == 0 && deac.length == 0 && nidd.length == 0 && ds.length == 0 && tds.length == 0) {
        $('.mp').empty()
        $('.mp').append('<p class="mt-5 mb-5 pb-5 pt-5 mg-text">No hay resultados</p>')
    } else {
        $('.mp').empty()
        $('.mp').append('<canvas id="nide" class="mt-4" width="100" height="35"></canvas>')


        let taData = []
        let deacData = []
        let niddData = []
        let dsData = []
        let tdsData = []

        let taLb = []
        let deacLb = []
        let niddLb = []
        let dsLb = []
        let tdsLb = []

        ta.forEach(element => {
            taData.push(element.total)
            taLb.push(element.name)
        });

        deac.forEach(element => {
            deacData.push(element.total)
            deacLb.push(element.name)
        });

        nidd.forEach(element => {
            niddData.push(element.total)
            niddLb.push(element.name)
        });

        ds.forEach(element => {
            dsData.push(element.total)
            dsLb.push(element.name)
        });

        tds.forEach(element => {
            tdsData.push(element.total)
            tdsLb.push(element.name)
        });

        let labels = new Set(taLb, deacLb, niddLb, dsLb, tdsLb)

        var ctx2 = document.getElementById("nide").getContext("2d");
        var myChart2 = new Chart(ctx2, {
            type: "horizontalBar",
            data: {
                labels: [...labels],
                datasets: [
                    {
                        label: "Totalmente en desacuerdo",
                        backgroundColor: "#892000",
                        data: tdsData.length > 0 ? tdsData : [0]
                    },
                    {
                        label: "En desacuerdo",
                        backgroundColor: "#E55D0C",
                        data: dsData.length > 0 ? dsData : [0]
                    },

                    {
                        label: "Ni de acuerdo, ni en desacuerdo",
                        backgroundColor: "#FFC141",
                        data: niddData.length > 0 ? niddData : [0]
                    },

                    {
                        label: "De acuerdo",
                        backgroundColor: "#008489",
                        data: deacData.length > 0 ? deacData : [0]
                    },
                    {
                        label: "Totalmente de acuerdo",
                        backgroundColor: "#09DE9D",
                        data: taData.length > 0 ? taData : [0]
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
    }
}

function graficaDeciciones(dataYes, dataNo) {

    if (dataYes.length == 0 && dataNo.length == 0) {
        $('.md').empty()
        $('.md').append('<p class="mt-5 mb-5 pb-5 pt-5 mg-text">No hay resultados</p>')
    } else {
        $('.md').empty()
        $('.md').append('<canvas id="sino" class="mt-4" width="100" height="45"></canvas>')

        let yesData = []
        let noData = []

        let yesLb = []
        let noLb = []


        dataYes.forEach(element => {
            yesData.push(element.total)
            yesLb.push(element.name)
        });

        dataNo.forEach(element => {
            noData.push(element.total)
            noLb.push(element.name)
        });

        let labels = new Set(yesLb, noLb)

        var ctx2 = document.getElementById("sino").getContext("2d");
        var myChart2 = new Chart(ctx2, {
            type: "horizontalBar",
            data: {
                labels: [...labels],
                datasets: [
                    {
                        label: "Si",
                        backgroundColor: "#09DE9D",
                        data: yesData
                    },
                    {
                        label: "No",
                        backgroundColor: "#892000",
                        data: noData
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

    }
}

function drawWordCloudAll(text_string, location, width, height) {

    if (text_string.length == 0) {
        $('.nube-content').empty()
        $('.nube-content').append('<p class="mt-5 mb-5 pb-5 pt-5 mg-text">No hay resultados</p>')
    } else {
        $('.nube-content').empty()
        $('.nube-content').append('<div id="nube"></div>')

        var svg_location = "#nube";
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
            .range([1, 100]);

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
}