$(document).ready(function(){
  //   $("button").click(function(e){
  // //     // $("ul").last().clone().appendTo("body");
  // //        $("ul").last().clone().insertAfter("ul:last-child");

  // //        $( "ul" ).each(function( index ) {
		// //   //console.log( index + ": " + $( this ).removeClass() );
	 
		// //  // $(this).closest('.li').remove()
		// //    $(this).attr('class', 'li'+ index)
		// // });

		// $(this).closest('ul').remove();
		// // $( "ul" ).each(function( index ) {
		// // 	$(this).closest('ul').remove();
		// // });	
  //   });

  // $(".addli").click(function(){
        
  //     $("ul").last().clone().insertAfter("ul:last-child");

  //      $( "ul" ).each(function( index ) {
		 
	 // 	var i = parseInt(index)+1;
		 
		//     $(this).attr('class', 'li'+ i)
		//   });

		 
  //   });

  	  $('body').on('click', '.addli', function () {
        // $("ul").last().clone().insertAfter("ul:last-child");

         $(this).closest('ul').clone().insertAfter($(this).closest('ul'));


	       $( "ul" ).each(function( index ) {
			 
		 	var i = parseInt(index)+1;
			 
			    $(this).attr('class', 'li'+ i)
		  });
      });

       $('body').on('click', '.delli', function () {
           $(this).closest('ul').find('input').val("");
          $(this).closest('input').val('test');
		 
		    $(this).closest('ul').remove();
		    $( "ul" ).each(function( index ) {
			 
		 	  var i = parseInt(index)+1;
			 
			    $(this).attr('class', 'li'+ i)
		    });
		   
      });




});