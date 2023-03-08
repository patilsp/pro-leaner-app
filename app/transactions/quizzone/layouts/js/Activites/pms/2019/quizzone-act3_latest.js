$(function () {
	var rightwords = [];
	var extrawords = [];
	var feedback1_right = "";
	var feedback1_wrong = "";
	var feedback2_right = "";
	var feedback2_wrong = "";
	var feedback3_right = "";
	var feedback3_wrong = "";
	var displayQuestion = 1;
	var total = 0;
	$(document).on('click', '.btn_li', function(){
		var data = $(this).attr('data-optionId');
		var opt1 = $('#opt1').attr('data-value');
		var opt2 = $('#opt2').attr('data-value');
		var opt3 = $('#opt3').attr('data-value');
		//alert(data);

		if(opt1 == null || opt1 == 'undefined' || opt1 == '') {
			var opt1 = $('#opt1').attr('data-value', data);
			$('#opt1').html($(this).html());
		} else if(opt2 == null || opt2 == 'undefined' || opt2 == ''){
			var opt2 = $('#opt2').attr('data-value', data);
			$('#opt2').html($(this).html());
		} else if(opt3 == null || opt3 == 'undefined' || opt3 == ''){
			var opt3 = $('#opt3').attr('data-value', data);
			$('#opt3').html($(this).html());
		}
		
		/*For score*/
		var page_item = 'page_item'+displayQuestion;
		var rightwordsarray = [];
		if(displayQuestion == 1) {
			rightwordsarray = rightwords[0].split('optionId');
			console.log($('#opt1').attr('data-value') ,"==", rightwordsarray[0]);
			if($('#opt1').attr('data-value') == rightwordsarray[0]){
				
				total ++;
				icon('qust'+displayQuestion, 'right', page_item);
				right_icon();
				qust1();
				disable_li();
			} else if(($('#opt1').attr('data-value') != '' || $('#opt1').attr('data-value') == null || $('#opt1').attr('data-value') == 'undefined')) {
				icon('qust'+displayQuestion, 'wrong', page_item);
				wrong_icon();
				qust1();
				disable_li();
			}
		} else if(displayQuestion == 2) {
			rightwordsarray = rightwords[1].split('optionId');
			console.log($('#opt2').attr('data-value')," == ",rightwordsarray[0]);
			if($('#opt2').attr('data-value') == rightwordsarray[0]){
				total ++;
				icon('qust'+displayQuestion, 'right', page_item);
				right_icon();
				qust2();
				disable_li();
			} else if($('#opt2').attr('data-value') != '' || $('#opt2').attr('data-value') == null || $('#opt2').attr('data-value') == 'undefined') {
				icon('qust'+displayQuestion, 'wrong', page_item);
				wrong_icon();
				qust2();
				disable_li();
			}
		} else if(displayQuestion == 3) {
			rightwordsarray = rightwords[2].split('optionId');
			if($('#opt3').attr('data-value') == rightwordsarray[0]){
				total ++;
				icon('qust'+displayQuestion, 'right', page_item);
				right_icon();
				qust3();
				disable_li();
			} else if(($('#opt3').attr('data-value') != '' || $('#opt3').attr('data-value') == null || $('#opt3').attr('data-value') == 'undefined')) {
				icon('qust'+displayQuestion, 'wrong', page_item);
				wrong_icon();
				qust3();
				disable_li();
			}
		}
	})

	function qust1() {
		displayQuestion = 2;
		setTimeout(function(){
			$('#qus1').addClass('animated fadeOutUp');
		}, 500);
		setTimeout(function(){
			$('.fontawesome_icon_wrong').addClass('show_rightwrong_icon animated fadeOut');
			$('.fontawesome_icon_right').addClass('show_rightwrong_icon animated fadeOut');
		}, 800);
		setTimeout(function(){
			$('#page_item2_link').addClass('active');
			enable_li();
			$('#qus1').addClass('qus1');
			$('#qus2').removeClass('qus2').addClass('animated fadeInUp');
			$('.fontawesome_icon_wrong, .fontawesome_icon_right').removeClass('animated fadeOut');
		}, 1300);
	}
	function qust2() {
		displayQuestion = 3;
		setTimeout(function(){
			$('#qus2').addClass('animated fadeOutUp');
		}, 500);
		setTimeout(function(){
			$('.fontawesome_icon_wrong').addClass('show_rightwrong_icon animated fadeOut');
			$('.fontawesome_icon_right').addClass('show_rightwrong_icon animated fadeOut');
		}, 800);
		setTimeout(function(){
			$('#page_item3_link').addClass('active');
			enable_li();
			$('#qus2').addClass('qus2');
			$('#qus3').removeClass('qus3').addClass('animated fadeInUp');
			$('.fontawesome_icon_wrong, .fontawesome_icon_right').removeClass('animated fadeOut');
		}, 1300);
	}
	function qust3() {
		setTimeout(function(){
			$('#qus5').addClass('animated fadeOutUp');
		}, 500);
		setTimeout(function(){
			$('.fontawesome_icon_wrong').addClass('show_rightwrong_icon animated fadeOut');
			$('.fontawesome_icon_right').addClass('show_rightwrong_icon animated fadeOut');
		}, 800);
		setTimeout(function(){
			enable_li();
			$('#qus3').addClass('qus3');
			$('#qust_section').addClass('qust_section').addClass('animated fadeOut');
			$('#cor_ans_section').removeClass('cor_ans_section').addClass('animated fadeIn');
			$('.fontawesome_icon_wrong, .fontawesome_icon_right').removeClass('animated fadeOut');
		}, 1300);
	}

	function right_icon(){
		/*$('.fontawesome_icon_right').removeClass('show_rightwrong_icon');
		$('.fontawesome_icon_wrong').addClass('show_rightwrong_icon');*/
	}
	function wrong_icon(){
		/*$('.fontawesome_icon_wrong').removeClass('show_rightwrong_icon');
		$('.fontawesome_icon_right').addClass('show_rightwrong_icon');*/
	}

	function disable_li(){
		$('li').addClass('disable_li');
	}

	function enable_li(){
		$('li').removeClass('disable_li');
	}

	function icon(qust_num, icon_type, page_item) {
		//if(qust_num == "qust1"){
			if(icon_type == "right")
				$('#'+page_item).html('<a class="page-link right" href="#" tabindex="-1"><i class="fa fa-check right_icon cyu_pagination_icon" aria-hidden="true"></i></a>');
			else
				$('#'+page_item).html('<a class="page-link wrong" href="#"><i class="fa fa-close wrong_icon cyu_pagination_icon" aria-hidden="true"></i></a>');
		//}	
	}

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
              console.log(data)
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

	            if(data.word1 != ''){
              	extrawords.push(data.word1);
	            }
              if(data.word2 != ''){
								extrawords.push(data.word2);
              }
							if(data.word3 != ''){
								extrawords.push(data.word3);
							}
							if(data.word4 != ''){
								extrawords.push(data.word4);
							}

              $.each(data, function(i, e){
                  //console.log(i," - ",e);
                  if(i == 'qust1') {
                    $.each(e, function(key, val){
                    	if(key == "qust1"){
                    		var textReplacetoIP = val.replace('[blank]', '<span class="opts mx-2 d-inline-block text-center" data-value="" id="opt1"></span>');
                    		$("#qus1_loop").append(textReplacetoIP.replace('<p>','<p class="w-100 d-inline-block">'));
                    		$('#pills-ca').append('<div class="row"> <div class="col-12 col-md-10 offset-md-1"> <div class="input-group mb-3">'+textReplacetoIP.replace('<p>','<p class="d-inline-block">')+' </div></div></div>')
                    	}
           		 	});
                    //console.log(e);
           		 	rightwords.push(e.optionId+'optionId'+e.right_word);                     
                  }
                  else if(i == 'qust2') {
                    $.each(e, function(key, val){
                    	if(key == "qust2"){
                    		var textReplacetoIP = val.replace('[blank]', '<span class="opts mx-2 d-inline-block text-center" data-value="" id="opt2"></span>');
                    		$("#qus2_loop").append(textReplacetoIP.replace('<p>','<p class="w-100 d-inline-block">'));
                    		$('#pills-ca').append('<div class="row"> <div class="col-12 col-md-10 offset-md-1"> <div class="input-group mb-3">'+textReplacetoIP.replace('<p>','<p class="w-100 d-inline-block">')+' </div></div></div>')
                    	} else if(key == "right_word"){
                    		//rightwords.push(val);
                    	}
           		 	});
           		 	rightwords.push(e.optionId+'optionId'+e.right_word);                     
                  }
                  else if(i == 'qust3') {
                    $.each(e, function(key, val){
                    	if(key == "qust3"){
                    		var textReplacetoIP = val.replace('[blank]', '<span class="opts mx-2 d-inline-block text-center" data-value="" id="opt3"></span>');
                    		$("#qus3_loop").append(textReplacetoIP.replace('<p>','<p class="w-100 d-inline-block">'));
                    		$('#pills-ca').append('<div class="row"> <div class="col-12 col-md-10 offset-md-1"> <div class="input-group mb-3">'+textReplacetoIP.replace('<p>','<p class="w-100 d-inline-block">')+' </div></div></div>')
                    	} else if(key == "right_word"){
                    		//rightwords.push(val);
                    	}
           		 	});
           		 	rightwords.push(e.optionId+'optionId'+e.right_word);                        
                  }
                });

              	

                var totWordsList = $.merge( $.merge( [], rightwords ), extrawords );
                totWordsList.sort(function() { return 0.5 - Math.random() });

                $i = 1;
						    $.each(totWordsList, function(key,val) {
						    	var finalOption = [];
						    	if(val.search('optionId') === 1) {
					    			finalOption = val.split('optionId');
						    	} else {
						    		finalOption[0] = 0;
						    		finalOption[1] = val; 
						    	}

					    		//if(key < 4)
					    			$("#word_list_row1").append(`<li class="btn_li" id="li`+$i+++`" data-optionId="`+finalOption[0]+`">`+finalOption[1]+`</li>`);
					    		/*else
					    			$("#word_list_row2").append(`<li class="btn_li" id="li`+$i+++`" data-optionId="`+finalOption[0]+`">`+finalOption[1]+`</li>`);*/
						    }); 

						    //appeneding right answer in the correct answer tab content
						    $.each(rightwords, function(key,val) {
						    	var splitOptions = val.split('optionId');
						    	if(key == 0)
					    			$('#pills-ca').find('#opt1').html(splitOptions[1]);
					    		else if(key == 1)
					    			$('#pills-ca').find('#opt2').html(splitOptions[1]);
					    		else if(key == 2)
					    			$('#pills-ca').find('#opt3').html(splitOptions[1]);
					    	});
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