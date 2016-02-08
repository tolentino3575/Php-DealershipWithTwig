<?php
  class Car
  {
      private $make_model;
      private $price;
      private $miles;
      private $image;

      function worthBuying($max_price, $max_mileage)
      {
          if (($this->price < ($max_price + 100)) &&
              ($this->miles < $max_mileage)) {
              return $this;
          }
      }

      function __construct($make_model, $price, $miles, $image)
      {
          $this->make_model = $make_model;
          $this->price = $price;
          $this->miles = $miles;
          $this->image = $image;
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
          // $float_mileage = (float) $new_mileage;
          // if ($float_mileage != 0) {
          //     $formatted_mileage = number_format($float_mileage, 2);
              $this->miles = $new_mileage;
          // }
      }
      function getMileage()
      {
          return $this->miles;
      }

      function setImage()
      {
          $this->image = $new_image;
      }
      function getImage()
      {
          return $this->image;
      }
  }

  $porsche = new Car("2014 Porsche 911", 114991, 7864, "img/911.jpg");
  $ford = new Car("2011 Ford F450", 55995, 14241, "img/f450.jpeg");
  $lexus = new Car("2013 Lexus RX 350", 44700, 20000, "img/rx350.jpg");
  $mercedes = new Car("Mercedes Benz CLS550", 39900, 37979, "img/cls550.jpeg");

  $cars = array($porsche, $ford, $lexus, $mercedes);
  $cars_matching_search = array();
  var_dump($cars_matching_search);
  foreach ($cars as $car) {
    if ($car->worthBuying($_GET["price"], $_GET["mileage"])) {
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
                $newMake = $car->getMakeModel();
                $newPrice = $car->getPrice();
                $newMileage = $car->getMileage();
                $newImage = $car->getImage();
                echo "<img src='$newImage'>";
                echo "<li>$newMake</li>";
                echo "<ul>";
                    echo "<li> $$newPrice</li>";
                    echo "<li> $newMileage</li>";
                echo "</ul>";
            }
        ?>
    </ul>
</body>
</html>
