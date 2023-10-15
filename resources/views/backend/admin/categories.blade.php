@extends("backend.admin.layout.admin")
@section('main-content')

<div class="pagetitle">
    <h1>Categories</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/access">Dashboard</a></li>
        <li class="breadcrumb-item active">Categories</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->




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

<div class="container customfont">
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Category Name</th>
        <th scope="col">Slug</th>
        <th scope="col">Description</th>
        <th scope="col">Cover Photo</th>
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
        <td>{{$row->cat_name}}</td>
        <td>{{$row->cat_slug}}</td>
        <td class="text-justify">@php
          echo $row->cat_des;
        @endphp</td>

        <td><img height="200px" src='../storage/image/{{$row->cat_path}}'> </td>
        <td>
            <a href="../../admin/update-category/{{$row->id}}" target="_blank" rel="noopener noreferrer"><button class="btn btn-success">Edit</button></a>
            <br> <br>
            <form action="../admin/delete-category/{{$row->id}}" method="post">
            @csrf
            <input class="btn btn-danger" type="submit" value="Delete">
        </form></td>
      </tr>
      @endforeach

               @endif
    </tbody>
  </table>
  {{$data->links()}}
</div>
</div>
@endsection
