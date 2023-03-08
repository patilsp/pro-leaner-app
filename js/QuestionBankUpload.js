$(function () {
	$('.expl_tooltip').tooltip({ boundary: 'window' });
	
	$("#review_back").click(function () {
		$("#review_col").addClass("review_col");
  	$("#upload_col").removeClass("upload_col");
	});

	var input = document.getElementById( 'file-upload' );
	var infoArea = document.getElementById( 'file-upload-filename' );

	input.addEventListener( 'change', showFileName );

	function showFileName( event ) {
		console.log("qdqwdwedew");
	  // the change event gives us the input it occurred in 
	  var input = event.srcElement;

	  //alert(input.files[0]);
	  // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
	  var fileName = "";
	  if(input.files[0] != undefined)
	  	fileName = input.files[0].name;

	  //show show_attachedfiel blk
	  var arr = [];
	  if(fileName != ""){
	  	arr = fileName.split('.');
	  	if(arr[1] != "xlsx" && arr[1] != "xls"){
	  		alert("Upload only Excel");

	  		$("#show_attachedfiel").addClass("show_attachedfiel");
	  		$("#review").addClass("review");
	  		return false;
	  	} else {
	  		$("#upload_lable").removeClass("d-none").addClass("d-none");
	  		$("#import_excel_form").removeClass("d-none");
	  	}
	  }
	  else{
	  	$("#show_attachedfiel").addClass("show_attachedfiel");
	  	$("#review").addClass("review");
	  }
	  
	  // use fileName however fits your app best, i.e. add it into a div
	  infoArea.textContent = 'File name: ' + fileName;
	}

	//Review Uploaded Data
	$(document).on('submit', '#import_excel_form', function(event){
		event.preventDefault();
		$.ajax({
	      url:"apis/questions_apis.php",
	      method:'POST',
	      data:new FormData(this),
	      contentType:false,
	      processData:false,
	      success:function(data)
	      {
	        var json = $.parseJSON(data);
	        if(json.status) {
	        	$("#UploadData").html(json.List);
	        	$("#review_col").removeClass("review_col");
	        	$("#upload_col").addClass("upload_col");
	        	if(json.UploadStatus) {
	        		$("#error_info").hide();
	        		$("#uploadExcelSaveBtn").html("Upload");
	            $("#no_of_errors").html("");
	        	} else {
	        		$("#uploadExcelSaveBtn").html("Ignore errors and upload");
	            $("#no_of_errors").html(json.NoOfErrors + " Error(s) found");
	        	}
	        } else {
	        	$("#sb_heading").html("Notice!");
	        	var x = document.getElementById("snackbar");
	  				x.className = "show";
	  				$("#sb_body").html(json.message);
	  				setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
	        }
	      },
	      beforesend: function(){
	        $("body").mLoading()
	      },
	      complete: function(){
	        $("body").mLoading('hide')
	      }
    });
	});

	//Save Validate Excel Form
	$(document).on('submit', '#import_excel_form_validate', function(event){
		event.preventDefault();
		$.ajax({
      url:"apis/questions_apis.php",
      method:'POST',
      data:new FormData(this),
      contentType:false,
      processData:false,
      success:function(data)
      {
          var json = $.parseJSON(data);
          console.log(json);
          if(json.status) {
          	$("#review_col").addClass("review_col");
  					$("#upload_col").removeClass("upload_col");
  					$("#upload_lable").removeClass("d-none");
  					$("#import_excel_form").addClass("d-none");

          	$("#sb_heading").html("Notice!");
          	var x = document.getElementById("snackbar");
    				x.className = "show";
    				$("#sb_body").html(json.success_message);
    				setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
          } else {
          	$("#sb_heading").html("Notice!");
          	var x = document.getElementById("snackbar");
    				x.className = "show";
    				$("#sb_body").html(json.message);
    				setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
          }
      },
      beforeseNd: function(){
        $("body").mLoading()
      },
      complete: function(){
        $("body").mLoading('hide')
      }
    });
	});
})