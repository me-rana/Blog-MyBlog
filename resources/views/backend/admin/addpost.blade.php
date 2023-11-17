@extends("backend.admin.layout.admin")
@section('main-content')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>

        <style>
        @import url('https://fonts.googleapis.com/css2?family=PT+Serif&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Tektur&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Handjet:wght@400&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Vina+Sans&display=swap');
        .customfont{
             font-family: 'PT Serif', serif;
        }
        .italicCustom{
          font-family: 'Dancing Script', cursive;
        }
        .squareCustom{
          font-family: 'Tektur', cursive;
        }
        .dotFont{
          font-family: 'Handjet', cursive;
        }
        .sameSizeFont{
          font-family: 'Vina Sans', cursive;
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
    <br>
    <div class="card">
       <div class="container">
        <br>
        <h3 class="text-center sameSizeFont">{{$title ?? ''}}</h3>
        <p class="text-center text-success dotFont">Made your blog With Valid informations</p>

        <form action="{{route('admin.storepost')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="post_id" value="{{$pid ?? ''}}">
            <div class="mb-3">
                <label class="form-label">Post Title</label>
                <input name="title" type="text" id="title" class="form-control" value="{{$post->title ?? ''}}" placeholder="Post Title">
              </div>
              <div class="mb-3">
                <label class="form-label">Slug</label>
                <input name="slug" type="text" id="slug" class="form-control" value="{{$post->slug ?? ''}}" placeholder="slug">
              </div>
              <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select form-select-md mb-3" aria-label=".form-select-lg example">
                    <option value="0" @if ($post->status ?? '' == 0) selected @endif>Unpublished</option>
                    <option value="1" @if ($post->status ?? '' == 1) selected @endif>Published</option>
                  </select>
              </div>

              <div class="mb-3">
                <label class="form-label">Category<center><font size='1px' color="red">You can add category from <b>Category</b> Page</font></center></label>

                <select name="category" class="form-select form-select-md mb-3" aria-label=".form-select-lg example">
                    @foreach ($data as $category)
                        <option value="{{$category->id}}" @if ($category->id == ($post->category ?? '')) selected @endif>{{$category->cat_name}}</option>
                    @endforeach
                </select>


            </div>

              <div class="mb-3">
                <label class="form-label">Cover Photo</label> <br>
                <input type="file" name="image" id="cover_image" multiple>
              </div>


              <div class="mb-3">
                <label class="form-label">Content Description</label>
                <textarea name="description" class="form-control" id="editor" rows="20">{{$post->description ?? ''}}</textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">Tag</label>
                <input name="tag" value="{{$post->tag ?? ''}}" type="text" class="form-control" placeholder="Tags">
              </div>
              <button class="btn btn-success" type="submit">Submit</button>
        </form>
<br>
       </div>
    </div>
</div>
<br><br>

<script>

$("#title").change(function(){

    $.ajax({
	    url: '{{ route("admin.getslug") }}',
	    type: 'get',
	    data: {title: $(this).val()},
	    datatype: 'json',
	    success: function(response){
		    $("#slug").val(response.slug);
	    }
    })
});

</script>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    <script>
   CKEDITOR.replace( 'summary-ckeditor', {
filebrowserUploadUrl: "{{route('admin.newpost', ['_token' => csrf_token() ])}}",
filebrowserUploadMethod: 'form'});
</script>

@endsection
