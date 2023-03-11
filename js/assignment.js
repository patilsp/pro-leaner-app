$(document).ready(function() {
    $('#filter_table').DataTable({
        paging: true,
        "aoColumnDefs": [
          { bSortable: false, aTargets: [ -1, 2, 3 ] }
        ]
    });

    $('.from_to_date').datetimepicker({
      format: 'DD-MMM-YYYY',
      icons: {
        previous: "fas fa-chevron-left",
        next: "fas fa-chevron-right",
      },
    });

    $('.att_to_date').click(function(){
      $('#att_to_date').trigger('focus');
    });

    $('#due_by').datetimepicker({
      format: 'LT',
      icons: {
        time: 'fa fa-clock-o',
        date: 'fa fa-calendar',
        up: 'fa fa-angle-up',
        down: 'fa fa-angle-down',
        previous: 'fa fa-angle-left',
        next: 'fa fa-angle-right',
        today: 'fa fa-dot-circle-o',
        clear: 'fa fa-trash',
        close: 'fa fa-times'
      }
    }).on('change', function() {

    });

 
   
    $('.publish_date').click(function(){
        $('#publish_date').trigger('focus');
      });
  
      $('#publish_time').datetimepicker({
        format: 'LT',
        icons: {
          time: 'fa fa-clock-o',
          date: 'fa fa-calendar',
          up: 'fa fa-angle-up',
          down: 'fa fa-angle-down',
          previous: 'fa fa-angle-left',
          next: 'fa fa-angle-right',
          today: 'fa fa-dot-circle-o',
          clear: 'fa fa-trash',
          close: 'fa fa-times'
        }
      }).on('change', function() {
  
      });


    $('#error_info').tooltip();

	$("#review_back").click(function () {
		$("#review_col").addClass("review_col");
      	$("#upload_col").removeClass("upload_col");
	});


});

$(document).ready(function() {
	
	$(".selectclass").on("change", function() {
        var id = $(this).val();
        $.ajax({
            url:"../content/apis/getSubject.php",
            method:'POST',
            data: "classcode="+ id +"&type=getSubject",
            success:function(data)
            {
                var json = $.parseJSON(data);
                if(json.status){
            		$("#selectedSubject").html(json.subject);
                    $("#selectedSubject").trigger("change");
                    $("#course").trigger("change");
                    $("#subtopic").empty();
                    $("#subtopic").html('<option value="">-Select Sub Topic-</option>');
                }
            },
            beforeSend: function(){
                $("body").mLoading()
            },
            complete: function(){
                $("body").mLoading('hide')
            }
        });
    });

	$("#selectedSubject").on("change", function() {
        var id = $(this).val();
        $.ajax({
            url:"../Assignment/apis/assignments_apis.php",
            method:'POST',
            data: "subject_id="+ id +"&type=getCourses",
            success:function(data)
            {
                var json = $.parseJSON(data);
                if(json.status) {
            		$("#course").html(json.Result);
                }
            },
            beforeSend: function(){
                $("body").mLoading()
            },
            complete: function(){
                $("body").mLoading('hide')
            }
        });
    });
$("#course").on("change", function() {
        var id = $(this).val();
        $.ajax({
            url:"../Assignment/apis/assignments_apis.php",
            method:'POST',
            data: "topic_id="+ id +"&type=getTopic",
            success:function(data)
            {
                var json = $.parseJSON(data);
                if(json.status) {
            		$("#topic").html(json.Result);
                }
            },
            beforeSend: function(){
                $("body").mLoading()
            },
            complete: function(){
                $("body").mLoading('hide')
            }
        });
    });

    $("#topic").on("change", function() {
      var id = $(this).val();
      $.ajax({
          url:"../Assignment/apis/assignments_apis.php",
          method:'POST',
          data: "subtopic_id="+ id +"&type=getSubTopic",
          success:function(data)
          {
              var json = $.parseJSON(data);
              if(json.status) {
              $("#subtopic").html(json.Result);
              }
          },
          beforeSend: function(){
              $("body").mLoading()
          },
          complete: function(){
              $("body").mLoading('hide')
          }
      });
  });

    const el = document.getElementById("multichoice_qustediter");
    el.focus()
    let char = 1, sel; // character at which to place caret

    if (document.selection) {
    sel = document.selection.createRange();
    sel.moveStart('character', char);
    sel.select();
    }
    else {
    sel = window.getSelection();
    sel.collapse(el.lastChild, char);
    }
});

