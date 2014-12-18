<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>clamscribe - Password recovery</title>
    <link href="include/css/jquery_wizard/demo_style.css" rel="stylesheet" type="text/css">

    <link href="include/css/jquery_wizard/smart_wizard.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="include/js/jquery_wizard/jquery-2.0.0.min.js"></script>
    <script type="text/javascript" src="include/js/jquery_wizard/jquery.smartWizard.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            // Smart Wizard
            $('#wizard').smartWizard();

            function onFinishCallback() {
                $('#wizard').smartWizard('showMessage', 'Finish Clicked');
                //alert('Finish Clicked');
            }
        });
    </script>

</head>
<body>

{if $success == true}
    <h3 style="color: green;">Password changed.</h3>
{/if}

{if $success == false}
    <h3 style="color: red;">Password was not changed. Please check your data.</h3>
{/if}

<form action="{$smarty_url}?module=recovery" method="post">
    <table align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <!-- Smart Wizard -->
                <h2>Password recovery</h2>

                <div id="wizard" class="swMain">
                    <ul>
                        <li><a href="#step-1">
                                <label class="stepNumber">1</label>
                <span class="stepDesc">
                   Information<br/>
                   <small>How to reset your password</small>
                </span>
                            </a></li>
                        <li><a href="#step-2">
                                <label class="stepNumber">2</label>
                <span class="stepDesc">
                   Database login<br/>
                   <small>MySql database</small>
                </span>
                            </a></li>
                        <li><a href="#step-3">
                                <label class="stepNumber">3</label>
                <span class="stepDesc">
                   User settings<br/>
                   <small>Select user</small>
                </span>
                            </a></li>
                        <li><a href="#step-4">
                                <label class="stepNumber">4</label>
                <span class="stepDesc">
                   Summery<br/>
                   <small>Ready?</small>
                </span>
                            </a></li>
                    </ul>
                    <div id="step-1">
                        <h2 class="StepTitle">Resetting passwords with clamscribe is easy!</h2>

                        <p>You have lost your password? Don't worry!<br>Follow this wizard to reset your password.
                        </p>

                        <p>
                            Please contact your system administrator to get login credentials to the MySQL database.
                            After that, simply type in the username whose password you want to reset.<br>
                            <small>Please note: The MySQL login credentials have to be the same as in the config file.</small>
                        </p>

                        <p>
                            Are you ready? Click the "Next" button at the bottom of the page.
                        </p>
                    </div>
                    <div id="step-2">
                        <h2 class="StepTitle">MySql Login</h2>

                        <p>
                            Please enter your MySQL login credentials.
                        </p>

                        <p>
                            <input type="text" name="mysql_host" placeholder="MySQL host">
                            <input type="text" name="mysql_db" placeholder="MySQL database">
                            <input type="text" name="mysql_user" placeholder="Username">
                            <input type="text" name="mysql_pass" placeholder="Password">
                        </p>
                    </div>
                    <div id="step-3">
                        <h2 class="StepTitle">Select user</h2>

                        <p>
                            Please enter the username whose password you want to reset to.
                        </p>

                        <p>
                            <input type="text" name="user" placeholder="Username">
                        </p>

                        <p>Please enter and retype your new password.</p>

                        <p>
                            <input type="password" name="pass" placeholder="New password">
                            <input type="password" name="pass_again" placeholder="Retype password">
                        </p>
                    </div>
                    <div id="step-4">
                        <h2 class="StepTitle">Summary</h2>

                        <p>We will now reset the password.
                        </p>

                        <p>
                            Ready? Click "Finish" at the bottom of the page.
                        </p>
                    </div>
                </div>
                <!-- End SmartWizard Content -->

            </td>
        </tr>
    </table>
</form>

</body>
</html>
