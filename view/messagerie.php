<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" type="image/png" sizes="20x20" href="img/logo.png">
        <title>Messagerie</title>
    </head>
    <body>



        <div id="wrapper" >
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav"></ul>
                    <li><a href="accueil.html" class="btn show side"><img src="img/logo.png" width="45" height="45" alt="logo twitter"></a></li>
                    <li><a href="accueil.html"class="btn side"><i class="fas show fa-home"></i>&nbsp;&nbsp;Accueil</a></li>
                    <li><a href="accueil.html"class="btn side"><i class="fas show fa-hashtag"></i>&nbsp;&nbsp;Explorer</a></li>
                    <li><a href="accueil.html"class="btn side"><i class="far show fa-bell"></i>&nbsp;&nbsp;Notifications</a></li>
                    <li><a href="accueil.html"class="btn side"><i class="far show fa-envelope"></i>&nbsp;&nbsp;Messages</a></li>
                    <li><a href="accueil.html" class="btn side"><i class="far show fa-user"></i>&nbsp;&nbsp;Profil</a></li>
                    <li><button class="btn side popin-open"><i class="fas show fa-sliders-h"></i>&nbsp;&nbsp;Affichage</button></li>
                    <li><a href="accueil.html"class="btn show side btn-primary">Twitter</a></li>
                </ul>
                <div> 
                </div>
            </div>
            <div class="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                            <h1>Messagerie</h1>
                        </div>   
                    </div>
                    
                    <div class="row">
                        <div class="col-10">
                            <div class="my_ctn_msg">
                                <!-- ICI LISTE DES PERSONNES DONT LA DISCUSSION EST LANCÉE -->
                            </div>
                            <div id="form">
            
                            </div>
                        </div>

                        <div class="col-2">
                           
                            
                        </div>
                    
                    
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script src="script/messagerie.js"></script>
    </body>
</html>      