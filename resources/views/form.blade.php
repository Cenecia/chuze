<!DOCTYPE html>
<html>
  <head>
    <title>
      Form
    </title>
  </head>
  <body>
      <form action="post_to_me" method="POST">
          <input type="text" name="name" placeholder="Enter your name">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="submit">
    </form>
  </body>
</html>