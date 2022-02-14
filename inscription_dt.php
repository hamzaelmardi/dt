<?php
function dt_inscription_shortcode() {
 return $var = '
 <html >
 <head>
 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 </head>
 <style>
 .fa{
    margin-left: 5px;
}
 ::placeholder {
  color: grey;
}
 .container {
  border-radius: 5px;
  background-color: #f8f4f4;
  padding: 30px;
}

select {background: #30404b;color:white }
input,span { box-shadow: 0 0 2px grey; margin: 10px }
  input[type=text], select, input[type=tel] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
.button {
border-radius: 4px 4px 4px 4px;
  border: none;
  color: #30404b;
  padding: 10px 24px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 21px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}
.button1 {
   background-color: #dfa23f;
  color: white;
  border: 2px solid #dfa23f;
  
}
.button1:hover {
 background-color: #30404b; 
  color: white; 
  border: 2px solid #30404b;
}
#label {
 color: #d93025; font-size: 12px;align-items: flex-start;margin-left: 10px;display:none;margin-top: -6px
}
#iv{
    margin: 0 auto;
    width:70% 
}
#iv1{
    margin: 0 auto;
    width:85% 
}
</style>
<body>
<center>
<div >
     <h1>Inscription Fournniseur </h1> 
  </div>
 </center>
  <div id="iv" class="container" > 
   <select  id="source" >
   <option value="" selected disabled>select</option>
   <option value="Personnephysique">Personne physique</option>
  <option value="Personnemoral">Personne morale</option>
</select >
 <div id="iv1">
     <div name="Personnephysique" id="Personnephysique" style="display:none">
<div class="row">
<div class="col-6">
        <input type="text" id ="nom" name="nom" placeholder="nom" required>
        <label class="nom" id="label" >Saisissez votre nom </label> 
        <input type="text" id ="prenom" name="prenom" placeholder="prenom" required>
        <label class="prenom" id="label">Saisissez votre prenom </label> 
</div>
<div class="col-6">
        <input type="text" id ="cin" name="cin" placeholder="cin" required>
        <label class="cin" id="label">Saisissez votre cin </label> 
        <input type="text"  id ="code" name="code" placeholder="code fournisseur SNTL" required>
        <label  class="code" id="label">Saisissez votre code fournisseur sntl </label> 
</div>
</div>
<div class="row">
<div class="col-6">
             <input type="text"  id ="email" name="email" placeholder="adresse email"  >
             <label class="email" id="label">Saisissez votre adresse email</label>
             <input type="tel" id ="tel" name="tel" placeholder="telephone" />
             <label class="tel" id="label">Saisissez votre numero de telephone</label>
</div>
<div class="col-6">
        <input type="text"  id ="login" name="login" placeholder="login" required>
        <label  class="login" id="label">Saisissez votre login</label> 
        <input type="text"  id ="password" name="password" placeholder="password" required>
        <label class="password" id="label">Saisissez votre password</label> 
</div>
</div>
<div class="container" >
        <center> <button class="button button1" id ="inscription" > inscription </button> </center>
      </div>
      </div>
     
       <div name="Personnemoral" id="Personnemoral" style="display:none">
        <input type="text"  id ="raison" name="raison" placeholder="Raison sociale" required>
         <label class="raison" id="label" >Saisissez votre raison social </label> 
        <input type="text"  id ="code1" name="code1" placeholder="Code fournisseur SNTL" required>
         <label class="code1" id="label" >Saisissez votre code fournisseur sntl </label> 
        <input type="text"  id ="registre" name="registre" placeholder="Registre de commerce Mail" required>
        <label class="registre" id="label" >Saisissez votre Registre de commerce Mail </label> 
        <input type="text"  id ="emailm" name="emailm" placeholder="Adresse email" required >
        <label class="emailm" id="label">Saisissez votre adresse email</label>
        <input type="tel" id ="tel1" name="tel1" placeholder="Telephone" />
        <label class="tel1" id="label" >Saisissez votre numero de telephone </label>
        <input type="text"  id ="login1" name="login1" placeholder="Login" required>
        <label class="login1" id="label" >Saisissez votre login </label>
        <input type="text"  id ="password1" name="password1" placeholder="Password" required>
        <label class="password1" id="label" >Saisissez votre password </label>
        <center>
        <div class="container" >
         <button class="button button1" id ="inscription1" > inscription </button> 
        <div>
        </center>
      </div>
      </div>
      </body>
      </html>
      
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/formvalidation/0.6.2-dev/js/formValidation.min.js"></script>
    <script>
    $(document).ready(function(){
    var bindClickToToggle = function(element){
        element.click(function(){
            $(this).parents(".dropdown").find("dd ul").toggle();
        });
    };
    $("#source").change(function () {
        if ($("#source option:selected").text() == "Personne physique"){
            $("#Personnemoral").hide();
            $("#Personnephysique").show();
        } else if ($("#source option:selected").text() == "Personne morale"){
            $("#Personnephysique").hide();
            $("#Personnemoral").show();
        } });
});
</script>
  
  ';
}

add_shortcode('dtformshortcode','dt_inscription_shortcode');
