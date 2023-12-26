$(document).ready(function () {
  displayfields(null, null);

  $('.selectedCriteria').hide();

  function displayfields($textselected, $valselected) {

    var selectedValue = $valselected === null ? 'string' : $valselected;
    var selectedText = $textselected === null ? $('#selectFilter').find('option:selected').text() : $textselected;
    var selectFields = $('#selectFields');
    var selectConditions = $('#selectCondition');
    var selectedDataCondition = [];

    var urlbase = window.location.href;
    var url = new URL(urlbase);
    var baseUrl = `${url.protocol}//${url.host}/`;

    var path = '/' + urlbase.replace(baseUrl, 'get');

    $.ajax({
      url: path,
      type: 'GET',
      data: { selectedvalue: selectedValue },
      dataType: 'json',
      beforeSend: function () {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
        });
        Toast.fire({
          html: '<i class="fas fa-spinner fa-spin"></i> Loading...'
        });
      },
      success: function (res) {
        selectFields.empty();

        selectFields.append('<option selected disabled>Select ' + selectedText + ' Field</option>');

        if (selectedText === "Behavioral") {
          var newOptions = [
            {
              value: "opens",
              text: "Opened",
            },
            {
              value: "clicks",
              text: "Clicks",
            }
          ];

          $.each(newOptions, function (index, option) {
            var newOption = $('<option>', option);
            selectFields.append(newOption);
          });

        } else {
          $.each(res.columntype, function (index, item) {
            var newOption = $('<option>', {
              value: index,
              text: index
            });
            selectFields.append(newOption);
          });
        }


        $.each(res.colunmalltype, function (index, item) {

          if (index !== 'id' && index !== 'created_at' && index !== 'updated_at') {
            var newRowavailfields = $('<tr>');
            newRowavailfields.append('<td data-type="' + item + '">' + index + '</td>');
          }

          $('#availableFields tbody').append(newRowavailfields);
        });

        switch (selectedText) {
          case "Numeric":
            selectedDataCondition.push({ '<': 'is lower than', '<=': 'is lower than or equals', '>=': 'is greater than or equals', '>': 'is greater than', '=': 'equals', '!=': 'is different from' });
            break;
          case "Behavioral":
            selectedDataCondition.push({ '>': 'More Than', '>=': 'ANY' });
            break;
          default:
            selectedDataCondition.push({ '=': 'equals', '!=': 'not equals', 'LIKE': 'contains', 'NOT LIKE': 'does not contain' });
        }

        selectConditions.empty();

        $.each(selectedDataCondition[0], function (index, item) {
          var newOption1 = $('<option>', {
            value: index,
            text: item
          });
          selectConditions.append(newOption1);
        });

        // $('#selectedCriteriaTable tbody').empty();
        // $('.selectedCriteria').hide();
      },
      complete: function () {
        Swal.close();
      },
      error: function (xhr, status, error) {
        console.error(error);
      }
    });

  }

  //change filter

  $('#selectFilter').change(function () {

    var selectedValue = $(this).val();
    var selectedText = $(this).find('option:selected').text();

    displayfields(selectedText, selectedValue);


  });

  // change condition

  $('#selectCondition').change(function () {
    var selectedText = $(this).find('option:selected').text();

    $('#valueSelected').prop('disabled', false);

    if (selectedText == "ANY") {
      $('#valueSelected').prop('disabled', true);
    }

  });

  // add filter

  $("#addButton").click(function () {
    var selectfields = $('#selectFields');
    var selectconditions = $('#selectCondition');
    var selectvalue = $('#valueSelected');
    var datatablename = $('#datatableName').text();
    var selectedFilter = $('#selectFilter').val();

    if (selectfields.val() === '' || selectfields.val() === null) {
      selectfields.addClass('is-invalid');
      return false;
    } else {
      selectfields.removeClass('is-invalid');
    }

    if (selectvalue.val() === '' && selectconditions.val() != '>=') {
      selectvalue.addClass('is-invalid');
      return false;
    } else {
      selectvalue.removeClass('is-invalid');
    }

    var selectedValue = selectvalue.val();
    if (selectconditions.val() == "LIKE" || selectconditions.val() == "NOT LIKE") {
      selectedValue = "%" + selectvalue.val() + "%";
    }

    if (selectconditions.val() == ">=") {
      selectedValue = 0;
    }

    $('.selectedCriteria').show();

    var newRow = $('<tr>');
    if (selectedFilter === "behavioral") {
      newRow.append('<td data-fields="' + selectfields.val() + '" data-condition="' + selectconditions.val() + '"data-value="' + selectedValue + '"><span style="font-weight: bold;"> ' + selectfields.val().toUpperCase() + ' </span>' + $('#selectCondition').find('option:selected').text() + ' "' + selectvalue.val() + '"</td>');
      newRow.append('<td> <a class="delete-criteria" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"> <i class="fas fa-trash"></i></a></td>');
    } else {
      newRow.append('<td data-fields="' + datatablename + '.' + selectfields.val() + '" data-condition="' + selectconditions.val() + '"data-value="' + selectedValue + '"><span style="font-weight: bold;"> ' + selectfields.val().toUpperCase() + ' </span>' + $('#selectCondition').find('option:selected').text() + ' "' + selectvalue.val() + '"</td>');
      newRow.append('<td> <a class="delete-criteria" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"> <i class="fas fa-trash"></i></a></td>');
    }

    $('#selectedCriteriaTable tbody').append(newRow);

    selectvalue.val('');

  });

  $('#selectedCriteriaTable tbody').on('click', '.delete-criteria', function () {
    var row = $(this).closest('tr');

    row.remove();
  });

  var selectedrowData = "";
  var selectedrowDataType = "";

  $('#availableFields tbody').on('click', 'tr', function () {
    $('#availableFields tbody tr').removeClass('selected');

    $(this).addClass('selected');

    selectedrowData = $(this).find('td').map(function () {
      return $(this).text();
    }).get();

    selectedrowDataType = $(this).find('td').map(function () {
      return $(this).attr('data-type');
    }).get();

  });

  // add selected fields

  $("#addselectedFields").click(function () {
    if (selectedrowData == "") {
      return false;
    }

    if (selectedrowDataType == "") {
      return false;
    }

    var newRow = $('<tr>');
    newRow.append('<td data-typeselected="' + selectedrowDataType + '">' + selectedrowData + '</td>');

    var rowExists = false;
    $('#selectedTableFields tbody tr').each(function () {
      var existingRowContent = $(this).find('td:first').text();

      if (existingRowContent == selectedrowData) {
        rowExists = true;
        return false;
      }
    });

    if (!rowExists) {
      $('#selectedTableFields tbody').append(newRow);
    } else {
      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
      });
      Toast.fire({
        icon: "info",
        title: "This fields was already selected"
      });
    }
  });

  // Remove all fields 

  var selectedrowDataRemove = "";

  $('#selectedTableFields tbody').on('click', 'tr', function () {
    $('#selectedTableFields tbody tr').removeClass('selected');

    $(this).addClass('selected');

    selectedrowDataRemove = $(this).find('td').map(function () {
      return $(this).text();
    }).get();
  });

  $("#addselectedFieldsRemove").click(function () {
    if (selectedrowData == "") {
      return false;
    }

    $('#selectedTableFields tbody tr').each(function () {
      var existingRowContent = $(this).find('td:first').text();

      if (existingRowContent == selectedrowDataRemove) {
        $(this).remove();
        return false;
      }
    });

  });

  // add all fields

  $("#addselectedFieldsAll").click(function () {

    $('#selectedTableFields tbody').empty();

    $('#availableFields tbody tr').each(function () {
      var addallfields = $(this).find('td:first').text();
      var addalltypes = $(this).find('td').attr('data-type');

      if (addallfields != "") {
        var newRow = $('<tr>');
        newRow.append('<td data-typeselected="' + addalltypes + '">' + addallfields + '</td>');
      }

      $('#selectedTableFields tbody').append(newRow);
    });

  });

  // Remove all selected fields

  $("#addselectedFieldsRemoveAll").click(function () {

    $('#selectedTableFields tbody').empty();
  });

  // Generate view report

  $("#generateViewReport").click(function () {
    var dateFrom = $('#dateFrom');
    var dateTo = $('#dateTo');
    var combine = $('#selectedcombine');
    var dataArrayCriteria = [];
    var dataArrayFieldSelected = [];

    if (dateFrom.val() === '' || dateFrom.val() === null) {
      dateFrom.addClass('is-invalid');
      return false;
    } else {
      dateFrom.removeClass('is-invalid');
    }

    if (dateTo.val() === '' || dateTo.val() === null) {
      dateTo.addClass('is-invalid');
      return false;
    } else {
      dateTo.removeClass('is-invalid');
    }

    if ($('#selectedCriteriaTable tbody tr td').length > 0) {
      $('#selectedCriteriaTable tbody tr td').each(function () {
        var fieldResults = [$(this).attr('data-fields'), $(this).attr('data-condition'), $(this).attr('data-value')];
        dataArrayCriteria.push(fieldResults);
      });
    }

    if ($('#selectedTableFields tbody tr td').length > 0) {
      $('#selectedTableFields tbody tr td').each(function () {
        var textvalue = $(this).text() + ':' + $(this).attr('data-typeselected');
        dataArrayFieldSelected.push(textvalue);
      });
    } else {
      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
      });
      Toast.fire({
        icon: "warning",
        title: "Please add selected fields."
      });
      return false;
    }

    var urlbase = window.location.href;
    var url = new URL(urlbase);
    var baseUrl = `${url.protocol}//${url.host}/`;

    var path = '/' + urlbase.replace(baseUrl, 'post');

    $.ajax({
      url: path,
      type: 'POST',
      data: {
        datefrom: dateFrom.val(),
        dateto: dateTo.val(),
        combinedata: combine.val(),
        datacriteria: dataArrayCriteria,
        datafieldselected: dataArrayFieldSelected
      },
      dataType: 'json',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (res) {
        if (res.status === 'success') {
          window.location.href = '/analytics/contact/search_list';
        }
      },
      complete: function () {
        Swal.close();
      },
      error: function (xhr, status, error) {
        console.error(error);
      }
    });

  });
});
