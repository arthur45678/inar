
/*Select2*/
$(".select2").each(function () {
    $(this).select2({
        maximumSelectionLength: 2
    });
});
/*Select2 end*/








//Add dynamic tags
$(".add-more").click(function(){
    var html = $(".copy").html();
    $(".after-add-more").after(html);
});

$("body").on("click",".remove",function(){
    $(this).parents(".control-group").remove();
});
