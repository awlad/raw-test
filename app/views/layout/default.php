<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Jaxara Project</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?php stylesheets('css'); ?>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="///home/hizbul/Development/Projects/PHP/no-framework">Jaxara Project</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="<?php (current_url() == '/') ? 'active' : '' ?>"><a href="/"> <i class="fa fa-home"></i> Home </a></li>
                <li class="<?php (current_url() == '/employee/add') ? 'active' : '' ?>"><a href="<?php generate_url('employee/add')?>"> Add Employee </a></li>
                <li class="<?php (current_url() == '/employee/list') ? 'active' : '' ?>"><a href="<?php generate_url('employee/list')?>">Employee List</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <?php
    if((getFlash())) {
        getMessage(getFlash(), 'success');
        setFlash('');
    }
    ?>
    <!-- Main component for a primary marketing message or call to action -->
    {{=yields=}}

</div> <!-- /container -->
<script src="../../../assets/js/jquery.js"></script>
<?php javaScripts('js') ?>
<style>
    body {
        padding-top: 70px;
    }
</style>
</body>
</html>
