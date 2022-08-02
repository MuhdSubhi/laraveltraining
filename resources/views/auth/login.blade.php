@extends('layouts.main')
    
    @section('content')

    <form action="{{ route('auth.login.attempt')}}" method="POST">
        @csrf
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" required value=""><br>
        @error('email')
            <div class="">
                {{$errors->first('email')}}
            </div>   
        @enderror
        <br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" value="">
        @error('password')
            <div class="">
                {{$errors->first('password')}}
            </div>   
        @enderror
        <br>
        {{-- <button type="button" class="btn btn-info" href="{{ route('post..utama') }}">Sign Up</a> --}}
        <button type="submit" class="btn btn-primary">Submit</button>
    </form> 

    @endsection
