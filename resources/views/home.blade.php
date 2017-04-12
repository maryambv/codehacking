@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome</div>

                    <div class="panel-body">
                        <h1>Posts</h1>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Title</th>
                                <th>Owner</th>
                                <th>Category</th>
                                <th>Body</th>
                                <th>Created</th>



                            </tr>
                            </thead>

                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td><img height="150" src="{{$post->photo->first() ? $post->photo->first()->file :'http://placehold.it/500x400'}}" alt=" "></td>
                                    <td><a href="{{route('admin.posts.show',$post->id)}}">
                                            <h1>
                                            {{$post->title}}</h1>
                                        </a></td>
                                    <td>{{$post->user->name}}</td>

                                    <td>{{$post->category_id ? $post->category->name : 'uncategorized'}}</td>
                                    <td>{{str_limit($post->body,7)}}</td>
                                    <td>{{$post->created_at->diffForHumans()}}</td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection