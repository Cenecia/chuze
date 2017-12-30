<!DOCTYPE html>
<html>
  <head>
    <title>
      My Page
    </title>
  </head>
  <body>
    <h2>{{$customer->name}}</h2>
    <h3>Orders</h3>
    <ul>
      @foreach($customer->orders as $order)
        <li>{{$order->name}}</li>
      @endforeach
    </ul>
  </body>
</html>