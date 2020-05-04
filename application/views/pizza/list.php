<?php if($pizzas != null || !empty($pizzas)): ?> 
    <h3>Összes árucikk</h3>
    <?php foreach($pizzas as $item): ?>
        <ul>
            <li class="media">
                <div class="media-body">
                    <h5 class="mt-0 mb-1"><?=$item->name?></h5>
                    <?=$item->price?><?php echo(' Ft')?><br/>
                    <a class="btn btn-primary btn-sm" href="<?=site_url('ware/'.$item->id)?>"><?php echo('Megnéz')?></a>
                </div>
            </li>
        </ul>
    <?php endforeach;?>
<?php else: ?>
    <?php echo('Nincsenek áruk')?><br/>
<?php endif; ?>


