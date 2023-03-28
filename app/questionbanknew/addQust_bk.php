<?php
  include_once "../../session_token/checksession.php";
	include "../../configration/config.php";
?>
<!DOCTYPE html>
<html lang="en" class="light-theme">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../../assets/images/favicon-32x32.png" type="image/png" />

    <title>PMS - Dashboard</title>
    
	<?php include("../../componets/style.php"); ?>
</head>

<body>
	
<div class="container">
  <form name="contact" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="" id="main-container">
      
    </div>
  </form>
</div>

<hr />
<button
  class="btn btn-danger shortAnsTable"
  data-add-to="#main-container"
  type="button"
>
  Add Paragraph
</button>
<!-- ./wrapper -->
	
	<?php include("../../componets/js.php"); ?>
  <script src="../../assets/plugins/ckeditor/ckeditor.js"></script>
  <script src="../../assets/plugins/ckeditor/ckeditor_wiris/plugin.js"></script>
  <script src="https://www.wiris.net/demo/plugins/app/WIRISplugins.js?viewer=image"></script>
	<script src="../../assets/js/appConfig.js"></script>

  <script>
    

    $(document).ready(function() {
      var editorQustName = 0;
      var editorAnsName = 0;
      $('.shortAnsTable').click(function(){
        $('#main-container').append('<textarea name="editor['+editorQustName+']" class="editor1" id="editor'+editorQustName+'" rows="10" cols="80">This is my textarea to be replaced with CKEditor 4.</textarea><textarea class="editor1" name="editorAns['+editorAnsName+']" id="editorAns'+editorAnsName+'" rows="10" cols="80">This is my textarea to be replaced with CKEditor 4.</textarea><button type="button" data-editorInstance="'+editorQustName+'" class="btn btn-danger delete-editor"><i class="fa fa-trash m-0"></i></button>');
        //var ckEditorName = "editor"+editorName;

        CKEDITOR.replace( 'editor'+editorQustName,{
          toolbarGroups: [
            { name: 'others' },
            { name: 'paragraph',   groups: [ 'list' ] },
          ],
          extraPlugins: 'ckeditor_wiris,html5video,html5audio',
          allowedContent: true,
          filebrowserUploadUrl: "<?php echo $web_root ?>app/assets/plugins/ckeditor/upload.php?type=file",
          filebrowserImageUploadUrl: "<?php echo $web_root ?>app/assets/plugins/ckeditor/upload.php?type=image",
          height: ['100px'],
          readOnly: true,
        });

        CKEDITOR.replace( 'editorAns'+editorAnsName,{
          extraPlugins: 'ckeditor_wiris,html5video,html5audio',
          allowedContent: true,
          filebrowserUploadUrl: "<?php echo $web_root ?>app/assets/plugins/ckeditor/upload.php?type=file",
          filebrowserImageUploadUrl: "<?php echo $web_root ?>app/assets/plugins/ckeditor/upload.php?type=image",
          height: ['100px']
        });
        
        editorQustName += 1;
        editorAnsName += 1;

        $('.delete-editor').on("click", function() {
          var qustInstanceName = 'editor'+$(this).attr('data-editorInstance');
          var ansInstanceName = 'editorAns'+$(this).attr('data-editorInstance');
          console.log("came");
          CKEDITOR.instances[qustInstanceName].destroy();
          CKEDITOR.instances[ansInstanceName].destroy();

          $('#'+qustInstanceName).remove();
          $('#'+ansInstanceName).remove();
          $(this).remove();
        });
      });
    });


  </script>
</body>
</html>
