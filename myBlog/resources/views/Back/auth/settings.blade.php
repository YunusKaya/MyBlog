
@extends('back.layouts.master')
@section('title','Şifre İşlemleri')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Şifre İşlemleri</h6>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
            <form method="post" action="{{route('admin.settings.post')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label>E-Posta</label>
                            <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}" required  >
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label>Şifre</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" style="max-width: 150px">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
@endsection


