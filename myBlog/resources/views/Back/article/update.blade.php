
@extends('back.layouts.master')
@section('title','Yeni Makale')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Yeni Makale</h6>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
            <form method="post" action="{{route('admin.article.update.post')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="hidden" value="{{$article->id}}" name="id">
                    <label>Mamale Başlığı</label>
                    <input type="text" name="title" class="form-control" value="{{$article->title}}" required>
                </div>
                <div class="form-group">
                    <label>Katagori</label>
                    <select name="category" class="form-control" required>
                        <option value="">Seçim Yapın</option>
                        @foreach($categories as $category)
                            <option @if ($category->id == $article->category_id) selected @endif  value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Görsel</label> <br>
                    <img src="{{asset($article->img)}}" class="rounded mb-2" width="200">
                    <input type="file" name="image" class="form-control-file" accept="image/*">
                </div>
                <div class="form-group">
                    <label>İçerik</label>
                    <textarea id="editor" name="conten" class="form-control" rows="5">
                        {{$article->article }}
                    </textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('cs')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editor').summernote(
                {
                    'height':500
                }
            );
        });
    </script>
@endsection

