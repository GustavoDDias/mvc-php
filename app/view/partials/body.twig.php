<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{% block title %}{% endblock %}</title>

    <link rel="stylesheet" href="{{BASE}}css/style.css" />
    <link rel="stylesheet" href="{{BASE}}vendor/bootstrap-5.1.0/css/bootstrap.min.css" rel="stylesheet" />
    <script src="{{BASE}}js/main.js"></script>
    <script src="{{BASE}}vendor/jquery/jquery-3.6.0.min.js"></script>
    <script src="{{BASE}}vendor/bootstrap-5.1.0/js/bootstrap.min.js"></script>
    
</head>
<body>

    {% include 'partials/header.twig.php' %}

    {% block body %}{% endblock %}

    {% include 'partials/footer.twig.php' %}

</body>
</html>