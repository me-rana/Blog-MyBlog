<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{Route::currentRouteName()." - ".config('app.name')}}</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="assets/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <style>
        @import url('https://fonts.googleapis.com/css2?family=PT+Serif&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Tektur&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Handjet:wght@400&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Vina+Sans&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Saira+Condensed&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Croissant+One&display=swap');

        .menu{
            font-family: 'Saira Condensed', sans-serif;
        }
        .navmenu{
            font-family: 'Croissant One', cursive;
        }

        .p-sug{
            font-size: 8px;
        }


        .customfont{
             font-family: 'PT Serif', serif;
        }
        blockquote{
          background: #dfdede;
          border-left: 5px solid rgba(255, 0, 0, 0.555);
          padding: 4px;
          text-align: center;
          font-size: 18px;
          font-weight: bold;

        }
            table{
                width: 100%;
            }
            td,th {
            border: 1px solid #ddd;
            padding: 8px;
            }

            tr:nth-child(even){background-color: #f2f2f2;}

            tr:hover {background-color: #ddd;}

            th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
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
      @if (Route::currentRouteName() == 'Search Result')
      <script>
        window.location.hash = '#search';
      </script>
      @endif
    </head>
    <body>
        @include('frontend.theme.menu')

