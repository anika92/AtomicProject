<?php
//var_dump($_POST);
include_once('vendor/autoload.php');
use App\Bitm\SEIP1292\ProfilePicture\ImageUploader;

$active= new ImageUploader();
$activeItem=$active->showActive();

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Resource/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="Resource/bootstrap/js/bootstrap.js">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>






    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>

<section id="infoPage">

    <?php
    foreach($activeItem as $Item){
    ?>
    <img src="Resource/images/<?php echo $Item->images?>" alt="Anika" width="150" height="100" />

    <?php }
    ?>
    <header>
        <h1>Asma Anika Shahabuddin</h1>
        <h2>Developer, Designer</h2>
    </header>

    <p class="description">I am a webdeveloper living in Chittagong. I enjoy designing and coding web applications <br />
        <br />
        Follow me on twitter or facebook.</p>
<div class="social">
    <a href="#" class="grayButton">Find me on Facebook</a>
    <a href="#" class="grayButton">Follow me on Twitter</a>

</div>
</section>




<div class="btn-group">
    <button type="button"  class="btn btn-primary active" onclick="window.location.href='index.php'" class="active">Home</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href='views/SEIP1292/Book/index.php'">Book Title</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href='views/SEIP1292/Birthday/index.php'">Birthday</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href='views/SEIP1292/Email/index.php'">Email</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href='views/SEIP1292/City/index.php'">City</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href='views/SEIP1292/ProfilePicture/index.php'">Profile Picture</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href='views/SEIP1292/Gender/index.php'">Gender</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href='views/SEIP1292/Hobby/index.php'">Hobby</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href='views/SEIP1292/Summary/index.php'">Organization Summary</button>
    </div>



<footer>
    <h2>Creating a PHP Based Atomic Project</h2>

</footer>

<!-- BSA AdPacks code. Please ignore and remove. -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>



</body>
</html>

