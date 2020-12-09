@include("layouts.master")

<!doctype html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>새 프로젝트 추가</title>

    <style>
        * {
            color: #707070
        }

        .realContentDiv {
            width: 95%;
            height: 85%;
            margin-left: 2.5%;
            display: flex;
            flex-direction: column;
        }

        .txtTitle {
            width: 100%;
            height: 50px;
        }

        .techDiv {
            width: 100%;
            height: 220px;
        }

        .headerDiv {
            width: 100%;
            height: 40px;
            line-height: 40px;
            display: flex;
            justify-content: space-between;
        }

        .headerDiv div:nth-child(2) {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .listHeaderDiv {
            width: 100%;
            height: 40px;
            line-height: 40px;
            display: flex;
            justify-content: space-between;
        }

        .listHeaderDiv div:nth-child(1),
        .itemDiv div:nth-child(1){
            width: 10%;
            padding-left: 10px;
            border-right: 1px solid #707070;
        }

        .itemDiv div:nth-child(1) {
            border:  none;
        }

        .listHeaderDiv div:nth-child(2),
        .itemDiv div:nth-child(2) {
            width: 90%;
            text-align: left;
            padding-left: 20px;
        }

        .listDiv {
            width: 100%;
            height: 180px;
            background-color: white;
            border: 1px solid #707070
        }

        .listHeaderDiv {
            width: 100%;
            height: 40px;
        }

        .listItemDiv {
            width: 100%;
            height: 140px;
            overflow: scroll;
        }

        .itemDiv {
            width: 100%;
            height: 40px;
            line-height: 40px;
            display: flex;
            justify-content: space-between;
        }

        .imgDiv {
            margin-top: 50px;
            width: 100%;
            height: 50%;
        }

        .imgListDiv {
            width: 100%;
            height: 82px;
            display: flex;
            justify-content: flex-start;
        }

        .imgListDiv img {
            width: 82px;
            height: 82px;
            margin-right: 10px;
        }

        .getImgDiv {
            width: 100%;
            height: 203px;
            margin-top: 3%;
            background-color: white;
            border: 1px solid #707070;
            text-align: center;
            line-height: 203px;
            overflow: hidden;
            display: flex;
            flex-direction: column-reverse;
        }

        .fileArea {
            width: 100%;
            height: 203px;
        }

        .techAdd {
            height: 100%;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <script>
        let techs = [];
        let techIndex = 1;
        let isSubmit = false;
        let fileList = [];
        let fileInput =  document.getElementsByName('files');
        let fileCount = 1;

        function createTech() {
            let itemDiv = document.createElement('div');
            let noDiv = document.createElement('div');
            let titleDiv = document.createElement('div');
            let inputText = document.createElement("input");
            let listDiv = document.getElementsByClassName('listItemDiv')[0];

            itemDiv.setAttribute('class', 'itemDiv');
            
            inputText.onkeydown = (e) => {
                // 엔터를 입력 시
                if(e.keyCode == 13) {
                    e.preventDefault();
                    let httpReq = new XMLHttpRequest();
                    httpReq.open('GET', '/api/mystory/' + inputText.value);
                    httpReq.send()
                    httpReq.onreadystatechange = () => {
                        if(httpReq.status == 200) {
                            let response = httpReq.responseText;
                            let myStoryJson = JSON.parse(response);

                            titleDiv.innerText = myStoryJson.title;
                            noDiv.innerText = myStoryJson.id;
                            techs.push(myStoryJson.id);
                        }
                    };
                }
            }

            inputText.setAttribute('type', 'text');
            inputText.setAttribute('placeHolder', '글 id를 입력해주세요');

            titleDiv.appendChild(inputText)
            itemDiv.appendChild(noDiv);
            itemDiv.appendChild(titleDiv);

            listDiv.appendChild(itemDiv)
            techIndex++;
        }

        function techsToJson() {
            let techJson = document.getElementById('techJson');

            techJson.value = JSON.stringify(techs);
        }

        function addImage(obj) {
            let imgUrl = obj.value;
            let imgParent = document.getElementsByClassName('imgListDiv')[0];
            let imgObj = document.createElement('img');
            let fileArea = document.getElementsByClassName('getImgDiv')[0];

            imgObj.setAttribute('src', imgUrl);
            imgParent.appendChild(imgObj);

            let newFile = document.createElement('input');
            newFile.setAttribute('type', 'file');
            newFile.setAttribute('name', 'file' + fileCount++);
            newFile.setAttribute('class', 'fileArea');
            newFile.setAttribute('onchange', 'addImage(this)');

            obj.setAttribute('style', 'height: 0px');

            fileArea.appendChild(newFile);
        }

        function initFileInput() {
            for(let file of fileList) {
                fileInput.files.push(file);
            }
        }

        function write_click() {
            let formElement = document.getElementById("writeForm");
            let titleElement = document.getElementById("txtTitle");
            if (titleElement.value == ''){
                alert('입력되지 않은 칸이 있습니다');
                return;
            }

            techsToJson();

            formElement.submit();
        }

    </script>
    <div class="mainDiv">
        @yield("nav")
        <div class="contentDiv">
            <div class="subContentDiv">
                <div class="categoryDiv">
                    Project > 새 프로젝트
                </div>
                <form id="writeForm" method="POST" onsubmit="return false;" action="/index/project/write/process" enctype="multipart/form-data">
                    @csrf
                    <input id="txtTitle" name="txtTitle" class="txtTitle" type="text" placeholder="제목을 입력해주세요">
                    <div class="techDiv">
                        <div class="headerDiv">
                            <input name="techJson" id="techJson" type="hidden">
                            <div>사용기술</div>
                            <div class="techAdd" onclick="createTech();">@yield("techAddButton")</div>
                        </div>
                        <div class="listDiv">
                            <div class="listHeaderDiv">
                                <div>번호</div>
                                <div>제목</div>
                            </div>
                            <div class="listItemDiv">
                            </div>
                        </div>
                    </div>
                    <div class="imgDiv">
                        <div class="imgListDiv">
                        </div>
                        <div class="getImgDiv">
                            <input onchange="addImage(this);" class="fileArea" type="file" name="file0">
                        </div>
                    </div>

                    <hr>
                    <div class="FootDiv">
                        <button onclick="write_click();">글쓰기</button onclick="write_click">
                        <button>취소</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>