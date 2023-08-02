
function init(){
    $("#serija").prop("checked", false);
    $("#film").prop("checked", false);
}



$(document).ready(function(){
    $("#serija").change(function(){
        if(this.checked){
            //alert("Checked");
            
            if($("#BrSezonaId").length){
                console.log("Vec postoji...Unos za broj sezona serije...");
                return;
            }else{
                if($("#TrajanjeId").length){
                    jQuery('#TrajanjeId').remove();
                }
                console.log("Dodajem unos za  br sezone");
                let $komponenta = "<div id = \"BrSezonaId\"><hr class=\"mx-n3\">" +
                "<div class=\"row align-items-center pt-4 pb-3\">"+
                "<div class=\"col-md-3 ps-5\">"+
                    "<h6 class=\"mb-0\">Broj sezona: </h6>"+
                "</div>"+
                "<div class=\"col-md-9 pe-5\">"+
                    "<input id = \"BrSId\" type=\"number\" name = \"BrSezona\" class=\"form-control form-control-lg\" required>"+"</div>"
                "</div>";
                input = jQuery($komponenta);
                jQuery('#katTable').after(input);
            }
        
        }else{
            //alert("vec postoji");
        }
    });

    $("#film").change(function(){
        if(this.checked){

            if($("#TrajanjeId").length){
                console.log("Vec postoji...Unos za Trajanje filma..");
                return;
            }else{
                if($("#BrSezonaId").length){
                    jQuery('#BrSezonaId').remove();
                }
                console.log("Dodajem unos za trajanje");
                let $komponenta = "<div id = \"TrajanjeId\"><hr class=\"mx-n3\">" +
                "<div class=\"row align-items-center pt-4 pb-3\">"+
                "<div class=\"col-md-3 ps-5\">"+
                    "<h6 class=\"mb-0\">Trajanje: </h6>"+
                "</div>"+
                "<div class=\"col-md-9 pe-5\">"+
                    "<input id = \"TId\" type=\"number\" name = \"Trajanje\" class=\"form-control form-control-lg\" required>"+"</div>"
                "</div> </div>";
                input = jQuery($komponenta);
                jQuery('#katTable').after(input);
            }
        
        }else{
            //alert("vec postoji");
        }
    });
        
})