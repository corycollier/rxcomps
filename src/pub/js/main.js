
$(".expand-details").on('click', function(event){
    $('.details').not($(this).siblings('.details')).hide();
    $(this).siblings('.details').toggle();

    return false;
});