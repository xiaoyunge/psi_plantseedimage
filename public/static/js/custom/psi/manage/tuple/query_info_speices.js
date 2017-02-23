(function(){
    $(document).ready(function(){
        url = {
            querySpeciesById: "/think/index.php/psi/query/querySpeciesById",
            queryAllFamily: "/think/index.php/psi/query/queryAllFamily",
            queryAllGenusByFamilyId: "/think/index.php/psi/query/queryAllGenusByFamilyId",
            queryGenusById : "/think/index.php/psi/query/queryGenusById"
        };
        fun = {
            queryGenusById: function( gen_id, fam_id, handle ){
                $.get({
                    url: url.queryAllGenusByFamilyId,
                    data:{
                        fam_id: fam_id
                    },
                    success: function( data ) {
                        for ( x in data ){
                            let this_gen_id = data[x].id;
                            let gen_name = data[x].name;
                            let gen_name_ch = data[x].name_ch;
                            if ( data[x].id === gen_id) {
                                var html = `<option value="${this_gen_id}" selected>${gen_name} ${gen_name_ch}</option>`;
                                handle.find( "select[name='gen_id']" ).append(html);
                            }  else {
                                var html = `<option value="${this_gen_id}">${gen_name} ${gen_name_ch}</option>`;
                                handle.find( "select[name='gen_id']" ).append(html);
                            }
                        }   // End of for loop.
                    }   // End of recall method success
                }); // End of AJAX get method.
            },   // End of closure function queryGenusById.
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
            var recipient = trigger.data('speid');
             // Definded as global varriable in this closure.
          $.get({
            url: url.querySpeciesById ,
            beforeSend: function( xhr ) {},
            data:{
                spe_id: recipient
            },
            sucess: function(data, textStatus) {
            },
            complete: function(jqXHR, textStatus ) {}
          }).done(function( data ) {
            modal.find( "input[name='spe_epi']" ).val( data.spe_epi );
            modal.find( "input[name='spe_auth']" ).val( data.spe_authority );
            modal.find( "input[name='spe_name_ch']" ).val( data.spe_name_ch );
            modal.find( "select[name='gen_id']" ).val( data.spe_name_ch );
            modal.find( "input.btn_submit" ).attr( { "data-speid" : recipient } );
            fun.queryAllFamily(  data.fam_id, modal );
            fun.queryGenusById( data.gen_id, data.fam_id, modal  );
          });
          // family display
          
          // genus display
          $( this ).find( "select[name='fam_id']" ).change(function(){
              var fam_id = $( this ).val();
              $.get({
                  url: url.queryAllGenusByFamilyId,
                  beforeSend: function( xhr ) {
                  },
                  data:{
                      fam_id: fam_id
                  },
                  sucess: function(data, textStatus) {
                  },
                  complete: function(jqXHR, textStatus ) {}
                }).done(function( data ) {
                  modal.find("select[name='gen_id']").html("");
                  for ( x in data) {
                      var html = '<option value="' + data[x].id +'">'+ data[x].name +  ' ' + data[x].name_ch + '</option>';
                      modal.find("select[name='gen_id']").append(html);
                  }
                }).fail(function(){ console.log("fail"); });;   // End of function "done".
          });   // End of event trigger of select[name='gen_id'].
    }); // End of event with showing modal.
  });   // End of document ready function.
})(); // End of closed self-call function in this js file.
