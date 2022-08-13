$(function(){ 

     //get groupe by filiere
     $("#filiereCert").on('change',function(){ 
        $.post("../includes/ajax/getGroupe.php", {filiere:$("#filiereCert").val()},
            function (data, textStatus, jqXHR) {  
                $("#groupeCert").html(data); 
            }
        ).fail(function(){
            console.log('fail');
        });
    })
    //table Stagaiaire
    var cefStg='';
    $("#groupeCert").on('change',function () {  
        $('#tableCont').html('<table class="table my-0" id="dataTable"><thead><tr><th>CEF</th><th>NOM</th><th>PRENOM</th> <th>Note de Discipline</th> </tr></thead><tbody id="tableBody"></tbody></table>');
        $.post(
            "../includes/ajax/stagiaireTable.php",
            {grp:$("#groupeCert").val()},
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
                    
                    for(var j = 0; j < stagiaireTable[i].length; j++) {
                        
                            
                            
                        if(j != stagiaireTable[i].length-3){ 
                        const tdnode = document.createElement("td");
                        const textnode = document.createTextNode(stagiaireTable[i][j]);
                        tdnode.appendChild(textnode);
                        trnode.appendChild(tdnode);
                        }
                       else{ 
                        const tdnode2 = document.createElement("td");
                            const textnode2 = document.createTextNode(parseFloat(stagiaireTable[i][4])+parseFloat(stagiaireTable[i][5]));
                            tdnode2.appendChild(textnode2);
                            trnode.appendChild(tdnode2);
                            //button consulter
                            const node = document.createElement("button");
                            const textnode = document.createTextNode("Details");
                            node.setAttribute('id','btnattScolaire');
                            node.setAttribute('value',stagiaireTable[i][0]);
                            node.appendChild(textnode);
                            const tdnode = document.createElement("td");
                            tdnode.appendChild(node);
                            trnode.appendChild(tdnode);
                            node.addEventListener("click",function(){
                                $("#infoStagiaire").removeClass("d-none");
                                $("#lstStagiaire").addClass("d-none");
                                $("#infoStagiaire").addClass("showClass");
                                cefStg=node.value;
                                getName(cefStg);
                            })
                            break;
                        }
                        
                        
                    }
                }

        }
        );
        
    });
   
    
    $("#goBack").on('click',function () { 
        $("#lstStagiaire").removeClass("d-none");
        $("#infoStagiaire").addClass("d-none");
        $("#lstStagiaire").addClass("showClass");
        $("#infoStagiaire").removeClass("showClass");
        
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
                $("#infoCont").html("<span> <b> CEF </b>:&nbsp;&nbsp;&nbsp;&nbsp;"+infostg[i][0]+"</span> <br>"+
                "<span> <b> filiere</b> :&nbsp;&nbsp;&nbsp;&nbsp;"+infostg[i][2]+"</span><br>"+
                "<span> <b> groupe</b> :&nbsp;&nbsp;&nbsp;&nbsp;"+infostg[i][3]+"</span><br>"+
                "<span> <b> annee d\'etude</b> :&nbsp;&nbsp;&nbsp;&nbsp;"+infostg[i][4]+"</span><br>"+
                "<span> <b> niveau</b> :&nbsp;&nbsp;&nbsp;&nbsp;"+infostg[i][5]+"</span><br>");
            }
            
            
        }
    ).fail(function(){
        console.log("failed");
    }); 
    }


    //download files 
    //attestation Scolaire
    $("#btnattScolaire").on('click',function () { 
        console.log(cefStg);
        $.post("../includes/ajax/attestationSco.php",
            function (data, textStatus, jqXHR) {
                // window.location = '../includes/ajax/attestationSco.php?cef='+cefStg ;
                window.open('../includes/ajax/attestationSco.php?cef='+cefStg,'_blank');
            }
        ).fail(function(){
            console.log("fail");
        });
        
    });
    //Pv note
    // $("#btnPV").on('click',function () { 
    //     var grp=$('#groupe').val();
    //     $.post("../includes/ajax/PV_Note.php",
    //         function (data, textStatus, jqXHR) {
    //             // console.log(data);
    //              window.open('../includes/ajax/PV_Note.php?grp='+grp,'_blank');
    //             //$("#ress").html(data);
                
    //         }
    //     );
        
    // });
})