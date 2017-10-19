$(function(){
    if(!$('.tinymce').get(0))
        return;
    
    tinymce.init({
        selector: '.tinymce',
        menubar: false,
        toolbar: 'styleselect | bold italic | bullist numlist | table | link image media | pagebreak | fullscreen',
        plugins: 'link lists table image media pagebreak fullscreen',
        height: 403,
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
        file_browser_callback: function(fld, url, type, win){
            var opts = {
                form: tinymce.activeEditor.targetElm.getAttribute('data-form')
            }
            
            switch(type){
                case 'image':
                    opts.mime = 'image/*';
                    break;
                case 'media':
                    opts.mime = 'video/*';
                    break;
                case 'file':
                    opts.mime = '*';
                    break;
            }
            
            Media.pick(opts, function(file){
                $('#'+fld).val(file);
            });
        }
    });
});