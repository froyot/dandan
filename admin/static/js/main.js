$('.status-btn').on('click',function(){
    var data_id = $(this).attr('data-id');
    var that = this;
    $.ajax({
        url:status_url,
        "data":{"id":data_id},
        "success":function(data){
            if(data.status)
            {
                $(that).removeClass('btn-success');
                $(that).removeClass('btn-error');
                if(data.data.status == 1)
                {
                    $(that).addClass('btn-success');
                    $(that).text("Used");
                }
                else
                {
                    $(that).addClass('btn-error');
                    $(that).text("Not Used");
                }
            }
        }
    })
});