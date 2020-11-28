<style>
    * {
        text-decoration: none;
        color: black;
    }

    .mainDiv {
        width: 60%;
        height: 100%;
        margin: auto;
        background-color: #F9F9F9;
        border: 1px solid #707070;
    }

    .html {
        width: 100%;
        height: 100%;
    }

    .navDiv {
        width: 95%;
        height: 60px;
        margin-top: 5px;
        margin-left: 2.5%;
        border-bottom: 1px solid black;
        display: flex;
        justify-content: space-between;
        line-height: 50px;
    }

    .leftDiv {
        width: 50px;
        margin-left: 5px;

    }

    .rightDiv {
        width: 250px;
        display: flex;
        justify-content: space-around;
    }

    .menuDiv {
        width: 180px;
        display: flex;
        justify-content: space-around;
    }

    .loginDiv {
        width: 50px;
        height: 50px;
        border: 1px solid black;
        border-radius: 25px;
        text-align: center;
    }

    .contentDiv {
        width: 100%;
        height: 90%;
    }

    .subContentDiv {
        width: 96%;
        height: 100%;
        margin-left: 2%;
    }

    .categoryDiv {
        width: 100%;
        height: 50px;
    }

    button, input[type="submit"] {
        width: 100px;
        height: 30px;
        background-color: white;
        border: 1px solid #707070;

    }


</style>

@section("nav")
    <div class="navDiv">
        <a href="/index/">
            <div class="leftDiv">
                Home
            </div>
        </a>

        <div class="rightDiv">
            <div class="menuDiv">
                <a href="/index/about"><div class="menu">About</div></a>
                <a href="/index/project"><div class="menu">Project</div></a>
                <a href="/index/mystory"><div class="menu">My Story</div></a>
            </div>
            <a href="/index/login">
                <div class="loginDiv">
                    로그인
                </div>
            </a>
        </div>
    </div>
@endsection

@section("leftArrow")
    <svg class="leftArrow" xmlns="http://www.w3.org/2000/svg" width="43" height="64" viewBox="0 0 43 64">
        <g id="다각형_4" data-name="다각형 4" transform="translate(0 64) rotate(-90)" fill="#fff">
            <path d="M 63.004638671875 42.5 L 0.9953581094741821 42.5 L 31.99999809265137 0.8375149965286255 L 63.004638671875 42.5 Z" stroke="none"/>
            <path d="M 31.99999809265137 1.675006866455078 L 1.990699768066406 42 L 62.00929641723633 42 L 31.99999809265137 1.675006866455078 M 31.99999809265137 0 L 64 43 L -3.814697265625e-06 43 L 31.99999809265137 0 Z" stroke="none" fill="#707070"/>
        </g>
    </svg>
@endsection

@section("rightArrow")
    <svg class="rightArrow"  xmlns="http://www.w3.org/2000/svg" width="40" height="60" viewBox="0 0 40 60">
        <g id="다각형_3" data-name="다각형 3" transform="translate(40) rotate(90)" fill="#fff">
            <path d="M 59 39.5 L 1.000001907348633 39.5 L 30.00000190734863 0.8333333134651184 L 59 39.5 Z" stroke="none"/>
            <path d="M 30.00000190734863 1.666667938232422 L 2.000003814697266 39 L 58 39 L 30.00000190734863 1.666667938232422 M 30.00000190734863 0 L 60 40 L 3.814697265625e-06 40 L 30.00000190734863 0 Z" stroke="none" fill="#707070"/>
        </g>
    </svg>
@endsection

@section("techAddButton")
    <svg id="addTech" class="addTech" xmlns="http://www.w3.org/2000/svg" width="18.65" height="18.65" viewBox="0 0 18.65 18.65">
        <path id="Icon_awesome-plus-circle" data-name="Icon awesome-plus-circle" d="M9.887.563a9.325,9.325,0,1,0,9.325,9.325A9.323,9.323,0,0,0,9.887.563ZM15.3,10.94a.453.453,0,0,1-.451.451H11.391v3.459a.453.453,0,0,1-.451.451H8.835a.453.453,0,0,1-.451-.451V11.391H4.924a.453.453,0,0,1-.451-.451V8.835a.453.453,0,0,1,.451-.451H8.383V4.924a.453.453,0,0,1,.451-.451H10.94a.453.453,0,0,1,.451.451V8.383h3.459a.453.453,0,0,1,.451.451Z" transform="translate(-0.563 -0.563)"/>
    </svg>
@endsection