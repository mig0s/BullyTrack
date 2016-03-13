function showHide(div){
	if(document.getElementById(div).style.display = 'block'){
		document.getElementById(div).style.display = 'none';
	}else{
		document.getElementById(div).style.display = 'block'; 
	}
}
$(document).ready(function(){
	$(window).scroll(function(){
		if ($(this).scrollTop() > 800) {
			$('.scrollToTop').fadeIn();
		} else {
			$('.scrollToTop').fadeOut();
		}
	});
});