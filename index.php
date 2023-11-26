<?php
  if(!isset($_SESSION)) {
    session_start();
  }

  require_once 'autoload.php';
  require_once 'config/config.php';

  $controller = isset($_GET['controller']) 
    ? ucfirst($_GET['controller']) . 'Controller' 
    : ucfirst(DEFAULT_CONTROLLER) . 'Controller';
    
  $action = isset($_GET['action']) ? $_GET['action'] : DEFAULT_ACTION;

  if(!class_exists($controller) || !method_exists($controller, $action)) {
    require_once '404.php';
    die();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/assets/css/index.css" />
  <title>PHP MVC STARTER</title>
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
  <script src="/assets/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <header class="mb-3">
    <nav class="navbar navbar-expand-lg bg-dark" aria-label="Thirteenth navbar example">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-lg-flex" id="navbar">
          <a class="navbar-brand col-lg-3 me-0" href="#">Centered nav</a>
          <ul class="navbar-nav col-lg-6 justify-content-lg-center">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
              <ul class="dropdown-menu bg-dark">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
          </ul>
          <div class="d-lg-flex col-lg-3 justify-content-lg-end">
            <img class="img-fluid rounded" src="/assets/images/default.png" alt="profile" style="width: 35px;" />
          </div>
        </div>
      </div>
    </nav>
  </header>
  <main class="container-fluid p-0">
    <?php
      $controller = new $controller();
      $controller->$action();
    ?>
  </main>
</body>
</html>
