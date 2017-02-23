(function(){
    // jQuery program entrance after document ready.
    $(document).ready(function(){
      /*
          Use "ifChecked", a special callback of icheck to response the event action, otherwise do not reponse to
          the event with the jQuery tranditional callback
      */
      $( "form#select_frame input[name='content_part']" ).on( 'ifChecked', function(event)
      {
        // Invoke Ajax method to communicate with the query program in server.
        $.get({
          url: "/think/index.php/psi/Query/queryViewContent",
          beforeSend: function( xhr ) {
            console.log('[Ajax - before send]');
            editor.setData('Loading...');
          },
          data:{
            content_part:  $(this).val()
          },
          sucess: function(data, textStatus) {
               console.log('[Ajax - sucess]data: ' + data);
               console.log('[Ajax - sucess]status: ' + textStatus);
            },
          complete: function(jqXHR, textStatus ) {
              console.log( '[Ajax - complete]status: ' + textStatus );
          }
        }).done(function( data ) {
           // Return the result data from server.
          editor.setData(data);
          if ( console && console.log ) {
            console.log( "Return data:", data );
          }
        }).fail(function() {
          if ( console && console.log ) {
            console.log( "[Ajax error]: Can not be send or return data of view_content!");
          }
        }).always(function() {
            console.log( "[Ajax always]: Ajax finished" );
            console.log( this.data );
        });
      });
    });
    $( document ).ajaxError(function( event, request, settings ) {
        console.log('[Ajax global error]: Can not be send or return data!"');
    });
})();
