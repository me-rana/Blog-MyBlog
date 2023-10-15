
@foreach($comments as $comment)
         <div class="row">
            <div class="col-1">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQlyOF_je9i8P0ddO-BPO2cyU5qPCBgqIwZ5O-GIdQ&s" height="40px" alt="" srcset="">
            </div>
            <div class="col-11">
                <h6>{{$comment->name}}@if ($article->author_id == $comment->user_id)
                    <i class="fa-solid fa-user"></i>
                @endif</h6>
                <p class="text-justify">{{$comment->comment}}</p>

            </div>

         @if(Auth::check())
         <form method="post" action="{{ route('comment.submit') }}">
            @csrf
            <div class="form-group">
            <input type="text" name="comment" class="form-control" />
            <input type="hidden" name="post_id" value="{{$article->id}}" />
            <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
            <input type="submit" class="btn btn-warning" value="Reply" />
            </div>
            </form>
            <br>
         @endif
         @foreach($replies as $reply)
            @if ($reply->parent_id == $comment->id)
            <div class="row">
                <div class="col-1">

                </div>
                <div class="col-1">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQlyOF_je9i8P0ddO-BPO2cyU5qPCBgqIwZ5O-GIdQ&s" height="40px" alt="" srcset="">
                </div>
                <div class="col-10">
                    <h6>{{$reply->name}}@if ($article->author_id == $reply->user_id)
                        <i class="fa-solid fa-user" alt="Author of the Post"></i>
                    @endif</h6>
                    <p class="text-justify">{{$reply->comment}}</p>

                    {{-- @if(Auth::check())
         <form method="post" action="{{ route('comment.submit') }}">
            @csrf
            <div class="form-group">
            <input type="text" name="comment" class="form-control"/>
            <input type="hidden" name="post_id" value="{{ $article->id }}" />
            <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
            <input type="submit" class="btn btn-warning" value="Reply" />
            </div>
            </form>
         @endif --}}
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @endforeach
