<html>
<head>
<title>Preloader Demo</title>
<style type="text/css">
body {
    overflow: hidden;
}
/* preloader */
#preloader {
    position: fixed;
    top:0; left:0;
    right:0; bottom:0;
    background: #ccc;
    z-index: 100;
}
#loader {
    width: 100px;
    height: 100px;
    position: absolute;
    left:50%; top:50%;
    background: url('../images/preloader.gif') no-repeat center 0;
    margin:-50px 0 0 -50px;
}
</style>
</head>
<body>
<div id="preloader">
    <div id="loader"> PAGINA Prueba</div>
</div>
<div id="main">
   MAIN
<div>
<script src="jquery.js">
</script>
<script type="text/javascript">
$(window).load(function() {
    $('#preloader').fadeOut('slow');
    $('body').css({'overflow':'visible'});
})
</script>
</body>
</html>