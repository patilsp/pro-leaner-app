$(function(){
	/** start more options tooltip logic **/
	var hasToolTip = $(".tooltip_options");

	hasToolTip.on("click", function(e) {
	  e.preventDefault();
	  $(this).tooltip('toggle');
	}).tooltip({
	  animation: true,
	  trigger: "manual",
	});

	$('body').on('click', function(e) {
	  var $parent = $(e.target).closest('.tooltip_options');
	  if ($parent.length) {
	   hasToolTip.not($parent).tooltip('hide');
	  }
	  else{
	    hasToolTip.tooltip('hide');
	  }

	  var disabled = $(".accordionClass").sortable( "option", "disabled" );
	  ////console.log("disabled status - ", disabled);
	  if (!disabled) {
	  	////console.log("cameeeeeeeee");
	  	$(".accordionClass").sortable("disable");
  	}
  	if(moveactive != "")
  		$("#"+moveactive).removeClass("enablemoveclass");

  	if(moveactivesection !== "")
  		$("#"+moveactivesection).removeClass("enablemovesection");
	});

	var hasToolTip1 = $(".tooltip_optionssection");
	// console.log(hasToolTip1);
	hasToolTip1.on("click", function(e) {
	  e.preventDefault();
	  $(this).tooltip('toggle');
	}).tooltip({
	  animation: true,
	  trigger: "manual",
	});

	$('body').on('click', function(e) {
	  var $parent = $(e.target).closest('.tooltip_optionssection');
	  if ($parent.length) {
	   hasToolTip1.not($parent).tooltip('hide');
	  }
	  else{
	    hasToolTip1.tooltip('hide');
	  }
	});
	/** end more options tooltip logic **/

		$( "#accordionClass" ).sortable();
    $( "#accordionClass" ).disableSelection();

    $( ".dragSection" ).sortable();
    $( ".dragSection" ).disableSelection();

    
    /** adding active class onchange and mouseover class checkbox */
    $('.form-check-label').on('mouseover', function(){
	    $(this).parent().addClass('is-hover');
  	}).on('mouseout', function(){
	    $(this).parent().removeClass('is-hover');
  	});

  	$('.form-check-input').change(function(){
		  if($(this).is(":checked")) {
		    $(this).closest('.form-check-inline').addClass('checked_active');
		  } else {
		    $(this).closest('.form-check-inline').removeClass('checked_active');
		  }

		  //console.log("select all - ",$(this).attr('id'));
		  if($(this).attr('id') == "selectall" && $(this).is(":checked")){
				$('#pending_to_activate_classes .form-check-inline').addClass('checked_active');
		  } else if($(this).attr('id') == "selectall") {
		  	$('#pending_to_activate_classes .form-check-inline').removeClass('checked_active');
		  }

		  var lengthOfChecked_pending_to_activate = $('#pending_to_activate_classes input:checkbox:not(:checked)').length
		  if(lengthOfChecked_pending_to_activate){
		  	//console.log("cxameeeeee");
		  	$("#selectall"). prop("checked", false);
		  	$('#sellectall_blk .form-check-inline').removeClass('checked_active');
		  } else {
		  	//console.log("cxameeeeee1111111111111111111111");
		  	$('#sellectall_blk .form-check-inline').addClass('checked_active');
		  	$("#selectall"). prop("checked", true);
		  }

		  var lengthOfUnchecked = $('#activated_classes input:checkbox:not(:checked)').length;
		  //console.log("lengthOfUnchecked - ",lengthOfUnchecked);
		  if(lengthOfUnchecked > 0 || lengthOfChecked > 0){
		  	$("#class_save_submit").removeClass("class_save_active");
		  } else {
		  	$("#class_save_submit").addClass("class_save_active");
		  }

		  var lengthOfChecked = $('#pending_to_activate_classes input[type="checkbox"]:checked').length;
	  	  ////console.log("lengthOfChecked - ",lengthOfChecked);
		  if(lengthOfChecked > 0 || lengthOfUnchecked > 0){
		  	$("#class_save_submit").removeClass("class_save_active");
		  } else {
		  	$("#class_save_submit").addClass("class_save_active");
		  }
  	});

  	$(".accordionClass").sortable("disable");
  	$(document).on("click", ".move_class_option", function () {
  		//console.log("cameeeeee ---", $(this).attr("aria-classcardid"));
  		var id = $(this).attr("aria-classcardid");
  		moveactive = id;
			$(".accordionClass").sortable("enable");
			$("#"+id).addClass("enablemoveclass");
  	});

  	$(".dragSection").sortable("disable");
  	$(document).on("click", ".move_section_option", function () {
  		//console.log("cameeeeee ---", $(this).attr("aria-sectioncardid"));
  		var id = $(this).attr("aria-sectioncardid");
  		moveactivesection = id;
			$(".dragSection").sortable("enable");

			$("#"+id).addClass("enablemovesection");
  	});
})