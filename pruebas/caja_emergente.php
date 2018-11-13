<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>CSS Lightbox</title>
<?php session_start(); ?>
<style type="text/css">
div.lightbox {
	display: none;
	position: fixed;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
}

div.lightbox:target {
	display: table;
}

div.lightbox figure {
	display: table-cell;
	margin: 0;
	padding: 0;
	width: 100%;
	height: 100%;
	vertical-align: middle;
}

div.lightbox figure figcaption {
	display: block;
	margin: auto;
	padding: 8px;
	background-color: #ddbbff;
	height: 250px;
	position: relative;
	overflow: auto;
	border: 1px #000000 solid;
	border-radius: 10px;
	text-align: justify;
	font-size: 14px;
}

div.lightbox figure .closemsg {
	display: block;
	margin: auto;
	height: 0;
	overflow: visible;
	text-align: right;
	z-index: 5001;
	cursor: default;
}

div.lightbox figure .closemsg, div.lightbox figure figcaption {
	width: 300px;
}

.closemsg::after {
	content: "\00D7";
	display: inline-block;
	position: relative;
	right: -20px;
	top: -10px;
	z-index: 5002;
	color: #ffffff;
	border: 1px #ffffff solid;
	border-radius: 10px;
	width: 20px;
	height: 20px;
	line-height: 18px;
	text-align: center;
	margin: 0;
	background-color: #000000;
	font-weight: bold;
	cursor: pointer;
}

.closemsg::before {
	content: "";
	display: block;
	position: fixed;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	background-color: #000000;
	opacity: 0.65;
}
</style>
</head>

<body>

<h1>Pure CSS Lightbox</h1>

<p>Some sample text&hellip;</p>

<p>[ <a href="#example1">Open example #1</a> | <a href="#example2">Open example #2</a> ]</p>

<p>Another sample text&hellip;</p>

<div class="lightbox" id="example1">
	<figure>
		<a href="#" class="closemsg"></a>
		<figcaption>Elija un laboratorio.</br> <?php require_once('../inc/menu_usr.inc.php');?></figcaption>
	</figure>
</div>

<div class="lightbox" id="example2">
	<figure>
		<a href="#" class="closemsg"></a>
		<figcaption>Cras risus odio, pharetra nec ultricies et, mollis ac augue. Nunc et diam quis sapien dignissim auctor. Quisque quis neque arcu, nec gravida magna. Etiam ullamcorper augue quis orci posuere et tincidunt augue semper. Maecenas varius augue eu orci auctor bibendum tristique ligula egestas. Morbi pharetra tortor iaculis erat porta id aliquam leo cursus. Ut nec elit vel mauris dapibus lacinia eget sed odio.</figcaption>
	</figure>
</div>

</body>

</html>
