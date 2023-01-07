@extends('masterproduct::layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <form class="mb-3" method="POST" action="{{ request()->routeIs('master-product.products.edit') ? route('master-product.products.update', ['product'=>$product]) : route('master-product.products.store') }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method((request()->routeIs('master-product.products.edit') ? 'PUT' : 'POST'))
            <div class="d-flex justify-content-between">
                <div>
                    @if (!request()->routeIs('master-product.products.create'))
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-regular fa-trash-can"></i> Delete</button>
                    @endif
                </div>
                <div>
                    <a href="javascript:history.back();" class="btn btn-outline-secondary mb-3 me-1"><i class="fa fa-fw fa-arrow-left"></i> Back</a>
                    <button type="submit" class="btn btn-primary mb-3"><i class="fa-regular fa-fw fa-floppy-disk"></i> Save</button>
                </div>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="">Code</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code',( $product->code ?? '' )) }}">
                        @error('code')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',( $product->name ?? '' )) }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Brand</label>
                        <select id="select-brand" class="form-select @error('brand_id') is-invalid @enderror" name="brand_id"></select>
                        @error('brand_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Category</label>
                        <select id="select-category" class="form-select @error('category_id') is-invalid @enderror" name="category_id"></select>
                        @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </form>
        @if (!request()->routeIs('master-product.products.create'))
        <form method="POST" action="{{ route('master-product.products.destroy',['product'=>$product]) }}" autocomplete="off">
            @csrf
            @method('DELETE')
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteModalLabel">Warning !</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Data will delete pemanently.</p>
                            Are you sure ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-check"></i> Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @endif
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-5-theme/1.3.0/select2-bootstrap-5-theme.min.css" integrity="sha512-z/90a5SWiu4MWVelb5+ny7sAayYUfMmdXKEAbpj27PfdkamNdyI3hcjxPxkOPbrXoKIm7r9V2mElt5f1OtVhqA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(function(){
    'use strict'
    $('form').submit(function(e){
        $(e.target).find('[type="submit"]').html('<i class="fa-solid fa-fw fa-spinner fa-pulse"></i> Processing ..');
    });

    const selectBrand = $('#select-brand').select2({
        width : '100%',
        theme : 'bootstrap-5',
        ajax : {
            url : `{{ route('master-product.helpers.select2') }}`,
            data(params){
                return $.extend({},params,{
                    _method : 'GET',
                    _token : `{{ csrf_token() }}`,
                    model : 'Brand'
                });
            },
            processResults(response) {
                var data = $.map(response.data, function (obj) {
                    obj.text = obj.name;
                    return obj;
                });
                return {
                    results: data,
                    pagination : {
                        more : (data.next_page_url != null)
                    }
                };
            }
        }
    }),
    selectCategory = $('#select-category').select2({
        width : '100%',
        theme : 'bootstrap-5',
        ajax : {
            url : `{{ route('master-product.helpers.select2') }}`,
            data(params){
                return $.extend({},params,{
                    _method : 'GET',
                    _token : `{{ csrf_token() }}`,
                    model : 'Category'
                });
            },
            processResults(response) {
                var data = $.map(response.data, function (obj) {
                    obj.text = obj.name;
                    return obj;
                });
                return {
                    results: data,
                    pagination : {
                        more : (data.next_page_url != null)
                    }
                };
            }
        }
    });
});
</script>
@endpush
