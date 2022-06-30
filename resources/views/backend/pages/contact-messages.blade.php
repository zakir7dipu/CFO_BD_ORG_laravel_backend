@extends("backend.layouts.master")

@section("page-css")
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.3/b-flash-1.6.3/b-html5-1.6.3/b-print-1.6.3/fc-3.3.1/fh-3.1.7/r-2.2.5/sc-2.0.2/datatables.min.css"/>
    <style>
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }
    </style>
@endsection

@section("content")
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <span class="d-none" id="datatable-export-file-name">file</span>
                            <table class="table table-responsive datatable">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Subject</td>
                                    <td>Option</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($messages as $key=>$message)
                                <tr>
                                    <th>{{ $key+1 }}</th>
                                    <td>{!! $message->first_name." ".$message->last_name !!}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->subject }}</td>
                                    <td>
                                        <button class="btn btn-info viewMessage" data-action="{{ route('message.show',$message->id) }}">View</button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="popUpModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

            </div>
        </div>
    </div>
@endsection

@section("page-script")
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/b-1.6.3/b-flash-1.6.3/b-html5-1.6.3/b-print-1.6.3/fc-3.3.1/fh-3.1.7/r-2.2.5/sc-2.0.2/datatables.min.js"></script>
    <script>
       $(document).ready(()=>{
           var datatable_file_name = $('#datatable-export-file-name').text();
           $('.datatable').DataTable({
           lengthMenu: [
               [ 5,10, 25, 50, 100, -1 ],
               [ '5 rows', '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
           ],

           iDisplayLength: 10,
           sScrollX: "100%",
           sScrollXInner: "100%",
           scrollCollapse: true,

           dom: 'Bfrtip',
           buttons: [
               'pageLength',
               {
                   extend: 'copy',
                   title: datatable_file_name
               },
               {
                   extend: 'print',
                   title: datatable_file_name
               },
               {
                   extend: 'csv',
                   filename: datatable_file_name
               },
               {
                   extend: 'excel',
                   filename: datatable_file_name
               },
               {
                   extend: 'pdf',
                   filename: datatable_file_name
               },
           ]
       });

       $('.buttons-collection').addClass('btn-sm');
       $('.buttons-copy').removeClass('btn-secondary').addClass('btn-sm btn-warning').html('<i class="fas fa-copy"></i>');
       $('.buttons-csv').removeClass('btn-secondary').addClass('btn-sm btn-success').html('<i class="fas fa-file-csv"></i>');
       $('.buttons-excel').removeClass('btn-secondary').addClass('btn-sm btn-primary').html('<i class="far fa-file-excel"></i>');
       $('.buttons-pdf').removeClass('btn-secondary').addClass('btn-sm btn-info').html('<i class="fas fa-file-pdf"></i>');
       $('.buttons-print').removeClass('btn-secondary').addClass('btn-sm btn-dark').html('<i class="fas fa-print"></i>');
       })
    </script>

    <script>
        (function ($) {
            "use script";
            // popUpModal
            let viewMessage = document.querySelectorAll(".viewMessage")
            viewMessage.forEach(button=>{
                button.addEventListener('click', ()=>{
                    $.ajax({
                        type: "get",
                        url: button.getAttribute("data-action"),
                        success:data=>{
                            $('#popUpModal .modal-content').empty().append(data);
                            $('#popUpModal').modal("show");
                            onInputImageShow()
                        }
                    })
                })
            })
        })(jQuery)
    </script>
@endsection
