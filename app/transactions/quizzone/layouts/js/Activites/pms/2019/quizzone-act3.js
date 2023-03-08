$(function () {
	var rightwords = [];
	var extrawords = [];
	var displayQuestion = 1;
	var total = 0;
	$(document).on('click', '.btn_li', function(){
		var data = $(this).text();
		var opt1 = $('#opt1').val();
		var opt2 = $('#opt2').val();
		var opt3 = $('#opt3').val();


		if(opt1 == null || opt1 == 'undefined' || opt1 == '') {
			var opt1 = $('#opt1').val(data);
		} else if(opt2 == null || opt2 == 'undefined' || opt2 == ''){
			var opt2 = $('#opt2').val(data);
		} else if(opt3 == null || opt3 == 'undefined' || opt3 == ''){
			var opt3 = $('#opt3').val(data);
		}

		/*For score*/
		if(displayQuestion == 1) {
			if($('#opt1').val() == rightwords[0]){
				total ++;
				right_icon();
				qust1();
				disable_li();
			} else if(($('#opt1').val() != '' || $('#opt1').val() == null || $('#opt1').val() == 'undefined')) {
				wrong_icon();
				qust1();
				disable_li();
			}
		} else if(displayQuestion == 2) {
			if($('#opt2').val() == rightwords[1]){
				total ++;
				right_icon();
				qust2();
				disable_li();
			} else if($('#opt2').val() != '' || $('#opt2').val() == null || $('#opt2').val() == 'undefined') {
				wrong_icon();
				qust2();
				disable_li();
			}
		} else if(displayQuestion == 3) {
			if($('#opt3').val() == rightwords[2]){
				total ++;
				right_icon();
				qust3();
				disable_li();
			} else if(($('#opt3').val() != '' || $('#opt3').val() == null || $('#opt3').val() == 'undefined')) {
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
			enable_li();
			$('#qus2').addClass('qus2');
			$('#qus3').removeClass('qus3').addClass('animated fadeInUp');
			$('.fontawesome_icon_wrong, .fontawesome_icon_right').removeClass('animated fadeOut');
		}, 1300);
	}
	function qust3() {
		$("#pills-ca").html($("#copy_section_ca").html());
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
			
			$('#pills-ca .row').each(function(index, val) {
				console.log(index); 
				$(this).attr("style","display:block !important").removeClass('fadeOutUp fill_in_blank');
				if(index > 0)
					$(this).addClass("mt-4")
				$(this).find("#opt1").val(rightwords[0])
				$(this).find("#opt2").val(rightwords[1])
				$(this).find("#opt3").val(rightwords[2])
          	});
		}, 1300);
	}

	function right_icon(){
		$('.fontawesome_icon_right').removeClass('show_rightwrong_icon');
		$('.fontawesome_icon_wrong').addClass('show_rightwrong_icon');
	}
	function wrong_icon(){
		$('.fontawesome_icon_wrong').removeClass('show_rightwrong_icon');
		$('.fontawesome_icon_right').addClass('show_rightwrong_icon');
	}

	function disable_li(){
		$('li').addClass('disable_li');
	}

	function enable_li(){
		$('li').removeClass('disable_li');
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
                    	if(key == "qust_part1"){
                    		$("#qus1_loop").append(`<div class="input-group-prepend">
		                      <span class="input-group-text">`+val+`</span>
		                    </div>`);
                    	} else if(key == "fill_blank"){
                    		$("#qus1_loop").append(`<input type="text" class="form-control" id="opt1" value="" disabled>`);
                    		rightwords.push(val);
                    	} else if(key == "qust_part2"){
                    		$("#qus1_loop").append(`<div class="input-group-prepend">
		                      <span class="input-group-text">`+val+`</span>
		                    </div>`);
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
                    		$("#qus2_loop").append(`<input type="text" class="form-control" id="opt2" value="" disabled>`);
                    		rightwords.push(val);
                    	} else if(key == "qust_part2"){
                    		$("#qus2_loop").append(`<div class="input-group-prepend">
		                      <span class="input-group-text">`+val+`</span>
		                    </div>`);
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
                    		$("#qus3_loop").append(`<input type="text" class="form-control" id="opt3" value="" disabled>`);
                    		rightwords.push(val);
                    	} else if(key == "qust_part2"){
                    		$("#qus3_loop").append(`<div class="input-group-prepend">
		                      <span class="input-group-text">`+val+`</span>
		                    </div>`);
                    	}
           		 	});                     
                  }
                });

              	

                var totWordsList = $.merge( $.merge( [], rightwords ), extrawords );
                totWordsList.sort(function() { return 0.5 - Math.random() });

                $i = 1;
						    $.each(totWordsList, function(key,val) {
					    		if(key < 4)
					    			$("#word_list_row1").append(`<li class="btn_li" id="li`+$i+++`">`+val+`</li>`);
					    		else
					    			$("#word_list_row2").append(`<li class="btn_li" id="li`+$i+++`">`+val+`</li>`);
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