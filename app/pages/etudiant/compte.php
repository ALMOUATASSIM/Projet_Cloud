<?php
    session_start();
    require_once('../../ScriptPhp/connection.php');
    
?>
<?php 
  function Exist($con) {
            $stmt = $con->prepare("SELECT nom FROM enseignant 
            WHERE email= :email OR tel = :tel OR ppr= :cne 
            UNION
            SELECT nom FROM etudiant 
            WHERE email= :email OR tel = :tel OR cne= :cne 
            EXCEPT 
            SELECT nom FROM etudiant WHERE id=".$_POST['id']);
            $stmt->execute(array("email" => $_POST['email'],"tel" => $_POST['tel'], "cne" => $_POST['cne'] )); 
            return $stmt->fetchColumn();
        }
        
?>

<?php
    function getPass($cne,$con){
           $sqlp = 'SELECT password FROM etudiant WHERE cne = :cne';            
            $statementp = $con->prepare($sqlp);
            $statementp->execute(array('cne' => $cne));
            $count = $statementp->rowCount();
                foreach($statementp as $rowp)
                {
                    return $rowp['password'];
   
                }
               
            }
        function getPass2($ppr,$con){
           $sqln = 'SELECT password FROM enseignant WHERE ppr = :ppr';            
            $statementn = $con->prepare($sqln);
            $statementn->execute(array('ppr' => $ppr));
            $count = $statementn->rowCount();
                foreach($statementn as $rown)
                {
                    return $rown['password'];
   
                }
               
            }
    
?>
<?php
                               

            if(isset($_POST['update'])){
                if($_SESSION['qui'] == 'Etudiant'){
                    $email       =      $_POST['email'];
                    $tel         =      $_POST['tel'];
                    $password    =      $_POST['password'];
                    $c_password  =      $_POST['c_password'];
                    $a_password  =      $_POST['a_password'];
                    $id          =      $_POST['id'];
                    $cne         =      $_POST['cne'];
                    
                    if(Exist($connection)){
                        echo "<div class='err'> Le CNE ou l'Email ou le Téléphone déja existe </div>";
                    }else {   
                        $sql = 'UPDATE etudiant SET email= :email, tel= :tel, password= :password WHERE cne= :id ';
                        if(getPass($_SESSION['id'],$connection) == $a_password) {
                            try{
                                $statement = $connection->prepare($sql); 
                                $result = $statement->execute(array('id' => $_SESSION['id'],'email' => $email,'tel' => $tel , 'password' => $password));
                                if($result){
                                    echo '<div class="valid">Modification avec succès</div>';
                                }
                                else {
                                    echo '<div class="err">Il faut remplir tout les champs</div>';    
                                }
                            } catch(PDOException $e){
                                echo '<div class="err">Email ou Téléphone déja existe choisir une autre</div>';
                            }
                        } else if($a_password == '' ) {
                            echo '<div class="err">Vérifier votre mot de passe Actuel</div>';   
                        }else {echo '<div class="err">Vérifier votre mot de passe Actuel</div>'; } 
                    }
                }
            }
                
                        
             
        ?>
        
        
        <?php
            $sql = 'SELECT id, nom, pnom, email, tel, qui, cne, fil FROM etudiant WHERE cne= :id ';
            $statement = $connection->prepare($sql);
            $statement->execute(array('id' => $_SESSION['id']));
        
            $sql1 = 'SELECT id, nom, pnom, email, tel, qui, ppr FROM enseignant WHERE ppr= :id ';
            $statement1 = $connection->prepare($sql1);
            $statement1->execute(array('id' => $_SESSION['id']));
        ?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Mon compte</title>
        <link rel="stylesheet" href="../../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel="stylesheet">
    </head>
    
    
    <body>
         <header>
            <div class="alle">
                <h1><a href="index.php">EtudiantUPPA</a><span class="orange">.</span></h1>
                <nav>
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="compte.php">Mon compte</a></li>
                        <li><a href="../../ScriptPhp/logout.php">Déconnexion</a></li>
                    </ul>
                </nav>
            </div>         
        </header>
        <div class="topcompte" >
            <p>Mon profile</p>

        </div>
        <div class="signin">
            
            <form method="post" action="compte.php">
                
                <?php 
                if($statement1->rowCount()>0) {
                    $statement=$statement1;
                }
                   
                
                foreach($statement as $row) {
                    ?>
              <table style="margin: 0 auto;">
                  <tr>
                    <td colspan="2" style="text-align : center;" ><span id="mess"></span></td>
                  </tr>
                  <input type="hidden" value="<?php echo $row[0]; ?>" name="id">
                  <input type="hidden" value="<?php echo $row['cne']; ?>" name="cne">
                  
                    <tr>
                        <td>
                            <label>NOM : </label>
                        </td>
                        <td>
                            <input type="text" name="nom" placeholder="Votre nom"  value="<?php echo $row[1]; ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Prénom : </label>
                        </td>
                        <td>
                            <input type="text" name="pnom" placeholder="Votre prénom" value="<?php echo $row[2]; ?>" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email : </label>
                        </td>
                        <td>
                            <input type="email" name="email" id ="email" placeholder="Votre email" value="<?php echo $row[3]; ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Téléphone : </label>
                        </td>
                        <td>
                            <input type="text" name="tel" id ="tel" placeholder="Votre numéro de téléphone" value="<?php echo $row[4]; ?>" required >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Je suis un : </label>
                        </td>
                        <td>
                            <input type="text" name="qui" id ="qui" value="<?php echo $row['qui']; ?>" disabled >
                        </td>
                    </tr>
                        <tr id="cne">
                        <td>
                            <label>CNE :</label>
                        </td>
                        <td>
                            <input type="text" name="cne" placeholder="Votre CNE" value="<?php echo $row['cne']; ?>" disabled>
                        </td>
                    </tr>
                    <tr id="fil">
                        <td>
                            <label>Filière :</label>
                        </td>
                        <td>
                            <input type="text" name="fil" id ="fil" value="<?php echo $row['fil']; ?>" disabled >
                        </td>
                    </tr>
                 <?php   }  ?>
                    <tr>
                        <td>
                            <label>Mot de passe :</label>
                        </td>
                        <td>
                            <input type="password" name="password" id="password" placeholder="Votre mot de passe"  onkeyup="check()" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Confirmer Mot de passe :</label>
                        </td>
                        <td>
                            <input type="password" name="c_password" id="c_password" placeholder="Votre mot de passe" onkeyup="check()" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span id="message"></span>
                        </td>
                    </tr>
                    <tr style="height: 100px;">
                        <td></td>
                        <td>
                            <button type="button" class="button-5" style="float:right;" id="modifier" onclick="modify()"  >Modifier</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Saisir votre mot de passe<br> actuel pour confirmer:</label>
                        </td>
                        <td>
                            <input type="password" name="a_password" id="a_password"  placeholder="Votre mot de passe actuel">
                        </td>
                        <td>
                            <button type="submit" name="update" class="button-6" style="float:right;" disabled id="btSubmit" onkeyup="check()" >Confirmer</button>
                        </td> 
                    </tr>
                </table>
                
            </form>
        </div>
        
            
        
        <script>
            var email = document.getElementById("email");
            var tel = document.getElementById("tel");
            var password = document.getElementById("password");
            var c_password = document.getElementById("c_password");
            var modifier = document.getElementById("modifier");
            
            email.disabled = true;
            tel.disabled = true;
            password.disabled = true;
            c_password.disabled = true;
            
            function modify(){
                modifier.disabled = true;
                email.disabled = false;
                tel.disabled = false;
                password.disabled = false;
                c_password.disabled = false;
            }
        </script>
        <script src="../../js/script.js"></script>
        
        
        
        
        
        
        
        
        
        
        
        
        
    
    </body>
</html>