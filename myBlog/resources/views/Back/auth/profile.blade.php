
@extends('back.layouts.master')
@section('title','Profil Bilgileri')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Profil Bilgileri</h6>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
            <form method="post" action="{{route('admin.profile.post')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label>Adı Soyadı</label>
                            <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}" required>
                        </div>
                        <div class="form-group">
                            <label>Profil Resmi</label> <br>
                            <img src="{{asset(Auth::user()->img)}}" class="rounded mb-2" width="200">
                            <input type="file" name="image" class="form-control-file" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label>Arka Plan Resmi</label> <br>
                            <img src="{{asset(Auth::user()->borderimg)}}" class="rounded mb-2" width="200">
                            <input type="file" name="borderImage" class="form-control-file" accept="image/*">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label>E-Posta</label>
                            <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}" required  >
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <input type="text" name="role" class="form-control" value="{{Auth::user()->role}}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Biografi</label>
                            <textarea id="editor" name="conten" class="form-control" rows="10">
                                {{Auth::user()->biography}}
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
@endsection


