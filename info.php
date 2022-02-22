<?php
    ob_start();
    session_start();

    include('index.php');

    function dtinfo_shortcode() {
        $login = $_SESSION['login'];
        $user= get_user_by('login', $login);
 $wpcon = mysqli_connect("localhost","root","","wordpress");
                $user_data = checklogin1($wpcon);

        if(in_array('fournisseur',$user->roles)){
               
         // connection database oracle
            $dbstr ="(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST =127.0.0.1)(PORT = 1521))
                    (CONNECT_DATA =
                    (SERVER = DEDICATED)
                    (SERVICE_NAME = orcl)
                    (INSTANCE_NAME = orcl)))";
            $conn = oci_connect('c##hamza','123',$dbstr);

            $get_code = oci_parse($conn, "select CODE from FOURNISSEUR where EMAIL = '".$user->user_email."' UNION select CODE from MORALE where EMAIL = '".$user->user_email."'");
            oci_execute($get_code);
            $nrows = oci_fetch_all($get_code, $results);
                if ($nrows > 0) { 
                     for ($i = 0; $i < $nrows; $i++) { 
                         foreach ($results as $data) { 
                        $co =  $data[$i];
                         } 
                        }}


            $stmt = oci_parse($conn, "select DATE_FACTURE,DATE_REGLEMENT,REF_REGLEMENT,MONTANT from information where CODE in '$co'");
            oci_execute($stmt);
            $nrows = oci_fetch_all($stmt, $results);
                if ($nrows > 0) { 

            $table1= '<html>
          <head>
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
            <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
            <link href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
            <link href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css" rel="stylesheet" type="text/css" />
            <style>

            .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #aaa;
            border-radius: 3px;
            padding: 2px;
            background-color: transparent;
            margin-left: 3px;
        }
            table {
          width: 100%;
          border: 1px solid black;
        }
        input {
        border: 1px solid #555;
        }
        #ii{
        background-color : #dfa23f;
    }
        .button {
          border: none;
          color: white;
          padding: 6px 3px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 4px 2px;
          transition-duration: 0.4s;
          cursor: pointer;
        }
        </style>
          <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
          <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
          <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
          <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
          <script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
          <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
          <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
          <script src="//cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js"></script>
          <script src="//cdn.datatables.net/plug-ins/1.11.3/dataRender/datetime.js"></script>
        <script>
        $(document).ready(function() {
            $("#example thead tr").clone(true).appendTo( "#example thead" );
            $("#example thead tr:eq(1) th").each( function (i) {
                var title = $(this).text();

                if(i==0 ) $(this).html( \'<input id="facture" type="text" name="facture" placeholder=" Search "  style="width:100%; "/>\' );
                else if(i==1 ) $(this).html( \'<input id="reglement" type="text" name="reglement" placeholder=" Search " style="width:100%; "/>\' );
                else if(i==3 ) $(this).html( \'<input id="date" type="number" placeholder=" Search "   style="width:100%; "/>\' );
                else $(this).html( \'<input type="text" placeholder=" Search " style="width: 100%; "/>\' );

                $( "input", this ).on( "keyup change", function () {
                    if ( table.column(i).search() !== this.value ) {
                        table
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } );
            } );

            var table = $("#example").DataTable( {
            "paging":         true,
                "pageLength":5,
                "scrollX": true,
                orderCellsTop: true,
                fixedHeader: true,
                "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/fr_fr.json"
            }
            } );

            $("#facture,#reglement").on("change", function () {
                table.draw();
            });
        });
         var Datef, Dater;
         
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var facture = Datef.val();
                var reglement = Dater.val();
                if (
                    ( facture === null) 
                    ( reglement === null) 
                    
                ) {
                    return true;
                }
                return false;
            }
        );
        $(document).ready(function() {
            Datef = new DateTime($("#facture"), {
                format: "DD/MM/YY",
        buttons: {clear: true}
            });
        Dater = new DateTime($("#reglement"), {
                format: "DD/MM/YY",
                buttons: {clear: true}
            });
         
        } );
        </script>

        <body>
 <h1>Espace Fournisseur</h1> </br>
        <table id="example" class="table table-hover table-bordered table-striped" style="width:100%">
            <thead >
            
                <tr id="ii">
                    <th>Date facture</th>
                    <th>Date règlement</th>
                    <th>Réf règlement</th>
                    <th>Montant réglé</th>
                </tr>
                 
            </thead>
            <tbody>';
        for ($i = 0; $i < $nrows; $i++) { 
        $table1 .= '<tr>';
         foreach ($results as $data) { 
        $table1 .= "<td >  $data[$i] </td>";
         } 
         $table1 .= '</tr>';
        }
        $table1 .= '</tbody>
        </table>
        </body>
        '; 

        }
        return $table1;
}
else { 

    echo  "<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
    
     Swal.fire({
              icon: 'warning',
              text: 'vous  n\'etes pas autorisé à accéder à cette page',
              allowOutsideClick : false,
             }).then((result) => {
              if (result.isConfirmed) {
              var redirect = window.location.origin+'/sntl/client' 
              window.location.href = redirect
              }
                }) 
             </script>"; 
             
}
}

add_shortcode('dtinfoshortcode','dtinfo_shortcode');