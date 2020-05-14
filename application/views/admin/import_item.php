<?php $this->load->view('layout/header'); ?>
<?php if(isset($message) && !empty($message)): ?>
<div class="alert alert-info mt-3"><?=$message?></div>
<?php endif; ?>
<div class="importItemBox mt-3">
    <p><a href="<?=base_url('admin')?>">&lt;Admin panel</a></p>
    <h3 class="text-center">Termék importálása CSV-ből</h3>
    <?php echo form_open_multipart('admin/import_item'); ?>
        <?php echo form_upload('import_file', '', ['class' => "form-control mt-5"]); ?>
    
        <?php echo form_submit('submit', 'Küldés', ["class" => "btn btn-primary mt-3 float-right"]); ?>
    <?php echo form_close(); ?>
</div>
<?php $this->load->view('layout/footer'); ?>