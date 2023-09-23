@props([
    'branch' , 'branchId'
    ])


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <style>
        @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
        @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700');
        @import url('https://fonts.googleapis.com/css?family=Libre+Baskerville:400,700');

        body {
            font-family: 'Open Sans', sans-serif;
        }

        *:hover {
            -webkit-transition: all 1s ease;
            transition: all 1s ease;
        }

        section {
            float: left;
            width: 100%;
            background: #fff;
            padding: 30px 0;
        }

        h1 {
            float: left;
            width: 100%;
            color: #232323;
            margin-bottom: 30px;
            font-size: 14px;
        }

        h1 span {
            font-family: 'Libre Baskerville', serif;
            display: block;
            font-size: 45px;
            text-transform: none;
            margin-bottom: 20px;
            margin-top: 30px;
            font-weight: 700
        }

        h1 a {
            color: #131313;
            font-weight: bold;
        }


        .card {
            font-family: 'Open Sans', Arial, sans-serif;
            position: relative;
            float: left;
            overflow: hidden;
            width: 100%;
            text-align: center;
            height: 368px;
            border: 1px solid #eee;
            box-shadow: 4px 4px 4px #eee;
            padding-bottom: 10px;
        }

        .card .background-block {
            float: left;
            width: 100%;
            height: 300px;
            overflow: hidden;
        }

        .card .background-block .background {
            width: 100%;
            vertical-align: top;
            opacity: 0.9;
            -webkit-filter: blur(0.3px);
            filter: blur(0.3px);
            -webkit-transform: scale(1.8);
            transform: scale(1.8);
        }

        .card .card-content {
            width: 100%;
            padding: 15px 25px;
            color: #232323;
            float: left;
            background: #fff;
            height: 50%;
            border-radius: 0 0 5px 5px;
            position: relative;
            z-index: 9999;
        }

        .card .card-content::before {
            content: '';
            background: #fff;
            width: 120%;
            height: 100%;
            left: 11px;
            bottom: 51px;
            position: absolute;
            z-index: -1;
            transform: rotate(-13deg);
        }

        .card .button {
            border-radius: 15px;
            padding: 10px 20px;
            background: #5aafccf1;
            font-weight: bold;
            color: #fff;
            border: none;
            position: absolute;
            bottom: 45%;
            left: 50%;
            max-width: 50%;
            opacity: 1;
            /* box-shadow: 3px 3px 20px rgba(0, 0, 0, 0.5); */
            -webkit-transform: translate(-50%, 0%);
            transform: translate(-50%, 0%);
            z-index: 99999;
        }

        .card h2 {
            margin: 0 0 5px;
            font-weight: 600;
            font-size: 25px;
        }


        .card i {
            display: inline-block;
            font-size: 16px;
            color: #232323;
            text-align: center;
            border: 1px solid #232323;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 50%;
            margin: 0 5px;
        }

        .card .icon-block {
            float: left;
            width: 100%;
            margin-top: 15px;
        }

        .card .icon-block a {
            text-decoration: none;
        }

        .card i:hover {
            background-color: #232323;
            color: #fff;
            text-decoration: none;
        }
    </style>


</head>

<body>
    <div class="col-md-4">
        <div class="card">
            <div class="background-block">
                <img src="{{ asset('assets/img/gsg2.jpg')}}" alt="" class="background" />
            </div>
            <div class="btn">
                <a href="{{ route('branch.space.index' , $branchId)}}" class="button">show spaces</a>
            </div>
            <div class="card-content">
                <h2>{{$branch}}</h3>
                    <div class="icon-block"><a href="#"><i class="fa fa-pencil"></i></a><a href="#"> <i class="fa fa-trash"></i></a></div>
            </div>
        </div>
    </div>
</body>

</html>