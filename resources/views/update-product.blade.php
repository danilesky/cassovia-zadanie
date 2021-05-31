@extends('includes.layout')
@section('body')
    <p><h3>Update product</h3></p>
    <form action="{{route('api.update_product')}}" method="POST">
        @csrf
        @method('patch')
        <label for="id">ID produktu</label>
        <input type="number" name="id" id="id">


        <label for="name">Názov produktu</label>
        <input type="text" name="name" id="name">

        <label for="img">Obrázok</label>
        <input type="text" name="img" id="img">

        <label for="mail">Cena</label>
        <input type="number" name="price" id="price">

        <input type="submit" value="Aktulizovať produkt">
        
    </form>

    <p><h3>delete product</h3></p>
    <form action="{{route('api.delete_product')}}" method="POST">
        @csrf
        @method('delete')
        <label for="id">ID produktu</label>
        <input type="number" name="id" id="id">

        <input type="submit" value="Vymazať produkt">
    </form>
@endsection