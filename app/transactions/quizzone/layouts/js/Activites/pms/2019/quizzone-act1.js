$(document).ready(function(){
//$(function () {
	$(document).on('change', '.qust1', function() {
		$('.qust1_label').removeClass('active');
		$(this).parent().addClass('active');
	});
	$(document).on('change', '.qust2', function() {
		$('.qust2_label').removeClass('active');
		$(this).parent().addClass('active');
	});
	$(document).on('change', '.qust3', function() {
		$('.qust3_label').removeClass('active');
		$(this).parent().addClass('active');
	});
	$(document).on('change', '.qust4', function() {
		$('.qust4_label').removeClass('active');
		$(this).parent().addClass('active');
	});

	//$('#submit_btn').click(function(){
	$('#layout_form').on('submit', function(event) {
        event.preventDefault();
		var qust1 = $('input[name=options1]:checked').val();
		var qust2 = $('input[name=options2]:checked').val();
		var qust3 = $('input[name=options3]:checked').val();
		var qust4 = $('input[name=options4]:checked').val();
		var total = 0
		if(qust1 == 1){
			$("#last_td1").append('<span class="remove_html"><span class="fontawesome_icon fontawesome_icon_right animated fadein"><i class="fa fa-check" aria-hidden="true"></i></span></span>');
			total++;
		}
		else
			$("#last_td1").append('<span class="remove_html"><span class="fontawesome_icon fontawesome_icon_wrong animated fadeIn"><i class="fa fa-close" aria-hidden="true"></i></span></span>');
		if(qust2 == 1){
			$("#last_td2").append('<span class="remove_html"><span class="fontawesome_icon fontawesome_icon_right animated fadeIn"><i class="fa fa-check" aria-hidden="true"></i></span></span>');
			total++;
		}
		else
			$("#last_td2").append('<span class="remove_html"><span class="fontawesome_icon fontawesome_icon_wrong animated fadeIn"><i class="fa fa-close" aria-hidden="true"></i></span></span>');
		if(qust3 == 1){
			$("#last_td3").append('<span class="remove_html"><span class="fontawesome_icon fontawesome_icon_right animated fadeIn"><i class="fa fa-check" aria-hidden="true"></i></span></span>');
			total++;
		}
		else
			$("#last_td3").append('<span class="remove_html"><span class="fontawesome_icon fontawesome_icon_wrong animated fadeIn"><i class="fa fa-close" aria-hidden="true"></i></span></span>');
		if(qust4 == 1){
			$("#last_td4").append('<span class="remove_html"><span class="fontawesome_icon fontawesome_icon_right" animated fadeIn><i class="fa fa-check" aria-hidden="true"></i></span></span>');
			total++;
		}
		else
			$("#last_td4").append('<span class="remove_html"><span class="fontawesome_icon fontawesome_icon_wrong" animated fadeIn><i class="fa fa-close" aria-hidden="true"></i></span></span>');

		$('#score_text').text(total +' out of 4');
		var percentage = total/4 * 100;
		if(percentage == 100){
			$("#card_title").text("Well done!");
			$("#card_image").attr("src","../../../images/graphics/welldone.png");
		} else if(percentage >= 50) {
			$("#card_title").text("You are almost there!");
			$("#card_image").attr("src","../../../images/graphics/almostdone.png");
		}
		else{
			$("#card_title").text("You can do better!");
			$("#card_image").attr("src","../../../images/graphics/notdone.png");
		}
		$('#submit_btn').addClass('submit_btn');
		$('#next_btn').removeClass('next_btn').addClass('animated fadeIn');
	});

	$('#next_btn').click(function(){
		//$("#pills-ca").html($("#copy_section_ca").html());
		$('#qust_section').removeClass('animated fadeIn');
		$('#cor_ans_section').removeClass('animated fadeOut');
		setTimeout(function(){
			$('#qust_section').addClass('qust_section').addClass('animated fadeOut');
			$('#next_btn').addClass('next_btn').removeClass('animated fadeIn');
			$('#submit_btn').removeClass('submit_btn');
		}, 500);
		setTimeout(function(){
			$('#score_section').addClass('score_section');
			$('#cor_ans_section').removeClass('cor_ans_section').addClass('animated fadeIn');
		}, 1000);
	});

	$('.go_back_btn').click(function(){
		$('#score_section').removeClass('animated fadeOut');
		$('#cor_ans_section').removeClass('animated fadeIn');
		setTimeout(function(){
			$('#cor_ans_section').addClass('animated fadeOut');
		}, 500);
		setTimeout(function(){
			$('#cor_ans_section').addClass('cor_ans_section');
			$('#score_section').removeClass('score_section').addClass('animated fadeIn');
		}, 1000);
	});

	$('.try_again').click(function(){
		$('#qust_section').removeClass('animated fadeOut');
		$('#score_section').removeClass('animated fadeIn');
		$('#score_section').removeClass('animated fadeOut');
		$('.remove_html').html('');
		setTimeout(function(){
			$('#score_section').addClass('animated fadeOut');
		}, 500);
		setTimeout(function(){
			$('#score_section').addClass('score_section');
			$('#qust_section').removeClass('qust_section').addClass('animated fadeIn');
			$('#score_section').removeClass('animated fadeOut');
		}, 1000);
	});
	var url = document.URL;
	var split_url_val = url.split('?');
	var split_url_qust_id = split_url_val[1].split('&');
	var api_url = split_url_qust_id[0].replace('api_end_point=','');
  	var qust_id = split_url_qust_id[1].replace('qust_id=','');
	
	setTimeout(function () {
		////console.log(api_url,'-',qust_id);
	    $.ajax({
	        url: '../../../../'+api_url+'?qust_id='+qust_id,
	        method:'GET',
	        contentType:false,
	        processData:false,
	        async:true,
	        success:function(data)
	        {
	          data = JSON.parse(data);
	          $("#act_title").html(data.act_title);
	          $(".exp_img").attr("src",data.exp_img);
	          $(".exp_content").html(data.explanation);

	          $("#explanation1").html(data.explanation.exp1);
            $("#explanation2").html(data.explanation.exp2);
            $("#explanation3").html(data.explanation.exp3);

            if(data.explanation.exp1 == "" && data.explanation.exp2 == "" && data.explanation.exp3 == "" && data.exp_img == ""){
            	//console.log("111");
            	$("#exp_blk").addClass("d-none");
            	$("#no_exp").removeClass("d-none");
            } else if(data.explanation.exp1 != "" || data.explanation.exp2 != "" || data.explanation.exp3 != "" ||  data.exp_img != ""){
            	//console.log("222");
            	$("#exp_blk").removeClass("d-none");
            	$("#no_exp").addClass("d-none");
            }
            if(data.exp_img != ""){
            	//console.log("444");
            	$("#exp_blk").removeClass("d-none");
            	$("#no_exp").addClass("d-none");
            } else if(data.exp_img == ""){
            	//console.log("555");
            	$("#exp_left_img").addClass("d-none");
            }
	          
	          var question = "";
          	var option1 = "";
          	var option1_val = "";
          	var option2 = "";
          	var option2_val = "";
          	var right_ans_label = "";
          	$.each(data, function(i, e){
          		////console.log(i," - ",e);
          		if(i == 'qust1') {
          			$.each(e, function(key, val){
          				if(key == "qust1"){
          					question = val;
          				}
        					else if(key == "opt1"){
        						option1 = val;
        					}
    						 	else if(key == "opt1_ans"){
    						 		option1_val = val;
    						 	}
    						 	else if(key == "opt2"){
    						 		option2 = val;
    						 	}
    						 	else{
    						 		option2_val = val;
    						 	}
						 		});
          			$("#copy_section_ca").append(`<div class="d-flex align-items-center flex-wrap">
		              <div class="col-12 col-sm-6 col-md-6 p_75rem">`+question+`</div>
		              <div class="col-6 col-sm-3 col-md-3 p_75rem d-flex justify-content-end">
		                <label class="btn options qust1_label d-flex align-items-center justify-content-center">
		                  <input type="radio" name="options1" value="`+option1_val+`" class="qust1 opacity" autocomplete="off" required>`+option1+`
		                </label>
		              </div>
		              <div class="col-6 col-sm-3 col-md-3 d-flex justify-content-start" id="last_td1">
		                <label class="btn options qust1_label d-flex align-items-center justify-content-center">
		                  <input type="radio" name="options1" value="`+option2_val+`" class="qust1 opacity" autocomplete="off">`+option2+`
		                </label>
		              </div>
		            </div>`);

          			if(option1_val == 1)
          				right_ans_label = option1;
          			else
          				right_ans_label = option2;
		            $("#pills-ca").append(`<div class="d-flex align-items-center flex-wrap justify-content-center mb-3">
								  <div class="col-12 col-sm-6 col-md-6 p_75rem">`+question+` </div>
								  
								  <div class="col-6 col-sm-3 col-md-3 d-flex justify-content-start" id="last_td1">
								    <label class="btn options qust1_label d-flex align-items-center justify-content-center">
								      <input type="radio" disabled="disabled" class="qust1 opacity">`+right_ans_label+`
								    </label>
								  </div>
								</div>`);
	            } else if(i == 'qust2') {
          			$.each(e, function(key, val){
          				if(key == "qust2"){
          					question = val;
          				}
        					else if(key == "opt1"){
        						option1 = val;
        					}
    						 	else if(key == "opt1_ans"){
    						 		option1_val = val;
    						 	}
    						 	else if(key == "opt2"){
    						 		option2 = val;
    						 	}
    						 	else{
    						 		option2_val = val;
    						 	}
						 		});
          			$("#copy_section_ca").append(`<div class="d-flex align-items-center flex-wrap">
		              <div class="col-12 col-sm-6 col-md-6 p_75rem">`+question+`</div>
		              <div class="col-6 col-sm-3 col-md-3 p_75rem d-flex justify-content-end">
		                <label class="btn options qust2_label d-flex align-items-center justify-content-center">
		                  <input type="radio" name="options2" value="`+option1_val+`" class="qust2 opacity" autocomplete="off" required>`+option1+`
		                </label>
		              </div>
		              <div class="col-6 col-sm-3 col-md-3 d-flex justify-content-start" id="last_td2">
		                <label class="btn options qust2_label d-flex align-items-center justify-content-center">
		                  <input type="radio" name="options2" value="`+option2_val+`" class="qust2 opacity" autocomplete="off">`+option2+`
		                </label>
		              </div>
		            </div>`);

          			if(option1_val == 1)
          				right_ans_label = option1;
          			else
          				right_ans_label = option2;
		            $("#pills-ca").append(`<div class="d-flex align-items-center flex-wrap justify-content-center mb-3">
								  <div class="col-12 col-sm-6 col-md-6 p_75rem">`+question+` </div>
								  
								  <div class="col-6 col-sm-3 col-md-3 d-flex justify-content-start" id="last_td1">
								    <label class="btn options qust1_label d-flex align-items-center justify-content-center">
								      <input type="radio" disabled="disabled" class="qust1 opacity">`+right_ans_label+`
								    </label>
								  </div>
								</div>`);		            
	            } else if(i == 'qust3') {
          			$.each(e, function(key, val){
          				if(key == "qust3"){
          					question = val;
          				}
        					else if(key == "opt1"){
        						option1 = val;
        					}
    						 	else if(key == "opt1_ans"){
    						 		option1_val = val;
    						 	}
    						 	else if(key == "opt2"){
    						 		option2 = val;
    						 	}
    						 	else{
    						 		option2_val = val;
    						 	}
						 		});
          			$("#copy_section_ca").append(`<div class="d-flex align-items-center flex-wrap">
		              <div class="col-12 col-sm-6 col-md-6 p_75rem">`+question+`</div>
		              <div class="col-6 col-sm-3 col-md-3 p_75rem d-flex justify-content-end">
		                <label class="btn options qust3_label d-flex align-items-center justify-content-center">
		                  <input type="radio" name="options3" value="`+option1_val+`" class="qust3 opacity" autocomplete="off" required>`+option1+`
		                </label>
		              </div>
		              <div class="col-6 col-sm-3 col-md-3 d-flex justify-content-start" id="last_td3">
		                <label class="btn options qust3_label d-flex align-items-center justify-content-center">
		                  <input type="radio" name="options3" value="`+option2_val+`" class="qust3 opacity" autocomplete="off">`+option2+`
		                </label>
		              </div>
		            </div>`);

          			if(option1_val == 1)
          				right_ans_label = option1;
          			else
          				right_ans_label = option2;
		            $("#pills-ca").append(`<div class="d-flex align-items-center flex-wrap justify-content-center mb-3">
								  <div class="col-12 col-sm-6 col-md-6 p_75rem">`+question+` </div>
								  
								  <div class="col-6 col-sm-3 col-md-3 d-flex justify-content-start" id="last_td1">
								    <label class="btn options qust1_label d-flex align-items-center justify-content-center">
								      <input type="radio" disabled="disabled" class="qust1 opacity">`+right_ans_label+`
								    </label>
								  </div>
								</div>`);		            
	            }
        		});
				$('#submit_btn').removeClass('d-none').addClass('d-block');
          },
	        beforeSend: function(){
		        $("#loader_modal").modal("show");
	      	},
	      	complete: function(){
		        setTimeout(function(){
		          $("#loader_modal").modal("hide");
		        }, 1000);
	      	}
	    });
	}, 1000)
})