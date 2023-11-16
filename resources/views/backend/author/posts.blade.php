@extends('backend.author.layout.author')
@section('main-content')





    <style>
    @import url('https://fonts.googleapis.com/css2?family=PT+Serif&display=swap');
    .customfont{
         font-family: 'PT Serif', serif;
    }
    blockquote{
      background: #dfdede;
      border-left: 5px solid rgba(255, 0, 0, 0.555);
      padding: 4px;
      text-align: center;
      font-size: 18px;
      font-weight: bold;

    }
    .thead{
        background: white;
        padding: 20px;
    }
</style>
<div class="pagetitle">
    <h1>Posts</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/access">Dashboard</a></li>
        <li class="breadcrumb-item active">Posts</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

<div class="container customfont">
  <br>
  @if (session('message'))
<div class="alert alert-primary alert-dismissible fade show" role="alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  <strong>Success!</strong> {{session('message')}}
</div>
@endif

<h3 class="text-center">Lifetime Posts of the Website</h3>
<p class="text-center text-danger">You can modify or Terminate any posts</p>

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Description</th>
        <th scope="col">Publish Date</th>
        <th scope="col">Tag</th>
        <th scope="col">Image</th>
        <th scope="col">Action</th>

      </tr>
    </thead>
    <tbody>
        @php
                    $i=1;
                @endphp
               @if (count($data) > 0)
                @foreach ($data as $row)
      <tr>
        <th scope="row">{{$i++}}</th>
        <td>{{$row->title}}</td>
        <td>

              {{$row->cat_name}}


            </td>
        <td class="text-justify">
          @php echo Str::words($row->description,15); @endphp</td>
        <td>{{$row->created_at}}</td>
        <td>{{$row->tag}}</td>
        <td><img height="100px" src='../../{{$row->image_path}}'> </td>
        <td>
            <a href="../author/update-post/{{$row->id}}"><button class="btn btn-success">Edit</button></a>
            <br>
            <form action="../author/delete-post/{{$row->id}}" method="post">
            @csrf
            <input class="btn btn-danger" type="submit" value="Delete">
        </form> </td>
      </tr>
      @endforeach

               @endif
    </tbody>
  </table>
  {{$data->links()}}
</div>
@endsection
