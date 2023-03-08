<?php
include "../../configration/config.php";
include "../../functions/db_functions.php";
$records = GetRecords("resources",array());
$img_table = "";
foreach($records as $record)
{
	$img_id = $record['id'];	
	$img_name = $record['filename'];	
	$img_size = $record['filesize']." KB";
	$updated_on = date("d-m-Y H:i:s",strtotime($record['updated_on']));

	$img_table .= "<tr>";
	$img_table .="<td class=\"wd-5p\">
	<label class=\"ckbox mg-b-0\">
	<input type=\"checkbox\"><input type=\"hidden\" value=\"$img_id\"><span ></span>
	</label>
	</td>";
	$img_table .= "<td><img src=\"../img/avatar/dummy.jpg\" class=\"wd-15\" alt=\"\"><span class=\"pd-l-5\">$img_name</span></td>";
	$img_table .= "<td class=\"hidden-xs-down\">$updated_on</td>";
	$img_table .= "<td class=\"hidden-xs-down\">$img_size</td>";
	$img_table .= "<td class=\"hidden-xs-down\">jpeg</td>";
	$img_table .= "<td class=\"dropdown\">
	<a href=\"#\" data-toggle=\"dropdown\" class=\"btn pd-y-3 tx-gray-500 hover-info\"><i class=\"icon ion-more\"></i></a>
	<div class=\"dropdown-menu dropdown-menu-right pd-10\">
	<nav class=\"nav nav-style-1 flex-column\">
	<a href=\"#\" class=\"nav-link info\" id=\"$img_id\">Info</a>
	<a href=\"upload/$img_name\" class=\"nav-link\" download>Download</a>
	<a href=\"#\" class=\"nav-link delete\" id=\"$img_id\">Delete</a>
	</nav>
	</div>
	</td>";
	$img_table .= "</tr>";
}
$data = <<<EOD
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
	
	$img_table  
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