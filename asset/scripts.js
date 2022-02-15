(function($) {
  $(document).ready(function () {
    $('#conx').click( function() {
 var login = $('#login').val();
        var pass = $('#password').val();  
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
var fields = ['login','password']
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
                    var redirect = window.location.origin+'/sntl/client' 
              window.location.href = redirect
                }
            }else{
              Swal.fire({
              icon: 'warning',
              text: json.message,
              timer: 3000
             })
            }
          }
        })});
  });
})(jQuery);

(function($) {
  $(document).ready(function () {
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
        $.ajax({
          url: ajaxurl,
          type: "POST",
          data: {'action': 'insert_fourn1','nom': nom,'code': code,'login': login,'password': password,'email': email,'prenom': prenom,'cin': cin,'tel': tel},
          success:function(res){
            var json = JSON.parse(res);
              if(json.code1==200){
                Swal.fire({
              icon: 'success',
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
              icon: 'error',
              text: json.message,
              timer: 3000
             })
            }
          }
        })});
  });
})(jQuery);

(function($) {
  $(document).ready(function () {
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
        $.ajax({
          url: ajaxurl,
          type: "POST",
          data: {'action': 'insert_morale1','raison': raison,'code1': code1,'login1': login1,'password': password,'registre': registre,'tel1': tel1,'emailm': emailm},
          success:function(result){
            var json = JSON.parse(result);
              if(json.code1==200){
                Swal.fire({
              icon: 'success',
              text: json.message,
              timer: 5000
             })
                var redirect = window.location.origin+'/sntl/connexion-dt'
             window.location.href = redirect
            }else{
            Swal.fire({
              icon: 'error',
              text: json.message,
              timer: 5000
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
              icon: 'success',
              text: 'compte supprimée',
              timer: 3000
             })
            var redirect = window.location.origin+'/sntl/connexion-dt'
            window.location.href = redirect
               
                }
                else{
              Swal.fire({
              icon: 'error',
              text: 'not deleted',
              timer: 3000
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
              icon: 'success',
              text: json.message,
        
             })
            }else{
              Swal.fire({
              icon: 'error',
              text: json.message,
              timer: 3000
             })
            }
          }
        })});
  });
})(jQuery);
