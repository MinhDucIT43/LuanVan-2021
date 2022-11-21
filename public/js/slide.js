var slideIndex = 1;

// function plusSlides(n) {
//     slideIndex = slideIndex + n;
// 	showSlides(slideIndex);
// }

function currentSlide(n) {
	slideIndex = n;
	showSlides(slideIndex);
}

function showSlides(n) {
	var i;
	var slides = document.getElementsByClassName("mySlides");
	var chams = document.getElementsByClassName("cham");
	if (n > slides.length) {
        slideIndex = 1
    }    
	if (n < 1) {
        slideIndex = slides.length
    }
	for (i = 0; i < slides.length; i++) {
		slides[i].style.display = "none";  
	}
	for (i = 0; i < chams.length; i++) {
		chams[i].className = chams[i].className.replace("active", "");
	}
	slides[slideIndex-1].style.display = "block";  
	chams[slideIndex-1].className += " active";
}

function show(){
    showSlides(slideIndex);
    slideIndex = slideIndex + 1;
}

setInterval(show,4000);