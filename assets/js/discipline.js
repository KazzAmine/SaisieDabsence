$(function(){ 
   
    $("#btnFind").on('click',function () { 
        if($("#txtCef").val()==''){
            $("#stginfo").html('saisi une valide CEF');
        }else{
            $("#cont").removeClass("d-none");
            $("#btnsubmit").removeClass("d-none");
            $.post("../includes/ajax/getComportement.php", {cef:$("#txtCef").val()},
                function (data, textStatus, jqXHR) {
                    $("#stginfo").html(data);
                },
            ).fail(function(){
                console.log("fail");
            });
        }
    });

    $("#btnsubmit").on('click',function () { 
       if($("#txtCef").val()=='' ||$("#motifArea").val()=='' ){
           alert("saisi tous les champs");
            return ;
       }else{
       
           $.post("../includes/ajax/addComportement.php",
           {cef:$("#txtCef").val(),motif:$("#motifArea").val()} ,
               function (data, textStatus, jqXHR) {
                // if (data=='success') {
                    alert('Indiscipline a ete bien ajoute');
                    $("#description_motif").val('');
                    $("#Desicion").val('');
                    $("#cont").addClass("d-none");
                    $("#btnsubmit").addClass("d-none");
                // }
               
               }
           );
       }
        
    });

    
    //get groupe by filiere
    $("#filiereAbs").on('change',function(){ 
        $.post("../includes/ajax/getGroupe.php", {filiere:$("#filiereAbs").val()},
            function (data, textStatus, jqXHR) {  
                $("#group").html(data); 
            }
        ).fail(function(){
            console.log('fail');
        });
    })

    var cefStg='';
    $("#group").on('change',function () {  
        $('#dataTableCon').html('<table class="table my-0" id="dataTable"><thead><tr><td>NOM PRENOM</td> <td>Lundi</td> <td>Mardi</td> <td>Mercredi</td><td>Jeudi</td> <td>Vendredi</td><td>Samedi</td></tr></thead><tbody id="tableBody"></tbody></table>');
        $.post(
            "../includes/ajax/stagiaireTable.php",
            {grp:$("#group").val()},
            function (data, textStatus, jqXHR) { 
                var stagiaireTable=[];
                var lignes=data.split("@");
                lignes.pop();
                for(var ligne in lignes){
                    var arr=lignes[ligne].split("/");
                    stagiaireTable.push(arr);
                }

                for(var i = 0; i < stagiaireTable.length; i++) {

                   
                    var datet=$("#date").val();
                    var d = new Date(datet);
                       
                    const trnode = document.createElement("tr");  
                    
                    document.getElementById("tableBody").appendChild(trnode);
                    const tdnode = document.createElement("td");
                    const textnode = document.createTextNode(stagiaireTable[i][1] +' '+stagiaireTable[i][2]);   
                    tdnode.appendChild(textnode);
                    trnode.appendChild(tdnode);
                    
                   for(var j=0; j<6; j++){
                        const tdnodecheck = document.createElement("td");     
                                         
                        
                        for(var t=0;t<4;t++){
                            
                            const checkAbsence = document.createElement("input");
                            checkAbsence.setAttribute("type", "checkbox");
                            checkAbsence.style.margin = "8px";
                            tdnodecheck.appendChild(checkAbsence);
                            trnode.appendChild(tdnodecheck);
                            if(t==0){
                                checkAbsence.setAttribute("data-time-debut", "08:30:00");
                                checkAbsence.setAttribute("data-time-fin", "10:30:00");
                                checkAbsence.setAttribute("data-cef",stagiaireTable[i][0]);
                            }else if(t==1){
                                checkAbsence.setAttribute("data-time-debut", "10:30:00");
                                checkAbsence.setAttribute("data-time-fin", "12:30:00");
                                checkAbsence.setAttribute("data-cef",stagiaireTable[i][0]);
                            }else if(t==2){
                                checkAbsence.setAttribute("data-time-debut", "14:30:00");
                                checkAbsence.setAttribute("data-time-fin", "16:30:00");
                                checkAbsence.setAttribute("data-cef",stagiaireTable[i][0]);
                            }else if(t==3){
                                checkAbsence.setAttribute("data-time-debut", "16:30:00");
                                checkAbsence.setAttribute("data-time-fin", "18:30:00");
                                checkAbsence.setAttribute("data-cef",stagiaireTable[i][0]);
                            }

                            checkAbsence.setAttribute("data-day",d.toLocaleDateString('en-US'));
                                 if(t==3){
                                    d.setDate(d.getDate() + 1);
                                }   
                          
                        }                
                    }
                    }
                }
        );
        
    });
    $("#btnSaveAbsence").on('click',function(){
        var checkList=document.getElementsByTagName("input");
        var showAlert=true;
        for(var i=0;i<checkList.length;i++){
                if(checkList[i].checked==true){
                    var ch=checkList[i];
                    var date_debut=ch.getAttribute("data-day")+' '+ch.getAttribute("data-time-debut");
                    var date_fin=ch.getAttribute("data-day")+' '+ch.getAttribute("data-time-fin");
                    var cef=ch.getAttribute("data-cef");
                    // console.log(date_debut);
                    $.post("../includes/ajax/setAbsence.php",{cef:cef,date_d:date_debut,date_f:date_fin},
                    function (data,textStatus,jqXHR) 
                    {
                        if (showAlert==true)
                        {
                            alert ("absence est inserer pour ce classe");
                            showAlert = false;
                            
                        }   
                        
                    }
                );          
            }
        
         }
    })

    $("#showCert").on('click', function () {
        $("#certContainer").toggleClass("d-none");
    });

    


})