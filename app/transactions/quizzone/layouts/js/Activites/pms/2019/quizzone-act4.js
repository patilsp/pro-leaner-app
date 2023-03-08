$(function() {
	var bucketOptionValues = [];
    var displayQuestion = 1;
    var total
    total = 0;
    var radio_val;
    radio_val = "";
    $(document.body).on('change', 'input[type=radio]', function() {
        var radio_val = $(this).val();
        var page_item = 'page_item' + displayQuestion;
        var bucket_type = $(this).data('buckettype');
        console.log(bucket_type);

        if ($(this).prop('checked') == 1 && radio_val == 1) {
            total++;
            disable_li()
            icon('qust' + displayQuestion, 'right', page_item);
            $('#feedback .card-title').text("Correct:");
            feedback_msg(displayQuestion, radio_val, bucket_type);
            console.log("came");
            $('#feedback .card').addClass('right_feedback');
        } else {
            disable_li()
            icon('qust' + displayQuestion, 'wrong', page_item);
            $('#feedback .card-title').text("Incorrect:");
            feedback_msg(displayQuestion, radio_val, bucket_type);
            $('#feedback .card').addClass('wrong_feedback');
        }

        if (displayQuestion == 1) {
            disable_li()
            qust1();
            $('#img_option').val(bucketOptionValues[1].buck1);
            $('#img_option1').val(bucketOptionValues[1].buck2);
            document.getElementById('layout_form').reset();
        } else if (displayQuestion == 2) {
        	disable_li()
            qust2();
            $('#img_option').val(bucketOptionValues[2].buck1);
            $('#img_option1').val(bucketOptionValues[2].buck2);
            document.getElementById('layout_form').reset();
        } else if (displayQuestion == 3) {
            disable_li()
            qust3();
            document.getElementById('layout_form').reset();
        }/* else if (displayQuestion == 4) {
            disable_li()
            qust4();
            $('#img_option').val(bucketOptionValues[4].buck1);
            $('#img_option1').val(bucketOptionValues[4].buck2);
            document.getElementById('layout_form').reset();
        } else if (displayQuestion == 5) {
            disable_li()
            qust5();
            $('#img_option').val(bucketOptionValues[5].buck1);
            $('#img_option1').val(bucketOptionValues[5].buck2);
            document.getElementById('layout_form').reset();
        }*/

        $('#score_text').text(total + '/5');
        if (total == 5) {
            $('#score_text').removeClass().addClass('gold');
            $("#card_title").text("Well Done!");
            $("#card_image").attr("src", "../../../images/graphics/welldone.png");
        } else if (total >= 3) {
            $('#score_text').removeClass().addClass('sliver');
            $("#card_title").text("You are nearly there!");
            $("#card_image").attr("src", "../../../images/graphics/welldone.png");
        } else {
            $('#score_text').removeClass().addClass('bronze');
            $("#card_title").text("You can do better!");
            $("#card_image").attr("src", "../../../images/graphics/notdone.png");
        }

        $('#option_btn' + displayQuestion).addClass('animated fadeOut');
        setTimeout(function() {
            $('#option_btn' + displayQuestion).addClass('option_btn');
            $('#feedback').removeClass('feedback').addClass("animated fadeIn");
            $('#next_btn').removeClass('next_btn').addClass("animated fadeIn");
        }, 1000)

    });

    function feedback_msg(displayQuestion, radio_val, bucket_type) {
        console.log(bucket_type);
        if (displayQuestion == 1 && radio_val == 1) {
            if (bucket_type == "nfrdinnerbox")
                $('#' + bucket_type).append('<i class="fa fa-check red_icon"></i>');
            else
                $('#' + bucket_type).append('<i class="fa fa-check green_icon"></i>');
        } else if (displayQuestion == 1 && radio_val == 0) {
            if (bucket_type == "nfrdinnerbox")
                $('#' + bucket_type).append('<i class="fa fa-close red_icon"></i>');
            else
                $('#' + bucket_type).append('<i class="fa fa-close green_icon"></i>');
        }

        if (displayQuestion == 2 && radio_val == 1) {
            if (bucket_type == "nfrdinnerbox")
                $('#' + bucket_type).append('<i class="fa fa-check red_icon"></i>');
            else
                $('#' + bucket_type).append('<i class="fa fa-check green_icon"></i>');
        } else if (displayQuestion == 2 && radio_val == 0) {
            if (bucket_type == "nfrdinnerbox")
                $('#' + bucket_type).append('<i class="fa fa-close red_icon"></i>');
            else
                $('#' + bucket_type).append('<i class="fa fa-close green_icon"></i>');
        }

        if (displayQuestion == 3 && radio_val == 1) {
            if (bucket_type == "nfrdinnerbox")
                $('#' + bucket_type).append('<i class="fa fa-check red_icon"></i>');
            else
                $('#' + bucket_type).append('<i class="fa fa-check green_icon"></i>');
        } else if (displayQuestion == 3 && radio_val == 0) {
            if (bucket_type == "nfrdinnerbox")
                $('#' + bucket_type).append('<i class="fa fa-close red_icon"></i>');
            else
                $('#' + bucket_type).append('<i class="fa fa-close green_icon"></i>');
        }

        /*if (displayQuestion == 4 && radio_val == 1) {
            if (bucket_type == "nfrdinnerbox")
                $('#' + bucket_type).append('<i class="fa fa-check red_icon"></i>');
            else
                $('#' + bucket_type).append('<i class="fa fa-check green_icon"></i>');
        } else if (displayQuestion == 4 && radio_val == 0) {
            if (bucket_type == "nfrdinnerbox")
                $('#' + bucket_type).append('<i class="fa fa-close red_icon"></i>');
            else
                $('#' + bucket_type).append('<i class="fa fa-close green_icon"></i>');
        }

        if (displayQuestion == 5 && radio_val == 1) {
            if (bucket_type == "nfrdinnerbox")
                $('#' + bucket_type).append('<i class="fa fa-check red_icon"></i>');
            else
                $('#' + bucket_type).append('<i class="fa fa-check green_icon"></i>');
        } else if (displayQuestion == 5 && radio_val == 0) {
            if (bucket_type == "nfrdinnerbox")
                $('#' + bucket_type).append('<i class="fa fa-close red_icon"></i>');
            else
                $('#' + bucket_type).append('<i class="fa fa-close green_icon"></i>');
        }*/
    }


    function icon(qust_num, icon_type, page_item) {
        //if(qust_num == "qust1"){
        if (icon_type == "right")
            $('#' + page_item).html('<a class="page-link right" href="#" tabindex="-1"><i class="fa fa-check right_icon cyu_pagination_icon" aria-hidden="true"></i></a>');
        else
            $('#' + page_item).html('<a class="page-link wrong" href="#"><i class="fa fa-close wrong_icon cyu_pagination_icon" aria-hidden="true"></i></a>');
        //}	
    }

    function qust1() {
        displayQuestion = 2;
        setTimeout(function() {
            $('#qus1').addClass('animated fadeOut');
        }, 500);
        setTimeout(function() {
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
        setTimeout(function() {
            $('#qus2').addClass('animated fadeOut');
        }, 500);
        setTimeout(function() {
            enable_li();
            $('#page_item3_link').addClass('active');
            $('#qus2').addClass('qus2');
            $('#qus3').removeClass('qus3').addClass('animated fadeIn');
            $('.fontawesome_icon_wrong, .fontawesome_icon_right').removeClass('animated fadeOut');
        }, 1300);
    }

    function qust3() {
        /*displayQuestion = 4;
        setTimeout(function() {
            $('#qus3').addClass('animated fadeOut');
        }, 500);
        setTimeout(function() {
            enable_li();
            $('#page_item4_link').addClass('active');
            $('#qus3').addClass('qus3');
            $('#qus4').removeClass('qus4').addClass('animated fadeIn');
            $('.fontawesome_icon_wrong, .fontawesome_icon_right').removeClass('animated fadeOut');
        }, 1300);*/

        setTimeout(function() {
            $('#qus3').addClass('animated fadeOut');
        }, 500);
        setTimeout(function() {
            enable_li();
            $('#qus3').addClass('qus3');
            $('#qust_section').addClass('qust_section').addClass('animated fadeOut');
            $('#cor_ans_section').removeClass('cor_ans_section').addClass('animated fadeIn');
            $('.fontawesome_icon_wrong, .fontawesome_icon_right').removeClass('animated fadeOut');
            document.getElementById('layout_form').reset();
        }, 1300);
    }

    /*function qust4() {
        displayQuestion = 5;
        setTimeout(function() {
            $('#qus4').addClass('animated fadeOut');
        }, 500);
        setTimeout(function() {
            enable_li();
            $('#page_item5_link').addClass('active');
            $('#qus4').addClass('qus4');
            $('#qus5').removeClass('qus5').addClass('animated fadeIn');
            $('.fontawesome_icon_wrong, .fontawesome_icon_right').removeClass('animated fadeOut');
        }, 1300);
    }

    function qust5() {
        setTimeout(function() {
            $('#qus5').addClass('animated fadeOut');
        }, 500);
        setTimeout(function() {
            enable_li();
            $('#qus5').addClass('qus5');
            $('#qust_section').addClass('qust_section').addClass('animated fadeOut');
            $('#score_section').removeClass('score_section').addClass('animated fadeIn');
            $('.fontawesome_icon_wrong, .fontawesome_icon_right').removeClass('animated fadeOut');
            document.getElementById('layout_form').reset();
        }, 1300);
    }*/

    function disable_li() {
        $('#frd_nfrd_blk').addClass('disable_li');
    }

    function enable_li() {
        $('#frd_nfrd_blk').removeClass('disable_li');
    }



    $('#layout_form').on('submit', function(event) {
        event.preventDefault();

        $('#submit_btn').addClass('submit_btn');
        $('#qust_section').removeClass('animated fadeIn');

        setTimeout(function() {
            $('#qust_section').addClass('qust_section').addClass('animated fadeOut');
            $('#score_section').removeClass('score_section').addClass('animated fadeIn');
            $('#submit_btn').removeClass('submit_btn');
            $('.qust1_label, .qust2_label, .qust3_label, .qust4_label').removeClass('active');
            document.getElementById('layout_form').reset();
        }, 500);
    });

    $('.cor_ans_btn').click(function() {
        $('#score_section').removeClass('animated fadeIn');
        $('#cor_ans_section').removeClass('animated fadeOut');
        setTimeout(function() {
            $('#score_section').addClass('animated fadeOut');
        }, 500);
        setTimeout(function() {
            $('#score_section').addClass('score_section');
            $('#cor_ans_section').removeClass('cor_ans_section').addClass('animated fadeIn');
        }, 1000);
    });

    $('.go_back_btn').click(function() {
        $('#score_section').removeClass('animated fadeOut');
        $('#cor_ans_section').removeClass('animated fadeIn');
        setTimeout(function() {
            $('#cor_ans_section').addClass('animated fadeOut');
        }, 500);
        setTimeout(function() {
            $('#cor_ans_section').addClass('cor_ans_section');
            $('#score_section').removeClass('score_section').addClass('animated fadeIn');
        }, 1000);
    });

    $('.try_again').click(function() {
        displayQuestion = 1;
        total = 0;
        $('.page-item').html('');
        $('#qust_section').removeClass('animated fadeOut');
        $('#score_section').removeClass('animated fadeIn');
        $('#score_section').removeClass('animated fadeOut');
        $('#option_btn1, #option_btn2, #option_btn3, #option_btn4, #option_btn5').removeClass('animated fadeIn fadeOut');
        $('#frdinnerbox, #nfrdinnerbox').html('');
        $('#qus1, #qus2, #qus3, #qus4, #qus5').removeClass('qus1 animated fadeIn fadeOut');
        setTimeout(function() {
            $('#score_section').addClass('animated fadeOut');
        }, 500);
        setTimeout(function() {
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
                $(".exp_img").attr("src", data.exp_img);
                $(".exp_content").html(data.explanation);

                $("#explanation1").html(data.explanation.exp1);
                $("#explanation2").html(data.explanation.exp2);
                $("#explanation3").html(data.explanation.exp3);

                if(data.bucketOptionsText.bkOpt1 !== '' && data.bucketOptionsText.bkOpt2 !== '') {
	                $('#buck1Title').text(data.bucketOptionsText.bkOpt1);
	                $('#buck2Title').text(data.bucketOptionsText.bkOpt2);
	                $('.cor_green').text(data.bucketOptionsText.bkOpt1);
	                $('.cor_red').text(data.bucketOptionsText.bkOpt2);
                }

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
                    ////console.log(i," - ",e);
                    var obj = {};
                    if (i == 'qust1') {
                        $.each(e, function(key, val) {
                            if (key == "qust1") {
                                question = val;
                            } else if (key == "opt1_ans") {
                            	obj['buck1'] = val;
							} else {
                                obj['buck2'] = val;
                            }
                        });
                        bucketOptionValues.push(obj);
                        $("#qust_col").append(`<div id="qus1" class="d-flex justify-content-center text-center">
					                                <span class="m-1 text-white">` + question + `</span>
					                            </div>`);
                        var correctAnsBuck1 = '';
                        var correctAnsBuck2 = '';
                        if(obj['buck1'] == 1)
                        	correctAnsBuck1 = `<li>` + question + `</li>`;
                        else
                        	correctAnsBuck2 = `<li>` + question + `</li>`;

                        $('#correctAnsBuck1').append(correctAnsBuck1);
                        $('#correctAnsBuck2').append(correctAnsBuck2);
                    } else if (i == 'qust2') {
                        $.each(e, function(key, val) {
                            if (key == "qust2") {
                                question = val;
                            } else if (key == "opt1_ans") {
                            	obj['buck1'] = val;
							} else {
                                obj['buck2'] = val;
                            }
                        });
                        bucketOptionValues.push(obj);
                        $("#qust_col").append(`<div id="qus2" class="qus2 d-flex justify-content-center text-center">
					                                <span class="m-1 text-white">` + question + `</span>
					                            </div>`);

                        var correctAnsBuck1 = '';
                        var correctAnsBuck2 = '';
                        if(obj['buck1'] == 1)
                        	correctAnsBuck1 = `<li>` + question + `</li>`;
                        else
                        	correctAnsBuck2 = `<li>` + question + `</li>`;

                        $('#correctAnsBuck1').append(correctAnsBuck1);
                        $('#correctAnsBuck2').append(correctAnsBuck2);
                    } else if (i == 'qust3') {
                        $.each(e, function(key, val) {
                            if (key == "qust3") {
                                question = val;
                            } else if (key == "opt1_ans") {
                            	obj['buck1'] = val;
							} else {
                                obj['buck2'] = val;
                            }
                        });
                        bucketOptionValues.push(obj);
                        $("#qust_col").append(`<div id="qus3" class="qus3 d-flex justify-content-center text-center">
					                                <span class="m-1 text-white">` + question + `</span>
					                            </div>`);

                        var correctAnsBuck1 = '';
                        var correctAnsBuck2 = '';
                        if(obj['buck1'] == 1)
                        	correctAnsBuck1 = `<li>` + question + `</li>`;
                        else
                        	correctAnsBuck2 = `<li>` + question + `</li>`;

                        $('#correctAnsBuck1').append(correctAnsBuck1);
                        $('#correctAnsBuck2').append(correctAnsBuck2);
                    }
                });
                $('#submit_btn').removeClass('d-none').addClass('d-block');

                $('#img_option').val(bucketOptionValues[0].buck1);
				$('#img_option1').val(bucketOptionValues[0].buck2);
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