
$(buscar());

function buscar(query)
{
    $.ajax(
        {
            url: 'reporteBusquedaEmpleados.php',
            type: 'POST',
            dataType: 'html',
            data: {query, query},
        })
        .done(function(resp)
        {
            $("#datos").html(resp);
        })
        .fail(function()
        {
            console.log("Error");
        })
}

$(document).on('keyup', '#buscar', function()
{
    var filtro = $(this).val();

    if(filtro != "")
    {
        buscar(filtro);
    }
    else
    {
        buscar();
    }
})