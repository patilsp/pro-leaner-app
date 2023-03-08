$(function () {
	var displayQuestion = 1;
	var total
	total = 0;
	var redScore = 0;
	var orangeScore = 0;
	var yellowScore = 0;
	var greenScore = 0;
	$('#redScore').html(redScore);
	$('#orangeScore').html(orangeScore);
	$('#yellowScore').html(yellowScore);
	$('#greenScore').html(greenScore);

	$(document.body).on('change','input[type=radio]',function(){
		var radio_val = $(this).val();
		var page_item = 'page_item'+displayQuestion;
		var bucket_type = $(this).data('buckettype');
		console.log(bucket_type);
		
		if ($(this).prop('checked') == 1 && radio_val == 'red'){
	        total++;
	        redScore++;
	        $('#redScore').html(redScore);
	        disable_li()	        
    	} else if ($(this).prop('checked') == 1 && radio_val == 'orange'){
	        total++;
	        orangeScore++;
	        $('#orangeScore').html(orangeScore);
	        disable_li();	        
    	} else if ($(this).prop('checked') == 1 && radio_val == 'yellow'){
	        total++;
	        yellowScore++;
	        $('#yellowScore').html(yellowScore);
	        disable_li()
       	} else if ($(this).prop('checked') == 1 && radio_val == 'green'){
	        total++;
	        greenScore++;
	        $('#greenScore').html(greenScore);
	        disable_li()
    	}	
			

    	if(displayQuestion == 1){
    		disable_li()
			qust1();
			document.getElementById('layout_form').reset();
		}
		else if(displayQuestion == 2){
			disable_li()
			qust2();
			document.getElementById('layout_form').reset();
		}
		else if(displayQuestion == 3){
			disable_li()
			qust3();
			document.getElementById('layout_form').reset();
		}
		else if(displayQuestion == 4){
			disable_li()
			qust4();
			document.getElementById('layout_form').reset();
		}
		else if(displayQuestion == 5){
			disable_li()
			qust5();
			document.getElementById('layout_form').reset();
		}

    	$("#card_image").attr("src", "../../../images/graphics/welldone.png");

    	$('#option_btn'+displayQuestion).addClass('animated fadeOut');
    	setTimeout(function(){
    		$('#option_btn'+displayQuestion).addClass('option_btn');
			$('#feedback').removeClass('feedback').addClass("animated fadeIn");
			$('#next_btn').removeClass('next_btn').addClass("animated fadeIn");
    	}, 1000)
    	
	});


	function icon(qust_num, icon_type, page_item) {
		$('.page-link.active').css("background-color","rgba(107, 181, 246, 0.3)");
	}
	function qust1() {
		displayQuestion = 2;
		setTimeout(function(){
			$('#qus1').addClass('animated fadeOut');
		}, 500);
		setTimeout(function(){
			enable_li();
			$('#page_item2_link').addClass('active');
			$('#qus1').addClass('qus1');
			$('#qus2').removeClass('qus2').addClass('animated fadeIn');
			$('.fontawesome_icon_wrong, .fontawesome_icon_right').removeClass('animated fadeOut');
		}, 1300);
	}
	function qust2() {
		console.log("qust 2");
		displayQuestion = 3;
		setTimeout(function(){
			$('#qus2').addClass('animated fadeOut');
		}, 500);
		setTimeout(function(){
			enable_li();
			$('#page_item3_link').addClass('active');
			$('#qus2').addClass('qus2');
			$('#qus3').removeClass('qus3').addClass('animated fadeIn');
			$('.fontawesome_icon_wrong, .fontawesome_icon_right').removeClass('animated fadeOut');
		}, 1300);
	}
	function qust3() {
		setTimeout(function(){
			$('#qus3').addClass('animated fadeOut');
		}, 500);
		setTimeout(function(){
			enable_li();
			$('#qus3').addClass('qus3');
			$('#qust_section').addClass('qust_section').addClass('animated fadeOut');
			$('#score_section').removeClass('score_section').addClass('animated fadeIn');
			$('.fontawesome_icon_wrong, .fontawesome_icon_right').removeClass('animated fadeOut');
			document.getElementById('layout_form').reset();
		}, 1300);
	}

	function disable_li(){
		$('#frd_nfrd_blk').addClass('disable_li');
	}

	function enable_li(){
		$('#frd_nfrd_blk').removeClass('disable_li');
	}
	
	

	$('#layout_form').on('submit', function(event) {
        event.preventDefault();
		
		$('#submit_btn').addClass('submit_btn');
		$('#qust_section').removeClass('animated fadeIn');
		
		setTimeout(function(){
			$('#qust_section').addClass('qust_section').addClass('animated fadeOut');
			$('#score_section').removeClass('score_section').addClass('animated fadeIn');
			$('#submit_btn').removeClass('submit_btn');
			$('.qust1_label, .qust2_label, .qust3_label, .qust4_label').removeClass('active');
			document.getElementById('layout_form').reset();
		}, 500);
	});

	$('.try_again').click(function(){
		displayQuestion = 1;
		total = 0;
		redScore = 0;
		orangeScore = 0;
		yellowScore = 0;
		greenScore = 0;
		$('#redScore').html(0);
		$('#orangeScore').html(0);
		$('#yellowScore').html(0);
		$('#greenScore').html(0);

		$('.page-item').html('');
		$('#qust_section').removeClass('animated fadeOut');
		$('#score_section').removeClass('animated fadeIn');
		$('#score_section').removeClass('animated fadeOut');
		$('#option_btn1, #option_btn2, #option_btn3, #option_btn4, #option_btn5').removeClass('animated fadeIn fadeOut');
		$('#frdinnerbox, #nfrdinnerbox').html('');
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

                if(data.Featured.f1 != ""){
                	$(".optionRow1").append(`
                		<div class="loading-button" id="red">
                            <input id="img_option" data-bucketType="frdinnerbox" class="img_checkbox" value="red" name="img_option" type="radio">
                            <label for="img_option">`+data.Featured.f1+`</label>
                        </div>
            		`);

            		$('tbody').append(`
            			<tr>
	                        <td class="p-0 align-middle pl-2">`+data.Featured.f1+`</td>
	                        <td class="text-center d-flex justify-content-end align-items-center p-0 redTd">
	                          <div class="w-100 scoreTd p-2" id="redScore">2</div>
	                        </td>
                      	</tr>
        			`)
            	}
            	if(data.Featured.f2 != ""){
                	$(".optionRow1").append(`
                		<div class="loading-button" id="orange">
                            <input id="img_option1" data-bucketType="frdinnerbox" class="img_checkbox" value="orange" name="img_option" type="radio">
                            <label for="img_option1">`+data.Featured.f2+`</label>
                        </div>
            		`);

            		$('tbody').append(`
	        			<tr>
                            <td class="p-0 align-middle pl-2">`+data.Featured.f2+`</td>
                            <td class="text-center d-flex justify-content-end align-items-center p-0 orangeTd">
                              <div class="w-100 scoreTd p-2" id="orangeScore">2</div>
                            </td>
                      	</tr>
        			`)
            	}
            	if(data.Featured.f3 != ""){
                	$(".optionRow2").append(`
                		<div class="loading-button" id="yellow">
                            <input id="img_option2" data-bucketType="frdinnerbox" class="img_checkbox" value="yellow" name="img_option" type="radio">
                            <label for="img_option2">`+data.Featured.f3+`</label>
                        </div>
            		`);

            		$('tbody').append(`
	        			<tr>
                            <td class="p-0 align-middle pl-2">`+data.Featured.f3+`</td>
                            <td class="text-center d-flex justify-content-end align-items-center p-0 yellowTd">
                              <div class="w-100 scoreTd p-2" id="yellowScore">2</div>
                            </td>
                      	</tr>
        			`)
            	}
            	if(data.Featured.f4 != ""){
                	$(".optionRow2").append(`
                		<div class="loading-button" id="green">
                            <input id="img_option3" data-bucketType="frdinnerbox" class="img_checkbox" value="green" name="img_option" type="radio">
                            <label for="img_option3">`+data.Featured.f4+`</label>
                        </div>
            		`);

            		$('tbody').append(`
	        			<tr>
                            <td class="p-0 align-middle pl-2">`+data.Featured.f4+`</td>
                            <td class="text-center d-flex justify-content-end align-items-center p-0 greenTd">
                              <div class="w-100 scoreTd p-2" id="greenScore">2</div>
                            </td>
                      	</tr>
        			`)
            	} 
              
              $.each(data, function(i, e){
                  if(i == 'qust1') {
                    $.each(e, function(key, val){
                        if(key == "qust1"){
                            $("#qus1").html(val.replace('<p>','<p class="m-1">'));
                        }
                    });                   
                  }
                  else if(i == 'qust2') {
                    $.each(e, function(key, val){
                        if(key == "qust2"){
                            $("#qus2").html(val.replace('<p>','<p class="m-0">'));
                        }
                    });                
                  }
                  else if(i == 'qust3') {
                    $.each(e, function(key, val){
                        if(key == "qust3"){
                            $("#qus3").html(val.replace('<p>','<p class="m-0">'));
                        }
                    });                   
                  }
                });

                $('#redScore').html(redScore);
				$('#orangeScore').html(orangeScore);
				$('#yellowScore').html(yellowScore);
				$('#greenScore').html(greenScore);            
          },
            beforeSend: function(){
                $("#loader_modal").modal("show");
              },
              complete: function(){
                setTimeout(function(){
                  $("#loader_modal").modal("hide");
                }, 500);
              }
        });
 	}, 1000);
})