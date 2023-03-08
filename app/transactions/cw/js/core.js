// target elements with the "draggable" class
interact('.draggable')
  .draggable({
    // enable inertial throwing
    inertia: true,
    // keep the element within the area of it's parent
    restrict: {
      restriction: "parent",
      endOnly: true,
      elementRect: { top: 0, left: 0, bottom: 1, right: 1 }
    },
    // enable autoScroll
    autoScroll: true,

    // call this function on every dragmove event
    onmove: dragMoveListener,
    // call this function on every dragend event
    onend: function (event) {
      var textEl = event.target.querySelector('p');

      textEl && (textEl.textContent =
        'moved a distance of '
        + (Math.sqrt(event.dx * event.dx +
                     event.dy * event.dy)|0) + 'px');
    }
  });
  var actualValue = [] ;
  var expectedValue = "THANKYOU-PLEASE-GOODMORNING"
  var expectedValueList = expectedValue.split("-")
  function dragMoveListener (event) {
    var target = event.target,
        // keep the dragged position in the data-x/data-y attributes
        x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx,
        y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

    // translate the element
    target.style.webkitTransform =
    target.style.transform =
      'translate(' + x + 'px, ' + y + 'px)';

    // update the posiion attributes
    target.setAttribute('data-x', x);
    target.setAttribute('data-y', y);
  }

  // this is used later in the resizing and gesture demos
  window.dragMoveListener = dragMoveListener;

// enable draggables to be dropped into this
interact('.dropzone').dropzone({
  // only accept elements matching this CSS selector
  accept: '.yes-drop',
  // Require a 75% element overlap for a drop to be possible
  overlap: 0.01,

  // listen for drop related events:

  ondropactivate: function (event) {
    // add active dropzone feedback
    event.target.classList.add('drop-active');
  },
  ondragenter: function (event) {
    var draggableElement = event.relatedTarget,
        dropzoneElement = event.target;

    // feedback the possibility of a drop
    dropzoneElement.classList.add('drop-target');
    draggableElement.classList.add('can-drop');
  },
  ondragleave: function (event) {
    // remove the drop feedback style
    event.target.classList.remove('drop-target');
    event.relatedTarget.classList.remove('can-drop');
    if(jQuery(event.target).attr("expected-value")){
      actualValue = _.without(actualValue, jQuery(event.target).attr("expected-value"))  
    }
  },
  ondrop: function (event) {
        	var actualDroppedValue = jQuery(event.relatedTarget).attr("data-value")
        	var expectedDroppedValue = jQuery(event.target).attr("expected-value")

        	if(actualDroppedValue != expectedDroppedValue){
        		jQuery("#showTryAgain").modal('show');		
        	}else{
              var index = jQuery(event.target).attr("data-sequence")
              if(index && expectedDroppedValue){
                actualValue[index] = expectedDroppedValue
              }
              var currentPhrase = expectedValueList[sliderNumber-1];  
              if(checkForCompletion(currentPhrase)){
                jQuery("#showWellDone").modal('show');
              }else if(readyForNext()){
                if(readyForSet() && readyForNext()){
                  jQuery("#showWellDone").modal('show');
                }else{
                  //jQuery("#showNext").modal('show');
                }   
              }
        	}
  },
  ondropdeactivate: function (event) {
    // remove active dropzone feedback
    event.target.classList.remove('drop-active');
    event.target.classList.remove('drop-target');
  }
});

function getSorted(selector, attrName) {
    return $($(selector).toArray().sort(function(a, b){
        var aVal = parseInt(a.getAttribute(attrName)),
            bVal = parseInt(b.getAttribute(attrName));
        return aVal - bVal;
    }));
}

function checkForCompletion(received){
	var __actuals = actualValue.join("")
	var __calculatedActuals = [];
  var __selector = '.'+received + '.can-drop' 
  var listOfSolvedBlocks = getSorted(__selector, 'data-sequence')
	jQuery.each(listOfSolvedBlocks, function(key, item){
		__calculatedActuals.push(jQuery(item).attr("data-value"))
	})
	var calculatedValued = "";
	if(__calculatedActuals.length > 0){
		calculatedValued = __calculatedActuals.join("");
	}
	if( calculatedValued == received){
		return true;
	}else{
		return false;
	}
}

function readyForNext(){
	if(expectedValue.indexOf(actualValue.join("")) != -1){
		return true;
	}	
}

function readyForSet(){
	var list = expectedValue.split("-")
	if(list.indexOf(actualValue.join("")) != -1){
		return true;
	}	
}