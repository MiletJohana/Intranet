function blog(param,cont) {
    $('#modal-title-lg').html('Blog');
    if(param==1){
        $.ajax({
            url:'../home/blog.php',
            type:'POST',
            data:{param,cont},
            success:function(respHtml){
                $('#modal-body-lg').html(respHtml);
                $('#modal-large-dialog').attr('style', 'min-width:1200px');
            }
        });
    }
    $.ajax({
        url: '../home/boton.php',
        type: 'POST',
        data: { resp: 2 },
        success: function (resp) {
            $('#btn-lg').html(resp);
        }
    });
}