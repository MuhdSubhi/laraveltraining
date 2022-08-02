@extends('layouts.main')
    
    @section('content')
        <div class="container">
            <h1> Utama </h1>
        </div>
        <br>
        <div class="container">
            <h3> Test Data Here!!!</h3>
            <a type="button" class="btn btn-success" href="{{ route('form.create') }}">Tambah</a>

            @foreach ($staffs as $staff )
                <div class="card">
                    <p style="font-size: 20px; color: #a18888">{{ $staff->fname }} {{ $staff->lname }}</p>
                    <p></p>

                    <a type="button" class="btn btn-info col-lg-1" href="{{ route('form.edit' , ['id' => $staff->id])}}">Update</a>
                    <form action="{{ route('form.destroy', ['id' => $staff->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </div>
            @endforeach

            @foreach($currency as $curr)
                <p>=========================================</p>
                <p>currency code : {{ $curr->currency_code }}</p> 
                <p>currency unit : {{ $curr->unit }}</p> 
                <p>buying rate : {{ $curr->rate->buying_rate }}</p>
                <p>selling rate : {{ $curr->rate->selling_rate }}</p>
            @endforeach
            <div style="margin-top:20px;">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">{{$staffs->links("pagination::bootstrap-5")}}</li>
                    </ul>
                </nav>
            </div>
        </div>
        

    @endsection
