$(function(){
    $('.panel-form-list .form-filter').each(function(i,e){
        var $this = $(e);
        
        $this.keypress(function(e){
            if(e.keyCode == 13)
                e.preventDefault();
        });
        
        $this.typeahead({
            delay: 300,
            fitToElement: true,
            source: function(q,cb){
                $.get(this.$element.data('source'), {q: q}, function(res){
                    if(res.error || !res.data)
                        return;
                    var opts = [];
                    for(var k in res.data)
                        opts.push({id: k, name: res.data[k]});
                    cb(opts);
                });
            },
            afterSelect: function(val){
                var el = this.$element;
                
                var list = $('#'+el.data('list'));
                var opts = list.children('li');
                var exists = [];
                
                for(var i=0; i<opts.length; i++)
                    exists.push( $(opts[i]).find('input').val() );
                
                if(~exists.indexOf(val.id))
                    return el.val('').focus();
                
                var li = $('<li class="list-group-item"></li>');
                list.append(li);
                li.text(val.name);
                
                var btn = $('<button type="button" class="close" aria-label="Close" onclick="multyAjaxRemove(this)"><span aria-hidden="true">&times;</span></button>');
                li.append(btn);
                
                var input = $('<input type="hidden">');
                li.append(input);
                input.attr('name', el.data('name')+'[]');
                input.val(val.id);
                
                el.val('').focus();
            }
        });
    });
});

function multyAjaxRemove(el){
    $(el).parent().slideUp(function(){
        $(this).remove();
    });
}