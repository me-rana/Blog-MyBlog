@php
    $title = 'Home';
@endphp
@extends('frontend.theme.content')
@section('main-content')
 <!-- Page header with logo and tagline-->
 <style>
    .styler{
        color: black;
        text-decoration: none;

    }
    .styler:hover{
        color: rgb(56, 4, 87);
    }
 </style>
{{-- Made by Rana Bepari --}}
 <header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Welcome to <br><a class="styler" href="https://ranasvc.com">Rana's Web Development</a><br> Website!</h1>
            <p class="lead mb-0">This Website is developed by <a class="styler" href="https://www.facebook.com/ranab.me"><b>Rana Bepari</b></a> <br> <font size="2px">Powered By Laravel and Bootstrap 5</font></p>
        </div>
    </div>
</header>
  <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <!-- Featured blog post-->
                    <div class="card mb-4">
                        <div class="card mb-4">
                            @if($feature_post != null)
                            <a href="#!"><img height="400px" class="card-img-top" src="../../{{$feature_post->image_path}}" alt="..." /></a>
                            <div class="card-body">
                                <div class="small text-muted">{{$feature_post->updated_at->format('j F, Y')}}</div>
                                <h2 class="card-title h4">{{substr($feature_post->title, 0, 50)}}</h2>
                                <p class="card-text text-justify">
                                    @php
                                    echo substr($feature_post->description, 0, 120);
                                  @endphp <br></p>
                                <a href="posts/{{$feature_post->slug}}"><button class="btn btn-primary">Read more →</button> </a>
                            </div>
                            @endif
                    </div>
               
                    <!-- Nested row for non-featured blog posts-->
                    @if (Route::currentRouteName() == 'Search Result')
                       
                    <div id="search" class="container">
                        <div class="row bg-dark text-white">
                            <hr class="my-2">
                            <div class="col-8">Search Results</div>
                            <div class="col-4">{{ $posts->count() }}</div>
                            <hr class="my-2">
                        </div>
                    </div>
                    
                @endif
                    <div class="row my-2">
                        @php
                        $i=1;
                    @endphp
                   @if (count($posts) > 0)
                    @foreach ($posts as $row)
                        <div class="col-lg-6">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="#!"><img height="200px" class="card-img-top" src="../../{{$row->image_path}}" alt="..." /></a>
                                <div class="card-body">
                                    <div class="small text-muted">{{$row->updated_at->format('j F, Y')}}</div>
                                    <h2 class="card-title h4">{{substr($row->title, 0, 50)}}</h2>
                                    <p class="card-text text-justify">
                                        @php
                                        echo substr($row->description, 0, 120);
                                      @endphp <br></p>
                                    <a href="posts/{{$row->slug}}"><button class="btn btn-primary">Read more →</button> </a>
                                </div>
                            </div>
                        </div>
                        @endforeach

                   @endif


{{-- Fixed --}}
 <!-- Pagination-->
 {{$posts->links()}}
</div>
                    </div>

                </div>
                <!-- Side widgets-->
                @include('frontend.theme.search')
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
