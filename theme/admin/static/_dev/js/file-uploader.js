window.Media = {
    _cb: $.noop,
    _mime: 'image/*',
    _form: null,
    
    el: {
        drawer: $('#drawer-media'),
        inpFilter: $('#drawer-media-filter'),
        btnUpload: $('#drawer-media-upload'),
        lisResult: $('#drawer-media-search-result'),
        loading: $('#drawer-media-loading')
    },
    
    init: function(){
        Media.search.init();
        Media.upload.init();
    },
    
    pick: function(opt, cb){
        Media._cb = cb;
        Media._form = opt.form;
        
        if(opt.mime)
            Media.el.btnUpload.attr('accept', opt.mime);
        else
            Media.el.btnUpload.removeAttr('accept');
        
        Media.el.loading.hide();
        Media.el.drawer.drawer('show');
        Media.search._lastQuery = Media.el.inpFilter.val();
        setTimeout(function(){ Media.el.inpFilter.select() }, 500);
    },
    
    loader: function(text){
        if(text === false)
            return Media.el.loading.fadeOut();
        Media.el.loading.find('span').html(text);
        Media.el.loading.fadeIn();
    },
    
    search: {
        _lastQuery: null,
        _timer: null,
        
        init: function(){
            Media.el.inpFilter.keyup(function(){
                var val = Media.el.inpFilter.val().trim();
                if(val == Media.search._lastQuery)
                    return;
                Media.search._lastQuery = val;
                
                if(Media.search._timer)
                    clearTimeout(Media.search._timer);
                
                if(!val)
                    return;
                
                Media.search._timer = setTimeout(Media.search.find, 300);
            });
        },
        
        find: function(){
            var par = {};
            if( Media.el.inpFilter.val() )
                par.q = Media.el.inpFilter.val().trim();
            if(Media._mime)
                par.mime = Media._mime;
            
            Media.loader('Finding...');
            Media.el.lisResult.html('');
            
            $.get(tMedia.filter, par, function(res){
                if( typeof res !== 'object' ){
                    Media.loader(false);
                    return alert( res );
                }
                
                if(res.error){
                    Media.loader(false);
                    return alert(res.error);
                }
                
                if(Media.el.inpFilter.val().trim() === par.q){
                    Media.loader(false);
                    Media.search.result(res.data);
                }
            });
        },
        
        result: function(items){
            Media.el.lisResult.html('');
            for(var i=0; i<items.length; i++){
                var item = items[i];
                
                var thu = $('<div class="thumbnail clickable" data-image="' + item.path + '"></div>');
                thu.append('<img src="' + item.path + '" alt="#">');
                thu.append('<div class="caption">' + item.name + '</div>');
                
                thu.click(function(){
                    Media._cb($(this).data('image'));
                    Media.el.drawer.drawer('hide');
                });
                
                Media.el.lisResult.append(thu);
            }
        }
    },
    
    upload: {
        init: function(){
            Media.el.btnUpload.on('change', function(){
                var file = $(this).get(0).files[0];
                Media.loader('Uploading...');
                Media.upload.send(file, {form: Media._form}, function(err, data){
                    Media.loader(false);
                    if(err)
                        return bootbox.alert({title: 'Error', message: err});
                    
                    Media._cb(data.path);
                    Media.el.drawer.drawer('hide');
                });
            });
        },
        
        send: function(file, params, cb){
            var formData = new FormData(),
                xhr      = new XMLHttpRequest();
            
            if(params){
                for(var field in params)
                    formData.append(field, params[field]);
            }
            
            formData.append('file', file, file.name);
            xhr.open('POST', tMedia.upload, true);
            xhr.onreadystatechange = function(){
                if(xhr.readyState == 4){
                    if(xhr.status == 200){
                        var res = window.JSON.parse(xhr.responseText);
                        if(res.error)
                            return cb(res.error);
                        return cb(false, res);
                    }else{
                        cb('Internal Server Error');
                    }
                }
            }
            
            xhr.send(formData);
        }
    }
}

Media.init();