@extends('layouts.admin')
@section('content')

    <h1>Edit Post</h1>

    <div class="col-sm-2">
        {!! Form::label( 'Photo: ') !!}
        @foreach($post->photo as $photo)
            <div class="form-group">

                {!! Form::open(['method'=>'DELETE' ,'action'=>['AdminMediaController@destroy', $photo->id]])!!}

                     <img height="100" src="{{$photo ? $photo->file :'http://placehold.it/400x400'}}" alt=" ">
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}

                {!! Form::close() !!}
            </div>
        @endforeach
    </div>

    <div class="col-sm-9">
    {!! Form::model($post,['method'=>'PATCH' ,'action'=>['AdminPostsController@update',$post->id] ,'files'=> true])!!}

        <div class="form-group">
            {!! Form::label('title', 'Title: ') !!}
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('category-_id', 'Category: ') !!}
            {!! Form::select ('category_id',[''=>'Choose Category']+$categories,null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <input name="photo_id" type="file" accept="image/*" onchange="loadFile(event)">
            {!! Form::label('photo_id', 'Photo: ') !!}
            <img height="50" id="photo_id"/>
            <script>
                var loadFile = function(event) {
                    var output = document.getElementById('photo_id');
                    output.src = URL.createObjectURL(event.target.files[0]);
                };
            </script>
        </div>

        <div class="form-group">
            {!! Form::label('body', 'Description: ') !!}
            {!! Form::textarea ('body', null, ['class'=>'form-control' ]) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Edit', ['class'=>'btn btn-primary col-sm-6']) !!}
        </div>

    {!! Form::close() !!}

    {!! Form::open(['method'=>'DELETE' ,'action'=>['AdminPostsController@destroy' ,$post->id]])!!}
        <div class="form-group">
            {!! Form::submit('Delete Post', ['class'=>'btn btn-danger col-sm-6']) !!}
        </div>

        {!! Form::close() !!}
    </div>
    @include('includes.form_error')

@endsection