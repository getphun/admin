$(function(){
    if(!$('.tinymce').get(0))
        return;
    
    tinymce.init({
        selector: '.tinymce',
        menubar: false,
        toolbar: 'styleselect | bold italic | bullist numlist | table | link image media | pagebreak | fullscreen | code',
        plugins: 'link lists table image media pagebreak fullscreen code',
        height: 401,
        content_css: window.tMCE.cssContent,
        
        // pagebreak
        pagebreak_separator: '<!-- PAGE BREAK -->',
        
        // image
        image_caption: true,
        image_description: true,
        image_dimensions: false,
        image_title: true,
        
        // link
        rel_list: [
            { title: 'None', value: '' },
            { title: 'No Follow', value: 'nofollow' }
        ],
        
        // file uploader
//         file_browser_callback: function(fld, url, type, win){
//             var filePickerOpt = {
//                     target: '#' + fld,
//                     form: 'tinymce.general'
//                 };
//             
//             switch(type){
//                 case 'image':
//                     filePickerOpt.mime = 'image/*';
//                     break;
//                 case 'media':
//                     filePickerOpt.mime = 'video/*';
//                     break;
//                 case 'file':
//                     filePickerOpt.mime = '*';
//                     break;
//             }
//             
//             $.filePicker(filePickerOpt);
//         }
    });
});