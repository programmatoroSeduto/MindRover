<?php
function get_public_navbar($page) 
{
    //link
    $homepage = './homepage.php';
    $chi_siamo = "./frogstudios.php";
    $mindrover = "./mindrover.php";
    $crowdfunding = "./crowdfunding.php";
    $login_form = "./login.php";
    $searchpage = "./search.php";

    echo '
    <div id="nav-wrapper"  style="position: sticky; top: 0; margin: 0; max-height: 75px; overflow: hidden;">
        <nav id="nav">
            <a href="' . (($page !== 'HOMEPAGE') ? $homepage : '#') . '">
                <div class="nav left">
                    <span class="gradient skew"><h1 class="logo un-skew"><img src="../assets/img/logo2.png" style="width: 350px; height: auto; margin-top: 20px;"></h1></span>
                    <button id="menu" class="btn-nav"><span class="fas fa-bars"></span></button>
                </div>
            </a>
            <div class="nav right">
                <a href="' . (($page !== 'CHI SIAMO') ? $chi_siamo : '#') . '" class="nav-link ' . (($page === "CHI SIAMO") ? "active" : "") . '"><span class="nav-link-span"><span class="u-nav">CHI SIAMO</span></span></a>
                <a href="' . (($page !== 'MINDROVER') ? $mindrover : '#') . '" class="nav-link ' . (($page === "MINDROVER") ? "active" : "") . '"><span class="nav-link-span"><span class="u-nav">MINDROVER</span></span></a>
                <a href="' . (($page !== 'CROWDFUNDING') ? $crowdfunding : '#') . '" class="nav-link ' . (($page === "CROWDFUNDING") ? "active" : "") . '"><span class="nav-link-span"><span class="u-nav">CROWDFUNDING</span></span></a>
                <a href="' . (($page !== 'SEARCH') ? $searchpage : '#') . '" class="nav-link ' . (($page === "SEARCH") ? "active" : "") . '"><span class="nav-link-span"><span class="u-nav">CERCA</span></span></a>
                <a href="' . (($page !== 'LOGIN') ? $login_form : '#') . '" class="nav-link ' . (($page === "LOGIN") ? "active" : "") . '"><span class="nav-link-span"><span class="u-nav">ACCEDI</span></span></a>
            </div>
        </nav>
    </div>
    ';
}

function get_private_navbar($page)
{
    //link
    $homepage = './homepage.php';
    $chi_siamo = "./frogstudios.php";
    $mindrover = "./mindrover.php";
    $crowdfunding = "./crowdfunding.php";
    $profile = "./profiloprivato.php";
    $searchpage = "./search.php";


    $logout = "../php/logout.php";

    echo '
    <div id="nav-wrapper"  style="position: sticky; top: 0; margin: 0; max-height: 75px; overflow: hidden;">
        <nav id="nav">
            <a href="' . (($page !== 'HOMEPAGE') ? $homepage : '#') . '">
                <div class="nav left">
                    <span class="gradient skew"><h1 class="logo un-skew"><img src="../assets/img/logo2.png" style="width: 350px; height: auto; margin-top: 20px;"></h1></span>
                    <button id="menu" class="btn-nav"><span class="fas fa-bars"></span></button>
                </div>
            </a>
            <div class="nav right">
                <a href="' . (($page !== 'CHI SIAMO') ? $chi_siamo : '#') . '" class="nav-link ' . (($page === "CHI SIAMO") ? "active" : "") . '"><span class="nav-link-span"><span class="u-nav">CHI SIAMO</span></span></a>
                <a href="' . (($page !== 'MINDROVER') ? $mindrover : '#') . '" class="nav-link ' . (($page === "MINDROVER") ? "active" : "") . '"><span class="nav-link-span"><span class="u-nav">MINDROVER</span></span></a>
                <a href="' . (($page !== 'CROWDFUNDING') ? $crowdfunding : '#') . '" class="nav-link ' . (($page === "CROWDFUNDING") ? "active" : "") . '"><span class="nav-link-span"><span class="u-nav">CROWDFUNDING</span></span></a>
                <a href="' . (($page !== 'SEARCH') ? $searchpage : '#') . '" class="nav-link ' . (($page === "SEARCH") ? "active" : "") . '"><span class="nav-link-span"><span class="u-nav">CERCA</span></span></a>
                <a href="' . (($page !== 'ACCOUNT') ? $profile : '#') . '" class="nav-link ' . (($page === "ACCOUNT") ? "active" : "") . '"><span class="nav-link-span"><span class="u-nav">GESTIONE ACCOUNT</span></span></a>
            </div>
        </nav>
    </div>
    ';
}
?>