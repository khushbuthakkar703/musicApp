$(document).ready(function () {

    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
    var label = [0,5,10];
    var today = new Date();
    var d;
    var month;
    dLabels1 = [0,5,10];

    for (var i = 6; i >= 0; i -= 1) {
        d = new Date(today.getFullYear(), today.getMonth() - i, 1);
        month = monthNames[d.getMonth()];
        dLabels1[6 - i] = month
    }

    //console.log(dLabels1)

    id = $('#campaign_id').val()
    dDatas1 = [0, 0, 0, 0, 0, 0];
    $.get("/campaign/spinhistory?cid="+id, function (json) {
        $.each(json, function (key, value) {

            function findText(element) {
                return element === key;
            }

            dDatas1[dLabels1.findIndex(findText)] = value
        });

        var ctx = document.getElementById("graphmonthlyspin").getContext("2d");
        Chart.defaults.global.legend.display = true;

        options = {
            scales: {
                xAxes: [{
                          stacked: true,
                        gridLines: {
                            display: true,      
                            color: "white",
                    },
                    ticks: {
                        },
                scaleLabel: {
                        display: false,
                }
                }],
                yAxes: [{
                    stacked: true,
                    gridLines: {
                        display: true,
                        color: "white",
                    },
                    ticks: {
                        beginAtZero: false,
                        min: 0,
                        max: 10,
                        stepSize: 5,
                    }
                }],
            },
        }


        ch = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dLabels1,
                datasets: [{
                    data: dDatas1,
                    label: "Total Spins",
                    fill: true,
                    lineTension: 1,
                    color:"rgb(132, 255, 255)",
                    backgroundColor: "transparent",
                    borderColor: "rgb(132, 255, 255)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(60,181,220,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(60,181,220,1)",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 5,
                }]
            },
            options: options
        });
    });
});
