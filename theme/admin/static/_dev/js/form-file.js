$(function(){
    $('.file-previewer').click(function(){
        var input = $('#' + $(this).data('input'));
        var value = input.val().trim();
        previewImage(value, input.attr('placeholder'));
    });
    
    $('.file-picker').click(function(){
        var input = $('#' + $(this).data('input'));
        
        Media.pick({
            form: input.data('form'),
            mime: input.data('accept')
        }, function(file){
            input.val(file);
        });
    });
});