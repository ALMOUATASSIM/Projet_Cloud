<?php
    session_start(); 
    require_once('../../ScriptPhp/connection.php');
?>
<?php
// une fonction qui vérifie si l'email déja existe dans la base de donnés 
function verify($email,$table,$con){
    $sqln = 'SELECT email FROM '.$table.' WHERE email = :email';            
    $statementn = $con->prepare($sqln);
    $statementn->execute(array('email' => $email));
    $countn = $statementn->rowCount();
    if($countn>0){
        return true;
    }else {
        return false;
    }
}
?>
<?php          
if(isset($_POST['submit'])) {
    $nom         =      $_POST['nom'];
    $pnom        =      $_POST['pnom'];
    $email       =      $_POST['email'];
    $tel         =      $_POST['tel'];
    $qui         =      $_POST['qui'];
    $cne         =      $_POST['cne'];
    $fil         =      $_POST['fil'];
    $ppr         =      $_POST['ppr'];
    $password    =      $_POST['password'];
    $c_password  =      $_POST['c_password'];   
    
    if($_POST['qui'] == 'Etudiant'){
        $sql = "INSERT INTO etudiant(nom, pnom, email, tel, qui, cne, fil, password,demande) VALUES (?, ?, ?, ?,?,?, ?,?,1 )";    
        $statement = $connection->prepare($sql);
        try
        {
            if(verify($email,'enseignant',$connection)) throw new PDOException();
            $result = $statement->execute(array($nom, $pnom, $email, $tel, $qui, $cne, $fil, $password));
            header("location: admin.php");   
        }
        catch(PDOException $e)
        {
            echo '<div class="err">Email ou CNE ou Telephone déja exist <div>'; 
        }
    }
    else
    {
        $sql = "INSERT INTO enseignant(nom, pnom, email, tel, qui, ppr, password,demande) VALUES (?, ?, ?, ?,?,?, ?,1 )";    
        $statement = $connection->prepare($sql);
        try
        {
            if(verify($email,'etudiant',$connection)) throw new PDOException();
            $result = $statement->execute(array($nom, $pnom, $email, $tel, $qui, $ppr, $password));
            header("location: admin.php"); 
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

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Admin</title>
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../../css/style2.css">
        <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel="stylesheet">
       
    </head>
    <body>
        <header>
            <div class="alle">
                <h1><a href="index.php">AdminUPPA</a><span class="orange">.</span></h1>
                <nav>
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="../../ScriptPhp/logout.php">Déconnexion</a></li>
                    </ul>
                </nav>
            </div>         
        </header>
        <div  class="toplog" >
            <a class="in" href="admin.php">Statistique</a>
            <a  href="enseig.php">Enseignant</a>
            <a  href="fonc.php">Fonctionnare</a>
            <a  href="etud.php">Etudiant</a>
            <a  href="demande.php">Demande</a>
            <a  href="fil.php">Filière</a>
        </div>
        <div class="modif" style="margin: 10px auto;">
            <h1 style="text-align:center;">Ajouter un utilisateur</h1><br>
            <form method="post" action="ajout.php"  >
                <table style="margin: 10px auto;">
                    <tr>
                        <td><label>NOM : </label></td>
                        <td><input type="text" name="nom" placeholder="Nom..." required></td>
                    </tr>
                    <tr>
                        <td><label>Prénom : </label></td>
                        <td><input type="text" name="pnom" placeholder="Prénom..." required></td>
                    </tr>
                    <tr>
                        <td><label>Email : </label></td>
                        <td><input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" type="email" name="email" placeholder="Email..." required></td>
                    </tr>
                    <tr>
                        <td><label>Téléphone : </label></td>
                        <td><input type="number" name="tel" placeholder="Téléphone..." required></td>
                    </tr>
                    <tr>
                        <td><label>Je suis un : </label></td>
                        <td>
                            <select onchange="hide()" id="qui" name="qui" required>
                                <option>Enseignant</option>
                                <option>Fonctionnaire</option>
                                <option>Etudiant</option>
                            </select>
                        </td>
                    </tr>
                    <tr id="ppr">
                        <td><label>PPR : </label></td>
                        <td><input type="text" id="ppr1" name="ppr" placeholder="PPR..." ></td>
                    </tr>
                    <tr  id="cne">
                        <td><label>CNE : </label></td>
                        <td><input type="text" name="cne" id="cne1" placeholder="CNE..." ></td>
                    </tr>
                    <tr id="fil">
                        <td><label>Filière : </label></td>
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
                        <td><label>Mot de passe : </label></td>
                        <td><input type="password" name="password" id="password" placeholder="Mot de passe..."  onkeyup="check()" required></td>
                    </tr>
                    <tr>
                        <td><label>Confirmer Mot de passe : </label></td>
                        <td>
                            <input type="password" name="c_password" id="c_password" placeholder="Confirmer mot de passe..." onkeyup="check()" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span id='message'></span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2">
                            <button style="float:right;" type="button" name="quitter" class="button-10" onclick="linke()">Quitter</button>
                            <button type="submit" name="submit" class="button-9" style="float:right;" disabled id="btSubmit" onkeyup="check()">Valider</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        

        <script>
            function linke(){
                location.href = "admin.php";
            }
        </script>
        <script src="../../js/script.js"></script>
        
        
        
        
        
        
        
        
        
        
        
        
    
    </body>
</html>