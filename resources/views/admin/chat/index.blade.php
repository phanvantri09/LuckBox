@extends('admin.index')
@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link href="css/app.css" rel="stylesheet">
@endsection
@section('content')
    <section style="background-color: #CDC4F9;">
        <div class="container py-5">

            <div class="row">
                <div class="col-md-12">

                    <div class="card" id="chat3" style="border-radius: 15px;">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">

                                    <div class="p-3">

                                        <div class="input-group rounded mb-3">
                                            <input id="searchInput" type="search" class="form-control rounded" placeholder="Tìm kiếm..." aria-label="Search"
                                                   aria-describedby="search-addon" />
                                            <span class="input-group-text border-0" id="search-addon">
                                              <i class="fas fa-search"></i>
                                            </span>
                                        </div>

                                        <div class="user-list" data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px">
                                            <ul id="listUserChat" class="list-unstyled mb-0">

                                            </ul>
                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-6 col-lg-7 col-xl-8">

                                    <div class="user-list pt-3 pe-3" data-mdb-perfect-scrollbar="true"
                                         style="position: relative; height: 400px">

                                        <div id="messageOutputAdmin" >

                                        </div>

                                    </div>

                                    <form id="chatFormAdmin" class="text-muted d-flex justify-content-start align-items-center pe-3 pt-3 mt-2">
                                        <input type="text" class="form-control form-control-lg" id="messageAdmin"
                                               placeholder="Nhập tin nhắn...">
                                        <button class="btn" type="button submit" style="padding-top: .55rem;">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
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
        });
    </script>
    <script src="./js/app.js"></script>
@endsection
