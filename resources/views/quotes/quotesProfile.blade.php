@extends('layouts.app')
@section('title', 'My Quotes')

@section('content')
<div class="container">

    @if (session('msg'))
        <p class="alert alert-info">{{session('msg')}}</p>
    @endif

    <div class="row">
        <div class="col-sm-12 text-center">
            <h3>Hi <span class="badge badge-warning">{{$user->name}}</span></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-sm text-center">

            @if (count($user->quotes) == 0)
                <p class="font-weight-bolder">You have no quote !</p>
            @endif

            <div class="card border-warning " >
                <div class="card-body">
                  <h5 class="card-title">My Quote</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">

                  @foreach ($user->quotes as $quote)
                  <li class="list-group-item">
                    <a href="/quotes/{{$quote->slug}}">{{$quote->title}}</a>
                  </li>
                  @endforeach

                </ul>
                <div class="card-body">
                  <a href="/quotes" class="card-link font-weight-bold">~ Go to Home ~</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
