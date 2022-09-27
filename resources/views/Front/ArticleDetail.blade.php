@extends('front.layouts.master')
@section('title','Anasayfa')
@section('content')
    <div class="container">
        <div class="row mt-5 mb-3">
            <div class="col-md-9">
                <img src="{{asset( $article->img)}}" class="img-fluid" style="width: 100%">
                <div class="d-block py-1" style="font-size: 16px ">
                    <span class="float-right font-italic text-muted">Kategori: {{$article->getCategory->name}}</span>
                    <span class="float-left font-italic text-muted">Yazar: {{$article->getUser->name}}</span>
                    <br>
                    <span class="float-right font-italic text-muted ">{{$article->created_at->diffForHumans()}}</span>

                </div>
            </div>
            <div class="col-md-3">
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <h1>{{$article->title}}</h1>
                {!! $article->article !!}
            </div>
        </div>
    </div>
@endsection
