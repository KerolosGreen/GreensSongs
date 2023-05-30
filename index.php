<?php
include './Db_Connect.php';
session_start();
$numberoflovedsongs='';
if(isset($_SESSION['username']) && $_SESSION['Role']==1){
  $loginfo='Dashboard';
}
else{
  if(isset($_SESSION['username']) && $_SESSION['Role']==0){
  $loginfo='Favourite'.'  '.'<i class="fa-regular fa-heart" style="color: #9b2c2c;"></i>';
}

else{
  $loginfo='Login';
}
}
 if(isset($_POST['mysubmitbutton'])){

  if(!isset($_SESSION['username'])){
    // echo $errmsg="Please Log In First";
    header("location: login.php");
  }
  //*********************************LASTE DIT */
  if($_SESSION['Role']==1){

  }
  //*********************************LAST EDIT */
  else{
    $_viewadded = mysqli_query($connect,"SELECT * FROM favs WHERE song_Id= '".$_POST['loveid']."' AND user_id= '".$_SESSION['ID']."' ");
  if(mysqli_num_rows($_viewadded) > 0){
    
  }
  else{
     mysqli_query($connect,"INSERT INTO favs(song_Id,user_id) VALUES ('".$_POST['loveid']."','".$_SESSION['ID']."')");
  }
  }
  //  echo '<br>'.'<br>'.'<br>'.'<br>'.'<br>'.$_POST['loveid'];
  
 
}

$sqlretrieve = "SELECT * FROM songs WHERE View = 1";
$result = mysqli_query($connect,$sqlretrieve);
$songs = mysqli_fetch_all($result,MYSQLI_ASSOC);
// echo '<pre>';
// print_r($songs);
// echo '<pre>';
if(isset($_SESSION['ID'])){
  $_viewnumberadded = mysqli_query($connect,"SELECT * FROM favs WHERE user_id= '".$_SESSION['ID']."' ");
  $numberoflovedsongs = mysqli_num_rows($_viewnumberadded);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greens's Songs</title>
    <script src="https://kit.fontawesome.com/64cc13dfa7.js" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">


        <style>
            html{
                      -webkit-background-size: cover;
                    -moz-background-size: cover;
                     -o-background-size: cover;
            }
            body{
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            .Song{
                box-shadow: 0px 5px 15px 3px rgba(0,0,0,0.4);
                flex-direction: column;
                position: relative;
                cursor: pointer;
                margin: 10px;
                font-family: 'Courier New', Courier, monospace;
                text-align: center;
                color:white;
                min-width:190px;
                max-width:320px;
                /* height:240px;  */
                /* max-height:fit-content; */
                height: 240px;
                
                background-color: #181818;
                border-radius: 10px;
                transition: ease-in-out;
                transition-duration: .25s;
            }
            .Song:hover {
    
             background-color: rgb(34, 34, 34);
                
            }
            .sn {
                margin-top: 5%;
                font-size: 18px;

            
            }
            .sd{
                font-size: 10px;
            }
            .sa{
                font-size: 14px;
            }
            .simg{
                position: relative;
                width: 150px;
                height: 150px;
                margin-left: auto;
                margin-right: auto;
                margin-top: 5%;
                border-radius: 100%;
                box-shadow: 0px 5px 15px 3px rgba(0,0,0,0.4);
                
                
            }
            .songscont{
                    margin-top: 40px;
                    
                    margin-left: auto;
                    margin-right: auto;
                    background-color: rgba(255, 228, 196, 0.137);
                    display: flex;
                    width: fit-content;
                    max-width: 1350px;
                    height: fit-content;
                    border-radius: 20px;
                    backdrop-filter: blur(20px);
                    padding: 10px;
                    flex-direction: row;
                    flex-wrap: wrap;
                    justify-content: center;
                    box-shadow: 0px 5px 15px 3px rgba(0,0,0,0.4);
                    
            }
            
            body{
                background-attachment: fixed;
                color: white;
                /*background-image: linear-gradient(-10deg,black, var( --defaultcolor) , rgb(88, 58, 0),rgb(65, 0, 0));*/
                /*background-image: linear-gradient(-30deg,rgb(3, 0, 44), rgb(49, 97, 136),rgb(14, 59, 95),rgb(2, 23, 41));*/
                background-image: linear-gradient(-30deg,rgb(15, 14, 32), rgb(49, 136, 117),rgb(14, 59, 95),rgb(2, 23, 41));
                background-repeat: no-repeat;
                /*background-color: tr;*/
                overflow-y: overlay;
                }
                *{
                box-sizing: border-box;
    
                }

                ::-webkit-scrollbar {
                    /*background-image: linear-gradient(0deg,rgb(15, 14, 32),rgb(14, 59, 95),rgb(2, 23, 41), rgb(49, 136, 117));*/
                    background-repeat: no-repeat;
                    backdrop-filter: blue(20px);
                    width: 10px;
                }

                ::-webkit-scrollbar-thumb {
                    background-color: rgb(212, 212, 212);
                    width: 20px;
                    border-radius: 10px;
                }
                ::-webkit-scrollbar-thumb:hover {
                    background-color: rgb(156, 156, 156);
                }
                .playbutton{
                    text-align: center;
                overflow: hidden;
                font-size: 18px;
                color: black;
                cursor: pointer;
                opacity: 0;
                position: relative;
                top: -100px;
                left: 140px;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: green;
                transition: ease-in-out;
                transition-duration: .25s;
                width: 40px;
                height: 40px;
                border-radius: 100%;
            }

                .Song:hover .playbutton{
                 top: -130px;
                 opacity: 100%;
   
                }

                .playbutton:hover{
                 transform: scale(1.1);
                }

                .playbutton:active{

                background-color:rgb(0, 88, 0); 
                }
                .fa-solid{
                    margin-left: 3px;
                }
                .Her{
                    text-align: center;
                    margin-top : 80px;
                    font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                    
                }



                .lovebutton{
                text-align: center;
                overflow: hidden;
                font-size: 18px;
                color: black;
                cursor: pointer;
                opacity: 0;
                position: relative;
                top: -130px;
                right: -20px;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: rgba(0, 0, 0, 0.537);
                transition: ease-in-out;
                transition-duration: .25s;
                width: 40px;
                height: 40px;
                border-radius: 100%;
            }

                .Song:hover .lovebutton{
                 top: -165px;
                 opacity: 100%;
   
                }

                .lovebutton:hover{
                 transform: scale(1.1);
                }

                .lovebutton:active{

                  background-color: rgba(256,256,256, 0.437);
                }
                .fa-solid{
                    margin-left: 3px;
                }
                button{
                  border: none;
                }
                button:focus{
                  border: none;
                }
                
        </style>
</head>
<body>


<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo $_SERVER['PHP_SELF'];?>">Green's Songs</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./addsongs.php">Add?</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Viewing Our Songs</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> -->
        <a class="badge nav-link disabled mt-2 "><?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} ?></a>
        <a class="btn btn-outline-success mx-2" href="./login.php"><?php echo $loginfo .' '.$numberoflovedsongs  ?></a>
      </form>
    </div>
  </div>
</nav>
    
<!-- <ul class="dropdown-menu position-static d-grid gap-1 p-2 rounded-3 mx-3 border-0 shadow w-25 my-10" data-bs-theme="dark">
    <li><a class="dropdown-item rounded-2 active" href="#">Action</a></li>
    <li><a class="dropdown-item rounded-2" href="#">Another action</a></li>
    <li><a class="dropdown-item rounded-2" href="#">Something else here</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item rounded-2" href="#">Separated link</a></li>
  </ul> -->

<!-------Login Error----->
  <!-- <?php 

if($errmsg){



?>
<div class="w-25 mx-auto alert alert-danger " role="alert" style="margin-top:60px; position:absolute; left:60%">
<?php echo $errmsg ?>
</div>
<?php
}
?> -->

<!-------Login Error----->



    <h4 class="Her">Listen To What You Love</h4>
    <div class="songscont">
    <?php
    if(!$songs){
        echo '<h5>'."There is No Songs Yet.".'</h5>';
    }

    foreach($songs AS $song):
        ?>


            <div class="Song">

          
            

                <img src="imgs/<?php echo$song["file_name"] ?>" class="simg">
                <h3 class="sn"><?php echo$song['SName'] ?></h3>
                <h3 class="sd"><?php echo$song['Sduration'] ?></h3>
                <h4 class="sa"><?php echo$song['Sartist'] ?></h4>
                <div class="playbutton" target="_blank" href="https://www.youtube.com/results?search_query=<?php echo$song['SName']."+".$song['Sartist'] ?>"><i class="fa-solid fa-play"></i></div>
                <!-- <div class="lovebutton"><i class="fa-regular fa-heart" style="color: #9b2c2c;"></i></div> -->
                <form method="POST">
                  <input type="hidden" name='loveid' value="<?php echo$song["ID"] ?>">
                <button name="mysubmitbutton" class="lovebutton" type="submit">
                  <?php
                  if(isset($_SESSION['ID'])){
                    $_addedornotres = mysqli_query($connect,"SELECT * FROM favs WHERE user_id= '".$_SESSION['ID']."' AND song_Id = '".$song["ID"]."' ");
                    if(mysqli_num_rows($_addedornotres)> 0){
                      echo '<i class="fa-solid fa-heart" style="color: #9b2c2c;"></i>';
                    }
                    else{
                      echo '<i class="fa-regular fa-heart" style="color: #9b2c2c;"></i>';
                    }
                  }
                  else{
                    echo '<i class="fa-regular fa-heart" style="color: #9b2c2c;"></i>';
                  }
                    
                  ?>
                  </button>
                </form>
            </div>
        
        
        <?php
    endforeach;

    ?>

    <!----
    target="_blank" href="https://www.youtube.com/results?search_query=<?php echo$song['SName']."+".$song['Sartist'] ?>"
    --->
    
       
    </div>

    <!----card


    <div class="Song">
            <h3>Song Name</h3>
            <h3>Song Duration</h3>
            <h4>Song Artist</h4>
        </div>


    -->


</body>
</html>