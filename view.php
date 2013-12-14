<? ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Landing Page w Ajax</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>

	<!-- HTML STUFF -->
	<?php echo $foo_data?>
	<br />
	<br />	
	<button id="a_random_button" value="Button 1" >Button 1</button> 
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/index.js"></script>
    <script>
    $(document).ready(function(){
        app.init();
    });   
    </script>     
  </body>
</html>
