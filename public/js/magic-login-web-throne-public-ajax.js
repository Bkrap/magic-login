// console.log("hello");

jQuery('.login-ajax-form').on("submit", function(e){ // class of root/inc/magic_login/components/modal/first-step.php button

    e.preventDefault();
    var userEmailVar = jQuery("#magic-email").val();

    // Cookies.set('userToken', userTokenVar, { expires: 1 }); // docs: https://github.com/js-cookie/js-cookie

    var formData = {
      action: 'check_user',
    //   page_id: curr_post_id,
      email: userEmailVar,
    //   redirectLink: jQuery("#clickedUrl").val(),
    };

    jQuery.ajax({
      type: 'POST',
      url:  magic_login_web_throne_admin_ajax,
      dataType: 'html',
      data: formData,
      success: function(data) {
        data = jQuery.trim(data);
        // jQuery('#exampleModal').modal('hide');
        console.log(data);
        // if( data == 'user-exists' ) {
        //   jQuery('#exampleModal3').modal('toggle');
        // } else {
        //   jQuery('#exampleModal2').modal('toggle');

        //   var loadingWheel = jQuery('#loading-second-step').hide();
        //   //Attach the event handler to any element
        //   jQuery(document)
        //     .ajaxStart(function () {
        //        //ajax request went so show the loading image
        //         loadingWheel.show();
        //     })
        //   .ajaxStop(function () {
        //       //got response so hide the loading image
        //        loadingWheel.hide();
        //    });
        // }
        
        return data;
      },
      error: function(request, status, error, res){
        console.log(res);
        alert(request.responseText);
        console.log(data);
      },
    });

});