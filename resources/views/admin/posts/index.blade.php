@extends('layouts.admin')
    @section('content')

    <h1>Posts</h1>
     <table class="table">
         <thead>
           <tr>
               <th>ID</th>
               <th>Photo</th>
               <th>Owner</th>
               <th>Title</th>
               <th>Category</th>
               <th>Body</th>
               <th>Created</th>
               <th>Updated</th>


           </tr>
         </thead>

         <tbody>
         @foreach($posts as $post)
               <tr>
                   <td>{{$post->id}}</td>
                   <td><img height="50" src="{{$post->photo->first() ? $post->photo->first()->file :'http://placehold.it/400x400'}}" alt=" "></td>
                   <td>{{$post->user->name}}</td>
                   <td><a href="{{route('admin.posts.edit',$post->id)}}">{{$post->title}}</a></td>
                   <td>{{$post->category_id ? $post->category->name : 'uncategorized'}}</td>
                   <td>{{str_limit($post->body,7)}}</td>
                   <td>{{$post->created_at->diffForHumans()}}</td>
                   <td>{{$post->updated_at->diffForHumans()}}</td>
               </tr>

             @endforeach
         </tbody>
       </table>

    @endsection