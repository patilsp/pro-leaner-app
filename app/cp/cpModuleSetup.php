<?php
include_once "../session_token/checksession.php";
include_once "../configration/config.php";
include "../functions/db_functions.php";
//include_once "session_token/checktoken.php";
$token=$_SESSION['token'];
$logged_user_id=$_SESSION['cms_userid'];
$user_type = $_SESSION['cms_usertype'];
$role_id = $_SESSION['user_role_id'];
try {
  include "functions/common_function.php";
  $getCPClasses = getCPClasses();
  /*echo "<pre/>";
  print_r($getCPClasses);die;*/

  $disableEditAddActionStatusClass = '';
  if($role_id == 8){
    $disableEditAddActionStatusClass = 'disableEditAddAction';
  }
} catch(Exception $exp){
  print_r($exp);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Virtual School</title>
    <link rel="icon" type="image/png" href="../../img/favicon.png" />

    <!-- vendor css -->
    <link href="../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../lib/highlightjs/github.css" rel="stylesheet">
    <link href="../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../css/cms.css">
    <link href="links/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <!-- orgchart CSS -->
    <link rel="stylesheet" href="../../lib/orgchart/jquery.orgchart.css?ver=231120211126">
    <style type="text/css">
      .orgChartDiv{
          width: auto;
          height: auto;
      }

      .orgChartContainer{
          overflow: auto;
          background: #eeeeee;
      }
      .disableEditAddAction{
        pointer-events: none;
      }

      .accordion .card {
        box-shadow: 0 0 0.375rem 0.25rem rgb(161 172 184 / 15%);
        border-radius: 5px;
        margin-bottom:10px

      }
      .fs-18{
        font-size: 18px !important;
      }
      .fw-4{
        font-wfont-weight: 400 !important;
      }
      .collapsed{
        cursor: pointer;
      }
    </style>
  </head>

  <body  id="kt_body"  class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
    <?php include("../fixed-blocks/header.php"); ?>   

      <div class="row">
          <div class="col-md-12">
            <!-- start you own content here -->
            <div class="card h-100 d-flex flex-column justify-content-between">
              <div class="card-header card-header d-flex align-items-center justify-content-between pd-y-5">
                <h6 class="mg-b-0 tx-14">Module SetUp</h6>
              </div><!-- card-header -->
              <div class="card-body">
                <div class="accordion" id="moduleSetupAccordion">
                  <input type="hidden" id="classId" value="">
                  <input type="hidden" id="openedCard" value="">
                  <?php
                    foreach ($getCPClasses['classes'] as $class) {
                      $classId = $class['id'];
                      $classCode = explode(" ", $class['module']);
                      $classCode = $classCode[1];

                  ?>
                  <div class="card">
                    <div class="card-header" id="heading_<?php echo $classCode; ?>">
                      <h2 class="mb-0">
                       
                          <h5 class="mb-0 flex-grow-1 collapsed p-3 fw-4" data-toggle="collapse" data-target="#collapse_<?php echo $classId; ?>" aria-expanded="true" aria-controls="collapse_<?php echo $classId; ?>">
                            <span class="fw-4">Class <?php echo $classCode; ?></span>
                          </h5>
                        
                        <div class="d-flex align-items-center btn btn-sm btn-icon btn-light btn-default collapsed" data-toggle="collapse" data-target="#collapse_<?php echo $classId; ?>" aria-expanded="true" aria-controls="collapse_<?php echo $classId; ?>">
                        <p class="mb-0 "></p>
                        <i class="fa fa-chevron-down"></i>
                      </div>
                     
                      </h2>
                    </div>



                    <div id="collapse_<?php echo $classId; ?>" class="collapse" aria-labelledby="heading_<?php echo $classCode; ?>" data-parent="#moduleSetupAccordion">
                      <div class="card-body <?php echo $disableEditAddActionStatusClass; ?>">
                        <div class="orgChartContainer">
                          <h1 class="containerHeadinng text-center">START</h1>
                          <div id="orgChart<?php echo $classId ?>" class="orgChartDiv"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                    } // end foreach
                  ?>
                </div>
              </div><!-- card-body -->
            </div>
          </div>
        </div>
    </div>

    <?php include("../fixed-blocks/footer.php"); ?>
    <!-- ########## END: MAIN PANEL ########## -->
    <script src="../../lib/jquery/jquery.js"></script>
    <script src="../../lib/popper.js/popper.js"></script>
    <script src="../../lib/bootstrap/js/bootstrap.js"></script>
    <script src="../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../lib/moment/moment.js"></script>
    <script src="../../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../lib/peity/jquery.peity.js"></script>
    <script src="../../lib/highlightjs/highlight.pack.js"></script>
    <script src="../../lib/orgchart/jquery.orgchart.js"></script>
    <script src="../../lib/ajax_loader/jquery.mloading.js"></script>
    <script src="../../js/cms.js"></script>
    
    <script src="../../links/plugins/global/plugins.bundle.js"></script>
    <script src="../../links/js/scripts.bundle.js"></script>
    <script src="../../links/plugins/custom/datatables/datatables.bundle.js"></script>

    <script type="text/javascript">
      var openedCard = '';
      var openedCardArray = [];
      $('#moduleSetupAccordion').on('show.bs.collapse', function (event) {
        var id = event.target.id;
        var classId = id.split('_');
        classId = classId[1];
        openedCard='orgChart'+classId;
        $('#classId').val(classId);
        $('#openedCard').val(openedCard);
        getTreeData(classId, openedCard);
      })

      function getTreeData(classId, openedCard) {
        $.ajax({
          url:"apis/getCPClassSubjectChapterTopics.php",
          method:'POST',
          data:"id="+classId+"&type=getAllDataForTheClass",        
          async:true,
          success:function(data)
          {
            var json = $.parseJSON(data);
           
            if(json.status) {
              var treeData = json.result;
              
              updateTree(openedCard, treeData);
            }
          },
          beforeSend: function(){
            $("body").mLoading('show');
          },
          complete: function(){
            $("body").mLoading('hide');
          }
        });
      }

      function updateTree(openedCard, treeData){
        org_chart = $('#'+openedCard).orgChart({
          data: treeData,
          showControls: true,
          allowEdit: true,
          onAddNode: function(node){
              saveCategory(node.data.id, 'add'); 
              org_chart.newNode(node.data.id);
          },
          onDeleteNode: function(node){
              saveCategory(node.data.id, 'delete');
              org_chart.deleteNode(node.data.id); 
          },
          onClickNode: function(node){
              console.log('Clicked node '+node.data.id);
          }
        });
      }

      function saveCategory(id, type, value="", category="") {
        // alert('cpModuleSetup---'+id);
        var classId = $('#classId').val();
        var openedCard = $('#openedCard').val();

        $data = "id="+id+"&type="+type;
        if(type === 'update') {
          $data = "id="+id+"&type="+type+"&value="+value+"&category="+category;
        }
        $.ajax({
          url:"apis/modules.php",
          method:'POST',
          data:$data,        
          async:true,
          success:function(data)
          {
            var json = $.parseJSON(data);
          
            if(json.status) {
              getTreeData(classId, openedCard);
            }
          },
          beforeSend: function(){
            $("body").mLoading('show');
          },
          complete: function(){
            $("body").mLoading('hide');
          }
        });
      }
    </script>
  </body>
</html>
