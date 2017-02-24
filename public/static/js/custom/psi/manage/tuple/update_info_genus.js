(function(){
    $(document).ready(function(){
        var variable = {
            url : "/think/index.php/psi/update/updateGenusById"
        };
        var controllers = {
            modal: $( "#modal_edit_frame" ) ,
            button_submit : $( "#modal_edit_frame" ).find( "input.btn_submit" )
        };
        func = {
            
        };
        controllers.button_submit.click(function(){
            var gen_id = controllers.button_submit.attr( "data-genid" );
            var gen_name = controllers.modal.find("input[name='gen_name']").val();
            var gen_name_ch = controllers.modal.find("input[name='gen_name_ch']").val();
            var fam_id = controllers.modal.find("select[name='fam_id']").val();
            $.get({
                url: variable.url,
                beforeSend: function( xhr ) {},
                data:{
                    gen_id: gen_id,
                    gen_name: gen_name,
                    gen_name_ch: gen_name_ch,
                    fam_id: fam_id
                },
                sucess: function(data, textStatus) {
                    $("#dialog_success").modal('show');
                },
                complete: function(jqXHR, textStatus ) {}
            }).done(function(){
                $("#dialog_success").modal('show');
                setTimeout(
                        function(){window.location.reload();},
                        5000
                );
            }).fail(function() {   
                  $("#dialog_fail").modal('show');
            }).always(function() {
                controllers.modal.modal('hide');
            });
        });
    });
})();


