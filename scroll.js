(function ($) {
  $.fn.simpleLoadMore = function (options) {
    // Settings.
    var settings = $.extend({
      count: 1,
      btnHTML: '',
      item: ''
    }, options);

    $('button.btn-load').show();
    // Variables
    var $loadMore = $(this);
    var $items = $loadMore.find(settings.item);
    var btnHTML = settings.btnHTML ? settings.btnHTML : '<button type="button" class="btn btn-primary btn-load btn-sm">Load More <span class="fa text-primary fa-arrow-right"></span></button>';
    var $btnHTML = $(btnHTML);

    // Add classes.
    $loadMore.addClass('load-more');
    $items.addClass('load-more__item');

    // Add button.
    if (!$loadMore.find('.btn-load').length && $items.length > settings.count) {
      $loadMore.append($btnHTML);
    }

    $btn = $loadMore.find('.btn-load');

    if (!$btn.length) {
      $btn = $btnHTML;
    }

    if ($items.length > settings.count) {
      $items.slice(settings.count).hide();
    }

    // Add click event on button.
    $btn.on('click', function (e) {
      e.preventDefault();

      var $this = $(this),
        $updatedItems = $items.filter(':hidden').slice(0, settings.count);
      // Show the selected elements.
      if ($updatedItems.length > 0) {
        $updatedItems.slideDown();
      }

      // Hide the 'View More' button
      // if the elements lenght is less than 5.
      if ($updatedItems.length < settings.count) {
        $this.hide();
      }
    });
  }
}(jQuery));