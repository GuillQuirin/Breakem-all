$(document).ready(function(){
    $(".formteam1").submit(function(){

    if($.trim($(".nameteam").val()) == "" || $.trim($(".nameteam").val()).length < 2 || $.trim($(".nameteam").val()).length >10 ) {
        alert("Veuillez entrer un nom de team compris entre 2 et 20 caractères.");
        return false;
    }

    if($.trim($(".desc-default").val()) == "" || $.trim($(".desc-default").val()).length < 3 || $.trim($(".desc-default").val()).length >200 ) {
        alert("Veuillez entrer une description comprise entre 3 et 200 caractères.");
         return false;
    }

});

});
