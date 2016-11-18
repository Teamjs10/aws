<?php
require_once 'clk_functions.php';
$sql = "SELECT empintid, empid, badge, empFirst, empLast, empDept
FROM employee";
$db_conn=  getDB();
$query = $db_conn->query($sql);


if ($query->rowCount()){

    //$new_array=array();
    $file = fopen("phptest.txt","w");
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        //$new_array[]=$row;
        $contents= $row['empintid'] .','. $row['empid'].','. $row['badge'].','. $row['empFirst']
                .','. $row['empLast'] .','. $row['empDept'].PHP_EOL;

    fwrite($file, $contents);

    };
    fclose($file);
    echo 'file created correctly<br />'; 
}
$con=ssh2_connect('192.168.1.103', 22);
$success = ssh2_auth_password($con, 'jtrla', 'Eyerish1!');
If($success){
    echo 'Success= '. $success. '<br />';
    $success = ssh2_scp_send($con, '/var/www/html/clock/phptest.txt', 'phptest.txt', 0644);
}
If($success){
    echo 'Success= '. $success. '<br />';
}
echo 'Done';
