var Survey = function () {

    var uri = 'surveys';

    var table = $('#table-'+uri); //main user table
    

     /** var list = function () {

      table.dataTable({
        "order"         : [[ 0, "asc" ]], 
        "lengthMenu"    : [ [ 50, 100, -1], [ 50, 100, "All"] ],
        "pageLength"    : 50,
        "iDisplayLength": 50,
        "paging"        : true,
        "ordering"      : true,
        "info"          : true,
        "ajax"          : api+"/"+uri,
        "columns"       : [
                    { data: null , render: function ( data ) 
                        {  
                            return '<a href="/surveys/'+data.id+'" class="btn btn-circle btn-xs dark btn-outline"><i class="icon-pencil"></i> Edit</a>';
                        }  
                    } ,  
                    { data: "id"},                    
                    { data: "name"},  
                    { data: null , render: function ( data ) 
                        {
                            return data.first_name + ' ' +  data.last_name;
                        }  
                    },
                    { data: null , render: function ( data ) 
                        {
                            return data.active==1 ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>' ; 
                        }  
                    },
           
                    ],
        destroy: true,            
        });
    }
    */ 


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
                table.api().ajax.reload();//update table values
                $('.modal').modal('hide');//hide modal
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






    var create = function ( e ) 
    {
        $('#_method').val( 'POST' );
        $('#form-' + uri ).trigger("reset");
        $('#modal-' + uri ).modal('show');
    };


    var edit = function ( e ) 
    {
 
        e.preventDefault();

        $.get( api + '/' + uri + '/' + $(this).data('id'), function( data ) 
        {
            $('#_method').val( 'PUT' );
            $('#id').val( data.id );
            $('#name').val( data.first_name );
            $('#active').val( data.active );
        });        

        $('#modal-' + uri ).modal('show');
    };


    var destroy = function ( e ) 
    {
        e.preventDefault();
 
        if( confirm('Are you sure?') ) 
        {
          $.post( api + $(this).data("url"), { _method: 'DELETE' } )
            .done(function( data ) {
                table.api().ajax.reload();//reload table
          });          
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
            //list();
            // create form
            $('.btn-'+uri+'-add').on('click', create );
            // show/edit
            $( table ).on('click', '.edit-'+uri+'-id', edit ) ;
            // store
            $('.ajax-form-'+uri).on('submit', store ); 
            // remove
            $( table ).on('click', '.remove-'+uri+'-id', destroy ) 
        }
    };
}();

jQuery(document).ready(function() {
    Survey.init();
}); 