(function(){
    var trigger = "button#insert_new_family_submit";
    var valueSuppliers = {
        fam_name : "form#insert_new_family input[name='fam_name']",
        fam_name_ch : "form#insert_new_family input[name='fam_name_ch']"
    };
    var url = '/think/index.php/psi/Insert/insertNewFamily';
    $(document).ready(function(){
        $(trigger).click( function(){
            console.log( $(valueSuppliers.fam_name).val() );
            console.log( $(valueSuppliers.fam_name_ch).val() );
            $.get({
                url: url,
                beforeSend: function( xhr ) {},
                data:{
                    fam_name: $(valueSuppliers.fam_name).val(),
                    fam_name_ch: $(valueSuppliers.fam_name_ch).val()
                },
                sucess: function(data, textStatus) {
                    console.log('success');
                },
                complete: function(jqXHR, textStatus ) {}
            }).done(function( data ) {
                    $('#modal_insert_fam').modal('hide');
                    $('#dialog_success').modal('show');
                    console.log('yes');
            }).fail(function() {}).always(function() {});
        });
    });
})();