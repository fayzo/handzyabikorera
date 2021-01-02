<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hand-Made</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK ;?>dist/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK ;?>dist/css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK ;?>dist/css/responsive.css">
    <!-- icon -->
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/themify-icons.css" type="text/css">
    <!-- fevicon -->
    <link rel="icon" href="<?php echo BASE_URL_LINK ;?>images/fevicon.png" type="image/gif" />
    <!-- fevicon -->
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK ;?>dist/css/ui.totop.css" >
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/dataTables.bootstrap4.min.css" type="text/css" >
    <!-- <link rel="stylesheet" href="< ?php echo BASE_URL_LINK;?>assets/css/responsive.bootstrap4.min.css" type="text/css" > -->
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/imagePopup.css" type="text/css">
    <link rel="stylesheet" href="<?php echo BASE_URL_LINK ;?>dist/css/profile.css">
    
    <!-- <link rel="stylesheet" href="< ?php echo BASE_URL_LINK;?>plugin/fontawesome-free/css/all.min.css"> -->
    
    <!-- Scrollbar Custom CSS -->
    <!-- < link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css"> -->
    <!-- Tweaks for older IEs-->
    <!-- <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen"> -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   
</head>
<!-- body -->
<script type="text/javascript">
    
    function showResult(){
		var provincecode=document.getElementById('provincecode').value;
		var params = "&provincecode="+provincecode+"";
		http=new XMLHttpRequest();
		http.open("POST","core/ajax_db/getdistrict.php",true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		http.send(params);
		http.onreadystatechange = function() 
		{//Call a function when the province changes.
			
		document.getElementById("districtcode").innerHTML= http.responseText;
				
		if(document.getElementById('districtcode').value!=="No District Available")
		document.form.name.disabled=false;
		
		}		
	}
	    
		
	    //Get sectors list
		function showResult2(){
		var districtcode=document.getElementById('districtcode').value;
		var params = "&districtcode="+districtcode+"";
		http=new XMLHttpRequest();
		http.open("POST","core/ajax_db/getsector.php",true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		http.send(params);
		http.onreadystatechange = function() 
		{//Call a function when the district changes.
			
		document.getElementById("sectorcode").innerHTML=http.responseText;
				
		if(document.getElementById('sectorcode').value!=="No Sector Available")
		document.form.name.disabled=false;
		
		}		
	}
	
    //Get cell list
    function showResult3(){
		var sectorcode=document.getElementById('sectorcode').value;
		var params = "&sectorcode="+sectorcode+"";
		http=new XMLHttpRequest();
		http.open("POST","core/ajax_db/getcell.php",true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		http.send(params);
		http.onreadystatechange = function() 
		{//Call a function when the sector changes.
			
		document.getElementById("codecell").innerHTML=http.responseText;
				
		if(document.getElementById('codecell').value!=="No Cell Available")
		document.form.name.disabled=false;
		
		}		
    }

    //Get cell list
  
	// Get Villages list
    function showResult4(){
		var codecell=document.getElementById('codecell').value;
		var params = "&codecell="+codecell+"";
		http=new XMLHttpRequest();
		http.open("POST","core/ajax_db/getvillage.php",true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send(params);
		http.onreadystatechange = function() 
		{
            // Call a function when the cell changes.
			
		document.getElementById("CodeVillage").innerHTML=http.responseText;
				
		if(document.getElementById('CodeVillage').value!=="No village Available")
		document.form.name.disabled=false;
		
		}		
	}
	
  
    function foodCategories(categories,id,user_id) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'core/ajax_db/foodView_FecthPaginat.php?pages=' + id + '&categories=' + categories+ '&user_id=' + user_id, true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                switch (categories) {
                    case categories:
                         var pagination = document.getElementById('food-hides');
                         pagination.innerHTML = xhr.responseText;
                        break;
                }
            }
        };
          xhr.addEventListener('progress',function(e){
             var progress= Math.round((e.loaded/e.total)*100);
             $('.progress-navbar').show();
             $('#progress_width').css('width',progress +'%');
             $('#progress_width').html(progress +'%');
         }, false);

        xhr.addEventListener('load', function (e) { 
            $('.progress-bar').removeClass('bg-info').addClass('bg-danger').html('<span> completed  <span class="fa fa-check"></span></span>');
            setInterval(function () {
                $(".progress-navbar").fadeOut();
            }, 2000);
        }, false);

    }
    
  </script>
