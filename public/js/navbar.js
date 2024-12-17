$(document).ready(function() {
    // Handle clicks on navbar links
    $('.ajax-link').on('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');


        $('.nav-links a').removeClass('active');
        $(this).addClass('active');

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('#content-area').html($(response).find('#content-area').html());
                window.history.pushState({ path: url }, '', url);
            },
            error: function() {
                alert('Error loading the page.');
            }
        });
    });

    $(window).on('popstate', function() {
        var path = window.location.pathname;
        if (path) {
            $.ajax({
                url: path,
                type: 'GET',
                success: function(response) {
                    $('#content-area').html($(response).find('#content-area').html());
                }
            });
        }
    });
});
