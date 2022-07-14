<?php

$id=$_GET['id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <title>GreyBox - Examples</title>

    <script type="text/javascript">
        var GB_ROOT_DIR = "./greybox/";
    </script>

    <script type="text/javascript" src="./greybox/AJS.js"></script>
    <script type="text/javascript" src="./greybox/AJS_fx.js"></script>
    <script type="text/javascript" src="greybox/gb_scripts.js"></script>
    <link href="./greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />

    <script type="text/javascript" src="static_files/help.js"></script>
    <link href="./static_files/help.css" rel="stylesheet" type="text/css" media="all" />
    
   
</head>
<?
if($id==1){

?>
<body onload="return GB_myShow('D.R.S.A.U', 'http://192.168.4.79/papsal/FrmUsuario.php')" background="images/f1.png">
<?  }  ?>

<?

if($id==2){

?>
<body onload="return GB_myShow2('D.R.S.A.U', 'http://192.168.4.79/papsal/FrmVehicular.php')" background="images/f1.png">
<?  }  ?>

<?

if($id==3){

?>
<body onload="return GB_myShow1('D.R.S.A.U', 'http://192.168.4.79/papsal/FrmSalida.php')" background="images/f1.png">
<?  }  ?>
<?

if($id==4){

?>
<body onload="return GB_myShowCar('D.R.S.A.U', 'http://192.168.4.79/papsal/CargaReloj.php')" background="images/f1.png">
<?  }  ?>

<?

if($id==5){

?>
<body onload="return GB_myShowCar1('D.R.S.A.U', 'http://192.168.4.79/papsal/CambiaPass.php')" background="images/f1.png">
<?  }  ?>
<?

if($id==6){

?>
<body onload="return GB_myShow4('D.R.S.A.U', 'http://192.168.4.79/papsal/Pendiente.php')" background="images/f1.png">
<?  }  ?>
<?

if($id==7){

?>
<body onload="return GB_myShow5('D.R.S.A.U', 'http://192.168.4.79/papsal/FrmTardanza.php')" background="images/f1.png">
<?  }  ?>
<?

if($id==8){

?>
<body onload="return GB_myShow5('D.R.S.A.U', 'http://192.168.4.79/papsal/FrmVehiSal.php')" background="images/f1.png">
<?  }  ?>
<?

if($id==9){

?>
<body onload="return GB_myShow4('D.R.S.A.U', 'http://192.168.4.79/papsal/PorAprobar.php')" background="images/f1.png">
<?  }  ?>

<?

if($id==10){

?>
<body onload="return GB_myShow6('D.R.S.A.U', 'http://192.168.4.79/papsal/FrmAsignaPersonal.php')" background="images/f1.png">
<?  }  ?>

 <script type="text/javascript">
GB_myShow = function(caption, url, /* optional */ height, width, callback_fn) {
    var options = {
        caption: caption,
        height: height || 500,
        width: width || 480,
        fullscreen: false,
        show_loading: false,
        callback_fn: callback_fn,
		
		
    }
    var win = new GB_Window(options);
	
    return win.show(url);
}
</script>

<script type="text/javascript">
GB_myShow1 = function(caption, url, /* optional */ height, width, callback_fn) {
    var options = {
        caption: caption,
        height: height || 490,
        width: width || 590,
        fullscreen: false,
        show_loading: false,
        callback_fn: callback_fn,
		
		
    }
    var win = new GB_Window(options);
	
    return win.show(url);
}
</script>

<script type="text/javascript">
GB_myShowCar = function(caption, url, /* optional */ height, width, callback_fn) {
    var options = {
        caption: caption,
        height: height || 300,
        width: width || 500,
        fullscreen: false,
        show_loading: false,
        callback_fn: callback_fn,
		
		
    }
    var win = new GB_Window(options);
	
    return win.show(url);
}
</script>

<script type="text/javascript">
GB_myShowCar1 = function(caption, url, /* optional */ height, width, callback_fn) {
    var options = {
        caption: caption,
        height: height || 200,
        width: width || 500,
        fullscreen: false,
        show_loading: false,
        callback_fn: callback_fn,
		
		
    }
    var win = new GB_Window(options);
	
    return win.show(url);
}
</script>

<script type="text/javascript">
GB_myShow2 = function(caption, url, /* optional */ height, width, callback_fn) {
    var options = {
        caption: caption,
        height: height || 340,
        width: width || 490,
        fullscreen: false,
        show_loading: false,
        callback_fn: callback_fn,
		
		
    }
    var win = new GB_Window(options);
	
    return win.show(url);
}
</script>

<script type="text/javascript">
GB_myShow4 = function(caption, url, /* optional */ height, width, callback_fn) {
    var options = {
        caption: caption,
        height: height || 510,
        width: width || 1050,
        fullscreen: false,
        show_loading: false,
        callback_fn: callback_fn,
		
		
    }
    var win = new GB_Window(options);
	
    return win.show(url);
}
</script>
<script type="text/javascript">
GB_myShow5 = function(caption, url, /* optional */ height, width, callback_fn) {
    var options = {
        caption: caption,
        height: height || 435,
        width: width || 590,
        fullscreen: false,
        show_loading: false,
        callback_fn: callback_fn,
		
		
    }
    var win = new GB_Window(options);
	
    return win.show(url);
}
</script>

<script type="text/javascript">
GB_myShow6 = function(caption, url, /* optional */ height, width, callback_fn) {
    var options = {
        caption: caption,
        height: height || 250,
        width: width || 590,
        fullscreen: false,
        show_loading: false,
        callback_fn: callback_fn,
		
		
    }
    var win = new GB_Window(options);
	
    return win.show(url);
}
</script>

</body>
</html>
