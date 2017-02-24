(function(){
    $(document).ready(function(){
        url = {
            querySpeciesById: "/think/index.php/psi/query/querySpeciesById",
            queryAllFamily: "/think/index.php/psi/query/queryAllFamily",
            queryAllGenusByFamilyId: "/think/index.php/psi/query/queryAllGenusByFamilyId",
            queryGenusById : "/think/index.php/psi/query/queryGenusById"
        };
        fun = {
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
            modal.find( "input[name='fam_name']" ).val( data.gen_name );
            modal.find( "input[name='fam_name_ch']" ).val( data.gen_name_ch );
            modal.find( "input.btn_submit" ).attr( { "data-famid" : recipient } );
            console.log(data.fam_id);
            fun.queryAllFamily(  data.fam_id, modal );
          }).fail(function(){
              console.log("fail");
          }); // family display
    }); // End of event with showing modal.
  });   // End of document ready function.
})(); // End of closed self-call function in this js file.
