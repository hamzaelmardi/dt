<?php 
ob_start();
session_start();
include('index.php');
function dtmon_compte_shortcode() {
  $wpcon = mysqli_connect("localhost","root","","wordpress");
  $user_data = checklogin1($wpcon);
  $login = $_SESSION['login'] ;
  $user= get_user_by('login', $login);
  $nom = $user->data->display_name;
  $email = $user->data->user_email;

  $dbstr ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST =127.0.0.1)(PORT = 1521))
            (CONNECT_DATA =
            (SERVER = DEDICATED)
            (SERVICE_NAME = orcl)
            (INSTANCE_NAME = orcl)))";
    $conn = oci_connect('c##hamza','123',$dbstr);
    $stmt = oci_parse($conn, "select TEL from FOURNISSEUR where EMAIL ='$email'");
    $stmt1 = oci_parse($conn, "select CODE from FOURNISSEUR where EMAIL ='$email'");
     oci_execute($stmt);
     oci_execute($stmt1);
    $nrows = oci_fetch_all($stmt, $results);
    $nrows1 = oci_fetch_all($stmt1, $results1);
 
 $var = '
 <head>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

 </head>
 <style>
  .imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}
.modal {
  display: none; 
  position: fixed;
  z-index: 1; 
  left: 0;
  top: 0;
  width: 100%;  
  height: 100%;  
  overflow: auto;
  background-color: rgb(0,0,0);  
  background-color: rgba(0,0,0,0.4); 
  padding-top: 60px;
}

.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; 
  border: 1px solid #888;
  width: 50%; 
}


.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}


.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}


@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
.containermo {
  padding: 40px;
}

::placeholder {
  color: grey;
}



.button {
border-radius: 4px 4px 4px 4px;
  border: none;
  color: #30404b;
  padding: 4px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 18px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}
.button1 {
   background-color: #dfa23f;
  color: white;
  border: 2px solid #dfa23f;
  
}
.button2 {
   background-color: #dc3741;
  color: white;
  border: 2px solid #dc3741;
  
}

#label {
 color: #d93025; font-size: 14px;align-items: flex-start;display:none;margin-top: -6px
}
.title {color: #30404b; }
#label {color: #d93025; font-size: 14px;align-items: flex-start;display:none;margin-top: -6px}
input { box-shadow: 0 0 3px black; margin: 10px }
body {
    background-color: #f9f9fa
}

.col-xl {
    flex: 0 0 100%;
    max-width: 100%;
}

.padding {
    padding: 3rem !important
}

.user-card-full {
    overflow: hidden
}

.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    border: none;
    margin-bottom: 30px
}

.m-r-0 {
    margin-right: 0px
}

.m-l-0 {
    margin-left: 0px
}

.user-card-full .user-profile {
    border-radius: 5px 0 0 5px
}

.bg-c-lite-green {
    background: linear-gradient(to right, #064073, #064073)
}

.user-profile {
    padding: 20px 0
}

.card-block {
    padding: 1.25rem
}

.m-b-25 {
    margin-bottom: 25px
}

.img-radius {
    margin: auto;
    border: 4px solid white;
    width : 100px;
    border-radius: 500px;
    height : 100px;
    display : block;
    background : url(https://www.svgrepo.com/show/70234/man.svg)
}

h6 {
    font-size: 14px
}

.card .card-block p {
    line-height: 25px
}

@media only screen and (min-width: 1400px) {
    p {
        font-size: 14px
    }
}

.card-block {
    padding: 1.25rem
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.m-b-20 {
    margin-bottom: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.card .card-block p {
    line-height: 25px
}

.m-b-10 {
    margin-bottom: 10px
}

.text-muted {
    color: #919aa3 !important
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.f-w-600 {
    font-weight: 600
}

.m-b-20 {
    margin-bottom: 20px
}

.m-t-40 {
    margin-top: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.m-b-10 {
    margin-bottom: 10px
}

.m-t-40 {
    margin-top: 20px
}

.user-card-full .social-link li {
    display: inline-block
}

.user-card-full .social-link li a {
    font-size: 20px;
    margin: 0 10px 0 0;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out
}
</style>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25"> <span class="img-radius" alt="User-Profile-Image"></span> </div>
                               <p><b>'. $nom .'</b></p>
                                <p>fournisseur</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Email</p>
                                        <h6 class="text-muted f-w-400">'.$email.'</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Non d\'utilisateur</p>
                                        <h6 class="text-muted f-w-400">'. $login  .'</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Téléphone</p>
                                        ';

                                         if ($nrows > 0) { 
                                          for ($i = 0; $i < $nrows; $i++) { 
                                            foreach ($results as $data) { 
                                             $var .= '<h6 class="text-muted f-w-400">'.$data[$i].'</h6>' ;
                                            }
                                          }
                                        }

                                   $var .= '         
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Code SNTL</p>';
                                        if ($nrows1 > 0) { 
                                          for ($i = 0; $i < $nrows1; $i++) { 
                                            foreach ($results1 as $data) { 
                                             $var .= '<h6 class="text-muted f-w-400">'.$data[$i].'</h6>' ;
                                            }
                                          }
                                        }
                                          $var .= ' 
                                       
                                    </div>
                                </div>
                                <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600"></h6>
                                <div class="row">
                                    <div class="col-sm-6">
                                       <button  class="button button1" onclick="document.getElementById(\'id01\').style.display=\'block\'"> <i class="fas fa-user-edit"></i> Modifier mot de passe</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button  class="button button2" id ="delete" > <i class="fas fa-trash"></i> Supprimer le compte</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="id01" class="modal">
  
  <div class="modal-content animate">
    <div class="imgcontainer">
    <h1>Modifier</h1>
      <span onclick="document.getElementById(\'id01\').style.display=\'none\'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="containermo">
     <label for="psw"><b>Ancien mot de passe</b></label>
      <input id ="oldpassword" name="oldpassword" type="password" placeholder="Enter votre ancien mot de passe" name="psw" >
      <label class="oldpassword" id="label" >Entrez un mot de passe</label>
      <label for="psw"><b>Nouveau mot de passe</b></label>
      <input id ="newpassword" name="newpassword" type="password" placeholder="Enter votre nouveau mot de passe" name="psw" >
      <label class="newpassword" id="label" >Entrez un mot de passe</label>
      <center>  
      <button class="button button1" id ="update">Modifier</button>
      
    </div>
     

<script>
var modal = document.getElementById(\'id01\');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
   
  ';
  return $var;
}

add_shortcode('dtmon_compte','dtmon_compte_shortcode');