@extends('layouts.app')
@section('title', 'Quotes - Comment')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-sm-12 ">
            <div class="card-body">
                <h3 class="card-title">Edit Comment</h3>

                <form action="/quotes/comment/{{$comment->id}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="comment" class="form-control" autofocus autocomplete="off" placeholder="Comment Public">{{old('comment') ? old('comment') :  $comment->comment}}</textarea>
                    </div>

                    @if ($errors->has('comment'))
                        <p class="alert alert-danger">{{$errors->first('comment')}}</p>
                    @endif

                    <input type="hidden" name="_method" value="PUT">
                    <button type="submit" class="btn btn-info btn-sm float-right">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
