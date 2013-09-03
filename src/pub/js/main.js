// Gumby is ready to go
Gumby.ready(function() {
	// console.log('Gumby is ready to go...', Gumby.debug());

	// placeholder polyfil
	if(Gumby.isOldie || Gumby.$dom.find('html').hasClass('ie9')) {
		$('input, textarea').placeholder();
	}

});

// Oldie document loaded
Gumby.oldie(function() {

});

// Touch devices loaded
Gumby.touch(function() {
    // console.log("This is a touch enabled device...");
});

// Document ready
$(function() {
    $('.tabs').trigger('gumby.set', 0);

    $.getJSON('/index/get-user-role-id/?format=json', function(data) {
        $("body").addClass(data.role);
    });

    $(".tab-content paginationControl a").on('click', function(event){
        event.preventDefault(true);
        $.get($(this).attr('href'), function(data){
            $(".tab-content.active").html(data);
        });
        return false;
    });

    $(".athlete-name a").tooltip({ content: function() {
        $.get($(this).attr('href'));
    }})

    // $(".tab-content a").on('click', function(event){
    //     event.preventDefault(true);
    //     $.get($(this).attr('href'), function(data){
    //         $(".tab-content.active").html(data);
    //     });
    //     return false;

    // });

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

    $("#user-first_name, #user-last_name").on('change', function(event){
        $("#credit_card-name").val(
            $("#user-first_name").val() + ' ' + $("#user-last_name").val()
        );

        $("#athlete-name").val(
            $("#user-first_name").val() + ' ' + $("#user-last_name").val()
        );
    });

    $("#user-address1, #user-address2").on('change', function(event){
        $("#credit_card-address").val(
            $("#user-address1").val() + ' ' + $("#user-address2").val()
        );
    });

    $("#user-city").on('change', function(event){
        $("#credit_card-city").val($("#user-city").val());
    });

    $("#user-state").on('change', function(event){
        $("#credit_card-state").val($("#user-state").val());
    });

    $("#user-postal").on('change', function(event){
        $("#credit_card-postal").val($("#user-postal").val());
    });

    $("#user-country").on('change', function(event){
        $("#credit_card-country").val($("#user-country").val());
    });

});
