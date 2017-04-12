@extends('layouts.admin')
@section('content')

    <h1>Edit Post</h1>
    <div class="col-sm-2">
        {!! Form::label( 'Photo: ') !!}
        @foreach($post->photo as $photo)
            <div class="form-group">
                <img height="100" src="{{$photo ? $photo->file :'http://placehold.it/400x400'}}" alt=" ">
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
        {!! Form::label('photo_id', 'Photo: ') !!}
        {!! Form::file ('photo_id', null, ['class'=>'form-control']) !!}
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