/*
 * Usage scope(file path): /think/application/psi/view/manage/insert.html
 * dragdown linkage
 */
(function(){
    var trigger = "form select[name='query_family']";
    var urlList = {
       query_familyList :  '/think/index.php/psi/Query/queryAllFamily' ,
       query_genusList :'/think/index.php/psi/Query/queryAllGenusByFamilyId'
    };
     // jQuery program entrance after document ready.
     $(document).ready(function(){
        // =================================================================================
       // Family linkage dragdown.
       //$( trigger ).click( function(event){
         // Invoke Ajax method to communicate with the query program in server.
         $.get({
           url: urlList.query_familyList,//'/think/index.php/psi/Query/queryFamilyList',
           beforeSend: function( xhr ) {},
           data:{},
           sucess: function(data, textStatus) {},
           complete: function(jqXHR, textStatus ) {}
         }).done(function( data ) {
             $(trigger).html('');
            for (x in data){
                var html = '<option value="' + data[x].id +'">'+ data[x].name +  ' ' + data[x].name_ch + '</option>';
                $("form select[name='query_family']").append(html);
            }
         }).fail(function() {}).always(function() {});
       //});
       // =================================================================================
       // Genus linkage dragdown
       $( "select[name='query_family']" ).change( function(event)
       {
         // Invoke Ajax method to communicate with the query program in server.
         $.get({
           url: urlList.query_genusList,
           beforeSend: function( xhr ) {
             
           },
           data:{
               fam_id : $("select[name='query_family']").val()
           },
           sucess: function(data, textStatus) {},
           complete: function(jqXHR, textStatus ) {}
         }).done(function( data ) {
             $("form select[name='gen_id']").html('');
             for (x in data){
                var html = '<option value="' + data[x].id +'">'+ data[x].name +  ' ' + data[x].name_ch + '</option>';
                $("form select[name='gen_id']").append(html);
            }
         }).fail(function() {}).always(function() { });
       });
     });
 })();
