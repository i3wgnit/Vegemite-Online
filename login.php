<?php
include "mysqli.php";
if (isset($_POST['signup'])) {
    $username = ($_POST['username'])? htmlspecialchars($_POST['username']):"bob";
    $password = $_POST['password'];
    $passConf = $_POST['passConf'];
    if ($password == $passConf) {
        $query = "SELECT COUNT(*) FROM vegemiteOnline WHERE username = '" . $username . "'";
        if ($result = $mysqli->query($query)) {
            $row = $result->fetch_row();
            $result->close();
            if ($row[0]) {
                $sError = "Pseudo non disponible";
            } else {
                $query = "INSERT INTO vegemiteOnline (username, password) " .
                    "VALUES('" . $username . "', '" . $password . "')";
                if ($result = $mysqli->query($query)) {
                    $lError = "Votre compte a &eacute;t&eacute; cr&eacute;&eacute;";
                } else {
                    $sError = "Erreur de connection";
                }
            }
        } else {
            $sError = "Erreur de connection";
        }
    } else {
        $sError = "Les mots de passe doivent correspondre";
    }
} elseif (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];
    $query = "SELECT * FROM vegemiteOnline WHERE password = '" . $password .
            "' AND username = '" . $username . "'";
    if ($result = $mysqli->query($query)) {
        $row = $result->fetch_assoc();
        $result->close();
        if ($row['id']) {
            session_start();
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: /");
        } else {
            $lError = "Mauvais pseudo ou mot de passe";
        }
    } else {
        $lError = "Erreur de connection";
    }
}
?>

<html>
    <head>
        <title>Vegemite Online</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    
    <body>
        <div id="header">
            <div id="header_cont">
                <div id="nav">
                    <img src="css/img/logo.png" width="125" height="120" />
                    <div class="navButton current" style="text-decoration: none;">Vegemite Online</div>
                </div>
                <noscript>You Must Have Javascript Enabled For This Game To Work</noscript>
            </div>
        </div>
        <div id="wrap">
            <div id="wrap_content">
                <div class="v-wrap">
                    <div class="content">
                        <div id="left">
                            <span>Cr&eacute;er un compte</span>
                            <form method="post" action="#">
                                <label for="sUsername">Pseudo : </label>
                                <input type="text" maxlength="30" id="sUsername" name="username" value="<?php echo $sError? $username? $username :'' :'' ?>" />
                                <br/><label for="sPassword">Mot de passe : </label>
                                <input type="password" maxlength="30"  id="sPassword" name="password" />
                                <br/><label for="sPassConf">Confirmer le mdp : </label>
                                <input type="password" maxlength="30"  id="sPassConf" name="passConf" />
                                <br/><input type="submit" name="signup" value="Cr&eacute;er un compte" />
                                <br/><?php echo $sError ?>
                            </form>
                        </div>
                        <div id="right">
                            <span>Se connecter</span>
                            <form method="post" action="#">
                                <input type="text" maxlength="30" id="lUsername" name="username" value="<?php echo $lError? $username? $username:'' :'' ?>" />
                                <label for="lUsername"> : Pseudo</label><br/>
                                <input type="password" maxlength="30" id="lPassword" name="password" />
                                <label for="lPassword"> : Mot de passe</label><br/>
                                <a href="javascript:alert('Je ne peux rien pour vous.');">Mot De Passe Oubli&eacute;?</a><br/>
                                <input type="submit" name="login" value="Se connecter" />
                                <br/><?php echo $lError ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="js/main.js">
    </script>
    <script type="text/javascript">
        var resize = new Event( "optimizedResize" );
        window.addEventListener( "optimizedResize", function() {
            fit( document.getElementById( "wrap" ) );
        } );
        window.dispatchEvent( resize );
    </script>
</html>