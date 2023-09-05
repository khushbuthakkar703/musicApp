$(document).ready(function()
{

    dLabels = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']
    dDatas = [0,0,0,0,0,0,0]
    $.get("/djmanager/data/weeklyactivity/0", function( json ) {
        $.each(json, function(key, value){
            function findText(element) {
                return element == value.date;
            }

            dDatas[dLabels.findIndex(findText)] = value.views
        });

    var ctx = document.getElementById("chart-example-bar").getContext('2d');
    
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: dLabels,
            datasets: [{
                data: dDatas,
                label: "Spin Totals",
                backgroundColor: "rgba(60,181,220,0.2)",
                borderColor: "rgba(60,181,220,1)",
                borderWidth: 1,
                hoverBackgroundColor: "rgba(60,181,220,0.4)",
                hoverBorderColor: "rgba(60,181,220,1)",
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
});


});

$(document).ready(function()
{

    dLabels1 = ['January','February','March','April','May','June','July','August','September','October','November','December']
    dDatas1 = []
    $.get("/djmanager/data/yearlyactivity/0", function( json ) {
        $.each(json, function(key, value){
            function findText(element) {
                return element == value.date;
            }

            dDatas1[dLabels1.findIndex(findText)] = value.views
        });

    var ctx = document.getElementById("chart-example-line").getContext('2d');
    
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dLabels1,
            datasets: [{
                data: dDatas1,
                label: "Spin Totals",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(60,181,220,0.4)",
                borderColor: "rgba(60,181,220,1)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "rgba(60,181,220,1)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(60,181,220,1)",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
});
});
