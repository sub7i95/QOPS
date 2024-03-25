var SurveyArea = function () {

    var uri = 'surveys';

    // Create & Update
    var store = function ( e ) 
    {
        e.preventDefault();
        
        var form = $(this);      
        var $btn = form.find('button[type="submit"]').button('loading');// Please wait... message
        var type = form.find('input[name="_method"]').val() || 'POST';
        var url  = form.attr('action'); 

        if( type == 'PUT')
        {
            var url = form.attr('action') + '/' + $('#id').val();     
        }

        $.ajax({
            url     : url,
            type    : type ,
            data    : form.serialize(),
            dataType: 'json',
            success : function( json )
            {
                $('.modal').modal('hide');//hide modal
                location.reload();
            },
            error   : function ( jqXhr, json, errorThrown ) 
            {
                if( jqXhr.status == 422)  //  if validation failed
                {    
                    var errors = jqXhr.responseJSON;//get Larevel errors
                    var errorsHtml ='';                  
                    $.each( errors, function( key, value ) 
                    {
                        errorsHtml += '<li class="red">' + value[0] + '</li>'; 
                    });
                    $('.showError').html( errorsHtml );//show error messages 
                }
            }
        }).always(function(){
            $btn.button('reset');
        });
    };


    /*
     * Create modals 
    */
    var create = function ( e ) 
    {
        $('#_method').val( 'POST' );
        $('#form-' + uri ).trigger("reset");
        $('#modal-' + uri+'-area' ).modal('show');
    };

    var createItem = function ( e ) 
    {
        $('#_method').val( 'POST' );
        $('#area_id').val( $(this).data('id') );
        $('#form-surveys-area-item' ).trigger("reset");
        $('#modal-surveys-area-item' ).modal('show');
    };


    /*
     * Edit modals 
    */
    var edit = function ( e ) 
    {
         e.preventDefault();
        $.get( api + '/' + uri + '/' + $(this).data('id') + '/area', function( data ) 
        {
            $('#_method').val( 'PUT' );
            $('#id').val( data.id );
            $('#name').val( data.first_name );
            $('#active').val( data.active );
        });        

        $('#modal-' + uri ).modal('show');
    };


    /*
     * Edit Item 
    */
    var editItem = function ( e ) 
    {
        e.preventDefault();

        $.get( api + '/surveys/'+$(this).data('survey')+'/items/'+$(this).data('id') , function( data ) 
        {
            $('#_method').val( 'PUT' );
            $('#id').val( data.id );
            $('#item_name').val( data.name );
            $('#item_weight').val( data.weight );
            //$('#active').val( data.active );
        });        

        $('#modal-surveys-area-item' ).modal('show');
    };

    /*
     * Update Item 
    */
    var updateItem = function ( e ) 
    {
        e.preventDefault();

        $.get( api + '/surveys/'+$(this).data('survey')+'/items/'+$(this).data('id') , function( data ) 
        {
            $('#_method').val( 'PUT' );
            $('#id').val( data.id );
            $('#item_name').val( data.name );
            $('#item_weight').val( data.weight );
            //$('#active').val( data.active );
        });        

        $('#modal-surveys-area-item' ).modal('show');
    };


    var destroy = function(e) {
        e.preventDefault();
    
        if (confirm('Are you sure?')) {
            var token = $('meta[name="csrf-token"]').attr('content');  
              
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': token // Set the CSRF token as a header for all AJAX requests
                }
            });
    
            $.post(api + '/area/' + $(this).data('id'), {
                _method: 'DELETE',
                _token: token // Send the CSRF token along with the request
            })
            .done(function(data) {
                location.reload();
            })
    
            return false;
        }
    };



    return {

        init: function () 
        {
            //if (!jQuery().dataTable) {
            //    return;
            //}
            // list
            // create form
            $('.btn-add-surveys-area').on('click', create );
            $('.btn-add-area-item').on('click', createItem );

            // show/edit
            $( '.btn-edit-area' ).on('click', edit ) ;
            $( '.btn-edit-area-item' ).on('click', editItem ) ;
            
            //$( '.btn-edit-item' ).on('click', editItem ) ;
            // store
            $('.ajax-form-surveys-area').on('submit', store ); 
            // remove
            $( '.btn-remove-area-id' ).on('click', destroy ) 


        }
    };
}();

jQuery(document).ready(function() {
    SurveyArea.init();
}); 