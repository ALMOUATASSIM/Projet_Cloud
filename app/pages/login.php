<?php
    require_once('../ScriptPhp/connection.php');
    session_start();
?>
<?php   
     
    if(isset($_POST['login'])){
          if($_POST['email'] == "admin@admin.admin" || $_POST['password'] == "admin" ){
              header("location: admin/index.php"); 
                        die('Bienvenu admin');
          }
                        
        if(empty($_POST['email']) || empty($_POST['password'] )) {
            echo '<div class="err">Il faut remplir les champs<div>';
        }else {
            
            $sql = 'SELECT cne,email,password,qui FROM etudiant WHERE password = :password AND email = :email AND demande = 1
                    UNION
                    SELECT ppr,email,password,qui FROM enseignant
                    WHERE password = :password AND email = :email AND demande = 1';            
            $statement = $connection->prepare($sql);
            $statement->execute(array('email' => $_POST['email'],'password' => $_POST['password'],));
            $count = $statement->rowCount();
            if($count>0){
                foreach($statement as $row)
                {
                    $_SESSION['id'] = $row['cne'];
                    $_SESSION['qui'] = $row['qui'];
                  
                    if($row['qui'] == 'Etudiant'){
                        header("location: etudiant/index.php");
                    }else if($row['qui'] == 'Fonctionnaire' || $row['qui'] == 'Enseignant'){
                        header("location: enseignant/index.php");
                    }
                    
   
                }
               
                }
            
            
    
             else {
                echo '<div class="err">Email ou mot de passe est incorrect<div>';
            }
            
        }
        
    }
    
        
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Se Connecter</title>
        <link rel="stylesheet" href="../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel="stylesheet">
       

    </head>
    <body>
        <header>
            <div class="alle">
                <h1><a href="../../index.php">AnnuaireUPPA</a><span class="orange">.</span></h1>
                <nav>
                    <ul>
                        <li><a href="../../index.php">Accueil</a></li>
                        <li><a href="login.php">Se Connecter</a></li>
                        <li><a href="signin.php">S'inscrire</a></li>
                    </ul>
                </nav>
            </div>         
        </header>
        <div  class="toplog" >
            <a class="in" href="login.php">Se Connecter</a>
            <a  href="signin.php">S'inscrire</a>
        </div>
        <div class="signin">
            <form method="post" action="login.php" class=".form">
                <table style="margin: 0 auto;">
                    <tr>
                        <td>
                            <label>Email : </label>
                        </td>
                        <td>
                            <input type="email" name="email" placeholder="Votre email" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Mot de passe :</label>
                        </td>
                        <td>
                            <input type="password" name="password" id="password" placeholder="Votre mot de passe" required>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <a style="color : #0000FF;" href="signin.php">Vous n'êtes pas encore inscrit ?</a>
                        </td>
                    </tr>
                   
                    <tr style="height: 100px;">
                        <td></td>
                        <td>
                            <button type="submit" name="login" class="button-3" style="float:right;">Se connecter</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        
        
        
        
        
        
        
        <script src="../js/script.js"></script>
        
        
        
        
        
        
        
        
        
        
        
        
        
    
    </body>
</html>