<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Login</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
</head>
<body>


<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="https://scontent-hbe1-1.xx.fbcdn.net/v/t39.30808-1/469924355_1322732528891772_1341830967115154656_n.jpg?stp=dst-jpg_s200x200_tt6&_nc_cat=106&ccb=1-7&_nc_sid=1d2534&_nc_ohc=000N5rRri9gQ7kNvwHYbt6N&_nc_oc=AdnYKPao3BeBrVxQ-6bPNnd25RtyAKh7wD_7wQ1K0jSpsZ76aNQA5NVtwdY8LHd1e_Y&_nc_zt=24&_nc_ht=scontent-hbe1-1.xx&_nc_gid=NcF-veKaYB6jE1LESxDlWg&oh=00_AfSiAT2bBWXaH7zX9Y44SnIpHnWu7qoROGbyEyAKaPdXGQ&oe=687E0D55" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form method="POST" action="{{ route('Chat') }}">
        @csrf
      <input type="text" id="login" class="fadeIn second" name="username" placeholder="Enter your username" >
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>


</body>
</html>