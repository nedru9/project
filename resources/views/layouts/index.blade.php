@extends('app')
@section('content')
    <h1 class="mt-3 mb-3">Загрузите изображения</h1>
    @if(session('success'))
    <div class="alert alert-success mb-3">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
        <div class="alert alert-danger mb-3">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{route('form')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input class="form-control" type="file" name="images[]" multiple>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Загрузить</button>
        </div>
    </form>
@endsection