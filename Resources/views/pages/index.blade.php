@extends('masterproduct::layouts.master')

@section('content')
<div class="row">
    @foreach ($counts as $count)
    <div class="col-md-4">
        <a class="card shadow mb-3" href="{{ route($count->route) }}" target="_blank">
            <div class="card-body">
                <h3 class="fw-bolder fs-5 mb-0">{{ $count->title }}</h3>
                <p class="fw-bolder fs-1 mb-0 text-end">{{ $count->volume }}</p>
            </div>
        </a>
    </div>        
    @endforeach
</div>
@endsection