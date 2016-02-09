<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/car.php";

    $app = new Silex\Application();

    $app['debug']=true;

    $app->get("/", function() {
        return "<!DOCTYPE html>
        <html>
        <head>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>
            <title>Find A Car</title>
        </head>
        <body>
            <div class='container'>
                <h1>Find a Car!</h1>
                <form action='/car_output'>
                    <div class='form-group'>
                        <label for='price'>Enter Maximum Price:</label>
                        <input id='price' name='price' class='form-control' type='number'>
                        <label for='mileage'>Enter Maximum Mileage:</label>
                        <input id='mileage' name='mileage' class='form-control' type='number'>
                    </div>
                    <button type='submit' class='btn-success'>Submit</button>
                </form>
            </div>
        </body>
        </html>
        ";
    });

    $app->get("/car_output", function(){

    $porsche = new Car("2014 Porsche 911", 114991, 7864, "img/911.jpg");
    $ford = new Car("2011 Ford F450", 55995, 14241, "img/f450.jpeg");
    $lexus = new Car("2013 Lexus RX 350", 44700, 20000, "img/rx350.jpg");
    $mercedes = new Car("Mercedes Benz CLS550", 39900, 37979, "img/cls550.jpeg");

    $cars = array($porsche, $ford, $lexus, $mercedes);
    $cars_matching_search = array();
    foreach ($cars as $car) {
      if ($car->worthBuying($_GET["price"], $_GET["mileage"])) {
        array_push($cars_matching_search, $car);

      }

    }


    if (!empty($cars_matching_search)) {
     $output = "";
      foreach ($cars_matching_search as $car) {

          $newMake = $car->getMakeModel();
          $newPrice = $car->getPrice();
          $newMileage = $car->getMileage();
          $newImage = $car->getImage();

          $output = $output . "
          <img src='$newImage'>
          <li>$newMake</li>
          <ul>
          <li>$$newPrice</li>
          <li> $newMileage</li>
          </ul>
          ";
      }
      return $output;
    }
    else {
      return "There are no cars to show";
    }

    });

    return $app;
?>
