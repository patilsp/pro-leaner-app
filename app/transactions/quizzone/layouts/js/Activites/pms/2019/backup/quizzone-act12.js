$(function () {
	$('.close_span').click(function(){
        $('#myModal').modal('hide');
    });

    $('#layout_form').on('submit', function(event) {
        event.preventDefault();
        
        $('.qust_blk').addClass('animated fadeOut');
        setTimeout(function(){
            $('.qust_blk').addClass('qust_blk_hide');
            $('#alert_blk').removeClass('alert_blk').addClass('animated fadeIn');
        }, 1000)
        $.ajax({
          url: '../../../PHPActivityAPI.php?type=saveData',
          method:'POST',
          data:new FormData(this),
          contentType:false,
          processData:false,
          async:true,
          success:function(data)
          {
                  setTimeout(function(){
              $("#showWellDone").modal("show");
            }, 2500);
              data = JSON.parse(data);
              if(data.status)
              {
                $("#message").html(data.Message);
              }
          },
          beforeSend: function(){
            $("#loader_modal").modal("show");
          },
          complete: function(){
            setTimeout(function(){
              $("#loader_modal").modal("hide");
            }, 2000);
          }
        });
    });
    
    /*var formData = new FormData();
    formData.append('reference', $("#reference").val());
    $.ajax({
        url: '../../../PHPActivityAPI.php?type=getData',
        method:'POST',
        data: formData,
        contentType:false,
        processData:false,
        async:true,
        success:function(data)
        {
          data = JSON.parse(data);
          for (var key in data.SavedData) {
            if($.isArray(data.SavedData[key])) {
            $("input[name='" + key + "[]']").map(function(key1){
              if(this.type == "radio") {
                if($.inArray(this.value, data.SavedData[key]) !== -1 )
                {
                  $(this).prop("checked", true);
                }
              } else {
                $(this).val(data.SavedData[key][key1]);
              }
            });
                  } else {
            $('input[name="'+key+'"]').val(data.SavedData[key]);
            }
          }     
        },
        beforeSend: function(){
        //$("body").mLoading()
        },
        complete: function(){
        //$("body").mLoading('hide')
        }
    });*/

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
            $("#desc_img").attr("src",data.desc_img);
            
            var question = "";
            var option1 = "";
            var option1_val = "";
            var option2 = "";
            var option2_val = "";
            var option3 = "";
            var option3_val = "";
            $.each(data, function(i, e){
              if(i == 'desc') {
                $.each(e, function(key, val){
                  $("#desc").append(`<li class="points">`+val+`</li>`);
                });
              } else if(i == 'qust1') {
                $.each(e, function(key, val){
                  if(key == "qust"){
                    question = val;
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
                $("#questions_modal").append(`<div class="row qust_blk">
                  <h3>`+question+`</h3>
                  <div class="col-12" id="qust1_col">
                    <div class="custom-control custom-radio custom-control">
                      <input type="radio" class="custom-control-input" id="customRadio1" name="qust1" value="`+option1_val+`" required >
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
                  </div>
                </div>`)
              } else if(i == 'qust2') {
                $.each(e, function(key, val){
                  if(key == "qust"){
                    question = val;
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
                $("#questions_modal").append(`<div class="row qust_blk">
                  <h3>`+question+`</h3>
                  <div class="col-12" id="qust1_col">
                    <div class="custom-control custom-radio custom-control">
                      <input type="radio" class="custom-control-input" id="customRadio4" name="qust2" value="`+option1_val+`" required >
                      <label class="custom-control-label" for="customRadio4">`+option1+`</label>
                    </div>
                    <div class="custom-control custom-radio custom-control">
                      <input type="radio" class="custom-control-input" id="customRadio5" name="qust2" value="`+option2_val+`">
                      <label class="custom-control-label" for="customRadio5">`+option2+`</label>
                    </div>
                    <div class="custom-control custom-radio custom-control">
                      <input type="radio" class="custom-control-input" id="customRadio6" name="qust2" value="`+option3_val+`">
                      <label class="custom-control-label" for="customRadio6">`+option3+`</label>
                    </div>
                  </div>
                </div>`)
              } else if(i == 'qust3') {
                $.each(e, function(key, val){
                  if(key == "qust"){
                    question = val;
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
                $("#questions_modal").append(`<div class="row qust_blk">
                  <h3>`+question+`</h3>
                  <div class="col-12" id="qust1_col">
                    <div class="custom-control custom-radio custom-control">
                      <input type="radio" class="custom-control-input" id="customRadio7" name="qust3" value="`+option1_val+`" required >
                      <label class="custom-control-label" for="customRadio7">`+option1+`</label>
                    </div>
                    <div class="custom-control custom-radio custom-control">
                      <input type="radio" class="custom-control-input" id="customRadio8" name="qust3" value="`+option2_val+`">
                      <label class="custom-control-label" for="customRadio8">`+option2+`</label>
                    </div>
                    <div class="custom-control custom-radio custom-control">
                      <input type="radio" class="custom-control-input" id="customRadio9" name="qust3" value="`+option3_val+`">
                      <label class="custom-control-label" for="customRadio9">`+option3+`</label>
                    </div>
                  </div>
                </div>`)
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
  }, 1000)
})