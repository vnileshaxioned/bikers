(function ($) {

  $(document).ready(function () {
    // for search
    $('.search-field').keyup(function () {
      var data = $(this),
        inputValue = data.val();
      searchFilter('', inputValue);
    });

    // for filter
    $('.filter-taxonomy').click(function () {
      var color = $('.filter-taxonomy option:selected').val();
      searchFilter(color);
    });

    // searchFilter function to call ajax request
    function searchFilter(color = '', search = '') {
      var postPerPage = $('.post-container').attr('data-posts');
      $.ajax({
        type: 'post',
        url: ajax.ajaxurl,
        data: {
          action: 'filter_search',
          color: color,
          search: search,
          post_per_page: postPerPage,
        },
        datatype: 'json',
        success: function (response) {
          if (response.length) {
            $('.post-container').html(response);
          } else {
            $('.post-container').html('<li><span>No Search found</span></li>');
          }
        },
        error: function (xhr, status, error) {
          alert('Status: ' + xhr.status + ' ' + error);
        },
      });
    }
    
    var postPerPage = $('.post-container').attr('data-posts'),
      allPosts = $('.post-container').attr('data-all-posts'),
      counts = parseInt(postPerPage),
      count = counts;
    $('.load-more-button').click(function (e) {
      e.preventDefault();
      console.log(postPerPage);
      $.ajax({
        type: 'post',
        url: ajax.ajaxurl,
        data: {
          action: 'filter_search',
          offset: count,
          post_per_page: postPerPage,
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