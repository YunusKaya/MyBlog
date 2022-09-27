@extends('front.layouts.master')
@section('title','Anasayfa')
@section('content')
    <div class="container">
        <div class="row">
            @foreach($writers as $writer)
                <div class="col-md-4 mt-5">
                    <div class="card">
                        <img class="card-img-top" src="{{$writer->borderimg}} " style="max-height: 170px" alt="Bologna">
                        <div class="card-body text-center">
                            <img class="avatar rounded-circle" src="{{$writer->img}}" style="max-width: 100px; margin-top: -4.5rem" alt="Bologna">
                        </div>
                        <div class="card-body pb-3" style="margin-top: -1rem">
                            <h4 class="card-title">
                                {{$writer->name}}
                            </h4>
                            <p class="card-text">{{Str::limit($writer->biography,170)}}</p>
                            <a href="#" class="btn btn-outline-info">Profil</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row d-flex justify-content-center">
            {{$writers->links()}}
        </div>
    </div>
@endsection

@section('front-cs')
    <style>
        .flex-1
        {
            display: none !important;
        }
        .text-sm
        {
            text-align: center !important;
        }
        svg
        {
            width: 20px !important;
            height: 20px !important;
        }
    </style>
@endsection
