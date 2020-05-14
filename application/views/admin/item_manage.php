<?php $this->load->view('layout/header'); ?>
<div class="adminPanelBox mt-3">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <article class="card-group-item">
                    <header class="card-header"><h6 class="title">Admin panel</h6></header>
                    <div class="filter-content">
                        <div class="list-group list-group-flush">
                        <a href="<?=base_url('admin/manage/users')?>" class="list-group-item">Felhasználók kezelése</a>
                        <a href="<?=base_url('admin/manage/items')?>" class="list-group-item active">Termékek kezelése</a>
                        </div> 
                    </div>
                </article>
            </div> <!-- .card -->
        </div> <!-- .col-md-4 -->
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>Azonosító</th>
                        <th>Megnevezés</th>
                        <th>Ár</th>
                        <th>Műveletek</th>
                    </thead>
                    <tbody>
                        <?php if(empty($pizzas)) : ?>
                            <h3 class="text-center">Nincs megjeleníthető termék!</h3>
                        <?php else: ?>
                        <?php foreach($pizzas as $pizza): ?>
                        <tr>
                            <td><?=$pizza['id']?></td>
                            <td><?=$pizza['name']?></td>
                            <td><?=$pizza['price']?></td>
                            <td><a href="<?=base_url('admin/edit_item/'.$pizza['id'])?>">Szerkeszt</a> <a href="<?=base_url('admin/delete_item/'.$pizza['id'])?>" class="text-danger">Töröl</a></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <a href="<?=base_url('admin/add_item')?>">Termék felvétele</a> | <a href="<?=base_url('admin/import_item')?>">Termék importálása CSV-ből</a>
        </div>
    </div> <!-- .row -->
</div> <!-- .adminPanelBox -->
<?php $this->load->view('layout/footer'); ?>