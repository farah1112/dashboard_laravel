<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Recette</title>
    <style>
#contact{
  
  padding: 3px;
width: 100%;
margin-top:114px;
}
#formul{
    margin-top:10%;
}
</style>
</head>
<body>


<!--header-->




    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4" style="margin-top:70px;">
                <h2><g>Have an account?</g></h2>
                <hr>
                <form action="{{Route('login')}}" method="post">
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
                        <span class="text-danger" >@error('email'){{$message}} @enderror</span>

                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" value="{{old('password')}}">
                        <span class="text-danger" >@error('password'){{$message}} @enderror</span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-success" type="submit">Connecter</button>
                    </div>
                </form>
            </div>  
        </div>
    </div>
    <br><br><br><br>
<!--footer-->
<section id="contact" >
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center m-t-lg m-b-lg">
              <br>
            <a href="#" target="_blank"><i class="fab fa-facebook-square" style='font-size:25px;color:white'></i></a>
                <a href="#" target="_blank"><i class="fab fa-linkedin" style='font-size:25px;color:white'></i></a>
                <a href="#" target="_blank"><i class="fab fa-instagram" style='font-size:25px;color:white'></i></a>
                <p style="color:#FFFFFF;"><strong>&copy; 2022 Farah Weslati</strong><br/> </p>
                
            </div>
        </div>
    </div>
</section>
</body>
</html>