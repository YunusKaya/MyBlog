@extends('front.layouts.master')
@section('title','Anasayfa')
@section('content')

    <div class="container my-5">
        <h1 class="text-center mb-5 font-weight-light  ">
            {{$category_name}}
        </h1>
        <div class="row my-3">
            <div class="col-md-9">
                <div class="row">
                    @foreach($article as $art)
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <img class="card-img-top" src="{{$art->img}}" alt="Card image cap">
                                <div class="card-body">
                                    <p style="text-indent:0px !important; display: block !important;">
                                        <span class="float-left font-italic text-muted">Yazar: {{$art->getUser->name}}</span>
                                        <span class="float-right font-italic text-muted">{{$art->created_at->diffForHumans()}}</span>
                                    </p><br>
                                    <h5 class="card-title">{{$art->title}}</h5>
                                    <p class="card-text">
                                        {!! Str::limit($art->article,100)!!}
                                    </p>
                                    <a href="{{route('articleDetail',$art->slug)}}" class="btn btn-outline-primary rounded-0 float-right">
                                        Devamını Oku
                                    </a>
                                </div>
                                <div class="card-footer">
                                    <p class="card-text"><small class="text-muted">Kategori: {{$art->getCategory->name}}</small></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-header">Katogoriler</div>
                <div class="list-group">
                    @foreach($catagories as $catogory)
                        <li class="list-group-item  @if(Request::segment(1)==$catogory->slug) active @endif ">
                            <a class="text-dark" href="{{route('category',$catogory->slug)}}">
                                {{$catogory->name}}
                            </a>
                            <span class="badge bg-danger float-right text-white">
                                {{$catogory->articleCount()}}
                            </span>
                        </li>
                    @endforeach
                    <li class="list-group-item ">
                        <a class="text-dark" href="{{route('category','tum-makaleler')}}">
                            Tüm Makaleler
                        </a>
                    </li>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            {{$article->links()}}
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
