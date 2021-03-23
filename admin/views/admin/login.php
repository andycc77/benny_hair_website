<style type="text/css">
    #content-login .error{
        display: none;
    }
</style>
    <div id="content-login">
    <h2 class="header-login">Login </h2>
    <form id="box-login" action="<?php echo site_url('admin/logining')?>" method="post">
        <p>
            <label class="req"> username </label>
            <br/>
            <input type="text" name="username" value="" id="username"/>
        </p>
        <p>
            <label class="req"> password </label>
            <br/>
            <input type="password" name="password" value="" id="password"/>
        </p>
        <!--p class="fl">
            <input type="checkbox" name="remember" value="1" id="remember"/>
            <label class="rem"> Remember me </label>
        </p-->
        <p class="fr">
            <input type="submit" value="Login" class="button themed" id="login"/>
        </p>

        <div class="clear"></div>
    </form>
    <!--a class="forgot" href="#"> Forgot password? </a-->
    <span class="message error"></span>
    <!--span class="message information">Just press <strong>Login</strong> or <strong>Error Test</strong></span-->
    </div>
<script>
<?php
    if(isset($errorMessage)){
?>
            $("#box-login").show('shake', 55);
            $(".header-login").show('shake', 55);
            $("#content-login .error").html('<?php echo $errorMessage?>');
            $("#content-login .error").show('blind', 500);
<?php
}
?>
</script>