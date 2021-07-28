@extends('layouts.app')
@section('title', 'Quotes')

@section('content')
<div class="container">
    {{-- Comment Succsess --}}
    @if (session('msg'))
    <p class="alert alert-info">{{session('msg')}}</p>
    @endif

    <div class="row col-sm-12 mb-3">
        <a href="/quotes">
            <<< Back</a> </div> <div class="row">
                <div class="col-sm-12 ">

                    <div class="card border-success  mb-3 " style="border-radius: 15px 0 30px 20px">
                        <div class="card-header ">{{$quote->title}}</div>
                        <div class="card-body text-dark">
                            <p class="card-text">{!!$quote->description!!}</p>

                            {{-- Fitur Copy --}}

                            <input type="text" id="bar" class=".d-md-none .d-lg-block"
                                value="{!! strip_tags($quote->description) !!}">
                            <hr class="border-dark">

                            <p class="card-title">Author : <a href="/quotes-profile/{{$quote->user->id}}"
                                    class="font-weight-bold">{{$quote->user->name}}</a> </p>

                            <button class="btn btn-info btn-sm" data-clipboard-action="copy"
                                data-clipboard-target="#bar">
                                <i class="fa fa-copy"></i>
                            </button>

                            @if ($quote->isLogin())

                            {{-- Fitur Like --}}
                            @component('components.like', ['model' => $quote, 'type' => 1])
                            @endcomponent
                            {{-- Fitur Like --}}

                            @endif

                        </div>

                    </div>

                </div>
    </div>

    {{-- FITUR COMMENT --}}
    <div class="row">
        <div class="col-sm-12">


            <div class="card border-success">
                <div class="card-header">
                    Comment
                </div>
                <div class="card-body">

                    <form action="/quotes/comment/{{$quote->id}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="comment" class="form-control" autofocus autocomplete="off"
                                placeholder="Comment Public">{{old('comment')}}</textarea>
                        </div>

                        @if ($errors->has('comment'))
                        <p class="alert alert-danger">{{$errors->first('comment')}}</p>
                        @endif

                        <button type="submit" class="btn btn-info btn-sm float-right">Comment</button>
                    </form>
                </div>

                <div class="col">
                    <hr>

                    @foreach ($quote->comments as $comment)
                    @php
                    $waktu = date('l, d-m-Y', strtotime($comment->updated_at))
                    @endphp
                    <div class="mb-3" style="max-width: 540px;">
                        <div class="row">
                            <div class="col">
                                <div class="card-body">
                                    <h4 class="card-title">{{$comment->user->name}}</h4>
                                    <p class="card-text">{{$comment->comment}}.</p>
                                    <p class="card-text"><small class="text-muted">Last updated : {{$waktu}}</small></p>


                                    @if ($comment->isOwner())

                                    <a href="/quotes/comment/{{$comment->id}}/edit" class="btn btn-warning btn-sm"><i
                                            class="fa fa-edit"></i></a>
                                    <a href=""
                                        onclick="event.preventDefault(); document.getElementById('delete').submit();"
                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                                    <form id="delete" action="/quotes/comment/{{$comment->id}}" method="POST"
                                        class="none">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>

                                    @endif

                                    @if ($comment->isLogin())

                                    {{-- Fitur Like --}}
                                    @component('components.like',['model' => $comment , 'type' => 2])
                                    @endcomponent
                                    {{-- Firut Like --}}

                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach

                </div>
            </div>
        </div>




    </div>

</div>

<script src="{{asset('js/like.js')}}"></script>

@endsection