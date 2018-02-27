jQuery(function($){
    var alert = $('#alert');
    if (alerte.length > 0)
    {
        alert.hide().slideDown(500);
        alert.find('.close').click(function(e)
        {
            e.preventDefault();
            alerte.slideUp();
        })
    }
});