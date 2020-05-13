<?php $this->load->view('layout/header'); ?>
<?php if(isset($message) && !empty($message)): ?>
<?php echo "<div class='alert alert-success'>".$message."</div>"; ?>
<?php endif; ?>
<?php if($items != null || !empty($items)): ?>
<div class="cartBox table-responsive">
    <h2 class="text-center">Kosár</h2>
    <table class="table">
        <thead>
            <th>Termék azonosító</th>
            <th>Termék neve</th>
            <th>Termék ára</th>
            <th>Műveletek</th>
        </thead>
        <tbody>
            <?php foreach($items as $item): ?>
            <tr>
                <td><?=$item['item_id']?></td>
                <td><?=$item['name']?></td>
                <td><?=$item['price']?> Ft</td>
                <td><a href="<?=base_url('cart/remove/'.$item['item_id'])?>" class="text-danger">Töröl</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p class="font-weight-bold text-right">Összesen: <span><?=$total?> Ft</span></p>
    <a class="btn btn-success float-right" href="<?=base_url('cart/order')?>">Megrendel</a>
</div>
<?php else: ?>
<h1 class="text-center">A kosár üres!</h1>
<?php endif; ?>
<?php $this->load->view('layout/footer'); ?>