@extends('includes.layout')

@section('body')
    @if($success)
    <p style="color:green">{{$success}}</p>
    @endif

    @if($errors)
        @foreach($errors as $error)
            <p style="color:red">{{$error}}</p>
        @endforeach
    @endif

    <form action="{{route('api.make_customer')}}" method="POST">
        @csrf
        <label for="name">Meno</label>
        <input type="text" name="name" id="name">

        <label for="lastname">Priezvisko</label>
        <input type="text" name="lastname" id="lastname">

        <label for="mail">E-mail</label>
        <input type="email" name="mail" id="mail">

        <label for="mail">Mobil</label>
        <input type="number" name="phone" id="phone">

        <input type="submit" value="Vytvoriť zákazníka">
    </form>
@endsection