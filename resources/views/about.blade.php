@include("layouts.master")

<!doctype html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About</title>
    <style>
        .subContentDiv {
            margin: auto;
        }

        img {
            margin-left: 50px;
        }
    </style>
</head>
<body>
    <div class="mainDiv">
        @yield("nav")
        <div class="contentDiv">
            <div class="subContentDiv">
                <div class="profileDiv">
                    <img src="/index/image/17" alt="">
                </div>
                <div class="licenseDiv">
                    <p>자격증</p>
                    <p>기계설계산업기사</p>
                    <p>JPT 715점</p>
                </div>
                <div class="licenseDiv">
                    <p>나의 정보</p>
                    <p>Phone : 010-6665-9400</p>
                    <p>E-mail : reloop15@g.yju.ac.kr</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>