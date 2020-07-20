(function($) {
 

/* Find Category by looking at URL */  
var categoryLocation = $(location).attr('pathname');
categoryLocation.indexOf(1);
categoryLocation.toLowerCase();
categoryLocation = categoryLocation.split("/")[1];
categoryLocation = categoryLocation.charAt(0).toUpperCase() + categoryLocation.slice(1);

categoryLocation = $('a[rel="category tag"]').text();
/* Once page is loaded set the correct category as the selected option in the sidebar. */
window.addEventListener("DOMContentLoaded", function(){
    var currentCat = $("#cat").val()
   
    $("#cat option").filter(function() {
      return $(this).text() == categoryLocation;
    }).prop('selected', true);
    
    /* Filter out the news option since that uses a separate sidebar. */
    var NewsOption = $('#cat option').filter(function () { return $(this).html() == "News"; }).hide();
    var NewsOption = $('#cat option').filter(function () { return $(this).html() == "Uncategorized"; }).hide();
    
   
    
});

 
 /* Print button for team member PDF */
 $('.single-member-page .fa-print').click(function(){
     window.print();
 });



})( jQuery );