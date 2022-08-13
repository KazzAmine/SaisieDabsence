$(document).ready(function(){

    // NAVIGATION LINKS
    $("#sg-menu").click(function(){
        $("#container-sg").removeClass('d-none');
        $("#container-stgr").addClass('d-none');
        $("#acceuil").addClass('d-none');
    }); 

    $("#stgr-menu").click(function(){
        $("#container-stgr").removeClass('d-none');
        $("#container-sg").addClass('d-none');
        $("#acceuil").addClass('d-none');
        
    }); 
    
    $("#acceuil-menu").click(function(){
        $("#acceuil").removeClass('d-none');
        $("#container-sg").addClass('d-none');
        $("#container-stgr").addClass('d-none');
    }); 

    //AFFICHER LES FILLIERES
    $("#filliere").change(function(){
        $.post("../includes/ajax/select_stgr.php",{filliere:$("#filliere").val()},
        function (data) {  
            $("#group").html(data);
        }
    ).fail(function () {console.log("fail")  });
    });
 //AFFICHER LES GROUPES
    $("#group").change(function(){
        $.post("../includes/ajax/select_grp.php",{group:$("#group").val()},
        function (data) { 
            $("#dataTable").html(data);
        }
    ).fail(function () {console.log("fail")   });
    });

  
   

    // AFFICHER LES INFOS SG
    $("#select-sg").change(function(){
        var x = $("#select-sg").val();
        $.post("../includes/ajax/select-sg.php",{sg:x},
        function (data) { 
            $("#mat2").prop( "disabled", true );
            var objJSON = JSON.parse(data);
            $("#mat2").val(objJSON.mat);
            $("#cin2").val(objJSON.cin);
            $("#nom2").val(objJSON.nom);
            $("#prenom2").val(objJSON.prenom);
            $("#password2").val(objJSON.password);
        })
    });
    //update SG
    // $("#update-sg").click(function(){
    //     var x = $("#select-sg").val();
    //     $.post("../includes/ajax/update-sg.php",{sg:x,cin:$("#cin2").val(),nom:$("#nom2").val(),prenom:$("#prenom2").val()},
    //     function (data) { 
    //         if (data=='succes') {
    //             alert('mofifier');

    //             $("#mat2").val('');
    //             $("#cin2").val('');
    //             $("#nom2").val('');
    //             $("#prenom2").val('');

    //         }
    //     })
    // });
    //delete sg
    $("#supp-sg").click(function(){
        var x = $("#select-sg").val();
        $.post("../includes/ajax/delete-sg.php",{sg:x},
        function (data) { 
            if (data=='succes') {
                alert('deleted');
                $("#mat2").val('');
                $("#cin2").val('');
                $("#nom2").val('');
                $("#prenom2").val('');
                $("#password2").val('');

            }
        })
    });

    //cherche-stagaire
    $("#cherche-stg").click(function(){
        var x = $("#cef").val();
        $.post("../includes/ajax/cheche-stgr.php",{cef:x},
        function (data) {
            if(x==''){
                alert('Saisir un CEF');
                $("#ifn").addClass("d-none");
                return;
            } 
            if(data=='0') {
                alert('CEF introuvable');
                return;
            }
            else{
                $("#add_motif").removeClass("d-none")
                $("#motifinfo").html(data);
                $("#motifinfo").removeClass("d-none");

                
            } 
        })      
    });
    //ajoute-compotement
    $("#add-compot").click(function(){
        var cef = $("#cef").val();
        var desc_motif=$("#description_motif").val();
        var Desicion=$("#Desicion").val();

        if (cef=='' || desc_motif==''|| desc_motif=='') {
            alert('Saisir tous les Champs');    
        }
        else{
            $.post("../includes/ajax/ajouter_comp.php",{cef:cef,desc_motif:desc_motif,Desicion:Desicion},
            function (data) {
                if (data=='succes') 
                {
                    alert('comportement ajouter');
                    $("#description_motif").val('');
                    $("#Desicion").val('');
                    $("#add_motif").addClass("d-none");
                    $("#motifinfo").addClass("d-none");
                }
            })
        }      
    });
    //login
    $("#btn_login").click(function(){
        var mat = $("#mat").val();
        var pass=$("#pass").val();
        if (pass==''|| mat=='') {
            alert('Saisir tous les Champs');    
        }
        else{
            $.post("includes/ajax/login_ajax.php",{mat:mat,pass:pass},
            function (data) {
                if (data=='D') 
                {
                   location.replace('Directeur/index.php');
                }
                else if (data=='SG') {
                    location.replace('SG/index.php');
                }
                else{
                    alert("Login fail");
                }
                
            })
        }      
    });

        // activer compte
        $('.accept').click(function(){ 
            $.post("../includes/ajax/activer_compte.php",{mat:$(this).val()},
                function (data, textStatus, jqXHR) {
                    if (data=='succes') {
                        alert('Compte activer');
                        location.replace('../Directeur/surveillance.php');
                    }
                    if (data=='fail') {
                        alert('Ressayez');
                    }
                }
            ); 
        });

        //refuser un demmande
        $('.refuse').click(function(){ 
            $.post("../includes/ajax/delete-sg.php",{sg:$(this).val()},
                function (data, textStatus, jqXHR) {
                    if (data=='succes') {
                        alert('Compte refuser');
                        location.replace('../Directeur/surveillance.php');
                    }
                    if (data=='fail') {
                        alert('Ressayez');
                    }
                }
            ); 
        });

         // supprimer stagiaire
         $('.delete').click(function(){ 
            $.post("../includes/ajax/supprimerStg.php",{cef:$(this).val()},
                function (data, textStatus, jqXHR) {
                    // if (data=='succes') {
                    //     alert('Stagiaire est supprimer');
                    //     location.replace('../Directeur/index.php');
                    // }
                    alert('Stagiaire est supprimer');
                     location.replace('../Directeur/index.php');
                    console.log(data);
                    
                }
            ); 
        });








});

