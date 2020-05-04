<?php $this->load->view('layout/header'); ?>
<?php $this->load->view('layout/navbar'); ?>
<div class='text-center'>
    <?php echo form_open('login', array('class'=>'login-form'));?>
        <h1 class="h3 mb-3 font-weight-normal">Bejelentkezés</h1>
        <?php echo form_label('Email:','email', array('class'=>'sr-only'));?>
        <?php echo form_input('email',set_value('email'), array(
            'type'=>'email',
            'id'=>'email',
            'class' => 'form-control',
            'placeholder'=>'Email cím'
        ));?>
        <?php echo form_error('email');?>
<br>
        <?php echo form_label('Password:', 'password', array('class'=>'sr-only'));?>
        <?php echo form_password('password','', array(
            'type'=>'password',
            'id'=>'password',
            'class' => 'form-control',
            'placeholder'=>'Jelszó'
        ));?>
        <?php echo form_error('password');?>
<br>
        <?php echo form_submit('login','Bejelentkezés',array(
            'class'=>'btn btn-lg btn-primary btn-block'
        )); ?>
    <?php echo form_close();?>
</div>
<?php $this->load->view('layout/footer'); ?>