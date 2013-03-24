// Gumby is ready to go
Gumby.ready(function() {
	console.log('Gumby is ready to go...', Gumby.debug());

	// placeholder polyfil
	if(Gumby.isOldie || Gumby.$dom.find('html').hasClass('ie9')) {
		$('input, textarea').placeholder();
	}
});

// Oldie document loaded
Gumby.oldie(function() {

});

// Document ready
$(function() {

    // hide gender and scale from the user if they're a judge
    $("#role").on('change', function(event){
        var role = $(this).val();

        if (role == 'judge') {
            $("#athlete-gender-element").hide();
            $("#athlete-scale_id-element").hide();
            $("#athlete-gender-label").hide();
            $("#athlete-scale_id-label").hide();
        } else {
            $("#athlete-gender-element").show();
            $("#athlete-scale_id-element").show();
            $("#athlete-gender-label").show();
            $("#athlete-scale_id-label").show();
        }
    });

});
