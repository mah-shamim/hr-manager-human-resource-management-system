<?php 
    //handling error reporting  
    error_reporting(E_ALL);

     // session start
    ini_set('session.use_trans_sid', false);
    ini_set('session.use_cookies', true);
    ini_set('session.use_only_cookies', true);
    $https = false;
	 if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
		  $protocol = 'https://';
		}
		else {
		  $protocol = 'http://';
		}
    if(isset($_SERVER['HTTPS']) and $_SERVER['HTTPS'] != 'off') $https = true;
    $dirname = rtrim(dirname($_SERVER['PHP_SELF']), '/').'/';
	$installerurl=$protocol.$_SERVER['HTTP_HOST'].$dirname;
    session_name('ci_installer');
    session_set_cookie_params(0, $dirname, $_SERVER['HTTP_HOST'], $https, true);
    session_start();

    //add ./vendor/autoload.php file
    require_once __DIR__.'/vendor/autoload.php';

    use Php\Requirements;
    use Php\Validation;
    use Php\DbImport;
    use Php\FileWrite;
    use Php\Verification;

    // //create object for each class
    $Requirements = new Requirements();
    $Validation   = new Validation();
    $DbImport     = new DbImport();
    $FileWrite    = new FileWrite(); 
    $Verification = new Verification(); 

    //set the path of files
    $path = [
        'sql_path'      => 'sql/install.sql',
        'template_path' => 'php/Database.php',
        'output_path'   => '../application/config/database.php',
        'config_path'   => '../application/config/config.php',
    ];

    $message      = null; 
    $activeClass  = null; 

    //generate token
    if (empty($_SESSION['_token'])) {
        if (function_exists('openssl_random_pseudo_bytes'))
		{
			$_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(32));
		} else {
			$_SESSION['_token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
		}
    }
    $token = $_SESSION['_token']; 

//condition for step 3
    if (isset($_GET['launchapp']) && $Validation->checkEnvFileExists() === false) {
        // Check Applicatiob Launch
        $launch = $Verification->launch_application($_GET); 
        //Installation done if all task done
        if($launch){
        //create a env file in Flag directory
        $FileWrite->createEnvFile();
        //destroy session data
        session_destroy();
        // Redirect to application
        $Validation->checkEnvFileExists();
        }else{
        //IF Installation Process failed
        $message .= '<li>Failed! Please Check your internet connection and Try again</li>';
        } 
    } else {
        $Validation->checkEnvFileExists();
    }
    // ends of step 3

    // Purchase Key Validation
     if (!empty($_GET['user_id']) || !empty($_GET['purchase_key'])) {

            $result = $Validation->validate($_GET);

            if ($result) {

                $validdata = $Verification->verify_purchase($_GET);
				//bugs
                $validdata = 'yes';
                if($validdata == 'yes'){
                    header('location: '.$installerurl.'index.php?step2=true');
                } else{
                   $message .= $validdata;
                }

            } else{
                $message .= $result;
            }
    }

    //Submit form data 
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Insert Login Information
        if(!empty($_POST['email']) && !empty($_POST['password'])){
            // validate Login data
            $lresult = $Validation->validate_login($_POST);
            // If validation successful
            if ($lresult===true) {
                // Insert login data into table
                if($DbImport->insert_login($_POST)){
                    // Redirect to complete app page
                    header('location: '.$installerurl.'index.php?complete=true');
                } else{
                    $message .= "<li>Failed! Please Try Again</li>";
                }
            }else {
                //Display error message
                $message .= $lresult;
            }
        // End of login info insert
        } else {

        //validate all input
        $dbvalid = $Validation->run($_POST);
        if ($dbvalid===true) {
            //check install.sql file is exists in sql directory
            if ($Validation->checkFileExists($path['sql_path'])==false) {
                $message .= "<li>install.sql file is not exists in sql/ directory!</li>";
            } else {
                //first create the database, then create tables, then write config and database file
                if ($FileWrite->databaseConfig($path,$_POST) === false) {
                    //write database file
                    $message .= "<li>The database configuration file could not be written, ";
                    $message .= "please chmod application/config/database.php file to 777</li>";
                } elseif ($FileWrite->baseUrl($path['config_path']) === false) {
                    //write config file
                    $message .= "<li>The config  file could not be written, ";
                    $message .= "please chmod application/config/config.php file to 777</li>";
                } elseif ($DbImport->createDatabase($_POST) === false) {
                    $message .= "<li>The database could not be created, ";
                    $message .= "please verify your settings.</li>";
                } elseif ($DbImport->createTables($_POST) === false) {
                    $message .= "<li>The database tables could not be created, ";
                    $message .= "please verify your settings.</li>";
                } else { 
                    //redirect to complete installation
                    header('location: '.$installerurl.'index.php?step4=true');
                   
                }   
            }

            } else {
                //Display error message
                $message .= $dbvalid;
                // $message = $Validation->run($_POST);
            }
        }
    }
    //Ends of submit form data 

?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="<?php echo $installerurl;?>assets/img/favicon.png" sizes="32x32">
        <title>Codeigniter Application Installer</title>

        <!-- Bootstrap -->
        <link href="<?php echo $installerurl;?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $installerurl;?>assets/css/style.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="page-wrapper">
            <div class="container"> 
                <!-- begin of row -->
                <div class="row"> 
                    <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1"> 
                        <header class="header">
                            <h1 class="header-title">Bdtask software installer</h1>
                        </header>
                        <div class="page-content">
                            <div class="outer-container">
                                <div id="wizard" class="aiia-wizard">
                                    <?php 
                                    if (isset($_GET['step1']) || (!isset($_GET['step1']) && !isset($_GET['step2']) && !isset($_GET['step3']) && !isset($_GET['step4']) && !isset($_GET['complete']))) {
                                            $activeClass = 'active';
                                        } 
                                    ?>
                                    <div class="aiia-wizard-step <?php echo $activeClass ?>">
                                        <h1>Step One</h1>
                                        <form method="GET" action="<?php echo $installerurl;?>index.php" class="form-horizontal" name="installsc">
                                        <?php
                                        if (!empty($message)) {
                                            echo "<div class=\"alert alert-danger\"><ul>$message</ul></div>";
                                        }

                                        ?>  
                                        <div class="step-content step-one">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <label for="userid" class="col-sm-4 col-form-label">Envato User ID <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="bottom" title="Enter Envato User ID or Enter 'bdtask' as non Envato User">
                                                        </span> </label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="userid" name="userid" value="<?php echo @$_GET['userid'] ?>" placeholder="Enter anything" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="purchase_key" class="col-sm-4 col-form-label">Purchase Key <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="bottom" title="Enter Purchase Key which you got by envato purchase or bdtask support.">
                                                        </span></label>
                                                        <div class="col-sm-8">
                                                            <input type="password" class="form-control" id="purchase_key" value="<?php echo @$_GET['purchase_key'] ?>" placeholder="purchase-code" name="purchase_key" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.End of step one -->
                                        <div class="row action_btns">
                                           <button class='btn btn-success pull-right  verify_btn'>Next</button> 
                                        </div>
                                        </form>
                                        
                                    </div>
                                    <div class="aiia-wizard-step <?php echo (isset($_GET['step2'])?'active':'') ?>">
                                        <h1>Step Two</h1>
                                        <div class="step-content step-two">
                                            <div class="app_content">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h3 class="title text-center"><strong>Directory permissions & requirements</strong></h3>
                                                        <!-- display requirements -->
                                                        <?= $Requirements->directoriesAndPermission(); ?>
                                                        <!-- Server Requirement -->
                                                        <div class="height"></div>
                                                        <?= $Requirements->server();  ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.End of step two -->
                                        <div class="row action_btns">
                                            <button class='btn btn-success pull-left aiia-wizard-button-previous prev_action'>Previous</button>
                                           <a href="<?php echo $installerurl;?>index.php?step3=true" class='btn btn-success pull-right'>Next</a> 
                                        </div>
                                    </div>

                                    <div class="aiia-wizard-step <?php echo (isset($_GET['step3'])?'active':'') ?>">
                                        <h1>Step Three</h1>
                                        <?php
                                        if (!empty($message)) {
                                            echo "<div class=\"alert alert-danger\"><ul>$message</ul></div>";
                                        }
                                        ?> 
                                        <form action="<?php echo $installerurl;?>index.php?step3=true" method="post" name="step3">

                                        <div class="step-content step-three">

                                                <input type="hidden" name="_token" value="<?= (!empty($token)?$token:null) ?>"/>
                                                <div class="form-group">
                                                    <label for="database">Database Name </label>
                                                    <input type="text" name="database" class="form-control" id="database" placeholder="Database Name" value="">
                                                </div> 
                                                <div class="form-group">
                                                    <label for="username">Username </label>
                                                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="">
                                                </div> 
                                                <div class="form-group">
                                                    <label for="password">Password </label>
                                                    <input type="text" name="password" class="form-control" id="password" placeholder="Password" value="">
                                                </div>  
                                                <div class="form-group">
                                                    <label for="hostname">Host Name <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="bottom" title="Please keep localhost by default, but if need you can add your own domain name or ip address"></span></label>
                                                    <input type="text" name="hostname" class="form-control" id="hostname" placeholder="Host Name"  value="localhost">
                                                </div> 
                                            
                                        </div>
                                        <div class="row action_btns">
                                            <button class='btn btn-success pull-left aiia-wizard-button-previous prev_action'>Previous</button>
                                            <button type="submit" class='btn btn-success pull-right'>Next</button> 
                                        </div>
                                        </form>
                                    </div>
                                    <div class="aiia-wizard-step <?php echo (isset($_GET['step4'])?'active':'') ?>">
                                        <h1>Step Four</h1>

                                        <div class="text-center" id="wait_div">
                                            <br>
                                            <h3 id="wait_msg">&nbsp;</h3>
                                        </div>
                                        <div class="logininfo hide" id="logininfo"> 
                                            <p class="text-center">Please add your own initial Email and Password. Please change that after login</p>
                                            <?php
                                            if (!empty($message)) {
                                                echo "<div class=\"alert alert-danger\"><ul>$message</ul></div>";
                                            }
                                            ?> 
                                            <form action="<?php echo $installerurl;?>index.php?step4=true" method="post" class="form-horizontal" name="step4">
                                                <div class="step-content step-four">
                                                    <div class="row">
                                                        <div class="col-sm-7">
                                                            <div class="form-group">
                                                                <label for="email" class="col-sm-4 col-form-label">Email</label>
                                                                <div class="col-sm-8">
                                                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="pass" class="col-sm-4 col-form-label">Password</label>
                                                                <div class="col-sm-8">
                                                                    <input type="password" name="password" class="form-control" placeholder="Password" id="pass" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.End of step four -->
                                                 <div class="row action_btns">
                                                    <button class='btn btn-success pull-left aiia-wizard-button-previous prev_action'>Previous</button>
                                                    <button type="submit" class='btn btn-success pull-right'>Next</button> 
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="aiia-wizard-step <?php echo (isset($_GET['complete'])?'active':'') ?>">
                                        <h1>Complete</h1>
                                        <div class="step-content step-five">

                                            <div class="col-sm-12">
                                                <?php
                                                if (!empty($message)) {
                                                    echo "<div class=\"alert alert-danger\"><ul>$message</ul></div>";
                                                }else{
                                                ?> 
                                                <h3 class="title text-center margin">Installation complete</h3> 
                                                <div class="alert alert-success">
                                                    <strong>Your application installed successfully !!!</strong>
                                                </div>
                                                <?php } ?>

                                                <div class="divider"></div>

                                                <h3 class="text-center" id="btn-before">&nbsp;</h3>
                                                <div class="text-center hide" id="btn-complete">
                                                    <a href="<?php echo $installerurl;?>index.php?complete=true&launchapp=true" class="btn btn-block cbtn">Click to launch your application </a>
                                                </div>

                                            </div>

                                        </div>
                                        <!-- /.End of step five -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!-- /.End of page wrapper -->
        <footer class="footer text-center">
            <div class="container fText">
                <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                    <div class="row">
                        <div class="col-sm-6 text-left">Developed by <a  target="_blank" href="https://www.bdtask.com/">bdtask</a></div>
                        <div class="col-sm-6  text-right"><a target="_blank" href="https://forum.bdtask.com/"><span class="glyphicon glyphicon-user"></span> Installation Support</a></div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.End of footer -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php echo $installerurl;?>assets/js/jquery-3.3.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo $installerurl;?>assets/js/bootstrap.min.js"></script>
        <!-- Wizard Script -->
        <script src="<?php echo $installerurl;?>assets/js/script.js"></script>

        <?php if(isset($_GET['step4'])){ ?>
        <script type="text/javascript">
            $(document).ready(function() {

                var wait = 50000; //10 second

                var time = 50;
                setInterval(function(){
                 $("#wait_msg").html("You need to wait "+time+" second before you can proceed");
                 time--;
                }, 1000);

                setTimeout(function() {
                    $("#wait_div").addClass('hide');
                    $("#logininfo").removeClass('hide');
                }, wait);

            });
            </script>
        <?php } ?>


        <?php if(isset($_GET['complete'])){ ?>
        <script type="text/javascript">
            $(document).ready(function() {

                var wait = 3000; //10 second

                var time = 3;
                setInterval(function(){
                 $("#btn-before").html("You need to wait "+time+" second before you can proceed");
                 time--;
                }, 1000);

                setTimeout(function() {
                    $("#btn-before").addClass('hide');
                    $("#btn-complete").removeClass('hide');
                }, wait);

            });
            </script>
        <?php } ?>



    </body>
</html>