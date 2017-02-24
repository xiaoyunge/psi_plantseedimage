(function(){
    $(document).ready(function(){
        url = {
            querySpeciesById: "/think/index.php/psi/query/querySpeciesById",
            queryAllFamily: "/think/index.php/psi/query/queryAllFamily",
            queryAllGenusByFamilyId: "/think/index.php/psi/query/queryAllGenusByFamilyId",
            queryGenusById : "/think/index.php/psi/query/queryGenusById"
        };
        fun = {
            queryAllFamily: function( fam_id, handle ){
                $.get({
                    url: url.queryAllFamily,
                    sucess: function(data) {} // End of attr success.
                }).done(function(data){
                    for( x in data){
                            let this_fam_id = data[x].id;
                            let fam_name = data[x].name;
                            let fam_name_ch = data[x].name_ch;
                            if ( data[x].id === fam_id) {
                                var html = `<option value="${this_fam_id}" selected>${fam_name} ${fam_name_ch}</option>`;
                                handle.find( "select[name='fam_id']" ).append(html);
                            } else {
                                var html = `<option value="${this_fam_id}">${fam_name} ${fam_name_ch}</option>`;
                                handle.find( "select[name='fam_id']" ).append(html);
                            }
                        } // End of loop
                });   // End of function "done".
            }   // End of method queryAllFamily.
        };  // End of Object fun.
        $('#modal_edit_frame').on('show.bs.modal', function (event) {
            var modal = $(this);
            var trigger = $(event.relatedTarget);
            var recipient = trigger.data('genid');
             // Definded as global varriable in this closure.
          $.get({
            url: url.queryGenusById ,
            beforeSend: function( xhr ) {},
            data:{
                gen_id: recipient
            },
            sucess: function(data, textStatus) {
            },
            complete: function(jqXHR, textStatus ) {}
          }).done(function( data ) {
            modal.find( "input[name='gen_name']" ).val( data.gen_name );
            modal.find( "input[name='gen_name_ch']" ).val( data.gen_name_ch );
            modal.find( "input.btn_submit" ).attr( { "data-genid" : recipient } );
            console.log(data.fam_id);
            fun.queryAllFamily(  data.fam_id, modal );
          }).fail(function(){
              console.log("fail");
          }); // family display
    }); // End of event with showing modal.
  });   // End of document ready function.
})(); // End of closed self-call function in this js file.
