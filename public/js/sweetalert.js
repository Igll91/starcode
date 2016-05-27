/**
 *
 * Created by silvio on 19/04/16.
 */

function deleteConfirmationSweetAlert(element) {

    var title = $(element).data('title');
    var text  = $(element).data('text');
    var type  = $(element).data('type');

    swal({
             title:              title,
             text:               text,
             type:               type,
             showCancelButton:   true,
             confirmButtonColor: "#DD6B55",
             confirmButtonText:  "Yes, delete it!",
             closeOnConfirm:     false,
             html:               false
         }, function () {
             return true;
         }
    );

    return false;
};
