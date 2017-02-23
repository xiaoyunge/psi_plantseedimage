/*
 * Usage scope(file path): /think/application/psi/view/manage/insert.html
 * dragdown linkage
 */
(function(){
    var trigger = "div#modal_insert_gen form#insert_new_genus select[name='fam_id']";
    var urlList = {
       query_familyList :  '/think/index.php/psi/Query/queryAllFamily' ,
       query_genusList :'/think/index.php/psi/Query/queryAllGenusByFamilyId'
    };
     // jQuery program entrance after document ready.
     $(document).ready(function(){
        // =================================================================================
       // Family linkage dragdown.
        $( trigger ).click( function(event)
        {
         // Invoke Ajax method to communicate with the query program in server.
            $.get({
                url: urlList.query_familyList,//'/think/index.php/psi/Query/queryFamilyList',
                beforeSend: function( xhr ) {},
                data:{},
                sucess: function(data, textStatus) {},
                complete: function(jqXHR, textStatus ) {}
            }).done(function( data ) {
                for (x in data){
                    var html = '<option value="' + data[x].id +'">'+ data[x].name +  ' ' + data[x].name_ch + '</option>';
                    $( trigger ).append(html);
                }
            }).fail(function() {}).always(function() {});
        });
     });
 })();
