{if $username_changed}
    username was changed.<br>
{/if}

{if $password_changed}
    password was changed.<br>
{/if}

{if $nothing_changed}
    password was changed.<br>
{/if}

<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Login settings</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{$smarty_url}?module=account&page=save" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" value="{$login_username}">
                    </div>
                    <div class="form-group">
                        <label for="newpass">Set new Password</label>
                        <input type="password" class="form-control" id="newpass" name="newpass" placeholder="Password">
                        <input type="password" class="form-control" id="newpass_again"name="newpass_again" placeholder="Password again">
                    </div>
                    <br><br>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Your current Password"><br>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </div>
    <!--/.col (left) -->
</div>   <!-- /.row -->