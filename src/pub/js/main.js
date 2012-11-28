
$(".expand-details").on('click', function(event){
    $('.details').not($(this).siblings('.details')).hide();
    $(this).siblings('.details').toggle();

    return false;
});


$(".toggle-scoring-type").on('click', function(event){
    if ($(this).val() == 'points') {
        $(".scoring-type-points").removeClass('hidden');
    } else {
        $(".scoring-type-points").addClass('hidden');
    }


});