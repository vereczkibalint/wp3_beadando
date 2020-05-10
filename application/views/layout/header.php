<!DOCTYPE html>
<html lang="hu">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PizzaShop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/custom.css')?>">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-pink">
  <a class="navbar-brand" href="<?php echo base_url(); ?>">PizzaShop</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#pizzaNavbar" aria-controls="pizzaNavbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="pizzaNavbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url()?>">Összes termék</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <?php if(!$this->ion_auth->logged_in()): ?>
      <li class="nav-item">
        <a href="<?php echo base_url('auth/login'); ?>" class="nav-link font-weight-bold">Bejelentkezés</a>
      </li>
      <li class="nav-item">
          <a href="<?php echo base_url('register'); ?>" class="nav-link font-weight-bold">Regisztráció</a>
      </li>
      <?php else: ?>
      <li class="nav-item mr-2">
        <a href="<?php echo base_url('cart'); ?>" class="nav-link">
          <i class="fas fa-shopping-cart"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="user_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $this->ion_auth->user()->row()->username; ?></a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="user_dropdown">
            <a class="nav-link" href="<?php echo base_url('orders'); ?>">Rendeléseim</a>
            <div class="dropdown-divider"></div>
            <a class="nav-link" href="<?php echo base_url('auth/change_password'); ?>">Jelszó módosítása</a>
            <div class="dropdown-divider"></div>
            <?php if($this->ion_auth->is_admin()): ?>
                <a class="nav-link" href="<?php echo base_url('admin'); ?>">Admin panel</a>
                <div class="dropdown-divider"></div>
            <?php endif; ?>
            <a class="nav-link" href="<?php echo base_url('auth/logout'); ?>">Kilépés</a>
        </div>
      </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
<main class="container">