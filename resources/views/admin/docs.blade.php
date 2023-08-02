@extends('admin.index')
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
@section('content')
<div class="row">
     <h1 class="text-center">Hướng dẫn sử dụng</h1>
     <div class="col-lg-12">
       <div class="card">
         <div class="card-body">
          
           <h5 class="card-title">Bước 1: event</h5>

           <p class="card-text">
             Some quick example text to build on the card title and make up the bulk of the card's
             content.
           </p>

           <a href="#" class="card-link">Card link</a>
           <a href="#" class="card-link">Another link</a>
         </div>
       </div>

       <div class="card card-primary card-outline">
         <div class="card-body">
           <h5 class="card-title">Card title</h5>

           <p class="card-text">
             Some quick example text to build on the card title and make up the bulk of the card's
             content.
           </p>
           <a href="#" class="card-link">Card link</a>
           <a href="#" class="card-link">Another link</a>
         </div>
       </div><!-- /.card -->
     </div>
     <!-- /.col-md-6 -->
     <div class="col-lg-12">
       <div class="card">
         <div class="card-header">
           <h5 class="m-0">Featured</h5>
         </div>
         <div class="card-body">
           <h6 class="card-title">Special title treatment</h6>

           <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
           <a href="#" class="btn btn-primary">Go somewhere</a>
         </div>
       </div>

       <div class="card card-primary card-outline">
         <div class="card-header">
           <h5 class="m-0">Featured</h5>
         </div>
         <div class="card-body">
           <h6 class="card-title">Special title treatment</h6>

           <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
           <a href="#" class="btn btn-primary">Go somewhere</a>
         </div>
       </div>
     </div>
     <!-- /.col-md-6 -->
   </div>
@endsection
@section('scripts')
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('.status-select').on('change', function() {
                $(this).closest('form').submit();
            });
        });
    </script>
@endsection
