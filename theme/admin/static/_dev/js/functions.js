function noop(){}

function previewImage(value, title){
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
    if(~['jpg', 'png', 'bmp', 'jpeg'].indexOf(ext.toLowerCase()))
        msg = '<div class="text-center"><img src="' + value + '" style="max-width:100%"></div>';
    
    bootbox.alert({
        title: title,
        message: msg,
        backdrop: true
    });
}