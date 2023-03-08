$(function () {
	var correctAnswers = ["", "", ""];
	var correctAnswersText = ["", "", ""];
	var optTextArray = [];
	var textResult = '';
	$( "#sortable1" ).sortable({
      connectWith: ".connectedSortable",
      start: function( event, ui ) {
      	setTimeout(function(){
  				$('.ui-sortable-helper li').addClass('box_showdow'); 
    		}, 100)
      },
      stop: function(event, ui) {
      	$('tr li').removeClass('box_showdow'); 
        $('.connectedSortable').each(function() {
            result = "";
            textResult = "";
            $(this).find("tr").each(function(){
                result += $(this).attr('id') + ",";
                textResult += $(this).find('span').html() + ",";
                console.log($(this).find('span').html());
            });
            $("."+$(this).attr("id")+"#user_ans").val(result);
        });
      }
    });

	$('#layout_form').on('submit', function(event) {
    	event.preventDefault();
    
    	var result = $('#user_ans').val().split(',');
    	textResult = textResult.split(',');
    	console.log(textResult);
		if (result.length > 1) {
			setTimeout(function(){
				var total = 0;
				//correctAnswers = ["3", "1", "2"];
				for(var i = 0; i< result.length; i++) {
					console.log(optTextArray[i]);
					if(result[i] == "item"+correctAnswers[i] || textResult[i] == optTextArray[i]) {
						$("#last_td"+correctAnswers[i]).append('<span class="remove_html"><span class="fontawesome_icon fontawesome_icon_right animated fadein"><i class="fa fa-check" aria-hidden="true"></i></span></span>');
						total++;
					} else {
						$("#last_td"+correctAnswers[i]).append('<span class="remove_html"><span class="fontawesome_icon fontawesome_icon_wrong animated fadeIn"><i class="fa fa-close" aria-hidden="true"></i></span></span>');
					}
				}
				
				$('#next_btn').removeClass('next_btn').addClass('animated fadeIn');
			}, 1500)
			
			$('.qust_td').addClass('d-flex justify-content-end');
			$('.options_li').addClass('options_ans_li');
			$('#submit_btn').addClass('submit_btn');
		}
	});

	$('#next_btn').click(function(){
		//$("#pills-ca").html($("#copy_section_ca").html());
		$('#qust_section').removeClass('animated fadeIn');
		setTimeout(function(){
			$('#qust_section').addClass('qust_section').addClass('animated fadeOut');
			$('#cor_ans_section').removeClass('cor_ans_section').addClass('animated fadeIn');
			$('#next_btn').addClass('next_btn').removeClass('animated fadeIn');
			$('#submit_btn').removeClass('submit_btn');
			$('#user_ans').val("");
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

            var option1_val = "";
            var option2 = "";
            var option2_val = "";
            $.each(data, function(i, e){
          		//console.log(i," - ",e);
          		if(i == 'qust1') {
          			$.each(e, function(key, val){
          				if(key == "qust1"){
          					question = val;
          				}
        					else if(key == "opt1"){
        						option1 = val;
        					}
    						 	else if(key == "optId"){
    						 		option1_val = val;
    						 	}
    						 	else if(key == "opt2"){
    						 		option2 = val;
    						 	}
    						 	else{
    						 		option2_val = val;
    						 	}
						 		});

						 		qustarray.push(question);
						 		//console.log(option1);
						 		optarray.push(option1+'--optionId--'+option1_val);
						 		original_opt_array.push(option1_val);
						 		optTextArray.push(option1);

                $("#pills-ca").append(`<div class="d-flex align-items-center flex-wrap justify-content-center mb-3">
                  <div class="col-12 col-sm-6 col-md-6 p_75rem">`+question+` </div>
                  
                  <div class="col-6 col-sm-3 col-md-3 d-flex justify-content-start" id="last_td1">
                    <label class="btn options qust1_label d-flex align-items-center justify-content-center">
                    `+option1+`
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
    						 	else if(key == "optId"){
    						 		option1_val = val;
    						 	}
    						 	else if(key == "opt2"){
    						 		option2 = val;
    						 	}
    						 	else{
    						 		option2_val = val;
    						 	}
						 		});
						 		qustarray.push(question);
						 		optarray.push(option1+'--optionId--'+option1_val);
						 		original_opt_array.push(option1_val);
						 		optTextArray.push(option1);

                $("#pills-ca").append(`<div class="d-flex align-items-center flex-wrap justify-content-center mb-3">
                  <div class="col-12 col-sm-6 col-md-6 p_75rem">`+question+` </div>
                  
                  <div class="col-6 col-sm-3 col-md-3 d-flex justify-content-start" id="last_td1">
                    <label class="btn options qust1_label d-flex align-items-center justify-content-center">
                      `+option1+`
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
    						 	else if(key == "optId"){
    						 		option1_val = val;
    						 	}
    						 	else if(key == "opt2"){
    						 		option2 = val;
    						 	}
    						 	else{
    						 		option2_val = val;
    						 	}
						 		});
						 		qustarray.push(question);
						 		optarray.push(option1+'--optionId--'+option1_val);
						 		original_opt_array.push(option1_val);
						 		optTextArray.push(option1);

                $("#pills-ca").append(`<div class="d-flex align-items-center flex-wrap justify-content-center mb-3">
                  <div class="col-12 col-sm-6 col-md-6 p_75rem">`+question+` </div>
                  
                  <div class="col-6 col-sm-3 col-md-3 d-flex justify-content-start" id="last_td1">
                    <label class="btn options qust1_label d-flex align-items-center justify-content-center">
                      `+option1+`
                    </label>
                  </div>
                </div>`);                 
          		}
        		});

        		$('#submit_btn').removeClass('d-none').addClass('d-block');
        		console.log(optTextArray);

        		$.each(qustarray, function(key, val){
  						$("#questions tbody").append(`<tr class="d-flex align-items-center">
							  <td class="col-12 qust_td">
							    <ul>
							      <li class="qust_li">
							        <span class="d-flex align-items-center">`+val+`</span>
							      </li>
							    </ul>
							  </td>
							</tr>`);
        		});
        		
        		do {
        			var shuffle_options = shuffle(optarray);
        			console.log(shuffle_options,'------',optarray);
        		} while(shuffle_options != optarray);

        		console.log("original_opt_array - ", original_opt_array);
      			
      			$.each(original_opt_array, function(key, val){
      				var index = shuffle_options.indexOf(val);
      				console.log(key, val);
      				correctAnswers[key] = val;
      			});
      			console.log(correctAnswers);

        		$.each(shuffle_options, function(key, val){
        			var splitSuffleOption = val.split('--optionId--');
    					$("#options tbody").append(`<tr class="d-flex align-items-center" id="item`+splitSuffleOption[1]+`">
                  <td class="col-12" id="last_td`+splitSuffleOption[1]+`">
                    <ul>
                      <li class="active options_li">
                        <span class="d-flex align-items-center">`+splitSuffleOption[0]+`</span>
                      </li>
                    </ul>
                  </td>
                </tr>`);
      			});

        		

        		function shuffle(a) {
						    for (let i = a.length - 1; i > 0; i--) {
						        const j = Math.floor(Math.random() * (i + 1));
						        [a[i], a[j]] = [a[j], a[i]];

						        console.log(a[i],'------',a[j]);
						    }
						    return a;
						}
						//console.log("shuffle_options - ", shuffle_options);
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