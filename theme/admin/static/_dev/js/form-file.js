$(function(){
    $('.file-previewer').click(function(){
        var input = $('#' + $(this).data('input'));
        var value = input.val().trim();
        
        if(!value){
            return bootbox.alert({
                title: 'Whoops',
                message: 'No file/image to view. Please select file first.',
                size: 'small',
                backdrop: true
            });
        }
        
        msg = 'Unable to get file preview';
        ext = value.split('.');
        ext = ext[ext.length-1];
        
        // image
        if(~['jpg', 'png', 'bmp', 'jpeg'].indexOf(ext.toLowerCase())){
            msg = '<img src="' + value + '" style="max-width:100%">';
        }
        
        bootbox.alert({
            title: input.attr('placeholder'),
            message: msg,
            backdrop: true
        });
    });
    
    $('.file-picker').click(function(){
        var input = $('#' + $(this).data('input'));
        
        pickFile({
            form: input.data('form'),
            mime: input.data('accept')
        }, function(result){
            input.val(file);
        });
    });
});