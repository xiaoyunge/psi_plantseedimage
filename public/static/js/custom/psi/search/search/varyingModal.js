(function(){
    $(document).ready(function(){   
        var speciesImageRootUrl = plantSeedIndex.image_url.species;
        $('#modal_tuple').on('show.bs.modal', function (event) {
            var trigger = $(event.relatedTarget); // Button that triggered the modal
            var recipient = trigger.data('speid'); // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find(".modal-body img")
                    .attr({"src" : plantSeedIndex.image_url.species + '/' + recipient + 
                        '/seed/' + recipient + '_1.jpg'});
            //modal.find('.modal-title').text('New message to ' + recipient)
            $.get({
                url: "/think/index.php/psi/file/findAllSpeciesImages",
                beforeSend: function( xhr ) {},
                data:{
                    spe_id: recipient
                },
                sucess: function(data, textStatus) {
                    console.log(data);
                },
                complete: function(jqXHR, textStatus ) {}
            }).done(function( data ) {
                    console.log(data);
            }).fail( function() {} ).always( function() {} );
        });
    });
})();

