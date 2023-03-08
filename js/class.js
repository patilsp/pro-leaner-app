$(function(){
	var moveactive = "";
    var moveactivesection = "";
	/** start more options tooltip logic **/
	var hasToolTip = $(".tooltip_options_new");

	hasToolTip.on("click", function(e) {
	  e.preventDefault();
	  $(this).tooltip('toggle');
	}).tooltip({
	  animation: true,
	  trigger: "manual",
	});

	$('body').on('click', function(e) {
	  var $parent = $(e.target).closest('.tooltip_options_new');
	  if ($parent.length) {
	   hasToolTip.not($parent).tooltip('hide');
	  }
	  else{
	    hasToolTip.tooltip('hide');
	  }

	  var disabled = $(".accordionClass").sortable( "option", "disabled" );
	  if (!disabled) {
	  	$(".accordionClass").sortable("disable");
  	}
  	if(moveactive != "")
  		$("#"+moveactive).removeClass("enablemoveclass");

  	if(moveactivesection !== "")
  		$("#"+moveactivesection).removeClass("enablemovesection");
	});

	var hasToolTip1 = $(".tooltip_optionssection_new");

	// $(".tooltip_optionssection_new").mouseover(function(){
	// 	hasToolTip1.tooltip('hide');
	// });
	
	hasToolTip1.on("click", function(e) {
	  e.preventDefault();
	  $(this).tooltip('toggle');
	}).tooltip({
	  animation: true,
	  trigger: "manual",
	});

	$('body').on('click', function(e) {
	  var $parent = $(e.target).closest('.tooltip_optionssection_new');
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

		  if($(this).attr('id') == "selectall" && $(this).is(":checked")){
				$('#pending_to_activate_classes .form-check-inline').addClass('checked_active');
		  } else if($(this).attr('id') == "selectall") {
		  	$('#pending_to_activate_classes .form-check-inline').removeClass('checked_active');
		  }

		  var lengthOfChecked_pending_to_activate = $('#pending_to_activate_classes input:checkbox:not(:checked)').length
		  if(lengthOfChecked_pending_to_activate){
		  	$("#selectall"). prop("checked", false);
		  	$('#sellectall_blk .form-check-inline').removeClass('checked_active');
		  } else {
		  	$('#sellectall_blk .form-check-inline').addClass('checked_active');
		  	$("#selectall"). prop("checked", true);
		  }

		  var lengthOfUnchecked = $('#activated_classes input:checkbox:not(:checked)').length;
		  if(lengthOfUnchecked > 0 || lengthOfChecked > 0){
		  	$("#class_save_submit").removeClass("class_save_active");
		  } else {
		  	$("#class_save_submit").addClass("class_save_active");
		  }

		  var lengthOfChecked = $('#pending_to_activate_classes input[type="checkbox"]:checked').length;
		  if(lengthOfChecked > 0 || lengthOfUnchecked > 0){
		  	$("#class_save_submit").removeClass("class_save_active");
		  } else {
		  	$("#class_save_submit").addClass("class_save_active");
		  }
  	});

  	$(".accordionClass").sortable("disable");
  	$(document).on("click", ".move_class_option", function () {
  		var id = $(this).attr("aria-classcardid");
  		moveactive = id;
			$(".accordionClass").sortable("enable");
			$("#"+id).addClass("enablemoveclass");
  	});

  	$(".dragSection").sortable("disable");
  	$(document).on("click", ".move_section_option", function () {
  		var id = $(this).attr("aria-sectioncardid");
  		moveactivesection = id;
			$(".dragSection").sortable("enable");

			$("#"+id).addClass("enablemovesection");
  	});
})