<?php
	//start session
	session_start();
	//connect to the database
	require('../model/database.php');
    //retrieve the functions
	require('../model/functions_subscription.php'); 

    $userSession = isset($_SESSION['user']);
	
	//retrieve the data
	$subEmail = $_GET['subEmail'];
	$subCategory = $_GET['subCategory'];

    /////////////////////////////////////////////////
    //security process to encrypt subscriber's email,
    //make the email unreadable
    /////////////////////////////////////////////////
    //store the cipher method
    $ciphering = "AES-128-CTR";
    //use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    //Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567891011121';
    //store the encryption key
    $encryption_key="subscriberEmail";
    //encrypted email will be sent to the page of subscription management
    $encryptedEmail = openssl_encrypt($subEmail, $ciphering, $encryption_key, $options, $encryption_iv);

    //check if email is existing
    $check_result = check_sub_email($subEmail);

    if($check_result)
    {
        //if new subscriber is existing, only display message; give access to manage subscription.
        $_SESSION['success'] = '<form method="post" action="subscription.php" style="margin:0;">'.
                'The email has been used for subscription. <input name="subEmail" type="hidden" value="'.$encryptedEmail.'"/>'.
                '<input type="submit" value="Manage Subscription" style="margin:0;background:none;width:auto;text-decoration:underline;color:blue;font-size:1em;" />'.
            '</form>';
        redirectPage($userSession);
    }
    else{
        //call the add_new_sub() function
        $result = add_new_sub($subEmail, $subCategory);
        if($result)
        {
            $_SESSION['success'] = 'Thanks for subscription!';
            redirectPage($userSession);
        }
        else
        {
            //if subscriber is not successfully added, create an error message to display on the add error page
            $_SESSION['error'] = "Sorry, we can't add you to subscription list for now.";
            header('location:../view/database_error.php');
        }
    }

    //redirect to coffees.php; if not registered, stay on login page
    function redirectPage($userSession)
    {
        if(!$userSession)
        {
            header('location:../view/login_form.php');
        }
        else{
            header('location:../view/coffees.php');
        }
    }


?>