document.addEventListener("DOMContentLoaded", function () {
    const statusSelect = document.getElementById("statusSelect");
    const statusForm = document.getElementById("statusForm");

    statusSelect.addEventListener("change", function () {
        const selectedValue = statusSelect.value;
        statusForm.action = 'ongage-stats' + '?domain=' + selectedValue;
        statusForm.submit();
    });

    function getUrlParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    const selectedStatus = getUrlParam('domain');

    if (selectedStatus) {
        statusSelect.value = selectedStatus;
    }

    var viewDomain = selectedStatus ? selectedStatus : 'mg.kn';

    $("#displayDomain").text(viewDomain.toUpperCase());
});