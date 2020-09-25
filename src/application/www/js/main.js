'use strict';

/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////
$( document ).ready(function() 
{
    var globalPrix =0;
    $('.btnAddPanier').click(function()
    {
        // on commence par récuperer la valeur du clic
        var btn = $(this);
        // a chaque clic on attribut une nouvelle valeur au bouton qui a l'id (idProduit)
        var idProd = $(this).attr("idProduit");
        // on change le nom du produit pour chaque clic
        var name = $("#name_"+idProd).html();
        // on change et on recupere le prix pour chaque bouton situé dans chaque liste de produit
        var prixT = $("#prixT_"+idProd).html();
        // idem on recupere la quantité saisie dans l'input avec l'id du produit qui correspond
        var qttProd = $("#qttProds_"+idProd).val();
        // on multiplie le prix par la quantité saisie (recuperer au paravant)
        // var totalP = prixT*qttProd;
        // calcule du total des achats du panier
        // globalPrix += totalP;
                
        $("#qttProd").attr("idProd", idProd);
        $("#productName").html(name);
        $("#prixTotal").html(globalPrix);
        $("#productQuantity").html(qttProd);
        // $("#productPrice").html(totalP);
        
        // Permet d'ajouter une ligne du choix du client dans la table panier pour chaque commande
        //$('#panier>tbody:last').append("<tr><td>"+name+"</td><td>"+qttProd+"</td><td>"+totalP+" €</td></tr>"); 
        
         
       // monArret.push(globalPrix);
        console.log(globalPrix);
       // console.log(totalP);
    
        // on declare une variable au format Json pour garder les valeurs de la session ouverte 
        var jsonData = 
        {
            "idProd":idProd,
            "name":name,
            "prixT":prixT,
            "qttProd":qttProd
        
        };
        // j'utilise une fonction (data) pour stocker dans order ma variable jsonData
        $.post("order",jsonData, showData);
        // animation scroll
        $("html,body").animate(
            {
                scrollTop: $("#qttProd").offset().top
            }, 500);

    });
    $('#parentButton').on('click','.btnSuppPanier',function()
    {
        var btn = $(this);
        var idSupp = $(this).attr("idSupp");
        console.log(idSupp);

        $.post("order",{"idSupp":idSupp}, showData);
    });

    function showData(data){
        var newData = JSON.parse(data);
        console.log(newData);
        // il faut vider le tableau pour eviter qu'il remette les mm infos a l'interieur une fois le mm produit rajouter
        $('#panier>tbody').html("");
        // boucle for pour parcourir le tableau et afficher son contenu
            var prixFinal = 0;
            for(var i=0; i<newData.length; i++)
            {
                prixFinal += newData[i]['prixT'];
                $('#panier>tbody:last').append("<tr><td>"+newData[i]['name'] + "</td><td>"+newData[i]["qttProd"] + "</td><td>" + newData[i]["prixT"] + " €</td><td><button class='button-cancel btnSuppPanier' idSupp=\'" + newData[i]['idProd'] + "\'><i class='fas fa-trash-alt'></i></button></td></tr>"); 
            }
        // on affiche le prix total des achats effectués
        $('#prixTotal').empty('');
        $('#prixTotal').append(prixFinal);
    }

    $('.btnShowPanier').click(function()
    {
        var btn = $(this);
        var idCommande = $(this).attr("idCommande");
        console.log("lol"+idCommande);

        if($('#detailsProd_'+idCommande).hasClass('hide'))
        {
            $('#detailsProd_'+idCommande).removeClass('hide');
        }else
        {
            $('#detailsProd_'+idCommande).addClass('hide');
        }
        
        

    });

});



/////////////////////////////////////////////////////////////////////////////////////////
// CODE PRINCIPAL                                                                      //
/////////////////////////////////////////////////////////////////////////////////////////

