<?php 
  include_once "../../session_token/checksession.php";
  include_once "../../configration/config.php";
  include_once "../../configration/config_schools.php";
  //include_once "session_token/checktoken.php";
  require_once "../../functions/db_functions.php";

  //Get Saved Data
  $review = array();
  $student = array();
  $query = "SELECT * FROM `global_content_status` WHERE master_database = '$master_db'";
  $stmt = $dbs->query($query);
  while($rows = $stmt->fetch(PDO::FETCH_ASSOC)) { 
    if($rows['content4review']) {
      array_push($review, $rows['courseid']);
    }
    if($rows['content4student']) {
      array_push($student, $rows['courseid']);
    }
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

    <title></title>

    <!-- vendor css -->
    <link href="../../../lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../../lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../../lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../../../lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../../../lib/highlightjs/github.css" rel="stylesheet">
    <link href="../../../lib/ajax_loader/jquery.mloading.css" rel="stylesheet">
    <link href="../../../lib//fileinputs/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <!-- CMS CSS -->
    <link rel="stylesheet" href="../../../css/cms.css">
    <style type="text/css">
      .br-pagebody {
        margin-top: 0px;
      }
      /*.card-body{
        height: 65vh;
        overflow-y: auto;
      }*/
	  input[type="checkbox"]:checked + span {
	  	background-color:#18a4b2;
		color:#ffffff;
		padding:2px;
	  }
	  #toast {
        visibility: hidden;
        max-width: 50px;
        height: 50px;
        /*margin-left: -125px;*/
        margin: auto;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 2px;

        position: fixed;
        z-index: 1;
        left: 0;right:0;
        bottom: 30px;
        font-size: 17px;
        white-space: nowrap;
    }
    #toast #img{
      width: 50px;
      height: 50px;
        
        float: left;
        
        padding-top: 16px;
        padding-bottom: 16px;
        
        box-sizing: border-box;

        
        background-color: #111;
        color: #fff;
    }
    #toast #desc{

        
        color: #fff;
       
        padding: 16px;
        
        overflow: hidden;
      white-space: nowrap;
    }

    #toast.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, expand 0.5s 0.5s,stay 3s 1s, shrink 0.5s 2s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, expand 0.5s 0.5s,stay 3s 1s, shrink 0.5s 4s, fadeout 0.5s 4.5s;
    }
    th{
      text-align: center;
    }
    </style>
  </head>

  <body class="collapsed-menu">

    <!-- ########## START: LEFT PANEL ########## -->
    <?php include("../../fixed-blocks/left_sidebar.php"); ?>
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <?php include("../../fixed-blocks/header.php"); ?>
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="br-pagetitle">
      </div><!-- d-flex -->

      <div class="br-pagebody">
        <!-- start you own content here -->
        <div class="card h-100 d-flex flex-column justify-content-between">
          <div class="card-header tx-medium bd-0 tx-white bg-dark">
            Topics - Enable Topic
          </div><!-- card-header -->
          <form class="user_form form-horizontal" action="save_topic_relase_status.php" name="user_form" method="POST">
            <div class="card-body bd bd-t-0 rounded-bottom">
              <div class="row text-center">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Class</th>
                      <th>Topic</th>
                      <th>Content for Review</th>
                      <th>Content for Student's</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      function get_categories($id)
                      {
                        try{
                          global $master_db;
                          global $db;
                          $ids = array();
                          $query = "SELECT id, name FROM $master_db.mdl_course_categories WHERE parent = '$id' AND visible=1 ORDER BY sortorder ASC";
                          $stmt = $db->query($query);
                          while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
                            $ids[] = array("Type"=>"Category", "id"=>$rows['id'], "Name"=>$rows['name']);
                          }
                          return $ids;
                        } catch(Exception $exp){
                          echo "<pre/>";
                          print_r($exp);
                        }
                      }

                      function get_courses($id)
                      {
                        try{
                          global $master_db;
                          global $db;
                          $ids = array();
                          $query = "SELECT id, fullname FROM $master_db.mdl_course WHERE category = '$id' AND visible=1 ORDER BY sortorder ASC";
                          $stmt = $db->query($query);
                          while($rows = $stmt->fetch(PDO::FETCH_ASSOC))
                           $ids[] = array("Type"=>"Course", "id"=>$rows['id'], "name"=>$rows['fullname']);
                          return $ids;
                        } catch(Exception $exp){
                          echo "<pre/>";
                          print_r($exp);
                        }
                      }

                      function getchildren($id){
                        try{
                          global $master_db;
                          global $db;
                          $subcat = get_categories($id);
                          $sublist = array();
                          foreach($subcat as $cat){
                            
                              //$courselist[] = array("Type"=>"Category", "Category"=>$ "id"=>$cat['id'], "Name"=>$cat['Name']);
                              array_push($sublist,array('name'=>$cat['Name'], 'catid' => $cat['id'], 'children'=>getchildren($cat['id'])));
                              //getchildren($cat['id'], $courselist);
                          }
                          
                          $courses = get_courses($id);
                          

                          
                          foreach($courses as $course){
                              array_push($sublist,array('name'=>$course['name'], 'id' => $course['id']));
                              //$courselist[] = array("Type"=>"Course", "id"=>$course['id'], "Name"=>$course['Name']);
                          }
                          return $sublist;
                        } catch(Exception $exp){
                          echo "<pre/>";
                          print_r($exp);
                        }
                      }
                       try{                                     
                     // $class = intval($_GET['class']);
                      $courselist = array();
                      $query = "SELECT id, name, visible FROM $master_db.mdl_course_categories WHERE name LIKE 'Class %' AND visible=1 order by name";
                      $stmt = $db->query($query);
                      while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $categoryid = $rows['id'];
                        $courselist = getchildren($categoryid);

                      foreach($courselist as $list1)
                      {
                    ?>
                        <tr>
                          <td> <?php echo $rows['name']; ?> </td>
                          <td style="text-align:left"><?php echo $list1['name']; ?></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <?php 
                        //foreach($list1['children'] as $list2)
                        {
                        ?>
                          <?php 
                          foreach($list1['children'] as $list2)
                          {
                          ?>
                            <tr>
                              <td> <?php echo $rows['name']; ?> </td>
                              <td style="text-align:left; padding-left:50px"><?php echo $list2['name']; ?></td>
                              <td></td>
                              <td></td>
                            </tr>

                            <?php 
                              foreach($list2['children'] as $list3)
                              {
                            ?>
                                <input type="hidden" name="class_name[<?php echo $list3['id'] ?>]" value="<?php echo $rows['name']; ?>">
                                <input type="hidden" name="topic_name[<?php echo $list3['id'] ?>]" value="<?php echo $list3['name']; ?>">
                                <tr>
                                  <td> <?php echo $rows['name']; ?> </td>
                                  <td style="text-align:left; padding-left:100px"><?php echo $list3['id'].' - '.$list3['name']; ?></td>
                                  <td>
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="checkbox" name="topic_id_review[<?php echo $list3['id'] ?>]" class="form-check-input" value="<?php echo $list3['id'] ?>" <?php if(in_array($list3['id'], $review)) { ?> checked="checked" <?php } ?>>
                                      </label>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="checkbox" name="topic_id_student[<?php echo $list3['id'] ?>]" class="form-check-input" value="<?php echo $list3['id'] ?>" <?php if(in_array($list3['id'], $student)) { ?> checked="checked" <?php } ?>>
                                      </label>
                                    </div>
                                  </td>
                                </tr>
                    <?php
                              }
                          }
                        }
                      }// foreach
                      }//enf of while loop
                    } catch(Exception $exp){
                      echo "<pre/>";
                      print_r($exp);
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div><!-- card-body -->
           
            <div class="card-footer bd bd-t-0 d-flex justify-content-between">
              <a href="<?php echo $web_root ?>app/home.php" class="btn btn-md btn-danger">Cancel</a>
              <button type="submit" class="btn btn-md btn-info pull-right" id="submit" name="submit">Submit</button>
            </div><!-- card-footer -->
          </form>   
        </div>
        <div id="toast"><div id="img">Status</div><div id="desc"></div></div>
      </div><!-- br-pagebody -->
    </div><!-- br-mainpanel -->

    <div class="modal fade  bs-example-modal-sm" id="loader_modal"  data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-body">
                <p class="text-bold text-center text-bold">Loading..Please Wait..</p>
              </div>
          </div>
      </div>
  </div>

    <!-- ########## END: MAIN PANEL ########## -->

    <script src="../../../lib/jquery/jquery.js"></script>
    <script src="../../../lib/popper.js/popper.js"></script>
    <script src="../../../lib/bootstrap/bootstrap.js"></script>
    <script src="../../../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../../../lib/moment/moment.js"></script>
    <script src="../../../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../../../lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../../../lib/peity/jquery.peity.js"></script>
    <script src="../../../lib/ajax_loader/jquery.mloading.js"></script>
    <script src="../../../lib/fileinputs/js/fileinput.js" type="text/javascript"></script>
    <script src="../../../lib/jqueryToast/jquery.toaster.js"></script>
    <script src="../../../js/cms.js"></script>
    <script>
    	function launch_toast() {
    		  var x = document.getElementById("toast")
    		  x.className = "show";
    		  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
    	}
      $(function () {
        $('.user_form').on('submit', function(event) {
          event.preventDefault();

          $.ajax({
            url: 'save_topic_relase_status.php',
            method:'POST',
            data:new FormData(this),
            contentType:false,
            processData:false,
            async:true,
            success:function(data)
            {
              
              console.log(data);
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
      });
    </script>
  </body>
</html>
