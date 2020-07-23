<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Willkommen</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
    <script src="js/bootstrap.js"></script>
    <link href="index.css" rel="stylesheet"/>
</head>
<body>
    <div class="page-header">
        <h1>Hallo, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.Willkommen!.</h1>
    </div>
    <p>
       
        <a href="logout.php" class="btn btn-primary">Abmeldung</a>
    </p>
    <?php 
     $url='http://newsapi.org/v2/everything?q=bitcoin&from=2020-06-23&sortBy=publishedAt&apiKey=6e7dddf6894e48c282b961b4f219876e';
     $response= file_get_contents($url);
     $newsData=  json_decode($response);
    ?>
    <div class="jumbotron">
        <h1>Bitcoins Update</h1>
       <div class="container-fluid">
           <?php
           foreach($newsData->articles as $news)
           {
               ?>
            <div class="row NewsGrid">
                <div class="col-md-4">
                    <img src="<?php echo $news->urlToImage  ?>" alt="News thumbnail">
                </div>
                <div class="col-md-8">
                    <h2><b>Title:</b> <?php echo $news->title ?></h2>
                   
                    <h5><b>Content:</b> <?php echo $news->content ?></h5>
                    <h6><b>Autor:</b> <?php echo $news->author ?></h6>
                    <h6><b>Veröffenlichen:</b> <?php echo $news->publishedAt ?></h6>
                </div>
            </div>
            <?php
           }
           ?>
       </div>
    </div>
</body>
</html>