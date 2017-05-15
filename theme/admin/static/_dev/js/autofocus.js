$(function(){
    'use strict';
    
    var focusable = 'input,select,textarea';
    
    var formError = $('.form-group.has-error');
    if(formError.get(0))
        return $(formError.get(0)).find(focusable).focus();
    var formInput = $('.form-group');
    if(formInput.get(0))
        return $(formInput.get(0)).find(focusable).focus();
});