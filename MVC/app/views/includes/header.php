<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/style.css">

  <title><?php echo SITENAME; ?></title>
</head>

<body>

  <div class="container">

  


<nav class="navbar navbar-expand-sm navbar-light bg-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
      <li class="nav-item">
      <a class="nav-link" href="/MVC/Home">Home</a>
    </li>
        <?php
    if (isLoggedInAsAdmin()) {
      echo '<li class="nav-item"><a class="nav-link" href="/MVC/Admin">Admin</a></li>';
    }
  ?>
    <?php
    if (isLoggedIn()) {
      echo '<li class="nav-item"><a class="nav-link" href="/MVC/User/displayUserProfile/'.$_SESSION['user_id'].'"></i> Profile </a></li>';
      echo '<li class="nav-item"><a class="nav-link" href="/MVC/Wishlist/viewWishlist"></i> Wishlist </a></li>';
      echo '<li class="nav-item"><a class="nav-link" href="/MVC/Purchase/viewOrderHistory"></i> Order History </a></li>';
    }
  ?>

      </ul>
    
    <ul class="nav navbar-nav navbar-right">
    <?php
    //if not logged in, button add to cart, add to wishlist and details won't show
    if (isLoggedIn()) {
      echo '<li class="nav-item"><a class="nav-link" href="/MVC/TwoFA/Setup"><i class="fa fa-key" aria-hidden="true"></i> 2FA </a></li>';
      echo '<li class="nav-item"><a class="nav-link" href="/MVC/User/viewUserSettings/'.$_SESSION['user_id'].'"><i class="fa-solid fa-gear"></i> Settings </a></li>';
      echo '<li class="nav-item"><a class="nav-link" href="/MVC/Purchase/viewCart"><i class="fa-solid fa-cart-shopping"></i> Cart </a></li>';
      echo '<li class="nav-item"><a class="nav-link" href="/MVC/Login/logout"><i class="fa-solid fa-sign-out"></i> Logout  '. $_SESSION['user_username'].'</a></li>';
    } 
    else {
      echo '<li class="nav-item"><a class="nav-link" href="/MVC/Login/Create"><i class="fa-solid fa-user-plus"></i> Sign Up</a></li>
          <li class="nav-item"><a class="nav-link" href="/MVC/Login/"><i class="fa-solid fa-right-to-bracket"></i> Login</a></li>';
    }
    ?>
  </ul>
    </div>
  </div>
</nav>
