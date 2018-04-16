<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @yield(css)

    <title>MVC Template Test</title>
</head>
<body>
    <header>
      <h2>nice header</h2>
    </header>

    @yield(content)

    <footer>
      <h2>nice footer</h2>
    </footer>

    @yield(script)
</body>
</html>
