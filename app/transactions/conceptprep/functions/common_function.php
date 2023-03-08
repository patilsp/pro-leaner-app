<?php
	function getCPClasses()
	{
		global $db;
		try{
			$data = array();
			$class_arr = GetRecords("cpmodules", array("parentId"=>0, "deleted"=>0));
			$data['classes'] = $class_arr;
			return $data;
		} catch(Exception $exp) {
			echo "<pre/>";
			print_r($exp);
		}
	}

	function getCPSubject($classId, $subjectId)
	{
		global $db;
		try{
			$subject = GetRecord("cpmodules", array("id"=>$subjectId, "parentId"=>$classId, "deleted"=>0));
			return $subject['module'];
		} catch(Exception $exp) {
			echo "<pre/>";
			print_r($exp);
		}
	}

	function getSlides($class, $subject_id)
	{
		global $db;
		global $master_db;
		try{
			$class_id = $class;
			$subject_id = $subject_id;
			//this module will get from mdl_modules table
			$module = "13";
			$data = "";
			$previSlideInfo = "";
			$accordionExpand = true;
			$accordionShow = 'show';
			$dataArray = array();
			//get chapters, topics and sub-topics
			$getChapters = GetRecords("cpmodules", array("parentId"=>$subject_id, "type"=>'chapter', "deleted"=>0));
			if(count($getChapters) > 0){
				foreach ($getChapters as $chapter) {
					$chapter_id = $chapter['id'];
					$getTopics = GetRecords("cpmodules", array("parentId"=>$chapter['id'], "type"=>'topic', "deleted"=>0));
					
					foreach ($getTopics as $topic) {
						$topic_id = $topic['id'];
						$getSubTopics = GetRecords("cpmodules", array("parentId"=>$topic['id'], "type"=>'subTopic', "deleted"=>0));
						
						foreach ($getSubTopics as $subTopic) {
							$sub_topic_id = $subTopic['id'];
							$chapTopicSubTopic = $chapter['module'].' / '.$topic['module'].' / '.$subTopic['module'];
							$data .= '<div class="w-100 cardSlidesBlock" id="cardSlidesBlock_'.$sub_topic_id.'">';
							$data .= '<label class="sidebar-label pd-x-10 mg-t-25 mg-b-20 tx-info">"'.$chapTopicSubTopic.'"</label>';

							//$previSlideInfo .= '<div class="w-100" id="cardSlidesBlock_'.$sub_topic_id.'">';
							//$previSlideInfo .= '<label class="sidebar-label pd-x-10 mg-t-25 mg-b-20 tx-info">"'.$chapTopicSubTopic.'"</label>';
							$previSlideInfo .= '
								<div class="card" id="cardSlidesBlock_'.$sub_topic_id.'">
								    <div class="card-header p-0" id="heading'.$sub_topic_id.'">
								      <h5 class="mb-0">
								        <button class="btn btn-link w-100 text-left" data-toggle="collapse" data-target="#collapse'.$sub_topic_id.'" aria-expanded="'.$accordionExpand.'" aria-controls="#collapse'.$sub_topic_id.'">
								          '.$chapTopicSubTopic.'
								        </button>
								      </h5>
								    </div>

							  	  	<div id="collapse'.$sub_topic_id.'" class="collapse '.$accordionShow.'" aria-labelledby="heading'.$sub_topic_id.'" data-parent="#accordion">
								      <div class="card-body">								    
							';

							$slides = GetRecords("cpadd_slide_list", array("class"=>$class_id, "subject_id"=>$subject_id, "chapter_id"=>$chapter['id'], "topic_id"=>$topic['id'], "sub_topic_id"=>$subTopic['id']), array("sequence"));
		          if(count($slides) > 0) {
		            foreach ($slides as $slide) {
		              $subject_id = $slide['subject_id'];
		              $chapter_id = $slide['chapter_id'];
		              $topic_id = $slide['topic_id'];
		              $sub_topic_id = $slide['sub_topic_id'];
		              $layout_id = $slide['layout_id'];
		              //Layout 6 id's getting and comparing for to display frountend to identify easily - added on 03/05/2021
		              $layout6_ids = array(10, 23, 24, 25, 26);
		              $layout_id_name = '';
		              if(in_array($layout_id, $layout6_ids)) {
		              	$layout_id_name = 'Layout6 - ';
		              }

		              //Start - checking any slides contains empty json data except DictionaryWords layout and slide_json column contains null values - 05/05/2021
		              $ignoreLayouts_ids = array(0, 5263);
		              $slideJSON = json_decode($slide['slide_json']);
						      $objectToArray = (array)$slideJSON;
						      $slideContentContains = "";
						      //echo "<pre/>";
						      //print_r($objectToArray);
						      if(!in_array($layout_id, $ignoreLayouts_ids)) {
						      	if(!empty($objectToArray)) {
								      foreach ($objectToArray as $key => $value)
			    					  {
			    					  	//echo 'key---'.$objectToArray[$key];
			    					  	if(isset($objectToArray[$key]) && !is_array($objectToArray[$key])){
											    //this means key exists and the value is not a array
											    if(trim($objectToArray[$key]) != '') {
											    	//value is null or empty string or whitespace only
												    $slideContentContains = "";
											    	break;
										    	} else {
														//echo "else 111";echo '<br/>';
														$slideContentContains = 'slide Empty - ';
													}
												} elseif (is_array($objectToArray[$key])) {
												foreach ($value as $key1 => $value1)
			    					  			{
			    					  				//echo "value 1---".$value1;echo "<br/>";
			    					  				if(trim($value[$key1]) != '') {
			    					  					//value is null or empty string or whitespace only
				    					  				//echo "value 1---".$value1;echo "<br/>";
									  					$slideContentContains = "";
											    		break;
										    		} else {
										    			$slideContentContains = 'slide Empty - ';
										    		}
								  				}
												} else {
													//echo "else end";echo '<br/>';
													$slideContentContains = 'slide Empty - ';
												}
							  			}
							  		} else {
							  			$slideContentContains = 'slide Empty - ';
							  		}
								  }
								  //End - checking any slides contains empty json data except DictionaryWords layout and slide_json column contains null values - 05/05/2021

		              $slide_title = $slide['slide_title'];
		              $taskid = $slide['task_assign_id'];
		              $id = $slide['id'];
		              $classid = $slide['class'];
		              $slide_file_path = $slide['slide_file_path'];
		              $previSlidePath = $slide['slide_file_path'];
		              $slidePraticeQuestionLayout = 'false';
	              	$query_ln = "SELECT name,resource_type_id  FROM resources WHERE id='".$layout_id."'";
		    				  $stmt_ln = $db->query($query_ln);
		    				  while($fetch_ln = $stmt_ln->fetch(PDO::FETCH_ASSOC)){
	    				  		$layout_name = $fetch_ln['name'];
	    				  		if($fetch_ln['resource_type_id'] == 7 || $fetch_ln['resource_type_id'] == 8) {

	    				  			$previSlidePath = $previSlidePath.'?api_end_point=getactivitydata.php&qust_id='.$id;
	    				  		}
    				  	  }

				  	  // $previSlideInfo .= '
				  	  // 	<div class="card previSlideCard'.$id.'" id="previSlideCard'.$id.'" data-iFrameSrc="'.$previSlidePath.'">
		       //              <div class="card-header">
		       //                <button title="Click and View" type="button" data-taskid="'.$taskid.'" data-autoid="'.$id.'" data-subject_id="'.$subject_id.'" data-chapter_id="'.$chapter_id.'" data-topic_id="'.$topic_id.'" data-sub_topic_id="'.$sub_topic_id.'" data-slidepath="'.$slide_file_path.'" data-classid="'.$classid.'" data-layoutid="'.$layout_id.'" data-layoutname="'.$layout_name.'" class="btn btn-dafault btn-oblong btn-block bd-0 tx-11 tx-semibold pd-y-12 tx-mont tx-uppercase tx-spacing-1 clickSavedSlides" style="white-space: normal;">Edit - '.$slideContentContains.$layout_id_name.$slide_title.'</button>

		       //                <button type="button" class="delete_slide deleteFromPreviewMode btn btn-md btn-danger" data-slide_id ="'.$id.'" data-slide_title ="'.$slide_title.'"><span>&times</spa></button>
		       //              </div>
		       //              <div class="card-body">
		       //                <div class="iframe_wrapper">
		                        
		       //                </div>               
		       //              </div>
	        //           	</div>
				  	  // ';
				  	  $iframeSrcPath = '';
				  	  if ($accordionExpand){
				  	  	$iframeSrcPath = '<iframe width="100%" id="previSlideFrame'.$id.'" height="670px" src="'.$previSlidePath.'"></iframe>';
			  	  	  }
				  	  $previSlideInfo .= '
				        	<div class="card previSlideCard'.$id.'" id="previSlideCard'.$id.'" data-iFrameSrc="'.$previSlidePath.'">
			                    <div class="card-header">
			                      <button title="Click and View" type="button" data-taskid="'.$taskid.'" data-autoid="'.$id.'" data-subject_id="'.$subject_id.'" data-chapter_id="'.$chapter_id.'" data-topic_id="'.$topic_id.'" data-sub_topic_id="'.$sub_topic_id.'" data-slidepath="'.$slide_file_path.'" data-classid="'.$classid.'" data-layoutid="'.$layout_id.'" data-layoutname="'.$layout_name.'" class="btn btn-dafault btn-oblong btn-block bd-0 tx-11 tx-semibold pd-y-12 tx-mont tx-uppercase tx-spacing-1 clickSavedSlides" style="white-space: normal;">Edit - '.$slideContentContains.$layout_id_name.$slide_title.'</button>

			                      <button type="button" class="delete_slide deleteFromPreviewMode btn btn-md btn-danger" data-slide_id ="'.$id.'" data-slide_title ="'.$slide_title.'"><span>&times</spa></button>
			                    </div>
			                    <div class="card-body">
			                      <div class="iframe_wrapper">
			                        '.$iframeSrcPath.'
			                      </div>               
			                    </div>
		                  	</div>					      
				  	  ';

		              $data .= '
	              	<div class="row savedSlides cardSlide" data-sub_topic_id="'.$sub_topic_id.'" id="'.$id.'">
			              <div class="col-md-12">
			                <div class="card bd-0 shadow-base">
			                	<button type="button" class="delete_slide btn btn-md btn-danger" data-slide_id ="'.$id.'" data-slide_title ="'.$slide_title.'"><span>&times</spa></button>
		                		<div class="pd-y-40 pd-x-30 tx-center moveCursor" title="Click and Move">
			                  	<button title="Click and View" type="button" data-taskid="'.$taskid.'" data-autoid="'.$id.'" data-subject_id="'.$subject_id.'" data-chapter_id="'.$chapter_id.'" data-topic_id="'.$topic_id.'" data-sub_topic_id="'.$sub_topic_id.'" data-slidepath="'.$slide_file_path.'" data-classid="'.$classid.'" data-layoutid="'.$layout_id.'" data-layoutname="'.$layout_name.'" class="btn btn-dafault btn-oblong btn-block bd-0 tx-11 tx-semibold pd-y-12 tx-mont tx-uppercase tx-spacing-1 clickSavedSlides" style="white-space: normal;">'.$slideContentContains.$layout_id_name.$slide_title.'</button>
			                  </div>
			                </div>
			              </div>
			            </div>
		              ';
	              }// end of foreach loop
	              $data .='
	              <div class="row">
		              <div class="col-md-12">
		                <div class="card bd-0 shadow-base">
		                  <div class="pd-y-20 pd-x-30 tx-center">
		                    <h6 class="tx-inverse tx-roboto tx-normal mg-b-15">Click Here.. To</h6>
		                    <a href="#" class="btn btn-info btn-oblong btn-block bd-0 tx-11 tx-semibold pd-y-12 tx-mont tx-uppercase tx-spacing-1 topbarCollapse" data-classid ="'.$class_id.'" data-subjectid ="'.$subject_id.'" data-slidepath="'.$slide_file_path.'" data-chapter_id="'.$chapter_id.'" data-topic_id="'.$topic_id.'" data-sub_topic_id="'.$sub_topic_id.'">Add New Slide</a>
		                  </div>
		                </div>
		              </div>
		            </div>
	              ';
            	}// end of slide list count if loop
          		else {
      					$data .='
    						<div class="row">
		              <div class="col-md-12">
		                <div class="card bd-0 shadow-base">
		                <div class="pd-y-20 pd-x-30 tx-center">
		                  <h6 class="tx-inverse tx-roboto tx-normal mg-b-15">Click Here.. To</h6>
		                  <a href="#" class="btn btn-info btn-oblong btn-block bd-0 tx-11 tx-semibold pd-y-12 tx-mont tx-uppercase tx-spacing-1 topbarCollapse" data-classid ="'.$class_id.'" data-subjectid ="'.$subject_id.'" data-chapter_id="'.$chapter_id.'" data-topic_id="'.$topic_id.'" data-sub_topic_id="'.$sub_topic_id.'">Add New Slide</a>
		                </div>
		              </div>
		              </div>
		            </div>
      					';
    					} //end of else loop
    					$data .= '</div>';
    					$previSlideInfo .= '</div></div></div>';
    					$accordionExpand = false;
						$accordionShow = '';
						}
					}
				}
			}// end of if loop of getChapters
	    else {
	    	$data .='
	    	<div class="row">
	        <div class="col-md-12">
	          <div class="card bd-0 shadow-base">
	            <div class="pd-y-20 pd-x-30 tx-center">
	              <h5 class="tx-inverse tx-roboto tx-normal mg-b-15">No chapter, topic and sub-topic are created, Contact Admin.</h5>
	            </div>
	          </div>
	        </div>
	      </div>
	    	';
    	}// end of else loop of getChapters
    	

    	$dataArray['data'] = $data;
    	$dataArray['previSlideInfo'] = $previSlideInfo;
    	return $dataArray;
		} catch(Exception $exp) {
			echo "<pre/>";
			print_r($exp);
		}
	}

	//getSlides for Add Existing topics
	function getSlidesExistingTopic($web_root, $class_id, $topic_id, $json_prev_lessonid_slideid, $task_assi_id)
	{
		global $db;
		global $master_db;
		try{
			$data = array();
			$slide_count = 0;
			$selected_slide_id = 0;
			$query0 = "SELECT sequence FROM $master_db.mdl_course_sections WHERE course = ? AND sequence != ''";
			$stmt0 = $db->prepare($query0);
	  		$stmt0->execute(array($topic_id));
	  		if($fetch0 = $stmt0->fetch(PDO::FETCH_ASSOC))
	  			$sequence = $fetch0['sequence'];
	  		else
	  			$sequence = 0;
	  		$sequence_ids = array();
	  		$query0 = "SELECT instance FROM $master_db.mdl_course_modules WHERE course = ? ORDER BY FIELD (id, $sequence)";
	  		$stmt0 = $db->prepare($query0);
	  		$stmt0->execute(array($topic_id));
	  		while($fetch0 = $stmt0->fetch(PDO::FETCH_ASSOC)) {
	  			$sequence_ids[] = $fetch0['instance'];
	  		}
	  		if(count($sequence_ids) > 0) {
	  			$sequence_ids_string = implode(",", $sequence_ids);
	  		} else {
	  			$sequence_ids_string = "0";
	  		}

			$slides_arr = "";
			$query1 = "SELECT * FROM $master_db.mdl_lesson WHERE course = ? ORDER BY FIELD (id, $sequence_ids_string)";
			$stmt1 = $db->prepare($query1);
			$stmt1->execute(array($topic_id));
			$i=1;
			while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC))
			{
				$new_slides_prev_page_ids = array();
				foreach(json_decode($json_prev_lessonid_slideid) as $obj) {
					if($obj->lesson_id == $fetch1['id'])
						array_push($new_slides_prev_page_ids, $obj->prev_slide_id);
				}
				$chap_name = $fetch1['name'];

				$slides_arr.= '
					<label class="sidebar-label pd-x-10 mg-t-25 mg-b-20 tx-info">"'.$chap_name.'"</label>
				';
				$slide_sequences = array();
				$paths = array();
				$slide_ids = array();
				$nedpgids = array();
				$pvedpgids = array();
				$slide_titles = array();
				$page = GetRecord("$master_db.mdl_lesson_pages", array("lessonid"=>$fetch1['id'], "prevpageid"=>0));
				if(!isset($page['id']))
					continue;
				$nextpageid = $page['nextpageid'];
				array_push($paths, DecryptContent($page['contents']));
				array_push($slide_ids, $page['id']);
				array_push($nedpgids, $page['nextpageid']);
				array_push($pvedpgids, $page['prevpageid']);
				array_push($slide_titles, $page['title']);

				while($nextpageid != 0)
				{
					//echo "<br />$lessonid--$nextpageid--CAME";
					$page = GetRecord("$master_db.mdl_lesson_pages", array("lessonid"=>$fetch1['id'], "id"=>$nextpageid));				
					array_push($slide_sequences, $page['id']);
					$nextpageid = $page['nextpageid'];
					array_push($paths, DecryptContent($page['contents']));
					array_push($slide_ids, $page['id']);
					array_push($nedpgids, $page['nextpageid']);
					array_push($pvedpgids, $page['prevpageid']);
					array_push($slide_titles, $page['title']);
				}
				//echo "<pre/>";
				//print_r($slide_ids);
		  		$next_slide = 0;
		  		foreach($slide_ids as $key=>$slide_id)
		  		{
		  			
		  			if(in_array($next_slide, $new_slides_prev_page_ids)) {
		  				//next_slide exists in cpadd_slide_list table means fetch the path from the table
		  				$prev_slide_id_array = array();
		  				$cpadd_slide_list = GetRecords("cpadd_slide_list", array("prev_slide_id"=>$next_slide, "lesson_id"=>$fetch1['id']), array("sequence"));
		  				if(count($cpadd_slide_list) > 0) {
		  					foreach($cpadd_slide_list as $slide)
		  					{
			  					if($slide['status'] == 13)
			  						$new_slide = false;
			  					else {
			  						$new_slide = true;
			  						$id = $slide['id'];
				  					$layout_id = $slide['layout_id'];
				  					//Start - Layout 6 id's getting and comparing for to display frountend to identify easily - added on 03/05/2021
									$layout6_ids = array(10, 23, 24, 25, 26);
									$layout_id_name = '';
									if(in_array($layout_id, $layout6_ids)) {
										$layout_id_name = 'Layout6 - ';
									}
									//End - Layout 6 id's getting and comparing for to display frountend to identify easily - added on 03/05/2021
				  					$slide_title = $slide['slide_title'];
				  					$slide_file_path = $slide['slide_file_path'];
			  					}

			  					//Start - checking any slides contains empty json data except DictionaryWords layout and slide_json column contains null values - added on 05/05/2021
								$ignoreLayouts_ids = array(0, 5263);
								$slideJSON = json_decode($slide['slide_json']);
								$objectToArray = (array)$slideJSON;
								$slideContentContains = "";
								//echo "<pre/>";
								//print_r($objectToArray);
								if(!in_array($layout_id, $ignoreLayouts_ids)) {
								      foreach ($objectToArray as $key => $value)
			    					  {
			    					  	//echo 'key---'.$objectToArray[$key];
			    					  	if(isset($objectToArray[$key]) && !is_array($objectToArray[$key])){
										    //this means key exists and the value is not a array
										    if(trim($objectToArray[$key]) != '') {
										    	//value is null or empty string or whitespace only
											    $slideContentContains = "";
										    	break;
									    	} else {
												//echo "else 111";echo '<br/>';
												$slideContentContains = 'slide Empty - ';
											}
										} elseif (is_array($objectToArray[$key])) {
											foreach ($value as $key1 => $value1)
		    					  			{
		    					  				//echo "value 1---".$value1;echo "<br/>";
		    					  				if(trim($value[$key1]) != '') {
		    					  					//value is null or empty string or whitespace only
			    					  				//echo "value 1---".$value1;echo "<br/>";
								  					$slideContentContains = "";
										    		break;
									    		} else {
									    			$slideContentContains = 'slide Empty - ';
									    		}
							  				}
										} else {
											//echo "else end";echo '<br/>';
											$slideContentContains = 'slide Empty - ';
										}
									  }
								}
								//End - checking any slides contains empty json data except DictionaryWords layout and slide_json column contains null values - added on 05/05/2021
		  					}
		  				} else {
		  					$new_slide = false;
	  					}
		  				if($new_slide) {
		  					if($_SESSION['cms_usertype'] != "Instructional Designer") {
	  							$slides_arr .='
					              	<div class="row savedSlides">
						              <div class="col-md-12">
						                <div class="card bd-0 shadow-base">
						                  <div class="pd-y-20 pd-x-30 tx-center">
						                    <button type="button" data-taskid="'.$task_assi_id.'" data-autoid="'.$id.'" data-topic_id="'.$topic_id.'" data-classid="'.$class_id.'" data-layoutid="'.$layout_id.'" class="btn btn-danger btn-oblong btn-block bd-0 tx-11 tx-semibold pd-y-12 tx-mont tx-uppercase tx-spacing-1 clickSavedSlides">'.$slideContentContains.$layout_id_name.$slide_title.'</button>
						                  </div>
						                </div>
						              </div>
						            </div>
					              ';
		              		} else {
		              			$slides_arr .='
					              	<div class="row savedSlides">
						              <div class="col-md-12">
						                <div class="card bd-0 shadow-base">
						                  <div class="pd-y-20 pd-x-30 tx-center">
						                    <button type="button" class="btn btn-danger btn-oblong btn-block bd-0 tx-11 tx-semibold pd-y-12 tx-mont tx-uppercase tx-spacing-1 clickExistingSlides" data-slidepath="'.$slide_file_path.'" data-slidetitle="'.$slide_title.'" style="white-space: normal;">'.$slideContentContains.$layout_id_name.$slide_title.'1</button>
						                  </div>
						                </div>
						              </div>
						            </div>
					              ';
		              		}
		  				} else {
			  				$slides_arr .='
								<div class="row">
								  <div class="col-md-12">
								    <div class="card bd-0 shadow-base">
								    <div class="pd-y-20 pd-x-30 tx-center">
								      <h5 class="tx-inverse tx-roboto tx-normal mg-b-15">Click Here.. To</h5>
								      <a href="#" class="btn btn-info btn-oblong btn-block bd-0 tx-11 tx-semibold pd-y-12 tx-mont tx-uppercase tx-spacing-1 topbarCollapse" data-classid ="'.$class_id.'" data-topicid ="'.$topic_id.'" data-lessonid ="'.$fetch1['id'].'" data-prev_slide_id ="'.$next_slide.'">Add New Slide</a>
								    </div>
								  </div>
								  </div>
								</div>
								';
		  				}
		  			}
		  			$slide_title = $slide_titles[$key];
		  			if(!($selected_slide_id == $slide_id || (isset($slide_ids[$key-1]) && $selected_slide_id == $slide_ids[$key-1])))
						$slides_arr.='
						  <div class="row savedSlides">
			          <div class="col-md-12">
			            <div class="card bd-0 shadow-base">
			              <div class="pd-y-20 pd-x-30 tx-center">
			                <button type="button" class="btn btn-default btn-oblong btn-block bd-0 tx-11 tx-semibold pd-y-12 tx-mont tx-uppercase tx-spacing-1 clickExistingSlides" data-slidepath='.$web_root."app/".$paths[$key].' data-slidetitle="'.$slide_title.'" style="white-space: normal;">'.$slideContentContains.$layout_id_name.$slide_title.'</button>
			              </div>
			            </div>
			          </div>
			        </div>
		        ';
					$next_slide = $slide_id;
				}
				if(in_array($next_slide, $new_slides_prev_page_ids)) {
	  				//next_slide exists in cpadd_slide_list table means fetch the path from the table
	  				$prev_slide_id_array = array();
	  				$cpadd_slide_list = GetRecord("cpadd_slide_list", array("prev_slide_id"=>$next_slide, "lesson_id"=>$fetch1['id']));
	  				if(isset($cpadd_slide_list['id'])) {
	  					if($cpadd_slide_list['status'] == 13)
	  						$new_slide = false;
	  					else {
	  						$new_slide = true;
	  						$id = $cpadd_slide_list['id'];
		  					$layout_id = $cpadd_slide_list['layout_id'];
		  					$layout_id = $slide['layout_id'];
		  					//Layout 6 id's getting and comparing for to display frountend to identify easily - added on 03/05/2021
							$layout6_ids = array(10, 23, 24, 25, 26);
							$layout_id_name = '';
							if(in_array($layout_id, $layout6_ids)) {
								$layout_id_name = 'Layout6 - ';
							}
		  					$slide_title = $cpadd_slide_list['slide_title'];
		  					$slide_file_path = $cpadd_slide_list['slide_file_path'];
	  					}

	  					//Start - checking any slides contains empty json data except DictionaryWords layout and slide_json column contains null values - 05/05/2021
						$ignoreLayouts_ids = array(0, 5263);
						$slideJSON = json_decode($slide['slide_json']);
						$objectToArray = (array)$slideJSON;
						$slideContentContains = "";
						//echo "<pre/>";
						//print_r($objectToArray);
						if(!in_array($layout_id, $ignoreLayouts_ids)) {
						      foreach ($objectToArray as $key => $value)
	    					  {
	    					  	//echo 'key---'.$objectToArray[$key];
	    					  	if(isset($objectToArray[$key]) && !is_array($objectToArray[$key])){
								    //this means key exists and the value is not a array
								    if(trim($objectToArray[$key]) != '') {
								    	//value is null or empty string or whitespace only
									    $slideContentContains = "";
								    	break;
							    	} else {
										//echo "else 111";echo '<br/>';
										$slideContentContains = 'slide Empty - ';
									}
								} elseif (is_array($objectToArray[$key])) {
									foreach ($value as $key1 => $value1)
    					  			{
    					  				//echo "value 1---".$value1;echo "<br/>";
    					  				if(trim($value[$key1]) != '') {
    					  					//value is null or empty string or whitespace only
	    					  				//echo "value 1---".$value1;echo "<br/>";
						  					$slideContentContains = "";
								    		break;
							    		} else {
							    			$slideContentContains = 'slide Empty - ';
							    		}
					  				}
								} else {
									//echo "else end";echo '<br/>';
									$slideContentContains = 'slide Empty - ';
								}
							  }
						}
						//End - checking any slides contains empty json data except DictionaryWords layout and slide_json column contains null values - 05/05/2021
	  				} else {
	  					$new_slide = false;
  					}
	  				if($new_slide) {
	  					if($_SESSION['cms_usertype'] != "Instructional Designer") {
  							$slides_arr .='
				              	<div class="row savedSlides">
					              <div class="col-md-12">
					                <div class="card bd-0 shadow-base">
					                  <div class="pd-y-20 pd-x-30 tx-center">
					                    <button type="button" data-taskid="'.$task_assi_id.'" data-autoid="'.$id.'" data-topic_id="'.$topic_id.'" data-classid="'.$class_id.'" data-layoutid="'.$layout_id.'" class="btn btn-danger btn-oblong btn-block bd-0 tx-11 tx-semibold pd-y-12 tx-mont tx-uppercase tx-spacing-1 clickSavedSlides">'.$slideContentContains.$layout_id_name.$slide_title.'</button>
					                  </div>
					                </div>
					              </div>
					            </div>
				              ';
	              		} else {
	              			$slides_arr .='
				              	<div class="row savedSlides">
					              <div class="col-md-12">
					                <div class="card bd-0 shadow-base">
					                  <div class="pd-y-20 pd-x-30 tx-center">
					                    <button type="button" class="btn btn-danger btn-oblong btn-block bd-0 tx-11 tx-semibold pd-y-12 tx-mont tx-uppercase tx-spacing-1 clickExistingSlides" data-slidepath='.$slide_file_path.' data-slidetitle="'.$slide_title.'" style="white-space: normal;">'.$slideContentContains.$layout_id_name.$slide_title.'</button>
					                  </div>
					                </div>
					              </div>
					            </div>
				              ';
	              		}
	  				} else {
		  				$slides_arr .='
							<div class="row">
							  <div class="col-md-12">
							    <div class="card bd-0 shadow-base">
							    <div class="pd-y-20 pd-x-30 tx-center">
							      <h5 class="tx-inverse tx-roboto tx-normal mg-b-15">Click Here.. To</h5>
							      <a href="#" class="btn btn-info btn-oblong btn-block bd-0 tx-11 tx-semibold pd-y-12 tx-mont tx-uppercase tx-spacing-1 topbarCollapse" data-classid ="'.$class_id.'" data-topicid ="'.$topic_id.'" data-lessonid ="'.$fetch1['id'].'" data-prev_slide_id ="'.$next_slide.'">Add New Slide</a>
							    </div>
							  </div>
							  </div>
							</div>
							';
	  				}
	  			}
			}
			return $slides_arr;
		} catch(Exception $exp) {
			echo "<pre/>";
			print_r($exp);
		}
	}

	function updateSlideJson($id, $data, $slide_html_path) {
		global $db;
		try{
			if($_SESSION['user_role_id'] != 8){
				$query = "UPDATE cpadd_slide_list SET slide_json = ?, slide_file_path = ? WHERE id = ?";
				$stmt = $db->prepare($query);
				$stmt->execute(array($data, $slide_html_path, $id));
				if($stmt->rowCount())
					return 1;
				else
					return 0;
			} else {
				return 1;
			}
		} catch(Exception $exp) {
			echo "<pre/>";
			print_r($exp);
		}
	}

	function updateSlideStatus($task_assign_id, $status) {
		global $db;
		try{
			$query = "UPDATE cpadd_slide_list SET status = ? WHERE task_assign_id = ?";
			$stmt = $db->prepare($query);
			$stmt->execute(array($status, $task_assign_id));
			if($stmt->rowCount())
				return 1;
			else
				return 0;
		} catch(Exception $exp) {
			echo "<pre/>";
			print_r($exp);
		}
	}

	function getFolderName($cpadd_slide_list_id) {
		global $db;
		try{
			$data1 = GetRecord("cpadd_slide_list", array("id"=>$cpadd_slide_list_id));
			$classDetails = GetRecord("cpmodules", array("id"=>$data1['class'], "deleted"=>0));
			$subjectDetails = GetRecord("cpmodules", array("id"=>$data1['subject_id'], "deleted"=>0));

			$folderName = str_replace(' ', '', $classDetails['module']).'_'.$data1['class'].'_'.str_replace(' ', '', $subjectDetails['module']).'_'.$data1['subject_id'];

			$class_topicname = "images/graphics/".$folderName."/";
			return $class_topicname;
		} catch(Exception $exp) {
			echo "<pre/>";
			print_r($exp);
		}
	}

	function getImageFolderName($class_id, $subject_id) {
		global $db;
		try{
			$classDetails = GetRecord("cpmodules", array("id"=>$class_id, "deleted"=>0));
			$subjectDetails = GetRecord("cpmodules", array("id"=>$subject_id, "deleted"=>0));

			$folderName = str_replace(' ', '', $classDetails['module']).'_'.$class_id.'_'.str_replace(' ', '', $subjectDetails['module']).'_'.$subject_id;

			$class_topicname = "images/graphics/".$folderName."/";
			return $class_topicname;
		} catch(Exception $exp) {
			echo "<pre/>";
			print_r($exp);
		}
	}

	function getFolderNameHTML($id) {
		global $db;
		try{

			$data1 = GetRecord("cpadd_slide_list", array("id"=>$id));
			$classDetails = GetRecord("cpmodules", array("id"=>$data1['class'], "deleted"=>0));
			$subjectDetails = GetRecord("cpmodules", array("id"=>$data1['subject_id'], "deleted"=>0));

			$className = str_replace(' ', '', $classDetails['module']).'_'.$data1['class'];
			$subjectName = str_replace(' ', '', $subjectDetails['module']).'_'.$data1['subject_id'];

			$htmlFilePath = $className."/".$subjectName."/lesson/";
			return $htmlFilePath;
		} catch(Exception $exp) {
			echo "<pre/>";
			print_r($exp);
		}
	}

	function getResourceImages($classid, $subjectid) {
		global $db;
		global $web_root;
		global $dir_root;
		try{
			$data = "";
		    $query = "SELECT * FROM resources WHERE status_id=1 AND resource_type_id=1 AND class_id='".$classid."' AND topics_id='".$subjectid."' ORDER BY id DESC";
		    $stmt = $db->query($query);
		    $rowcount = $stmt->rowCount();

		    $data .='
		        <div class="col-md-12">
		            <div class="card bd-0">
		              <div class="card-header bg-info bd-0 d-flex align-items-center justify-content-between pd-y-5">
		                <h6 class="mg-b-0 tx-14 tx-black tx-normal">Image Upload</h6>
		              </div><!-- card-header -->
		              <form id="img_upload" enctype="multipart/form-data">
		                <div class="card-body bd bd-t-0 rounded-bottom-0">
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
		                            if (is_array($files_data))
									{
			                            foreach ($files_data as $item) {
			                            	$file_path = pathinfo($item);
			                                $file_type = $file_path['extension'];
			                                // $file_name = $file_path['basename'];
											$file_name = isset($files_data[1][0]) ? $files_data[1][0] : $file_path['basename'];

			                                $dir_item = $item;
			                                //$radio_val = str_replace("../../", $web_root."app/", $item);
			                                $radio_val = str_replace($dir_root, "$web_root", $item);
			                                $item = str_replace($dir_root, $web_root, $item);

			                                $ms_file_formates = array("doc", "docx", "ppt", "pptx", "xls", "xlsx", "pdf");
											if(in_array($file_type, $ms_file_formates)){
												if($file_type == "doc" || $file_type == "docx")
													$widget_img = '<img src="../../images/word.jpg" class="img-responsive center-block" wdith="100px" height="100px">';
												else if($file_type == "ppt" || $file_type == "pptx")
													$widget_img = '<img src="../../images/ppt.png" class="img-responsive center-block" wdith="100px" height="100px">';
												else if($file_type == "xls" || $file_type == "xls")
													$widget_img = '<img src="../../images/excel.jpg" class="img-responsive center-block" wdith="100px" height="100px">';
												else if($file_type == "pdf")
													$widget_img = '<img src="../../images/pdf.jpg" class="img-responsive center-block" wdith="100px" height="100px">';
											} else {
												$widget_img = '<img src="'.$item.'" class="img-responsive center-block" wdith="100px" height="100px">';
											}
			                                
			                                if(file_exists($dir_item)) {
			                                	$file_size = filesize($dir_item);
			                                	if ($file_size >= 1024)
				                                {
				                                    $file_size_kb = number_format($file_size / 1024, 2) . ' KB';
				                                }
				                                $data.='
				                                <tr data-name="'.$fetch["name"].'">
				                                    <td>
				                                        '.$widget_img.'
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

		    return $data;
	    } catch(Exception $exp) {
	    	echo "<pre/>";
	    	print_r($exp);
	    }
	}

	//get ReviewSlides for ID
	function getAssignSlidesID($web_root, $class_id, $topic_id){
		global $db;
		global $master_db;
		try{
			$data = array();
			$slide_count = 0;
			$selected_slide_id = 0;
			$slides_arr = "";
			$query0 = "SELECT sequence FROM $master_db.mdl_course_sections WHERE course = ? AND sequence != ''";
			$stmt0 = $db->prepare($query0);
	  		$stmt0->execute(array($topic_id));
	  		if($fetch0 = $stmt0->fetch(PDO::FETCH_ASSOC))
	  			$sequence = $fetch0['sequence'];
	  		else
	  			$sequence = 0;
	  		$sequence_ids = array();
	  		$query0 = "SELECT instance FROM $master_db.mdl_course_modules WHERE course = ? ORDER BY FIELD (id, $sequence)";
	  		$stmt0 = $db->prepare($query0);
	  		$stmt0->execute(array($topic_id));
	  		while($fetch0 = $stmt0->fetch(PDO::FETCH_ASSOC)) {
	  			$sequence_ids[] = $fetch0['instance'];
	  		}
	  		if(count($sequence_ids) > 0) {
	  			$sequence_ids_string = implode(",", $sequence_ids);
	  		} else {
	  			$sequence_ids_string = "0";
	  		}

			$query1 = "SELECT * FROM $master_db.mdl_lesson WHERE course = ? ORDER BY FIELD (id, $sequence_ids_string)";
	  		$stmt1 = $db->prepare($query1);
	  		$stmt1->execute(array($topic_id));
	  		$i=1;
	  		while($fetch1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
	  			$chap_name = $fetch1['name'];

	  			$slides_arr.= '
				<div class="col-md-12 mg-t-20 mg-md-t-0">
					<div class="accordion" id="accordion">
					  <div class="card">
					    <div class="card-header" id="h'.$fetch1['id'].'">
					      <h5 class="mb-0">
					      	<a data-toggle="collapse" data-parent="#accordion" href="#c'.$fetch1['id'].'" aria-expanded="false" aria-controls="c'.$fetch1['id'].'" class="tx-gray-800 transition">
			        			'.$chap_name.'
					        </a>
					      </h5>
					    </div>

					    <div id="c'.$fetch1['id'].'" class="collapse" aria-labelledby="h'.$fetch1['id'].'" data-parent="#accordion">
					      <div class="card-body">';
				$slide_sequences = array();
				$paths = array();
				$slide_ids = array();
				$nedpgids = array();
				$pvedpgids = array();
				$page = GetRecord("$master_db.mdl_lesson_pages", array("lessonid"=>$fetch1['id'], "prevpageid"=>0));
				if(!isset($page['id'])) {
					$slides_arr .= '
							</div>
						</div>
					</div>
					</div>
					</div>
				';
					continue;
				}
				$nextpageid = $page['nextpageid'];
				array_push($paths, DecryptContent($page['contents']));
				array_push($slide_ids, $page['id']);
				array_push($nedpgids, $page['nextpageid']);
				array_push($pvedpgids, $page['prevpageid']);

				while($nextpageid != 0)
				{
					//echo "<br />$lessonid--$nextpageid--CAME";
					$page = GetRecord("$master_db.mdl_lesson_pages", array("lessonid"=>$fetch1['id'], "id"=>$nextpageid));				
					array_push($slide_sequences, $page['id']);
					$nextpageid = $page['nextpageid'];
					array_push($paths, DecryptContent($page['contents']));
					array_push($slide_ids, $page['id']);
					array_push($nedpgids, $page['nextpageid']);
					array_push($pvedpgids, $page['prevpageid']);
				}
		  		$next_slide = 0;
		  		foreach($slide_ids as $key=>$slide_id)
		  		{
		  			$slides_arr.= '
	  					<div class="card">';
	  				if(!($selected_slide_id == $slide_id || (isset($slide_ids[$key-1]) && $selected_slide_id == $slide_ids[$key-1])))
	  				$slides_arr.='
						  <div class="card-header d-flex align-items-center justify-content-between pd-y-5">
						    <div class="alert alert-danger text-center" role="alert" style="width:100%;font-size: 26px;padding:0px">
						      	<label class="checked_btn btn btn-danger d-block mx-auto">
							  		<input type="checkbox" class="slideid" name="slideid[]" value="'.$fetch1['id'].':'.$next_slide.'" data-DestlessonID='.$fetch1['id'].'>Add New Slide
								</label>
						    </div>
						  </div><!-- card-header -->';
					$next_slide = $slide_id;
					$slides_arr .= '
						  <div class="card-body">
						    <object width="100%" height="670px" data="'.$web_root."app/".$paths[$key].'"></object>
						  </div><!-- card-body -->
						</div>
		  			';
				}
				if($selected_slide_id != end($slide_ids))
				$slides_arr .='
									<div class="card">
									  <div class="card-header d-flex align-items-center justify-content-between pd-y-5">
									    <div class="alert alert-danger text-center" role="alert" style="width:100%;font-size: 26px;padding:0px">
									      	<label class="checked_btn btn btn-danger d-block mx-auto">
										  		<input type="checkbox" class="slideid" name="slideid[]" value="'.$fetch1['id'].':'.$next_slide.'" data-DestlessonID='.$fetch1['id'].'>Add New Slide
											</label>
									    </div>
									  </div><!-- card-header -->';
				$slides_arr .='								  
								  	</div>
								</div>
				    		</div>
				  		</div>
					</div>
				</div>
				';
				$slide_count += count($paths);
			}
			$data['html'] = $slides_arr;
			$data['slide_count'] = $slide_count;
			return $data;
		} catch(Exception $exp) {
			echo "<pre/>";
			print_r($exp);
		}
	}

	function getSlideNames($class, $topic_id)
	{
		global $db;
		global $master_db;
		try{
			$class_id = $class;
			echo $topic_id = $topic_id;
			//this module will get from mdl_modules table
			$module = "13";
			$data = "";
			$options = "<option value=''>-Select Slide-</option>";
			//get chapters and category
			$getChapters = GetRecords("$master_db.mdl_course_modules", array("course"=>$topic_id, "module"=>$module, "visible"=>1));
			if(count($getChapters) > 0) {
			  $instance = array();
			  foreach ($getChapters as $getChapter) {
			    $instance[] = $getChapter['instance'];
			  }
			  $instanceImplode = implode(",", $instance);
			$query0 = "SELECT sequence FROM $master_db.mdl_course_sections WHERE course = ? AND sequence != ''";
			$stmt0 = $db->prepare($query0);
	  		$stmt0->execute(array($topic_id));
	  		if($fetch0 = $stmt0->fetch(PDO::FETCH_ASSOC))
	  			$sequence = $fetch0['sequence'];
	  		else
	  			$sequence = 0;
	  		$sequence_ids = array();
	  		$query0 = "SELECT instance FROM $master_db.mdl_course_modules WHERE course = ? ORDER BY FIELD (id, $sequence)";
	  		$stmt0 = $db->prepare($query0);
	  		$stmt0->execute(array($topic_id));
	  		while($fetch0 = $stmt0->fetch(PDO::FETCH_ASSOC)) {
	  			$sequence_ids[] = $fetch0['instance'];
	  		}
	  		if(count($sequence_ids) > 0) {
	  			$sequence_ids_string = implode(",", $sequence_ids);
	  		} else {
	  			$sequence_ids_string = "0";
	  		}

			  $query = "SELECT * FROM $master_db.mdl_lesson WHERE id IN ($instanceImplode)  ORDER BY FIELD (id, $sequence_ids_string)";
			  $stmt = $db->query($query);
			  $rowcount = $stmt->rowCount();
			  if($rowcount > 0){
			    while($fetch = $stmt->fetch(PDO::FETCH_ASSOC)){
			      $name = $fetch['name'];
			      if($name == "Activity" || $name == "Scenario") {
			      	continue;
			      }
			      $lesson_id = $fetch['id'];
			      $data .= '<label class="sidebar-label pd-x-10 mg-t-25 mg-b-20 tx-info">"'.$name.'"</label>';
			      $slides = GetRecords("cpadd_slide_list", array("class"=>$class_id, "topic_id"=>$topic_id, "lesson_id"=>$lesson_id), array("sequence"));
			      
		          if(count($slides) > 0) {
		          	$options .= '<optgroup label="'.$name.'">';
		            foreach ($slides as $slide) {
		              $id = $slide['id'];
		              $title = $slide['slide_title'];
		              $options .= '<option value="'.$id.'">'.$title.'</option>';
		            }
		            $options .= '</optgroup>';
		           }
		        }
		      }
		      echo $options;
		  }
		} catch(Exception $exp) {
			echo "<pre/>";
			print_r($exp);
		}
	}
?>