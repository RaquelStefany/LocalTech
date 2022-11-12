/* $("#btn-dados").click(function() {
    $("#div-dados").css("display","grid");
    $("dados").css("display","unset");
});
 */
$(document).mouseup(function(e)
{
    var container = $("#dados");
    if (!container.is(e.target) && container.has(e.target).length === 0){
        container.hide();
        window.location.href = "Clientes.php";
    }
});