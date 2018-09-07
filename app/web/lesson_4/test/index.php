<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="script/jquery-3.3.1.min.js"></script>
    <title>Document</title>
</head>
<body>

<ul id="goods">
    <?php include 'query.php'; ?>
</ul>

<button id="more">MORE!!!</button>

<script>
    $(document).ready(function () {
        var i = 1;
        $("#more").click(function () {
            i++;
            $.post("query.php", {more:i}, function (data) {
                $("#goods").html(data);
            });
            return false;
        })
    })
</script>

</body>
</html>