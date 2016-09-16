<?php
    session_start();
    if(!isset($_SESSION))
    header("location:index.php");
     $TopicName= $_SESSION["TopicName"]; 
     $DomainName= $_SESSION["DomainName"];
     $TeamName=$_SESSION["TeamName"];
     $TeamId=$_SESSION["TeamId"];
     $SynopsisAvailable=$_SESSION["SynopsisAvailable"];
     if($SynopsisAvailable)
     {
      ?> 
          <style type="text/css">#synopsis{ display:none; }</style>   
        <?php
      } 
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- oswald font -->
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet"> 
  <!-- stylesheet -->
    <link rel="stylesheet" type="text/css" href="asset/css/styles.css"/>
<script type="text/javascript">
  function logout(){
    location.href="logout.php";
  }
  </script>

<style>
  /* layout.css Style */
.upload-drop-zone {
  height: 200px;
  border-width: 2px;
  margin-bottom: 20px;
}

/* skin.css Style*/
.upload-drop-zone {
  color: #ccc;
  border-style: dashed;
  border-color: #ccc;
  line-height: 200px;
  text-align: center
}
.upload-drop-zone.drop {
  color: #222;
  border-color: #222;
}
</style>

</head>
<body>

<div class="jumbotron text-center" id="jumbotron" style="background-image: url('asset/images/1.png'); background-size: cover;">
  <h1 style="font-family: 'Oswald', sans-serif; font-size: 80px; letter-spacing: 6px; color:#fbc94a;" id="head-name">SCROLLS 2016</h1>
  <!-- <h2 style="color:white;">Welcome</h2>  -->
</div>
  
  <button id="logout-btn" onclick="logout()">Logout</button>


<div class="container" style="text-align: center;">
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="main-head">          
          <div class="row">

            <h3>Hello Team <strong><?php echo $TeamName; ?></strong>, your team ID is <strong><?php echo $TeamId; ?></strong></h3>
          </div>
          <div class="row" style="margin-top:0%;">
            <h4>You have chosen the topic <span id="topic-name"><strong><?php echo $TopicName; ?></strong></span> under the Domain <span id="domain-name"><strong><?php echo $DomainName; ?></strong></span></h4>
          </div>

            
      </div>
  

                <div id="" class="col-sm-6 col-xs-12 col-sm-offset-3" style="margin-top:1%;">          
                  <div class="row" style="margin-top:3%; color:#5f5f5f;">
                  <?php
                  if($SynopsisAvailable)
                        {
                  ?>  
                        <h4>It seems you have submitted your Synopsis. </br> We will respond soon !</h4>
                  <?php
                        }
                  else {

                  ?>
                        <h4>It seems you havent submitted your Synopsis.</h4>
                  <?php
                      }
                  ?>
        </div>
                     <!-- 
                  <div class="panel panel-default" >
                    <div class="panel-body">
 -->
                      <!-- Standar Form -->
                     
                      <form method="post" id="synopsis" enctype="multipart/form-data" action="upload.php" id="js-upload-form">
                        <div class="form-inline" id="image-upload">
                          <div class="form-group">
                            <input type="file" name="uploadedfile" accept="application/pdf" id="js-upload-files" multiple>
                          </div>
                        </div>
                          <input type="submit" class="btn btn-send" id="js-upload-submit" value="Submit Your Final Paper" style=" border-radius:0px;">
                      </form>
                      
                      <!-- Drop Zone -->
<!--
                      <div class="upload-drop-zone" id="drop-zone">
                        Just drag and drop files here
                      </div>
        
                    
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>

                      
                      <div class="js-upload-finished">
                        <h3>Processed files</h3>
                        <div class="list-group">
                          <a href="#" class="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>image-01.jpg</a>
                          <a href="#" class="list-group-item list-group-item-success"><span class="badge alert-success pull-right">Success</span>image-02.jpg</a>
                        </div>
                      </div>
        -->             
                    <!-- </div>
                  </div>  -->
            </div>  
          </div>
</div>

<script>
  + function($) {
    'use strict';

    // UPLOAD CLASS DEFINITION
    // ======================

    var dropZone = document.getElementById('drop-zone');
    var uploadForm = document.getElementById('js-upload-form');

    var startUpload = function(files) {
        console.log(files)
    };

    uploadForm.addEventListener('submit', function(e) {
        var uploadFiles = document.getElementById('js-upload-files').files;
        e.preventDefault();

        startUpload(uploadFiles)
    });

    dropZone.ondrop = function(e) {
        e.preventDefault();
        this.className = 'upload-drop-zone';

        startUpload(e.dataTransfer.files)
    };

    dropZone.ondragover = function() {
        this.className = 'upload-drop-zone drop';
        return false;
    };

    dropZone.ondragleave = function() {
        this.className = 'upload-drop-zone';
        return false;
    };

}(jQuery);
</script>

</body>
</html>