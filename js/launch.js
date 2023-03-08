$(document).ready(function() {
	$(".classes").change(function() {
		$("#tabel").html("");
		$(".topics").val("").html("");
		$(".subjects").val("").html("");

		var  _this = this;
		var class1 = $(this).val();
		var dataString = "classes=" + class1 + "&type=getSectionsSubjectMapping";
		$.ajax
		({
			type: "POST",
			url: "apis/ajaxcalls.php",
			data: dataString,
			cache: false,
			async: true,
			success: function(html)
			{
				$('.sections').html(html);
			},
      beforeSend: function(){
        //$("body").mLoading()
      },
      complete: function(){
        //$("body").mLoading('hide')
      }
		});

		console.log("came");
	});

	$(".sections").change(function() {
		var class1 = $(".classes").val();
		var section1 = $(".sections").val();
		var dataString = "classes=" + class1 + "&sections=" + section1 + "&type=getPillars" + "&module=enable_disable_chap";
		$.ajax
		({
			type: "POST",
			url: "apis/ajaxcalls.php",
			data: dataString,
			cache: false,
			async: true,
			success: function(html)
			{
				$('.subjects').html(html);
			},
      beforeSend: function(){
        //$("body").mLoading()
      },
      complete: function(){
        //$("body").mLoading('hide')
      }
		});
	});

	$(".subjects").change(function() {
		var class1 = $(".classes").val();
		var subject = $(this).val();
		var dataString = "classes=" + class1 + '&subject='+subject + "&type=getTopics";
		$.ajax
		({
			type: "POST",
			url: "apis/ajaxcalls.php",
			data: dataString,
			cache: false,
			async: true,
			success: function(html)
			{
				$('.topics').html(html);
			},
      beforeSend: function(){
        //$("body").mLoading()
      },
      complete: function(){
        //$("body").mLoading('hide')
      }
		});
	});

	$(".topics").change(function() {
		var class1 = $(".classes").val();
		var subject = $(".subjects").val();
		var section = $(".sections").val();
		var topic = $(this).val();
		var dataString = "topic="+topic + '&class='+class1 + '&section='+section + '&subject='+subject + "&type=getChaptersNew";
		$.ajax
		({
			type: "POST",
			url: "apis/ajaxcalls.php",
			data: dataString,
			cache: false,
			async: false,
			success: function(html)
			{
				$("#tabel").html(html);
			},
      beforeSend: function(){
        //$("body").mLoading()
      },
      complete: function(){
        //$("body").mLoading('hide')
      }
		});
	});

	//Save
	$(document).on('submit', '#form1', function(event){
		event.preventDefault();
		$.ajax({
	        type: "POST",
	        async: true,
	        url: "apis/ajaxcalls.php",
	        data:new FormData(this),
	        contentType:false,
	        processData:false,
	        success: function(data){
	        	var json = JSON.parse(data);
	        	if(json.status) {
	        		$('html, body').animate({scrollTop: '0px'}, 1000);
					$("#tabel").html('<div class="w-100 h-100 text-center d-flex align-items-center justify-content-center" id="empty_content"><h3 class="m-0 txt-grey">Select a class, section, subject and chapter to launch content</h3></div>');
					$("#sb_heading").html("Success");
					$("#sb_body").html(json.message);
                    var x = document.getElementById("snackbar");
                    x.className = "show";
                    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
	        	}
	        },
	        beforeSend: function(){
	            //$("body").mLoading()
	        },
	        complete: function(){
	            //$("body").mLoading('hide')
	        }
	    });
	});
});