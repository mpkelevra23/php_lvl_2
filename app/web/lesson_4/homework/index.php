<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            var more = 2;
            $("#more").click(function () {
                var str = "more=" + more;
                $.ajax({
                    type: "POST",
                    url: "ProductController.php",
                    data: str,
                    success: function (msg) {
                        $("#result").html(msg);
                    }
                });
                more++;
            })
        })
    </script>
</head>
<body>
<div id="result">
    <?php
    include_once 'ProductController.php';
    ?>
</div>
<button id="more">Ещё</button>
</body>
</html>
