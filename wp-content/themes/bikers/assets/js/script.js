(function ($) {
  $(document).ready(function () {
    var postPerPage = $('.post-container').attr('data-posts'),
      allPosts = $('.post-container').attr('data-all-posts'),
      counts = parseInt(postPerPage),
      count = counts;
    $('.load-more-button').click(function (e) {
      e.preventDefault();
      $.ajax({
        type: 'post',
        url: ajax.ajaxurl,
        data: {
          action: 'load_more',
          offset: count,
          posts_per_page: postPerPage,
        },
        datatype: 'json',
        success: function (response) {
          $('.post-container').append(response);
          var postLength = $('.post-list').length;
          if (postLength == allPosts) {
            $('.load-more').hide();
          } else {
            count += counts;
          }
        },
        error: function (xhr, status, error) {
          alert('Status: ' + xhr.status + ' ' + error);
        },
      });
    });
  });
}(jQuery))