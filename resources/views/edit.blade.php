@include("layouts.master")

        <!doctype html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>글 쓰기</title>

    <style>
        .realContentDiv {
            width: 100%;
            height: 85%;
            display: flex;
            flex-direction: column;
        }

        .contentBoxDiv {
            width: 100%;
            height: 95%;
            margin-top: 3%;
        }

        .txtContent {
            width: 100%;
            height: 100%;
        }

        .titleBoxDiv {
            width: 100%;
            height: 40px;
        }

        .txtTitle {
            width: 100%;
            height: 100%;
            line-height: 40px;
        }

    </style>
</head>
<body>
<script>
    window.onload = () => {
        let formElement = document.getElementById("editForm");
        let titleElement = document.getElementById("txtTitle");
        let contentElement = document.getElementById("txtContent");

        function edit_click() {
            if (titleElement.value == '' || contentElement.value == ''){
                alert('입력되지 않은 칸이 있습니다');
                return;
            }

            formElement.submit();
        }
    }
</script>
<div class="mainDiv">
    @yield("nav")
    <div class="contentDiv">
        <div class="subContentDiv">
            <div class="categoryDiv">
                My Story > 글수정
            </div>
            <form id="editForm" method="POST" action="/index/mystory/edit/process/{{ $story->id }}">
                @csrf
                <div class="realContentDiv">
                    <div class="titleBoxDiv">
                        <input id="txtTitle" name="txtTitle" class="txtTitle" type="text" value="{{ $story->title }}">
                    </div>
                    <div class="contentBoxDiv">
                        <textarea id="txtContent" name="txtContent" class="txtContent" id="" cols="30" rows="10" >{{ $story->content }}</textarea>
                    </div>
                </div>
                <hr>
                <div class="contentFootDiv">
                    <div class="buttonDiv">
                        <button onclick="write_click">수정</button>
                        <button>취소</button>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
</body>
</html>