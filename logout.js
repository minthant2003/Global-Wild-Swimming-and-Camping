$(document).ready(function() {
    $('#logout').click(function() {
        $.ajax({
            type: 'POST',
            url: 'logout.php',
            success: function() {
                location.reload();
            }
        });
    })
    $('.mindate').datepicker({ minDate: new Date() })
});