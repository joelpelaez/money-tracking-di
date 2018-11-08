<?php
/** @var \App\Core\View $this */
?>
<!DOCTYPE html>
<html>
<head>
    <title>Money Tracking</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="<?= $this->css_folder; ?>materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>

<div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper container">
            <a href="<?= APP_URL ?>" class="brand-logo">Money Tracking</a>
            <a href="<?= APP_URL ?>" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

            <ul class="right hide-on-med-and-down">
                <li><a href="<?php echo APP_URL?>account">Cuentas</a></li>
                <li><a href="<?php echo APP_URL?>category">Categorías</a></li>
                <li><a href="<?php echo APP_URL?>transaction">Transacciones</a></li>
            </ul>
        </div>
    </nav>
</div>
<ul class="sidenav" id="mobile-demo">
    <li><a href="<?php echo APP_URL?>account">Cuentas</a></li>
    <li><a href="<?php echo APP_URL?>category">Categorías</a></li>
    <li><a href="<?php echo APP_URL?>transaction">Transactions</a></li>
</ul>

<?= $this->page->content ?>

<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="<?= $this->js_folder; ?>jquery-3.3.1.js"></script>
<script type="text/javascript" src="<?= $this->js_folder; ?>materialize.js"></script>

<script>
    $(document).ready(function () {
        $('select').formSelect();
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd"
        });
        $('.fixed-action-btn').floatingActionButton();
        $('.sidenav').sidenav();
        $('.tap-target').tapTarget();
    });
</script>


<?php
if($this->getAction())
{
    ?>
    <script>
        M.toast({html:'<?php echo $this->getAction() ?>'})
    </script>
    <?php
}
?>>
</body>
</html>