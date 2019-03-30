$(document).ready(function(){
    
    $('.eliminarEvento').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        let idEvento = $(this).data('id');
        if(confirm('Esta seguro de eliminar este evento?') &&
           confirm('Tenga en cuenta que se eliminarán todos los stands, seguro?')) {
            $.post('/jx_event_delete', {id: idEvento}, function(){window.top.location.reload();});
        }
    });

    $('.eliminarStands').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        let idStand = $(this).data('id');
        if(confirm('Esta seguro de eliminar este stand?')) {
            $.post('/jx_event_delete_stand', {id: idStand}, function(){window.top.location.reload();});
        }
    });

    $('.eliminarCodigo').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        let idCodigo = $(this).data('id');
        if(confirm('Esta seguro de eliminar este codigo?')) {
            $.post('/jx_event_delete_code', {id: idCodigo}, function(){window.top.location.reload();});
        }
    });

    $('.codeGenerator').click(function(e){
        e.preventDefault();
        e.stopPropagation();
        let idEvento = $(this).data('id');
        let cantidad = prompt('ingrese cantidad de códigos a generar');
        $.post('/jx_event_codegen', {evento: idEvento, cantidad}, function(){
            window.top.location.reload();
        });
    });

    $('#uploaderFile').click(function(){
        $('#file_input').trigger('click');
    });


});