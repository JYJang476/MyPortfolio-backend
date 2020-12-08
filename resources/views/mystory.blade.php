@include("layouts.master")
<!doctype html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>나의 스토리</title>

    <style>

        .realContentDiv {
            width: 100%;
            height: 97%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .contentLeftDiv {
            width: 35%;
            height: 100%;

        }

        .schDiv {
            width: 100%;
            height: 5%;
        }

        .boardDiv {
            width: 100%;
            height: 85%;
            background-color: white;
            border: 1px solid #707070;
            font-size: 0.8em;
        }

        .headerDiv {
            width: 100%;
            height: 5%;
            border-bottom: 1px solid #707070;
            display: flex;
            justify-content: space-between;
        }

        .headerDiv div, .itemDiv div {
            text-align: center;
            line-height: 2.25;
        }

        .headerDiv div:nth-child(1),
        .itemDiv div:nth-child(1) {
            width: 25%;
            height: 100%;
        }

        .headerDiv div:nth-child(2),
        .itemDiv div:nth-child(2) {
            width: 50%;
            height: 100%;
        }

        .headerDiv div:nth-child(3),
        .itemDiv div:nth-child(3){
            width: 25%;
            height: 100%;
        }

        .contentRightDiv {
            width: 60%;
            height: 100%;
        }

        .rightContentDiv {
            width: 100%;
            height: 85%;
            border: 1px solid #707070;
            background-color: white;
            margin-top: 5%;
        }

        .contentHeaderDiv {
            width: 100%;
            height: 30px;
            line-height: 30px;
            display: flex;
            justify-content: space-between;
        }

        .contentHeaderDiv div:nth-child(1) {
            padding-left: 5px;
            width: 70%;
            height: 100%;
            background-color: white;

        }

        .contentHeaderDiv div:nth-child(2) {
            width: 30%;
            height: 100%;
            text-align: center;
        }

        .contentContentDiv {
            width: 95%;
            height: 95%;
            margin-left: 2.5%;
            margin-top: 2.5%;
        }

        .listDiv {
            width: 100%;
            height: 100%;
        }

        .itemDiv {
            width: 100%;
            height: 40px;
            display: flex;
            justify-content: space-around;
        }

        .rightFootDiv, .contentFootDiv {
            margin-top: 5px;
        }

    </style>
</head>
<body>
    <script>
        window.onload = () =>
        {
            let schText = document.getElementById('sch_txt');
            function schMyStory(e) {
                let list = document.getElementById('listDiv');
                if (e.keyCode == 13) {
                    alert('aa');
                    let httpObj = new XMLHttpRequest();
                    httpObj.open('GET', '/api/mystory/search?schValue=' + schText.value);
                    httpObj.send();

                    httpObj.onreadystatechange = () => {
                        if (httpObj.status == 200) {
                            let listHTML = '';
                            let bodyJson = JSON.parse(httpObj.responseText);

                            for (let item of bodyJson) {
                                listHTML += "<a href='/index/mystory/'" + item.id + ">\n" +
                                    "<div class='itemDiv'>\n" +
                                    "<div>" + item.id + "</div>\n" +
                                    "<div>" + item.title + "</div>\n" +
                                    "<div>" + item.date + "</div>\n" +
                                    "</div>\n" +
                                    "</a>\n";
                                list.innerHTML = listHTML;
                            }
                        } else if (httpObj.status == 404) {
                            list.innerHTML = httpObj.responseText;
                        }
                    }
                }
            }

            schText.onkeydown = schMyStory;


        }
    </script>
    <div class="mainDiv">
        @yield("nav")
        <div class="contentDiv">
            <div class="subContentDiv">
                <div class="categoryDiv">
                    My Story
                </div>
                <div class="realContentDiv">
                    <div class="contentLeftDiv">
                        <div class="schDiv">
                            <div class="txtBoxDiv">
                                <input class="sch_txt" id="sch_txt" type="text" placeholder="검색어">
                                <a href="">
                                    <img src="" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="boardDiv">
                            <div class="headerDiv">
                                <div>번호</div>
                                <div>제목</div>
                                <div>날짜</div>
                            </div>
                            <div id="listDiv" class="listDiv">
                                @foreach($storys as $item)
                                    <a href="/index/mystory/{{$item['id']}}">
                                        <div class="itemDiv">
                                            <div>{{ $item['id'] }}</div>
                                            <div>{{ $item['title'] }}</div>
                                            <div>{{ $item['date'] }}</div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="contentFootDiv">
                            <a href="write"><button>글쓰기</button></a>
                        </div>
                    </div>
                    <div class="contentRightDiv">
                        <div class="rightContentDiv">
                            <div class="contentHeaderDiv">
                                <div>{{ $story->title }}</div>
                                <div>{{ $story->date }}</div>
                            </div>
                            <div class="contentContentDiv">
                                {{ $story->content }}
                            </div>
                        </div>
                        <div class="rightFootDiv">
                            <a href="delete/{{$story->id}}"><button>삭제</button></a>
                            <a href="edit/{{$story->id}}"><button>수정</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
