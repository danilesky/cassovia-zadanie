@extends('includes.layout')
@section('body')
    <form action="{{route('api.create_product')}}" method="POST">
        @csrf
        <label for="name">Názov produktu</label>
        <input type="text" name="name" id="name">

        <label for="img">Obrázok</label>
        <input type="text" name="img" id="img">

        <label for="mail">Cena</label>
        <input type="number" name="price" id="price">

        <input type="submit" value="Vytvoriť produkt">
    </form>
@endsection