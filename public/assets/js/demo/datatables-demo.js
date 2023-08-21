// Call the dataTables jQuery plugin
$(document).ready(function () {
    $('#transTable').DataTable({
        'order':[[0, 'desc']]
    });
});
$(document).ready(function () {
  $('#homeTable').DataTable();

});

$(document).ready(function () {
     $('#stockTable').DataTable();
});
$(document).ready(function () {
    $('#productTable').DataTable();
});
$(document).ready(function () {
    $("#clientTable").DataTable();
});


 
