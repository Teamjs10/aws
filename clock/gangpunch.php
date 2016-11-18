

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/form.css" media="screen" />
        <link rel="stylesheet" href="../pikaday/css/pikaday.css">
        
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <!-- The Javascript for the time function only works with this version of JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js" type="text/javascript"></script>
        <script src="js/clock.js" type="text/javascript"></script>
        <script src="js/time.js" type="text/javascript"></script>
        <title>Team Punch</title>
        <script language="JavaScript">
            function itemAll(){
                $('.itemImg').hide();
                $('.all').hide();
                $('.Clear').show();
                $('.Selected').show();
                $(".hIn").show();
                $(".hOut").show();
            }
            function restore(){
                $('.itemImg').show();
                $('.all').show();
                $('.Clear').hide();
                $('.Selected').hide();
                $(".hIn").attr('value', '').hide();
                $(".hOut").attr('value', '').hide();
            }
            function itemSelect(x){
                var i='img.itemImg:eq('+x+')';
                var s='img.Selected:eq('+x+')';
                var hi='#hIn'+x;
                var ho='#hOut'+x;
                $(i).hide();
                $(s).show();
                $(hi).show();
                $(ho).show();
                
            }
            function deselect(x){
                var i='img.itemImg:eq('+x+')';
                var s='img.Selected:eq('+x+')';
                var hi='#hIn'+x;
                var ho='#hOut'+x;
                $(i).show();
                $(s).hide();
                $(hi).attr('value', '').hide();
                $(ho).attr('value', '').hide();
            }
            function ApplyPunch(){
                var In=$('#pInx').val();
                var Out=$('#pOutx').val();
                $(".hIn:visible").attr('value', In);
                $(".hOut:visible").attr('value', Out);
            }
            function subPunch(){
                var punch=[];
                var a,b, c, d, e;
                var x,y,z;
                $('.hIn:visible').each(function () {
                   c=$(this).data('hash');
                    a='#hIn'+c;
                    b='#hOut'+c;
                    e='#badge'+c;
                    d=a+':visible';
                    if($(d)){
                        x=$(e).val();
                        y=$(a).val();
                        z=$(b).val();
                        punch.push(x+ '-'+y+'-'+z);
                        
                    }
                    
            });
            var pDate=$('#pDayDate').val();
            $('#punchinfo').attr('value', punch);
            $('#pDate').attr('value', pDate);
        $("#punchform").attr('action', 'test.php');
        $("#punchform").submit();
        }
        
            
        </script>
    </head>
    <body>
     <div class="phead"><div class="inner"><img src="img/sham30.png" onclick="goHome()" ></div></div>
    <div class="tdGang">    
        <form method="post" id="punchform" name="punchform">
            <table id="box-table-a">
            <thead>
            <tr>
                <th scope="col" colspan="5"><b>By Manager</b></th>
            <th scope="col"><b>Date</b></th>
            <th scope="col"><b>In</b></th>
            <th scope="col"><b>Out</b></th>
            </tr>
            <tr>
            <th>&nbsp;</th>
            <th scope="col"><img id="apply" src="img/apply.png" onclick="ApplyPunch()"></th>
            <th scope="col" colspan="3">&nbsp;</th>
            <th scope="col"><input type="text" id="pDayDate"></th>
            <th scope="col"><input type="text" id="pInx" onchange="timeform(this.id)"></th>
            <th scope="col"><input type="text" id="pOutx" onchange="timeform(this.id)"></th>
            </tr>
            <tr>
            <th scope="col">&nbsp;</th>
            <th scope="col"><img class="Clear" onclick="restore()"><img class='all' id='all' onclick='itemAll()' /></th>
            <th scope="col">Badge</th>
            <th scope="col">FName</th>
            <th scope="col">LName</th>
            <th scope="col">Department</th>
            <th scope="col" colspan="2">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            
            
        <?php
            require_once 'clk_functions.php';
            $db_conn=  getDB();
            empGang($db_conn, 1);
            //echo "<script type=\"text/javascript\">currentDate()</script>";
        ?>
                <tr>
                    <td>&nbsp;</td>
                    <td><img src="img/submit.png" onclick="subPunch()"></td>
                    <td scope="col" colspan="6">&nbsp;</td>
                </tr>
               
            </tbody>
            </table>
            <input style="display: none" id="pDate" name="pDate">
            <input style="display: none" id="punchinfo" name="punchinfo">
        </form>
    </div>
        <script src="../pikaday/pikaday.js"></script>
            <script>

            var picker = new Pikaday(
            {
                field: document.getElementById('pDayDate'),
                firstDay: 1,
                minDate: new Date(2000, 0, 1),
                maxDate: new Date(2020, 12, 31),
                yearRange: [2000,2020]
            });

            </script>
    </body>
</html>
