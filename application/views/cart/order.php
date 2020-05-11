<?php $this->load->view('layout/header'); ?>
<div class='orderBox'>
    <?php echo form_open('cart/order', array('class'=>'form-signin'));?>
        <h1 class="h3 mb-3 font-weight-normal">Szállítási adatok</h1>
        <?php echo form_label('Irányítószám:','irsz');?>
        <?php echo form_input('irsz',set_value('irsz'), [
            'type'=>'text',
            'id'=>'irsz',
            'class' => 'form-control',
            'placeholder'=>'Irányítószám'
        ]);?>
        <?php echo form_error('irsz');?>

        <?php echo form_label('Város:','varos');?>
        <?php echo form_input('varos',set_value('varos'),[
            'type'=>'text',
            'id'=>'varos',
            'class' => 'form-control',
            'placeholder'=>'Város'
        ]);?>
        <?php echo form_error('varos');?>

        <?php echo form_label('Cím:','cim');?>
        <?php echo form_input('cim',set_value('cim'),[
            'type'=>'text',
            'id'=>'cim',
            'class' => 'form-control',
            'placeholder'=>'Cím'
        ]);?>
        <?php echo form_error('cim');?>

        <?php echo form_label('Házszám:','hazszam');?>
        <?php echo form_input('hazszam',set_value('hazszam'), [
            'type'=>'text',
            'id'=>'hazszam',
            'class' => 'form-control mb-3',
            'placeholder'=>'Házszám'
        ]);?>
        <?php echo form_error('hazszam');?>

        <?php echo form_submit('submit','Rendelés véglegesítése',[
            'class'=>'btn btn-success btn-block'
        ]); ?>
    <?php echo form_close();?>
</div>
<?php $this->load->view('layout/footer'); ?>