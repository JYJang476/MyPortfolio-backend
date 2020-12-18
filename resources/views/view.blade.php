@include("layouts.master")

<!doctype html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>프로젝트 1</title>

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

        .optionDiv {
            width: 100%;
            height: 36px;
            margin-bottom: 10px;
        }

        .editButton {
            width: 54px;
            float: right;
        }

        .slideDiv {
            width: 100%;
            height: 540px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .leftArrowDiv, .rightArrowDiv {
            width: 64px;
            height: 540px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .leftArrow, .rightArrow {
            width: 100%;
            height: 43px;
        }

        .FootDiv {
            margin-top: 50px;
            width: 100%;
            height: 40px;
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        .numsDiv {
            margin-top: 3px;
            height: 34px;
            text-align: center;
            line-height: 34px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .numsDiv button {
            width: 34px;
            height: 34px;
            background-color: transparent;
            border: 1px solid #707070;
            border-radius: 17px;
        }

        .imgDiv img {
            width: 100%;
            height: 100%;
        }

    </style>
</head>
<body>
    <script>
        let board_id = {{ json_encode($b_id) }};
        let imgs_id = {{ json_encode($img_id) }};
        let thisIndex = 0;
        let imgBaseUrl = '/index/image/';

        window.onload = () => {
            changeSlide(0);
        }

        function nextSlide() {
            let imgObj = document.getElementById("slideImg");
            if(thisIndex < imgs_id.length){
                imgObj.setAttribute('src', imgBaseUrl + imgs_id[++thisIndex]);
            }
        }

        function backSlide() {
            let imgObj = document.getElementById("slideImg");
            if(imgs_id.length > thisIndex){
                imgObj.setAttribute('src', imgBaseUrl + imgs_id[--thisIndex]);
            }
        }

        function changeSlide(index) {
            let imgObj = document.getElementById("slideImg");
            let img_id = imgs_id[0] != 'undefined' ? imgs_id[index] : imgs_id;
            imgObj.setAttribute('src', imgBaseUrl + img_id);
            thisIndex = index;
        }
    </script>

    <div class="mainDiv">
        @yield("nav")
        <div class="contentDiv">
            <div class="subContentDiv">
                <div class="categoryDiv">
                    Project > {{ $title }}
                </div>
                <div class="realContentDiv">
                    <div class="optionDiv">
                        <svg class="editButton" xmlns="http://www.w3.org/2000/svg" width="40.5" height="35.993" viewBox="0 0 40.5 35.993">
                            <path id="Icon_awesome-edit" data-name="Icon awesome-edit" d="M28.308,5.85l6.342,6.342a.687.687,0,0,1,0,.97L19.294,28.519l-6.525.724a1.368,1.368,0,0,1-1.512-1.512l.724-6.525L27.337,5.85A.687.687,0,0,1,28.308,5.85ZM39.7,4.24,36.267.809a2.75,2.75,0,0,0-3.881,0L29.9,3.3a.687.687,0,0,0,0,.97l6.342,6.342a.687.687,0,0,0,.97,0L39.7,8.121a2.75,2.75,0,0,0,0-3.881ZM27,24.342V31.5H4.5V9H20.658a.865.865,0,0,0,.6-.246l2.813-2.812a.844.844,0,0,0-.6-1.441H3.375A3.376,3.376,0,0,0,0,7.875v24.75A3.376,3.376,0,0,0,3.375,36h24.75A3.376,3.376,0,0,0,31.5,32.625V21.53a.845.845,0,0,0-1.441-.6l-2.812,2.813A.865.865,0,0,0,27,24.342Z" transform="translate(0 -0.007)"/>
                        </svg>
                    </div>
                    <div class="slideDiv">
                        <div onclick="backSlide()" class="leftArrowDiv">@yield("leftArrow")</div>
                        <div class="imgDiv">
                            <img id="slideImg" src="" alt="">
                        </div>
                        <div onclick="nextSlide()" class="rightArrowDiv">@yield("rightArrow")</div>
                    </div>
                    <div class="FootDiv">
                        <div class="numsDiv">
                            @for($i = 0; $i < count($b_id); $i++)
                                <button onclick="changeSlide({{$i}})">
                                    {{ $i + 1 }}
                                </button>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
