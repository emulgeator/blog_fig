$(document).ready(function() {

    $('#buttonBlogPostEdit').click(function() {
        var url = $(this).attr('data-url');

        window.location.replace(url);
    });

    $('#buttonBlogPostDelete').click(function() {
        var url = $(this).attr('data-url');

        modifyPost(url, function() {
            window.location.replace('/');
        });
    });

    $('#buttonBlogPostPublish').click(function() {
        var url = $(this).attr('data-url');

        modifyPost(url, function() {
            location.reload();
        });
    });

    $('#buttonBlogPostUnPublish').click(function() {
        var url = $(this).attr('data-url');

        modifyPost(url, function() {
            location.reload();
        });
    });
});

function modifyPost(url, callback) {
    var csrfToken = $('input[name=_token]').val();

    $.post(url, {"_token": csrfToken}, callback);
}
