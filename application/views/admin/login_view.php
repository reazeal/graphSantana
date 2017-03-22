<div class="hold-transition login-page">

<div class="login-box">
    <div class="login-logo">
        <b>Dash</b>Board
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Silahkan Login pada Sistem</p>

        <?php echo $this->session->flashdata('message');?>
        <?php echo form_open('');?>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Username" name="identity">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <?php echo form_error('identity');?>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                 <?php echo form_error('password');?>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <?php echo form_checkbox('remember','1',FALSE);?> Remember me
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                <?php echo form_hidden('redirect_to',$redirect_to);?>
                <?php echo form_submit('submit', 'Sign In', 'class="btn btn-primary btn-block btn-flat"');?>
                </div>
                </div>
        <?php echo form_close();?>

        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" onclick="showCredit(CREDIT,WEB_TITLE);" class="btn btn-block btn-social btn-facebook btn-flat" disabled=""><i class="fa fa-facebook"></i> Sign in using
                Facebook</a>
            <a href="#" onclick="showCredit(CREDIT,WEB_TITLE);" class="btn btn-block btn-social btn-google btn-flat" disabled=""><i class="fa fa-google-plus"></i> Sign in using
                Google+</a>
        </div>
    </div>
</div>
</div>

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
<div><div>