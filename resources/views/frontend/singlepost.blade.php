@extends('frontend.singletheme.content')
@section('main-section')

<!-- Post content-->
<article>
    <!-- Post header-->
    <header class="mb-4">
        <!-- Post title-->
        <h1 class="fw-bolder mb-1">{{$read_one->title}}</h1>
        <!-- Post meta content-->
        <div class="text-muted fst-italic mb-2">Posted on {{$read_one->updated_at->format('j F, Y')}} by {{$read_one->getAuthor->name}}</div>
        <!-- Post categories-->
        <a class="badge bg-secondary text-decoration-none link-light" href="../category/{{ $read_one->getCategory->cat_slug }}">{{$read_one->getCategory->cat_name}}</a>

    </header>

 <!-- Preview image figure-->
 <figure class="mb-4"><center><img class="img-fluid rounded" src="../../{{$read_one->image_path}}" alt="..." /></center></figure>
 <!-- Post content-->
 <section class="mb-5 text-justify">
    @php
        echo $read_one->description;
    @endphp
 </section>

</article>
<!-- Comments section-->
<section class="mb-5">
 <div class="card bg-light">
     <div class="card-body">
        <h6 class="text-center">Comment Here</h6>
        <p class="text-center"><font size='2px'>You need to sign in to comment.</font></p>
        <h5>Comments</h5>
        <hr>
         <!-- Comment form-->
        @if (Auth::check())
        <form action="/submit-comment" method="post" class="mb-4">
            @csrf
            <input name='post_id' type="text" class="from-control" value="{{$read_one->id}}" hidden>
            <textarea name="comment" class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea>
            <br>
            <input type="submit" class="btn btn-primary" value="Comment">
        </form>
        @endif
         <!-- Comment with nested comments-->
         @include('frontend.comments')


        </div>



</section>
</div>
<!-- Side widgets-->
<div class="col-lg-4">
<!-- Search widget-->
<div class="card mb-4">
 <div class="card-header">Search</div>
 <div class="card-body">
    <form action="{{route('Search Result')}}">
        <div class="input-group">
            <input name="myquery" class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
            <button class="btn btn-primary" id="button-search" type="button">Go!</button>
        </div>
    </form>
 </div>
</div>
<!-- Categories widget-->
<div class="card mb-4">
 <div class="card-header">Categories</div>
 <div class="card-body">
     <div class="row">
         <div class="col-sm-6">
             <ul class="list-unstyled mb-0">
                @php
                        $i=1;
                    @endphp
                   @if (count($all_category) > 0)
                    @foreach ($all_category as $single_cat)
                 <li><a href="../category/{{$single_cat->cat_slug}}">{{$single_cat->cat_name}}</a></li>
                 @endforeach

                 @endif
             </ul>
         </div>

     </div>
 </div>
</div>
<!-- Side widget-->
<div class="card mb-4">
 <div class="card-header">Side Widget</div>
 <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
</div>
</div>
</div>
</div>

@endsection
