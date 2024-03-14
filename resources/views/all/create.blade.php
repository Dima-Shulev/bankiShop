@extends('layouts.app')
@section('keywords.page'){{__('Форма загрузки избражений')}}@endsection
@section('description.page'){{__('Форма загрузки избражений')}}@endsection
@section('title.page'){{__('Форма загрузки избражений')}}@endsection
@section('content.page')
    <div class="d-flex justify-content-center align-items-center min-vh-100 m-auto">
        <div class="d-flex justify-content-start align-items-start">
            <form action="{{route('all.store')}}" method="post" class="form-control" enctype="multipart/form-data">
            @csrf
                <label for="name" class="mb-2 p-1"><b>{{__('Название файлов:')}}</b></label>
                @for($i=0;$i<5;$i++)
                    <div class="d-flex">
                        <input type="text" name="name[]" id="name" placeholder="{{__('Название файла')}}" class="form-control m-2 p-1"/>
                        <input type="file" name="image[]" placeholder="{{__('Название файла')}}" class="form-control m-2 p-1"/>
                    </div>
                    @endfor
                <input type="submit" name="pushImage" value="{{__('Сохранить на сервер')}}" class="form-control btn btn-primary m-2 p-1" />
            </form>
        </div>
    </div>
@endsection
