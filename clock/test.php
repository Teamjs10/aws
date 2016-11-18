<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //[pDate] & [punchinfo] where Punch info is a concatenated string of info
         require_once 'clk_functions.php';
        $a=get_post_var('punchinfo');
        $pDate=get_post_var('pDate');
        $x=(explode(',', $a));
        $length=count($x);
        $b= [];
        for($z=0;$z<$length; $z++){
            $c=(explode('-', $x[$z]));
            array_push($b, $c);
        }
        echo '<br /><br /><br />';
        $lengthx=  sizeof($b,0);
        for($z=0;$z<$lengthx; $z++){
            $badge=$b[$z][0];
            if($b[$z][1]<>''){
                $dateinfo = $pDate . ' '.$b[$z][1];
                $jacktime=date_parse($dateinfo);
                $uTime=  mktime($jacktime['hour'],$jacktime['minute'],0,$jacktime['month'],$jacktime['day'],$jacktime['year']);
                echo $badge . '-'.$uTime . ' - In<br />';
            }
            if($b[$z][2]<>''){
                $dateinfo = $pDate . ' '.$b[$z][2];
                $jacktime=date_parse($dateinfo);
                $uTime=  mktime($jacktime['hour'],$jacktime['minute'],0,$jacktime['month'],$jacktime['day'],$jacktime['year']);
                echo $badge . '-'.$uTime . ' - Out<br />';
            }   
        }
        
        ?>
    </body>
</html>
