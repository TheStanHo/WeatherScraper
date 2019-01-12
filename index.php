<?php

        $currentWeather="";
        $error = "";
    if($_GET['city'])  {
        $city2 = ucwords($_GET['city']);
        
        $city = str_replace(' ', '-', $city2);
      
        $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
             $error = "That city could not be found.";
                }
            else {
              $exists = true;
                

        $forecastPage = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
           
            $pageArray = explode(')</span><p class="b-forecast__table-description-content"><span class="phrase">', $forecastPage);
            if(sizeof($pageArray) > 1)  {

           
           $secondPageArray = explode('</span></p></td><td',$pageArray[1]);
          
            if(sizeof($secondPageArray) > 1)  {
                $currentWeather = $secondPageArray[0];
            } else {
                $error = "That city could not be found";
            }

                
        }  else {
                $pageArray = explode('3 Day Weather Forecast Summary:</b> <span class="phrase">', $forecastPage);
                $secondPageArray = explode('</span></p><div class="forecast-cont">', $pageArray[1]);
                $currentWeather = $secondPageArray[0];
            //$error = "That city could not be found";
        }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script
      async
      src="https://www.googletagmanager.com/gtag/js?id=UA-131674608-1"
    ></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() {
        dataLayer.push(arguments);
      }
      gtag("js", new Date());

      gtag("config", "UA-131674608-1");
    </script>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link rel="shortcut icon" type="image/png" href="SH.png" />
    <link rel="icon" type="image/png" href="SH.png" />
    <title>Weather Scraper</title>
    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
      integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ"
      crossorigin="anonymous"
    />
    <style type="text/css">
      html {
        background: url(Background.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }

      body {
        background: none;
      }

      .container {
        text-align: center;
        margin-top: 100px;
        width: 450px;
      }

      input {
        margin: 20px;
      }

      #currentWeather{
          margin: 15px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h1>What's The Weather</h1>
      <form>
        <div class="form-group">
          <label for="city">Enter the name of a City.</label>
          <input
            type="text"
            class="form-control"
            name="city"
            id="city"
            aria-describedby="emailHelp"
            placeholder="Eg. London, Tokyo"
            
          />
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <div id="currentWeather"><?php 
        
        if($currentWeather)  {
            echo'<div class="alert alert-success" role="alert" style="width:435px;">
            The weather for the next 3 days: '.$currentWeather.'
          </div>';
        } else if($error)  {
            echo'<div class="alert alert-danger" role="alert style="width:435px;">
            City could not be found!
          </div>';
        }

        ?>

      </form>
    </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script
      src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
      integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
      integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
      integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
