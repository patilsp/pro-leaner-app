function myFunction(obj) {
    clone_data = obj;
}
$(document).ready(function() {

    type = '';
    rowID = '';
    var del = new Array();
    $(document).on('change', 'input[type=file]', prepareUpload);
    var files1 = new Array();
    var f = 0;

    $(document).on('click', '#CreateAssnmt', function(event){   
        type = '';
        rowID = '';
    });

    // Grab the files and set them to our variable
    function prepareUpload(event) {
        files = event.target.files;
        var data1 = new FormData();
        var count = 0;
        $.each(files, function(i, file) {
            files1.push(file);
            data1.append(count, file);
            count++;

            var html = "<tr id='tr" + f + "'><td>" + file.name + "</td><td><a class='btn-dager delete' id='" + f + "' href='#''><i class='fa fa-times'></i></a></td></tr>";
            $('.upload_docs tbody').append(html);

            var html1 = "<div id='show_attachedfiel' class='show_attachedfiel d-flex align-items-center mx-3 border rounded-lg p-2 mb-2 mt-2 body'><p class='d-flex m-0 font-weight-bold txt-grey align-items-center fn' >" + file.name + "</p><i class='fa fa-times close_btn_sm ml-4 delete' id='" + f + "'></i></div>";
            $('#upload_documents_js').append(html1);
            f++;

        });

        if ( $('#upload_documents_js > *').length > 0 ) {
            $("#no_file_selected").text("");
        } else {
            $("#no_file_selected").text("No file selected");
        }
    }



    var clone_data = "";
    $('body').on('change', '.upload_documents', function() {
        myfile = $(this).val();
        var ext = myfile.split('.').pop();
        if (1 == 1) {
            $(clone_data).hide();
            $(".appenduploadfile").append('<input type="file" class="upload_documents" name="upload_documents[]" id="upload_documents" onclick="myFunction(this)" placeholder="" multiple accept="application/pdf">');

            return true;
        } else {
            $(this).val("");
            alert("Only PDF files are allow.");
            return false;
        }
    });

    $(document).on('click', '.delete', function() {
        var id = $(this).attr('id');
        del.push(id);
        $("#tr" + id).remove();
        // alert("Are you sure you want to Delete the file?");
        var delrow = $(this).closest('.show_attachedfiel');
        delrow.remove();

        if ( $('#upload_documents_js > *').length > 0 ) {
            $("#no_file_selected").text("");
        } else {
            $("#no_file_selected").text("No file selected");
        }
    });
    
//Create Worksheet
$(document).on('submit', '#create_assignment_form', function(event){
    event.preventDefault();
    var data1 = new FormData(this);

    jQuery.each($('input[name^="upload_documents"]')[0].files, function(i, file) {
        data1.append(i, file);
    });

    data1.append('del', del);
    if(type == 'editmodal'){
        data1.append('type', 'updatemodal');
        data1.append('cmid', rowID);
    }

    $.ajax({
        url:"apis/assignments_apis.php",
        method:'POST',
        data:data1,
        contentType:false,
        processData:false,
        success:function(data)
        {
            var json = $.parseJSON(data);
            if(json.status) {
                $("#sb_heading").html("Success!");
                $("#create_assignment_modal").modal("hide");
                location.reload();
            } else {
                $("#sb_heading").html("Notice!");
                $("#autoid").val("0");
                var x = document.getElementById("snackbar");
                x.className = "show";
                $("#sb_body").html(json.message);
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 10000);
            }
        },
        beforeseNd: function(){
        $("body").mLoading()
        },
        complete: function(){
        $("body").mLoading('hide')
        }
    });
    });


    $(document).on('click', '.editdetails', function(event){  
        type = 'editmodal';
        rowID = $(this).data('id');
        var editdata = {type : 'editmodal',cmid: rowID};
        var form_data = new FormData();
        for ( var key in editdata ) {
            form_data.append(key, editdata[key]);
        }
        $.ajax({
            url:"apis/assignments_apis.php",
            method:'POST',
            data:form_data,
            contentType:false,
            processData:false,
            success:function(data)
            {
            var data = $.parseJSON(data);
            var data = data.Result[0];
            $("#model_title").text("Edit Assignment");
                // if(data.files.length != 0){
                //     //loop uploaded files
                //     data.files.forEach(files => {
                //         $("#upload_documents_js").append('<div id="show_attachedfiel" class="show_attachedfiel d-flex align-items-center mx-3 border rounded-lg p-2 mb-2 mt-2 body"><p class="d-flex m-0 font-weight-bold txt-grey align-items-center fn">'+files.name+'</p><i class="fa fa-times close_btn_sm ml-4 delete" id="0"></i></div>');
                //     });
                // }
                               
                $("#name").val(data.title);
                $("#intro").val(data.intro);
                $("#att_to_date").val(data.duedate);
                var d = new Date(data.duedatetime);
                $('#due_by').val(d.getHours()+":"+d.getMinutes());
                $("#grade").val(data.grade);
                $("#link").val(data.link_actual);
                $("#publish_date").val(data.publish_date);
                $("#publish_time").val(data.publish_time);
               
            $('#create_assignment_modal').modal('show')
        }            
        });
    });

    $('#create_assignment_modal').on('hidden.bs.modal', function (e) {
        $("#upload_documents_js").html('');
        $(this).find('form').trigger('reset');
    })

    $(document).on('click', '#deletemodaldetails', function(event){
        var rowID = $(this).attr('data-id');
        $('#class_delete_modal').modal({ backdrop: 'static', keyboard: false })
        .one('click', '#delete_class_yes', function (e) {
            var editdata = {type : 'deletemodal', id : rowID};
            var form_data = new FormData();
            for ( var key in editdata ) {
                form_data.append(key, editdata[key]);
            }
            $.ajax({
                url:"apis/assignments_apis.php",
                method:'POST',
                data:form_data,
                contentType:false,
                processData:false,
                success:function(data){
                var data = $.parseJSON(data);
                var data = data.Result;
                location.reload();
                }            
            });        
        });
    });
    

});