(function(){
    $(document).ready(function(){
        var variable = {
            url : "/think/index.php/psi/update/updateSpeciesById"
        };
        var controllers = {
            modal: $( "#modal_edit_frame" ) ,
            button_submit : $( "#modal_edit_frame" ).find( "input.btn_submit" )
        };
        func = {
            
        };
        controllers.button_submit.click(function(){
            var spe_id = controllers.button_submit.attr( "data-speid" );
            var spe_epi = controllers.modal.find("input[name='spe_epi']").val();
            var spe_name_ch = controllers.modal.find("input[name='spe_name_ch']").val();
            var spe_auth = controllers.modal.find("input[name='spe_auth']").val();
            var gen_id = controllers.modal.find("select[name='gen_id']").val();
            $.get({
                url: variable.url,
                beforeSend: function( xhr ) {},
                data:{
                    // species ID
                    spe_id: spe_id,
                    // Species epithet
                    spe_epi: spe_epi,
                    // Species Chinese name.
                    spe_name_ch: spe_name_ch,
                    spe_auth: spe_auth,
                    gen_id: gen_id
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


