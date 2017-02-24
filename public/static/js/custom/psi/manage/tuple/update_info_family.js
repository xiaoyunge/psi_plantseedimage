(function(){
    $(document).ready(function(){
        var variable = {
            url : "/think/index.php/psi/update/updateFamilyById"
        };
        var controllers = {
            modal: $( "#modal_edit_frame" ) ,
            button_submit : $( "#modal_edit_frame" ).find( "input.btn_submit" )
        };
        func = {
            
        };
        controllers.button_submit.click(function(){
            var fam_id = controllers.button_submit.attr( "data-famid" );
            var fam_name = controllers.modal.find("input[name='fam_name']").val();
            var fam_name_ch = controllers.modal.find("input[name='fam_name_ch']").val();
            $.get({
                url: variable.url,
                beforeSend: function( xhr ) {},
                data:{
                    fam_id: fam_id,
                    fam_name: fam_name,
                    fam_name_ch: fam_name_ch,
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
                   // $("#dialog_fail").modal('show');
            }).always(function() {
                controllers.modal.modal('hide');
            });
        });
    });
})();


