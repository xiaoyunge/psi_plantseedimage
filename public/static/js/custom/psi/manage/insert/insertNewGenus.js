(function(){
    var trigger = "button#insert_new_genus_submit";
    var valueSuppliers = {
        gen_name : "form#insert_new_genus input[name='gen_name']",
        gen_name_ch : "form#insert_new_genus input[name='gen_name_ch']",
        fam_id : "form#insert_new_genus select[name='fam_id']"
    };
    var url = '/think/index.php/psi/Insert/insertNewGenus';
    $(document).ready(function(){
        $(trigger).click( function(){
            console.log( 'genus' );
            console.log( $(valueSuppliers.gen_name).val() );
            console.log( $(valueSuppliers.gen_name_ch).val() );
            console.log( $(valueSuppliers.fam_id).val() );
            $.get({
                url: url,
                beforeSend: function( xhr ) {},
                data:{
                    
                    gen_name: $(valueSuppliers.gen_name).val(),
                    gen_name_ch: $(valueSuppliers.gen_name_ch).val(),
                    fam_id: $(valueSuppliers.fam_id).val()
                    
                },
                sucess: function(data, textStatus) {
                    console.log('success');
                },
                complete: function(jqXHR, textStatus ) {}
            }).done(function( data ) {
                    $('#modal_insert_gen').modal('hide');
                    $('#dialog_success').modal('show');
            }).fail(function() {}).always(function() {});
        });
    });
})();