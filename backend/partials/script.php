<!-- jQuery dulu -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="../../template-admin/public/graindashboard/js/graindashboard.js"></script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
<!-- Graindashboard (vendor -> core) -->

<script src="../../template-admin/public/graindashboard/js/graindashboard.vendor.js"></script>



<script>
$(document).ready(function() {
    // Init GDUnfold dropdown
   if ($.GDCore && $.GDCore.components && $.GDCore.components.GDUnfold) {
    $.GDCore.components.GDUnfold.init($('[data-unfold-target]'));
}
    // Sidebar toggle
    $('#sidebarToggle, .js-side-nav').on('click', function(e){
        e.preventDefault();
        $('#sidebar').toggleClass('collapsed'); // pastikan sidebar punya ID sidebar
    });
});
</script>


<script>
    $(document).ready(function () {
    $('.js-side-nav').on('click', function(e){
        e.preventDefault();
        $('body').toggleClass('side-nav-opened'); // pakai class ini untuk CSS
    });
});

</script>


<!-- Init DataTables -->
 <script>
$('#tabelBuku').DataTable({
    responsive: true,
    paging: true,   // <--- wajib biar Previous/Next muncul
    pageLength: 5,  // <--- default tampil 5 baris
    dom: 'Bfrtip',
    buttons: [
        { extend: 'copy', className: 'btn btn-secondary btn-sm', text: '<i class="fas fa-copy"></i> Copy' },
        { extend: 'csv', className: 'btn btn-info btn-sm', text: '<i class="fas fa-file-csv"></i> CSV' },
        { extend: 'excel', className: 'btn btn-success btn-sm', text: '<i class="fas fa-file-excel"></i> Excel' },
        { extend: 'pdf', className: 'btn btn-danger btn-sm', text: '<i class="fas fa-file-pdf"></i> PDF', orientation: 'landscape', pageSize: 'A4' },
        { extend: 'print', className: 'btn btn-primary btn-sm', text: '<i class="fas fa-print"></i> Print' }
    ],
    language: {
        url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json"
    }
});

</script>



