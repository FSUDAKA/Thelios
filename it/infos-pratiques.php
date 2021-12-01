<?php include 'connect_infos_pratiques.php';

require_once './class/User.php';

$usr = new User();

$data = $usr->findOneById($_SESSION['id']);
if($dataGeneral["OPT_INFOSPRATIQUES"] != 1){header("Location: accueil.php$eventurl");}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Infos pratiques - <?php echo $dataGeneral['NOM']; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/flipclock.css">
		<link rel="icon" href="images/favicon.ico" type="image/png">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet"> 
	</head>
	<body>

		<!-- Header -->
			<header id="header">
                <div id="nav1"><div class="inner"><?php include 'menu1.php'; ?></div></div>
				<div class="inner">
					<a href="index.php" class="logo"><img src="images/logo.png"></a>
					<nav id="nav">
                        <?php include 'menu.php'; ?>
					</nav>
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
				</div>
			</header>

		<!-- Banner -->
			<section id="banner" style="background: url(images/<?php echo $event."/".$dataEvt['PIC_INFOS']; ?>); background-size: cover; background-position: center; background-repeat: no-repeat;">
				<div class="inner">
					<header>
						<h1>Infos pratiques</h1><br>
						<!--<h3 style="text-shadow: 0 0 10px black;"><?php //echo $dataEvt['TXT_INFOS_ST']; ?></h3>-->
					</header>
				</div>
			</section>


		<!-- Three -->
			<section id="one" class="wrapper lignes">
                <div class="inner">
					<div class="row uniform">
                        
                        
                        <?php for ($i = 1; $i <= 6; $i++) {
                        $ICO_INFOS_P = "ICO_INFOS_P".$i;
                        $TXT_INFOS_P_TITRE = "TXT_INFOS_P".$i."_TITRE";
                        $TXT_INFOS_P = "TXT_INFOS_P".$i;
                        ?>
                        
                        <?php if($dataEvt['NB_INFOS'] >= $i){ ?>
                        <div class="6u 12u$(small)">
	                            <?php if(($dataEvt[$ICO_INFOS_P] != "") && ($dataEvt[$TXT_INFOS_P_TITRE] != "")){ ?><h2 id="content"><?php if($dataEvt[$ICO_INFOS_P] != ""){ ?><i class="fa fa-<?php echo $dataEvt[$ICO_INFOS_P]; ?>" aria-hidden="true"></i><?php } ?> <?php if($dataEvt[$TXT_INFOS_P_TITRE] != ""){ ?><span style="color: #555;"><?php echo $dataEvt[$TXT_INFOS_P_TITRE]; ?></span><?php } ?></h2><?php } ?>
	                            <?php if($dataEvt[$TXT_INFOS_P] != ""){ ?><p><?php echo $dataEvt[$TXT_INFOS_P]; ?></p><?php } ?>
	                        
					    </div>
                        <?php if($i % 2 == 0){echo '<div class="12u$" style="padding:0;"></div>';} ?>
                        <?php } ?>
                        
                        <?php } ?>
                        <img class="fit-picture">
     
     					                    
                        
				    </div>
                </div>
                            </section>

		<!-- Footer -->
        
        
        <section id="ten" class="wrapper align-center bloclock">
         
        
				<div class="inner">

					<h3></h3>
                    <h2 id="content" style="">Compte à rebours</h2>


					<div class="clock"></div>

				</div>
            
        </section>
			<?php include 'footer.php'; ?>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="assets/js/flipclock.min.js"></script>
			<script type="text/javascript">
				var clock;

				$(document).ready(function() {
					
					// Grab the current date
					var currentDate = new Date();
        var futureDate  = new Date(2021,08,3);
                    // Set some date in the future. In this case, it's always Jan 1	var futureDate  = new Date(2019,12,17);

					// Calculate the difference in seconds between the future and current date
					var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;
                    if (diff == 0 | diff < 0) {
                        diff = 0;
                    }

					// Instantiate a coutdown FlipClock
					clock = $('.clock').FlipClock(diff, {
						clockFace: 'DailyCounter',
						countdown: true
					});
				});
			</script>

	</body>
</html>
