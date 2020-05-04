<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-pink">
  <a class="navbar-brand" href="<?php echo base_url(); ?>">PizzaShop</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#pizzaNavbar" aria-controls="pizzaNavbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="pizzaNavbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('pizza/list'); ?>">Összes termék</a>
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
        <a href="#" class="nav-link">
          <i class="fas fa-shopping-cart"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="user_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $this->ion_auth->user()->row()->username; ?></a>
        <div class="dropdown-menu" aria-labelledby="user_dropdown">
            <a class="nav-link" href="<?php echo base_url('auth/logout'); ?>">Kilépés</a>
        </div>
      </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>