$(function () {
    var count=0;
    var bad_count=0;
    $('.welldone').hide();
    $('#try').hide();
    $('.ui-draggable').click(function(){
        
      var valu = $(this).attr('value'); 
      if(valu=='good_group'){
          count++;
            $(this).css({'background':'#7FFFD4'});  
          }
      else if(valu=='bad_group'){
             bad_count++;
             $(this).css({'background':'red'}); 
             
          }
          if(count=='3'){
             $('#welldone').show();  
          }
          if(bad_count!=0){
             $('#notdone').show(); 
             $('#try').show();
          }
    });
     $('#trye').click(function(){
        location.reload();
    });
});