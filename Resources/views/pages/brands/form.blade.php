@extends('masterproduct::layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <form class="mb-3" method="POST" action="{{ request()->routeIs('master-product.brands.edit') ? route('master-product.brands.update', ['brand'=>$brand]) : route('master-product.brands.store') }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method((request()->routeIs('master-product.brands.edit') ? 'PUT' : 'POST'))
            <div class="d-flex justify-content-between">
                <div>
                    @if (!request()->routeIs('master-product.brands.create'))
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
                    <div class="row align-items-center mb-3">
                        <div class="col-4">
                            <div class="text-center">
                                <img src="{{ asset(($brand->logo ?? 'https://via.placeholder.com/300x200?text=Logo')) }}" class="mw-100" style="max-height:100px;" onerror="this.src='https://via.placeholder.com/300x200?text=Logo'">
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <label for="">Logo</label>
                                <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo">
                                @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror        
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Name</label>
                        <input autofocus type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',( $brand->name ?? '' )) }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </form>
        @if (!request()->routeIs('master-product.brands.create'))
        <form method="POST" action="{{ route('master-product.brands.destroy',['brand'=>$brand]) }}" autocomplete="off">
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
@endpush

@push('js')
<script>
$(function(){
    'use strict'
    $('form').submit(function(e){
        $(e.target).find('[type="submit"]').html('<i class="fa-solid fa-fw fa-spinner fa-pulse"></i> Processing ..');
    });
});
</script>
@endpush
