$(function(){
    if(!$('.tinymce').get(0))
        return;
    
    tinymce.init({
        selector: '.tinymce',
        menubar: false,
        toolbar: 'styleselect | bold italic | bullist numlist | table | link image media | pagebreak | fullscreen',
        plugins: 'link lists table image media pagebreak fullscreen paste',
        height: 403,
        content_css: window.tMCE.cssContent,
        
        // pagebreak
        pagebreak_separator: '<!-- PAGE BREAK -->',
        
        // paste
        paste_word_valid_elements: 'h1,h2,h3,h4,h5,h6,p,strong,em,span,sup,sub,code,blockquote,div,pre,ul,ol,li,table,thead,tbody,th,td,tr,a,figure,figcaption',
        paste_merge_formats: true,
        paste_preprocess: function(plugin, args){
            var rms = [
                    [/<\/?font[^>]*>/g, ''],            // remove <font> tag
                    [/ valign="[^"]+"/g, ''],           // remove valign attribute
                    [/<br ?\/>/g, '<br>'],              // convert <br /> to <br>
                    [/<br>([ \n]*)<br>/g, '<br>'],      // remove too close <br>
                    [/<a([^>]*)><\/a>/g, ''],           // remove empty <a>
                    [/<([\/]?)b>/g, '<$1strong>'],      // convert b to strong
                    [/ style="([^"]+)"/g, '']           // remove style attribute
                ];
            
            for(var i=0 ;i<rms.length; i++){
                var rm = rms[i];
                args.content = args.content.replace(rm[0], rm[1]);
            }
            
            console.log(args.content);
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