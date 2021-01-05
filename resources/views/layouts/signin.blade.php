<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>25 Percent</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png"/>
  <link rel="stylesheet" href="{{ asset('../assets/css/fontawesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('../assets/css/icofont.css') }}">
  <link rel="stylesheet" href="{{ asset('../assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('../assets/css/lightcase.css') }}">
  <link rel="stylesheet" href="{{ asset('../assets/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('../assets/css/jquery-ui.min.css') }}">
  <link rel="stylesheet" href="{{ asset('../assets/css/nice-select.css') }}">
  <link rel="stylesheet" href="{{ asset('../assets/css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('../assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('../assets/css/responsive.css') }}">

  <style type="text/css">
      body {
        background-size: cover;
        background-image: linear-gradient(360deg, #00a3e8, transparent);
        height: 100vh;
        
        /*background-image: url("{{ asset('../assets/images/withdraw-bg.png') }}");*/
      }
      
      .logo img {
          border-radius: 50%;
      }
      
      .signin-wrapper .card {
          border: none;
      }
      
      .signin-wrapper .bottom-text {
          font-size: 16px;
      }
  </style>
</head>
<body>
  @yield('content')
  
  
  @yield('scripts')
</body>
</html>