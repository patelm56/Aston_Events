@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
<link href="./Css/style.css" rel="stylesheet" type="text/css">
<meta name="author" content="Mital Patel">
<meta charset= utf-8>
    <title> Welcome to the Aston Events</title>

</head>


    <body>
          <div>
              <h1>Welcome to the Aston Events</h1>
              <p> On the Aston Events page you register and join multiple events or you could become an event organiser. You are still able to view the events that are shown on this website without having to take participation in the events.</p>

<section id="boxes">

      <div class="containers">
<img src="./photos/pic1.png" class="bg" style="width:35%;">

      <div class="box">

        <h3><a href="/events/type/culture">Culture</a></h3>
        <img src="./photos/culture.png" class="culture" style="width:30%">
        <p style="color:black"> These are the different culture events that you can attend.</p>
      </div>


      <div class="box2">

        <h3><a href="/events/type/sport">Sports</a></h3>
        <img src="./photos/sport.png" class="sport" style="width:30%;">
        <p style="color:black"> These are the different sport events that you can attend.</p>

      </div>

      <div class="box3">

      <h3><a href="/events/type/other">Others</a></h3>
        <img src="./photos/others.png" class="others" style="width:30%;">
        <p style="color:black"> These are other events that you can attend.</p>
      </div>



      </div>
</div>
    </section>




            <div id="main">

                  <ul id="menus">
                    <h4>
                      <li>Contact Us</li>

                      <p> +44 (0)121 204 3000 </p>
                     </h4>
                  </ul>
          </p>

          <p id="footer"> Copyright &copy; 2018 Aston Events</p>
        </div>
    </body>


</html>

@endsection
