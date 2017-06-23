(function($){
    
    $(document).ready(function(){
       
        //select2 plugin initalize
        $('select').select2({
            allowClear: true
        });

        //initalize popups
        $('[data-original-title]').tooltip();


        //filter&search form handling
        var $filterSearchForm = $('form.filter-search');
        $filterSearchForm.find('[name="limit"]').change(function(){
            $filterSearchForm.submit();
        });

        //submit form after change limit select
        $('form [name="limit"]').change(function(){
            $(this).closest('form').submit();
        });
                
    });
    
})(jQuery);