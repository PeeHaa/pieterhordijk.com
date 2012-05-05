(function($) {
  $('.mainmenu > ul > li').hover(function() {
    var $li = $(this).closest('li');
    $('.mainmenu ul ul').stop().clearQueue().fadeOut('slow', function() {
      $('ul', $li).stop().clearQueue().fadeIn('slow');
    });
  }, function() {
    var $li = $(this).closest('li');
    $('ul', $li).stop().clearQueue().fadeOut('slow', function() {
      $('.mainmenu ul li.active ul').clearQueue().stop().fadeIn('slow');
    });
  });

  $('.usermenu .login a').click(function() {
    var $usermenu = $(this).closest('.usermenu');
    var $loginform  = $('.loginform', $usermenu);

    if ($loginform.css('display') == 'inline') {
      $loginform.css('display', 'none');
    } else {
      $loginform.css('display', 'inline');
      $('input[name="username"]', $loginform).focus();
    }

    return false;
  });

  $('.usermenu .loginform form').submit(function() {
    var $form = $(this);
    var $csrftoken = $('input[name="csrf-token"]', $form);
    var $username = $('input[name="username"]', $form);
    var $password = $('input[name="password"]', $form);
    var $submit = $('input[type="submit"]', $form);

    if ($username.val() == '' || $password.val() == '') {
      return false;
    }

    $submit.animate({
      opacity: 0
    }, 500);

    var requestData = $form.serialize();
    requestData+= '&submit=submit';

    $username.attr('disabled', 'disabled');
    $password.attr('disabled', 'disabled');

    var requestSettings = {
      url: $form.attr('action') + '/json',
      data: requestData,
      type: $form.attr('method'),
      dataType: 'json',
      error: function(jqHr, status, error) {
        $submit.css('background-image', 'url(/style/key_delete.png)');
        $username.removeAttr('disabled');
        $password.removeAttr('disabled').val('');

        $submit.animate({
          opacity: 1
        }, 500, function() {
            setTimeout(function() {
              $submit.css('background-image', 'url(/style/key_go.png)');
            }, 2000);
        });
      },
      success: function(data, status, jqHr) {
        if (data.result == 'success') {
          window.location.href = window.location.href;
          return;
        } else {
          $submit.css('background-image', 'url(/style/key_delete.png)');
          $username.removeAttr('disabled');
          $password.removeAttr('disabled').val('');

          $submit.animate({
            opacity: 1
          }, 500, function() {
              setTimeout(function() {
                $submit.css('background-image', 'url(/style/key_go.png)');
              }, 2000);
          });
        }
      }
    };
    $.ajax(requestSettings);

    return false;
  });

  $('aside a.delete').click(function() {
    var answer = confirm('Are you sure you want to delete this project?');
    if (!answer) {
      return false;
    }
  });
})(jQuery);