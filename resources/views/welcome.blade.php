@extends('includes.layout')

@section('body')
    <div>
        <ul>
            <li>
                <a href="{{route('make_customer')}}">Vytvoriť zákazníka</a>
            </li>
            <li>
                <a href="{{route('create_product')}}">Vytvoriť produkt</a>
            </li>
            <li>
                <a href="{{route('update_product')}}">Aktulizovať produkt</a>
            </li>
            <li>
                <a href="{{route('orders')}}">Zoznam objednávok</a>
            </li>
        </ul>
    </div>
@endsection
