<?php
session_start();
$ganesh = "articolo";
require_once('../php/modules/navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nome articolo</title>

    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="../css/utils/clearsheet.css">
    <link type="text/css" rel="stylesheet" href="../css/utils/bg.css">
    <link type="text/css" rel="stylesheet" href="../css/splash.css">
    <link type="text/css" rel="stylesheet" href="../css/nav.css">
    <link type="text/css" rel="stylesheet" href="../css/fonts.css">
    <link type="text/css" rel="stylesheet" href="../css/containers.css">
    <link type="text/css" rel="stylesheet" href="../css/footer.css">
    <link type="text/css" rel="stylesheet" href="../css/text-container.css">
    <link type="text/css" rel="stylesheet" href="../css/board.css">
    <link type="text/css" rel="stylesheet" href="../css/profile_settings_style.css">
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <style>
        .list-item
        {
            /* flex: 1; */
            display: block;
            height: 17vh;
            padding: 1vh;
            background-color: white;
            background-size: 100% 100%;
            background-position: center;
            transition: .5s;
            border: 0.1vh solid black;
            /* margin-top: 3vh; */
            color: white;
            text-shadow: -1px 1px 2px #000, 1px 1px 2px #000, 1px -1px 0 #000, -1px -1px 0 #000;
            cursor: pointer;
        }

        .list-item:hover{
            background-size: 110% 110%;
        }

        .hh2{
            transition: .5s;
            padding: 1rem; 
            font-family: ganesh; 
            text-transform: uppercase; 
            font-size: medium; 
            text-align: center;
            border: 0.1vh solid black;
        }

        .hh2.titolo{
            background: linear-gradient(45deg, #8f281d, #da4112);
            color: white;
        }

        .hh2.back{
            background-color: whitesmoke;
            color: #da4112;
            cursor: pointer;
            
        }

        .hh2.back:hover{
            background: linear-gradient(45deg, #8f281d, #da4112);
            color: black;
        }

        .example::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE,Edge e Firefox  */
        .example {
            overflow: auto;
            -ms-overflow-style: none;
            scrollbar-width: none; /* Firefox 64 */
        }        

    </style>
</head>
<body>
    <?php
        if(isset($_SESSION['user_id']))
        {
            get_private_navbar($ganesh);
        }
        else
        {
            get_public_navbar($ganesh);
        }
    ?>
    
    <div style="height: 91.5vh; display: grid; grid-template-columns: 15fr 5fr;">
        <div class="example" style="overflow-y: scroll; padding: 3rem; background-image: url('../assets/img/news-rane.jpg'); background-repeat: no-repeat; background-size: cover">
            <div style="background-color: rgba(173, 216, 230, 0.50); min-height: 15vh; padding: 0.5rem 2rem; line-height: 2.5rem; display: grid; grid-template-rows: 1fr 1fr">
                <h1 style="font-family: ganesh; text-align: center">Perchè non mi fate vedere le tette della Pausini?</h1>
                <p style="font-family: ganesh; text-align: center; padding-bottom: 1vh">Tanto non ho niente da perdere</p>
                <div style="display: flex; flex-direction: column-reverse"><p><i>Mentato Raizzia</i> || 12/12/2012 || 
                <span class="userinfo-tag tag-tag"><i class="fas fa-frog"></i> mentato </span> <span class="userinfo-tag tag-tag"><i class="fas fa-frog"></i> raizzia </span> <span class="userinfo-tag tag-tag"><i class="fas fa-frog"></i> piattinelculo </span></p> 
                </div>
            </div>
            <div style=" background-color: rgba(250, 250, 210, 0.5); padding: 1rem; margin-top: 2rem; margin-bottom: 1rem;">
                <i>Ma se la gente dice che la Conad sei tu, allora perchè stai chiamando la polizia?<br>
                Stavo solo cercando di rubarti il frigorifero, troia.</i>
                <br>
                Sriracha air plant roof party cold-pressed. Fanny pack authentic literally kogi ramps skateboard poutine fashion axe everyday carry selvage before they sold out unicorn. Coloring book everyday carry plaid single-origin coffee. Slow-carb kitsch readymade, tofu church-key blog selvage. Slow-carb YOLO cardigan brunch, biodiesel ennui palo santo blog retro.
                <br>
                Migas four loko paleo biodiesel vaporware small batch. Organic hell of listicle pitchfork bespoke before they sold out chia mumblecore. Four loko waistcoat tattooed DIY. Vegan poutine four dollar toast taiyaki. Scenester vice venmo coloring book before they sold out.
                <br>
                Letterpress viral thundercats adaptogen cliche hella lo-fi af, shoreditch glossier hammock selfies. Shabby chic lumbersexual fanny pack 3 wolf moon, twee crucifix slow-carb scenester lyft. Man braid letterpress pug, williamsburg marfa direct trade wolf enamel pin succulents pop-up kombucha chartreuse fanny pack blog. Mustache squid flexitarian prism cred. Master cleanse mixtape pinterest art party. Chicharrones migas kombucha YOLO blog swag keytar hoodie pug 8-bit truffaut mixtape. Yuccie raw denim chambray cronut.
                <br>
                Kitsch occaecat pitchfork prism hoodie, shaman coloring book. Artisan succulents four loko helvetica palo santo, wayfarers art party 8-bit salvia vaporware ea pinterest kogi velit fixie. Single-origin coffee keffiyeh taxidermy raw denim viral occaecat cray migas mumblecore street art. Activated charcoal live-edge art party, fashion axe portland chicharrones squid deep v pug small batch scenester lomo tilde twee knausgaard.
                <br>
                Officia brooklyn fam 3 wolf moon, cliche cray selvage pabst cred gochujang glossier kombucha. Dolore waistcoat street art, occupy nostrud man bun pariatur 3 wolf moon. Snackwave bitters actually, fixie nulla ea fugiat flannel crucifix. Organic bicycle rights fixie dolore aliqua migas. Ex kinfolk meggings woke.
                <br>
                Nel dubbio, Ark bastardo.
                <br>
                Adaptogen chartreuse excepteur microdosing wayfarers, elit street art aute food truck man braid consequat. Raw denim try-hard fashion axe coloring book plaid viral. Edison bulb skateboard microdosing, listicle hella jean shorts green juice chillwave brooklyn PBR&B bicycle rights duis. Offal yuccie dolor swag fam eiusmod cillum gochujang.
                <br>
                Narwhal authentic direct trade food truck, drinking vinegar polaroid put a bird on it. Blue bottle copper mug readymade green juice cornhole vinyl enim. Shaman williamsburg cray coloring book man bun. Knausgaard ad hashtag distillery VHS dreamcatcher, tattooed banh mi yr chillwave you probably haven't heard of them schlitz air plant cupidatat. Mlkshk woke tattooed non, fashion axe ugh literally four dollar toast ullamco.
                <br>
                Irony ethical woke cliche typewriter poutine. Migas non YOLO nulla aliqua small batch, fanny pack edison bulb vinyl offal exercitation direct trade chicharrones. Mlkshk nulla gentrify, raclette blue bottle vape culpa ex dolore vice dreamcatcher DIY cornhole affogato brooklyn. Nisi squid farm-to-table fugiat microdosing portland.
                <br>
                Banjo brooklyn austin sriracha, selfies subway tile meditation sunt meggings. Duis cred wolf readymade bushwick hoodie meggings shaman etsy stumptown ex. Pop-up non ramps ugh, affogato twee green juice post-ironic man bun pug activated charcoal. Nulla knausgaard roof party, ramps letterpress iceland seitan. Lo-fi dreamcatcher kombucha activated charcoal. Vinyl brooklyn jean shorts man bun direct trade fanny pack.
                <br>
                Wayfarers dolore la croix vice, tempor master cleanse poke tumblr narwhal mlkshk succulents adipisicing. Kombucha semiotics master cleanse prism, stumptown authentic jean shorts dolore live-edge ipsum eiusmod et tote bag shaman. Gluten-free laboris chia proident readymade. Aute brunch chambray, affogato DIY vice ipsum cliche fugiat church-key blue bottle. Mixtape cold-pressed swag incididunt unicorn fanny pack snackwave keytar culpa post-ironic hammock echo park artisan esse.
                <br>
                Four dollar toast labore poutine +1 8-bit kickstarter. Flannel listicle fashion axe tempor reprehenderit. Aesthetic tousled sustainable, actually raw denim cliche hot chicken letterpress cornhole subway tile. Yr salvia nulla sunt meh adipisicing williamsburg, af pitchfork ullamco sriracha in raclette.
                <br>
                Thundercats 3 wolf moon qui pug vinyl actually quis waistcoat. Voluptate laboris hoodie ipsum organic marfa hell of biodiesel. Aute cronut la croix, polaroid locavore cardigan vaporware nostrud iceland meh. Est vegan aliqua, banjo next level live-edge cliche affogato vape cold-pressed polaroid blog cardigan chartreuse taiyaki.
                <br>
                Enim semiotics nostrud voluptate cronut authentic non trust fund esse 3 wolf moon adipisicing. Actually occaecat lumbersexual pour-over echo park, sartorial nulla letterpress aliqua prism kitsch knausgaard direct trade tofu minim. Locavore magna taxidermy mlkshk ugh bespoke. Knausgaard live-edge pok pok, offal voluptate authentic plaid vape crucifix skateboard excepteur flexitarian +1 sed la croix.
                <br>
                Distillery XOXO deserunt, poke swag reprehenderit copper mug iPhone cold-pressed direct trade ut qui jean shorts heirloom. Adipisicing whatever iPhone, cronut tattooed edison bulb shabby chic non man braid ut viral tilde literally. Lyft knausgaard keytar glossier shaman poke squid. Air plant yr jean shorts ullamco gentrify pok pok single-origin coffee VHS cloud bread officia next level humblebrag. Gentrify scenester sartorial, vape unicorn try-hard ugh hella tacos chambray culpa meggings vaporware cloud bread mumblecore. Single-origin coffee incididunt everyday carry, offal dolore VHS elit next level mlkshk cloud bread PBR&B shabby chic ethical selvage. Consectetur street art readymade, shoreditch pickled humblebrag hammock.
                <br>
                Blog normcore offal, humblebrag wolf taiyaki lyft aesthetic jean shorts in asymmetrical portland gentrify direct trade. Lumbersexual mlkshk duis squid taxidermy bitters. Freegan VHS fam vinyl eiusmod jean shorts post-ironic quis voluptate adaptogen seitan sed. Unicorn iceland veniam artisan butcher eiusmod enim glossier aute. Snackwave migas lorem, sed cronut disrupt roof party vaporware dolore. Hammock id sustainable in next level kogi iPhone fanny pack anim nostrud woke stumptown fingerstache raw denim.
                <br>
                Tempor stumptown hella tilde authentic. Tote bag hashtag cray echo park cillum mixtape. Asymmetrical four loko master cleanse swag next level intelligentsia. Gentrify typewriter quis deserunt, vegan kickstarter shabby chic post-ironic mixtape sint keffiyeh. Flexitarian meh cornhole distillery single-origin coffee. Consequat poke cronut, tbh cardigan try-hard ex lorem qui.
                <br>
                Knausgaard poke ad hella. Vice lo-fi scenester vegan hell of dolor qui lorem in glossier messenger bag heirloom elit. Quinoa normcore sunt, lomo subway tile pariatur incididunt XOXO flexitarian portland. Tempor vinyl lomo heirloom truffaut officia. Vice farm-to-table pickled synth venmo food truck deep v umami artisan leggings.
                <br>
                Ut microdosing cloud bread 8-bit palo santo cornhole tempor enamel pin, tousled viral meggings ipsum. Yr artisan paleo actually sustainable mollit mlkshk roof party echo park. Shabby chic shaman banh mi marfa, farm-to-table stumptown franzen gastropub kinfolk lorem duis brooklyn. Freegan gastropub farm-to-table consequat try-hard, magna etsy in voluptate salvia lyft master cleanse lumbersexual cardigan. Edison bulb normcore hoodie, single-origin coffee pop-up try-hard cillum dolore officia dolor nostrud tumblr four loko marfa etsy. Fanny pack heirloom blue bottle in viral. Irure laboris ugh, lorem artisan ut fashion axe minim.
                <br>
                Letterpress slow-carb pour-over, skateboard mixtape chartreuse lorem banjo selvage cornhole. Cliche salvia knausgaard air plant tilde sunt tacos helvetica. Coloring book four dollar toast kogi mumblecore glossier. Shaman laborum gastropub gluten-free. Chia culpa chillwave stumptown, YOLO in magna adaptogen intelligentsia dolor kogi you probably haven't heard of them prism biodiesel. Actually incididunt hexagon, single-origin coffee street art godard try-hard sint keffiyeh bitters drinking vinegar fingerstache.
                <br>
                Cillum shoreditch 3 wolf moon, synth gentrify neutra street art. Knausgaard kogi kitsch fixie yr vice XOXO cronut mustache organic umami aliquip disrupt normcore tacos. Yr veniam messenger bag, exercitation health goth shaman man bun. Flannel kinfolk chicharrones ugh godard. In chillwave tilde laborum church-key pickled. Vexillologist adaptogen cronut ut enim, taiyaki twee semiotics.
                <br>
                Man braid butcher whatever 8-bit swag mustache microdosing dolore eiusmod, helvetica fingerstache drinking vinegar pabst. Ennui hammock pinterest gastropub quinoa, DIY air plant kale chips kinfolk et kitsch raclette actually tote bag. Iceland yr edison bulb tattooed distillery quinoa gochujang dolore ut commodo nisi sunt. Dreamcatcher skateboard semiotics, lo-fi ipsum ut proident shoreditch adaptogen commodo in irure hell of kombucha anim. Flexitarian bushwick chartreuse paleo post-ironic cold-pressed live-edge polaroid id shaman incididunt. 8-bit duis wayfarers disrupt. Stumptown minim ad voluptate, actually readymade meditation put a bird on it pabst non 8-bit try-hard.
                <br>
                Id heirloom humblebrag, intelligentsia pok pok narwhal wolf beard shabby chic ipsum. Cray crucifix ad chambray whatever la croix irure tacos vinyl 8-bit voluptate. Franzen ipsum pickled, selvage mustache butcher swag deep v dolor pabst. Cray yr ea, pug knausgaard taxidermy typewriter XOXO hella actually.
                <br>
                Hell of umami church-key bitters kinfolk poutine. Hella vaporware you probably haven't heard of them tilde laboris aute pork belly pitchfork la croix selvage in godard. You probably haven't heard of them mustache affogato live-edge, fashion axe franzen schlitz shabby chic etsy aesthetic. Franzen post-ironic activated charcoal yr hella. Ullamco selfies SWAG BARCA actually. Ugh sartorial kitsch, enim PBR&B forage man braid stumptown godard yuccie butcher biodiesel officia taxidermy tilde. Id aesthetic vexillologist retro
            </div>
        </div>
        <div style="display: flex; flex-direction: column;">
            <div class="hh2 titolo">Altri interessantissimi articoli</div>
            <div style="display: flex; flex-direction: column;">
                <div class="list-item" style="background-image: url('../assets/img/news-rane.jpg');">Alla scoperta di Bella Rena, il videogioco autobiografico di Gregghy.</div>
                <div class="list-item" style="background-image: url('../assets/img/news-vr.jpg');">Ma se ti seghi con mindROVER poi dove sborri?</div>
                <div class="list-item" style="background-image: url('../assets/img/news-work.jpg');">Ma quando muori lo sai che l'unico reame che vedrai è largo 2 e profondo 6?</div>
                <div class="list-item" style="background-image: url('../assets/img/news-volante.jpg');">Lo sai che MATTONE DOPO MATTONE DOPO MATTONE queste mura iniziano a cadere?</div>
            </div>
            <div class="hh2 back" onclick="location.href='../HTML/search.php';">Torna alla pagina di ricerca</div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer-container footer-bg"> 
        <div class="footer-content">

            <img src="../assets/img/logo.png" style="height: 11vh;">   
            <img src="../assets/img/unige.png" alt="Unige" style="height: 10vh;">
            <i class="fab fa-facebook-square d"></i>
            <i class="fab fa-youtube d"></i>
            <i class="fab fa-instagram d"></i>
            <i class="fas fa-envelope d"></i>
            <br>
            <span style="font-size: 0.8rem; letter-spacing: normal;">©2020 Frog Studios, Inc. Tutti i diritti riservati. mindROVER©, 
            Golarion©, Toad of Duty© sono proprietà intelletuali di Frog Studios, Inc.</span>
            
        </div>
    </div>
</body>
</html>