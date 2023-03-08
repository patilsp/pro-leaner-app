$(function () {
    $("#dvDestmain1").hide();
    $("#welldone").hide();
    $("#notdone").hide();
    
    
    $("td img").draggable({
        revert: "invalid",
        refreshPositions: true,
        drag: function (event, ui) {
            ui.helper.addClass("draggable");
        },
        stop: function (event, ui) {
            ui.helper.removeClass("draggable");
            var image = this.src.split("/")[this.src.split("/").length - 1];
            
            var valu = $(this).attr('value');
                        
            var categories  =$(this).attr('value');
            var category_type  =$(this).closest('div').attr('value');
           
            console.log(categories);
            console.log(category_type);
            
            if ( $('#dvDestdrop1').children().length == 1  &&  $('#dvDestdrop2').children().length == 1 &&  $('#dvDestdrop3').children().length == 1 &&  $('#dvDestdrop4').children().length == 1 ) {
                
                $(".valid_msg").removeClass("valid_msg_hide"); 
                $('#welldone').show();
            }
            if((categories!=category_type || category_type!=categories) && category_type != null) {
                    $(".valid_msg").removeClass("valid_msg_hide");
                    $('#notdone').show();
                $("td img").draggable( "option", "disabled", true );
                var a='<input type="button" id="try"value="Try Again"/>';
                $('#_try').html(a);
                $('#try').click(function(){
                     $(".valid_msg").addClass("valid_msg_hide");
                     location.reload();
                     
                });
                }
         }
    });
   $("#dvDestdrop1").droppable({
        drop: function (event, ui) {
            if ($("#dvDestdrop1 img").length == 0) {
                $("#dvDestdrop1").html("");
          }
            ui.draggable.addClass("dropped");
            $("#dvDestdrop1").append(ui.draggable);
        }
    });
    $("#dvDestdrop2").droppable({
        drop: function (event, ui) {
            if ($("#dvDestdrop2 img").length == 0) {
                $("#dvDestdrop2").html("");
            }
            ui.draggable.addClass("dropped");
            $("#dvDestdrop2").append(ui.draggable);
        }
    });
    $("#dvDestdrop3").droppable({
        drop: function (event, ui) {
            if ($("#dvDestdrop3 img").length == 0) {
                $("#dvDestdrop3").html("");
            }
            ui.draggable.addClass("dropped");
            $("#dvDestdrop3").append(ui.draggable);
        }
    });
    $("#dvDestdrop4").droppable({
        drop: function (event, ui) {
            if ($("#dvDestdrop4 img").length == 0) {
                $("#dvDestdrop4").html("");
            }
            ui.draggable.addClass("dropped");
            $("#dvDestdrop4").append(ui.draggable);
        }
    });
    $("#dvDestdrop5").droppable({
        drop: function (event, ui) {
            if ($("#dvDestdrop5 img").length == 0) {
                $("#dvDestdrop5").html("");
            }
            ui.draggable.addClass("dropped");
            $("#dvDestdrop5").append(ui.draggable);
        }
    });
    $("#dvDestdrop6").droppable({
        drop: function (event, ui) {
            if ($("#dvDestdrop6 img").length == 0) {
                $("#dvDestdrop6").html("");
            }
            ui.draggable.addClass("dropped");
            $("#dvDestdrop6").append(ui.draggable);
        }
    });
    $("#dvDestdrop7").droppable({
        drop: function (event, ui) {
            if ($("#dvDestdrop7 img").length == 0) {
                $("#dvDestdrop7").html("");
            }
            ui.draggable.addClass("dropped");
            $("#dvDestdrop7").append(ui.draggable);
        }
    });
    
    jQuery.browser = {};
    (function () {
        jQuery.browser.msie = false;
        jQuery.browser.version = 0;
        if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
            jQuery.browser.msie = true;
            jQuery.browser.version = RegExp.$1;
        }
    })();
});