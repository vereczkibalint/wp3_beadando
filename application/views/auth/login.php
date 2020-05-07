<?php $this->load->view('layout/header'); ?>
<div class='text-center loginBox'>
    <div id="infoMessage"><?php echo $message;?></div>
    <?php echo form_open('auth/login', array('class'=>'login-form'));?>
    
        <h1 class="h3 mb-3 font-weight-normal">Bejelentkezés</h1>
        
        <?php echo form_label('Email:','email', array('class'=>'sr-only'));?>
        <?php echo form_input($identity,set_value('email'), array(
            'type'=>'email',
            'id'=>'email',
            'class' => 'form-control',
            'placeholder'=>'Email cím'
        ));?>
        <?php echo form_error('email');?>
        
        <br>
        
        <?php echo form_label('Password:', 'password', array('class'=>'sr-only'));?>
        <?php echo form_password($password,'', array(
            'type'=>'password',
            'id'=>'password',
            'class' => 'form-control',
            'placeholder'=>'Jelszó'
        ));?>
        <?php echo form_error('password');?>
        
        <br>
        
        <?php echo lang('login_remember_label', 'remember');?>
        <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
        
        <br>
        
        <?php echo form_submit('submit','Bejelentkezés',array(
            'class'=>'btn btn-primary'
        )); ?>
        
    <?php echo form_close();?>
</div>
<?php $this->load->view('layout/footer'); ?>