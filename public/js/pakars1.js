// Slide carousell home
var slideIndex = 0;
		showSlides();

		function showSlides() {
			var i;
			var slides = document.getElementsByClassName("mySlides");
			var dots = document.getElementsByClassName("dot");
			for (i = 0; i < slides.length; i++) {
				slides[i].style.display = "none";  
			}
			slideIndex++;
			if (slideIndex > slides.length) {slideIndex = 1}    
				for (i = 0; i < dots.length; i++) {
					dots[i].className = dots[i].className.replace(" activeslide", "");
				}
				slides[slideIndex-1].style.display = "block";  
				dots[slideIndex-1].className += " activeslide";
  setTimeout(showSlides, 4000); // Change image every 2 seconds
};

// more less home button
$(document).ready(function() {
	var limitText = 100;  
	var ellipsestext = "...";
	var moretext = "<br><button class='btn btn-xs btn-success'>Read more</button>";
	var lesstext = "<br><button class='btn btn-xs btn-success'>Read less</button>";


	$('.more').each(function() {
		var content = $(this).html();

		if(content.length > limitText) {

			var c = content.substr(0, limitText);
			var h = content.substr(limitText, content.length - limitText);

			var isi = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

			$(this).html(isi);
		}

	});

	$(".morelink").click(function(){
		if($(this).hasClass("less")) {
			$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		return false;
	});
});

// Search table
function myFunction() {
	var input, filter, table, tr, td, i;
	input = document.getElementById("mylist");
	filter = input.value.toUpperCase();
	table = document.getElementById("myTable");
	tr = table.getElementsByTagName("tr");
	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[1];
		if (td) {
			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			} else {
				tr[i].style.display = "none";
			}
		}       
	}
};