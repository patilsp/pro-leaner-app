$(function(){
	$('#cssEditorForm, #htmlEditorForm, #jsEditorForm').on('submit', function(event){
    //prevent the form from submitting by default
    event.preventDefault();
    $.ajax({
      url: 'cssUpdate.php',
      method:'POST',
      data:new FormData(this),
      contentType:false,
      processData:false,
      async:true,
      success:function(data)
      {
        //console.log(data);
        if(data == "success")
        	$.toaster({ message : 'Successfully Updated.', title : '', priority : 'success' });
        else
        	$.toaster({ message : 'Getting Issue.', title : '', priority : 'danger' });
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