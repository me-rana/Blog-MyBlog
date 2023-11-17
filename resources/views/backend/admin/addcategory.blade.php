@extends("backend.admin.layout.admin")
@section('main-content')

        <style>
        @import url('https://fonts.googleapis.com/css2?family=PT+Serif&display=swap');
        .customfont{
             font-family: 'PT Serif', serif;
        }
        .thead{
        background: white;
        padding: 20px;
    }
</style>
<div class="pagetitle">
    <h1>{{$title ?? ''}}</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/access">Dashboard</a></li>
        <li class="breadcrumb-item active">{{$title ?? ''}}</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
<div class="container customfont">
  @if (session('message'))
  <div class="alert alert-primary alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <strong>Success!</strong> {{session('message')}}
  </div>
  @endif
    <div class="card pt-3">
        <div class="container">
            <h3 class="text-center">{{$title ?? ''}}</h3>
            <p class="text-center">With Some Descriptions</p>
            <form action="../admin/submit-category" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="cid" value="{{$cid ?? ''}}">
            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input name="cat_name" id="cat_name" type="text" class="form-control" value="{{$category->cat_name ?? ''}}" placeholder="Category Name">
              </div>
              <div class="mb-3">
                <label class="form-label">Category Slug</label>
                <input name="cat_slug" id="cat_slug" value="{{$category->cat_slug ?? ''}}" type="text" class="form-control" placeholder="Url">
              </div>
              <div class="mb-3">
                <label class="form-label">Cover Photo</label> <br>
                <input type="file" name="image" id="cover_image" multiple>
              </div>


                <div class="mb-3">
                  <label for="" class="form-label">Category Description</label>
                  <textarea class="form-control" name="cat_des" id="" rows="3">{{$category->cat_des ?? ''}}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
            <br>
        </div>

    </div>
</div>
<script>

    $("#cat_name").change(function(){

        $.ajax({
            url: '{{ route("admin.getCatslug") }}',
            type: 'get',
            data: {cat_name: $(this).val()},
            datatype: 'json',
            success: function(response){
                $("#cat_slug").val(response.cat_slug);
            }
        })
    });

    </script>

@endsection
