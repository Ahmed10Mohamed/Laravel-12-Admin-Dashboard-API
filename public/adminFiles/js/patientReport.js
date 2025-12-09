$(document).ready(function () {
    $('#diagnosis_report_id-org').on('change', function () {
        let ids = $(this).val();
        let url = $(this).data('url');

        $.ajax({
            type: 'GET',
            url: url,
            data: { ids: ids },
            success: function (response) {
                $('#selectReport').html(response.html);
                $('#price').val(response.total);
            },
            error: function () {
                $('#selectReport').html('');
                $('#price').val(0);
            }
        });
    });
});

