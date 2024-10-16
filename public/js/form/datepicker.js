// Class definition

var KTBootstrapDatepicker = (function () {
  var arrows;
  if (KTUtil.isRTL()) {
    arrows = {
      leftArrow: '<i class="la la-angle-right"></i>',
      rightArrow: '<i class="la la-angle-left"></i>',
    };
  } else {
    arrows = {
      leftArrow: '<i class="la la-angle-left"></i>',
      rightArrow: '<i class="la la-angle-right"></i>',
    };
  }

  // Private functions
  var demos = function () {
    // range picker
    $(".renge_picker").datepicker({
      rtl: KTUtil.isRTL(),
      todayHighlight: true,
      templates: arrows,
      orientation: "bottom left",
      format: "yyyy-mm-dd",
    });

    // year picker
    $(".year_picker").datepicker({
      rtl: KTUtil.isRTL(),
      templates: arrows,
      orientation: "bottom left",
      format: "yyyy",
      viewMode: "years",
      minViewMode: "years",
    });
  };

  return {
    // public functions
    init: function () {
      demos();
    },
  };
})();

jQuery(document).ready(function () {
  KTBootstrapDatepicker.init();
});
