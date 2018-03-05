<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Site de Jean Forteroche</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/freelancer.min.css" rel="stylesheet">

</head>


<body id="top">
<!-- Navigation -->
<nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
    <div class="container">
        <a href="index.php?action=accueil&amp"><img src="public/images/LOGO.png" width="200px"/>
            <a class="navbar-brand js-scroll-trigger" href="#top"></a>
            <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=accueil&amp#portfolio">Blog</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=accueil&amp#actualités">Mes Actualités</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=accueil&amp#contact">Contact</a>
                    </li>
                    <li class="nav-item dropdown mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" data-toggle="dropdown">Espace membre</a>
                        <ul class="dropdown-menu">
                            <?php if (isset($_SESSION['id'])) { ?>

                                <li><a class="dropdown-item" href="index.php?action=deconnectMembre">Se déconnecter</a></li>
                                <li>
                                    <a class="dropdown-item" href="index.php?action=accesSuppMembre">
                                        Supprimer mon compte
                                    </a>
                                </li>


                            <?php } else { ?>

                                <li><a class="dropdown-item" href="index.php?action=connectMembre">Se connecter</a></li>
                                <li><a class="dropdown-item" href="index.php?action=inscripMembre">S'inscrire</a></li>
                            <?php } ?>


                        </ul>
                    </li>
                </ul>
            </div>
    </div>
</nav>