    $('.ace-switch').on('change', function(){
        var checkbox = $(this);
        var act = checkbox.is(':checked') ? 'on' : 'off';
        var url = checkbox.data('link').replace("__act__",act);
        $.getJSON(url, function(response){
            if(response.result === 'success'){

            }
            else
            {
                checkbox.is(':checked')?checkbox.attr('checked',''):checkbox.attr('checked','checked');
                alert('set error');
                return false;

            }

        },function(){
            checkbox.is(':checked')?checkbox.attr('checked',''):checkbox.attr('checked','checked');
                alert('set error');
                return false;
        });
    });
