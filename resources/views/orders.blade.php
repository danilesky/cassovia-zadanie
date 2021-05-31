@extends('includes.layout')
@section('body')
    <p><h3>Create order</h3></p>
    <form action="{{route('api.create_order')}}" method="POST">
        @csrf
        <label for="customer_id">Id zakaznika</label>
        <input type="number" name="customer_id" id="customer_id">

        <label for="lastname">Id produktu</label>
        <input type="number" name="product_id" id="product_id">

        <label for="lastname">Množstvo</label>
        <input type="number" name="qty" id="qty">

        <input type="submit" value="Vytvor objednavku">
        
    </form>

    <p><h3>List order</h3></p>
    <form action="{{route('api.get_orders')}}" method="GET">
        @csrf
        <label for="customer_name">Meno zákazníka</label>
        <input type="text" name="customer_name" id="customer_name">

        <label for="date_from">dátum od</label>
        <input type="date" name="date_from" id="date_from">

        <label for="date_to">dátum do</label>
        <input type="date" name="date_to" id="date_to">

        <input type="submit" value="vyhľadaj objednavku">
        
    </form>
@endsection