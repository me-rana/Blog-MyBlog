@extends('frontend.theme.content')
@section('main-content')
<br><br>

  <!-- Page content-->
        <div class="container">
            <h3 class="text-center">{{$category->cat_name}}</h3>
            <div class="row row align-items-center">
                <div class="col-6">
                    <center><img src="../../{{$category->cat_path}}" height="200px" /></center>
                </div>
                <div class="col-6 d-flex justify-content-center">
                    {{$category->cat_des}}
                </div>
            </div>
<br><br>

            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">



                    <!-- Nested row for non-featured blog posts-->
                    <div class="row">


                        @php
                        $i=1;
                        $paginate = 8;
                    @endphp
                   @if (count($category->getPosts) > 0)
                    @foreach ($category->getPosts()->paginate($paginate) as $row)
                        <div class="col-lg-6">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="#!"><img height="200px" class="card-img-top" src="../storage/image/{{$row->image_path}}" alt="..." /></a>
                                <div class="card-body">
                                    <div class="small text-muted">{{$row->updated_at}}</div>
                                    <h2 class="card-title h4">{{substr($row->title, 0, 50)}}</h2>
                                    <p class="card-text text-justify">
                                        @php
                                        echo substr($row->description, 0, 120);
                                      @endphp <br></p>
                                    <a href="../posts/{{$row->slug}}"><button class="btn btn-primary">Read more →</button> </a>
                                </div>
                            </div>
                        </div>
                        @endforeach

                   @endif


{{-- Fixed --}}
 <!-- Pagination-->
{{ $category->getPosts()->paginate($paginate)->links('pagination::bootstrap-5') }}

                    </div>

                </div>
                
                <!-- Side widgets-->
                
                
                    <!-- Search widget-->
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
