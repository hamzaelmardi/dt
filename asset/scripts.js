(function($) {
  $(document).ready(function () {
    $('#loginconx,#passwordconx').on("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    document.getElementById('conx').click();
  }
});
    $('#conx').click( function() {
 var login = $('#loginconx').val();
        var pass = $('#passwordconx').val();  
        var er = false;

  function formValidation(arr){
    arr.forEach(function(el) {
        if ($.trim($('#'+el).val()).length == 0) {
          $('.'+el).css('display','block');
          er = true;
        } else {
          $('.'+el).css('display','none');
        }
    });
  }
var fields = ['loginconx','passwordconx']
formValidation(fields)
  if( er == true){
     return false;
    }
        $.ajax({
          url: ajaxurl,
          type: "POST",
          data: {'action': 'load_comments1','login': login,'pass': pass},
          
          success:function(result){
           
            var json = JSON.parse(result);
              if(json.code1==200){

                const role = json.role
                console.log(role)
                if(role.includes("fournisseur")){
              var redirect = window.location.origin+'/sntl/espace-dt'
              window.location.href = redirect
                }
                else if(role.includes("client")){
                  Swal.fire({
              icon: 'error',
              text: 'Nom d\'utilisateur ou Mot de passe incorrect',
             })
                }
            }else{
              Swal.fire({
              icon: 'error',
              text: json.message,
             })
            }
          }
        })});
  });
})(jQuery);

(function($) {
  $(document).ready(function () {
     $('#nom,#code,#login,#password,#email,#prenom,#cin,#tel').on("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    document.getElementById("inscription").click();
  }
});
    $('#inscription').click( function() {
        var nom = $('#nom').val();
        var code = $('#code').val();
        var login = $('#login').val();
        var password = $('#password').val();
        var email = $('#email').val();   
        var prenom = $('#prenom').val();   
        var cin = $('#cin').val();
        var tel = $('#tel').val();
        var er = false;

  function formValidation(arr){
    arr.forEach(function(el) {
        if ($.trim($('#'+el).val()).length == 0) {
          $('.'+el).css('display','block');
          er = true;
        } else {
          $('.'+el).css('display','none');
        }
    });
  }
var fields = ['nom','prenom','cin','code','email','tel','login','password']
formValidation(fields)
  if( er == true){
     return false;
    }
  function validateEmail(emailinc) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( emailinc );
}
var fields = ['email']
formValidation(fields)
  if( !validateEmail($('#email').val())){
   Swal.fire({
              icon: 'warning',
              html: ' Email non valide,<br> format accepté est: exemple@exemple.com',
             })
    return false;

    }
    function validatete(emailinc) {
  var telReg = /^(05|06)(\d{2}){4}$/im;
  return telReg.test( emailinc );
}
var fields = ['tel']
formValidation(fields)
  if( !validatete($('#tel').val())){
   Swal.fire({
              icon: 'warning',
              html: 'Numéro de téléphone invalide.<br> Format acceptée: 0XXXXXXXXX'
             })
    return false;

    }
        $.ajax({
          url: ajaxurl,
          type: "POST",
          data: {'action': 'insert_fourn1','nom': nom,'code': code,'login': login,'password': password,'email': email,'prenom': prenom,'cin': cin,'tel': tel},
          beforeSend: function() {
        $('.loading-form').css('display', 'block');
         jQuery('.inscription-dt').css('pointer-events','none')
        },
          success:function(res){
            $('.loading-form').css('display', 'none');
             jQuery('.inscription-dt').css('pointer-events','auto')
            var json = JSON.parse(res);
              if(json.code1==200){
                Swal.fire({
              imageUrl: 'https://www.freeiconspng.com/uploads/ok-icon-success-19.png',
           imageWidth: 100,
          imageHeight: 100,
              text: json.message,
              allowOutsideClick : false,
             }).then((result) => {
        if (result.isConfirmed) {
          console.log(result.isConfirmed);
              var redirect = window.location.origin+'/sntl/connexion-dt'
             window.location.href = redirect

             }})
            }else{
              Swal.fire({
              icon: 'warning',
              text: json.message,
             })
            }
          }
        })});
  });
})(jQuery);

(function($) {
  $(document).ready(function () {
    $('#raison,#code1,#login1,#password1,#registre,#tel1,#emailm').on("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    document.getElementById("inscription1").click();
  }
});
    $('#inscription1').click( function() {
        var raison = $('#raison').val();
        var code1 = $('#code1').val();
        var login1 = $('#login1').val();
        var password = $('#password1').val();   
        var registre = $('#registre').val();
        var tel1 = $('#tel1').val();
    var emailm = $('#emailm').val();
         var er = false;
         

  function formValidation(arr){
    arr.forEach(function(el) {
        if ($.trim($('#'+el).val()).length == 0) {
          $('.'+el).css('display','block');
          er = true;
        } else {
          $('.'+el).css('display','none');
        }
    });
  }
var fields = ['raison','registre','code1','tel1','login1','password1','emailm']
formValidation(fields)
  if( er == true){
     return false;
    }
    function validateEmail(emailinc) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( emailinc );
}
var fields = ['emailm']
formValidation(fields)
  if( !validateEmail($('#emailm').val())){
   Swal.fire({
              icon: 'warning',
              html: ' Email non valide,<br> format accepté est: exemple@exemple.com',
             })
    return false;

    }
    function validatete(emailinc) {
  var telReg = /^(05|06)(\d{2}){4}$/im;
  return telReg.test( emailinc );
}
var fields = ['tel1']
formValidation(fields)
  if( !validatete($('#tel1').val())){
   Swal.fire({
              icon: 'warning',
              html: 'Numéro de téléphone invalide.<br> Format acceptée: 0XXXXXXXXX',
             })
    return false;

    }

        $.ajax({
          url: ajaxurl,
          type: "POST",
          data: {'action': 'insert_morale1','raison': raison,'code1': code1,'login1': login1,'password': password,'registre': registre,'tel1': tel1,'emailm': emailm},
          beforeSend: function() {
        $('.loading-form').css('display', 'block');
        jQuery('.inscription-dt').css('pointer-events','none')
        },
          success:function(result){
             $('.loading-form').css('display', 'none');
             jQuery('.inscription-dt').css('pointer-events','auto')

            var json = JSON.parse(result);
              if(json.code1==200){
                Swal.fire({
              imageUrl: 'https://www.freeiconspng.com/uploads/ok-icon-success-19.png',
           imageWidth: 100,
          imageHeight: 100,
              text: json.message,
             })
                var redirect = window.location.origin+'/sntl/connexion-dt'
             window.location.href = redirect
            }else{
            Swal.fire({
              icon: 'warning',
              text: json.message,
             
             })
            }
          }
        })});
  });
})(jQuery);



(function($) {
  $(document).ready(function () {
    $('#delete').click( function() {
     Swal.fire({
        icon: 'warning',
        text: 'Voulez-vous vraiment supprimer votre compte ?',
        showDenyButton: true,
        confirmButtonText: 'Oui',
        denyButtonText: `Non, Annuler`,
      }).then((result) => {
        if (result.isConfirmed) {
         
        $.ajax({
          url: ajaxurl,
          type: "POST",
          data: {'action': 'delete_account1'},
          success:function(result){
            var json = JSON.parse(result);
              
              if(json.code1==200){
            Swal.fire({
              imageUrl: 'https://www.freeiconspng.com/uploads/ok-icon-success-19.png',
           imageWidth: 100,
          imageHeight: 100,
              text: 'Votre compte a été supprimé',
             
             })
            var redirect = window.location.origin+'/sntl/connexion-dt'
            window.location.href = redirect
               
                }
                else{
              Swal.fire({
              icon: 'error',
              text: 'not deleted',
             
             })
            }
            }
          
        })
      }})
      });
  });
})(jQuery);

(function($) {
  $(document).ready(function () {
      $('#newpassword,#oldpassword').on("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    document.getElementById("update").click();
  }
});
    $('#update').click( function() {
        var newpassword = $('#newpassword').val();
        var oldpassword = $('#oldpassword').val();
        var er = false;

  function formValidation(arr){
    arr.forEach(function(el) {
        if ($.trim($('#'+el).val()).length == 0) {
          $('.'+el).css('display','block');
          er = true;
        } else {
          $('.'+el).css('display','none');
        }
    });
  }
var fields = ['newpassword','oldpassword']
formValidation(fields)

  if( er == true){
     return false;
    }
       
  
        $.ajax({
          url: ajaxurl,
          type: "POST",
          data: {'action': 'update_user1','oldpassword': oldpassword,'newpassword': newpassword},
          success:function(res){
            var json = JSON.parse(res);
              if(json.code1==200){
                Swal.fire({
              imageUrl: 'https://www.freeiconspng.com/uploads/ok-icon-success-19.png',
           imageWidth: 100,
          imageHeight: 100,
              text: json.message,
        
             })
            }else{
              Swal.fire({
              icon: 'error',
              text: json.message,
             
             })
            }
          }
        })});
  });
})(jQuery);
