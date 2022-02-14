<?php 
 ob_start();
    session_start();
function subscriber_connexiondt(){

	 $login = $_SESSION['login'] ;
  $user= get_user_by('login', $login);
  $nom = $user->data->display_name;
		
	$domain = get_site_url();
	$account = $domain . '/compte';
	$logout = $domain . '/sntl/wp-content/plugins/dt/logout';


	
	$dropdown = '
	<div class="th-dropdown">
			<div >
				<a id= "dr" href="'. $account . '">'. esc_html__( 'My account', 'woocommerce' ) .'</a>
			</div>
			<div>
				<a id= "dr" href="'. $logout . '">'. esc_html__( 'Logout', 'woocommerce' ) .'</a>
			</div>
		</div>';
	
	if (!$_SESSION['login']) {
		$content = '
		<div class="header-module module-button" style="margin-left: 25px;"><a href=" /sntl/connexion-dt" target="_blank" >Se connecter</a></div>';
	} 
	
	else {
		$current_user = $_SESSION['login'] ;
		$username = $nom ;
		
		$content = '
		<style>
.top-header-menu:hover > .th-dropdown{
	display :block !important;
	margin-left: -5px;
}
.th-dropdown {
	display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 158px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  border-radius: 5px;
}
.th-dropdown div a:hover{background-color: #e3e1e1}
#dr{
  color : #30404b !important ;
  padding: 9px 26px;
  text-decoration: none;
  display: block;
border-radius: 5px;
}
	</style>
	<div class="top-header-menu" style="margin-left: 25px;">
	<i class="fas fa-user-tie" style="color:#dfa23f"></i> 
	<a target="_blank" style="color: white;">' . $username . $dropdown .'</a>
	</div>';

		} 

	return $content;
	
}
add_shortcode('profil', 'subscriber_connexiondt');