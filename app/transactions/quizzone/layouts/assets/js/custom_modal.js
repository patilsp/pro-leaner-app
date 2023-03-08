// Get the modal
var modal = document.getElementById('myCustomModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('modal_img');
var img2 = document.getElementById('modal_img2');
var modalImg = document.getElementById("img01");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
}
if(img2 != null){
	img2.onclick = function(){
	    modal.style.display = "block";
	    modalImg.src = this.src;
	}
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}