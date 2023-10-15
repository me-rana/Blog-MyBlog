@extends('backend.author.layout.author')
@section('main-content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <div class="row">
            <div class="col-6">{{ __('All Categories') }} </div>
            <div class="col-6"><a href="add-category"><button class="btn btn-primary float-end" type="button">Add Category</button></a></div>
        </div>
    </h2>
</x-slot>
<div class="clear"></div>
<div class="clear"></div>


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
    <h1>Categories</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/access">Dashboard</a></li>
        <li class="breadcrumb-item active">Categories</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
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

        <td><img height="200px" src='http://127.0.0.1:8000/storage/image/{{$row->cat_path}}'> </td>
        <td><form action="../author/delete-category/{{$row->id}}" method="post">
            @csrf
            <input class="btn btn-danger" type="submit" value="Delete" disabled>
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
