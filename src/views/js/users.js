$(document).ready(function(){
    $('.unlockUser').click(function(){
        let idUser = $(this).data('id');
        if(confirm('Esta seguro de desbloquear este usuario?')) {
            $.post('/jx_user_unlock', {id: idUser}, function(){window.top.location.reload();});
        }
    });
    $('.removeAdmin').click(function(){
        let idUser = $(this).data('id');
        if(confirm('Esta seguro de quitar la administracion a este usuario?')) {
            $.post('/jx_user_rem_admin', {id: idUser}, function(){window.top.location.reload();});
        }
    });
    $('.doAdmin').click(function(){
        let idUser = $(this).data('id');
        if(confirm('Esta seguro de hacer administrador a este usuario?')) {
            $.post('/jx_user_add_admin', {id: idUser}, function(){window.top.location.reload();});
        }
    });
    $('.deleteUser').click(function(){
        let idUser = $(this).data('id');
        if(confirm('Esta seguro de eliminar este usuario?')) {
            $.post('/jx_user_delete', {id: idUser}, function(){window.top.location.reload();});
        }
    });
});