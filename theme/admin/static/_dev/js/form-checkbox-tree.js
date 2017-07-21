$(function(){
    $('.checkbox-tree').change(function(){
        var $this = $(this);
        var val = $this.prop('checked');
        if(!val)
            return;
        
        var parent = $('#'+$this.data('parent'));
        if(parent.prop('checked'))
            return;
        parent.prop('checked', true);
        parent.change();
    });
});