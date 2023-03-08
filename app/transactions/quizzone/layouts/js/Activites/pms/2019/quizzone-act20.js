$(function () {
    var bucketOptionValues = [];
    var t;
    var pause = false;
    var first_time = 0;

    
	var total
	total = 0;
    var box1_static_arr = new Array();
    var box2_static_arr = new Array();
    var box3_static_arr = new Array();
    var images_prefix = "../../../images/graphics/zigsaw/";
    
    var data = [
    {
        "ref"        : "img1_1",
        "image_path" : images_prefix + "G4_PA_Act2 - 1-30.png"
    },
    {
        "ref"        : "img1_2",
        "image_path" : images_prefix + "G4_PA_Act2 - 1-31.png"
    },
    {
        "ref"        : "img1_3",
        "image_path" : images_prefix + "G4_PA_Act2 - 1-32.png"
    },
    {
        "ref"        : "img1_4",
        "image_path" : images_prefix + "G4_PA_Act2 - 1-33.png"
    },

    {
        "ref"        : "img2_1",
        "image_path" : images_prefix + "G4_PA_Act2 - 2-30.png"
    },
    {
        "ref"        : "img2_2",
        "image_path" : images_prefix + "G4_PA_Act2 - 2-31.png"
    },
    {
        "ref"        : "img2_3",
        "image_path" : images_prefix + "G4_PA_Act2 - 2-32.png"
    },
    {
        "ref"        : "img2_4",
        "image_path" : images_prefix + "G4_PA_Act2 - 2-33.png"
    },

    {
        "ref"        : "img3_1",
        "image_path" : images_prefix + "G4_PA_Act2 - 3-30.png"
    },
    {
        "ref"        : "img3_2",
        "image_path" : images_prefix + "G4_PA_Act2 - 3-31.png"
    },
    {
        "ref"        : "img3_3",
        "image_path" : images_prefix + "G4_PA_Act2 - 3-32.png"
    },
    {
        "ref"        : "img3_4",
        "image_path" : images_prefix + "G4_PA_Act2 - 3-33.png"
    }
    ];

    $("#dvSource img").draggable({
        revert: "invalid",
        helper: 'clone',
        refreshPositions: true,
        drag: function (event, ui) {
            ui.helper.addClass("draggable");
        },
        stop: function (event, ui) {
            ui.helper.removeClass("draggable");
            var image = this.src.split("/")[this.src.split("/").length - 1];
            var valu = $(this).attr('value');
            var categories = $(this).attr('value');
            var category_type = $(this).closest('div').attr('value');

            if (categories == category_type)
	        	total++;

	        $('#score_text').text(total +' out of 9');
            setTimeout(function () {
                var temp_drop_box_val = $("#temp_drop_box").find('img').attr("value");
                if(temp_drop_box_val == undefined || temp_drop_box_val == null)
                    $("#submit_btn").removeClass("submit_btn");
                else
                    $("#submit_btn").addClass("submit_btn");
            }, 1000)
        }
    });



    $(".dragable_image_div").droppable({
        over: function(event, ui) {
            $(this).addClass('highlighter_focus_in');
            $(this).removeClass('highlighter_focus_out');
        },
        out: function(event, ui) {
            $(this).addClass('highlighter_focus_out');
            $(this).removeClass('highlighter_focus_in');
        },
        drop: function (event, ui) {
            $(this).removeClass('highlighter_focus_in');
            $(this).addClass('highlighter_focus_dropped');
            if ($("#"+$(this).attr("id")+" img").length == 0) {
                $(this).html("");
            }

            $(this).append(ui.draggable);
        }
    });
    $("#temp_drop_box").droppable({
    	over: function(event, ui) {
            $(this).addClass('highlighter_focus_in');
            $(this).removeClass('highlighter_focus_out');
        },
        out: function(event, ui) {
           	$(this).addClass('highlighter_focus_out');
         	$(this).removeClass('highlighter_focus_in');
        },
        drop: function (event, ui) {
        	$(this).removeClass('highlighter_focus_in');
            $(this).addClass('highlighter_focus_dropped');
            if ($("#temp_drop_box img").length == 0) {
                $("#temp_drop_box").html("");
            }

            if(first_time === 0){
                first_time++;
                startOrResumeTime(0,0,0);
            }
            
            

            $("#temp_drop_box").append(ui.draggable);
        }
 	});

    function startOrResumeTime(m,s) {
        s = parseInt(s);
        m = parseInt(m);
        if(++s==60){
          s=0;
          if(++m==60){
            m=0;
          }
        }
      
        if(!pause){
          if(m<10) m='0'+m;
          if(s<10) s='0'+s;
          document.getElementById('timer').innerHTML = m+":"+s;
          t = setTimeout(function(){startOrResumeTime(m,s)},1000);
        }
    }

    $("#submit_btn").click(function(){
        pause = true;

        var box1_img = [];
        var box2_img = [];
        var box3_img = [];
        $('.box1_img').each(function(){
          box1_img.push($(this).find('img').attr("value"));
        });
        $('.box2_img').each(function(){
          box2_img.push($(this).find('img').attr("value"));
        });
        $('.box3_img').each(function(){
          box3_img.push($(this).find('img').attr("value"));
        });
        
        var box1_status = 0;
        var box2_status = 0;
        var box3_status = 0;
        $.each( box1_static_arr, function( key, value ) {
            if(box1_static_arr[key] != box1_img[key])
                box1_status++;
        });

        if(box1_status > 0){
            $.each( box2_static_arr, function( key, value ) {
                if(box2_static_arr[key] != box1_img[key])
                    box1_status++;
                else
                    box1_status = 0;
            });
        }

        if(box1_status > 0){
            $.each( box3_static_arr, function( key, value ) {
                if(box3_static_arr[key] != box1_img[key])
                    box1_status++;
                else
                    box1_status = 0;
            });
        }

        $.each( box1_static_arr, function( key, value ) {
            if(box1_static_arr[key] != box2_img[key])
                box2_status++;
        });

        if(box2_status > 0){
            $.each( box2_static_arr, function( key, value ) {
                if(box2_static_arr[key] != box2_img[key])
                    box2_status++;
                else
                    box2_status = 0;
            });
        }

        if(box2_status > 0){
            $.each( box3_static_arr, function( key, value ) {
                if(box3_static_arr[key] != box2_img[key])
                    box2_status++;
                else
                    box2_status = 0;
            });
        }


        $.each( box1_static_arr, function( key, value ) {
            if(box1_static_arr[key] != box3_img[key])
                box3_status++;
        });

        if(box3_status > 0){
            $.each( box2_static_arr, function( key, value ) {
                if(box2_static_arr[key] != box3_img[key])
                    box3_status++;
                else
                    box3_status = 0;
            });
        }

        if(box3_status > 0){
            $.each( box3_static_arr, function( key, value ) {
                if(box3_static_arr[key] != box3_img[key])
                    box3_status++;
                else
                    box3_status = 0;
            });
        }

        if(box1_status === 0 && box2_status === 0 && box3_status === 0){
            $("#modal_img").attr("src", "../../../images/graphics/welldone.png");
            $("#modal_title").text("Well Done! You have completed in just "+$('#timer').text());
            $("#modal_info").text("You are quite sharp.");
        } else {
            $("#modal_img").attr("src", "../../../images/graphics/notdone.png");
            $("#modal_title").text("Not Done!");
            $("#modal_info").text("Try to Complete."); 
        }

        $("#StatusModal").modal("show");
    })
    
    $("#next_btn").click(function(){
        location.reload();
    })

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
                        obj['ref'] = e.qustImgOpt1Ref;
                        obj['image_path'] = e.qustImgOpt1;
                        bucketOptionValues.push(obj);
                        obj = {};

                        obj['ref'] = e.qustImgOpt2Ref;
                        obj['image_path'] = e.qustImgOpt2;
                        bucketOptionValues.push(obj);
                        obj = {};

                        obj['ref'] = e.qustImgOpt3Ref;
                        obj['image_path'] = e.qustImgOpt3;
                        bucketOptionValues.push(obj);
                        obj = {};

                        obj['ref'] = e.qustImgOpt4Ref;
                        obj['image_path'] = e.qustImgOpt4;
                        bucketOptionValues.push(obj);
                        obj = {};
                    } else if (i == 'qust2') {
                        obj['ref'] = e.qustImgOpt1Ref;
                        obj['image_path'] = e.qustImgOpt1;
                        bucketOptionValues.push(obj);
                        obj = {};

                        obj['ref'] = e.qustImgOpt2Ref;
                        obj['image_path'] = e.qustImgOpt2;
                        bucketOptionValues.push(obj);
                        obj = {};

                        obj['ref'] = e.qustImgOpt3Ref;
                        obj['image_path'] = e.qustImgOpt3;
                        bucketOptionValues.push(obj);
                        obj = {};

                        obj['ref'] = e.qustImgOpt4Ref;
                        obj['image_path'] = e.qustImgOpt4;
                        bucketOptionValues.push(obj);
                        obj = {};
                    } else if (i == 'qust3') {
                        obj['ref'] = e.qustImgOpt1Ref;
                        obj['image_path'] = e.qustImgOpt1;
                        bucketOptionValues.push(obj);
                        obj = {};

                        obj['ref'] = e.qustImgOpt2Ref;
                        obj['image_path'] = e.qustImgOpt2;
                        bucketOptionValues.push(obj);
                        obj = {};

                        obj['ref'] = e.qustImgOpt3Ref;
                        obj['image_path'] = e.qustImgOpt3;
                        bucketOptionValues.push(obj);
                        obj = {};

                        obj['ref'] = e.qustImgOpt4Ref;
                        obj['image_path'] = e.qustImgOpt4;
                        bucketOptionValues.push(obj);
                        obj = {};
                    }
                });
                $('#submit_btn').removeClass('d-none').addClass('d-block');

                console.log(bucketOptionValues);

                //Get All References
                var allRefs = new Array();
                bucketOptionValues.forEach(function (item) {
                    allRefs.push(item.ref);
                });

                box1_static_arr = allRefs.slice(0, 4);
                if(allRefs.length > 4) {
                    box2_static_arr = allRefs.slice(4, 8);
                }
                if(allRefs.length > 4) {
                    box3_static_arr = allRefs.slice(8, 12);
                }
                var shuffleData = shuffle(bucketOptionValues);
                $(".dynamic_input").each(function(key, value) {
                    console.log(key);
                    $(this).attr("src", shuffleData[key].image_path);
                    $(this).attr("value", shuffleData[key].ref);
                });
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
})