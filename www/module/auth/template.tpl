{if $page == 'login'}

    {if $login_success == true}
        You are logged in as {$login_username}.
    {else}
   <!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>clamscribe | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="include/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Sign In</div>


            <form action="{$smarty_url}?module=auth&action=login" method="post">

                <div class="body bg-gray">
                {if $fail==true}
        <div style="color:red;">
            Login failed.
        </div>
    {/if}
                    <div class="form-group">
                        <input type="text" name="user" class="form-control" placeholder="User ID"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass" class="form-control" placeholder="Password"/>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember_me" disabled/> Remember me (disabled for security reasons)
                    </div>
                </div>
                <div class="footer">
                    <button type="submit" class="btn bg-olive btn-block">Sign me in</button>

            </form>

        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>

    {/if}


{elseif $page == 'logout'}
    <script language="JavaScript" type="text/javascript">
        window.setTimeout(function () {
            window.location.href = "{$smarty_url}";
        }, 2000);
    </script>
    Logout successful.
    <br>
    If it doesn't redirect in a few seconds, click
    <a href="{$smarty_url}">here</a>
    .
{/if}