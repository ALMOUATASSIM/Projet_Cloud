<?php
    session_start(); 
    require_once('../ScriptPhp/connection.php');
?>
<?php
    function verify($email,$table,$con){
        
        $sqln = 'SELECT email FROM '.$table.' WHERE email = :email';            
            $statementn = $con->prepare($sqln);
            $statementn->execute(array('email' => $_POST['email']));
            $countn = $statementn->rowCount();
            if($countn>0){
                return true;
            }else{
                return false;
            }
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>S'inscrire</title>
        <link rel="stylesheet" href="../css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel="stylesheet">

    </head>
    <body>
        
        
       
        <?php          
            if(isset($_POST['submit'])) {
                
                $_SESSION['qui'] = $_POST['qui'];
                
                if($_POST['qui'] == 'Etudiant'){
                    
                    $nom         =      $_POST['nom'];
                    $pnom        =      $_POST['pnom'];
                    $email       =      $_POST['email'];
                    $tel         =      $_POST['tel'];
                    $qui         =      $_POST['qui'];
                    $cne         =      $_POST['cne'];
                    $fil         =      $_POST['fil'];
                    $password    =      $_POST['password'];
                    $c_password  =      $_POST['c_password'];   
                    
                    
                    
                    $sql = "INSERT INTO etudiant(nom, pnom, email, tel, qui, cne, fil, password, demande) VALUES (?, ?, ?, ?,?,?, ?,?,0 )";    
                    $statement = $connection->prepare($sql);
                    try
                    {
                        if(verify($email,'enseignant',$connection)) throw new PDOException();
                        $result = $statement->execute(array($nom, $pnom, $email, $tel, $qui, $cne, $fil, $password));
                        $_SESSION['id'] = $_POST['cne'];
                       header("location: condition.php");   
                    }
                    catch(PDOException $e)
                    {
                        echo '<div class="err">Email ou CNE ou Telephone déja exist <div>'; 
                    }
                }
                else 
                    {
                        $nom         =      $_POST['nom'];
                        $pnom        =      $_POST['pnom'];
                        $email       =      $_POST['email'];
                        $tel         =      $_POST['tel'];
                        $qui         =      $_POST['qui'];
                        $ppr         =      $_POST['ppr'];
                        $password    =      $_POST['password'];
                        $c_password  =      $_POST['c_password'];   
                        $sql = "INSERT INTO enseignant(nom, pnom, email, tel, qui, ppr, password, demande) VALUES (?, ?, ?, ?,?,?, ?,0 )";    

                        $statement = $connection->prepare($sql);
                        try
                        {
                            if(verify($email,'etudiant',$connection)) throw new PDOException();
                            $result = $statement->execute(array($nom, $pnom, $email, $tel, $qui, $ppr, $password));
                            $_SESSION['id'] = $_POST['ppr'];
                            header("location: condition.php");   
                        }
                        catch(PDOException $e)
                        {
                           echo '<div class="err">Email ou PPR ou Telephone déja exist <div>'; 
                           
                        }

                    }
            }
        
        ?>
        <?php
        $sqlp = 'SELECT id,nom,c_nom FROM filiere';
        $statementp = $connection->prepare($sqlp);
        $result = $statementp->execute(array());
        ?>
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
            <a  href="login.php">Se Connecter</a>
            <a class="in" href="signin.php">S'inscrire</a>
        </div>
        <div class="signin">
            <form method="post" action="signin.php" class=".form">
                <table style="margin: 0 auto;">
                    <tr>
                        <td>
                            <label>NOM : </label>
                        </td>
                        <td>
                            <input type="text" name="nom" placeholder="Votre nom" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Prénom : </label>
                        </td>
                        <td>
                            <input type="text" name="pnom" placeholder="Votre prénom" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email : </label>
                        </td>
                        <td>
                            <input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" type="email" name="email" placeholder="Votre email" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Téléphone : </label>
                        </td>
                        <td>
                            <input type="number" name="tel" placeholder="Votre numéro de téléphone" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Je suis un : </label>
                        </td>
                        <td>
                            <select onchange="hide()" id="qui" name="qui" required>
                                <option>Enseignant</option>
                                <option>Fonctionnaire</option>
                                <option>Etudiant</option>
                            </select>
                        </td>
                    </tr>
                    <tr id="ppr">
                        <td>
                            <label>PPR :</label>
                        </td>
                        <td>
                            <input type="text" name="ppr" id="ppr1" placeholder="Votre PPR">
                        </td>
                    </tr>
                    <tr  id="cne">
                        <td>
                            <label>CNE :</label>
                        </td>
                        <td>
                            <input type="text" name="cne" id="cne1" placeholder="Votre CNE">
                        </td>
                    </tr>
                    <tr id="fil">
                        <td>
                            <label>Filière :</label>
                        </td>
                        <td>
                            
                            <select name="fil" required>
                                <?php  if($statementp->rowCount()>0) {  
                                foreach($statementp as $row) { ?>
                                <option ><?php echo $row[1] ?></option>
                                <?php }} ?>
                            </select>
                        </td>
                        
                    </tr>
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
                            <input type="password" name="c_password" id="c_password" placeholder="Confirmer mot de passe" onkeyup="check()" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span id='message'></span>
                        </td>
                    </tr>
                    <tr style="height: 100px;">
                        <td></td>
                        <td>
                            <button type="submit" name="submit" class="button-3" style="float:right;" disabled id="btSubmit" onkeyup="check()" >S'inscrire</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        

        
        <script src="../js/script.js"></script>
        
        
        
        
        
        
        
        
        
        
        
        
    
    </body>
</html>