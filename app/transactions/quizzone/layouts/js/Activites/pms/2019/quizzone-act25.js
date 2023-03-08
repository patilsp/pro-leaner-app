$(function () {
	var displayQuestion = 1;
	var total
	total = 0;
	$(document.body).on('change','input[type=radio]',function(){
		var radio_val = $(this).val();
		var page_item = 'page_item'+displayQuestion;
		
		if ($(this).prop('checked') == 1){
			if(page_item == "page_item1"){
				if(radio_val == "1")
					total = total+1;
				if(radio_val == "1")
					$('#'+page_item).html('<a class="page-link right" style="background-color:#4fda66" href="#" tabindex="-1"><i class="fa fa-check right_icon cyu_pagination_icon" aria-hidden="true"></i></a>');
				else
					$('#'+page_item).html('<a class="page-link wrong" style="background-color:#ed6a6a" href="#"><i class="fa fa-close wrong_icon cyu_pagination_icon" aria-hidden="true"></i></a>');
			} else if(page_item == "page_item2"){
				if(radio_val == "1")
					total = total+1;

				if(radio_val == "1")
					$('#'+page_item).html('<a class="page-link right" style="background-color:#4fda66" href="#" tabindex="-1"><i class="fa fa-check right_icon cyu_pagination_icon" aria-hidden="true"></i></a>');
				else
					$('#'+page_item).html('<a class="page-link wrong" style="background-color:#ed6a6a" href="#"><i class="fa fa-close wrong_icon cyu_pagination_icon" aria-hidden="true"></i></a>');
			} else if(page_item == "page_item3"){
				if(radio_val == "1")
					total = total+1;

				if(radio_val == "1")
					$('#'+page_item).html('<a class="page-link right" style="background-color:#4fda66" href="#" tabindex="-1"><i class="fa fa-check right_icon cyu_pagination_icon" aria-hidden="true"></i></a>');
				else
					$('#'+page_item).html('<a class="page-link wrong" style="background-color:#ed6a6a" href="#"><i class="fa fa-close wrong_icon cyu_pagination_icon" aria-hidden="true"></i></a>');
			}
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
    	}, 500)
    	
	});

	$('#next_btn').click(function(){
		$('#next_btn').removeClass("animated fadeIn");
		icon('page_item'+displayQuestion);
		if(displayQuestion == 1)
			qust1();
		else if(displayQuestion == 2)
			qust2();
		else if(displayQuestion == 3)
			qust3();
	})

	function icon(page_item){
		console.log(page_item);
		
		if(page_item == "page_item1"){
			$('#page_item1').find("a").removeClass('present active').addClass('presented');
			$('#page_item1').find("a span").addClass('ansed_qust');
			$('#page_item2').find("a").addClass('present active').removeClass('yet_present');
			$('#page_item2').find("a span").removeClass('ansed_qust');
		} else if(page_item == "page_item2"){
			$('#page_item2').find("a").removeClass('present active').addClass('presented');
			$('#page_item2').find("a span").addClass('ansed_qust');
			$('#page_item3').find("a").addClass('present active').removeClass('yet_present');
			$('#page_item3').find("a span").removeClass('ansed_qust');
		} else if(page_item == "page_item3"){
			$('#page_item3').find("a").removeClass('present active').addClass('presented');
			$('#page_item3').find("a span").addClass('ansed_qust');
			$('#page_item4').find("a").addClass('present active').removeClass('yet_present');
			$('#page_item4').find("a span").removeClass('ansed_qust');
		}

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
		$('#qust_section').removeClass('animated fadeOut');
		$('#score_section').removeClass('animated fadeIn');
		$('#score_section').removeClass('animated fadeOut');
		$('#qus1, #qus2, #qus3, #qus4, #qus5, #qus6, #qus7, #qus8, #qus9, #qus10, #qus11, #qus12, #qus13, #qus14, #qus15').removeClass('qus1 animated fadeIn fadeOut');
		setTimeout(function(){
			$('#score_section').addClass('animated fadeOut');
		}, 500);
		setTimeout(function(){
			$('#page_item2, #page_item3, #page_item4, #page_item5, #page_item6, #page_item7, #page_item8, #page_item9, #page_item10, #page_item11, #page_item12, #page_item13, #page_item14, #page_item15').find('a').removeClass('presented').addClass('yet_present');
			$('#page_item1').find('a').addClass('present active').removeClass('presented');
			$('#page_item1').find('span').addClass('active_qust')
			
			//$('#next_btn').removeClass('next_btn');
			$('#score_text').text('');
			$('#score_section').addClass('score_section');
			$('#qust_section').removeClass('qust_section').addClass('animated fadeIn');
			$('#qus1').addClass('animated fadeIn');
			$('#score_section').removeClass('animated fadeOut');
		}, 1000);

		$('.pagination').html('<li class="page-item" id="page_item1"> <a class="page-link present active" href="#" tabindex="-1"> <span class="active_qust cyu_pagination_icon">1</span> </a> </li><li class="page-item" id="page_item2"> <a class="page-link yet_present" href="#"> <span class="ansed_qust cyu_pagination_icon">2</span> </a> </li><li class="page-item" id="page_item3"> <a class="page-link yet_present" href="#"> <span class="ansed_qust cyu_pagination_icon">3</span> </a> </li>')
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
              $("#act_title").html(data.act_title);
              $(".exp_img").attr("src",data.exp_img);
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
	            var option3 = "";
	            var option3_val = "";
              $.each(data, function(i, e){
                  //console.log(i," - ",e);
                  if(i == 'qust1') {
                    //console.log(i);
                    $.each(e, function(key, val){
                        if(key == "qust_image"){
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
                        else if(key == "opt3"){
                          option3 = val;
                        }
                        else if(key == "opt3_ans"){
                          option3_val = val;
                        }
                    });
                    $('#qust1img').attr('src', question_img);
                    $('#qust1_col').html(`
                    	<div class="custom-control custom-radio custom-control">
		                    <input type="radio" class="custom-control-input" id="customRadio1" name="qust1" value="`+option1_val+`">
		                    <label class="custom-control-label" for="customRadio1">`+option1+`</label>
	                  	</div>

	                  	<div class="custom-control custom-radio custom-control">
		                    <input type="radio" class="custom-control-input" id="customRadio2" name="qust1" value="`+option2_val+`">
		                    <label class="custom-control-label" for="customRadio2">`+option2+`</label>
	                  	</div>

	                  	<div class="custom-control custom-radio custom-control">
		                    <input type="radio" class="custom-control-input" id="customRadio3" name="qust1" value="`+option3_val+`">
		                    <label class="custom-control-label" for="customRadio3">`+option3+`</label>
	                  	</div>
                	`)          
                  } else if(i == 'qust2') {
                    $.each(e, function(key, val){
                        if(key == "qust_image"){
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
                        else if(key == "opt3"){
                          option3 = val;
                        }
                        else if(key == "opt3_ans"){
                          option3_val = val;
                        }
                    });
                    $('#qust2img').attr('src', question_img);
                    $('#qust2_col').html(`
                    	<div class="custom-control custom-radio custom-control">
		                    <input type="radio" class="custom-control-input" id="qus2_1" name="qust2" value="`+option1_val+`">
		                    <label class="custom-control-label" for="qus2_1">`+option1+`</label>
	                  	</div>

	                  	<div class="custom-control custom-radio custom-control">
		                    <input type="radio" class="custom-control-input" id="qus2_2" name="qust2" value="`+option2_val+`">
		                    <label class="custom-control-label" for="qus2_2">`+option2+`</label>
	                  	</div>

	                  	<div class="custom-control custom-radio custom-control">
		                    <input type="radio" class="custom-control-input" id="qus2_3" name="qus2" value="`+option3_val+`">
		                    <label class="custom-control-label" for="customRadio3">`+option3+`</label>
	                  	</div>
                	`) 
                  } else if(i == 'qust3') {
                    $.each(e, function(key, val){
                        if(key == "qust_image"){
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
                        else if(key == "opt3"){
                          option3 = val;
                        }
                        else if(key == "opt3_ans"){
                          option3_val = val;
                        }
                    });
                    $('#qust3img').attr('src', question_img);
                    $('#qust3_col').html(`
                    	<div class="custom-control custom-radio custom-control">
		                    <input type="radio" class="custom-control-input" id="qus3_1" name="qust3" value="`+option1_val+`">
		                    <label class="custom-control-label" for="qus3_1">`+option1+`</label>
	                  	</div>

	                  	<div class="custom-control custom-radio custom-control">
		                    <input type="radio" class="custom-control-input" id="qus3_2" name="qust3" value="`+option2_val+`">
		                    <label class="custom-control-label" for="qus3_2">`+option2+`</label>
	                  	</div>

	                  	<div class="custom-control custom-radio custom-control">
		                    <input type="radio" class="custom-control-input" id="qus3_3" name="qust3" value="`+option3_val+`">
		                    <label class="custom-control-label" for="customRadio3">`+option3+`</label>
	                  	</div>
                	`) 
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