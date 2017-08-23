+function($){
    'use strict';
    
    $(document).on('click.bs.confirm', '[data-confirm]', function(e){
        var $this   = $(this);
        var href    = $this.attr('href') || $this.data('target');
        var title   = $this.data('confirm');
        var message = $this.data('confirm-message');
        var type    = $this.data('confirm-type') || 'danger';
        var label   = $this.data('confirm-label');
        if(!label){
            if(type == 'danger')
                label = 'Delete';
            else
                label = 'Oke';
        }
        
        bootbox.confirm({
            title: title,
            message: message,
            buttons: {
                confirm: {
                    label: label,
                    className: 'btn-' + type
                },
                cancel: {
                    label: 'Cancel'
                }
            },
            callback: function(confirm){
                if(confirm)
                    top.location.href = href;
            }
        });
        
        return false;
    });
    
}(jQuery);