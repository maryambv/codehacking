@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="col-sm-3 col-md-offset-1">{{$post->title}}</div>
                        <div class="col-sm-3 col-md-offset-1">Owner: {{$post->user->name}}</div>
                        <div class="col-sm-3 col-md-offset-1">Last Update: {{$post->updated_at->diffForHumans()}}</div>
                    </div>

                    <div class="panel-body">
                        @if($post->photo->first())
                            <div class=" form-group row col-md-10 col-md-offset-5"> <img height="150" src="{{$post->photo->first() ? $post->photo->first()->file :'http://placehold.it/500x400'}}" alt=" "></div>
                        @endif

                        <div class="form-group">{{$post->body}}</div>
                        <div class="form-group">
                            @foreach($comments as $comment)
                                <div class="form-group comments">
                                    <div> {{$comment->user()->get()[0]->name}} :</div>
                                    <div >{{$comment->body}}</div>


                                    <div >{{$comment->created_at->diffForHumans()}}</div>


                                </div>

                            @endforeach
                        </div>


                        {!! Form::open(['method'=>'POST' ,'action'=>'PostCommentsController@store'])!!}


                        <div class="form-group">
                            {!! Form::label('body', 'Comment: ') !!}
                            {!! Form::textarea ('body', null, ['class'=>'form-control' ]) !!}
                            {!! Form::hidden ('post_id',$post->id) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Add Comment', ['class'=>'btn btn-primary']) !!}
                        </div>

                        {!! Form::close() !!}
                        @include('includes.form_error')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection