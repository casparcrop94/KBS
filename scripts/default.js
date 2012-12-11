$(document).ready(function(){

$("#fold-year").live("click", function(event){
	var id = $(this).attr("rel");
	var html = $(this).html();
	var icon = (html == "? "? '? ':'? ');
	$(this).html(icon)

	$("#" + id).toggle('slow', function() {
	    // Animation complete.
	  });
	event.preventDefault();
});

$("#fold-month").live("click", function(event){
	var id = $(this).attr("rel");
	$("#" + id).toggle('slow', function() {
	    // Animation complete.
	  });
	event.preventDefault();
});

});
