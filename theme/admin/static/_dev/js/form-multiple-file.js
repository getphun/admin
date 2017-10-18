window.MMedia = {
    remove: function(el){
        $(el).parent().slideUp(function(){
            $(this).remove();
        });
    },
    
    init: function(){
        $('.multiple-file-pick').click(function(){
            var $this = $(this);
            
            Media.pick({
                form: $this.data('form'),
                mime: $this.data('accept'),
                multiple: true
            }, function(file){
                if(!file)
                    return;
                
                var thu = $('<div class="thumbnail" style="display:none"></div>');
                thu.append('<button type="button" onclick="MMedia.remove(this)" class="btn btn-xs btn-danger btn-close" title="Delete"><span aria-hidden="true">&times;</span></button>');
                thu.append('<img src="' + file + '" alt="#" onclick="previewImage(this.src, \'' + $this.data('label') + '\')">');
                thu.append('<input type="hidden" name="' + $this.data('name') + '[]" value="' + file + '">');
                
                $('#'+$this.data('list')).prepend(thu);
                thu.slideDown();
            });
        });
    }
}

MMedia.init();