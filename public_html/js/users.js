$(document).ready(function() {
    $('#dataTables-example').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "../php/users.php"
    } );
} );