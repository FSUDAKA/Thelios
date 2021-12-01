<?php include 'connect_actu.php';

require_once './class/User.php';

$usr = new User();

$data = $usr->findOneById($_SESSION['id']);

$NB_ACTUS = $dataEvt['NB_ACTUS'];

if($dataGeneral["OPT_ACTUALITES"] != 1){header("Location: accueil.php$eventurl");}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Accueil - <?php echo $dataGeneral['NOM']; ?> - Rencontres Fondation MAIF</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/flipclock.css">
		<link rel="icon" href="images/favicon.ico" type="image/png"›
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
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
			<section id="banner" style="background: url(images/<?php echo $event."/".$dataEvt['PIC_ACTUALITE']; ?>); background-size: cover; background-position: center; background-repeat: no-repeat;">
				<div class="inner">
					<header>
						<h1>Actualités</h1>
						<h3 style="text-shadow: 0 0 10px black;"><?php echo $dataEvt['TXT_ACTUALITE']; ?></h3>
					</header>
				</div>
			</section>

		<!-- Three -->
			<section id="one" class="wrapper align-center">
				<div class="inner">
                    
					<div class="row uniform">
						
				

                    <?php for ($i = 1; $i <= $NB_ACTUS; $i++) {
                   
                         $PIC = "PIC_".$i;
                         $TITRE = "TITRE_".$i;
                         $TXT = "TXT_".$i;
                     ?>
                        
                        <?php if($NB_ACTUS >= $i){ ?>
                        <div class="4u 12u$(small)">
                            <div class="row uniform">
                                <?php if($dataEvt[$PIC] != ""){ ?>
                                <div class="12u$ 12u$(small)" style="padding-top: 0;">
                                    <a data-fancybox="gallery" href="images/<?php echo $event."/".$dataEvt[$PIC]; ?>"><div style="width:100%; height:250px; background-size: cover; background-position: center; background-image:url(images/<?php echo $event."/".$dataEvt[$PIC]; ?>);"></div></a>
                                </div>
                                <?php } if(($dataEvt[$TITRE] != "") || ($dataEvt[$TXT] != "")){ ?>
                                <div class="12u$ 12u$(small)" style="text-align:justify; line-height: 22px; padding-top: 10px;">
                                    <?php if($dataEvt[$TITRE] != ""){ ?><h2 id="content" style="margin-bottom: 10px; text-align:left;"><?php echo $dataEvt[$TITRE]; ?></h2><?php } ?>
                                    <?php if($dataEvt[$TXT] != ""){ ?><?php echo $dataEvt[$TXT]; ?><?php } ?>
                                </div>
                                <?php } ?>
                            </div>
					    </div>
                        <?php if($i % 3 == 0){echo '<div class="12u$" style="padding:0;"></div>';} ?>
                        <?php } ?>
                        
                     <?php } ?>

						</div>
				</div>
			</section>

		<!-- Footer -->
        
        
        <section id="ten" class="wrapper align-center bloclock" style="">
         
        
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

						var futureDate  = new Date(2019,11,16);
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
