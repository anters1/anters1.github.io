  $(function () {
    $('.radio-check').click(function () {
      $(this).toggleClass('switch-on');
      if ($(this).hasClass('switch-on')) {
        $(this).trigger('on.switch');
      } else {
        $(this).trigger('off.switch');
      }
    });
    $('.radio-check').on('on.switch', function () {
      $($(this).attr('data-id')).removeClass('bl-hide');
    });
    $('.radio-check').on('off.switch', function () {
      $($(this).attr('data-id')).addClass('bl-hide');
    });
  });
