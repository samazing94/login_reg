@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1> Hello, {{ Auth::user()->name }} </h1>
                    <p> Birthday: {{ Auth::user()->dob }} </p>
                    <p> Email: {{ Auth::user()->email }} </p>
                    You are logged in {!! Auth::user()->username !!}!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
