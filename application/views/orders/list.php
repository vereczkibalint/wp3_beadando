<?php if(isset($orders) && !empty($orders)): ?>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Rendelés azonosítója</th>
                <th>Rendelés dátuma</th>
                <th>Végösszeg</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($orders as $order): ?>
            <tr>
                <td><?=$order['order_id']?></td>
                <td><?=$order['order_date']?></td>
                <td><?=$order['sumprice']?> Ft</td>
                <td><a href="<?=base_url('orders/details/'.$order['order_id'])?>">Részletek</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php else: ?>
<h1 class="mt-2 text-center">Nincs megjeleníthető rendelés!</h1>
<?php endif; ?>
