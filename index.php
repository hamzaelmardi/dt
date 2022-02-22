<?php
/*
Plugin Name: Plugin_oracle_dt
Description: test dt
*/
/**
 *  
 */
 require_once(ABSPATH. WPINC .'/class-phpass.php');
function WordPress_resources1() {
    
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_script('main_js', plugin_dir_url( __FILE__ ) . '/asset/main.js', NULL, 1.0, true);

    wp_localize_script('main_js', 'magicalData', array(
        'nonce' => wp_create_nonce('wp_rest'),
        'siteURL' => get_site_url()
    ));
    
    
   include(__DIR__ . '/info.php');
    include(__DIR__ . '/inscription_dt.php');
    include(__DIR__ . '/connexion_dt.php');
    include(__DIR__ . '/profil.php');
    include(__DIR__ . '/mon_compte.php');
   
}


add_action('wp_enqueue_scripts', 'WordPress_resources1');



// alert fonction 
function capitaine_assets1() {
 wp_enqueue_script( 'capitaine', plugin_dir_url( __FILE__ )  . '/asset/scripts.js', array( 'jquery' ), '1.0', true );
 wp_enqueue_script( 'dd', "https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js", array( 'jquery' ), '1.0', true );
 wp_localize_script( 'capitaine', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}
add_action( 'wp_enqueue_scripts', 'capitaine_assets1' );

//---------- alert connexion fournisseur dt --------------

add_action( 'wp_ajax_load_comments1', 'capitaine_load_comments1' );
add_action( 'wp_ajax_nopriv_load_comments1', 'capitaine_load_comments1' );

function capitaine_load_comments1() {
    
$login = $_POST['login'];
$password = $_POST['pass'];

$vqr= array(
    'pass' =>  $password,
    'login' =>  $login,
  );

  $wp_hasher = new PasswordHash(8,true);

  $user= get_user_by('login', $login);

  if($wp_hasher->CheckPassword($password,$user->user_pass)){

    ob_start();
    session_start();
    $_SESSION['login'] = $login;
    $_SESSION['password'] = $password;
    
    echo json_encode(array('code1'=>200,'message'=>'success', 'role'=>$user->roles));
 
} else {

echo json_encode(array('code1'=>404,'message'=>'Nom d\'utilisateur ou Mot de passe incorrect'));

}
    wp_die();

}  
// -------- alert inscription personne phyique ------------

add_action( 'wp_ajax_insert_fourn1', 'capitaine_insert_fourn1' );
add_action( 'wp_ajax_nopriv_insert_fourn1', 'capitaine_insert_fourn1' );

function capitaine_insert_fourn1() {
    global $wpdb;
    $nom = $_POST['nom'];
    $code = $_POST['code'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $prenom = $_POST['prenom'];
    $cin = $_POST['cin'];
    $tel = $_POST['tel'];
$vqr= array(
    'nom' =>  $nom,
    'prenom' =>  $prenom,
    'cin' =>  $cin,
    'code' =>  $code,
    'password' =>  $hash,
    'login' =>  $login,
    'email' =>  $email,
    'tel' =>  $tel,
  );

if(isset ($_POST['nom'] , $_POST['code'], $_POST['prenom'], $_POST['cin'], $_POST['email'], $_POST['tel'])){
 $user = get_user_by('login', $login);
 $user_m = get_user_by('email', $email);

 $conn = oci_connect('c##hamza','123','localhost/orcl');
    $requete1="select nom,code,prenom,cin,email,tel from FOURNISSEUR where code ='$code'";
    $stmt = oci_parse($conn, $requete1);
     oci_execute($stmt);
     oci_fetch_all($stmt,$extract);
if(in_array($nom,$extract['NOM'])  and in_array($prenom,$extract['PRENOM']) and 
   in_array($cin,$extract['CIN']) and  in_array($email,$extract['EMAIL']) and  in_array($tel,$extract['TEL'])
    && !$user_m &&  !$user){ 
     echo json_encode(array('code1'=>200 ,'message'=>'Informations correctes, votre compte est actif.')); 
       $userdata = array(
        'user_login' => $login,
        'first_name' => $prenom,
        'last_name' => $nom,
        'user_pass' => $password,
        'user_email' =>  $email,
        'role' => 'fournisseur' 
        );

$user_id = wp_insert_user( $userdata ) ;
$to = $email;
  $subject  = "SNTL- Inscription réussie";
  $body = $body = '<head>
  <style type="text/css">
    @media (min-width: 650px) {
      .content{
        margin: 0 15%;
        padding:0 20px;
        width: 70%;
      }
    }

    @media (max-width: 650px) {
      .content{
        margin: 0;
        width: 100%;
        padding:0
      }
    }

  </style>
</head>
   
   <body style="margin: 0 !important; padding: 0 !important;background-color: white">


       <div class="content" align="center" style="font-family: \'Lato\',Helvetica, Arial, sans-serif; line-height: 30px; font-size: 17px; background-color: #fff;">

            <img src="https://www.leconomiste.com/sites/default/files/eco7/public/snlt-037.jpg" width="200px">
 </div>
 <br>
          <p>Bonjour Mme/M <b>'.$nom.'</b>,<p>
Nous vous informons que votre compte fournisseur a été activé.
Ci-dessous vos informations de connexion:<br>

  - Nom d\'utilisateur: <b>'.$login.'</b><br>
  - Mot de passe: <b>'.$password.'</b><br>
 

Cordialement,</p>
    </div>

  </body>';
  $headers = 'Content-type: text/html; charset=utf-8';
  mail($to, $subject , $body, $headers);

}
else if($user){
echo json_encode(array('code1'=>405 ,'message'=>'Ce nom d\'utilisateur existe déjà'));
}
else if(!in_array($code,$extract['CODE'])){
echo json_encode(array('code1'=>406 ,'message'=>' Ce code fournniseur n’existe pas, veuillez vérifier votre code fournniseur ou contacter la SNTL'));
}
else {
echo json_encode(array('code1'=>404 ,'message'=>'Vos informations ne correspondent pas aux informations saisies sur le système de gestion, veuillez contacter la SNTL'));
}}
    wp_die();
}

//-------- alert inscription personne morale  -----------------

add_action( 'wp_ajax_insert_morale1', 'capitaine_insert_morale1' );
add_action( 'wp_ajax_nopriv_insert_morale1', 'capitaine_insert_morale1' );

function capitaine_insert_morale1() {
    global $wpdb;
    $raison = $_POST['raison'];
    $code1 = $_POST['code1'];
    $login1 = $_POST['login1'];
    $password = $_POST['password'];
    $registre = $_POST['registre'];
    $tel1 = $_POST['tel1'];
    $emailm = $_POST['emailm'];
$vqr= array(
    'raison' =>  $raison,
    'tel1' =>  $tel1,
    'code1' =>  $code1,
    'password' =>  $password,
    'login1' =>  $login1,
    'registre' =>  $registre,
    'emailm' =>  $emailm,
  );

if(isset ($_POST['raison'] , $_POST['code1'], $_POST['registre'], $_POST['tel1'], $_POST['emailm'])){

  $user= get_user_by('login', $login1);
$user_m = get_user_by('email', $emailm);

 $conn = oci_connect('c##hamza','123','localhost/orcl');
    $requete1="select raison,code,registre,tel,email from FOURNISSEUR where code ='$code1'";
    $stmt = oci_parse($conn, $requete1);
     oci_execute($stmt);
     oci_fetch_all($stmt,$extract) ;
if(in_array($raison,$extract['RAISON']) and in_array($registre,$extract['REGISTRE'])   
    and in_array($tel1,$extract['TEL']) and in_array($emailm,$extract['EMAIL']) && !$user_m &&  !$user){
    
     echo json_encode(array('code1'=>200 ,'message'=>'Informations correctes, votre compte est actif.')); 
       $userdata = array(
        'user_login' => $login1,
        'first_name' => $raison,
        'user_pass' => $password,
    'user_email' =>  $emailm,
        'role' => 'fournisseur' 
        );

$user_id = wp_insert_user( $userdata ) ;
$to = $emailm;
  $subject  = "SNTL- Inscription réussie";
  $body = $body = '<head>
  <style type="text/css">
    @media (min-width: 650px) {
      .content{
        margin: 0 15%;
        padding:0 20px;
        width: 70%;
      }
    }

    @media (max-width: 650px) {
      .content{
        margin: 0;
        width: 100%;
        padding:0
      }
    }

  </style>
</head>
   
   <body style="margin: 0 !important; padding: 0 !important;background-color: white">


       <div class="content" align="center" style="font-family: \'Lato\',Helvetica, Arial, sans-serif; line-height: 30px; font-size: 17px; background-color: #fff;">

            <img src="https://www.leconomiste.com/sites/default/files/eco7/public/snlt-037.jpg" width="200px">
 </div>
 <br>
           <p>Bonjour <b>'.$raison.'</b>,<p>
Nous vous informons que votre compte fournisseur a été activé.
Ci-dessous vos informations de connexion:<br>

  - Nom d\'utilisateur: <b>'.$login1.'</b><br>
  - Mot de passe: <b>'.$password.'</b><br>
 

Cordialement,</p>
    </div>

  </body>';
  $headers = 'Content-type: text/html; charset=utf-8';
  mail($to, $subject , $body, $headers);
}
else if(!in_array($code1,$extract['CODE'])){
echo json_encode(array('code1'=>406 ,'message'=>' Ce code fournniseur n’existe pas, veuillez vérifier votre code fournniseur ou contacter la SNTL'));
}
else if($user){
echo json_encode(array('code1'=>405 ,'message'=>'Ce nom d\'utilisateur existe déjà'));
}
else {
echo json_encode(array('code1'=>404 ,'message'=>'Vos informations ne correspondent pas aux informations saisies sur le système de gestion, veuillez contacter la SNTL'));
}}
    wp_die();
}





//------------- check if user is loged in before accessing to  page  ----------
function checklogin1($wpcon){
    ob_start();
    session_start();
    if(!isset($_SESSION['login'])){
            header('location: /sntl/connexion-dt'); 
    }

}


//----------- delete account-----------------

    add_action( 'wp_ajax_delete_account1', 'capitaine_delete_account1' );
    add_action( 'wp_ajax_nopriv_delete_account1', 'capitaine_delete_account1' );

    function capitaine_delete_account1() {
       global $wpdb;
       ob_start();
    session_start();
      $login = $_SESSION['login'] ;

      $user= get_user_by('login', $login);
      
    $id = $user->data->ID;
    if(wp_delete_user( $id )){
        echo json_encode(array('code1'=>200)); 

    unset($_SESSION['login']);
    unset($_SESSION['password']);
      wp_die();
    }
    else {
    echo json_encode(array('code1'=>404));
     wp_die();
    }
    }

// -------- alert update user ------------

add_action( 'wp_ajax_update_user1', 'capitaine_update_user1' );
add_action( 'wp_ajax_nopriv_update_user1', 'capitaine_update_user1' );

function capitaine_update_user1() {
    global $wpdb;
     ob_start();
    session_start();
      $login = $_SESSION['login'] ;
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
    $vqr= array(
    'oldpassword' =>  $oldpassword,
    'newpassword' =>  $newpassword,
    
  );
 $wp_hasher = new PasswordHash(8,true);
 $user = get_user_by('login', $login);
 $pass = $user->data->user_pass;
if($wp_hasher->CheckPassword($oldpassword,$pass)){ 
     echo json_encode(array('code1'=>200 ,'message'=>'Mot de passe a été modifier'));  

    $id = $user->data->ID; 
   wp_update_user( array(
    'ID' => $id,
    'user_pass' => $_POST[ 'newpassword' ]
));

      
}
else {
echo json_encode(array('code1'=>404 ,'message'=> 'Ancien mot de passe incorrect'));
}
    wp_die();
}


?>