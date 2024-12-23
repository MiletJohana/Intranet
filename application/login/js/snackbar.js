function snackbar(content, style, timeout, htmlAllowed) {
    var options = {
        content: content,
        style: style,
        timeout: timeout,
        htmlAllowed: htmlAllowed
    }

    $.snackbar(options);
}