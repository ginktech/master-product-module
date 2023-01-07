@extends('masterproduct::layouts.master')

@section('content')
    <div class="d-flex justify-content-between">
        <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
            <div id="table-product-buttons" class="btn-group" role="group">
                {{-- <button type="button" class="btn btn-outline-secondary"><i class="fa fa-print"></i></button>
                <button type="button" class="btn btn-outline-secondary"><i class="fa fa-file-pdf"></i></button>
                <button type="button" class="btn btn-outline-secondary"><i class="fa fa-file-excel"></i></button> --}}
            </div>
            <div class="d-none btn-group ms-3" role="group" aria-label="Third group">
                <button type="button" class="btn btn-outline-secondary"><i class="fa fa-database"></i></button>
            </div>
            <div class="d-none input-group ms-1">
                <button type="button" class="btn btn-outline-secondary"><i class="fa fa-download"></i> Export</button>
                <input type="file" class="form-control">
                <button type="button" class="btn btn-outline-secondary"><i class="fa fa-upload"></i> Import</button>
            </div>
        </div>

        <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group me-2" role="group" aria-label="First group">
            </div>
            <div class="btn-group" role="group" aria-label="Second group">
                <a href="{{ route('master-product.brands.create') }}" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Create New</a>
            </div>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <table id="table-product" class="table" width="100%">
                <thead>
                    <tr>
                        {{-- <th><input type="checkbox" class="form-check-input"></th> --}}
                        <th>Logo</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.5.0/css/select.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.bootstrap5.min.css">
@endpush

@push('js')
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/select/1.5.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>
<script>
$(function(){
    'use strict'
    const tableProduct = $('#table-product').DataTable({
        buttons: [
            {
                extend : 'print',
                text : `<i class="fa fa-print"></i>`,
                exportOptions: {
                    columns: [ 1 ]
                }
            },
            {
                extend : 'excelHtml5',
                text : `<i class="fa-regular fa-file-excel"></i>`,
                exportOptions: {
                    columns: [ 1 ]
                }
            },
            {
                extend : 'pdfHtml5',
                text : `<i class="fa-regular fa-file-pdf"></i>`,
                exportOptions: {
                    columns: [ 1 ]
                }
            }
        ],
        // select     : {
        //     style: 'multi',
        //     selector: 'td:first-child > input.form-input-check'
        // },
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, 'All'],
        ],
        serverSide : true,
        processing : true,
        ajax : {
            url : window.location
        },
        order : [[1,'asc']],
        columns : [
            // { 
            //     data : 'id',
            //     width: '20px',
            //     orderable : false,
            //     render(){ return `<input type="checkbox" class="form-check-input">` }
            // },
            { 
                data : 'logo',
                width : '80px',
                className : 'p-1',
                render(data){
                    return `<img src="{{asset('/')}}${data}" style="max-height:30px; max-width:100px;" onerror="this.onerror=null;this.src='https://via.placeholder.com/50?text=Logo'"/>`
                }
            },
            { 
                data : 'name',
                render(data, type, row, meta){
                    return `<a class="fw-bolder" href="{{ route('master-product.brands.index') }}/${row.id}/edit">${data}</a>`;
                }
            }
        ],
        initComplete(){
            tableProduct.buttons().container().appendTo('#table-product-buttons');
            $('#table-product-buttons .btn-secondary').removeClass('btn-secondary').addClass('btn-outline-secondary');
        }
    });
    
});
</script>
@endpush
