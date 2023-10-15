@extends('backend.author.layout.author')
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
    <h1>Add Category</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/access">Dashboard</a></li>
        <li class="breadcrumb-item active">Add Category</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
<div class="container customfont">
    <div class="card pt-3">
        <div class="container">
            <h3 class="text-center">Add a New Category</h3>
            <p class="text-center">With Some Descriptions</p>
            <form action="../author/submit-category" method="post" enctype="multipart/form-data">
                @csrf
            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input name="cat_name" id="cat_name" type="text" class="form-control" placeholder="Category Name">
              </div>
              <div class="mb-3">
                <label class="form-label">Category Slug</label>
                <input name="cat_slug" id="cat_slug" type="text" class="form-control" placeholder="Url">
              </div>
              <div class="mb-3">
                <label class="form-label">Cover Photo</label> <br>
                <input type="file" name="image" id="cover_image" multiple>
              </div>


                <div class="mb-3">
                  <label for="" class="form-label">Category Description</label>
                  <textarea class="form-control" name="cat_des" id="" rows="3"></textarea>
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
            url: '{{ route("author.getCatslug") }}',
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