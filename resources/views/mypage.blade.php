<!DOCTYPE html>
<html>
  <head>
    <title>
      My Page
    </title>
  </head>
  <body>
    <h1>
      This is my page
    </h1>
    <p>
      {{ $var1 }}
    </p>
    @if($var1 == 'Hamburger')
      I love hamburgers
    @endif
    <p>
      {{ $var2 }}
    </p>
    <p>
      {{ $var3 }}
    </p>
    <ul>
      @foreach($orders as $order)
        <li>{{$order->name}}</li>
      @endforeach
    </ul>
  </body>
</html>