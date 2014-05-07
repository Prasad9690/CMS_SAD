<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php find_selected_page(); ?>
<!DOCTYPE html> 
<html>

<head>
  <title>Light Template</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="stylesheets/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects 
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script> -->
</head>

<body>
  <div id="main">		

    <header>
	  <div id="strapline">
	    <div id="welcome_slogan">
	      <h3>Campus News</h3>
	    </div><!--close welcome_slogan-->
      </div><!--close strapline-->	  
	  <nav>
	    <div id="menubar">
          <ul id="nav">
            <li class="current"><a href="index.php">Home</a></li>
          </ul>
        </div><!--close menubar-->	
      </nav>
    </header>
    
    <div id="slideshow_container">  
	  <div class="slideshow">
	    <ul class="slideshow">
          <li class="show"><img width="940" height="250" src="images/logo.jpg" /></li>
        </ul> 
	  </div><!--close slideshow-->  	
	</div><!--close slideshow_container-->   
	
	<div id="site_content">		
	  
	  <div class="sidebar_container">       
		<div class="sidebar">
          <div class="sidebar_item">
            <?php echo public_navigation($sel_subject, $sel_page); ?>
          </div><!--close sidebar_item--> 
        </div><!--close sidebar-->
       </div><!--close sidebar_container-->	
	   
	  <div id="content">
        <div class="content_item">
			<?php if($sel_page) { ?>
			  <h2><?php echo htmlentities($sel_page['menu_name']); ?></h2>
			  <p><?php echo strip_tags(nl2br($sel_page['content']),"<b><br><p><a>"); ?></p>
			<?php } else { ?>
			  <h2>Welcome</h2>
			<?php } ?>  	
		</div><!--close content_item-->
      </div><!--close content-->   
	</div><!--close site_content-->  	

    <footer>
	  <a href="index.html">Developed by the CMS Group.</a>
    </footer>
	
  </div><!--close main-->
  
  <!-- javascript at the bottom for fast page loading -->
  
</body>
</html>
