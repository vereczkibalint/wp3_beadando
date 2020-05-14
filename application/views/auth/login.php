<?php $this->load->view('layout/header'); ?>
<div class='text-center loginBox'>
    <?php if(isset($message) && !empty($message)) : ?>
        <div class="alert alert-info"><?=$message?></div>
    <?php endif; ?>
    <?php echo form_open('auth/login', array('class'=>'login-form'));?>
    
        <h1 class="h3 mb-3 font-weight-normal">Bejelentkezés</h1>
        
        <?php echo form_label('Felhasználónév:','email', array('class'=>'sr-only'));?>
        <?php echo form_input($identity,set_value('username'), array(
            'type'=>'text',
            'id'=>'username',
            'class' => 'form-control',
            'placeholder'=>'Felhasználónév'
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