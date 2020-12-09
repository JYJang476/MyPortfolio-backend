@include("layouts.master")

        <!doctype html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>로그인</title>
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

        .loginBoxDiv {
            width: 360px;
            height: 50%;
            margin: auto;
        }

        .loginBoxDiv form {
            width: 100%;
            height: 100%;

        }

        .textDiv {
            width: 300px;
            height: 80%;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

        .loginBoxDiv input[type="text"], input[type="password"] {
            width: 300px;
            height: 30px;
            margin-left: 30px;
        }

        .loginButton {
            width: 300px;
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            margin-left: 30px;
        }
        .loginBoxDiv input[type="submit"] {
        }

    </style>
</head>
<body>
<div class="mainDiv">
    @yield("nav")
    <div class="contentDiv">
        <div class="subContentDiv">
            <div class="msgDiv">
                <p>방문을 환영합니다.</p>
                <p>관리자이시면 로그인을 해주세요</p>
            </div>
            <div class="loginBoxDiv">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="textDiv">
                        <input name="email" type="text" placeholder="아이디">
                        <input name="password" type="password" placeholder="비밀번호">
                    </div>
                    <div class="loginButton">
                        <input type="submit" value="로그인">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
