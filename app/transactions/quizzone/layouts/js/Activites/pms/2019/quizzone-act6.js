$(function () {
  var draggableImgs = [];
  var total;
  total = 0;

  function welldone(card_title, card_text, card_image) {
    $("#card_image").attr("src", card_image);
    $("#card_title").text(card_title);
    $("#score_text").text(card_text + " out of 5");
  }

  $("#next_btn").click(function () {
    $("#qust_section").removeClass("animated fadeIn");
    setTimeout(function () {
      $("#qust_section").addClass("qust_section").addClass("animated fadeOut");
      $("#score_section").removeClass("score_section").addClass("animated fadeIn");
      $("#next_btn").addClass("next_btn").removeClass("animated fadeIn");
      $("#submit_btn").removeClass("submit_btn");
      $(".qust1_label, .qust2_label, .qust3_label, .qust7_label").removeClass("active");
      document.getElementById("layout_form").reset();
    }, 500);
  });

  $(".cor_ans_btn").click(function () {
    $("#score_section").removeClass("animated fadeIn");
    $("#cor_ans_section").removeClass("animated fadeOut");
    setTimeout(function () {
      $("#score_section").addClass("animated fadeOut");
    }, 500);
    setTimeout(function () {
      $("#score_section").addClass("score_section");
      $("#cor_ans_section").removeClass("cor_ans_section").addClass("animated fadeIn");
    }, 1000);
  });

  $(".go_back_btn").click(function () {
    $("#score_section").removeClass("animated fadeOut");
    $("#cor_ans_section").removeClass("animated fadeIn");
    setTimeout(function () {
      $("#cor_ans_section").addClass("animated fadeOut");
    }, 500);
    setTimeout(function () {
      $("#cor_ans_section").addClass("cor_ans_section");
      $("#score_section").removeClass("score_section").addClass("animated fadeIn");
    }, 1000);
  });

  var url = document.URL;
  var split_url_val = url.split("?");
  var split_url_qust_id = split_url_val[1].split("&");
  var api_url = split_url_qust_id[0].replace("api_end_point=", "");
  var qust_id = split_url_qust_id[1].replace("qust_id=", "");

  setTimeout(function () {
    //console.log(api_url,'-',qust_id);
    $.ajax({
      url: "../../../../" + api_url + "?qust_id=" + qust_id,
      method: "GET",
      contentType: false,
      processData: false,
      async: true,
      success: function (data) {
        data = JSON.parse(data);
        console.log(data);
        console.log("data.explanation.exp1 - ", data.explanation.exp1);
        $("#act_title").html(data.act_title);
        $(".exp_img").attr("src", data.exp_img);
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
        } else if (data.explanation.exp1 != "" || data.explanation.exp2 != "" || data.explanation.exp3 != "") {
          //console.log("3333");
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
        $.each(data, function (i, e) {
          //console.log(i," - ",e);
          if (i == "qust1") {
            //console.log(i);
            $.each(e, function (key, val) {
              if (key == "qust") {
                question = val;
              } else if (key == "ans") {
                option1 = val;
              }
            });
            $(".drag_img1").attr("src", question);
            $(".drag_img1").attr("value", option1);
            $('#card-body1').html(
              `<div class="card-header">
                        <label class="w-100 mb-0">` +
                option1 +
                `</label>
                      </div>`
            )
            $("#card_row1").append(
              `<li>
                      
                      <div class="inner_div" id="dvDest1" value='` +
                option1 +
                `'>
                        
                      </div>
                    </li>`
            );
            $('#corect-card-body1').html(
              `<div class="card-header">
                        <label class="w-100 mb-0">` +
                option1 +
                `</label>
                      </div>`
            )
            $("#corect_card_row1").append(
              `<li>
                      
                      <div class="inner_div highlighter_focus_dropped" id="dvDest1"><img class="d-block mx-auto dropped" value="phy_group" src="` +
                question +
                `" alt="dragable_image"></div>
                    </li>`
            );
          } else if (i == "qust2") {
            $.each(e, function (key, val) {
              if (key == "qust") {
                question = val;
              } else if (key == "ans") {
                option1 = val;
              }
            });
            $(".drag_img2").attr("src", question);
            $(".drag_img2").attr("value", option1);
            
            $("#card_row1").append(
              `<li>
                      <div class="inner_div" id="dvDest2" value='` +
                option1 +
                `'>
                        
                      </div>
                    </li>`
            );
            $("#corect_card_row1").append(
              `<li>
                      
                      <div class="inner_div highlighter_focus_dropped" id="dvDest1"><img class="d-block mx-auto dropped" value="phy_group" src="` +
                question +
                `" alt="dragable_image"></div>
                    </li>`
            );
          } else if (i == "qust3") {
            $.each(e, function (key, val) {
              if (key == "qust") {
                question = val;
              } else if (key == "ans") {
                option1 = val;
              }
            });
            $(".drag_img3").attr("src", question);
            $(".drag_img3").attr("value", option1);
            $("#card_row1").append(
              `<li>
                      
                      <div class="inner_div" id="dvDest3" value='` +
                option1 +
                `'>
                        
                      </div>
                    </li>`
            );
            $("#corect_card_row1").append(
              `<li>
                      
                      <div class="inner_div highlighter_focus_dropped" id="dvDest1"><img class="d-block mx-auto dropped" value="phy_group" src="` +
                question +
                `" alt="dragable_image"></div>
                    </li>`
            );
          } else if (i == "qust4") {
            $.each(e, function (key, val) {
              if (key == "qust") {
                question = val;
              } else if (key == "ans") {
                option1 = val;
              }
            });
            $(".drag_img4").attr("src", question);
            $(".drag_img4").attr("value", option1);
            $('#card-body2').html(
              `<div class="card-header">
                        <label class="w-100 mb-0">` +
                option1 +
                `</label>
                      </div>`
            )
            $("#card_row2").append(
              `<li>
                      
                      <div class="inner_div" id="dvDest4" value='` +
                option1 +
                `'>
                        
                      </div>
                    </li>`
            );
            $('#corect-card-body2').html(
              `<div class="card-header">
                        <label class="w-100 mb-0">` +
                option1 +
                `</label>
                      </div>`
            )
            $("#corect_card_row2").append(
              `<li>
                      
                      <div class="inner_div highlighter_focus_dropped" id="dvDest1"><img class="d-block mx-auto dropped" value="phy_group" src="` +
                question +
                `" alt="dragable_image"></div>
                    </li>`
            );
          } else if (i == "qust5") {
            $.each(e, function (key, val) {
              if (key == "qust") {
                question = val;
              } else if (key == "ans") {
                option1 = val;
              }
            });
            $(".drag_img5").attr("src", question);
            $(".drag_img5").attr("value", option1);
            $("#card_row2").append(
              `<li>
                      
                      <div class="inner_div" id="dvDest5" value='` +
                option1 +
                `'>
                        
                      </div>
                    </li>`
            );
            $("#corect_card_row2").append(
              `<li>
                      
                      <div class="inner_div highlighter_focus_dropped" id="dvDest1"><img class="d-block mx-auto dropped" value="phy_group" src="` +
                question +
                `" alt="dragable_image"></div>
                    </li>`
            );
          } else if (i == "qust6") {
            $.each(e, function (key, val) {
              if (key == "qust") {
                question = val;
              } else if (key == "ans") {
                option1 = val;
              }
            });
            $(".drag_img6").attr("src", question);
            $(".drag_img6").attr("value", option1);
            $("#card_row2").append(
              `<li>
                      
                      <div class="inner_div" id="dvDest6" value='` +
                option1 +
                `'>
                        
                      </div>
                    </li>`
            );
            $("#corect_card_row2").append(
              `<li>
                      
                      <div class="inner_div highlighter_focus_dropped" id="dvDest1"><img class="d-block mx-auto dropped" value="phy_group" src="` +
                question +
                `" alt="dragable_image"></div>
                    </li>`
            );
          }
        });

        //shufleing dragable images
        $(".drag_box")
          .find("img")
          .each(function (mcqEmIndex, mcqEmValue) {
            draggableImgs.push(mcqEmValue);
          });
        console.log(draggableImgs);
        draggableImgs.sort(function () {
          return 0.5 - Math.random();
        });
        $(".drag_box").html(draggableImgs);

        //start enable the draggable and validate
        $("#dvSource img").draggable({
          revert: "invalid",
          helper: "clone",
          refreshPositions: true,
          drag: function (event, ui) {
            ui.helper.addClass("draggable");
          },
          stop: function (event, ui) {
            ui.helper.removeClass("draggable");
            var image = this.src.split("/")[this.src.split("/").length - 1];
            var valu = $(this).attr("value");
            var categories = $(this).attr("value");
            var category_type = $(this).closest("div").attr("value");

            console.log(categories);
            console.log(category_type);

            if (categories == category_type) total++;
            /*else if(total != 0 && category_type != null)
            total--;*/

            $("#score_text").text(total + " out of 9");
            if (total == 5) {
              var card_title = "Well done!";
              var card_text = total;
              var card_image = "../../../images/graphics/welldone.png";
              welldone(card_title, card_text, card_image);
            } else {
              var card_title = "Not done!";
              var card_text = total;
              var card_image = "../../../images/graphics/notdone.png";
              welldone(card_title, card_text, card_image);
            }

            if (categories == category_type)
              $(this).closest("div").append('<span class="remove_html" style="display:none"><span class="fontawesome_icon fontawesome_icon_right animated fadein"><i class="fa fa-check" aria-hidden="true"></i></span></span>');
            else if (categories != category_type && category_type != null)
              $(this).closest("div").append('<span class="remove_html" style="display:none"><span class="fontawesome_icon fontawesome_icon_wrong animated fadeIn"><i class="fa fa-close" aria-hidden="true"></i></span></span>');

            if (
              $("#dvDest1").children("img").length == 1 &&
              $("#dvDest2").children("img").length == 1 &&
              $("#dvDest3").children("img").length == 1 &&
              $("#dvDest4").children("img").length == 1 &&
              $("#dvDest5").children("img").length == 1 &&
              $("#dvDest6").children("img").length == 1
            ) {
              $("#drag_div").addClass("animated fadeOut");
              setTimeout(function () {
                $("#drag_div").addClass("drag_div_hide");
                $("#drop_div").removeClass("col-8").addClass("col-12");
              }, 1000);
              setTimeout(function () {
                $(".remove_html").removeAttr("style");
              }, 2000);

              $("#qust_section").removeClass("animated fadeIn");
              $("#user_response").html($("#copy_section_ca").html());
              setTimeout(function () {
                $("#qust_section").addClass("qust_section").addClass("animated fadeOut");
                $("#cor_ans_section").removeClass("cor_ans_section").addClass("animated fadeIn");
                $("#next_btn").addClass("next_btn").removeClass("animated fadeIn");
                $("#submit_btn").removeClass("submit_btn");
                $(".qust1_label, .qust2_label, .qust3_label, .qust7_label").removeClass("active");
                document.getElementById("layout_form").reset();
                $("#drag_div").removeClass("animated fadeOut");
              }, 8000);
            }
          },
        });
        //end enable the draggable and validate

        setTimeout(function () {
          enableDropable();
        }, 1000);
      },
      beforeSend: function () {
        $("#loader_modal").modal("show");
      },
      complete: function () {
        setTimeout(function () {
          $("#loader_modal").modal("hide");
        }, 1000);
      },
    });
  }, 1000);

  function enableDropable() {
    $("#dvDest1").droppable({
      over: function (event, ui) {
        $(this).addClass("highlighter_focus_in");
        $(this).removeClass("highlighter_focus_out");
      },
      out: function (event, ui) {
        $(this).addClass("highlighter_focus_out");
        $(this).removeClass("highlighter_focus_in");
      },
      drop: function (event, ui) {
        $(this).removeClass("highlighter_focus_in");
        $(this).addClass("highlighter_focus_dropped");
        if ($("#dvDest1 img").length == 0) {
          $("#dvDest1").html("");
        }
        ui.draggable.addClass("dropped");
        ui.draggable.removeClass("ui-draggable");
        ui.draggable.removeClass("ui-draggable-handle");
        $("#dvDest1").append(ui.draggable);
        $("#dvDest1").droppable("destroy");
      },
    });
    $("#dvDest2").droppable({
      over: function (event, ui) {
        $(this).addClass("highlighter_focus_in");
        $(this).removeClass("highlighter_focus_out");
      },
      out: function (event, ui) {
        $(this).addClass("highlighter_focus_out");
        $(this).removeClass("highlighter_focus_in");
      },
      drop: function (event, ui) {
        $(this).removeClass("highlighter_focus_in");
        $(this).addClass("highlighter_focus_dropped");
        if ($("#dvDest2 img").length == 0) {
          $("#dvDest2").html("");
        }
        ui.draggable.addClass("dropped");
        ui.draggable.removeClass("ui-draggable");
        ui.draggable.removeClass("ui-draggable-handle");
        $("#dvDest2").append(ui.draggable);
      },
    });
    $("#dvDest3").droppable({
      over: function (event, ui) {
        $(this).addClass("highlighter_focus_in");
        $(this).removeClass("highlighter_focus_out");
      },
      out: function (event, ui) {
        $(this).addClass("highlighter_focus_out");
        $(this).removeClass("highlighter_focus_in");
      },
      drop: function (event, ui) {
        $(this).removeClass("highlighter_focus_in");
        $(this).addClass("highlighter_focus_dropped");
        if ($("#dvDest3 img").length == 0) {
          $("#dvDest3").html("");
        }
        ui.draggable.addClass("dropped");
        ui.draggable.removeClass("ui-draggable");
        ui.draggable.removeClass("ui-draggable-handle");
        $("#dvDest3").append(ui.draggable);
      },
    });

    $("#dvDest4").droppable({
      over: function (event, ui) {
        $(this).addClass("highlighter_focus_in");
        $(this).removeClass("highlighter_focus_out");
      },
      out: function (event, ui) {
        $(this).addClass("highlighter_focus_out");
        $(this).removeClass("highlighter_focus_in");
      },
      drop: function (event, ui) {
        $(this).removeClass("highlighter_focus_in");
        $(this).addClass("highlighter_focus_dropped");
        if ($("#dvDest4 img").length == 0) {
          $("#dvDest4").html("");
        }
        ui.draggable.addClass("dropped");
        ui.draggable.removeClass("ui-draggable");
        ui.draggable.removeClass("ui-draggable-handle");
        $("#dvDest4").append(ui.draggable);
      },
    });
    $("#dvDest5").droppable({
      over: function (event, ui) {
        $(this).addClass("highlighter_focus_in");
        $(this).removeClass("highlighter_focus_out");
      },
      out: function (event, ui) {
        $(this).addClass("highlighter_focus_out");
        $(this).removeClass("highlighter_focus_in");
      },
      drop: function (event, ui) {
        $(this).removeClass("highlighter_focus_in");
        $(this).addClass("highlighter_focus_dropped");
        if ($("#dvDest5 img").length == 0) {
          $("#dvDest5").html("");
        }
        ui.draggable.addClass("dropped");
        ui.draggable.removeClass("ui-draggable");
        ui.draggable.removeClass("ui-draggable-handle");
        $("#dvDest5").append(ui.draggable);
      },
    });
    $("#dvDest6").droppable({
      over: function (event, ui) {
        $(this).addClass("highlighter_focus_in");
        $(this).removeClass("highlighter_focus_out");
      },
      out: function (event, ui) {
        $(this).addClass("highlighter_focus_out");
        $(this).removeClass("highlighter_focus_in");
      },
      drop: function (event, ui) {
        $(this).removeClass("highlighter_focus_in");
        $(this).addClass("highlighter_focus_dropped");
        if ($("#dvDest6 img").length == 0) {
          $("#dvDest6").html("");
        }
        ui.draggable.addClass("dropped");
        ui.draggable.removeClass("ui-draggable");
        ui.draggable.removeClass("ui-draggable-handle");
        $("#dvDest6").append(ui.draggable);
      },
    });
  }
});
