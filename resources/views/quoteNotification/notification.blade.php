@extends('layouts.app')
@section('title', 'Quotes - Notification')

@section('content')
<div class="container">

   @if (session('msg'))
       <p class="alert alert-info">{{session('msg')}}</p>
   @endif

    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            <div class="card-body">
                <h3 class="card-title">Notification</h3>
                <div class="card">
                    <div class="card-header">
                      Featured
                    </div>
                    <ul class="list-group list-group-flush">
                      @foreach ($notifications as $notification)

                        <a href="/quotes/{{$notification->quote->slug}}" class="list-group-item">{{$notification->subject}} di {{$notification->quote->title}}</a>

                        <form action="/notification/{{$notification->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>

                      @endforeach
                    </ul>
                  </div>

                  {{-- Ubah notifikasi --}}
                  @php
                    $updateNotif->update([
                    'seen' => 1
                    ])
                  @endphp


            </div>
        </div>
    </div>
</div>
@endsection
