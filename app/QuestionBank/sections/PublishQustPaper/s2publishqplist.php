<style type="text/css">
	.icon-down:before {
	    content: "\25BC";
	    font-size: 12px;
	    color: #000000;
	    cursor: pointer;
	}
	.dropdown-toggle:empty::after{
		content: none;
	}
	.dropdown-item{
		cursor: pointer;
	}
	.dropdown-menu.show{
		border-radius: 10px;
		box-shadow: 0 0 40px 0 rgba(0, 0, 0, 0.2);
		background-color: #ffffff;
	}
</style>
<div class="row align-items-center justify-content-center h-100 pb-4 d-none" id="viewedit_qust_list">
	<div class="col-12 p-0 h-100">
		<div class="card border-0">
		  <div class="card-header bg-white">
		    <h5 class="font-weight-bold m-0"><span id="filter_heading"></span></h5>
		  </div>
		  
		  <div class="card-body table-responsive">
		    <table id="qust_table" class="table" style="width:100%">
	        <thead>
            <tr class="text-center">
              <th>
              	<div class="d-flex align-items-center">
                	<input class="form-check-input qust_paper_list m-0 position-relative" type="checkbox" value="qust_all" id="selectAll">
                	<span class='icon-down ml-1 dropdown-toggle dropdown-toggle-split px-0' id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent"></span>
                	<div class="dropdown-menu border-0" aria-labelledby="dropdownMenuReference">
				      <p class="dropdown-item active" data-action="viewall">View All</p>
				      <p class="dropdown-item" data-action="published">Published</p>
				      <p class="dropdown-item mb-0" data-action="notpublished">Not Published</p>
				    </div>
            	</div>
              </th>
              <th>Question Paper Code</th>
              <th>Title</th>
              <th>Total Marks</th>
              <th></th>
            </tr>
	        </thead>
	        <tbody>
          </tbody>
        </table>
	    </div>
  	</div>
	</div>
</div>