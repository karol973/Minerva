<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home page</title>
</head>
<body>
    @auth
        <p> Gratulacje, zalogowałeś się!</p>
        <form action="/logout" method="POST">
        @csrf 
        <button>Log out</button>
</form>
    @else
    @if ($errors->any())
  <div style="color:red">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
        <div style="border:3px solid black">
            <h2>Register</h2>
            <form action="/register" method="POST">
            @csrf
            <input type="text" name="name" placeholder="name">
            <input type="text" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">
            <button>Register</button>
            </form>
        </div>
        
        <div style="border:3px solid black">
            <h2>Login</h2>
            <form action="/login" method="POST">
            @csrf
            <input type="text" name="name" placeholder="name">
            <input type="password" name="password" placeholder="password">
            <button>Log in</button>
            </form>
        </div>
    @endauth
</body>
</html>