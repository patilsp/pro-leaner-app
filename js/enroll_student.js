$(document).ready(function() {
    $('#assign_sub_blk').hide();
    $('#enroll_student_sub_blk').hide();
    $('#studentClass').show();

    var sub_opts_selected = 0;
    var sub_opts_unselect = 0;
    //enroll student language change status
    var es_lang = 0;

	$('.sub_opts').select2({ //apply select2 to my element
        placeholder: "Search your subject",
        closeOnSelect: false
    });

    $(".selectclass").on("change", function() {
        var id = $('#selectclass').val();
        var  _this = this;
        var class1 = $(this).closest('.d-flex').find('.class').prop('value');
        //console.log(class1);
        $.ajax({
            url:"apis/enroll.php",
            method:'POST',
            data: "id="+ class1 +"&type=getSelectData",
            success:function(data)
            {
                var json = $.parseJSON(data);
                var result = json.Result;
                var section = result.Section1;
                $(_this).closest('.d-flex').find('.section').html(section);
            },
            beforeSend: function(){
                //$("body").mLoading()
            },
            complete: function(){
                //$("body").mLoading('hide')
            }
        });
    });

    $(".go").on("click",function(){
       
        var class_id   = $('#selectclass').val();
        var Section     = $('#sectionOptionSection').val();
        if(class_id != "" && Section != ""){
            $.ajax({
                url:"apis/enroll.php",
                method:'POST',
                data: "id="+ class_id +"&Section="+ Section +"&type=getClassData",
                success:function(data)
                {
                    $('#assign_sub_blk').show();
                    $('#studentClass').hide();
                    var json = $.parseJSON(data);
                    var tbody = json.Result;
                    var count = json.Count;
                    $('#table_body').html(tbody);
                    $('#table_count').val(count);
                    $('.sub_opts').select2({ //apply select2 to my element
                        placeholder: "Search your subject",
                        closeOnSelect: false
                    });
                   
                    $('.sub_opts').on('select2:select', function (e) {
                        var data = e.params.data;
                        sub_opts_selected = 1;
                    });

                    $('.sub_opts').on('select2:unselect', function (e) {
                        var data = e.params.data;
                        sub_opts_unselect = 1;
                    });
                },
                beforeSend: function(){
                    //$("body").mLoading()
                },
                complete: function(){
                    //$("body").mLoading('hide')
                }
            });
        }else{
            $("#sb_heading").html("Notice!");
            var x = document.getElementById("snackbar");
            x.className = "show";
            $("#sb_body").html("Mandatory Fields Required!");
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
        }
        
        
    });
    
    $(".save").on("click",function(){
       var countid = $('#table_count').val();
       var i = 1;
       var subjects = [];
       var classid = $('#selectclass').val();
       var section = $('#sectionOptionSection').val();
       console.log(countid);

       //Get all select box values with classname = sub_opts
       $(".sub_opts").each(function() {
           console.log($(this).val(), $(this).attr("id"));
           var full_id = $(this).attr("id");
           var id = full_id.replace("multipleSelect", "");
           subjects[id] = $(this).val();
       });
       $.ajax({
            url:"apis/enroll.php",
            method:'POST',
            data: "class="+ classid +"&section="+section+"&subjects="+subjects+"&type=saveClassData",
            success:function(data)
            {
                var json = $.parseJSON(data);
                var tablehead = json.tableHead;
                var tablebody = json.tableBody;
                $('#tableHead').html(tablehead);
                $('#tableBody').html(tablebody);
                if(json.status) {

                    //$("#sb_heading").html("Success!");
                    $('#enroll_student_sub_blk').show();
                    $('#assign_sub_blk').hide();
                    $('#studentClass').hide();
                } else {
                    //$("#sb_heading").html("Notice!");
                } 
                // var x = document.getElementById("snackbar");
                // x.className = "show";
                // $("#sb_body").html(json.message);
                // setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);

                $(".studentSubjects").on("change", function() {
                    es_lang = 1;
                });
                
                //status of select
                sub_opts_selected = 0;
                sub_opts_unselect = 0;
            },
            beforeSend: function(){
                //$("body").mLoading()
            },
            complete: function(){
                //$("body").mLoading('hide')
            }
        });
    });

    $(".update").on("click",function(){
        var i = 1;
        var subject = [];
        var classid = $('#selectclass').val();
        var userid = $('[name=userid]').map(function() { 
            return  this.value;
        }).get();
        $(".studentSubjects").each(function() {
           console.log($(this).val(), $(this).attr("id"));
           var full_id = $(this).attr("id");
           var temp = full_id.split("@");
           console.log(temp);
           console.log(subject[temp[1]]);
           if(subject[temp[1]] == undefined){
               subject[temp[1]] = temp[2]+"|"+$(this).val();
           } else {
               subject[temp[1]] += "~"+temp[2]+"|"+$(this).val();
           }
        });
        /*for(i =0 ;i < userid.length;i++){
            subject[i] = $('select[name=select'+userid[i]+']').map(function() { 
                return  this.value;
            }).get();
            console.log(subject[i]);
        }*/
        $.ajax({
            url:"apis/enroll.php",
            method:'POST',
            //data: "userid="+ userid +"&subject="+subject+"&type=updateStudentData",
            data:{userid: userid,subject:subject,type:'updateStudentData',class_id:classid},
            dataType: 'JSON',
            success:function(data)
            {
               // console.log(data['status']);
                //var json = $.parseJSON(data);
                if(data['status']) {

                    $("#sb_heading").html("Success!");
                    $('#enroll_student_sub_blk').hide();
                    $('#assign_sub_blk').hide();
                    $('#studentClass').show();
                } else {
                    $("#sb_heading").html("Notice!");
                } 
                var x = document.getElementById("snackbar");
                x.className = "show";
                $("#sb_body").html(data['message']);
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000); 
             
                es_lang = 0;
            },
            beforeSend: function(){
                //$("body").mLoading()
            },
            complete: function(){
                //$("body").mLoading('hide')
            }
        });
        
    })


    //back click event validate
    $("#back_click").click(function(){
        if(sub_opts_selected == 0 && sub_opts_unselect == 0 && es_lang == 0){
            location.href = 'enroll.php';
        } else {
            $("#alert_modal").modal("show");
        }
    });

    $("#redirect_yes").click(function(){
        if(es_lang == 1){
            $("#alert_modal").modal("hide");
            $("#sb_heading").html("Success!");
            $('#enroll_student_sub_blk').hide();
            $('#assign_sub_blk').hide();
            $('#studentClass').show();
        } else {
            location.href = 'enroll.php';
        }
    });
});