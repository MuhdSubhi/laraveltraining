@extends('layouts.main')

    @section('content')
    
        <div class="container">
            <h1> Registration </h1>
            
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

            <form action="{{ route('form.store') }}" method="POST">
                @csrf
                <label for="fname">First name:</label><br>
                <input type="text" id="fname" name="fname" maxlength="11" required value={{ old('fname')}}><br>
                @error('fname')
                    <div class="">
                        {{$errors->first('fname')}}
                    </div>   
                @enderror
                <br>
                <label for="lname">Last name:</label><br>
                <input type="text" id="lname" name="lname" value={{ old('lname')}}>
                @error('lname')
                    <div class="">
                        {{$errors->first('lname')}}
                    </div>   
                @enderror
                <br>
                {{-- <button type="button" class="btn btn-info" href="{{ route('post..utama') }}">Sign Up</a> --}}
                <button type="submit" class="btn btn-primary">Submit</button>
            </form> 
        </div>
    @endsection