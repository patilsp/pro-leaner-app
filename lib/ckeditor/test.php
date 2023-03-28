<?php 
include "config.php";

if(isset($_POST['submit'])){
  echo "<pre/>";
  print_r($_POST);
  // insert a single publisher
  $title = $_POST['title'];
  $short_desc = $_POST['short_desc'];
  $long_desc = $_POST['long_desc'];
  $query = "INSERT INTO contents(title, short_desc, long_desc) VALUES (?, ?, ?)";
  $stmt = $db->prepare($query);
  $stmt->execute(array($title, $short_desc, $long_desc));  

  /*$publisher_id = $stmt->lastInsertId();

  echo 'The publisher id ' . $publisher_id . ' was inserted';*/
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Integrate CKeditor to HTML page and save to MySQL with PHP</title>

    <!-- CSS -->
    <style type="text/css">
    .cke_textarea_inline{
       border: 1px solid black;
    }
    </style>

    <!-- Bootstrap css library -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="ckeditor.js"></script>
    <script src="plugins/ckeditor_wiris/plugin.js"></script>
    <script src="https://www.wiris.net/demo/plugins/app/WIRISplugins.js?viewer=image"></script>
  </head>
  <body>
    <div class="container">
  <form action="#">
    <div class="" id="main-container">
       <div class="editor">
            <textarea class="ckeditor" id="editor1" name="editor1"></textarea>
            <button class="btn btn-success delete-editor my-2">
              Delete Chapter
            </button>
          </div>
    </div>
    <div class="my-2">
      <button class="btn btn-primary">Submit</button>
    </div>
  </form>
</div>
<p><math xmlns="http://www.w3.org/1998/Math/MathML"><mroot><mn>2</mn><mn>1</mn></mroot></math></p>
<hr />
<button
  class="btn btn-danger add-chapter-para"
  data-add-to="#main-container"
  type="button"
>
  Add Paragraph
</button>



  </body>

  <script type="text/javascript">

/*
 * Included Jquery
 */
/*
https://drive.google.com/uc?export=view&id=1MAcF2ydw_b_9ZNhBpnw03euC1GhSULmW
*/

function createNewEditor(targetElement) {
  var editorDiv = document.createElement("div");
  $(editorDiv).addClass("editor");
  var textArea = document.createElement("textarea");
  var deleteBtn = document.createElement("button");

  $(textArea)
    .addClass("ckeditor")
    .appendTo(editorDiv);
  $(deleteBtn)
    .attr("type", "button")
    .addClass("btn btn-success delete-editor my-2")
    .text("Delete Chapter")
    .appendTo(editorDiv);
  $(editorDiv).appendTo(targetElement);

  var newEditor = CKEDITOR.replace(textArea, {
      extraPlugins:'ckeditor_wiris,html5video,html5audio',
      allowedContent: true,
      filebrowserUploadUrl: "upload.php?type=file",
      filebrowserImageUploadUrl: "upload.php?type=image",
  });
  $(textArea).attr("id", newEditor.name);
  console.log(newEditor);
}

function deleteEditor() {
  $(".editor").each(function(_, editor) {
    var deleteEditor = $(editor).find(".delete-editor");
    var editorName = $(editor)
      .find("textarea")
      .attr("id");
    $(deleteEditor).on("click", function() {
     if (CKEDITOR.instances.hasOwnProperty(editorName)) {
        CKEDITOR.instances[editorName].destroy();
        $(editor).remove();
      }
    });
  });
}

$(document).ready(function() {
  $(".ckeditor").each(function(_, ckeditor) {
    CKEDITOR.replace(ckeditor, {
                            extraPlugins:'ckeditor_wiris,html5video,html5audio',
                            allowedContent: true,
                            filebrowserUploadUrl: "upload.php?type=file",
                            filebrowserImageUploadUrl: "upload.php?type=image",
                        });
  });

  $(".chapter-video").each(function(_, chapterVideo) {
    var chapterVideoInput = $(chapterVideo).find(".file-input");
    var chapterFileUploadName = $(chapterVideo).find(".upload-file-name");
    $(chapterVideoInput).on("change", function(e) {
      var filesLength = e.target.files.length;
      if (filesLength) {
        $(chapterFileUploadName)
          .find("span")
          .text(e.target.files[0].name);
      }
    });
  });
  $(".add-chapter-para").each(function(_, addParaBtn) {
    var addTo = $(addParaBtn).data("add-to");
    $(addParaBtn).on("click", function() {
      createNewEditor(addTo);
      deleteEditor();
    });
  });
});




</script>
</html>