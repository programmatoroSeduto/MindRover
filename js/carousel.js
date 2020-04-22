let i=0;

function changeImg()
{
    let imgs = ['../assets/img/home-splash.jpg', '../assets/img/Alieni.jpg', '../assets/img/Nebulosa.jpg'];
    let txt = ['mindROVER è il nostro progetto più ambizioso, la realtà virtuale più... reale che abbiate mai visto. Un comodo sistema composto unicamente da un casco ergonomico, in totale sicurezza. ',
    'frase stupida 1',
    'frase stupida 2'];

    i = (i + 1) % imgs.length;
    $('#carousel').css({"background-image":"url(" + imgs[i] + ")"});
    $('#splashtext').text(txt[i]);
}