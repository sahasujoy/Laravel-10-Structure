/*=========================================================================================
    File Name: form-select2.js
    Description: Select2 is a jQuery-based replacement for select boxes.
==========================================================================================*/
(function (window, document, $) {
  'use strict';
  var select = $('.select2');

  select.each(function () {
    var $this = $(this);

    $this.wrap('<div class="position-relative"></div>');
    $this.select2({
      // the following code is used to disable x-scrollbar when click in select input and
      // take 100% width in responsive also
      dropdownAutoWidth: true,
      width: '100%',
      dropdownParent: $this.parent()
    });
  });

})(window, document, jQuery);
