


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        $('#img-thumb_130').show();

        reader.onload = function (e) {
            $('#img-thumb_130').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$('#data-table').DataTable();

$('[data-toggle="tooltip"]').tooltip(); 


