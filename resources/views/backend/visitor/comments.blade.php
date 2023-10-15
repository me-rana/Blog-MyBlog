@extends('backend.visitor.layout.visitor')
@section('main-content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<div class="table-responsive">
    <table class="table table-primary">
        <thead>
            <tr>
                <th scope="col">Post Name</th>
                <th scope="col">Comments</th>
                <th scope="col">Date and Time</th>
            </tr>
        </thead>
        <tbody>
        @if (count($comments) > 0)
            @foreach ($comments as $row)

            <tr class="">
                <td scope="row"><a href="../posts/{{$row->slug}}">{{$row->title}}</a></td>
                <td>{{$row->comment}}</td>
                <td>{{$row->created_at->format('j F, Y h:m a')}}</td>
            </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>


@endsection
