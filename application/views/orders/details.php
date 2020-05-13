<?php if(isset($order) && !empty($order)): ?>
<div class="table-responsive">
    <a href="<?=base_url('orders')?>">&lt;Rendeléseim</a>
    <table class="table">
        <thead>
            <tr>
                <th>Termék neve</th>
                <th>Darabszám</th>
                <th>Termék ára</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($order as $order_item): ?>
            <tr>
                <td><?=$order_item['name']?></td>
                <td><?=$order_item['quantity']?></td>
                <td><?=$order_item['price']?> Ft</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p class="font-weight-bold text-right">Szállítási cím: <?php echo $order_item['postal_code'] . ' ' . $order_item['city'] . ', ' . $order_item['street'] . ' ' . $order_item['number'].'.'; ?></p>
</div>
<?php else: ?>
<h1 class="mt-2 text-center">Nincs megjeleníthető rendelés!</h1>
<?php endif; ?>
