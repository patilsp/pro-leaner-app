$(function () {
	var bucketOptionValues = [];
	var displayQuestion = 1;
	var total
	total = 0;
	var qust_option = [];
	$(document).on("click", ".character",function(){
		var data = $(this).data('val');
		console.log(data);
		//if(displayQuestion == 1){
			var ip1 = $('#bind_box1').text();
			var ip2 = $('#bind_box2').text();
			var ip3 = $('#bind_box3').text();
			var ip4 = $('#bind_box4').text();
			var ip5 = $('#bind_box5').text();
			var ip6 = $('#bind_box6').text();
			var ip7 = $('#bind_box7').text();

			var anslength = 0;
			if(displayQuestion == 1){
				anslength  = bucketOptionValues['q1ans'].length
			} else if(displayQuestion == 2){
				anslength  = bucketOptionValues['q2ans'].length
			} else if(displayQuestion == 3){
				anslength  = bucketOptionValues['q3ans'].length
			}
			
			if(ip1 == "" && 1 <= anslength){
				$('#bind_box1').text(data);
				qust_option.push(data);
			}
			else if(ip2 == "" && 2 <= anslength){
				$('#bind_box2').text(data);
				qust_option.push(data);
			}
			else if(ip3 == "" && 3 <= anslength){
				$('#bind_box3').text(data);
				qust_option.push(data);
			}
			else if(ip4 == "" && 4 <= anslength){
				$('#bind_box4').text(data);
				qust_option.push(data);
			}
			else if(ip5 == "" && 5 <= anslength){
				$('#bind_box5').text(data);
				qust_option.push(data);
			}
			else if(ip6 == "" && 6 <= anslength){
				$('#bind_box6').text(data);
				qust_option.push(data);
			}
			else if(ip7 == "" && 7 <= anslength){
				$('#bind_box7').text(data);
				qust_option.push(data);
			}

			console.log(qust_option.length ,"=====", anslength);
			if(qust_option.length === anslength){
				$('#submit_btn').removeClass('submit_btn');
			}
		//}
	});

	$('#back_btn').click(function(){
		var ip1 = $('#bind_box1').text();
		var ip2 = $('#bind_box2').text();
		var ip3 = $('#bind_box3').text();
		var ip4 = $('#bind_box4').text();
		var ip5 = $('#bind_box5').text();
		var ip6 = $('#bind_box6').text();
		var ip7 = $('#bind_box7').text();

		//console.log(qust_option);
		/*for(var i = 0; i < qust_option.length; i++) {
			console.log(qust_option[i]);
		}*/
		//qust_option.pop();
		//qust_option = []; //declaring empty array
		qust_option.pop(); 
		
		if(ip7 != ""){
			$('#bind_box7').text('');
			console.log(ip7);
		}
		else if(ip6 != ""){
			$('#bind_box6').text('');
			console.log(ip6);
		}
		else if(ip5 != ""){
			$('#bind_box5').text('');
			console.log(ip5);
		}
		else if(ip4 != ""){
			$('#bind_box4').text('');
			console.log(ip4);
		}
		else if(ip3 != ""){
			$('#bind_box3').text('');
			console.log(ip3);
		}
		else if(ip2 != ""){
			$('#bind_box2').text('');
			console.log(ip2);
		}
		else{
			$('#bind_box1').text('');
			console.log(ip1);
		}
		$('#submit_btn').addClass('submit_btn');
	});

	$('#submit_btn').click(function(){
		var enterArrayString = qust_option + "";
		var finalVal = enterArrayString.replace(/,/g , '') 
		var page_item = 'page_item'+displayQuestion;
		disable_li();
		$('#submit_btn').addClass('submit_btn');
		$(document).find('.qust'+displayQuestion+'_opt').remove();

		if(displayQuestion == 1){
			
			if(finalVal == bucketOptionValues['q1ans']){
				icon('qust'+displayQuestion, 'right', page_item);
				total++;
			} else{
				icon('qust'+displayQuestion, 'wrong', page_item);
			}
			$('#bind_section').html('');
			qust1();
		}
		else if(displayQuestion == 2){
			if(finalVal == bucketOptionValues['q2ans']){
				icon('qust'+displayQuestion, 'right', page_item);
				total++;
			} else{
				icon('qust'+displayQuestion, 'wrong', page_item);
			}
			$('#bind_section').html('');
			qust2();
		}
		else if(displayQuestion == 3){
			if(finalVal == bucketOptionValues['q3ans']){
				icon('qust'+displayQuestion, 'right', page_item);
				total++;
			} else{
				icon('qust'+displayQuestion, 'wrong', page_item);
			}
			$('#bind_section').html('');
			qust3();
		}
		$('.bind_box').text('');
		console.log(total);
		$('#score_text').text(total +' out of 3');
		if(total == 3){
			$("#act_title").text("Well done!")
			$("#act_image").attr("src", "../../../images/graphics/welldone.png");
		}else{
			$("#act_title").text("Not done!");
			$("#act_image").attr("src", "../../../images/graphics/notdone.png");
		}

	});

	function icon(qust_num, icon_type, page_item) {
		if(icon_type == "right")
			$('#'+page_item).html('<a class="page-link right" href="#" tabindex="-1"><i class="fa fa-check right_icon cyu_pagination_icon" aria-hidden="true"></i></a>');
		else
			$('#'+page_item).html('<a class="page-link wrong" href="#"><i class="fa fa-close wrong_icon cyu_pagination_icon" aria-hidden="true"></i></a>');
	}

	function qust1() {
		displayQuestion = 2;
		qust_option = [];
		generate_chars(displayQuestion);
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
		displayQuestion = 3;
		qust_option = [];
		generate_chars(displayQuestion);
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
		qust_option = [];
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
		$('#keypad').addClass('disable_li');
	}

	function enable_li(){
		$('#keypad').removeClass('disable_li');
	}

	function generate_chars(question_no){
		var array = genCharArray('a', 'z');
		var myarray = [];
		if(question_no == 1){
			var ipBoxs = bucketOptionValues['q1ans'].length
			for (var i=1; i<=ipBoxs; i++) {
				$('#bind_section').append('<div class="bind_box" id="bind_box'+i+'"></div>')
			}
			//myarray = ['o','n','e','d','e','f','g'];
			for ( var i = 0; i < ipBoxs.length; i++ )
			{
				myarray.push(bucketOptionValues['q1ans'].charAt(i));
			}
		}
		else if(question_no == 2){
			var ipBoxs = bucketOptionValues['q2ans'].length
			for (var i=1; i<=ipBoxs; i++) {
				$('#bind_section').append('<div class="bind_box" id="bind_box'+i+'"></div>')
			}
			//myarray = ['o','n','e','d','e','f','g'];
			for ( var i = 0; i < ipBoxs.length; i++ )
			{
				myarray.push(bucketOptionValues['q2ans'].charAt(i));
			}
		}
		else if(question_no == 3){
			var ipBoxs = bucketOptionValues['q3ans'].length
			for (var i=1; i<=ipBoxs; i++) {
				$('#bind_section').append('<div class="bind_box" id="bind_box'+i+'"></div>')
			}
			//myarray = ['o','n','e','d','e','f','g'];
			for ( var i = 0; i < ipBoxs.length; i++ )
			{
				myarray.push(bucketOptionValues['q3ans'].charAt(i));
			}
		}


		for(var i=0; i<array.length; i++) {
		  myarray.push(array[i]);
		}
		var myarray = shuffle(myarray);
		for (var i=0; i<myarray.length; i++) {
		  $('#keypad ul').prepend('<li class="character qust'+question_no+'_opt" data-val="'+myarray[i]+'">'+myarray[i]+'</li>')
		}
	}

	function genCharArray(charA, charZ) {
	    var a = [], i = charA.charCodeAt(0), j = charZ.charCodeAt(0);
	    for (; i <= j; ++i) {
	        a.push(String.fromCharCode(i));
	    }
	    return a;
	}

	function shuffle(myarray) {
	    /*for (let i = myarray.length - 1; i > 0; i--) {
	        const j = Math.floor(Math.random() * (i + 1));
	        [myarray[i], myarray[j]] = [myarray[j], myarray[i]];
	    }*/

	    for (var i = myarray.length; i>0; i--) {
			var j = Math.floor(Math.random() * i);
			var _ref = [myarray[j], myarray[i - 1]];
			myarray[i - 1] = _ref[0];
			myarray[j] = _ref[1];
		}
	    return myarray;
	}

	$('.cor_ans_btn').click(function(){
		$('#score_section').removeClass('animated fadeIn');
		$('#cor_ans_section').removeClass('animated fadeOut');
		setTimeout(function(){
			$('#score_section').addClass('animated fadeOut');
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
		displayQuestion = 1;
		generate_chars(displayQuestion);
		total = 0;
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
                $(".act_title").html(data.act_title);
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
                        bucketOptionValues['q1ans'] = e.ans_box1+''+e.ans_box2+''+e.ans_box3+''+e.ans_box4+''+e.ans_box5+''+e.ans_box6+''+e.ans_box7;

                        $("#qust_col").append(`
                        	<div id="qus1" class="d-flex justify-content-center text-center">
                                ` + e.qust1 + `
                            </div>
                        `);

                        $('#cor_ans_table').append(`
                        	<tr>
                                <td class="ca_qust">` + e.qust1 + `</td>
                                <td class="ca_ans">` + bucketOptionValues['q1ans'] + `</td>
                            </tr>
                    	`);
                    } else if (i == 'qust2') {
                        bucketOptionValues['q2ans'] = e.ans_box1+''+e.ans_box2+''+e.ans_box3+''+e.ans_box4+''+e.ans_box5+''+e.ans_box6+''+e.ans_box7;

                        $("#qust_col").append(`
                        	<div id="qus2" class="qus2 d-flex justify-content-center text-center">
                                ` + e.qust2 + `
                            </div>
                        `);

                        $('#cor_ans_table').append(`
                        	<tr>
                                <td class="ca_qust">` + e.qust2 + `</td>
                                <td class="ca_ans">` + bucketOptionValues['q2ans'] + `</td>
                            </tr>
                    	`);
                    } else if (i == 'qust3') {
                        bucketOptionValues['q3ans'] = e.ans_box1+''+e.ans_box2+''+e.ans_box3+''+e.ans_box4+''+e.ans_box5+''+e.ans_box6+''+e.ans_box7;

                        $("#qust_col").append(`
                        	<div id="qus3" class="qus3 d-flex justify-content-center text-center">
                                ` + e.qust3 + `
                            </div>
                        `);

                        $('#cor_ans_table').append(`
                        	<tr>
                                <td class="ca_qust">` + e.qust3 + `</td>
                                <td class="ca_ans">` + bucketOptionValues['q3ans'] + `</td>
                            </tr>
                    	`);
                    }
                });
                $('#submit_btn').removeClass('d-none').addClass('d-block');

				console.log(bucketOptionValues);
				console.log(typeof(bucketOptionValues['q1ans']));

				generate_chars(displayQuestion);
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