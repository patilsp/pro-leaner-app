$(function () {
	var bucketOptionValues = [];
	var displayQuestion = 1;
	var total
	total = 0;
	var radio_val;
	radio_val = "";
	var choosedFeedbackMsg = '';
	$(document.body).on('change','input[type=radio]',function(){
		var radio_val = $(this).val();
		var page_item = 'page_item'+displayQuestion;
		$('#qus'+displayQuestion).addClass('pointerEvent');
		choosedFeedbackMsg = $(this).data('feedaback');
		
		$('#feedback .card').removeClass('right_feedback');
		$('#feedback .card').removeClass('wrong_feedback');
		if ($(this).prop('checked') == 1 && radio_val == 1){
	        total++;
	        icon('qust'+displayQuestion, 'right', page_item);
	        $('#feedback .card-title').text("Correct:");
	        feedback_msg(displayQuestion, radio_val, choosedFeedbackMsg);
	        console.log("came");
	        $('#feedback .card').addClass('right_feedback');
        } else {
    		icon('qust'+displayQuestion, 'wrong', page_item);
    		$('#feedback .card-title').text("Incorrect:");
    		feedback_msg(displayQuestion, radio_val, choosedFeedbackMsg);
    		$('#feedback .card').addClass('wrong_feedback');
    	}

    	$('#score_text').text(total +'/3');
    	if(total == 3) {
    		$('#score_text').removeClass().addClass('gold');
        	$("#card_title").text("Well Done!");
        	$("#card_image").attr("src", "../../../images/graphics/welldone.png");
        } else if(total >= 2) {
        	$('#score_text').removeClass().addClass('sliver');
        	$("#card_title").text("You are nearly there!");
        	$("#card_image").attr("src", "../../../images/graphics/welldone.png");
        } else {
        	$('#score_text').removeClass().addClass('bronze');
        	$("#card_title").text("You can do better!");
        	$("#card_image").attr("src", "../../../images/graphics/notdone.png");
        }

    	$('#option_btn'+displayQuestion).addClass('animated fadeOut');
    	setTimeout(function(){
    		$('#option_btn'+displayQuestion).addClass('option_btn');
			$('#feedback').removeClass('feedback').addClass("animated fadeIn");
			$('#next_btn').removeClass('next_btn').addClass("animated fadeIn");
    	}, 1000)
    	
	});

	$('#next_btn').click(function(){
		$('#next_btn').removeClass("animated fadeIn");
		if(displayQuestion == 1){
			qust1();
		}
		else if(displayQuestion == 2){
			qust2();
		}
		else if(displayQuestion == 3){
			qust3();
		}
	});

	function feedback_msg(displayQuestion, radio_val, choosedFeedbackMsg){
		$('#feedback .card_msg').html(choosedFeedbackMsg);
	}


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
			$('#score_section').removeClass('score_section').addClass('animated fadeIn');
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

	/*$('#next_btn').click(function(){
		
	});*/

	$('.try_again').click(function(){
		displayQuestion = 1;
		total = 0;
		$('#qus1, #qus2, #qus3, #qus4, #qus5, #qus6').removeClass('pointerEvent');
		$('.page-item').html('');
		$('#qust_section').removeClass('animated fadeOut');
		$('#score_section').removeClass('animated fadeIn');
		$('#score_section').removeClass('animated fadeOut');
		$('#option_btn1, #option_btn2, #option_btn3, #option_btn4, #option_btn5').removeClass('animated fadeIn fadeOut');
		$('.remove_html').html('');
		$('#qus1, #qus2, #qus3, #qus4, #qus5').removeClass('qus1 animated fadeIn fadeOut');
		setTimeout(function(){
			$('#score_section').addClass('animated fadeOut');
		}, 500);
		setTimeout(function(){
			$('#page_item1').html('<a class="page-link active" href="#" id="page_item1_link"></a>');
			$('#page_item2').html('<a class="page-link" href="#" id="page_item2_link"></a>');
			$('#page_item3').html('<a class="page-link" href="#" id="page_item3_link"></a>');
			$('#page_item4').html('<a class="page-link" href="#" id="page_item4_link"></a>');
			$('#page_item5').html('<a class="page-link" href="#" id="page_item5_link"></a>');
			//$('#next_btn').removeClass('next_btn');
			$('#option_btn1, #option_btn2, #option_btn3, #option_btn4, #option_btn5').removeClass('option_btn');
			$('#score_text').text('');
			$('#score_section').addClass('score_section');
			$('#qust_section').removeClass('qust_section').addClass('animated fadeIn');
			$('#qus1').addClass('animated fadeIn');
			$('#score_section').removeClass('animated fadeOut');
		}, 1000);
	});

	//Quizone Logic
    var url = document.URL;
    var split_url_val = url.split('?');
    var split_url_qust_id = split_url_val[1].split('&');
    var api_url = split_url_qust_id[0].replace('api_end_point=', '');
    var qust_id = split_url_qust_id[1].replace('qust_id=', '');

    setTimeout(function() {
        ////console.log(api_url,'-',qust_id);
        $.ajax({
            url: '../../../../' + api_url + '?qust_id=' + qust_id,
            method: 'GET',
            contentType: false,
            processData: false,
            async: true,
            success: function(data) {
                data = JSON.parse(data);
                $("#act_title").html(data.act_title);
                $("#act_sub_title").html(data.act_sub_title);
                $(".exp_img").attr("src", data.exp_img);
                $(".exp_content").html(data.explanation);

                $("#explanation1").html(data.explanation.exp1);
                $("#explanation2").html(data.explanation.exp2);
                $("#explanation3").html(data.explanation.exp3);

                if (data.explanation.exp1 == "" && data.explanation.exp2 == "" && data.explanation.exp3 == "" && data.exp_img == "") {
                    //console.log("111");
                    $("#exp_blk").addClass("d-none");
                    $("#no_exp").removeClass("d-none");
                } else if (data.explanation.exp1 != "" || data.explanation.exp2 != "" || data.explanation.exp3 != "" || data.exp_img != "") {
                    //console.log("222");
                    $("#exp_blk").removeClass("d-none");
                    $("#no_exp").addClass("d-none");
                }
                if (data.exp_img != "") {
                    //console.log("444");
                    $("#exp_blk").removeClass("d-none");
                    $("#no_exp").addClass("d-none");
                } else if (data.exp_img == "") {
                    //console.log("555");
                    $("#exp_left_img").addClass("d-none");
                }

                var question = "";
                var option1 = "";
                var option1_val = "";
                var option2 = "";
                var option2_val = "";
                var right_ans_label = "";
                $.each(data, function(i, e) {
                    //console.log(i," - ",e);
                    var obj = {};
                    if (i == 'qust1') {
                        obj['option1Val'] = e.opt1_ans;
                        obj['option1Feedback'] = e.feedback1;
                        obj['option2Val'] = e.opt2_ans;
                        obj['option2Feedback'] = e.feedback2;

                        bucketOptionValues.push(obj);
                        $("#qust_col").prepend(`
                        	<div id="qus1">
				                <div class="d-flex bd-highlight mb-80 align-items-center qust_header justify-content-center">
				                  <div class="bd-highlight unscram_word">
				                    <input id="img1" class="img_checkbox" value="` + e.opt1_ans + `" name="img_options" type="radio" data-feedaback="` + e.feedback1 + `">
				                    <label for="img1" class="checker d-flex justify-content-center align-items-center mb-0">
				                      <img class="d-block mx-auto right_image" src="` + e.qustOpt1 + `" alt="info_image">
				                    </label>
				                  </div>
				                  <div class="bd-highlight ml-4 mt-0 mt-sm-0 mt-md-2">
				                    <input id="img2" class="img_checkbox" value="` + e.opt2_ans + `" name="img_options" type="radio" data-feedaback="` + e.feedback2 + `">
				                    <label for="img2" class="checker d-flex justify-content-center align-items-center mb-0">
				                      <img class="d-block mx-auto right_image" src="` + e.qustOpt2 + `" alt="info_image">
				                    </label>
				                  </div>
				                </div>  
				              </div>
                    	`);
                    } else if (i == 'qust2') {
                        obj['option1Val'] = e.opt1_ans;
                        obj['option1Feedback'] = e.feedback1;
                        obj['option2Val'] = e.opt2_ans;
                        obj['option2Feedback'] = e.feedback2;

                        bucketOptionValues.push(obj);
                        $("#qust_col").prepend(`
                        	<div class="qus2" id="qus2">
				                <div class="d-flex bd-highlight mb-80 align-items-center qust_header justify-content-center">
				                  <div class="bd-highlight unscram_word">
				                    <input id="img3" class="img_checkbox" value="` + e.opt1_ans + `" name="img_options" type="radio" data-feedaback="` + e.feedback1 + `">
				                    <label for="img3" class="checker d-flex justify-content-center align-items-center mb-0">
				                      <img class="d-block mx-auto right_image" src="` + e.qustOpt1 + `" alt="info_image">
				                    </label>
				                  </div>
				                  <div class="bd-highlight ml-4 mt-0 mt-sm-0 mt-md-2">
				                    <input id="img4" class="img_checkbox" value="` + e.opt2_ans + `" name="img_options" type="radio" data-feedaback="` + e.feedback2 + `">
				                    <label for="img4" class="checker d-flex justify-content-center align-items-center mb-0">
				                      <img class="d-block mx-auto right_image" src="` + e.qustOpt2 + `" alt="info_image">
				                    </label>
				                  </div>
				                </div>  
				              </div>
                    	`);
                    } else if (i == 'qust3') {
                        obj['option1Val'] = e.opt1_ans;
                        obj['option1Feedback'] = e.feedback1;
                        obj['option2Val'] = e.opt2_ans;
                        obj['option2Feedback'] = e.feedback2;

                        bucketOptionValues.push(obj);
                        $("#qust_col").prepend(`
                        	<div class="qus3" id="qus3">
				                <div class="d-flex bd-highlight mb-80 align-items-center qust_header justify-content-center">
				                  <div class="bd-highlight unscram_word">
				                    <input id="img5" class="img_checkbox" value="` + e.opt1_ans + `" name="img_options" type="radio" data-feedaback="` + e.feedback1 + `">
				                    <label for="img5" class="checker d-flex justify-content-center align-items-center mb-0">
				                      <img class="d-block mx-auto right_image" src="` + e.qustOpt1 + `" alt="info_image">
				                    </label>
				                  </div>
				                  <div class="bd-highlight ml-4 mt-0 mt-sm-0 mt-md-2">
				                    <input id="img6" class="img_checkbox" value="` + e.opt2_ans + `" name="img_options" type="radio" data-feedaback="` + e.feedback2 + `">
				                    <label for="img6" class="checker d-flex justify-content-center align-items-center mb-0">
				                      <img class="d-block mx-auto right_image" src="` + e.qustOpt2 + `" alt="info_image">
				                    </label>
				                  </div>
				                </div>  
				              </div>
                    	`);
                    }
                });
                $('#submit_btn').removeClass('d-none').addClass('d-block');

				console.log(bucketOptionValues);
            },
            beforeSend: function() {
                $("#loader_modal").modal("show");
            },
            complete: function() {
                setTimeout(function() {
                    $("#loader_modal").modal("hide");
                }, 1000);
            }
        });
	}, 1000)
})