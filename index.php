<?php


### CONFIG ###

$name = "Name"; // SET YOUR NAME HERE
$thisversion = "1.02"; // DO NOT CHANGE THIS


/* FILE TYPES */
$filetypes = array(
    '.png',
    '.gif',
    '.zip',
    );


/* PUBLICITY */

$allpublic = "0"; // IF ENABLED ALL FILES WILL BE PUBLIC

/*  NOTE: THIS OPTION IS DISABLED IF ALLPUBLIC = 1*/
$public = array(
    'none',
    );


## END OF CONFIG ###

/* DO NOT EDIT BELOW THIS LINE */
?>
<html>
<head>
<title><?php echo $name;?>'s - File Dump</title>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href="http://bootswatch.com/cyborg/bootstrap.min.css" rel="stylesheet">

</head>

    <div class="container">
    <div class="row">
      <div class="jumbotron">

<center><div id="header">
<h1><center><?php echo $name;?>'s File Dump</center></h1>
<br><Br>
<table class="table table-hover">
<thead>
<tr>
<th>&nbsp;</th>
<th>File Name</th>
<th>Date Created</th>
<th>File Type</th>
<th>File Size</th>
<th>Publicity</th>
</tr>
</thead>
<tbody>


<?php


    
function formatbytes($file, $type)
{
   switch($type){
      case "KB":
         $filesize = filesize($file) * .0009765625; // bytes to KB
      break;
      case "MB":
         $filesize = (filesize($file) * .0009765625) * .0009765625; // bytes to MB
      break;
      case "GB":
         $filesize = ((filesize($file) * .0009765625) * .0009765625) * .0009765625; // bytes to GB
      break;
   }
   if($filesize <= 0){
      return $filesize = 'unknown file size';}
   else{return round($filesize, 2).' '.$type;}
}

foreach($filetypes as $filetype) {
$filelist[str_replace(".","",$filetype)] =  glob("*". $filetype);



foreach($filelist[str_replace(".","",$filetype)] as $result) {


      echo '<tr>';

    if(in_array($result,$public)){
    echo '<th><i class="fa fa-file"></i></th>';
    } elseif($allpublic === "1") {
    echo '<th><i class="fa fa-file"></i></th>';
    } else {
    echo '<th><i class="fa fa-file-o"></i></th>';
    };

if(in_array($result,$public)){
    echo '<th><a target="_blank"  style="text-decoration: none;" title="" href="'. $result .'">'. str_replace($filetype,"",$result),'</a></th>';
    } elseif($allpublic === "1") {
    echo '<th><a target="_blank"  style="text-decoration: none;" title="" href="'. $result .'">'. str_replace($filetype,"",$result),'</a></th>';
    } else {
    echo '<th>**********</th>';
    };
 
$filetype1 = str_replace(".","",$filetype);
    echo '<th>'. date ("F d Y H:i:s", filemtime($result)) .' GMT </th>';
    echo '<th>'. strtoupper($filetype1) .' </th>';
    echo '<th>'. formatbytes($result, "MB") .'</th>';
    if(in_array($result,$public)){
    echo '<th>Public</th>';
    } elseif($allpublic === "1") {
      echo '<th>Public</th>';   
    } else {
    echo '<th>Private</th>';
    };
      echo '</tr>';
}




}


?>


</table>
</div>
</div>
<div class="footer">
         <p>&copy; <?php echo $name;?> 2014 
        <?php 
         $version = @file_get_contents("https://raw.githubusercontent.com/ZigiDevelopment/filedump/master/version.txt");
         if($version !== $thisversion) {
          echo '<br><p>Version: '. $thisversion .' </p><p style="color:red">Your filedump script is out of date. <a href="https://github.com/ZigiDevelopment/filedump">Update here!</a></p>';
         } else {
          echo '<br><p>Version: '. $thisversion .' </p>';
         }


          ?><span style="float:right">Made by <a href="https://twitter.com/ZigiDev">ZigiDev</a>.</span></p>
        
</div>
</body>
</html>