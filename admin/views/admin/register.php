<div id="container">
    <form action="<?=site_url("/admin/registering")?>" method="post"  >
        <table class="table table-bordered">
            <tr>
                <td>
                    Account
                </td>
                <td>
                <?php if(isset($account)){ ?>
                    <input type="text" name="username"
                        value="<?=htmlspecialchars($account)?>" />
                <?php }else{ ?>
                    <input type="text" name="username" />
                <?php } ?>
                </td>
            </tr>
            <tr>
                <td>
                    Password
                </td>
                <td>
                    <input type="password" name="password" />
                </td>
            </tr>
            <tr>
                <td>
                    Re-type Password
                </td>
                <td>
                    <input type="password" name="passwordrt" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input class="btn" type="submit" value="送出" />
                </td>
            </tr>
        </table>
    </form>
    <?php  if (isset($errorMessage)){?>
    <div class="alert alert-error">
        <?php echo $errorMessage?>
    </div>
    <?php }?>
</div>