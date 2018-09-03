jQuery(document).ready(function() {

    jQuery('.more_button').on('click', function(e){
        e.preventDefault();
        jQuery(this).hide();
        jQuery('.automodel-list-show').removeClass('class name hide_list');
    });

});