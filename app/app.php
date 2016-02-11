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


    $cars_matching_search = array();
    foreach (Car::getAll() as $car) {
      if ($car->worthBuying($_GET["price"], $_GET["mileage"])) {
        array_push($cars_matching_search, $car);
      }
    }
      return $app['twig']->render('caroutput.html.twig', array('cars' => $cars_matching_search));

    });

    $app->get("/newlisting", function() use ($app) {
      return $app['twig']->render('newlisting.html.twig');
    });

    $app->post("/listingresult", function() use ($app) {
      $car = new Car($_POST['make_model'], $_POST['price'], $_POST['mileage']);
      $cars_listed = array($car);
      $car->save();
      return $app['twig']->render('listingresult.html.twig', array('newcars' => $cars_listed));
    });

    return $app;
?>
