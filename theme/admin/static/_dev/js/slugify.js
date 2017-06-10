$(function(){
    
    $('input[data-slug]').each(function(i,e){
        var $this = $(this);
        var value = $this.val().trim();
        
        if(value)
            return;
        
        $this.on('keyup paste focus', function(){
            $(this).data('dirty', true);
        });
        
        var target = $($this.data('slug'));
        target.on('keyup paste', function(){
            if($this.data('dirty'))
                return;
            
            var tval = $(this).val().trim().toLowerCase();
            tval = tval.replace(/[^a-z0-9]/g, '-');
            tval = tval.replace(/-+/g, '-');
            tval = tval.replace(/^-*|-*$/g, '');
            
            $this.val(tval);
        });
    });
    
});