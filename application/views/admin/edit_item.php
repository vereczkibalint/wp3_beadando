<?php $this->load->view('layout/header'); ?>
<div class="editItemBox mt-5">
    <h2 class="text-center mb-4"><?=$pizza->name?> szerkesztése</h2>
    <?php echo form_open(); ?>
    
    <?php echo form_label('Megnevezés:','name');?>
    <?php echo form_input('name',$pizza->name, array(
        'type'=>'text',
        'id'=>'name',
        'class' => 'form-control mb-3',
        'placeholder'=>'Megnevezés'
    ));?>
    <?php echo form_error('name');?>
    
    <?php echo form_label('Kategória:','category');?>
    <select name="category" id="category" class="form-control mb-3">
        <?php foreach($categories as $category): ?>
        <option value="<?=$category->category_id?>" <?php echo $pizza->category_id == $category->category_id ? "selected" : ""; ?>><?=$category->category_name?></option>
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

     echo form_input($data, $pizza->price);
    ?>
    <?php echo form_error('price');?>
    
    <?php echo form_submit('submit', 'Mentés'); ?>
    
    
    <?php echo form_close(); ?>
</div>
<?php $this->load->view('layout/footer'); ?>