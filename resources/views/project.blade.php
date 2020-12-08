@include("layouts.master")

<!doctype html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>내 프로젝트</title>

    <style>
        * {
            color: #707070
        }

        .realContentDiv {
            width: 95%;
            height: calc(100% - 60px);
            margin-left: 2.5%;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

        .titleDiv {
            width: 100%;
            height: 40px;
            line-height: 40px;
        }

        .projectDiv {
            width: 100%;
            height: 80%;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            overflow: auto;
        }

        img {
            width: 254px;
            height: 254px;
        }

        .imgDiv {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        .itemDiv {
            width: 33%;
            height: 254px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .projTitleDiv {
            width: 100%;
            height: 40px;
            text-align: center;
            line-height: 40px;
        }

        .FootDiv {
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
        }

        .pageDiv {
            width: 100px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin: auto;
        }

    </style>

        </head>
<body>
    <script>
        function goProject(id) {
            location.href = '/index/project/' + id;
        }
    </script>
    <div class="mainDiv">
        @yield("nav")
        <div class="contentDiv">
            <div class="subContentDiv">
                <div class="categoryDiv">
                    Project
                </div>
                <div class="realContentDiv">
                    <div class="titleDiv">내 프로젝트</div>
                    <div class="projectDiv">
                        @foreach($project as $proj)
                            <div class="itemDiv" onclick="goProject({{$proj->id}})">
                                <div class="imgDiv">
                                    <img src="/index/image/{{$proj->img_id}}" alt="">
                                </div>
                                <div class="projTitleDiv">{{$proj->project_name}}</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="pageDiv">
                        @for($i = 1; $i <= $project->lastPage(); $i++)
                            <a href="{{$project->url($i)}}"><div>{{$i}}</div></a>
                        @endfor
                    </div>
                    <div class="FootDiv">
                        <a href="/index/project/write">
                            <button>추가</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>