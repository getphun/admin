window.pickFileCB = $.noop;
window.pickFileMime = '';

function pickFile(opt, cb){
    window.pickFileCB = cb || $.noop;
    var drawer = $('#drawer-uploader');
    var btnUpload = $('#drawer-upload-button');
    
    if(opt.mime)
        btnUpload.attr('accept', opt.mime);
    else
        btnUpload.removeAttr('accept');
    window.pickFileMime = opt.mime;
    
    btnUpload.attr('data-form', opt.form);
    
    drawer.drawer('show');
    setTimeout(function(){
        drawer.find('input[type=search]').focus();
    }, 500);
}

$(function(){
    
});