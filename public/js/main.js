/**
 * Created by JASON on 11/10/2014.
 */
$(document).ready(function() {
    $('.summernote').summernote();

    //$('.summernote').closest('form').on('submit', function(e){
    //    var target = $(e.target);
    //    e.preventDefault();
    //    target.off('submit');
    //    $('.summernote').each(function(){
    //        var nField = $('<input type="hidden"/>');
    //        nField.attr('name', $(this).attr('data-name'));
    //        nField.attr('value', $(this).code());
    //        target.append(nField);
    //    });
    //    target.submit();
    //});
});