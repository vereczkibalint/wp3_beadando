<?php $this->load->view('layout/header'); ?>
<div class="adminPanelBox mt-3">
    <?php if(isset($message) && !empty($message)): ?>
    <?php echo "<div class='alert alert-info'>".$message."</div>"; ?>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <article class="card-group-item">
                    <header class="card-header"><h6 class="title">Admin panel</h6></header>
                    <div class="filter-content">
                        <div class="list-group list-group-flush">
                        <a href="<?=base_url('admin/manage/users')?>" class="list-group-item">Felhasználók kezelése</a>
                        <a href="<?=base_url('admin/manage/items')?>" class="list-group-item">Termékek kezelése</a>
                        </div> 
                    </div>
                </article>
            </div> <!-- .card -->
        </div> <!-- .col-md-4 -->
        <div class="col-md-8"></div>
    </div> <!-- .row -->
</div> <!-- .adminPanelBox -->
<?php $this->load->view('layout/footer'); ?>