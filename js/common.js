$(document).ready(function(){
	var savedLogo = '';

	/**Snackbar */
	$(".close_snackbar").click(function () {
    	$("#snackbar").addClass("hide").removeClass("show");
    	setTimeout(function () {
    		$("#snackbar").removeClass("show");
    	}, 2000)
    });

	/** Date&Time Logic*/
	setInterval(function(){ 
		var date_time = getdatetime(); 
		$("#curr_date_time").text(date_time); 
	},1000);
	

	function getdatetime(){
		var myDate = new Date();

		let daysList = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
		let monthsList = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Aug', 'Oct', 'Nov', 'Dec'];


		let date = myDate.getDate();
		let month = monthsList[myDate.getMonth()];
		let year = myDate.getFullYear();
		let day = daysList[myDate.getDay()];

		let today = `${date} ${month} ${year}, ${day}`;

		let amOrPm;
		let twelveHours = function (){
		    if(myDate.getHours() > 12)
		    {
		        amOrPm = 'PM';
		        let twentyFourHourTime = myDate.getHours();
		        let conversion = twentyFourHourTime - 12;
		        return `${conversion}`

		    }else {
		        amOrPm = 'AM';
		        return `${myDate.getHours()}`}
		};
		let hours = twelveHours();
		let minutes = myDate.getMinutes();
		let append = "";

		if(minutes.toString().length == 1)
			append = 0;

		return currentDateTime = today + ' ' +`${hours}:${append}${minutes} ${amOrPm}`;
	}

	$('.eye').click(function(){
       
        if($(this).hasClass('eye-slash')){
           
          $(this).removeClass('eye-slash');
          
          $(this).addClass('eye');
          $(this).attr('src','../../assets/images/show_password.svg');
          $('#password').attr('type','text');
      	}else{
         
          $(this).removeClass('eye');
          
          $(this).addClass('eye-slash');  
          $(this).attr('src','../../assets/images/hide_password.svg');
          
          $('#password').attr('type','password');
        }
    });

    /** Setting File Upload **/
    function readURL(input) {
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();

	    $('.setting_logo_name').text(input.files[0].name);
	    
	    reader.onload = function(e) {
	      $('#setting_logo').attr('src', e.target.result);
	    }
	    
	    reader.readAsDataURL(input.files[0]); // convert to base64 string

	    $('#img_upload_blk').removeClass('d-none').addClass('d-none');
	    $('#img_display_blk').removeClass('d-none');
	  }
	}

	$("#logoUpload").change(function() {
	  readURL(this);
	});

	$('.img_display_close').click(function(){
		$('#img_display_blk').removeClass('d-none').addClass('d-none');
		$('#img_upload_blk').removeClass('d-none');
	});

	$('#settingModal').on('shown.bs.modal', function () {
	  savedLogo = $('#setting_logo').attr('src');
	  
	  if(savedLogo !== ""){
		  $('#img_display_blk').removeClass('d-none');
			$('#img_upload_blk').removeClass('d-none').addClass('d-none');
		}
	})

	$(document).on('submit', '#settings_form', function(event) {
		var api_url = $("#save_url").val();
		console.log(api_url);
    event.preventDefault();
    $.ajax({
      url:api_url,
      method:'POST',
      data:new FormData(this),
      contentType:false,
      processData:false,
      success:function(data)
      {
        var json = $.parseJSON(data);
        if(json.status) {
        	location.reload(true);	
        } else {
        	console.log(json);
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