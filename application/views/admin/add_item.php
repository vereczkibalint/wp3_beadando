<?php $this->load->view('layout/header'); ?>
<div class="itemCreateBox mx-auto mt-5">
    <?php if(isset($message) && !empty($message)): ?>
    <?php echo "<div class='alert alert-info'>".$message."</div>"; ?>
    <?php endif; ?>
    <h2 class="text-center mb-4">Termék létrehozása</h2>
    <?php echo form_open_multipart(); ?>
    
    <?php echo form_label('Megnevezés:','name');?>
    <?php echo form_input('name',set_value('name'), array(
        'type'=>'text',
        'id'=>'name',
        'class' => 'form-control mb-3',
        'placeholder'=>'Megnevezés'
    ));?>
    
    <?php echo form_error('name');?>
    
    <?php echo form_label('Kategória:','category');?>
    <select name="category" id="category" class="form-control mb-3">
        <?php foreach($categories as $category): ?>
        <option value="<?=$category->category_id?>"><?=$category->category_name?></option>
        <?php endforeach; ?>
    </select>
    
    <?php echo form_error('category');?>
    
    <?php echo form_label('Ár:', 'price'); ?>
    <?php
    $data = array(
        'name' => 'price',
        'id' => 'price',
        'class' => 'form-control mb-3',
        'type' => 'number',
        'min' => '0',
        'max' => '9999'
      );

     echo form_input($data, set_value('price'));
    ?>
    <?php echo form_error('price');?>
    
    <?php echo form_label('Kép:', 'image'); ?>
    <?php echo form_upload('image', ["class" => "form-control"]); ?>
    <?php echo form_error('image');?>
    
    <?php echo form_submit('submit', 'Mentés', ["class" => "btn btn-primary mt-3"]); ?>
    
    
    <?php echo form_close(); ?>
</div>
<?php $this->load->view('layout/footer'); ?>