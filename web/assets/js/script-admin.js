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


        //delete and add ranking item (ranking form)

        var $wrapper = $('.js-item-wrapper');

        $wrapper.on('click', '.js-remove-item', function(e) {
            e.preventDefault();
            $(this).closest('.item-container')
                .fadeOut()
                .remove();
        });

        $wrapper.on('click', '.js-add-item', function(e) {
            e.preventDefault();
            // Get the data-prototype explained earlier
            var prototype = $wrapper.data('prototype');
            // get the new index
            var index = $wrapper.data('index');
            // Replace '__name__' in the prototype's HTML to
            // instead be a number based on how many items we have
            var newForm = prototype.replace(/__name__/g, index);
            // increase the index with one for the next item
            $wrapper.data('index', index + 1);
            // Display the form in the page before the "new" link
            $(this).before(newForm);
        });
                
    });
    
})(jQuery);