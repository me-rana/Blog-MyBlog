@extends('backend.admin.layout.admin')
@section('main-content')

<div class="pagetitle">
    <h1>Users</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/access">Dashboard</a></li>
        <li class="breadcrumb-item active">Users</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  @if (session('message'))
  <div class="alert alert-primary alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <strong>Success!</strong> {{session('message')}}
  </div>
  @endif

  <script>
    var alertList = document.querySelectorAll('.alert');
    alertList.forEach(function (alert) {
      new bootstrap.Alert(alert)
    })
  </script>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">No.</th>
        <th scope="col">UserName</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
      </tr>
    </thead>
    <tbody>
      @if (count($data) > 0)
      @php
          $i=1;
      @endphp
      @foreach ($data as $row)
        <tr>
            <th scope="row"> {{$i++}} </th>
            <td>{{$row->name}} </td>
            <td><i>{{$row->email}}</i></td>
            <td><form action="{{route('admin.userRole')}}" method="post">
                @csrf
                <input name="uid" type="hidden" value="{{$row->id}}">
                <div class="row">
                    <div class="col-10"><div class="mb-3">
                        <select class="form-select form-select" name="role" id="">
                            <option value="3" @if ($row->role == 3) selected @endif>User</option>
                            <option value="1" @if ($row->role == 1) selected @endif>Author</option>
                            <option value="2" @if ($row->role == 2) selected @endif>Admin</option>
                        </select>
                    </div></div>
                    <div class="col-2"><button class="btn btn-light"><i class="bi bi-arrow-up-right-circle-fill"></i></button></div>
                </div>

            </form></td>

          </tr>
        @endforeach

      @endif
    </tbody>
  </table>
  {{$data->links()}}
@endsection
