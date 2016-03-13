<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>CS 340 - Final</title>

    <link rel="stylesheet" href="/~siddonj/cs340/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <!-- My custom CSS -->
    <link rel="stylesheet" href="/~siddonj/cs340/css/custom.css">
    <!-- include jQuery -->
    <script src="/~siddonj/cs340/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/~siddonj/cs340/views/card/index.php">MTG Collection Manager</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Insert <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/~siddonj/cs340/views/card/insert.php">Card</a></li>
                <li><a href="/~siddonj/cs340/views/deck/insert.php">Deck</a></li>
                <li><a href="/~siddonj/cs340/views/color/insert.php">Color</a></li>
                <li><a href="/~siddonj/cs340/views/type/insert.php">Type</a></li>
                <li><a href="/~siddonj/cs340/views/owner/insert.php">Owner</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">View <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/~siddonj/cs340/views/card/index.php">Card</a></li>
                <li><a href="/~siddonj/cs340/views/deck/index.php">Deck</a></li>
                <li><a href="/~siddonj/cs340/views/color/index.php">Color</a></li>
                <li><a href="/~siddonj/cs340/views/type/index.php">Type</a></li>
                <li><a href="/~siddonj/cs340/views/owner/index.php">Owner</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      <!-- Error alert boxes. -->
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
