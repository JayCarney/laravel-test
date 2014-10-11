<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Template</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
    <link href="/css/navbar_top.css" rel="stylesheet">
    <link href="/css/signin.css" rel="stylesheet">
    <link href="/css/summernote.css" rel="stylesheet">

    <link href="/css/main.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Laravel Test</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="/">Home</a></li>
                <li>{{ HTML::linkAction('ArticlesController@index', 'Articles') }}</li>
                <li>{{ HTML::linkAction('UsersController@index', 'Authors') }}</li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        @if(!Auth::check())
                        <li><a href="/login">Login</a></li>
                        <li><a href="/signup">Sign up</a></li>
                        @endif
                        @if(Auth::check())
                        <li>{{ HTML::linkRoute('articles.create', 'New Article') }}</li>
                        <li>{{ HTML::linkRoute('articles.author', 'View My Articles', array(Auth::user()->id)) }}</li>
                        <li class="divider"></li>
                        <li><a href="/logout">Logout</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container">

    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron @yield('class','')">
        @foreach($errors as $error)
            <div class="alert alert-danger"><p>{{ $error['message'] }}</p></div>
        @endforeach
        @if(Session::has('error'))
            {{ '<div class="alert alert-danger"><p>'.Session::get('error').'</p></div>'}}
        @endif
        {{ isset($error) ? '<div class="alert alert-danger"><p>'.$error.'</p></div>':'' }}
        @if(Session::has('warning'))
            {{ '<div class="alert alert-warning"><p>'.Session::get('warning').'</p></div>'}}
        @endif
        {{ isset($warning) ? '<div class="alert alert-warning"><p>'.$warning.'</p></div>':'' }}
        @if(Session::has('info'))
            {{ '<div class="alert alert-info"><p>'.Session::get('info').'</p></div>'}}
        @endif
        {{ isset($flash) ? '<div class="alert alert-info"><p>'.$flash.'</p></div>':'' }}
        @yield('content')
    </div>

</div> <!-- /container -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/js/bootstrap.min.js"></script>
<script src="/js/summernote.min.js"></script>
<script src="/js/main.js"></script>
</body>
</html>