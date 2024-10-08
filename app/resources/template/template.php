<!DOCTYPE html>
<html lang="en">

<head>

    <?php

use app\core\controller\base\Controller;
use app\libs\autentication\Autentication;

 require_once "includes/head.php";

        foreach ($this->scripts as $script) {
            echo '<script defer type="text/javascript" src="'.$script.'"></script>';
        }
        
    ?>

</head>

<body>
    <div class="container-fluid">
        <header>
            <?php   
            // if(isset($_SESSION["token"])&& $_SESSION["token"]==APP_TOKEN){

            if (!str_contains($this->view, "autentication")) {
                require_once "includes/nav.php";
            // require_once "includes/menu.php";
                require_once "includes/bread_crumb.php";
            }
            // require_once "includes/nav.php";
            // // require_once "includes/menu.php";
            // require_once "includes/bread_crumb.php";

            // }

            ?>
        </header>
        <main>

            <?php
            require_once APP_VIEWS . $this->view;
            ?>
            <!-- name-space y el use -->
        </main>
        <footer>
            <?php
            // if(isset($_SESSION["token"])&& $_SESSION["token"]==APP_TOKEN){

            if (!str_contains($this->view, "autentication")) {
                require_once "includes/footer.php";
            }


            
            // }
            ?>
        </footer>

    </div>
</body>

</html>