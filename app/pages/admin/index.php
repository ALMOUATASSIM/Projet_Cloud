<?php 
// la page d'acceuil de l'admin

    require_once('../../ScriptPhp/connection.php');
    session_start(); 
?>
<?php
    if(isset($_SESSION['err'])){
        echo "<div class='err'> Vous n'avez pas remplit le champs</div>";
        session_destroy();
    }else {
        
    }
?>
 <?php
        $sqlp = 'SELECT id,nom,c_nom FROM filiere';
        $statementp = $connection->prepare($sqlp);
        $result = $statementp->execute(array());
    ?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>AdminUPPA</title>
        <link rel="stylesheet" href="../../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel="stylesheet">
    </head>
    <style>
        h2 {
            font-size: 70px;
        }
    </style>
    <body>
        <header>
            <div class="alle">
                <h1><a href="index.php">AdminUPPA</a><span class="orange">.</span></h1>
                <nav>
                    <ul>
                        
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="admin.php">Admin</a></li>
                        <li><a href="../../ScriptPhp/logout.php">Déconnexion</a></li>
                    </ul>
                </nav>
            </div>         
        </header>
        <section id="main">
            <div class="alle" align="center">
                <h2><strong> Bienvenue !</strong></h2>
                <form method="post" action="chercher.php">
                    <table>
                         <tr>
                             <td> 
                                 <select onchange="chang()"  id="qui"  name="qui" required>
                                    <option>--Chercher un--</option>
                                    <option>Enseignant</option>
                                    <option>Fonctionnaire</option>
                                    <option>Etudiant</option>
                                 </select>
                             </td>
                             <td id="par"> 
                                 <select onchange="changer()"  id="par1"  name="par" required>
                                    <option>--Chercher par--</option>
                                    <option>Tous</option>
                                    <option>Chercher</option>
                                 </select>
                             </td>
                         </tr>
                     </table>
                    <table>
                        <tr>
                             <td id="che"><input type="text" name="che1" id="sear" class="search-midle" placeholder="Chercher..."></td>
                             <td id="butt"><input type="submit" style="text-align:center" name="chercher1" id="bt1"  value="Chercher " class="button-3"></td>
                         </tr>
                    </table>
                </form>
            </div>     
        </section>
         <section id="contact">
            
        </section>
        <footer>
            <div class="wrapper">
               <a href="#main"> <h1>AnnuaireUPPA<span class="orange">.</span></h1></a>
                <div class="copyright">Copyright © Tous droits réservés.</div>
			</div>
        </footer>
    </body>
    <script>
        
        
        var qui = document.getElementById("qui");
        var che = document.getElementById("che");
        var bt1 = document.getElementById("bt1");
        var par = document.getElementById("par");
        var par1 = document.getElementById("par1");
        var butt = document.getElementById("butt");
        var sear = document.getElementById("sear");

        
        
        window.onload = function(){
            che.style.display='none';
            butt.style.display='none';
            par.style.display='none';
           
        }
        
        function chang(){
            if(qui.value == "Etudiant"){
                par.style.display='';
                che.style.display='none';
                butt.style.display='none';
                
            }else if(qui.value == "Enseignant") {
                par.style.display='';
                che.style.display='none';
                butt.style.display='none';

            }else if(qui.value == "Fonctionnaire") {
                par.style.display='';
                che.style.display='none';
                butt.style.display='none';

            }else if(qui.value == "--Chercher un--")  {
                par.style.display='none';
                che.style.display='none';
                butt.style.display='none';

            }
        }
        
        function changer(){
            if(par1.value == "Tous"){
                butt.style.display='';
                che.style.display='none';
                sear.required = false;
                
            }else if(par1.value == "Chercher") {
                butt.style.display='';
                che.style.display='';
                sear.required = true;

            }else if(par1.value == "--Chercher par--") {
                butt.style.display='none';
                che.style.display='none';

            }
        }
        
        function def(){
            che.style.display='none';
            butt.style.display='none';
            par.style.display='none';
        }
        
        
    </script>
</html>