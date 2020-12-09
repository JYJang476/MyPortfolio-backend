@include("layouts.master")

<!doctype html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>메인 페이지</title>
    <style>
        .contentDiv {
            height: 90%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .subContentDiv {
            width: 390px;
            height: 220px;
        }

        .msgDiv {
            width: 356px;
            text-align: center;
            margin: auto;
            padding-bottom: 5px;
        }

        .msgDiv p {
            margin: 0;
        }

        .btDiv {
            width: 230px;
            height: 60px;
            border: 1px solid #707070;
            margin: auto;
            text-align: center;
            line-height: 60px;
        }
    </style>
</head>
<body>
    <div class="mainDiv">
        @yield("nav")
        <div class="contentDiv">
            @yield("mainView")
        </div>
    </div>
</body>
</html>
