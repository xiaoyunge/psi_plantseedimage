(function(){
    $(document).ready(function(){
        var url = "/think/index.php/psi/delete/deleteSpecieById";
        $('#comfirm_delete').on('show.bs.modal', function (event) {
            var modal = $(this);
            var trigger = $(event.relatedTarget); 
            var recipient = trigger.data('speid'); 
            modal.find( "button.button_delete" ).attr( {"data-speid": recipient} ).val(recipient);
        });
        $("#comfirm_delete button.button_delete").click(function(){
            console.log( 'deleting ' + $(this).attr('data-speid') );
            $.get({
                url: url,
                beforeSend: function( xhr ) {},
                data:{
                    spe_id: $(this).attr('data-speid')
                },
                sucess: function(data, textStatus) {
                },
                complete: function(jqXHR, textStatus ) {}
            }).done(function( data ) {
                    $("#dialog_success").modal('show');
                    console.log("success");
            }).fail(function() {   
                    $("#dialog_fail").modal('show');
                    console.log("fail");
            }).always(function() {
                    $("#comfirm_delete").modal('hide');
            });
        })
    });
})();


