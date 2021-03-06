@extends('layouts.app')
@section('title', 'Quotes - Create')

@section('content')
<div class="container">

    {{-- Tag msg --}}
    @if (session('msg'))
        <p class="alert alert-danger">{{session('msg')}}</p>
    @endif

    <div class="row col-sm-12 mb-3">
        <a href="/quotes"><- Back</a>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card bg-light mb-3" >
                <div class="card-header">Create Your Quote</div>
                <div class="card-body">
                  <h5 class="card-title">Light card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                  <form action="/quotes" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" autofocus="on" autocomplete="off" placeholder="title" value="{{old('title')}}">

                        @if ($errors->has('title'))
                            <p class="alert alert-danger">{{$errors->first('title')}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control ckeditor" id="description" autocomplete="off">{{old('description')}}</textarea>

                        @if ($errors->has('description'))
                            <p class="alert alert-danger">{{$errors->first('description')}}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="tag" id="add_tag">add tag</label>

                        @if (old('tag'))
                            @for($i=0; $i < count(old('tag')); $i++)
                                <select name="tag[]" class="form-control" id="tag_select"  >
                                    @foreach ($tags as $tag)
                                        <option  {{old('tag'.$i) == $tag->id ? 'selected' : ''}} value="{{$tag->id}}">{{$tag->tag}}</option>
                                    @endforeach
                                </select>
                            @endfor

                            @else
                            <select name="tag[]" class="form-control" id="tag_select"  >
                                <option value="0">Tidak ada</option>
                                @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->tag}}</option>
                                @endforeach
                            </select>

                        @endif


                        <p class="mt-1 mb-2" id="halo"></p>

                        @if ($errors->has('tag'))
                            <p class="alert alert-danger">{{$errors->first('tag')}}</p>
                        @endif

                        <script>
                            let awal = 0;
                            $(document).ready(function() {
                                $('#add_tag').click(function(){
                                    awal++;
                                    if (awal <= 3) {
                                        $('#tag_select').clone().appendTo('#halo');
                                    }
                                })
                            })
                        </script>

                    </div>
                    <button type="submit" class="btn btn-primary float-right bnt-sm"><i class="fa fa-plus"></i></button>

                  </form>
                </div>
              </div>

        </div>

    </div>
</div>
@endsection
