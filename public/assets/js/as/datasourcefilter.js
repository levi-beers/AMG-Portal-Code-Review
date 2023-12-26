as.dashboard = {};

as.dashboard.datasourceinitChart = function () {

  $('#btnapplyFilter').click(function () {
    var startDate = moment($('#startdate').val()).format('YYYY-MM-DD');
    var endDate = moment($('#enddate').val()).format('YYYY-MM-DD');

    $.ajax({
      url: '/showfilter/'.id,
      type: 'GET',
      data: { startDate: startDate, endDate: endDate },
      dataType: 'json',
      success: function (res) {
        
        var labelName = "";

        if (res[0].datasource.datasource_table != '' || res[0].datasource.datasource_table != null) {
          labelName = res[0].datasource.datasource_table;
        }

        var datavalue = [];

        var chartData = {
          labels: [],
          datasets: [{
            label: labelName.toUpperCase(),
            data: datavalue,
            backgroundColor: '#007bff',
            borderColor: 'transparent',
            tension: 0,
            fill: false
          }]
        };

        $.each(res, function (index, item) {
          chartData.labels.push(item.report_date);
          datavalue.push(item.datacnt);
        });

        var options = {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: {
              beginAtZero: true,
              gridLines: {
                drawOnChartArea: false
              },
            },
            x: {
              gridLines: {
                drawOnChartArea: false
              },
            },
            xAxes: [{
              scaleLabel: {
                display: true
              }
            }],
            yAxes: [{
              gridLines: {
                drawOnChartArea: false
              },
              scaleLabel: {
                display: true
              }
            }]
          },
        };

        var ctx = $('#datasourceChart')[0].getContext('2d');

        var chart = new Chart(ctx, {
          type: 'bar',
          data: chartData,
          options: options
        });

      },
      error: function (xhr, status, error) {
        console.error(error);
      }
    });
  });

};

$(document).ready(function () {

  $("#startdate, #enddate").datepicker();

  as.dashboard.datasourceinitChart();

});
