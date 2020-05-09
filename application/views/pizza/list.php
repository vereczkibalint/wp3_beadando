<?php if($pizzas != null || !empty($pizzas)): ?> 
<div class="container m-3">
    <h3 class="mb-3">Összes termék</h3>
    <div class="row">
        <?php foreach($pizzas as $item): ?>
            <div class="card m-3 mx-auto" style="width: 18rem;">
                <?php if($item->image): ?>
                    <img class="card-img-top" src="<?=base_url('uploads/pizza/'.$item->image)?>" alt="Card image cap">
                <?php else: ?>
                    <img class="card-img-top" src="<?=base_url('assets/images/pizza_placeholder.png')?>" alt="Nincs elérhető kép!">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?=$item->name?></h5>
                    <p class="card-text"><?=$item->price?> Ft</p>
                    <?php if($this->ion_auth->logged_in()): ?>
                        <a href="#" class="btn btn-primary btn-sm">Kosárba</a>
                    <?php else: ?>
                        <small>A rendeléshez kérjük jelentkezzen be!</small>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach;?>
            </div>
    <?php else: ?>
        <h2 class="text-center">Nincsenek áruk!</h2>
    <?php endif; ?>
</div>