$(function(){
    
    // bootstrap select mobile support
    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent))
        $('select.form-control').selectpicker('mobile');
    
    $('.selectpicker[data-ajax]').selectpickerAjax({
        ajaxPreProcess: function(res){
            if(res.error)
                return [];
            var result = { '0': 'None' };
            for(var k in res.data)
                result[k] = res.data[k];
            return result;
        }
    });
    
    // bootstrap select
    $('select.form-control').each(function(i,e){
        var $this = $(e);
        
        $this.selectpicker();
    });
    
    // typeahead from datalist
    $('.form-control[list]').each(function(i,e){
        var $this = $(e);
        var datalist = $('#'+$this.attr('list'));
        var options  = datalist.children('option');
        $this.removeAttr('list');
        
        var opts = [];
        for(var i=0; i<options.length; i++)
            opts.push(options[i].value);
        
        $this.typeahead({source: opts});
    });
});