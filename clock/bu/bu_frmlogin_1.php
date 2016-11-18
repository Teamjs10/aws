
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>System Log In</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <script type="text/javascript">
        function submitForm(){
                $("#vlogin").attr('action', 'index.php');
    		$("#vlogin").submit();  
        }
        function updateVals(x,y){
            
            $("#hempintid").attr("value",x);
            $("#hcointid").attr("value",y);
        }

    function delayer(){
    window.location = "login.html"
    }
    //-->
</script>
    </head>
    <body>
        
        <?php
            //onLoad="setTimeout('delayer()', 5000)"
            require_once 'clk_functions.php';
            require_once 'dbparams.php';
            require 'PasswordHash.php';
            // Base-2 logarithm of the iteration count used for password stretching
            $hash_cost_log2 = 8;
            // Do we require the hashes to be portable to older systems (less secure)?
            $hash_portable = FALSE;
            // Are we debugging this code?  If enabled, OK to leak server setup details.
            $debug = TRUE;

            $op = get_post_var('op');
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
            
            $db = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);
            if (mysqli_connect_errno()){
                    fail('MySQL connect', mysqli_connect_error());
            }
            $hasher = new PasswordHash($hash_cost_log2, $hash_portable);
            if ($op === 'new') {
            $hash = $hasher->HashPassword($password);
            if (strlen($hash) < 20){
                fail('Failed to hash new password');
            }	
            unset($hasher);
            $fname= get_post_var('fname');
            $email=get_post_var('email');

	($stmt = $db->prepare('insert into users (intid, uname, pword, fullname, email, iddate) values (NULL, ?, ?, ?, ?, UNIX_TIMESTAMP())'))
		|| fail('MySQL prepare', $db->error);
	$stmt->bind_param('ss',$user, $hash, $fname, $email)
		|| fail('MySQL bind_param', $db->error);
	if (!$stmt->execute()) {
/* Figure out why this failed - maybe the username is already taken?
 * It could be more reliable/portable to issue a SELECT query here.  We would
 * definitely need to do that (or at least include code to do it) if we were
 * supporting multiple kinds of database backends, not just MySQL.  However,
 * the prepared statements interface we're using is MySQL-specific anyway. */
		if ($db->errno === 1062 /* ER_DUP_ENTRY */)
			fail('This username is already taken');
		else
			fail('MySQL execute', $db->error);
	}

        $what = 'User created';
} 
else {
	$hash= '*'; // In case the user is not found
        $empintid='';
        $empuname=''; 
        $cointid=''; 
	($stmt = $db->prepare('select emppass, empintid, empuname, company_cointid  from employee where empuname=?'))
		|| fail('MySQL prepare', $db->error);
	$stmt->bind_param('s', $login)
		|| fail('MySQL bind_param', $db->error);
	$stmt->execute()
		|| fail('MySQL execute', $db->error);
	$stmt->bind_result($hash, $empintid, $empuname, $cointid)
		|| fail('MySQL bind_result', $db->error);
	if (!$stmt->fetch() && $db->errno)
		fail('MySQL fetch', $db->error);

	if ($hasher->CheckPassword($password, $hash)) {
		$what = 'Authentication succeeded';
                session_start();
                // store session data
                $_SESSION["empintid"] = $empintid;
                $_SESSION["cointid"]=$cointid;
                            echo '
                        <div>
                        <form id="vlogin" method="post" action=""> 
                                <input type="text" name="hpage" id="hpage" style="visibility: hidden" value="reg" />
                                <input type="text" name="hempintid" id="hempintid" style="visibility: hidden" />
                                <input type="text" name="hcointid" id="hcointid" style="visibility: hidden" />
                        </form>
                        </div>';
                                echo "<script language=javascript>updateVals('".$empintid."','".$cointid."')</script>";
                                echo "<script language=javascript>submitForm()</script>";
	} else {
		$what = 'Authentication failed';
	}
	unset($hasher);
}

$stmt->close();
$db->close();            
            

echo $what;
        ?>
    </body>
</html>
