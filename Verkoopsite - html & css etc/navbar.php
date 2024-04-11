<!-- navbar.php -->
<!--<nav>-->
<!--    <ul>-->
<!--        <li><a href="index.php">Home</a></li>-->
<!--        <li><a href="#">Contact</a></li>-->
<!--        <li><a href="boeken_verkoop.php">Boeken</a></li>-->
<!--        <li><a href="laptop_verkoop.php">Laptops</a></li>-->
<!--        --><?php //if (isset($_SESSION["gebruiker"])) { ?>
<!--            <li><a href="?logout=1">Uitloggen</a></li>-->
<!--        --><?php //} else { ?>
<!--            <li><a href="inloggen.php">Inloggen</a></li>-->
<!--            <li><a href="registreren.php">Registreren</a></li>-->
<!--        --><?php //} ?>
<!--    </ul>-->
<!--    --><?php //if (!empty($gebruikersnaam)) { ?>
<!--        <div>Welkom, --><?php //echo $gebruikersnaam; ?><!--</div>-->
<!--    --><?php //} ?>
<!--</nav>-->
<!---->
<!--<style>-->
<!--    /* navbar.css */-->
<!---->
<!--    nav {-->
<!--        background-color: #1a1a1a;-->
<!--        padding: 10px;-->
<!--        overflow: hidden;-->
<!--    }-->
<!---->
<!--    nav ul {-->
<!--        list-style-type: none;-->
<!--        margin: 0;-->
<!--        padding: 0;-->
<!--        display: flex;-->
<!--        justify-content: space-around;-->
<!--    }-->
<!---->
<!--    nav ul li {-->
<!--        display: inline-block;-->
<!--    }-->
<!---->
<!--    nav ul li a {-->
<!--        display: block;-->
<!--        padding: 10px 20px;-->
<!--        color: #fff;-->
<!--        text-decoration: none;-->
<!--        transition: all 0.3s ease;-->
<!--    }-->
<!---->
<!--    nav ul li a:hover {-->
<!--        background-color: #0aeac7;-->
<!--    }-->
<!---->
<!--    nav div {-->
<!--        color: #fff;-->
<!--        padding: 10px;-->
<!--    }-->
<!--</style>-->


<!-- navbar.php -->
<!-- navbar.php -->
<!-- navbar.php -->
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="boeken_verkoop.php">Boeken</a></li>
        <li><a href="laptop_verkoop.php">Laptops</a></li>
        <?php if (isset($_SESSION["gebruiker"])) { ?>
            <li><a href="?logout=1">Uitloggen</a></li>
        <?php } else { ?>
            <li><a href="inloggen.php">Inloggen</a></li>
            <li><a href="registreren.php">Registreren</a></li>
        <?php } ?>
    </ul>
    <?php if (!empty($gebruikersnaam)) { ?>
        <div>Welkom, <?php echo $gebruikersnaam; ?></div>
    <?php } ?>
</nav>

<style>
    /* navbar.css */

    nav {
        background-color: #1a1a1a;
        padding: 10px;
        overflow: hidden;
        box-shadow: 0 8px 16px rgba(251, 51, 88, 0.5); /* Increase the box shadow even further */
    }

    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: space-around;
    }

    nav ul li {
        display: inline-block;
    }

    nav ul li a {
        display: block;
        padding: 10px 20px;
        color: #fff;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    nav ul li a:hover {
        background-color: #0aeac7;
    }

    nav div {
        color: #fff;
        padding: 10px;
    }
</style>

