$(document).ready(function(){
    
    $('.eliminarEvento').click(function(){
        let idEvento = $(this).data('id');
        if(confirm('Esta seguro de eliminar este evento?') &&
           confirm('Tenga en cuenta que se eliminarán todos los stands, seguro?')) {
            $.post('/jx_event_delete', {id: idEvento}, function(){window.top.location.reload();});
        }
    });

    $('.eliminarStands').click(function(){
        let idStand = $(this).data('id');
        if(confirm('Esta seguro de eliminar este stand?')) {
            $.post('/jx_event_delete_stand', {id: idStand}, function(){window.top.location.reload();});
        }
    });

    $('.eliminarCodigo').click(function(){
        let idCodigo = $(this).data('id');
        if(confirm('Esta seguro de eliminar este codigo?')) {
            $.post('/jx_event_delete_code', {id: idCodigo}, function(){window.top.location.reload();});
        }
    });

});