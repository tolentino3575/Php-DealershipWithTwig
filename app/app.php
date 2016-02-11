<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/car.php";

    session_start();
    if (empty($_SESSION['list_of_cars'])) {
        $_SESSION['list_of_cars'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app['debug']=true;

    $app->get("/", function() use ($app) {

      return $app['twig']->render('home.html.twig', array('cars' => Car::getAll()));


    });

    $app->get("/car_output", function() use ($app) {

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
      return $app['twig']->render('caroutput.html.twig', array('cars' => $cars_matching_search));

    });

    $app->get("/newlisting", function() use ($app) {
      return $app['twig']->render('newlisting.html.twig');
    });

    $app->post("/newlisting", function() use ($app) {
      $car = new Car($_POST['make_model'], $_POST['price'], $_POST['mileage']);
      $car->save();
      return $app['twig']->render('listingresult.html.twig', array('newcars' => $car));
    });

    return $app;
?>
