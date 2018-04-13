<?php
//include auth.php file on all secure pages
include("auth.php");



?>
<!DOCTYPE html>
<html>
<head>
<style>
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 0px 0px;
    cursor: pointer;
}
.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);}

.button1 {border-radius: 2px;}
.button2 {border-radius: 4px;}
.button3 {border-radius: 8px;}
.button4 {border-radius: 12px;}
.button5 {border-radius: 50%;}
</style>
<meta charset="utf-8">
<title>Enter password</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p>Welcome <?php echo $_SESSION['username'] ;?> , enter password!</p>

</div>
<?php

require('db.php');
$colour=$_SESSION['color'];
// If form submitted, insert values into the database.
if (isset($_POST['password'])){
        // removes backslashes
	$username=$_SESSION['username'];
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE username='$username'
and password='".md5($password)."'";
	//echo $query;
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
        if($rows==1){
            // Redirect user to index.php
	    header("Location: math.html");
         }else{
	echo "<div class='form'>
<h3>password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
	}
    }else{
?>
<div class="form">
<canvas id="canvas" width="300" height="300"
style="background-color:#ffff">
</canvas></div>
<br>
<div style="display:flex; flex-direction: row; justify-content: center; align-items: center";>
<button class="button button5" id="demo1">Anti-clock rotate</button>||
<button class="button button2" id="outer" >outer select</button>||
<button class="button button2" id="middle">middle select</button>||
<button class="button button2" id="inner">inner select</button>||
<button class="button button5" id="demo">clockwise rotate</button></div><br><br>
<div style="display:flex; flex-direction: row ; justify-content: center; align-items: center";>
<button class="button button1" id="del" >del</button>||
<button class="button button1" id="reset" >reset</button></div>
<div class="form">
<form action="" method="post" name="login">
<input type="password" name="password" placeholder="Password" id="password" required />
<input name="submit" type="submit" value="Login" />
</form>
<a href='login.php'>cancel</a>
<script >
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var radius = canvas.height / 2;
ctx.translate(radius, radius);
radius = radius * 0.90;
 var col = "<?php echo $colour; ?>" ;
        
 document.getElementById("password").value = col;
//var col="red";
var centreX = 0; var centreY = 0;

        var radius = 300 / 2;

        var rotateAngle = 45 * Math.PI / 180;

        var startAngle = 0 * Math.PI / 180;

        var endAngle = 45 * Math.PI / 180;
		var str ='';
		var txt;
        

        var colours = ["brown", "red", "green", "blue", "yellow", "pink", "orange", "black"];
		var redo=[2,3,4,5,6,7,8,1];
		var redm=['b','c','d','e','f','g','h','a'];
		var redi=['j','k','l','m','n','o','p','i'];
		
		var greeno=[3,4,5,6,7,8,1,2];
		var greenm=['c','d','e','f','g','h','a','b'];
		var greeni=['k','l','m','n','o','p','i','j'];
		
		var blueo=[4,5,6,7,8,1,2,3];
		var bluem=['d','e','f','g','h','a','b','c'];
		var bluei=['l','m','n','o','p','i','j','k'];
		
		var yellowo=[5,6,7,8,1,2,3,4];
		var yellowm=['e','f','g','h','a','b','c','d'];
		var yellowi=['m','n','o','p','i','j','k','l'];
		
		var pinko=[6,7,8,1,2,3,4,5];
		var pinkm=['f','g','h','a','b','c','d','e'];
		var pinki=['n','o','p','i','j','k','l','m'];
		
		var orangeo=[7,8,1,2,3,4,5,6];
		var orangem=['g','h','a','b','c','d','e','f'];
		var orangei=['o','p','i','j','k','l','m','n'];
		
		var blacko=[8,1,2,3,4,5,6,7];
		var blackm=['h','a','b','c','d','e','f','g'];
		var blacki=['p','i','j','k','l','m','n','o'];
		
		var browno=[1,2,3,4,5,6,7,8];
		var brownm=['a','b','c','d','e','f','g','h'];
		var browni=['i','j','k','l','m','n','o','p'];


		




function drawClock() {


	drawWheel(ctx,radius);
    
  drawFace(ctx, radius-15);
  drawNumbers(ctx, radius-15);
  
 // rotateWheel(ctx,radius)
  
  
  //drawTime(ctx, radius);
}

function drawFace(ctx, radius) {
  var grad;
  ctx.beginPath();
  ctx.arc(0, 0, radius, 0, 2*Math.PI);
  ctx.fillStyle = 'white';
  ctx.fill();
  grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
  grad.addColorStop(0, '#333');
  grad.addColorStop(0, 'white');
  grad.addColorStop(0, '#333');
  ctx.strokeStyle = grad;
  ctx.lineWidth = radius*0.01;
  ctx.stroke();
  ctx.beginPath();
  //ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
  ctx.fillStyle = '#333';
  ctx.fill();
}

function drawNumbers(ctx, radius) {
  var ang;
  var num;
  ctx.font = radius*0.15 + "px arial";
  ctx.textBaseline="middle";
  ctx.textAlign="center";
  for(num = 1; num < 9; num++){
    ang = (num * Math.PI /4)+2;
    ctx.rotate(ang);
    ctx.translate(0, -radius*0.85);
    ctx.rotate(-ang);
    ctx.fillText(num.toString(), 0, 0);
    ctx.rotate(ang);
    ctx.translate(0, radius*0.85);
    ctx.rotate(-ang);
  }
   for(num = 1; num < 9; num++){
    ang = (num * Math.PI /4)+2;
    ctx.rotate(ang);
    ctx.translate(0, -(radius-35)*0.85);
    ctx.rotate(-ang);
    ctx.fillText((9+num).toString(36), 0, 0);
    ctx.rotate(ang);
    ctx.translate(0, (radius-35)*0.85);
    ctx.rotate(-ang);
  }
  for(num = 9; num < 17; num++){
    ang = (num * Math.PI /4)+2;
    ctx.rotate(ang);
    ctx.translate(0, -(radius-80)*0.85);
    ctx.rotate(-ang);
    ctx.fillText((9+num).toString(36), 0, 0);
    ctx.rotate(ang);
    ctx.translate(0, (radius-80)*0.85);
    ctx.rotate(-ang);
  }
  ctx.beginPath();
	ctx.arc(0,0,radius*0.85-10,0,2*Math.PI);
	ctx.stroke();
	ctx.beginPath();
	ctx.arc(0,0,(radius-35)*0.85-10,0,2*Math.PI);
	ctx.stroke();
	ctx.moveTo(0,radius);
	ctx.lineTo(0,-radius);
	ctx.stroke();
	ctx.moveTo(radius,0);
	ctx.lineTo(-radius,0);
	ctx.stroke();
	ctx.moveTo(-radius/1.41421356237,-radius/1.41421356237);
	ctx.lineTo(radius/1.41421356237,radius/1.41421356237);
	ctx.stroke();
	ctx.moveTo(-radius/1.41421356237,radius/1.41421356237);
	ctx.lineTo(radius/1.41421356237,-radius/1.41421356237);
	ctx.stroke();
	
}

function drawTime(ctx, radius){
    var now = new Date();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    //hour
    hour=hour%12;
    hour=(hour*Math.PI/6)+
    (minute*Math.PI/(6*60))+
    (second*Math.PI/(360*60));
    drawHand(ctx, hour, radius*0.5, radius*0.07);
    //minute
    minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
    drawHand(ctx, minute, radius*0.8, radius*0.07);
    // second
    second=(second*Math.PI/30);
    drawHand(ctx, second, radius*0.9, radius*0.02);
}

function drawHand(ctx, pos, length, width) {
    ctx.beginPath();
    ctx.lineWidth = width;
    ctx.lineCap = "round";
    ctx.moveTo(0,0);
    ctx.rotate(pos);
    ctx.lineTo(0, -length);
    ctx.stroke();
    ctx.rotate(-pos);
	
	
}
////////////////////////////////////////////////////////////////////////////////////////
		function redoa()
		{
		
				var i, last,lastm;

                /* Store last element of array */
                last = redo[7];
				lastm=redm[7];
				lasti=redi[7];

                for(i=7; i>0; i--)
                {
                    /* Move each array element to its right */
                    redo[i] = redo[i - 1];
					redm[i] = redm[i - 1];
					redi[i] = redi[i - 1];
                }

                /* Copy last element of array to first */
                redo[0] = last;
				redm[0]=lastm;
				redi[0]=lasti;
		}
		function greenoa()
		{
		
				var i, last,lastm;

                /* Store last element of array */
                last = greeno[7];
				lastm=greenm[7];
				lasti=greeni[7];

                for(i=7; i>0; i--)
                {
                    /* Move each array element to its right */
                    greeno[i] = greeno[i - 1];
					greenm[i] = greenm[i - 1];
					greeni[i] = greeni[i - 1];
                }

                /* Copy last element of array to first */
                greeno[0] = last;
				greenm[0]=lastm;
				greeni[0]=lasti;
		}
		
		function blueoa()
		{
		
				var i, last,lastm;

                /* Store last element of array */
                last = blueo[7];
				lastm=bluem[7];
				lasti=bluei[7];

                for(i=7; i>0; i--)
                {
                    /* Move each array element to its right */
                    blueo[i] = blueo[i - 1];
					bluem[i] = bluem[i - 1];
					bluei[i] = bluei[i - 1];
                }

                /* Copy last element of array to first */
                blueo[0] = last;
				bluem[0]=lastm;
				bluei[0]=lasti;
		}
		function yellowoa()
		{
		
				var i, last,lastm;

                /* Store last element of array */
                last = yellowo[7];
				lastm=yellowm[7];
				lasti=yellowi[7];

                for(i=7; i>0; i--)
                {
                    /* Move each array element to its right */
                    yellowo[i] = yellowo[i - 1];
					yellowm[i] = yellowm[i - 1];
					yellowi[i] = yellowi[i - 1];
                }

                /* Copy last element of array to first */
                yellowo[0] = last;
				yellowm[0]=lastm;
				yellowi[0]=lasti;
		}
		function pinkoa()
		{
		
				var i, last,lastm;

                /* Store last element of array */
                last = pinko[7];
				lastm=pinkm[7];
				lasti=pinki[7];

                for(i=7; i>0; i--)
                {
                    /* Move each array element to its right */
                    pinko[i] = pinko[i - 1];
					pinkm[i] = pinkm[i - 1];
					pinki[i] = pinki[i - 1];
                }

                /* Copy last element of array to first */
                pinko[0] = last;
				pinkm[0]=lastm;
				pinki[0]=lasti;
		}
		function orangeoa()
		{
		
				var i, last,lastm;

                /* Store last element of array */
                last = orangeo[7];
				lastm=orangem[7];
				lasti=orangei[7];

                for(i=7; i>0; i--)
                {
                    /* Move each array element to its right */
                    orangeo[i] = orangeo[i - 1];
					orangem[i] = orangem[i - 1];
					orangei[i] = orangei[i - 1];
                }

                /* Copy last element of array to first */
                orangeo[0] = last;
				orangem[0]=lastm;
				orangei[0]=lasti;
		}
		function blackoa()
		{
		
				var i, last,lastm;

                /* Store last element of array */
                last = blacko[7];
				lastm=blackm[7];
				lasti=blacki[7];

                for(i=7; i>0; i--)
                {
                    /* Move each array element to its right */
                    blacko[i] = blacko[i - 1];
					blackm[i] = blackm[i - 1];
					blacki[i] = blacki[i - 1];
                }

                /* Copy last element of array to first */
                blacko[0] = last;
				blackm[0]=lastm;
				blacki[0]=lasti;
		}
		function brownoa()
		{
		
				var i, last,lastm;

                /* Store last element of array */
                last = browno[7];
				lastm=brownm[7];
				lasti=browni[7];

                for(i=7; i>0; i--)
                {
                    /* Move each array element to its right */
                    browno[i] = browno[i - 1];
					brownm[i] = brownm[i - 1];
					browni[i] = browni[i - 1];
                }

                /* Copy last element of array to first */
                browno[0] = last;
				brownm[0]=lastm;
				browni[0]=lasti;
		}
		
		
		
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		function redoc()
		{
			var i, temp,temp1;
			  temp = redo[0];
			  temp1=redm[0];
			  temp2=redi[0];
			  for (i = 0; i < 7; i++){
				redo[i] = redo[i+1];
				redm[i] = redm[i+1];
				redi[i] = redi[i+1];
				 }
			  redo[i] = temp;
			  redm[i] = temp1;
			  redi[i] = temp2;
				
		}
		function greenoc()
		{
			var i, temp,temp1;
			  temp = greeno[0];
			  temp1=greenm[0];
			  temp2=greeni[0];
			  for (i = 0; i < 7; i++){
				greeno[i] = greeno[i+1];
				greenm[i] = greenm[i+1];
				greeni[i] = greeni[i+1];
				 }
			  greeno[i] = temp;
			  greenm[i] = temp1;
			  greeni[i] = temp2;
				
		}
		function blueoc()
		{
			var i, temp,temp1;
			  temp = blueo[0];
			  temp1=bluem[0];
			  temp2=bluei[0];
			  for (i = 0; i < 7; i++){
				blueo[i] = blueo[i+1];
				bluem[i] = bluem[i+1];
				bluei[i] = bluei[i+1];
				 }
			  blueo[i] = temp;
			  bluem[i] = temp1;
			  bluei[i] = temp2;
				
		}
		function yellowoc()
		{
			var i, temp,temp1;
			  temp = yellowo[0];
			  temp1=yellowm[0];
			  temp2=yellowi[0];
			  for (i = 0; i < 7; i++){
				yellowo[i] = yellowo[i+1];
				yellowm[i] = yellowm[i+1];
				yellowi[i] = yellowi[i+1];
				 }
			  yellowo[i] = temp;
			  yellowm[i] = temp1;
			  yellowi[i] = temp2;
				
		}
		function pinkoc()
		{
			var i, temp,temp1;
			  temp = pinko[0];
			  temp1=pinkm[0];
			  temp2=pinki[0];
			  for (i = 0; i < 7; i++){
				pinko[i] = pinko[i+1];
				pinkm[i] = pinkm[i+1];
				pinki[i] = pinki[i+1];
				 }
			  pinko[i] = temp;
			  pinkm[i] = temp1;
			  pinki[i] = temp2;
				
		}
		function orangeoc()
		{
			var i, temp,temp1;
			  temp = orangeo[0];
			  temp1=orangem[0];
			  temp2=orangei[0];
			  for (i = 0; i < 7; i++){
				orangeo[i] = orangeo[i+1];
				orangem[i] = orangem[i+1];
				orangei[i] = orangei[i+1];
				 }
			  orangeo[i] = temp;
			  orangem[i] = temp1;
			  orangei[i] = temp2;
				
		}
		function blackoc()
		{
			var i, temp,temp1;
			  temp = blacko[0];
			  temp1=blackm[0];
			  temp2=blacki[0];
			  for (i = 0; i < 7; i++){
				blacko[i] = blacko[i+1];
				blackm[i] = blackm[i+1];
				blacki[i] = blacki[i+1];
				 }
			  blacko[i] = temp;
			  blackm[i] = temp1;
			  blacki[i] = temp2;
				
		}
		function brownoc()
		{
			var i, temp,temp1;
			  temp = browno[0];
			  temp1= brownm[0];
			  temp2=browni[0];
			  for (i = 0; i < 7; i++){
				browno[i] = browno[i+1];
				brownm[i] = brownm[i+1];
				browni[i] = browni[i+1];
				 }
			  browno[i] = temp;
			  brownm[i] = temp1;
			  browni[i] = temp2;
				
		}
		
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function rotateWheel(ctx,radius) {
 
				
				
				
				if(!col.localeCompare("red")){redoc();}
				if(!col.localeCompare("green")){greenoc();}
				if(!col.localeCompare("blue")){blueoc();}
				if(!col.localeCompare("yellow")){yellowoc();}
				if(!col.localeCompare("pink")){pinkoc();}
				if(!col.localeCompare("orange")){orangeoc();}
				if(!col.localeCompare("black")){blackoc();}
				if(!col.localeCompare("brown")){brownoc();}

            

            
				var i, last;

                /* Store last element of array */
                last = colours[7];

                for(i=7; i>0; i--)
                {
                    /* Move each array element to its right */
                    colours[i] = colours[i - 1];
                }

                /* Copy last element of array to first */
                colours[0] = last;

                /*ctx1.translate(centreX, centreY);

                ctx1.rotate(rotateAngle);

                ctx1.translate(-centreX, -centreY);*/
                drawWheel(ctx,radius);
                drawFace(ctx, radius-15);
  				drawNumbers(ctx, radius-15);
  
     

              

            

        }
		function rotateWheelreverse(ctx,radius) {

            
			if(!col.localeCompare("red")){redoa();}
				if(!col.localeCompare("green")){greenoa();}
				if(!col.localeCompare("blue")){blueoa();}
				if(!col.localeCompare("yellow")){yellowoa();}
				if(!col.localeCompare("pink")){pinkoa();}
				if(!col.localeCompare("orange")){orangeoa();}
				if(!col.localeCompare("black")){blackoa();}
				if(!col.localeCompare("brown")){brownoa();}

            {
				var i, temp;
			  temp = colours[0];
			  for (i = 0; i < 7; i++)
				 colours[i] = colours[i+1];
			  colours[i] = temp;

                /*ctx1.translate(centreX, centreY);

                ctx1.rotate(rotateAngle);

                ctx1.translate(-centreX, -centreY);*/
                drawWheel(ctx,radius);
                drawFace(ctx, radius-15);
  				drawNumbers(ctx, radius-15);
  
     

              

            }

        }
function drawWheel(ctx,radius) {

            
			
			

             {
				

                for (i = 0; i < 8; i++) {
				
					
					 ctx.fillStyle = colours[i];

                   

                    ctx.translate(centreX, centreY);

                    ctx.rotate(rotateAngle);

                    ctx.translate(-centreX, -centreY);

                    ctx.beginPath();

                    ctx.moveTo(centreX, centreY);

                    ctx.lineTo(centreX + radius, centreY);

                    ctx.arc(centreX, centreY, radius, startAngle, endAngle,false);

                    ctx.closePath();

                    ctx.fill();
					
					

                } ;
				
				

            }
			
			

        }
		function reset() {
		txt='\0';
		str ='';
		 colours = ["brown", "red", "green", "blue", "yellow", "pink", "orange", "black"];
		redo=[2,3,4,5,6,7,8,1];
		redm=['b','c','d','e','f','g','h','a'];
		redi=['j','k','l','m','n','o','p','i'];
		
		 greeno=[3,4,5,6,7,8,1,2];
		 greenm=['c','d','e','f','g','h','a','b'];
		 greeni=['k','l','m','n','o','p','i','j'];
		
		 blueo=[4,5,6,7,8,1,2,3];
		 bluem=['d','e','f','g','h','a','b','c'];
		 bluei=['l','m','n','o','p','i','j','k'];
		
		 yellowo=[5,6,7,8,1,2,3,4];
		 yellowm=['e','f','g','h','a','b','c','d'];
		 yellowi=['m','n','o','p','i','j','k','l'];
		
		 pinko=[6,7,8,1,2,3,4,5];
		 pinkm=['f','g','h','a','b','c','d','e'];
		 pinki=['n','o','p','i','j','k','l','m'];
		
		 orangeo=[7,8,1,2,3,4,5,6];
		 orangem=['g','h','a','b','c','d','e','f'];
		 orangei=['o','p','i','j','k','l','m','n'];
		
		 blacko=[8,1,2,3,4,5,6,7];
		 blackm=['h','a','b','c','d','e','f','g'];
		 blacki=['p','i','j','k','l','m','n','o'];
		
		 browno=[1,2,3,4,5,6,7,8];
		 brownm=['a','b','c','d','e','f','g','h'];
		 browni=['i','j','k','l','m','n','o','p'];
		 drawClock();
		 document.getElementById("password").value = str;
    
		}
		function printi() {
		
		if(!col.localeCompare("red")){
			str=str+redi[0];
			txt=txt+"*";}
		if(!col.localeCompare("green")){
			str=str+greeni[0];
			txt=txt+"*";}
		if(!col.localeCompare("blue")){
			str=str+bluei[0];
			txt=txt+"*";}
		if(!col.localeCompare("yellow")){
			str=str+yellowi[0];
			txt=txt+"*";}
		if(!col.localeCompare("pink")){
			str=str+pinki[0];
			txt=txt+"*";}
		if(!col.localeCompare("orange")){
			str=str+orangei[0];
			txt=txt+"*";}
		if(!col.localeCompare("black")){
			str=str+blacki[0];
			txt=txt+"*";}
		if(!col.localeCompare("brown")){
			str=str+browni[0];
			txt=txt+"*";}
    
    document.getElementById("password").value = str;
}

function printm() {
		
		if(!col.localeCompare("red")){
			str=str+redm[0];
			txt=txt+"*";}
		if(!col.localeCompare("green")){
			str=str+greenm[0];
			txt=txt+"*";}
		if(!col.localeCompare("blue")){
			str=str+bluem[0];
			txt=txt+"*";}
		if(!col.localeCompare("yellow")){
			str=str+yellowm[0];
			txt=txt+"*";}
		if(!col.localeCompare("pink")){
			str=str+pinkm[0];
			txt=txt+"*";}
		if(!col.localeCompare("orange")){
			str=str+orangem[0];
			txt=txt+"*";}
		if(!col.localeCompare("black")){
			str=str+blackm[0];
			txt=txt+"*";}
		if(!col.localeCompare("brown")){
			str=str+brownm[0];
			txt=txt+"*";}
			
			document.getElementById("password").value = str;
    
    
}
function printo() {
		
		if(!col.localeCompare("red")){
			str=str+redo[0];
			txt=txt+"*";}
		if(!col.localeCompare("green")){
			str=str+greeno[0];
			txt=txt+"*";}
		if(!col.localeCompare("blue")){
			str=str+blueo[0];
			txt=txt+"*";}
		if(!col.localeCompare("yellow")){
			str=str+yellowo[0];
			txt=txt+"*";}
		if(!col.localeCompare("pink")){
			str=str+pinko[0];
			txt=txt+"*";}
		if(!col.localeCompare("orange")){
			str=str+orangeo[0];
			txt=txt+"*";}
		if(!col.localeCompare("black")){
			str=str+blacko[0];
			txt=txt+"*";}
		if(!col.localeCompare("brown")){
			str=str+browno[0];
			txt=txt+"*";}
    
    document.getElementById("password").value = str;
}
function del()
{
	str = str.slice(0, -1);
		document.getElementById("password").value = str;
}
		
		drawClock();
		
		document.getElementById("demo").onclick = function() {rotateWheel(ctx,radius)};
		document.getElementById("demo1").onclick = function() {rotateWheelreverse(ctx,radius)};
		document.getElementById("outer").onclick = function() {printo()};
		document.getElementById("inner").onclick = function() {printi()};
		document.getElementById("middle").onclick = function() {printm()};
		document.getElementById("reset").onclick = function() {reset()};
		document.getElementById("del").onclick = function() {del()};
		
		
</script>
</div>
<?php } ?>
</body>
</html>