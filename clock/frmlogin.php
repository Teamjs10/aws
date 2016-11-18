<?php
// Start the session
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>System Log In</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <script type="text/javascript">
        function submitForm(x){
            switch (x) {
            case 1:
                window.location = "index.php";
                break;    
            case 2:
                
                break;          
            default:
                
                    }
            }
        function updateVals(x,y){
            
            $("#hempintid").attr("value",x);
            $("#hcointid").attr("value",y);
        }

    function delayer(){
    window.location = "login.html";
    }
    //-->
</script>
    </head>
    <body onLoad="setTimeout('delayer()', 5000)">
        
        <?php
            
            require_once 'clk_functions.php';
            require_once 'dbparams.php';
            require 'PasswordHash.php';
            // Base-2 logarithm of the iteration count used for password stretching
            $hash_cost_log2 = 8;
            // Do we require the hashes to be portable to older systems (less secure)?
            $hash_portable = FALSE;
            // Are we debugging this code?  If enabled, OK to leak server setup details.
            $debug = TRUE;
            $op='login';
            //$op = get_post_var('op');
            if ($op !== 'new' && $op !== 'login'){
                fail('Unknown request');
            }
                                 
            
            $login = get_post_var('username');
            /* Sanity-check the username, don't rely on our use of prepared statements
             * alone to prevent attacks on the SQL server via malicious usernames. */
            if (!preg_match('/^[a-zA-Z0-9_]{1,60}$/', $login)){
                    fail('Invalid username');
            }
            $password = get_post_var('password');
            /* Don't let them spend more of our CPU time than we were willing to.
             * Besides, bcrypt happens to use the first 72 characters only anyway. */
            if (strlen($password) > 72){
                    fail('The supplied password is too long');
            }
            $db_conn=  getDB();
            $hasher = new PasswordHash($hash_cost_log2, $hash_portable);
            if ($op === 'new') {
            $hash = $hasher->HashPassword($password);
            if (strlen($hash) < 20){
                fail('Failed to hash new password');
            }	
            unset($hasher);
            $fname= get_post_var('fname');
            $email=get_post_var('email');
            $query = "INSERT INTO users(intid, uname, pword, fullname, email, iddate) values
                (NULL,?,?,?,?,UNIX_TIMESTAMP());";
            $stmt= $db_conn->prepare($query);
            $stmt->execute(array($login, $hash, $fname, $email));
            if ($stmt->rowCount()==1){
            }
/* Figure out why this failed - maybe the username is already taken?
 * It could be more reliable/portable to issue a SELECT query here.  We would
 * definitely need to do that (or at least include code to do it) if we were
 * supporting multiple kinds of database backends, not just MySQL.  However,
 * the prepared statements interface we're using is MySQL-specific anyway. */
        $what = 'User created';
} 
else {
	$hash= '*'; // In case the user is not found 
	$sql="SELECT intid, uname, pword, fullname, email, iddate FROM users WHERE uname='".$login."'";
        $stmt = $db_conn->query($sql);
        if ($stmt->rowCount()){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }
	if ($hasher->CheckPassword($password, $row['pword'])) {
		$what = 'Authentication succeeded';
	} 
        else {
		$what = 'Authentication failed';
	}
	unset($hasher);
}
echo $what;
switch ($what) {
    case "Authentication succeeded":
        $_SESSION["favcolor"] = "green";
        echo "<script type=\"text/javascript\">submitForm(1)</script>";
        break;
    case "Authentication failed":
        echo "<script type=\"text/javascript\">submitForm(2)</script>";
        break;
    case "User created":
        echo "<script type=\"text/javascript\">submitForm(2)</script>";
        break;
    default:
        echo "<script type=\"text/javascript\">submitForm(2)</script>";;
}
        ?>
    </body>
</html>
