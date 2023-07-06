<!-- <div id="left"> 
    <strong>DASHBOARD</strong>
    <ol class="ol_ol">
        <li><a href="addfarm.php">My Farm</a></li>
        <li><a href="predicament.php">Predicament</a></li>
        <li><a href="guidelines.php">View Guidelines</a></li>
    </ol>
</div> -->

<div id="left">
    <strong><a href="myfarm.php">DASHBOARD</a></strong>
    <ol class="ol_ol">
        <li <?php if(basename($_SERVER['PHP_SELF']) == "myfarm.php" || empty($_SERVER['PHP_SELF'])) echo 'class="active"'; ?>>
            <a href="myfarm.php">My Farm</a>
        </li>
        <li <?php if(basename($_SERVER['PHP_SELF']) == "predicament.php") echo 'class="active"'; ?>>
            <a href="predicament.php">Predicament</a>
        </li>
        <li <?php if(basename($_SERVER['PHP_SELF']) == "guidelines.php") echo 'class="active"'; ?>>
            <a href="guidelines.php">View Guidelines</a>
        </li>
    </ol>
</div>

