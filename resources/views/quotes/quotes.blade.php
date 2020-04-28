@extends('layouts.app')
@section('title', 'Quotes')

@section('content')
<div class="container">

    @if (session('msg'))
        <p class="alert alert-info">{{session('msg')}}</p>
    @endif

    <div class="row col-sm-12 mb-3">
        <a href="/quotes-random" class="btn btn-info">Random Quotes</a>
    </div>

    <div class="row col-sm-12">

        @foreach ($tags as $tag)
        <ul type="square">
            <li> <a href="/quotes-filter/{{$tag->tag}}">{{$tag->tag}}</a> </li>
        </ul>
        @endforeach

    </div>

    <div class="row">
        <div class="col-sm-10 offset-sm-1 ">
            <div class="card-deck d-block">

            @foreach ($quotes as $quote)
                <div class="card border-dark mb-4" style="border-radius: 20px 0 10% 0">
                    <div class="card-header">
                      <a href="/quotes/{{$quote->slug}}">{{$quote->title}}</a>
                    </div>
                    <div class="card-body">
                      <blockquote class="blockquote mb-0">
                      <p>{!!$quote->description!!}</p>
                        <footer class="blockquote-footer">{{$quote->user->name}} <cite title="Source Title">Source Title</cite></footer>
                      </blockquote>

                      <hr>
                        {{-- Fitur Tag --}}
                        @foreach ($quote->tags as $tag)
                            <span class="badge badge-secondary">{{$tag->tag}} </span>
                        @endforeach
                      <hr>

                    @if ($quote->isOwner())
                        <a href="/quotes/{{$quote->slug}}/edit " class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>

                        <form id="delete" action="/quotes/{{$quote->id}}" method="POST">
                            @csrf
                            @method("delete")
                            <button type="submit" onclick="return confirm('Hapus Permanent ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    @endif



                    </div>
                </div>
            @endforeach

            </div>
        </div>
    </div>
</div>
@endsection
