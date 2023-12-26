as.dashboard = {};

as.dashboard.datasource4initChart = function () {

  $.ajax({
    url: '/showdata',
    type: 'GET',
    dataType: 'json',
    beforeSend: function () {
      const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
      });
      Toast.fire({
        icon: "info",
        html: '<i class="fas fa-spinner fa-spin"></i> Loading...'
      });
    },
    success: function (chartData) {
      var tableData = {};
      var tableid = {};
      var tabledataname = {};

      $.each(chartData, function (index, item) {
        var group = item.data_source.datasource_description;
        var groupid = item.datasource_id;
        var groupdatasource = item.data_source.datasource_table;

        if (!tableData[group]) {
          tableData[group] = [];
        }

        if (!tableid[groupid]) {
          tableid[groupid] = [];
        }

        if (!tabledataname[groupdatasource]) {
          tabledataname[groupdatasource] = [];
        }
        var datasource = {
          record_count: "" + item.datacnt + "",
          report_date: "" + item.report_date + ""
        };

        tableData[group].push(datasource);
        tableid[groupid].push(item.datasource_id);
        tabledataname[groupdatasource].push(item.data_source.datasource_table);
      });

      var zeroCountTables = ["dataencortexgmyahm", "dataflex6mo", "dataflex6mo", "dataflex6mo"];
      var tableNames = Object.keys(tableData);
      var currentDates = {};
      var chartInstances = [];
      var skipTables = ['datasource_reports', 'dataknresponders']; // Tables to skip
      var charbg = [];
      var dataIdtable = Object.keys(tableid);
      var datasourcetablename = Object.keys(tabledataname);

      tableNames.forEach(function (tableName) {
        var dates = tableData[tableName].map(function (row) {
          return row['report_date'];
        });
        currentDates[tableName] = dates[dates.length - 7];

        charbg.push('#d40682');
      });



      function drawChart(tableName, index) {
        var ctx = document.getElementById('chart' + index).getContext('2d');
        var data = tableData[tableName].filter(function (row) {

          return row['report_date'] >= currentDates[tableName];
        });

        var chartData = data.map(function (row) {

          return row['record_count'];
        }).slice(0, 7);
        var labels = data.map(function (row) {
          return row['report_date'];
        }).slice(0, 7);

        var barData = {
          label: 'Incoming',
          data: chartData,
          backgroundColor: charbg[index],
          type: 'bar',
        };

        var lineData = {
          label: 'Outgoing',
          data: chartData,
          borderColor: charbg[index],
          type: 'line',
          fill: false,
        };

        if (chartInstances[index]) {
          chartInstances[index].destroy();
        }

        chartInstances[index] = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: labels,
            datasets: [barData, lineData]
          },
          options: {
            responsive: true,
            maintainAspectRatio: true,
            animation: {
              duration: 1000,
              easing: 'easeOutQuart',
            },
            title: {
              display: true,
              text: dataIdtable[index] + ' | ' + datasourcetablename[index] + ' | ' + tableName.toUpperCase(),
              fontSize: 24
            },
            legend: {
              display: true,
              position: 'top',
            },
          }
        });

      }

      var chartContainer = document.getElementById('chartContainer');

      tableNames.forEach(function (tableName, index) {
        if (skipTables.includes(tableName)) {
          return;
        }

        if (zeroCountTables.includes(tableName)) {
          return;
        }

        var chartDiv = document.createElement('div');
        chartDiv.classList.add("chartDiv");

        var canvas = document.createElement('canvas');
        canvas.id = 'chart' + index;
        chartDiv.appendChild(canvas);

        var buttonContainer = document.createElement('div');
        buttonContainer.classList.add('buttonContainer');

        var prevButton = document.createElement('button');
        prevButton.classList.add('prevButton');
        var prevIcon = document.createElement('i');
        prevIcon.classList.add('fas', 'fa-arrow-left');
        prevButton.appendChild(prevIcon);
        prevButton.addEventListener('click', function () {
          currentDates[tableName] = new Date(new Date(currentDates[tableName]).setDate(new Date(currentDates[tableName]).getDate() - 1)).toISOString().split('T')[0];
          drawChart(tableName, index);
        });
        buttonContainer.appendChild(prevButton);

        var nextButton = document.createElement('button');
        nextButton.classList.add('nextButton');
        var nextIcon = document.createElement('i');
        nextIcon.classList.add('fas', 'fa-arrow-right');
        nextButton.appendChild(nextIcon);
        nextButton.addEventListener('click', function () {
          currentDates[tableName] = new Date(new Date(currentDates[tableName]).setDate(new Date(currentDates[tableName]).getDate() + 1)).toISOString().split('T')[0];
          drawChart(tableName, index);
        });
        buttonContainer.appendChild(nextButton);

        var filterButton = document.createElement('a');
        filterButton.classList.add("btn-success");
        filterButton.classList.add('buttonfilterright');
        filterButton.textContent = 'Filter Data';
        filterButton.style.textDecoration = 'none';
        filterButton.setAttribute('href', '/filtertable/' + dataIdtable[index]);

        buttonContainer.appendChild(filterButton);

        chartDiv.appendChild(buttonContainer);

        chartContainer.appendChild(chartDiv);
        drawChart(tableName, index);
      });
    },
    error: function (xhr, status, error) {
      console.error(error);

      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: error,
      });
    },
    complete: function () {
      Swal.close();
    }
  });

};

$(document).ready(function () {
  as.dashboard.datasource4initChart();
});
