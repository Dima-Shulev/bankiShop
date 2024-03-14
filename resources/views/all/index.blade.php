@extends('layouts.app')
@section('keywords.page'){{__('Онлайн хостинг изображений')}}@endsection
@section('description.page'){{__('Онлайн хостинг изображений')}}@endsection
@section('title.page'){{__('Онлайн хостинг изображений')}}@endsection
@section('content.page')
    <h1 class="text-center mb-4">{{__('Мой хостинг загруженных изображений')}}</h1>
    {{--<div class="d-flex justify-content-center align-items-center">--}}
    <x-filter.filter />
    {{--</div>--}}
    <x-message.message />
@if(isset($allImages))
    <div class="container form-control">
        <div class="d-flex flex-column justify-content-between align-items-between">
            <div class="d-flex justify-content-around align-items-between">
                <div class="block"><b>{{__('Название файла')}}</b></div>
                <div class="block"><b>{{__('Дата загрузки')}}</b></div>
                <div class="block"><b>{{__('Изображение')}}</b></div>
                <div class="block"><b>{{__('Скачать')}}</b></div>
            </div>
            <hr>
        @foreach($allImages as $image)
            <div class="d-flex justify-content-around align-items-between">
                <div class="block"><b>{{$image->name}}</b></div>
                <div class="block"><b>{{$image->created_at}}</b></div>
                <div class="block"><a href="{{asset("images/".$image->path)}}"><img src="{{asset("images/".$image->path )}}" alt="{{__('Предпросмотр')}}" title="{{__('Оригинал')}}" width="100px" height="100px" class="m-1"></a></div>
                <div class="block"><a href="{{route("all.saveImage",['path'=>$image->path])}}"><img src="{{asset("images/save.webp")}}" alt="{{__('Скачать ZIP')}}" title="{{__('Скачать ZIP')}}" class="m-1"></a></div>
            </div>
            <hr>
        @endforeach
        </div>
    </div>
@else
    <div class="container">
        <h3>{{__('Пока нет ни одного изображения !')}} </h3>
    </div>
@endif
@endsection
