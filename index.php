<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<script>
//start session
<?php session_start(); ?> 
//go to page top
function topfunction(){
	document.documentElement.scrollTop = 0;
}
//set bar position
window.onscroll = function(){
	if(document.documentElement.scrollTop > 100){
        //fix the top bar location
		document.getElementsByClassName("bar")[0].style.position = "fixed";
	}else{
		document.getElementsByClassName("bar")[0].style.position = "";
	}
}
</script>

<script type="text/javascript">
//
function goTofunction(){
    <?php
        //if login
        if(isset($_SESSION['pos'])){
            //success login->go to main page
            if(($_SESSION['pos'])=="restaurant"){
                echo'location.href = "mainR.php";';
            }else if(($_SESSION['pos'])=="manager"){
                echo'location.href = "mainM.php";';
            }
        }else{
            //have not login yet
            $msg = "Please login first";
            echo "alert('$msg');";
        }
    ?>
}

//slideshow gallery
var slideIndex = 1;
showSlides(slideIndex);
//back slide
function countSlide(n) {
    showSlides(slideIndex += n);
}
//current slide
function presentSlide(n) {
    showSlides(slideIndex = n);
}
//current slide
function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("slides");
  var dots = document.getElementsByClassName("form");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
</head>
    <link rel="stylesheet" type="text/css" href="../itp4513/css/style.css" >
    <link rel="icon" href="../itp4513/image/order-Logo.png">
<body>
    <nav>
      <!--page bar-->
      <div class="bar">
          <ul>
          <!--page bar button-->
            <li><a href="../itp4513/index.php">Home</a></li>
          </ul>
          <!--login related-->
          <div class="login"> 
          <?php
          if(isset($_SESSION['id'])&& isset($_SESSION['name'])){
            //login success
						echo'<form method="POST" action ="logout.php">
							'.'<div class="name">'.'<label>Hi, </label>'.
							$_SESSION['name'].'</div>'.
							'<button type="submit" name="logout">Logout</button>
							</form>';
					}else{
            //original login form
						echo'<form method="POST" action="login.php">
                            <select name="pos">
                                <option value="" selected hidden>Select position:</option>
                                <option value="1">Restaurant</option>
                                <option value="2">Manager</option>
                            </select>
                	  		<input type="text" name="uid" placeholder="UserID">
                	  		<input type="password" name="pwd" placeholder="Password">
                	  		<button type="submit" name="login" >Login</button>
                			</form>';
					}
				?>
            </div>
       </div>
      <!--index background-->
    	<div class="background">
    		<div class="content">
        		<h1>Welcome to IVE Food Ordering System</h1>
        </div>
        <button class="start" onclick="goTofunction()">Start Application</button>
       	<br>
        <img src="../itp4513/image/scroll-down.png">
    	</div>
      <!--About our system-->
        <div class="more">
        	<h3>About our system</h3>
            <div class="function">
                <table>
                    <th><img src="../itp4513/image/add.png" id="add" /></th>
                    <th><img src="../itp4513/image/modify.png" id="modify"></th>
                    <th><img src="../itp4513/image/delete.png" id="del"></th>
                    <th><img src="../itp4513/image/list.png" id="list"></th>
                    <tr height="20px"></tr>
                    <tr><td>Add</td>
                    <td>Modify</td>
                    <td>Delete</td>
                    <td>View</td></tr>
                </table>
            </div>
        </div>
        <br><br><br><br>
        <!--slide show text with picture-->
        <div class="slideshow">
          <div class="slides">
            <div class="slino">1 / 4</div>
            <img src="../itp4513/image/orderpg.PNG">
          </div>

          <div class="slides">
            <div class="slino">2 / 4</div>
            <img src="../itp4513/image/warehousepg.PNG">
          </div>

          <div class="slides">
            <div class="slino">3 / 4</div>
            <img src="../itp4513/image/stockpg.PNG">
          </div>
            
          <div class="slides">
            <div class="slino">4 / 4</div>
            <img src="../itp4513/image/detailspg.PNG">
          </div>
          <!--slide show flip button-->
          <a class="pre" onclick="countSlide(-1)">❮</a>
          <a class="next" onclick="countSlide(1)">❯</a>

          <div class="guide">
            <p id="caption">Click to view our demo &#9662;</p>
          </div>
          <!--slide show small picture-->
          <div class="tr">
            <div class="td">
              <img class="form cursor" src="../itp4513/image/orderpg.PNG" onclick="presentSlide(1)" 
              alt="Order Form">
            </div>
            <div class="td">
              <img class="form cursor" src="../itp4513/image/warehousepg.PNG" onclick="presentSlide(2)" 
              alt="Warehouse Form">
            </div>
            <div class="td">
              <img class="form cursor" src="../itp4513/image/stockpg.PNG" onclick="presentSlide(3)" 
              alt="Stock Form">
            </div>
            <div class="td">
              <img class="form cursor" src="../itp4513/image/detailspg.PNG" onclick="presentSlide(4)" 
              alt="Details Form">
            </div>
          </div>
        </div>
        <!--on to top button-->
        <div class="top">
        	<button onclick="topfunction()">˄</button>
        </div>
    <!--footer-->    
		<div class="footer">
        	<h5>Copyright ©2018 All rights reserved | Made by Elsie & Tinley</h5>
    	</div>
    </nav>

</body>
</html>