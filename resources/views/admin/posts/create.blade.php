@extends('layouts.admin')
@section("styles")
    @endsection
@section('content')

    <h1>Create Post</h1>

        {!! Form::open(['method'=>'POST' ,'action'=>'AdminPostsController@store' ,'files'=> true])!!}
            <div class="form-group">
                {!! Form::label('title', 'Title: ') !!}
                {!! Form::text('title', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('category-_id', 'Category: ') !!}
                {!! Form::select ('category_id',[''=>'Choose Category']+$categories,null, ['class'=>'form-control']) !!}
            </div>
    {{--                {!! Form::file ('photo_id', null, ['class'=>'form-control', 'onchange'=>'loadFile(event)']) !!}--}}
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
                {!! Form::submit('Create', ['class'=>'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    @include('includes.form_error')

@endsection







