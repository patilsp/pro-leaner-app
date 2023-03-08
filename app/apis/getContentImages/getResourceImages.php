<?php
include_once "../../session_token/checksession.php";
include "../../configration/config.php";
try{

    $data = "";
    $query = "SELECT * FROM resources WHERE status_id=1 AND resource_type_id=1 AND class_id='".$_POST['class_id']."' AND topics_id='".$_POST['topic_id']."' ORDER BY id DESC";
    $stmt = $db->query($query);
    $rowcount = $stmt->rowCount();

    $data .='
        <div class="col-md-12">
            <div class="card bd-0">
              <div class="card-header bg-info bd-0 d-flex align-items-center justify-content-between pd-y-5">
                <h6 class="mg-b-0 tx-14 tx-black tx-normal">Image Upload</h6>
              </div><!-- card-header -->
              <form id="img_upload" enctype="multipart/form-data">
                <div class="card-body bd  rounded-bottom-0">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="files">Attach Files:</label>
                                <input type="file" class="form-control" name="img_res[]" id="img_res" multiple required="required"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tags">Tags:</label>
                                <input type="text" id="tags" class="form-control" name="tags" data-role="tagsinput" required="required">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" style="margin-top: 27px;" class="btn btn-info">Submit</button>
                        </div>
                    </div>
                </div><!-- card-body -->
              </form>
            </div>
        </div>
    ';
    if ($rowcount) {
        $data .='
        <div class="col-md-12">
            <div class="card bd-0">
                <div class="card-header bg-info bd-0 d-flex align-items-center justify-content-between pd-y-5">
                    <h6 class="mg-b-0 tx-14 tx-black tx-normal">Choose Images</h6>
                </div><!-- card-header -->
                <div class="card-body bd bd-t-0 rounded-bottom-0" style="height: 400px;overflow-y:scroll">
                    <table class="table table-responsive table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>File Name</th>
                            <th>Type/File Size</th>
                            <th>Choose Image</th>
                        </tr>
                        </thead>
                        <tbody>';
                        while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
                            $files_data = json_decode($fetch['filepath']);
                            foreach ($files_data as $item) {
                                $file_path = pathinfo($item);
                                $file_type = $file_path['extension'];
                                $file_name = $file_path['basename'];
                                $file_size = filesize($item);
                                $radio_val = str_replace("../../", $web_root."app/", $item);
                                if ($file_size >= 1024)
                                {
                                    $file_size_kb = number_format($file_size / 1024, 2) . ' KB';
                                }

                                $data.='
                                <tr data-name="'.$fetch["name"].'">
                                    <td>
                                        <img src="'.$item.'" class="img-responsive center-block">
                                    </td>
                                    <td>
                                        <a href="'.$item.'">'.$file_name.'</a>
                                    </td>
                                    <td><span>'.$file_type. '/' .$file_size_kb.'</span></td>
                                    <td>
                                        <label class="checked_btn btn btn-danger d-block mx-auto">
                                          <input type="radio" class=" btn btn-md btn-danger imgpath" name="imgpath" value="'.$radio_val.'"autocomplete="off"> '.$file_name.'
                                        </label>
                                    </td>
                                </tr>';
                            }
                        }
                        $data.='
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        ';
    } else {
        $data .='
        <div class="col-md-12">
            <div class="card bd-0">
                <div class="card-header bg-info bd-0 d-flex align-items-center justify-content-between pd-y-5">
                    <h6 class="mg-b-0 tx-14 tx-black tx-normal">List of Images</h6>
                </div><!-- card-header -->
                <div class="card-body bd bd-t-0 rounded-bottom-0">
                    <div class="well well-lg text-center"><strong>This folder is empty!</strong></div>
                </div>
            </div>
        </div>
        ';
    }

    echo $data;
}catch(Exception $exp){
    print_r($exp);
    return "false";
}
?>