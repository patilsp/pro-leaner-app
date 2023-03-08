<?php
$data = <<<EOD
<div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
  <div class="card bd-0">
    <div class="card-header tx-medium bd-0 tx-white bg-mantle"  id="headingOne">
      <a data-toggle="collapse" class="tx-white" data-parent="#accordion" href="#collapseOne"
      aria-expanded="true" aria-controls="collapseOne">
        Upload Videos
      </a>
    </div><!-- card-header -->
    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="card-body bd bd-t-0 rounded-bottom">
        <br/>
        <div class="col-md-12">
          <div class="form-group">
            <label for="inst_gd">Enter Tags:</label>
            <input type="text" id="tags" value="LS,TS,ES,WE" data-role="tagsinput">
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="file_img">Attach Files:</label>
            <div class="file-loading">
              <input id="file_img" type="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="2">
            </div>
          </div>
        </div>
      </div><!-- card-body -->
      <div class="card-footer bd bd-t-0 d-flex justify-content-center">
        <button class="btn btn-md btn-info float-right">Upload</button>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card bd-0">
      <div class="card-body bd bd-t-0 rounded-bottom">
        <div class="row">
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <div class="form-group mg-b-0">
              <label>Class:</label>
              <input type="email" name="email" class="form-control parsley-success" required="">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <div class="form-group mg-b-0">
              <label>Topic:</label>
              <input type="email" name="email" class="form-control parsley-success" required="">
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <div class="form-group mg-b-0">
              <label>Keywords:</label>
              <input type="email" name="email" class="form-control parsley-success" required="">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table mg-b-0">
              <thead>
                <tr>
                  <th class="wd-5p">
                    <label class="ckbox mg-b-0">
                      <input type="checkbox"><span></span>
                    </label>
                  </th>
                  <th class="tx-10-force tx-mont tx-medium">Name</th>
                  <th class="tx-10-force tx-mont tx-medium hidden-xs-down">Date</th>
                  <th class="tx-10-force tx-mont tx-medium hidden-xs-down">Size</th>
                  <th class="tx-10-force tx-mont tx-medium hidden-xs-down">Type</th>
                  <th class="wd-5p"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="valign-middle">
                    <label class="ckbox mg-b-0">
                      <input type="checkbox"><span></span>
                    </label>
                  </td>
                  <td>
                    <img src="../img/avatar/dummy.jpg" class="wd-20" alt="">
                    <span class="pd-l-5">23424343.jpg</span>
                  </td>
                  <td class="hidden-xs-down">21/03/2018</td>
                  <td class="hidden-xs-down">781.4 KB</td>
                  <td class="hidden-xs-down">jpeg</td>
                  <td class="dropdown">
                    <a href="#" data-toggle="dropdown" class="btn pd-y-3 tx-gray-500 hover-info"><i class="icon ion-more"></i></a>
                    <div class="dropdown-menu dropdown-menu-right pd-10">
                      <nav class="nav nav-style-1 flex-column">
                        <a href="#" class="nav-link">Info</a>
                        <a href="#" class="nav-link">Download</a>
                        <a href="#" class="nav-link">Delete</a>
                      </nav>
                    </div><!-- dropdown-menu -->
                  </td>
                </tr>
                <tr>
                  <td class="valign-middle">
                    <label class="ckbox mg-b-0">
                      <input type="checkbox"><span></span>
                    </label>
                  </td>
                  <td>
                    <img src="../img/avatar/dummy.jpg" class="wd-20" alt="">
                    <span class="pd-l-5">23424343.jpg</span>
                  </td>
                  <td class="hidden-xs-down">21/03/2018</td>
                  <td class="hidden-xs-down">781.4 KB</td>
                  <td class="hidden-xs-down">jpeg</td>
                  <td class="dropdown">
                    <a href="#" data-toggle="dropdown" class="btn pd-y-3 tx-gray-500 hover-info"><i class="icon ion-more"></i></a>
                    <div class="dropdown-menu dropdown-menu-right pd-10">
                      <nav class="nav nav-style-1 flex-column">
                        <a href="#" class="nav-link">Info</a>
                        <a href="#" class="nav-link">Download</a>
                        <a href="#" class="nav-link">Delete</a>
                      </nav>
                    </div><!-- dropdown-menu -->
                  </td>
                </tr>
                <tr>
                  <td class="valign-middle">
                    <label class="ckbox mg-b-0">
                      <input type="checkbox"><span></span>
                    </label>
                  </td>
                  <td>
                    <img src="../img/avatar/dummy.jpg" class="wd-20" alt="">
                    <span class="pd-l-5">23424343.jpg</span>
                  </td>
                  <td class="hidden-xs-down">21/03/2018</td>
                  <td class="hidden-xs-down">781.4 KB</td>
                  <td class="hidden-xs-down">jpeg</td>
                  <td class="dropdown">
                    <a href="#" data-toggle="dropdown" class="btn pd-y-3 tx-gray-500 hover-info"><i class="icon ion-more"></i></a>
                    <div class="dropdown-menu dropdown-menu-right pd-10">
                      <nav class="nav nav-style-1 flex-column">
                        <a href="#" class="nav-link">Info</a>
                        <a href="#" class="nav-link">Download</a>
                        <a href="#" class="nav-link">Delete</a>
                      </nav>
                    </div><!-- dropdown-menu -->
                  </td>
                </tr>
                <tr>
                  <td class="valign-middle">
                    <label class="ckbox mg-b-0">
                      <input type="checkbox"><span></span>
                    </label>
                  </td>
                  <td>
                    <img src="../img/avatar/dummy.jpg" class="wd-20" alt="">
                    <span class="pd-l-5">23424343.jpg</span>
                  </td>
                  <td class="hidden-xs-down">21/03/2018</td>
                  <td class="hidden-xs-down">781.4 KB</td>
                  <td class="hidden-xs-down">jpeg</td>
                  <td class="dropdown">
                    <a href="#" data-toggle="dropdown" class="btn pd-y-3 tx-gray-500 hover-info"><i class="icon ion-more"></i></a>
                    <div class="dropdown-menu dropdown-menu-right pd-10">
                      <nav class="nav nav-style-1 flex-column">
                        <a href="#" class="nav-link">Info</a>
                        <a href="#" class="nav-link">Download</a>
                        <a href="#" class="nav-link">Delete</a>
                      </nav>
                    </div><!-- dropdown-menu -->
                  </td>
                </tr>
                <tr>
                  <td class="valign-middle">
                    <label class="ckbox mg-b-0">
                      <input type="checkbox"><span></span>
                    </label>
                  </td>
                  <td>
                    <img src="../img/avatar/dummy.jpg" class="wd-20" alt="">
                    <span class="pd-l-5">23424343.jpg</span>
                  </td>
                  <td class="hidden-xs-down">21/03/2018</td>
                  <td class="hidden-xs-down">781.4 KB</td>
                  <td class="hidden-xs-down">jpeg</td>
                  <td class="dropdown">
                    <a href="#" data-toggle="dropdown" class="btn pd-y-3 tx-gray-500 hover-info"><i class="icon ion-more"></i></a>
                    <div class="dropdown-menu dropdown-menu-right pd-10">
                      <nav class="nav nav-style-1 flex-column">
                        <a href="#" class="nav-link">Info</a>
                        <a href="#" class="nav-link">Download</a>
                        <a href="#" class="nav-link">Delete</a>
                      </nav>
                    </div><!-- dropdown-menu -->
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div><!-- card-body -->
    </div>
  </div>
</div>
EOD;
echo $data;
?>