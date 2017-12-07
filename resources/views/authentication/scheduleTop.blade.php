<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
        <!--<script src="js/jquery.js"></script>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
   
        <!-- jQuery Notify -->
        <script type="text/javascript" src="js/notify.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
        
        <title>Demo</title>
        
        <style>


        .sidebar-nav {
            padding: 9px 0;
        }

        .dropdown-menu .sub-menu {
            left: 100%;
            position: absolute;
            top: 0;
            visibility: hidden;
            margin-top: -1px;
        }

        .dropdown-menu li:hover .sub-menu {
            visibility: visible;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .nav-tabs .dropdown-menu, .nav-pills .dropdown-menu, .navbar .dropdown-menu {
            margin-top: 0;
        }

        .navbar .sub-menu:before {
            border-bottom: 7px solid transparent;
            border-left: none;
            border-right: 7px solid rgba(0, 0, 0, 0.2);
            border-top: 7px solid transparent;
            left: -7px;
            top: 10px;
        }
        .navbar .sub-menu:after {
            border-top: 6px solid transparent;
            border-left: none;
            border-right: 6px solid #fff;
            border-bottom: 6px solid transparent;
            left: 10px;
            top: 11px;
            left: -6px;
        }
        </style>
        
    </head>
    <body>
        <nav class="main-navigation navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                @if(\Auth::user()->id)
                    <ul class="nav navbar-nav">
                        <form class="navbar-form navbar-left">
                            <h5>Hello {{ \Auth::user()->email }}</h5>
                        </form>
                        <li class="{{ Request::is('homePage') ? 'active' : '' }}" id="home"><a href="homePage">Home</a></li>
                        <li class="{{ Request::is('profilePage') ? 'active' : '' }}" id="profile"><a href="profilePage">Profile</a></li>
                        <li class="{{ Request::is('postPage') ? 'active' : '' }}" id="post"><a href="postPage">Post</a></li>
                        <li class="{{ Request::is('commentPage') ? 'active' : '' }}" id="comment"><a href="commentPage">Comment</a></li>
                        <li class="{{ Request::is('allCommentsPosts') ? 'active' : '' }}" id="allCommentsPosts"><a href="allCommentsPosts">All Comments Posts</a></li>
         
                    </ul>
                @endif
                
                <ul class="nav navbar-nav navbar-right">
                    <form class="navbar-form navbar-left">
                        <div class="form-group">
                            <div class="user-option">
                                @yield('user-option')
                            </div>
                        </div>
                        
                    <a href="{{ URL::to('logout') }}" class="btn btn-info sm">Logout</a>
                    </form>
                    
                </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        @if(\Auth::user())
            <div class="home-page">
                @yield('home-page')
            </div>
            <div class="profile-page">
                @yield('profile-page')
            </div>
            <div class="post-page">
                @yield('post-page')
            </div>
            <div class="comment-page">
                @yield('comment-page')
            </div>
            <div class="comments-posts-page">
                @yield('comments-posts-page')
            </div>
        @endif
    </body>
    <script>
        
        
    </script>
</html>
