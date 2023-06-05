<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/33770a1487.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style type="text/css">
        body {
            background-color: #f4f7f6;
            margin-top: auto;
            height: 100vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: #fff;
            transition: .5s;
            border: 0;
            margin-bottom: 30px;
            border-radius: .55rem;
            position: relative;
            width: 100%;
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
        }

        .chat-app .people-list {
            width: 280px;
            position: absolute;
            left: 0;
            top: 0;
            padding: 20px;
            z-index: 7
        }

        .chat-app .chat {
            margin-left: 280px;
            border-left: 1px solid #eaeaea
        }

        .people-list {
            -moz-transition: .5s;
            -o-transition: .5s;
            -webkit-transition: .5s;
            transition: .5s
        }

        .people-list .chat-list li {
            padding: 10px 15px;
            list-style: none;
            border-radius: 3px
        }

        .people-list .chat-list li:hover {
            background: #efefef;
            cursor: pointer
        }

        .people-list .chat-list li.active {
            background: #efefef
        }

        .people-list .chat-list li .name {
            font-size: 15px
        }

        .people-list .chat-list img {
            width: 45px;
            border-radius: 50%
        }

        .people-list img {
            float: left;
            border-radius: 50%
        }

        .people-list .about {
            float: left;
            padding-left: 8px
        }

        .people-list .status {
            color: #999;
            font-size: 13px
        }

        .chat .chat-header {
            padding: 15px 20px;
            border-bottom: 2px solid #f4f7f6
        }

        .chat .chat-header img {
            float: left;
            border-radius: 40px;
            width: 40px
        }

        .chat .chat-header .chat-about {
            float: left;
            padding-left: 10px
        }

        .chat .chat-history {
            padding: 20px;
            border-bottom: 2px solid #fff
        }

        .chat .chat-history ul {
            padding: 0
        }

        .chat .chat-history ul li {
            list-style: none;
            margin-bottom: 30px
        }

        .chat .chat-history ul li:last-child {
            margin-bottom: 0px
        }

        .chat .chat-history .message-data {
            margin-bottom: 15px
        }

        .chat .chat-history .message-data img {
            border-radius: 40px;
            width: 40px
        }

        .chat .chat-history .message-data-time {
            color: #434651;
            padding-left: 6px
        }

        .chat .chat-history .message {
            color: #444;
            padding: 18px 20px;
            line-height: 26px;
            font-size: 16px;
            border-radius: 7px;
            display: inline-block;
            position: relative
        }

        .chat .chat-history .message:after {
            bottom: 100%;
            left: 7%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-bottom-color: #fff;
            border-width: 10px;
            margin-left: -10px
        }

        .chat .chat-history .my-message {
            background: #efefef
        }

        .chat .chat-history .my-message:after {
            bottom: 100%;
            left: 30px;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-bottom-color: #efefef;
            border-width: 10px;
            margin-left: -10px
        }

        .chat .chat-history .other-message {
            background: #e8f1f3;
            text-align: right
        }

        .chat .chat-history .other-message:after {
            border-bottom-color: #e8f1f3;
            left: 93%
        }

        .chat .chat-message {
            padding: 20px
        }

        .chat-message .input-group {
            flex-direction: row-reverse;
            gap: 10px;
        }

        .chat-message .input-group .Message_input {
            border-top-left-radius: 5px !important;
            border-bottom-left-radius: 5px !important;
        }

        .online,
        .offline,
        .me {
            margin-right: 2px;
            font-size: 8px;
            vertical-align: middle
        }

        .online {
            color: #86c541
        }

        .offline {
            color: #e47297
        }

        .me {
            color: #1d8ecd
        }

        .float-right {
            float: right
        }

        .clearfix:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0
        }

        .current_user {
            position: fixed;
            top: 5%;
            right: 3%;
            cursor: pointer;
        }

        .current_user .row_item .user-data {
            background: gainsboro;
            border-radius: 50%;
            padding: 6px;
        }

        .current_user .row_item .user-data img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

        .active_current_user {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: limegreen;
            position: absolute;
            bottom: 1px;
        }

        .avtarImage{
            cursor: pointer;
            width: 80px;
            height: 80px;
        }

        @media only screen and (max-width: 767px) {
            .chat-app .people-list {
                height: 465px;
                width: 100%;
                overflow-x: auto;
                background: #fff;
                left: -400px;
                display: none
            }

            .chat-app .people-list.open {
                left: 0
            }

            .chat-app .chat {
                margin: 0
            }

            .chat-app .chat .chat-header {
                border-radius: 0.55rem 0.55rem 0 0
            }

            .chat-app .chat-history {
                height: 300px;
                overflow-x: auto
            }
        }

        @media only screen and (min-width: 768px) and (max-width: 992px) {
            .chat-app .chat-list {
                height: 650px;
                overflow-x: auto
            }

            .chat-app .chat-history {
                height: 600px;
                overflow-x: auto
            }
        }

        @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
            .chat-app .chat-list {
                height: 480px;
                overflow-x: auto
            }

            .chat-app .chat-history {
                height: calc(100vh - 350px);
                overflow-x: auto
            }
        }

        @media only screen and (max-width: 1024px) {
            body {
                background-color: #f4f7f6;
                margin-top: auto;
                height: 100vh;
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 80px;
                flex-direction: column-reverse;
            }

            .current_user {
                position: relative;
                top: 5%;
                right: 3%;
            }
        }
    </style>
</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />


    <div class="container">
        @csrf
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card chat-app">
                    <div id="plist" class="people-list">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="height: 100%;"><i class="fa fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                        <ul class="list-unstyled chat-list mt-2 mb-0">

                            <div class="overflow-auto usersList" style="height: 570px">

                                <li class="clearfix active">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                                    <div class="about">
                                        <div class="name">Vincent Porter</div>
                                        <div class="status"> <i class="fa fa-circle offline"></i> left 7 mins ago </div>
                                    </div>
                                </li>


                            </div>
                        </ul>
                    </div>

                    <div class="chat">

                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                    </a>
                                    <div class="chat-about">
                                        <h6 class="m-b-0">Aiden Chavez</h6>
                                        <small>Last seen: 2 hours ago</small>
                                    </div>
                                </div>
                                <div class="col-lg-6 hidden-sm text-end">
                                    <a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="fa fa-camera"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-info"><i class="fa fa-cogs"></i></a>
                                </div>
                            </div>
                        </div>


                        <div class="overflow-auto" style="height: 500px">
                            <div class="chat-history">
                                <ul class="m-b-0">

                                    <!-- Outgoing Message Here... -->

                                    <li class="clearfix">
                                        <div class="message-data text-end">
                                            <span class="message-data-time">10:10 AM, Today</span>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                        </div>
                                        <div class="message other-message float-right"> Hi Aiden, how are you? How is the project coming along? </div>
                                    </li>


                                    <!-- Incoming Message Here... -->

                                    <li class="clearfix">
                                        <div class="message-data">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                            <span class="message-data-time">10:12 AM, Today</span>
                                        </div>
                                        <div class="message my-message">Are we meeting today?</div>
                                    </li>

                                </ul>
                            </div>
                        </div>


                        <div class="chat-message clearfix">
                            <div class="input-group mb-0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="height: 100% !important;"><i class="fa fa-send"></i></span>
                                </div>
                                <input type="text" class="form-control Message_input" placeholder="Enter text here...">
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>


    <div class="current_user" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <div class="row_item">
            <div class="user-data">
                @if(Auth::user()->image != "")
                <img src="{{url('images')}}/<?= Auth::user()->image ?>" alt="avatar">
                @else
                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                @endif
                <div class="active_current_user"></div>
            </div>
        </div>
    </div>

    <!--User Profile Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profile Setting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="text-center m-2">
                            @if(Auth::user()->image != "")
                                <img src="{{url('images')}}/<?= Auth::user()->image ?>" alt="avatar" class="rounded rounded-circle avtarImage">
                            @else
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar" class="rounded rounded-circle avtarImage">
                            @endif
                        </div>
                        <input type="file" name="image" id="image" class="image" hidden>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" value="{{ Auth::user()->name }}" />
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="exampleInputEmail1" value="{{ Auth::user()->email }}" placeholder="Email" aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Old Password</label>
                            <input type="password" class="form-control" name="old_password" placeholder="Old Password" />
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">New Password</label>
                            <input type="password" class="form-control" placeholder="New Password" name="new_password" />
                        </div>
                        <button type="submit" class="btn btn-primary form-control update">Submit</button>
                    </form>
                </div>
                <div class="modal-footer d-flex" style="justify-content: space-between;">
                    <button type="button" class="btn btn-danger logOut form-control"><i class="fa-solid fa-right-from-bracket"></i></button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript">

    </script>
</body>

</html>
<script type="module">
    import {
        authentication
    } from "./assets/js/authentication.js";
    let auth = new authentication();
    let avtarImage = document.querySelector(".avtarImage");
    let image = document.querySelector(".image");

    avtarImage.addEventListener("click",(e)=>{image.click()});

    image.addEventListener("change",(e)=>{
        let img = image.files[0];
        let setImage = URL.createObjectURL(img);
        avtarImage.src=setImage;
    });

    let logOut = document.querySelector(".logOut");

    logOut.addEventListener("click", (e) => {
        auth.logOut();
    });

     auth.loadUsers();
</script>