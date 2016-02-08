<?php
  class Car
  {
      public $make_model;
      public $price;
      public $miles;

      function worthBuying($max_price)
      {
          return $this->price < ($max_price + 100);
      }

      function __construct($make_model, $price, $miles)
      {
          $this->make_model = $make_model;
          $this->price = $price;
          $this->mileage = $miles;
      }

      function setMakeModel($new_make)
      {
          $this->make_model = $new_make;
      }
      function getMakeModel()
      {
          return $this->make_model;
      }

      function setPrice($new_price)
      {
          $float_price = (float) $new_price;
          if ($float_price != 0) {
              $formatted_price = number_format($float_price, 2);
              $this->price = $formatted_price;
          }
      }

      function getPrice()
      {
          return $this->price;
      }

      function setMileage($new_mileage)
      {
          $float_mileage = (float) $new_mileage;
          if ($float_mileage != 0) {
              $formatted_mileage = number_format($float_mileage, 2);
              $this->mileage = $formatted_mileage;
          }
      }

      function getMileage()
      {
          return $this->mileage;
      }
  }

  $porsche = new Car("2014 Porsche 911", 114991, 7864);
  $ford = new Car("2011 Ford F450", 55995, 14241);
  $lexus = new Car("2013 Lexus RX 350", 44700, 20000);
  $mercedes = new Car("Mercedes Benz CLS550", 39900, 37979);

  $cars = array($porsche, $ford, $lexus, $mercedes);

  $cars_matching_search = array();
  foreach ($cars as $car) {
    if ($car->worthBuying($_GET["price"])) {
      array_push($cars_matching_search, $car);
    }
  }
  ?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Car Dealership's Homepage</title>
</head>
<body>
    <h1>Your Car Dealership</h1>
    <ul>
        <?php
            foreach ($cars_matching_search as $car) {
                echo "<li> $car->make_model </li>";
                echo "<ul>";
                    echo "<li> $$car->price </li>";
                    echo "<li> $car->mileage </li>";
                echo "</ul>";
            }
        ?>
    </ul>
</body>
</html>
