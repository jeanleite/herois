<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Herois</title>
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
    <header>
      <!-- Fixed navbar -->
      @include('components.navbar')
    </header>
    <div class="container">
      <div id="app">
        @yield('content')
      </div>
    </div>

    <script src="/js/app.js"></script>
  </body>
</html>
