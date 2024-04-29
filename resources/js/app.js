import './bootstrap';
import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

// import DataTable from 'datatables.net-dt';
import DataTable from 'datatables.net-bs5';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';

// Inisialisasi DataTables
$(document).ready(function() {
    $('#dataset-table').DataTable({
        autoWidth: false, // Menghentikan DataTables untuk mengatur lebar kolom secara otomatis
        

    });
});


$(document).ready(function() {
    $('#preprocessing-table').DataTable();
});