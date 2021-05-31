@extends('includes.layout')

@section('body')
<form action="{{route('api.get_customers')}}" method="GET">
        <label for="name">Meno</label>
        <input type="text" name="name" id="name">

        <label for="lastname">Priezvisko</label>
        <input type="text" name="lastname" id="lastname">

        <label for="date">Dátum</label>
        <input type="date" name="date" id="date">

        <input type="submit" value="Vyhľadať zákazníkov">
</form>

<p>
    @if($name && $lastname)
        <p>Meno: {{$name}}</p>
        <p>Prizevisko : {{$lastname}}</p>
    @endif
</p>
@endsection