@extends('layouts.main')
    
    @section('content')

        <h1>Exces Dinai : Yu ar un otorise!!!  </h1>
        <a type="button" class="btn btn-info col-lg-1" href="{{ route('auth.logout.attempt')}}">logout</a>

    @endsection
