$(function(){
    var jsMapCreated = false;
    var mapPickers = $('.form-map');
    var fMap = $(mapPickers.get(0));
    
    if(!mapPickers.get(0))
        return;
    
    if(!jsMapCreated){
        var gapi = fMap.data('map-api');
        var s = $('<script></script>');
        s.attr('src', '//maps.google.com/maps/api/js?libraries=places&callback=generateFormField&key=' + gapi); //https://maps.googleapis.com/maps/api/js?libraries=places&callback=generateFormField&key='+gapi);
        $(document.body).append(s);
        jsMapCreated = true;
    }
    
    window.generateFormField = function(){
        mapPickers.each(function(i,e){
            var $this       = $(e);
            var $picker     = $('#'+$this.data('picker'));
            var sboxCreated = false;
            var val         = $this.val().trim();
            
            var opts = {
                    radius: 0,
                    enableAutocomplete: true,
                    onchanged: function(cloc, rad, isdrop){
                        if(!isdrop)
                            return;
                        $this.val(cloc.latitude + ',' + cloc.longitude);
                    },
                    oninitialized: function(component){
                        if(sboxCreated)
                            return;
                        
                        var mapContext = $(component).locationpicker('map');
                        var map = mapContext.map;
                        var input = $('<input type="search" class="form-control input-sm" placeholder="Find Location" style="margin-left:10px;margin-top:10px;width:75%;">').get(0);
                        var searchBox = new google.maps.places.SearchBox(input);
                        $this.data('search-box', $(input));
                        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                        
                        $(input).keypress(function(e){
                            if(e.keyCode == 13)
                                return false;
                        });
                        
                        map.addListener('bounds_changed', function() {
                            $(input).val('');
                        });
                        
                        searchBox.addListener('places_changed', function() {
                            var places = searchBox.getPlaces();
                            var geometry = places[0].geometry;
                            var loc = geometry.location.lat() + ',' + geometry.location.lng();
                            $this.val(loc);
                            $this.change();
                        });
                        
                        sboxCreated = true;
                    }
                };
            
            if(val){
                var eloc = val.split(',');
                opts.location = {
                    latitude: parseFloat(eloc[0]),
                    longitude: parseFloat(eloc[1])
                }
                if(!opts.location.latitude)
                    opts.location.latitude = -6.175382;
                if(!opts.location.longitude)
                    opts.location.longitude = 106.827110;
            }
            
            $picker.locationpicker(opts);
            
            $this.change(function(){
                if(!$this.val())
                    return;
                delete opts.location;
                var eloc = $this.val().split(',');
                opts.location = {
                    latitude: parseFloat(eloc[0]),
                    longitude: parseFloat(eloc[1])
                }
                if(opts.location.latitude && opts.location.longitude)
                    $picker.locationpicker(opts);
            });
            
            $this.keydown(function(e){
                if(e.keyCode == 13){
                    var val = $this.val();
                    $this.val('');
                    var searchBox = $this.data('search-box');
                    searchBox.val(val).focus();
                    return false;
                }
            });
        });
    };
});