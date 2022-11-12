$(document).mouseup(function(e)
{
    var container = $("#dados");
    if (!container.is(e.target) && container.has(e.target).length === 0){
        container.hide();
        window.location.href = "Atendimentos.php";
    }
});