@extends('app')
@section('content')
    <h1 class="mt-3">Все изображения</h1>
    <table class="table">
        <tr>
            <th>@sortablelink('name', 'Название')</th>
            <th>@sortablelink('created_at', 'Дата и время загрузки')</th>
            <th>Изображение</th>
            <th><i class="fa fa-download"></i></th>
        </tr>
        @foreach($images as $image)
        <tr>
            <td>{{ $image->name }}</td>
            <td>{{ $image->created_at }}</td>
            <td><img data-enlargeable  style="object-fit: cover; cursor: zoom-in" height="50px" width="50px" src="{{ asset('uploads/' . $image->name) }}" alt="Превью изображения"></td>
            <td><a href="{{route('download', ['filename' => $image->name])}}">Скачать в zip</a></td>
        </tr>
        @endforeach
        
    </table>



@endsection