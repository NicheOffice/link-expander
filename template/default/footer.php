<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $('#send').click(function (e) {
        document.getElementById("send").disabled = true;
        submit(url, token);
        e.preventDefault();
    });

    function submit() {
        const buttonText = $('#send').text()
        $('#send').html('<i class="fas fa-circle-notch fa-spin"></i>');
        $.post("system/ajax.php", {url: $('#url').val(), token: $('#token').val()}, function (data) {
            if (data !== 'error') {
                $.get("template/default/result.php", function (result) {
                    result = result.replace(new RegExp("{{title}}", "g"), data.title);
                    result = result.replace(new RegExp("{{image}}", "g"), data.image);
                    result = result.replace(new RegExp("{{safety}}", "g"), data.safety);
                    result = result.replace(new RegExp("{{keywords}}", "g"), data.keywords);
                    result = result.replace(new RegExp("{{description}}", "g"), data.description);
                    result = result.replace(new RegExp("{{shortUrl}}", "g"), data.shortUrl);
                    result = result.replace(new RegExp("{{longUrl}}", "g"), data.longUrl);
                    result = result.replace(new RegExp("{{tagClass}}", "g"), data.tagClass);
                    $('.columns').html(result);
                });
                if (data.image === undefined) {
                    $('.image is-4by3').remove();
                }
                $('#send').empty();
                $("#send").html(buttonText);
                document.getElementById("send").disabled = false;
            } else {
                $('.columns').html('<h1><div class="notification is-warning">' + data + '</div></h1>');
                $('#send').empty();
                $("#send").html(buttonText);
                document.getElementById("send").disabled = false;
            }
        });
    }
</script>
</body>
</html>