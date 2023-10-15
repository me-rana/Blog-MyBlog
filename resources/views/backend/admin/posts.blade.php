@extends("backend.admin.layout.admin")
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
               @if (count($posts) > 0)
                @foreach ($posts as $row)
      <tr>
        <th scope="row">{{$i++}}</th>
        <td>{{$row->title}}</td>
        <td>{{$row->cat_name}}</td>
        <td>@php echo Str::words($row->description,15); @endphp </td>
        <td>{{$row->created_at}}</td>
        <td>{{$row->tag}}</td>
        <td><img height="100px" src='../../storage/image/{{$row->image_path}}'> </td>
        <td>
            <a href="../admin/update-post/{{$row->id}}"><button class="btn btn-success">Edit</button></a>
            <br>
            <form action="../admin/delete-post/{{$row->id}}" method="post">
            @csrf
            <input class="btn btn-danger" type="submit" value="Delete">
        </form> </td>
      </tr>
      @endforeach

               @endif
    </tbody>
  </table>
  {{$posts->links()}}
</div>
@endsection
