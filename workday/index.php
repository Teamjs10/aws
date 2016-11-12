<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/form.css" media="screen" />
    </head>
    <body>



<?php
echo "I am really good at this stuff!";

$url="https://salesdemo1-services1.workday.net/ccx/service/customreport2/jrobigms0401v23/lmcneil/JTR_Employee_Info?format=json";
$ch= curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_USERPWD, "lmcneil:WD23Rocks!");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$opt="Not filled";
curl_getinfo($ch);
$response=  curl_exec($ch);
if(!curl_errno($ch))
{
 $info = curl_getinfo($ch);
 echo '<br>Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'].'<br>';
}
 else {
    
    echo '<br>Curl error: ' . curl_error($ch);
}

// Close handle
curl_close($ch);
$jtr=json_decode($response, TRUE);
echo '<br />Entry of Data - <br />';
                echo '<table id="box-table-a">';
                echo '<thead>
                <tr>
                <th scope="col">Row</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">ID</th>
                <th scope="col">Job Profile</th>
                </tr>
                </thead>
                <tbody>';
$i= count($jtr['Report_Entry']);
//print_r($jtr);
$y="";
for ($x = 0; $x < $i; $x++) {
   $y=$x + 1;
   echo '<tr>'; 
   echo '<td>'.$y. '</td><td>'. htmlentities($jtr['Report_Entry'][$x]['firstName']).'</td><td>'.htmlentities($jtr['Report_Entry'][$x]['lastName']).'</td><td>'.$jtr['Report_Entry'][$x]['Employee_ID']
           .'</td><td>'.$jtr['Report_Entry'][$x]['Job_Profile'].'</td></tr>';
}
echo "</tbody></table>";
?>
 
</body>
</html>