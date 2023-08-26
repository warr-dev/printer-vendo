<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PrintVendo</title>

    <!-- Favicons -->
    <link href="/img/favicon.png" rel="icon">
    <link href="/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Bootstrap core CSS -->
    <link href="/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--external css-->
    <link href="/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="/lib/dropzone/css/dropzone.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/toastr.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom styles for this template -->
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }

        #showtime {
            font-size: 3rem;
            margin: 0;
        }

        .bg {
            /* The image used */
            background-image: url("/img/bg.jpg");
            /* zoom: 1;
 filter: alpha(opacity=50);
 opacity: 0.5; */
            filter: brightness(.4);

            /* Full height */
            height: 100%;
            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .content {
            position: absolute;
            top: 0px;
            color: white;
            height: 100vh;
            width: 100vw;
            text-align: center;
        }

        .left {
            text-align: left
        }

        .right {
            text-align: right;
            min-width: 5rem
        }

        div.scrollmenu {
            overflow: auto;
            white-space: nowrap;
        }

        div.scrollitem {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 14px;
            text-decoration: none;
        }

        .action {
            display: flex;
            justify-content: center;
        }

        .action>div {
            padding: 0 1rem;
        }

        .pic {
            width: 50%;
        }

        h2 {
            color: #4db1bc;
            font-weight: bolder;
            margin: 0;
            grid-column: 1;
            grid-row: 1;
            z-index: 1;
            text-transform: uppercase;
            animation: glow 1s ease-in-out infinite alternate;
            text-align: center;
        }

        td[colspan="2"] {
            text-align: center
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 20px #2d9da9;
            }

            to {
                text-shadow: 0 0 30px #34b3c1, 0 0 10px #4dbbc7;
            }
        }

        .cont {
            padding: 1rem;
        }

        .credits {
            color: black;
        }

        .slider-wrapper {
            margin: 1rem;
            position: relative;
            overflow: hidden;
        }

        .slides-container {
            width: 80%;
            display: flex;
            overflow: hidden;
            scroll-behavior: smooth;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .slide-arrow {
            position: absolute;
            display: flex;
            top: 0;
            bottom: 0;
            margin: auto;
            height: 4rem;
            background-color: white;
            border: none;
            width: 2rem;
            font-size: 3rem;
            padding: 0;
            cursor: pointer;
            opacity: 0.5;
            transition: opacity 100ms;
        }

        .slide-arrow:hover,
        .slide-arrow:focus {
            opacity: 1;
        }

        #slide-arrow-prev {
            left: 0;
            padding-left: 0.25rem;
            border-radius: 0 2rem 2rem 0;
        }

        #slide-arrow-next {
            right: 0;
            padding-left: 0.75rem;
            border-radius: 2rem 0 0 2rem;
        }

        .slide {
            width: 100%;
            height: 100%;
            flex: 1 0 100%;
        }

        .pages-container {
            padding: 1rem
        }

        :root {
            --border-width: 7px;
        }


        .sec-loading {
            height: 100vh;
            width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sec-loading .one {
            height: 80px;
            width: 80px;
            border: var(--border-width) solid white;
            transform: rotate(45deg);
            border-radius: 0 50% 50% 50%;
            position: relative;
            animation: move 0.5s linear infinite alternate-reverse;
        }

        .sec-loading .one::before {
            content: "";
            position: absolute;
            height: 55%;
            width: 55%;
            border-radius: 50%;
            border: var(--border-width) solid transparent;
            border-top-color: white;
            border-bottom-color: white;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: rotate 1s linear infinite;
        }

        @keyframes rotate {
            to {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        @keyframes move {
            to {
                transform: translateY(15px) rotate(45deg);
            }
        }
    </style>
    @stack('head')
</head>