<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title></title>
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<script type="text/javascript">
document.addEventListener('gesturestart', function (e) {
    e.preventDefault();
});
var lastTouchEnd = 0;
document.documentElement.addEventListener('touchend', function (event) {
  var now = (new Date()).getTime();
  if (now - lastTouchEnd <= 300) {
    event.preventDefault();
  }
  lastTouchEnd = now;
}, false);
</script> 
</head>	

<body>
<div id="global">
	<header>
		{% block header %}
		{% endblock %}
            <div style="float:left; min-width: 300px;height:100%;">
                {% block arianne %}
                {% endblock %}
			    <p id="copyright">ArepDbAdministrator Version : bêta 0.1.0<br>Compatiblité : 3.5.8.2 PhpMyAdmin / 5.1.73 MySQL</p>
            </div>
            <a href="../disconnect.php">Déconnexion</a>
	</header>
	
	<div id="content">
		{% block content %}
		
		{% endblock %}
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="../js/script.js"></script>
</body>
</html> 