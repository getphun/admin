$(function(){
    if(!$('.tinymce').get(0))
        return;
    
    tinymce.init({
        selector: '.tinymce',
        menubar: false,
        toolbar: 'styleselect | bold italic | bullist numlist | table | link image media codesample | pagebreak | fullscreen',
        plugins: 'link lists table image media pagebreak fullscreen paste codesample textpattern',
        height: 403,
        content_css: window.tMCE.cssContent,
        
        // codesample
        codesample_dialog_height: 400,
        codesample_languages: [
            {text: 'HTML/XML',      value: 'markup'},
            {text: 'JavaScript',    value: 'javascript'},
            {text: 'CSS',           value: 'css'},
            {text: 'PHP',           value: 'php'},
            {text: 'Markdown',      value: 'markdown'},
            
            {text: 'SQL',           value: 'sql'},
            {text: 'Apache',        value: 'apacheconf'},
            {text: 'Nginx',         value: 'nginx'},
            {text: 'Bash',          value: 'bash'},
            {text: 'JSON',          value: 'json'}
        ],
        
        // pagebreak
        pagebreak_separator: '<!-- PAGE BREAK -->',
        
        // paste
        paste_word_valid_elements: 'h1,h2,h3,h4,h5,h6,p,strong,em,span,sup,sub,code,blockquote,div,pre,ul,ol,li,table,thead,tbody,th,td,tr,a,figure,figcaption',
        paste_merge_formats: true,
        paste_preprocess: function(plugin, args){
            
        },
        paste_postprocess: function(plugin, args){
            
        },
        
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
        
        // textpattern
        textpattern_patterns: [
            { start: '`', end: '`', format: 'code' },
            { start: '*', end: '*', format: 'italic' },
            { start: '**', end: '**', format: 'bold' },
            { start: '***', end: '***', format: ['bold', 'italic'] },
            { start: '#', format: 'h1' },
            { start: '##', format: 'h2' },
            { start: '###', format: 'h3' },
            { start: '####', format: 'h4' },
            { start: '#####', format: 'h5' },
            { start: '######', format: 'h6' },
            { start: '1. ', cmd: 'InsertOrderedList' },
            { start: '* ', cmd: 'InsertUnorderedList' },
            { start: '- ', cmd: 'InsertUnorderedList' }
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