@extends('frontend.theme.content')
@section('main-content')
<style>
    body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

html {
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

.column {
  float: left;
  width: 33.3%;
  margin-bottom: 16px;
  padding: 0 8px;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: 8px;
}

.about-section {
  padding: 50px;
  text-align: center;
  background-color: #474e5d;
  color: white;
}

.container {
  padding: 0 16px;
}

.container::after, .row::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: grey;
}

.button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
}

.button:hover {
  background-color: #555;
}
.styler{
        color: black;
        text-decoration: none;

    }
    .styler:hover{
        color: rgb(56, 4, 87);
    }

@media screen and (max-width: 650px) {
  .column {
    width: 100%;
    display: block;
  }
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
}
</style>
 <div class="container">
    <div class="row">
        <div class="col-6 align-self-center">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Welcome to <br><a class="styler" href="https://meranaint.com">MERANA Web Developed</a><br> Website!</h1>
                <p class="lead mb-0">This Website is developed by <a class="styler" href="https://facebook.com/irana.bpr"><b>Rana Bepari</b></a> <br> <font size="2px">Powered By Laravel and Bootstrap 5</font></p>
            </div>
        </div>
        <div class="col-6">
            <h3 class="text-center dotFont">Contact Us</h3>
    @if(Session::has('message'))
<p class="alert alert-success">{{ Session::get('message') }}</p>
@endif
    <form action="/submit-contact" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" type="text" class="form-control" placeholder="Your Name">
            <small><span class="text-danger"> @error('name') {{$message}} @enderror </span></small>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control" placeholder="Your Email">
            <small><span class="text-danger"> @error('email') {{$message}} @enderror </span></small>
          </div>

          <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message" class="form-control" id="" rows="10"></textarea>
            <small><span class="text-danger"> @error('message') {{$message}} @enderror </span></small>
          </div>
          <div class="mb-3">
            <label class="form-label">Contact No</label>
            <input name="contact" type="text" class="form-control" placeholder="Phone No(Whatsapp)">
            <small><span class="text-danger"> @error('contact') {{$message}} @enderror </span></small>
          </div>
          <button class="btn btn-success" type="submit">Submit</button>
    </form>
<br>
        </div>
    </div>
 </div>
@endsection
