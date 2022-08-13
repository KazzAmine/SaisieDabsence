$(function(){  
   
    //get all sections 
    // var stagaireClickMenu=$("#stagiaireSection");
    // var DiscSection=$("#DiscSection");
    // var acceuilSection=$("#acceuilSection");
    // var impExp=$("#impExp");
 
    // var pageTitle=$("#pageTitle");
    // // pageTitle.text("Consultation d'absence");
    // // Edit Page title
    // stagaireClickMenu.on('click',function () { 
    //     pageTitle.text("Consultation d'absence");
    // });
    // DiscSection.on('click',function () { 
    //     pageTitle.text("Discipline");
        
    // }); 
    // acceuilSection.on('click',function () { 
    //     pageTitle.text("Acceuil");
    // }); 
    // impExp.on('click',function () { 
    //     pageTitle.text("Importer / Exporter");
    // }); 
    
    //get groupe by filiere
    $("#filiere").on('change',function(){ 
        $.post("../includes/ajax/getGroupe.php", {filiere:$("#filiere").val()},
            function (data, textStatus, jqXHR) {  
                $("#groupe").html(data); 
            }
        ).fail(function(){
            console.log('fail');
        });
    })
    //table Stagaiaire
    var cefStg='';
    $("#groupe").on('change',function () {  
        $('#dataTableCont').html('<table class="table my-0" id="dataTable"><thead><tr><th>CEF</th><th>NOM</th><th>PRENOM</th><th>Total absence(Seance)</th><th>NOTE Assuidite</th> </tr></thead><tbody id="tableBody"></tbody></table>');
        $.post(
            "../includes/ajax/stagiaireTable.php",
            {grp:$("#groupe").val()},
            function (data, textStatus, jqXHR) { 
                var stagiaireTable=[];
                var lignes=data.split("@");
                lignes.pop();
                for(var ligne in lignes){
                    var arr=lignes[ligne].split("/");
                    stagiaireTable.push(arr);
                }

                for(var i = 0; i < stagiaireTable.length; i++) {
                    const trnode = document.createElement("tr");  
                    document.getElementById("tableBody").appendChild(trnode);
                    for(var j = 0; j < stagiaireTable[i].length-1; j++) {
                        const tdnode = document.createElement("td");
                        const textnode = document.createTextNode(stagiaireTable[i][j]);
                        tdnode.appendChild(textnode);
                        trnode.appendChild(tdnode);

                        //button consulter
                        if(j == stagiaireTable[i].length-2){ 
                            const node = document.createElement("button");
                            const textnode = document.createTextNode("Consulter");
                            node.setAttribute('id','showStgInfo');
                            node.setAttribute('value',stagiaireTable[i][0]);
                            node.appendChild(textnode);
                            const tdnode = document.createElement("td");
                            tdnode.appendChild(node);
                            trnode.appendChild(tdnode);

                            node.addEventListener("click",function(){
                                $("#absenceStagiaire").removeClass("d-none");
                                $("#lstStagiaire").addClass("d-none");
                                $("#absenceStagiaire").addClass("showClass");
                                cefStg=node.value;
                                getAbsence(cefStg);
                                getName(cefStg);
                            })
                        }
                        
                    }
                }

        }
        );
        
    });
    $("#goBack").on('click',function () { 
        $("#lstStagiaire").removeClass("d-none");
        $("#absenceStagiaire").addClass("d-none");
        $("#lstStagiaire").addClass("showClass");
        $("#absenceStagiaire").removeClass("showClass");
        
    });
    //selected stagiaire name
     
     function getName(stgcef){
        $.post("../includes/ajax/getStgInfo.php", {cef:stgcef},
        function (data, textStatus, jqXHR) {
            var infostg=[];
            var lignes=data.split("@");
            lignes.pop();
            for(var ligne in lignes){
                var arr=lignes[ligne].split("/");
                infostg.push(arr);
            }
            
            for(var i =0;i<infostg.length;i++){
                $("#stgnom").html(infostg[i][1]);
            }
            // console.log("success");
        }
    ).fail(function(){
        console.log("failed");
    }); 
    }
    //satgaiaire's absence 
    function getAbsence(stgcef){
        $.post("../includes/ajax/getAbsence.php", {cef:stgcef},
        function (data, textStatus, jqXHR) {
            $("#tableAbsence").html(data);
            // console.log("success");
        }
    ).fail(function(){
        console.log("failed");
    }); 
    }

    // search absence 
    $("#btnsearch").on('click',function() {
        if($("#txtDateAbs").val()==''){
            $("#tableAbsence").html('saisi une valide date');
        }else{
            $.post("../includes/ajax/searchAbsence.php", {dateAbsence:$("#txtDateAbs").val(),cef:cefStg},
                function (data, textStatus, jqXHR) {
                    $("#tableAbsence").html(data);
                    console.log("success");
                }
            ).fail(function(){
                console.log("failed");
            });  
    }
    })
   
    

    //sign_up
    $("#btn_sign").on('click',function () { 
        console.log("signup test")
        var mat=$('#mat').val();
        var cin=$('#cin').val();
        var nom=$('#nom').val();
        var prenom=$('#prenom').val();
        var pass=$('#pass').val();
        var confirm=$('#confirm_pass').val();

        if(mat=='' || cin=='' || nom=='' || prenom=='' || pass==''|| confirm=='')
        {
            alert('Il faut saisir tous les champs');
            return;
        }
        if(pass!=confirm)
        {
            alert('Les deux mot de passe ne sont pas identique');
            return;
        }
        $.post("./includes/ajax/sign.php",{mat:mat,cin:cin,nom:nom,prenom:prenom,pass:pass},
            function (data, textStatus, jqXHR) {
                if (data=='success') {
                    location.href='index.php';
                }
            }
        );
        
    });

    $('#saveCert').click(function () { 
        var typeJust=$('#typeJust').val();
        var date_debut=$('#dateD').val();
        var date_fin=$('#dateF').val();
        var cef=cefStg;
        if(typeJust==''|| date_debut=='' || date_fin=='')
        {
            alert('Saisir tous les champs !!');
        }
        else
        {
            $.post("../includes/ajax/justifAbsence.php",{cef:cef,date_d:date_debut,date_f:date_fin,typeJust:typeJust},
            function (data,textStatus,jqXHR) 
            {
                if(data=='succes')
                {
                    alert('certificat a été inserer');
                       }     
                else
                {
                    alert('fail');
                } 
            });
        }
        
        
    });

    $('.annuler').click(function () { 
        var id=$('.annuler').val();
        $.post("../includes/ajax/signComp.php",{id:id},
            function (data,textStatus,jqXHR) 
            {
                /*if(data=='succes')
                {
                    location.href=location;
                }     
                else
                {
                    alert('fail');
                } */
                // alert(id);
                location.href="../SG/index.php";
            });
        
    });





})