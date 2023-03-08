$(function () {
	$('[data-toggle="tooltip"]').tooltip();
	var correctAnswers = [];
	var total
	total = 0;
	var btn_total;
	btn_total = 0;
	var user_res_array = [];
	$(document.body).on('change','input[type=checkbox]',function(){
		//console.log('came');
		var checkbox_val = $(this).val();
		var checkbox_ans = $(this).data('id');
		
		if ($(this).prop('checked') == 1){
			btn_total++;
			$(this).closest('div').find('img').addClass('active');
			if(checkbox_val == 1)
				user_res_array.push({'qust1' : correctAnswers[checkbox_val-1]});
			else if(checkbox_val == 2)
				user_res_array.push({'qust2' : correctAnswers[checkbox_val-1]});
			else if(checkbox_val == 3)
				user_res_array.push({'qust3' : correctAnswers[checkbox_val-1]});
			else if(checkbox_val == 4)
				user_res_array.push({'qust4' : correctAnswers[checkbox_val-1]});
			else if(checkbox_val == 5)
				user_res_array.push({'qust5' : correctAnswers[checkbox_val-1]});
		} else {
			btn_total--;
			$(this).closest('div').find('img').removeClass('active');

			if(checkbox_val == 1){
	        	$('#img_opt1').removeClass('active');
		        user_res_array.forEach(function(value, index, array) {
		    		if(value.hasOwnProperty("qust1")) {
		    			user_res_array.splice(index, 1);
		    		}
		    	});
            }   
	        if(checkbox_val == 2){
	        	$('#img_opt2').removeClass('active');
	            user_res_array.forEach(function(value, index, array) {
		    		if(value.hasOwnProperty("qust2")) {
		    			user_res_array.splice(index, 1);
		    		}
		    	});
	        }    
	        if(checkbox_val == 3){
	        	$('#img_opt3').removeClass('active');
	            user_res_array.forEach(function(value, index, array) {
		    		if(value.hasOwnProperty("qust3")) {
		    			user_res_array.splice(index, 1);
		    		}
		    	});
	        }
	        if(checkbox_val == 4){
	        	$('#img_opt4').removeClass('active');
            user_res_array.forEach(function(value, index, array) {
			    		if(value.hasOwnProperty("qust4")) {
			    			user_res_array.splice(index, 1);
			    		}
			    	});
	        }
	        if(checkbox_val == 5){
	        	$('#img_opt5').removeClass('active');
            user_res_array.forEach(function(value, index, array) {
			    		if(value.hasOwnProperty("qust5")) {
			    			user_res_array.splice(index, 1);
			    		}
			    	});
	        }
		}

		if(btn_total > 0){
			$('#submit_btn').removeClass('submit_btn').addClass("animated fadeIn");
		}

		else if(btn_total < 1){
			$('#submit_btn').addClass('submit_btn').removeClass("animated fadeIn")
		}
	});
	
	$('.checker').click(function(){
		//console.log(btn_total);
		var checked = $(this).find('img').attr('class');
		a1=checked.split(" ");
		console.log(a1);
		if(btn_total > 4 && a1[4] != "active"){
			$("#showWellDone").modal("show");
		}
		else if($('#img1').attr("disabled", false),$('#img2').attr("disabled", false),$('#img3').attr("disabled", false),$('#img4').attr("disabled", false),$('#img5').attr("disabled", false),$('#img6').attr("disabled", false),$('#img7').attr("disabled", false));
	});
	

	$('#layout_form').on('submit', function(event) {
	
        event.preventDefault();

        
        
        $('#qust_section').find('input').addClass('card_submited').attr("disabled", "disabled");
        $('#qust_section').find('img').addClass('card_submited');
       	var total_score = 0;
       	//console.log("user_res_array - ", user_res_array);
        jQuery.each(user_res_array, function(index, item) {
        	if ('qust1' in item) {
    		  $('#qust1').addClass(item.qust1+' animated fadeIn');
    		  if(item.qust1 == "right")
    		  	total_score++;
			}
			if ('qust2' in item) {
			  $('#qust2').addClass(item.qust2+' animated fadeIn');
			  if(item.qust2 == "right")
    		  	total_score++;
		  	}

			if ('qust3' in item) {
			  $('#qust3').addClass(item.qust3+' animated fadeIn');
			  if(item.qust3 == "right")
    		  	total_score++;
			}
			if ('qust4' in item) {
			  $('#qust4').addClass(item.qust4+' animated fadeIn');
			  if(item.qust4 == "right")
    		  	total_score++;
			}
			if ('qust5' in item) {
			  $('#qust5').addClass(item.qust5+' animated fadeIn');
			  if(item.qust5 == "right")
    		  	total_score++;
			}
			if ('qust6' in item) {
			  $('#qust6').addClass(item.qust6+' animated fadeIn');
			  if(item.qust6 == "right")
    		  	total_score++;
			}
			if ('qust7' in item) {
			  $('#qust7').addClass(item.qust7+' animated fadeIn');
			  if(item.qust7 == "right")
    		  	total_score++;
			}
		});
        $("#your_answer").html($("#card_row1").html());
	    
        if(total_score == 5){
        	var card_title = "Well done!";
        	var card_text = total_score;
        	var card_image = "../../../images/graphics/welldone.png";
        	welldone(card_title, card_text, card_image);
        } else{
        	var card_title = "Not done!";
        	var card_text = total_score;
        	var card_image = "../../../images/graphics/notdone.png";
        	welldone(card_title, card_text, card_image);
        }
		
		$('#submit_btn').addClass('submit_btn_hide');
		$('#next_btn').removeClass('next_btn').addClass('animated fadeIn');
		document.getElementById('layout_form').reset();
	});

	function welldone(card_title, card_text, card_image){
		$("#card_image").attr("src", card_image)
		$('#card_title').text(card_title);
		$('#score_text').text(card_text +' out of 5');
	}		

	$('#next_btn').click(function(){
		$('#qust_section').addClass('animated fadeOut');
		setTimeout(function(){
			$('#qust_section').addClass('qust_section');
			$('#cor_ans_section').removeClass('cor_ans_section').addClass('animated fadeIn');
		}, 500)
	});

	var url = document.URL;
	var split_url_val = url.split('?');
	var split_url_qust_id = split_url_val[1].split('&');
	var api_url = split_url_qust_id[0].replace('api_end_point=','');
  	var qust_id = split_url_qust_id[1].replace('qust_id=','');
	
	setTimeout(function () {
		//console.log(api_url,'-',qust_id);
	    $.ajax({
	        url: '../../../../'+api_url+'?qust_id='+qust_id,
	        method:'GET',
	        contentType:false,
	        processData:false,
	        async:true,
	        success:function(data)
	        {
	          data = JSON.parse(data);
	          $("#act_title").text(data.act_title);
	          $(".exp_img").attr("src",data.exp_img);
	          $("#explanation1").text(data.explanation.exp1);
            $("#explanation2").text(data.explanation.exp2);
            $("#explanation3").text(data.explanation.exp3);

            if(data.explanation.exp1 == "" && data.explanation.exp2 == "" && data.explanation.exp3 == "" && data.exp_img == ""){
            	//console.log("111");
            	$("#exp_blk").addClass("d-none");
            	$("#no_exp").removeClass("d-none");
            } else if(data.explanation.exp1 != "" || data.explanation.exp2 != "" || data.explanation.exp3 != "" ||  data.exp_img != ""){
            	//console.log("222");
            	$("#exp_blk").removeClass("d-none");
            	$("#no_exp").addClass("d-none");
            } else if(data.explanation.exp1 != "" || data.explanation.exp2 != "" || data.explanation.exp3 != ""){
            	//console.log("3333");
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
          	var qustarray = [];
          	var optarray = []; 
          	var original_opt_array = [];
          	$.each(data, function(i, e){
          		//console.log(i," - ",e);
          		if(i == 'qust1') {
          			//console.log(i);
          			$.each(e, function(key, val){
          				if(key == "qust"){
          					question = val;
          				} 
          				else if(key == "ans"){
          					if(val === "1")
        							option1 = "right";
        						else
        							option1 = "wrong";
        					}
						 		});
						 		$("#card_row1").append(`<div class="card card_row1">
								  <input id="img1" class="img_checkbox" data-id="`+option1+`" value="1" name="option1" type="checkbox">
								  <label for="img1" class="checker" id="qust1">
								    <img class="d-block mx-auto rounded options" id="img_opt1" src="`+question+`" alt="badge">
								  </label>
								</div>`);
								qustarray.push(question);
						 		//console.log(option1);
						 		correctAnswers.push(option1);
						 		original_opt_array.push(option1);

						 		if(option1 == "right")
									$("#correct_answer").append(`<div class="card card_row1">
									  <label for="img1" class="checker right animated fadeIn" id="qust1">
									    <img class="d-block mx-auto rounded options active card_submited" id="img_opt1" src="`+question+`" alt="badge">
									  </label>
									</div>`);
          		} else if(i == 'qust2') {
          			$.each(e, function(key, val){
          				if(key == "qust"){
          					question = val;
          				}
        					else if(key == "ans"){
        						if(val === "1")
        							option1 = "right";
        						else
        							option1 = "wrong";
        					}
						 		});
						 		$("#card_row1").append(`<div class="card card_row1">
								  <input id="img2" class="img_checkbox" data-id="`+option1+`" value="2" name="option2" type="checkbox">
								  <label for="img2" class="checker" id="qust2">
								    <img class="d-block mx-auto rounded options" id="img_opt2" src="`+question+`" alt="badge">
								  </label>
								</div>`);
						 		qustarray.push(question);
						 		correctAnswers.push(option1);
						 		original_opt_array.push(option1);

						 		if(option1 == "right")
									$("#correct_answer").append(`<div class="card card_row1">
									  <label for="img1" class="checker right animated fadeIn" id="qust1">
									    <img class="d-block mx-auto rounded options active card_submited" id="img_opt1" src="`+question+`" alt="badge">
									  </label>
									</div>`);
          		} else if(i == 'qust3') {
          			$.each(e, function(key, val){
          				if(key == "qust"){
          					question = val;
          				}
        					else if(key == "ans"){
        						if(val === "1")
        							option1 = "right";
        						else
        							option1 = "wrong";
        					}
						 		});
						 		$("#card_row1").append(`<div class="card card_row1">
								  <input id="img3" class="img_checkbox" data-id="`+option1+`" value="3" name="option3" type="checkbox">
								  <label for="img3" class="checker" id="qust3">
								    <img class="d-block mx-auto rounded options" id="img_opt3" src="`+question+`" alt="badge">
								  </label>
								</div>`);
						 		qustarray.push(question);
						 		correctAnswers.push(option1);
						 		original_opt_array.push(option1);

						 		if(option1 == "right")
									$("#correct_answer").append(`<div class="card card_row1">
									  <label for="img1" class="checker right animated fadeIn" id="qust1">
									    <img class="d-block mx-auto rounded options active card_submited" id="img_opt1" src="`+question+`" alt="badge">
									  </label>
									</div>`);
          		} else if(i == 'qust4') {
          			$.each(e, function(key, val){
          				if(key == "qust"){
          					question = val;
          				}
        					else if(key == "ans"){
        						if(val === "1")
        							option1 = "right";
        						else
        							option1 = "wrong";
        					}
						 		});
						 		$("#card_row1").append(`<div class="card card_row1">
								  <input id="img4" class="img_checkbox" data-id="`+option1+`" value="4" name="option4" type="checkbox">
								  <label for="img4" class="checker" id="qust4">
								    <img class="d-block mx-auto rounded options" id="img_opt4" src="`+question+`" alt="badge">
								  </label>
								</div>`);
						 		qustarray.push(question);
						 		correctAnswers.push(option1);
						 		original_opt_array.push(option1);

						 		if(option1 == "right")
									$("#correct_answer").append(`<div class="card card_row1">
									  <label for="img1" class="checker right animated fadeIn" id="qust1">
									    <img class="d-block mx-auto rounded options active card_submited" id="img_opt1" src="`+question+`" alt="badge">
									  </label>
									</div>`);
          		} else if(i == 'qust5') {
          			$.each(e, function(key, val){
          				if(key == "qust"){
          					question = val;
          				}
        					else if(key == "ans"){
        						if(val === "1")
        							option1 = "right";
        						else
        							option1 = "wrong";
        					}
						 		});
						 		$("#card_row1").append(`<div class="card card_row1">
								  <input id="img5" class="img_checkbox" data-id="`+option1+`" value="5" name="option5" type="checkbox">
								  <label for="img5" class="checker" id="qust5">
								    <img class="d-block mx-auto rounded options" id="img_opt5" src="`+question+`" alt="badge">
								  </label>
								</div>`);
						 		qustarray.push(question);
						 		correctAnswers.push(option1);
						 		original_opt_array.push(option1);

						 		if(option1 == "right")
									$("#correct_answer").append(`<div class="card card_row1">
									  <label for="img1" class="checker right animated fadeIn" id="qust1">
									    <img class="d-block mx-auto rounded options active card_submited" id="img_opt1" src="`+question+`" alt="badge">
									  </label>
									</div>`);
          		}
        		});
      			
      			console.log("correctAnswers - ", correctAnswers);
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