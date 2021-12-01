<?php include 'connect_programme.php';

require_once './class/User.php';

$usr = new User();

$data = $usr->findOneById($_SESSION['id']);

if($dataGeneral["OPT_PROGRAMME"] != 1){header("Location: accueil.php$eventurl");}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Programme - <?php echo $dataGeneral['NOM']; ?></title>
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
					<a href="index.php" class="logo"><img src="images/logo-white.png"></a>
					<nav id="nav">
                        <?php include 'menu.php'; ?>
					</nav>
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
				</div>
			</header>

		<!-- Banner -->
			<section id="banner" style="background: url(images/jardin-cercle-aumale.jpeg); background-size: cover; background-position: center; background-repeat: no-repeat;">
				<div class="inner">
					<header>
						<h1>Programme</h1><br>
					</header>
				</div>
			</section>

		<!-- Three -->
			<section id="one" class="wrapper align-center" style="margin-bottom: 100px;">
                <div class="inner">
					<div class="row uniform">
						
						<div class="12u$ 12u$(small)" style="text-align: center;">
							
														<h2 id="content" style="color:#f99f1b; font-size: 38px; line-height: 38px; margin-top: 50px;">Présentation de la Spring collection 2021</h2>

						<p style="font-size:20px; text-align: center;">
						...
							</p>
						</div>
                        
                        <?php for ($i = 1; $i <= 9; $i++) {
                        $PIC_PROGRAMME_J = "PIC_PROGRAMME_J".$i;
                        $TXT_PROGRAMME_J_TITRE = "TXT_PROGRAMME_J".$i."_TITRE";
                        $TXT_PROGRAMME_J = "TXT_PROGRAMME_J".$i;
                        ?>
                        
                        <?php if($dataEvt['NB_PROGRAMME'] >= $i){ ?>
                        <div class="6u 12u$(small)">
                            <div class="row uniform">
                                <?php if($dataEvt[$PIC_PROGRAMME_J] != ""){ ?>
                                <div class="12u$ 12u$(small)" style="padding-top: 0;">
                                    <a data-fancybox="gallery" href="images/<?php echo $event."/".$dataEvt[$PIC_PROGRAMME_J]; ?>"><div style="width:100%; height:250px; background-size: cover; background-position: center; background-image:url(images/<?php echo $event."/".$dataEvt[$PIC_PROGRAMME_J]; ?>);"></div></a>
                                </div>
                                <?php } if(($dataEvt[$TXT_PROGRAMME_J_TITRE] != "") || ($dataEvt[$TXT_PROGRAMME_J] != "")){ ?>
                                <div class="12u$ 12u$(small)" style="text-align:justify; line-height: 22px; padding-top: 10px; font-size: 13pt !important; color: #000 !important;">
                                    <?php if($dataEvt[$TXT_PROGRAMME_J_TITRE] != ""){ ?><h2 id="content" style="margin-bottom: 10px; font-size: 26px;"><?php echo $dataEvt[$TXT_PROGRAMME_J_TITRE]; ?></h2><?php } ?>
                                    <?php if($dataEvt[$TXT_PROGRAMME_J] != ""){ ?><p><?php echo $dataEvt[$TXT_PROGRAMME_J]; ?></p><?php } ?>
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
        var futureDate  = new Date(2021,08,21);
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
