<?php

$city = $_GET["city"];
$result = "";
$err_msg = "";
$show = "none";
$show_err = "none";

if($city){

  if(file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$city."&APPID=0973c4fd257fbf6cba72d310944a4f94")){

    $url_content = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$city."&APPID=0973c4fd257fbf6cba72d310944a4f94");
    $weatherArray = json_decode($url_content,true);//built in function to get the json file arranged in an array
    $result = "Expected weather in ".$city." is ".$weatherArray['weather'][0]['description']." with humidity of ".$weatherArray['main']['humidity']."
    and temperature ".$weatherArray['main']['temp']." k";

  }else{

    $result = "Sorry, city not found";

  }
}
else{

  $result = "please enter a city!";

}

if($result){

  $show = "block";

}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Weather</title>
    <style = "text/css">

      #city {

        width: 400px;

      }

      #form{

        margin-top: 250px;
        margin-left: 300px;

      }

      #but1 {

        margin-left: 165px;

      }

      #error {

        margin-top: 45px;
        width: 400px;
        display: none;

      }

      #result {

        margin-top: 45px;
        width: 400px;
        display: <?php echo $show;?>;

      }

    </style>
  </head>
  <body style="background: url(background.jpg) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
    <div class = "container">
      <form class = "justify-content-center" id="form">
        <div class="form-group">
          <label for="city"><h1>Let's check the Weather!</h1></label>
          <input type="text" name="city" class="form-control" id="city" value="<?php if($city){
            echo $city;
          } ?>" placeholder="Enter city">
        </div>
          <button type="submit" id="but1" class="btn btn-primary">Submit</button>
          <div class="alert alert-danger" role="alert" id="error">
          </div>
          <div class="alert alert-info" role="alert" id="result">
            <?php echo $result.$err_msg; ?>
          </div>
      </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script type="text/javascript">

      $("#but1").click(function(){

        if($("#city").val().length == 0){

          $("#error").html("The city name is required.");
          $("#error").css("display","block");

          return false;

        }
        else{

          $("#error").html("");
          $("#error").css("display","none");
          $("#result").css("display","block");

          return true;

        }

      });
    </script>
  </body>
</html>
