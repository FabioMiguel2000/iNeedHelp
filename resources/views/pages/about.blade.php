@extends('layouts.navbar')

@section('content')

<!DOCTYPE html>
<html>
    
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
        }

        .about-section {
        padding: 50px;
        text-align: center;
        background-color: #474e5d;
        color: white;
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 300px;
            margin: auto;
            text-align: center;
            font-family: arial;
        }

        .title {
            color: grey;
            font-size: 18px;
        }
        h1{
            margin-top: 15px;
        }
        h2{
            margin: 15px;
        }

        button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

        a {
            text-decoration: none;
            font-size: 22px;
            color: black;
        }

        button:hover, a:hover {
           opacity: 0.7;
        }

    </style>
</head>

<body>

    <div class="about-section">
    <h1>About Us Page</h1>
    {{-- <p>Some text about who we are and what we do.</p>
    <p>Maybe list here some technologies, versions, ...</p> --}}
    </div>

    <h2 style="text-align:center">LBAW2153 Group Members</h2>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card">
                    <img src="https://previews.123rf.com/images/kritchanut/kritchanut1406/kritchanut140600093/29213195-male-silhouette-avatar-profile-picture.jpg" alt="Imagem1" style="width:100%">
                    <h1>Fabio Huang</h1>
                    <p class="title">CEO & Founder, Example</p>
                    <p>up201806829@g.uporto.pt</p>
                    <p>adicionar butoes para github, twitter (nao precisam de estar funcionais)</p>
                    <div style="margin: 24px 0;">
                      <a href="#"><i class="fa fa-github"></i></a> 
                      <a href="#"><i class="fa fa-twitter"></i></a>  
                      <a href="#"><i class="fa fa-linkedin"></i></a>  
                      <a href="#"><i class="fa fa-facebook"></i></a> 
                    </div>
                    <p><button>Contact</button></p>
                  </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card">
                    <img src="https://previews.123rf.com/images/kritchanut/kritchanut1406/kritchanut140600093/29213195-male-silhouette-avatar-profile-picture.jpg" alt="Imagem1" style="width:100%">
                    <h1>Ivo Ribeiro</h1>
                    <p class="title">CEO & Founder, Example</p>
                    <p>up201307718@g.uporto.pt</p>
                    <p>adicionar butoes para github, twitter (nao precisam de estar funcionais)</p>
                    <div style="margin: 24px 0;">
                      <a href="#"><i class="fa fa-github"></i></a> 
                      <a href="#"><i class="fa fa-twitter"></i></a>  
                      <a href="#"><i class="fa fa-linkedin"></i></a>  
                      <a href="#"><i class="fa fa-facebook"></i></a> 
                    </div>
                    <p><button>Contact</button></p>
                  </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card">
                    <img src="https://previews.123rf.com/images/kritchanut/kritchanut1406/kritchanut140600093/29213195-male-silhouette-avatar-profile-picture.jpg" alt="Imagem1" style="width:100%">
                    <h1>Pedro Pacheco</h1>
                    <p class="title">CEO & Founder, Example</p>
                    <p>up201806824@g.uporto.pt</p>
                    <p>adicionar butoes para github, twitter (nao precisam de estar funcionais)</p>
                    <div style="margin: 24px 0;">
                      <a href="#"><i class="fa fa-github"></i></a> 
                      <a href="#"><i class="fa fa-twitter"></i></a>  
                      <a href="#"><i class="fa fa-linkedin"></i></a>  
                      <a href="#"><i class="fa fa-facebook"></i></a> 
                    </div>
                    <p><button>Contact</button></p>
                  </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card">
                    <img src="https://previews.123rf.com/images/kritchanut/kritchanut1406/kritchanut140600093/29213195-male-silhouette-avatar-profile-picture.jpg" alt="Imagem1" style="width:100%">
                    <h1>Vasco Garcia</h1>
                    <p class="title">CEO & Founder, Example</p>
                    <p>up201805255@g.uporto.pt</p>
                    <p>adicionar butoes para github, twitter (nao precisam de estar funcionais)</p>
                    <div style="margin: 24px 0;">
                      <a href="#"><i class="fa fa-github"></i></a> 
                      <a href="#"><i class="fa fa-twitter"></i></a>  
                      <a href="#"><i class="fa fa-linkedin"></i></a>  
                      <a href="#"><i class="fa fa-facebook"></i></a> 
                    </div>
                    <p><button>Contact</button></p>
                  </div>
            </div>
        </div>
    </div>



    @include('layouts.footerbar')
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>

@endsection