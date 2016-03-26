<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Foundation image gallery with Phalcon</title>
        {{ stylesheet_link("css/foundation.min.css") }}
    </head>
    <body>
        {{ content() }}
    </body>
    {{ javascript_include("libs/jquery.min.js") }}
    {{ javascript_include("libs/foundation.js") }}
    <script>
        $(document).foundation();
    </script>
</html>
