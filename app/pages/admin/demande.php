<?php 
// la page de l'acceptation ou le refus des demandes
     require_once('../../ScriptPhp/connection.php');
?>

<!doctype html>
<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" href="../../css/style.css">

        <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel="stylesheet">
      
    </head>
    
   
    <?php
    // la valeur du demande = 0 signifie que le tableau va afficher les utilisateur qui n'ont pas accepter
        $sql = 'SELECT id,nom, pnom, email, tel,qui, ppr FROM enseignant WHERE demande = 0'; 
        $statement = $connection->prepare($sql);
        $result = $statement->execute(array());
    
        $sqle = 'SELECT id,nom, pnom, email, tel,qui,cne,fil FROM etudiant WHERE demande = 0'; 
        $statemente = $connection->prepare($sqle);
        $resulte = $statemente->execute(array());
    ?>
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
            <a  href="admin.php">Statistique</a>
            <a  href="enseig.php">Enseignant</a>
            <a  href="fonc.php">Fonctionnare</a>
            <a  href="etud.php">Etudiant</a>
            <a  href="fil.php">Filière</a>
            <a class="in" href="demande.php">Demande</a>
        </div>
        <div class="alll">
            <form action="demande.php" method="post">
                <table class="user">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Qui</th>
                    <th>PPR/CNE</th>
                    <th>Filière</th>
                    <th colspan="2"></th>
                </tr>
                <?php if($statemente->rowCount()>0) { 
                        foreach($statemente as $rowe) { 
                        
                    ?>
                <tr>
                    <input type="hidden" name="idd" value="<?php echo $row[0]; ?>">
                    <td><?php echo $rowe[0]; ?></td>
                    <td><?php echo $rowe[1]; ?></td>
                    <td><?php echo $rowe[2]; ?></td>
                    <td><?php echo $rowe[3]; ?></td>
                    <td><?php echo $rowe[4]; ?></td>
                    <td><?php echo $rowe[5]; ?></td>
                    <td><?php echo $rowe[6]; ?></td>
                    <td><?php echo $rowe[7]; ?></td>
                    <td style="padding:0;margin:0" colspan='2'>
                        <button type="button" onClick="accepte(<?php echo $rowe[0]; ?>)" class="button-11">Accepter</button>
                        <button type="submit" name="delet" onClick="suppe(<?php echo $rowe[0]; ?>)" class="button-8">Refuser</button>
                    </td>
                </tr>
                <?php }} else { ?>
                    <tr>
                        <th colspan="8">Aucun demande d'etudiant existe</th>
                    </tr>
                    <?php } ?>
                    
                    
                <?php if($statement->rowCount()>0) { 
                        foreach($statement as $row) { 
                        
                    ?>
                <tr>
                    <input type="hidden" name="idd" value="<?php echo $row[0]; ?>">
                    <td><?php echo $row[0]; ?></td>
                    <td><?php echo $row[1]; ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td><?php echo $row[3]; ?></td>
                    <td><?php echo $row[4]; ?></td>
                    <td><?php echo $row[5]; ?></td>
                    <td><?php echo $row[6]; ?></td>
                    <td>X</td>
                    <td style="padding:0;margin:0" colspan='2'>
                        <button type="button" onClick="accept(<?php echo $row[0]; ?>)" class="button-11">Accepter</button>
                        <button type="submit" name="delet" onClick="supp(<?php echo $row[0]; ?>)" class="button-8">Refuser</button>
                    </td>
                </tr>
                <?php }} else { ?>
                    <tr>
                        <th colspan="8">Aucun demande d'enseignant existe</th>
                    </tr>
                    <?php } ?>
            </table>
            </form>
        </div>
        <script>
            function accepte(id)
            {
                if(confirm("Vous voulez accepter ?")){
                    window.location.href='acceptetud.php?id=' +id+'';
                    return true;
                }
                else {
                    return false;
                }
            }
            function accept(id)
            {
                if(confirm("Vous voulez accepter ?")){
                    window.location.href='acceptens.php?id=' +id+'';
                    return true;
                }
                else {
                    return false;
                }
            }
            
            
            function supp(id)
            {
                if(confirm("Vous voulez refuser la demande ?")){
                    window.location.href='suppens.php?id=' +id+'';
                    return true;
                }
                else {
                    return false;
                }
            } 
             
            function suppe(id)
            {
                if(confirm("Vous voulez refuser la demande ?")){
                    window.location.href='suppetud.php?id=' +id+'';
                    return true;
                }
                else {
                    return false;
                }
            } 
        </script>
    </body>
</html>