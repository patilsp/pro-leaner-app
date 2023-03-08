$(function () {
	var feedback1_right = "";
	var feedback1_wrong = "";
	var feedback2_right = "";
	var feedback2_wrong = "";
	var feedback3_right = "";
	var feedback3_wrong = "";
	var displayQuestion = 1;
	var total
	total = 0;
	$(document.body).on('change','input[type=radio]',function(){
		var radio_val = $(this).val();
		var page_item = 'page_item'+displayQuestion;
		
		
		if ($(this).prop('checked') == 1 && radio_val == 1){
	        total++;
	        icon('qust'+displayQuestion, 'right', page_item);
    	} else {
    		icon('qust'+displayQuestion, 'wrong', page_item);
    	}

    	var feedback_text = "";
			if ($(this).prop('checked') == 1 && radio_val == 1){
				if(displayQuestion == 1)
	        feedback_text = feedback1_right;
	      else if(displayQuestion == 2)
	        feedback_text = feedback2_right;
	      else if(displayQuestion == 3)
	        feedback_text = feedback3_right;

        $("#feedback").addClass("card_right");
    	} else {
    		if(displayQuestion == 1)
	        feedback_text = feedback1_wrong
	      else if(displayQuestion == 2)
	        feedback_text = feedback2_wrong;
	      else if(displayQuestion == 3)
	        feedback_text = feedback3_wrong;

    		$("#feedback").removeClass("card_right");
    	}
    	$("#feedback li").text(feedback_text);

    	$('#option_btn'+displayQuestion).addClass('animated fadeOut');
    	setTimeout(function(){
    		$('#option_btn'+displayQuestion).addClass('option_btn');
			$('#feedback').removeClass('feedback').addClass("animated fadeIn");
			$('#next_btn').removeClass('next_btn').addClass("animated fadeIn");
    	}, 1000)
    	
	});

	$('#next_btn').click(function(){
		$('#next_btn').removeClass("animated fadeIn");
		if(displayQuestion == 1)
			qust1();
		else if(displayQuestion == 2)
			qust2();
		else if(displayQuestion == 3)
			qust3();
	})


	function icon(qust_num, icon_type, page_item) {
		//if(qust_num == "qust1"){
			if(icon_type == "right")
				$('#'+page_item).html('<a class="page-link right" href="#" tabindex="-1"><i class="fa fa-check right_icon cyu_pagination_icon" aria-hidden="true"></i></a>');
			else
				$('#'+page_item).html('<a class="page-link wrong" href="#"><i class="fa fa-close wrong_icon cyu_pagination_icon" aria-hidden="true"></i></a>');
		//}	
	}
	function qust1() {
		displayQuestion = 2;
		setTimeout(function(){
			$('#feedback').addClass('animated fadeOut');
			$('#qus1').addClass('animated fadeOut');
			$('#next_btn').addClass('animated fadeOut');
		}, 500);
		setTimeout(function(){
			$('#page_item2_link').addClass('active');
			$('#qus1').addClass('qus1');
			$('#qus2').removeClass('qus2').addClass('animated fadeIn');
			$('.fontawesome_icon_wrong, .fontawesome_icon_right').removeClass('animated fadeOut');
			$('#next_btn').addClass('next_btn').removeClass('animated fadeIn fadeOut fadeOut');
			$('#feedback').addClass('feedback').removeClass('animated fadeIn fadeOut');
		}, 1300);
	}
	function qust2() {
		console.log("qust 2");
		displayQuestion = 3;
		$('#next_btn').addClass('animated fadeOut');
		setTimeout(function(){
			$('#feedback').addClass('animated fadeOut');
			$('#next_btn').addClass('animated fadeOut');
			$('#qus2').addClass('animated fadeOut');
		}, 500);
		setTimeout(function(){
			$('#page_item3_link').addClass('active');
			$('#qus2').addClass('qus2');
			$('#qus3').removeClass('qus3').addClass('animated fadeIn');
			$('.fontawesome_icon_wrong, .fontawesome_icon_right').removeClass('animated fadeOut');
			$('#next_btn').addClass('next_btn').removeClass('animated fadeIn fadeOut fadeOut');
			$('#feedback').addClass('feedback').removeClass('animated fadeIn fadeOut');
		}, 1300);
	}
	function qust3() {
		$('#next_btn').addClass('animated fadeOut');
		setTimeout(function(){
			$('#feedback').addClass('animated fadeOut');
			$('#next_btn').addClass('animated fadeOut');
			$('#qus3').addClass('animated fadeOut');
		}, 500);
		setTimeout(function(){
			$('#qus3').addClass('qus3');
			$('#qust_section').addClass('qust_section').addClass('animated fadeOut');
			$('#cor_ans_section').removeClass('cor_ans_section').addClass('animated fadeIn');
			$('.fontawesome_icon_wrong, .fontawesome_icon_right').removeClass('animated fadeOut');
			$('#next_btn').addClass('next_btn').removeClass('animated fadeIn fadeOut fadeOut');
			$('#feedback').addClass('feedback').removeClass('animated fadeIn fadeOut');
			document.getElementById('layout_form').reset();
		}, 1300);
	}
		

	$('#layout_form').on('submit', function(event) {
        event.preventDefault();
		
		$('#submit_btn').addClass('submit_btn');
		$('#next_btn').removeClass('next_btn').addClass('animated fadeIn');

		$('#qust_section').removeClass('animated fadeIn');
		
		setTimeout(function(){
			$('#qust_section').addClass('qust_section').addClass('animated fadeOut');
			$('#score_section').removeClass('score_section').addClass('animated fadeIn');
			$('#submit_btn').removeClass('submit_btn');
			$('.qust1_label, .qust2_label, .qust3_label, .qust4_label').removeClass('active');
			document.getElementById('layout_form').reset();
		}, 500);
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
	            var question_img = "";
	            var option1 = "";
	            var option1_val = "";
	            var option2 = "";
	            var option2_val = "";
	            var feedback_right = "";
	            var feedback_wrong = "";
	            var right_ans_label = "";
	            //id = button1
	            var worng_img = "";
	            //id = button2
	            var right_img = "";
              $.each(data, function(i, e){
                  //console.log(i," - ",e);
                  if(i == 'qust1') {
                    //console.log(i);
                    $.each(e, function(key, val){
                        if(key == "qust_text"){
                            question = val;
                        }
                        else if(key == "qust_image"){
                          question_img = val;
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
                        else if(key == "opt2_ans"){
                          option2_val = val;
                        }
                        else if(key == "feedback_right"){
                          feedback_right = val;
                        }
                        else if(key == "feedback_wrong"){
                          feedback_wrong = val;
                        }
                    });
                    if(option1 == "True" || option1 == "Yes")
                    	right_img = "button2";
	            			else if(option1 == "False" || option1 == "No")
	            				right_img = "button1";
	            			else
	            				right_img = "button1";

	            			if(option2 == "True" || option2 == "Yes")
                    	worng_img = "button2";
	            			else if(option2 == "False" || option2 == "No")
	            				worng_img = "button1";
	            			else
	            				worng_img = "button2";

                    $("#qust_slider").append(`<div id="qus1">
										  <div class="d-flex bd-highlight mb-80 align-items-center qust_header">
										    <div class="bd-highlight unscram_word">
										      `+question+`
										    </div>
										    <div class="ml-auto bd-highlight">
										      <img class="d-block mx-auto right_image" src="`+question_img+`" alt="info_image">
										    </div>
										  </div>

										  <div class="d-flex justify-content-center" id="option_btn1">
										    <div class="card">
										      <input id="img1" class="img_checkbox" value="`+option1_val+`" name="img_options" type="radio">
										      <label for="img1" class="checker d-flex justify-content-center align-items-center">
										        <a id="`+right_img+`"></a>
										      </label>
										      <div class="card-footer text-center">
										          `+option1+`
										      </div>
										    </div>
										    <div class="card">
										      <input id="img2" class="img_checkbox" value="`+option2_val+`" name="img_options" type="radio">
										      <label for="img2" class="checker d-flex justify-content-center align-items-center">
										        <a id="`+worng_img+`" class="active"></a>
										      </label>
										      <div class="card-footer text-center">
										          `+option2+`
										      </div>
										    </div>
										  </div>  
										</div>`);
                    feedback1_right = feedback_right;
                    feedback1_wrong = feedback_wrong;

                    if(option1_val == 1)
		          				right_ans_label = option1;
		          			else
		          				right_ans_label = option2;
                    $(".question_blk").append(`<div class="d-flex align-items-center w-100 tb_max-width mx-auto mb-2">
			                <div class="d-flex flex-grow-1 align-items-center">
			                  <img src="`+question_img+`" class="mr-3">
			                  <p class="m-0">`+question+`</p>
			                </div>
			                <div class="mr-5">`+right_ans_label+`</div>
			              </div>`);               
                  } else if(i == 'qust2') {
                    $.each(e, function(key, val){
                        if(key == "qust_text"){
                            question = val;
                        }
                        else if(key == "qust_image"){
                          question_img = val;
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
                        else if(key == "opt2_ans"){
                          option2_val = val;
                        }
                        else if(key == "feedback_right"){
                          feedback_right = val;
                        }
                        else if(key == "feedback_wrong"){
                          feedback_wrong = val;
                        }
                    });

                    if(option1 == "True" || option1 == "Yes")
                    	right_img = "button2";
	            			else if(option1 == "False" || option1 == "No")
	            				right_img = "button1";
	            			else
	            				right_img = "button1";

	            			if(option2 == "True" || option2 == "Yes")
                    	worng_img = "button2";
	            			else if(option2 == "False" || option2 == "No")
	            				worng_img = "button1";
	            			else
	            				worng_img = "button2";

                    $("#qust_slider").append(`<div class="qus2" id="qus2">
			                <div class="d-flex bd-highlight mb-80 align-items-center qust_header">
			                  <div class="bd-highlight unscram_word">`+question+`</div>
			                  <div class="ml-auto bd-highlight">
			                    <img class="d-block mx-auto right_image" src="`+question_img+`" alt="info_image">
			                  </div>
			                </div>

			                <div class="d-flex justify-content-center" id="option_btn2">
			                  <div class="card">
			                    <input id="img_options_qust2" class="img_checkbox" value="`+option1_val+`" name="img_options_qust2" type="radio">
			                    <label for="img_options_qust2" class="checker d-flex justify-content-center align-items-center">
			                      <a id="`+right_img+`"></a>
			                    </label>
			                    <div class="card-footer text-center">
			                        `+option1+`
			                    </div>
			                  </div>
			                  <div class="card">
			                    <input id="img_options_qust2_1" class="img_checkbox" value="`+option2_val+`" name="img_options_qust2" type="radio">
			                    <label for="img_options_qust2_1" class="checker d-flex justify-content-center align-items-center">
			                      <a id="`+worng_img+`" class="active"></a>
			                    </label>
			                    <div class="card-footer text-center">
			                        `+option2+`
			                    </div>
			                  </div>
			                </div>  
			              </div>`);
			              feedback2_right = feedback_right;
                    feedback2_wrong = feedback_wrong;

                    if(option1_val == 1)
		          				right_ans_label = option1;
		          			else
		          				right_ans_label = option2;
                    $(".question_blk").append(`<div class="d-flex align-items-center w-100 tb_max-width mx-auto mb-2">
			                <div class="d-flex flex-grow-1 align-items-center">
			                  <img src="`+question_img+`" class="mr-3">
			                  <p class="m-0">`+question+`</p>
			                </div>
			                <div class="mr-5">`+right_ans_label+`</div>
			              </div>`); 
                  } else if(i == 'qust3') {
                    $.each(e, function(key, val){
                        if(key == "qust_text"){
                            question = val;
                        }
                        else if(key == "qust_image"){
                          question_img = val;
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
                        else if(key == "opt2_ans"){
                          option2_val = val;
                        }
                        else if(key == "feedback_right"){
                          feedback_right = val;
                        }
                        else if(key == "feedback_wrong"){
                          feedback_wrong = val;
                        }
                    });

                    if(option1 == "True" || option1 == "Yes")
                    	right_img = "button2";
	            			else if(option1 == "False" || option1 == "No")
	            				right_img = "button1";
	            			else
	            				right_img = "button1";

	            			if(option2 == "True" || option2 == "Yes")
                    	worng_img = "button2";
	            			else if(option2 == "False" || option2 == "No")
	            				worng_img = "button1";
	            			else
	            				worng_img = "button2";

                    $("#qust_slider").append(`<div class="qus3" id="qus3">
			                <div class="d-flex bd-highlight mb-80 align-items-center qust_header">
			                  <div class="bd-highlight unscram_word">
			                    `+question+`
			                  </div>
			                  <div class="ml-auto bd-highlight">
			                    <img class="d-block mx-auto right_image" src="`+question_img+`" alt="info_image">
			                  </div>
			                </div>

			                <div class="d-flex justify-content-center" id="option_btn3">
			                  <div class="card">
			                    <input id="img_options_qust3" class="img_checkbox" value="`+option1_val+`" name="img_options_qust3" type="radio">
			                    <label for="img_options_qust3" class="checker d-flex justify-content-center align-items-center">
			                      <a id="`+right_img+`"></a>
			                    </label>
			                    <div class="card-footer text-center">
			                        `+option1+`
			                    </div>
			                  </div>
			                  <div class="card">
			                    <input id="img_options_qust3_1" class="img_checkbox" value="`+option2_val+`" name="img_options_qust3" type="radio">
			                    <label for="img_options_qust3_1" class="checker d-flex justify-content-center align-items-center">
			                      <a id="`+worng_img+`" class="active"></a>
			                    </label>
			                    <div class="card-footer text-center">
			                        `+option2+`
			                    </div>
			                  </div>
			                </div>  
			              </div>`);
			              feedback3_right = feedback_right;
                    feedback3_wrong = feedback_wrong;

                    if(option1_val == 1)
		          				right_ans_label = option1;
		          			else
		          				right_ans_label = option2;
                    $(".question_blk").append(`<div class="d-flex align-items-center w-100 tb_max-width mx-auto mb-2">
			                <div class="d-flex flex-grow-1 align-items-center">
			                  <img src="`+question_img+`" class="mr-3">
			                  <p class="m-0">`+question+`</p>
			                </div>
			                <div class="mr-5">`+right_ans_label+`</div>
			              </div>`); 
                  }
                });               
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
    }, 1000);
})