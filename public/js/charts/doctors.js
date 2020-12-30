const charts = Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Medicos mas activos'
    },

    xAxis: {
        categories: [],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Citas Atendidas'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    series: []
});
let $start, $end;

function fetchData() {
    const startDate = $start.val();
    const endDate = $end.val();
    const url = `/charts/doctors/column/data?start=${startDate}&enddate=${endDate}`;

    fetch(url)
        .then(response=>  response.json())
        .then(data => {
            //  console.log(data)
            if (charts.series.length > 0) {
                charts.series[1].remove();
                charts.series[0].remove();
            }
            charts.xAxis[0].setCategories(data.categories);
            charts.addSeries(data.series[0]);
            charts.addSeries(data.series[1]);
        });
}
$(function () {
    $start = $('#startDate');
    $end = $('#endDate');
    fetchData();
    $start.change(function() {
        fetchData();
    });

    $end.change(function() {
        fetchData();
    });
});
