        function goHome(){
            window.location = "index.php";
        }

        function startTime() {
                var mm="AM";
                var today=new Date();
                var weekday = new Array(7);
                weekday[0] = "Sunday";
                weekday[1] = "Monday";
                weekday[2] = "Tuesday";
                weekday[3] = "Wednesday";
                weekday[4] = "Thursday";
                weekday[5] = "Friday";
                weekday[6] = "Saturday";
                var n = weekday[today.getDay()];

                var h=today.getHours();
                var m=today.getMinutes();
                var s=today.getSeconds();
                //add zero if needed 1-9
                m = checkTime(m);
                s = checkTime(s);
                if(h>12){
                    h=h-12;
                    mm="PM";
                }
                //alert(today.getDate());
               $("#pDayDate").attr("value", n + " " + (today.getMonth()+1) + "/"+ today.getDate() + "/" + today.getFullYear());
                //Opening time 
                //$("#pTimeActual").attr("value", h+":"+m+":"+s+ " "+mm);
                //Verify Time
                $("#pTime").attr("value", h+":"+m+":"+s+ " "+mm);
                //Unix time in milliseconds
                $("#pUTime").attr("value", today.getTime());
                var t = setTimeout(function(){startTime()},500);
            }

            function checkTime(i) {
                if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
                return i;
            } 
            function loadBadge(x){
                $("#hBadge").attr("value",x);
            }
            function currentDate(){
                var today=new Date();
                $("#pDayDate").attr("value", today.getMonth() + "/"+ today.getDate() + "/" + today.getFullYear());
            }