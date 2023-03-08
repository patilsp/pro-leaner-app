$(function() {
  var assigned = false;
  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    e.target // newly activated tab
    e.relatedTarget // previous active tab
    var tab = e.target;
    console.log(e.target.id);
    if(e.target.id == 'nav-assignedTask-tab' && assigned) {
      location.reload();
    }
  })


	var trId = "";
	$('.classSubRadio').on('change', function () {
		$("#new_task_form")[0].reset();
		var assignModalHeaderInfo = $(this).attr('data-info');
		$('#assignModalHeader').text(assignModalHeaderInfo);
		var classSubId = $(this).val().split('-');
		$('#classId').val(classSubId[0]);
		$('#subId').val(classSubId[1]);

		trId = $(this).closest('tr').attr('id');
	});

	// get CW Users
	$.ajax({
    type: "POST",
    url: "../id/apis/getUsers.php",
    data: 'checkeddept=CW',
    success: function(data){
      var data = $.parseJSON(data);
      console.log(data);
      var options = '<option value="">-Select User-</option>';
      if(data != null) {
        for (var i = 0; i < data.length; i++) {
          {
            options += '<option value="' + data[i].id + '">' + data[i].username + '</option>';
          }
        }
      } else {
        options += '<option value="" disabled>No Users Availlable of this Role</option>';
      }
      $("#user_cw").html(options);
    },
    beforeSend: function(){
      $("body").mLoading()
    },
    complete: function(){
      $("body").mLoading('hide')
    }
  });

  $('#new_task_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"apis/cpAssignTask.php",
      method:'POST',
      data:new FormData(document.new_task_form),
      contentType:false,
      processData:false,
      success:function(data)
      {
      	document.getElementById("new_task_form").reset();
      	$('#assignModal').modal('hide');
        var json = $.parseJSON(data);
        if(json.status){
          $(".close").trigger('click');
          $("#inst_btn").hide();
          $.toaster({ message : 'Successfully Assigned.', title : '', priority : 'success' });
          if(json.slide == "ok") {
            $('#'+json.slide_id_name+ " .slideicon").html("<i style='color:red;font-size:19px' class='icon ion-checkmark-circled'></i>");
          }
          else {
            $('#'+json.slide_id_name+ " .slideicon").html("<i style='color:red;font-size:19px' class='icon ion-backspace'></i>");
          }
          $('#'+trId).remove();
          assigned = true;
        } else {
          $.toaster({ message : json.message, title : 'Oh No!', priority : 'danger' });
          console.log("fail");
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
});