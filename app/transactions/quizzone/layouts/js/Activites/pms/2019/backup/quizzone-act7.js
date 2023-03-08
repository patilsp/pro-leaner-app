$(function () {
	var scramble_word_array = [];
	var unscramble_word_array = [];
	var submit_scramble_word_index = "";
	var displayQuestion = 1;
	var scramble_word1 = "";
	
	var total = 0;
	$('#submit_btn').click(function(event){
		console.log("came");
		event.preventDefault();
		/*For score*/
		if(displayQuestion == 1) {
			var page_item = 'page_item1';
			console.log($('#qust1_ip').val().toUpperCase());
			if($('#qust1_ip').val().toUpperCase() == unscramble_word_array[0].toUpperCase()){
				total ++;
				icon('qust1', 'right', page_item);
				qust1();
			} else{
				icon('qust1', 'wrong', page_item);
				qust1();
			}
		} else if(displayQuestion == 2) {
			var page_item = 'page_item2';
			if($('#qust2_ip').val().toUpperCase() == unscramble_word_array[1].toUpperCase()){
				total ++;
				icon('qust2', 'right', page_item);
				qust2();
			} else{
				icon('qust2', 'wrong', page_item);
				qust2();
			}
		} else if(displayQuestion == 3) {
			var page_item = 'page_item3';
			if($('#qust3_ip').val().toUpperCase() == unscramble_word_array[2].toUpperCase()){
				total ++;
				icon('qust3', 'right', page_item);
				qust3();
			} else{
				icon('qust3', 'wrong', page_item);
				qust3();
			}
		}

		if(displayQuestion == 2)
			submit_scramble_word_index = scramble_word_array[1].toUpperCase();
		else if(displayQuestion == 3)
			submit_scramble_word_index = scramble_word_array[2].toUpperCase();
		
		unscram_word(displayQuestion, submit_scramble_word_index);
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
              
              var scramble_word = "";
              var unscramble_word = "";
              var fill_blank = "";
              var qust_part1 = "";
              var qust_part2 = "";
              //scramble_word_array
              $.each(data, function(i, e){
                  //console.log(i," - ",e);
                  if(i == 'qust1') {
                    $.each(e, function(key, val){
                    	if(key == "qust_part1"){
                    		$("#qus1_loop").append(`<div class="input-group-prepend">
		                      <span class="input-group-text">`+val+`</span>
		                    </div>`);
                    	} else if(key == "fill_blank"){
                    		$("#qus1_loop").append(`<input type="text" class="form-control" id="qust1_ip" value="">`);
                    	} else if(key == "qust_part2"){
                    		$("#qus1_loop").append(`<div class="input-group-prepend">
		                      <span class="input-group-text">`+val+`</span>
		                    </div>`);
                    	} else if(key == "scramble_word"){
                    		scramble_word_array.push(val);
                    	} else if(key == "unscramble_word"){
                    		unscramble_word_array.push(val);
                    	}
           		 	});                     
                  }
                  else if(i == 'qust2') {
                    $.each(e, function(key, val){
                    	if(key == "qust_part1"){
                    		$("#qus2_loop").append(`<div class="input-group-prepend">
		                      <span class="input-group-text">`+val+`</span>
		                    </div>`);
                    	} else if(key == "fill_blank"){
                    		$("#qus2_loop").append(`<input type="text" class="form-control" id="qust2_ip" value="">`);
                    	} else if(key == "qust_part2"){
                    		$("#qus2_loop").append(`<div class="input-group-prepend">
		                      <span class="input-group-text">`+val+`</span>
		                    </div>`);
                    	} else if(key == "scramble_word"){
                    		scramble_word_array.push(val);
                    	} else if(key == "unscramble_word"){
                    		unscramble_word_array.push(val);
                    	}
           		 	});                     
                  }
                  else if(i == 'qust3') {
                    $.each(e, function(key, val){
                    	if(key == "qust_part1"){
                    		$("#qus3_loop").append(`<div class="input-group-prepend">
		                      <span class="input-group-text">`+val+`</span>
		                    </div>`);
                    	} else if(key == "fill_blank"){
                    		$("#qus3_loop").append(`<input type="text" class="form-control" id="qust3_ip" value="">`);
                    	} else if(key == "qust_part2"){
                    		$("#qus3_loop").append(`<div class="input-group-prepend">
		                      <span class="input-group-text">`+val+`</span>
		                    </div>`);
                    	} else if(key == "scramble_word"){
                    		scramble_word_array.push(val);
                    	} else if(key == "unscramble_word"){
                    		unscramble_word_array.push(val);
                    	}
           		 	});                     
                  }
                });

              setTimeout(function(){
              	unscram_word(displayQuestion, scramble_word_array[0].toUpperCase());;
              }, 500)                  
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

    function unscram_word(qust_num, $scramble_word) {
		console.log(qust_num);
		if(qust_num === 1){
			$('#unscram_word').text($scramble_word).addClass('animated fadeIn');
			$('.bg_txt').text($scramble_word);
		}
		else if(qust_num === 2){
			setTimeout(function(){
				$('#unscram_word').text($scramble_word).addClass('animated fadeIn');
				$('.bg_txt').text($scramble_word);
			}, 1300);
		}
		else if(qust_num === 3){
			setTimeout(function(){
				$('#unscram_word').text($scramble_word).addClass('animated fadeIn');
				$('.bg_txt').text($scramble_word);
			}, 1300);
		}
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
			$('#qus1').addClass('animated fadeOutUp');
		}, 500);
		setTimeout(function(){
			$('#page_item2_link').addClass('active');
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
			$('#page_item3_link').addClass('active');
			$('#qus2').addClass('qus2');
			$('#qus3').removeClass('qus3').addClass('animated fadeInUp');
			$('.fontawesome_icon_wrong, .fontawesome_icon_right').removeClass('animated fadeOut');
		}, 1300);
	}
	function qust3() {
		$("#pills-ca").html($("#qust_blk_content").html());
		setTimeout(function(){
			$('#qus3').addClass('animated fadeOutUp');
		}, 500);
		setTimeout(function(){
			$('#qus3').addClass('qus3');
			$('#qust_section').addClass('qust_section').addClass('animated fadeOut');
			$('#cor_ans_section').removeClass('cor_ans_section').addClass('animated fadeIn');
			$('.fontawesome_icon_wrong, .fontawesome_icon_right').removeClass('animated fadeOut');
			document.getElementById('layout_form').reset();

			$('#pills-ca .questions').each(function(index, val) {
				console.log(index); 
				$(this).attr("style","display:block !important").removeClass('fadeOutUp fill_in_blank');
				if(index > 0)
					$(this).addClass("mt-4")
				$(this).find("#qust1_ip").val(unscramble_word_array[0])
				$(this).find("#qust2_ip").val(unscramble_word_array[1])
				$(this).find("#qust3_ip").val(unscramble_word_array[2])
          	});
		}, 1300);
	}
})