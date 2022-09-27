

@extends('front.layouts.master')
@section('title','İletişim')
@section('content')
    <div class="container my-5">
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>
                            {{$error}}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h2>Bizimle İletişime Geçin</h2>
        <div class="border-left border-primary px-3 py-2 my-4 ml-4" style="border-width: 5px !important;">
            <form method="post" action="{{route('contactPost')}}">
               @csrf
                <div class="form-row my-2" >
                    <div class="form-group col-md-6">
                        <label for="firstname" class="text-secondary font-weight-bold">Ad:</label>
                        <input type="text" class="form-control" placeholder="Enter Full Name" name="firstname" value="{{old('firstname')}}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastname" class="text-secondary font-weight-bold">Soyad:</label>
                        <input type="text" class="form-control" placeholder="Enter Full Name" name="lastname" value="{{old('lastname')}}" required>
                    </div>
                </div>
                <div class="form-row my-2" >
                    <div class="form-group col-md-12">
                        <label for="subject" class="text-secondary font-weight-bold">Konu:</label>
                        <input type="text" class="form-control" placeholder="Enter Subject" name="subject" value="{{old('subject')}}" required>
                    </div>
                </div>
                <div class="form-row my-2" >
                    <div class="form-group col-md-12">
                        <label for="email" class="text-secondary font-weight-bold">E-Mail:</label>
                        <input type="email" class="form-control" placeholder="Enter E-Mail" name="email" value="{{old('email')}}" required>
                    </div>
                </div>
                <div class="form-row my-2">
                    <div class="col-md-12">
                        <label for="message" class="text-secondary font-weight-bold">Mesaj (Message):</label>
                        <textarea class="form-control" rows="7" name="message" required></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary rounded-0 my-4" style="width: 130px;">Gönder</button>
            </form>
        </div>
    </div>

    <br>
    <hr style="width: 40%; color: blue;">
    <br>


@endsection
