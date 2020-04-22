<?php
function get_public_navbar($page) 
{
    echo '
    <div id="nav-wrapper"  style="position: sticky; top: 0; margin: 0; max-height: 75px; overflow: hidden;">
        <nav id="nav">
            <a href="../HTML/homepage.html">
                <div class="nav left">
                    <span class="gradient skew"><h1 class="logo un-skew"><img src="../assets/img/logo2.png" style="width: 350px; height: auto; margin-top: 20px;"></h1></span>
                    <button id="menu" class="btn-nav"><span class="fas fa-bars"></span></button>
                </div>
            </a>
            <div class="nav right">
                <a href="../HTML/frogstudios.html" class="nav-link ' . (($page === "CHI SIAMO") ? "active" : "") . '"><span class="nav-link-span"><span class="u-nav">CHI SIAMO</span></span></a>
                <a href="../HTML/mindrover.html" class="nav-link ' . (($page === "MINDROVER") ? "active" : "") . '"><span class="nav-link-span"><span class="u-nav">MINDROVER</span></span></a>
                <a href="../HTML/crowdfunding.html" class="nav-link ' . (($page === "CROWDFUNDING") ? "active" : "") . '"><span class="nav-link-span"><span class="u-nav">CROWDFUNDING</span></span></a>
                <a href="#log" class="nav-link"><span class="nav-link-span"><span class="u-nav">ACCEDI</span></span></a>
            </div>
        </nav>
    </div>
    ';
}
?>