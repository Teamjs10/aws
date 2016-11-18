            function timeform(en){
                var n;
                var x; //x is used to stored the value of the field
                var f;
                var separate;  //T=Yes, there is a ':" in the string
                var locationpt;  //Location of ':' if included in string
                var ampm = "AM";
                var condError;
                var mins;  //used to check off whether minutes is 0-60
                var ftime;
                //x=$.trim(this.value); - "inTime"
                x=$.trim(document.getElementById(en).value);
                f=x.slice(0,1); //string slice, start at 0 to but not including 1
                if (f=="0"){
                    x=x.slice(1);
                }
                x=x.toUpperCase();
                var xa=x.split(""); //Put items xa array each item in x string
                if (isNaN(xa[0])) {
                    alert("Time is not in H:MM AM/PM format like 8:00 AM");
                }
                else{
                    var y= new Array( );
                    var z;
                    for (var i=0;i<xa.length;i++)  //xa.length is number of elements in array - not zero based
                        { 
                          z=xa[i];   
                             switch (z)  //using this we are creating an array that is only numbers or ':'
                            {
                                case ":":
                                    separate="T";
                                    locationpt=i;
                                    y.push(z);
                                    break;
                                case " ":
                                    break;
                                case "M":
                                    break;
                                case "A":
                                    ampm="AM";
                                    break;
                                case "P":
                                    ampm="PM";
                                    break;
                                default:
                                    y.push(z)
                                    //Put some error checking in here to make sure
                                    //That the user entered a number
                            } //End Switch
                        } //End For Loop
                }  //End Else
                if(separate=="T"){ //There is a : in the string
                    var fHours;
                    var fMinutes;
                    var e;
                    var finaltime;
                    switch (locationpt)  //
                    {
                        case 1: //was in format #:##
                            fHours=0 + y[0];
                            fHours=fHours + y[1] + y[2]+y[3]+ " " +ampm;
                            mins=y[2]+y[3];
                            if(mins>59){
                                condError="T";
                                e="minutes is greater than 59";
                            }
                            if (!y.length==4){
                                condError="T";
                                    e="Time is not in H:MM AM/PM form at like 8:00 AM";
                            }
                            break;
                        case 2: //was in format ##:## - could be 18:00 - need to check
                            fHours=y[0]+y[1];
                            if (fHours>12){
                                fHours=fHours-12;
                                ampm="PM";
                                if (fHours>12){
                                    condError="T";
                                    e="Hours greater than 24";
                                }
                            }
                            fHours=fHours + y[2] + y[3]+y[4]+ " " +ampm;
                            mins=y[3]+y[4];
                            if(mins>59){
                                condError="T";
                                e="minutes is greater than 59";
                            }
                            if (!y.length==5){
                                condError="T";
                                e="Time is not in H:MM AM/PM format like 8:00 AM"
                            }
                            break; 
                        default:
                            condError="T";
                            e="Time is not in H:MM AM/PM format like 8:00 AM"

                    }
                }
                //Else the number does not contain a ":" in it
                else{ 
                    var fHours;
                    var fMinutes;
                    var e;
                    var finaltime;
                    n=y.length
                    var z;
                    switch (n){
                        case 1:
                            fHours="0" +y[0] +":00" +" "+ ampm;
                            break;
                        case 2:
                            fHours=y[0]+y[1];
                            if (fHours>12){
                                z=fHours-12;
                                if(z==12){
                                    fHours=z+":00 AM";  //Time is 12:00am
                                }
                                else if(z>12){
                                    condError="T";
                                    e="Hours greater than 24";
                                }
                                else{
                                    fHours=z+":00 PM";
                                }
                                
                            }
                            else{
                                if(fHours==12){
                                    fHours=fHours+":00 PM";  //Time is 12:00am
                                }
                                else{
                                    fHours=fHours+":00 AM";
                                }
                                
                            }
                            break;
                        
                        case 3:
                           fHours= "0"+y[0]+":"+y[1]+y[2]+" "+ampm;
                           mins=y[1]+y[2];
                            if(mins>59){
                                condError="T";
                                e="minutes is greater than 59";
                            }
                           break;
			case 4:
                            fHours=y[0]+y[1];
                            if (fHours>12){
                                z=fHours-12;
                                if (z>12){
                                    condError="T";
                                    e="Hours greater than 24";
                                }
                                fHours=z+":"+y[2]+y[3]+" "+ ampm;
                            }
                            mins=y[2]+y[3];
                            if(mins>59){
                                condError="T";
                                e="minutes is greater than 59";
                            }
                            break;                          
                            
                    }
                    
                    //$("#"+en).attr("value","fHours");
                    
                }
                if(condError=="T"){
                    $("#"+en).attr("value","HH:MM AM/PM");
                    alert(e);
                }
                else{
                    $("#"+en).attr("value",fHours);
                }
                
                }//end if statement

    function checkTime() {
            var x = document.getElementById("int1").value
            var y = document.getElementById("out1").value
            var hx=x.slice(0,2);
            var mx=x.slice(3,5);
            var hy=y.slice(0,2);
            var my=y.slice(3,5);
            var d = new Date(2013, 03, 18, hx, mx, 0, 0);
            var d1 = new Date(2013, 03, 18, hy, my, 0, 0);
            
            if((d1-d)<0){
                alert("Punch Time must be less than previous entry")
            }
    
}

function myFunction() {
            
            var x = document.getElementById("inTime").value
            var y = document.getElementById("outTime").value
            var hx=x.slice(0,2);
            var mx=x.slice(3,5);
            var hy=y.slice(0,2);
            var my=y.slice(3,5);
            var d = new Date(2013, 03, 18, hx, mx, 0, 0);
            var d1 = new Date(2013, 03, 18, hy, my, 0, 0);
            var d2 = ((d1.getTime())- (d.getTime()))/1000;
            
            x=(d2/60)/60;
            alert(x);
            if (x<0) {
                //Do nothing, the total is not complete
            }
            else{
                $("#total").attr("value",x)
                }
}


