


//visualizza questo 'risultato' quando il motore di ricerca ritorna un insieme vuoto di dati
var no_results = '<div class="result-item-article">'+
                    '<div style="display: grid; text-align: center; margin: auto;"><i class="fas fa-exclamation" style="font-size: 4rem;"></i></div>'+
                    '<div style="background-color: green; padding: 1rem;">'+
                        '<div style="line-height: 2.3rem;">'+
                            '<h1>Nessun risultato!</h1>'+
                            '<h2>di <i>KungKurth</i></h2>'+
                        '</div>'+
                        '<br>'+
                        '<p>Eh sì! Non bastava un semplice messaggio. Abbiamo persino scritto un articolo a riguardo. </p>'+
                    '</div>'+
                '</div>';



//ritorna l'oggetto da inviare al server sotto forma di json
function getSearchData()
{   /*
    //la richiesta json da inserire nella richiesta 'request'
    var json_request = function(){};

    //usa ricerca totale?
    var use_all_data = false;
    if($('#use_all_data').is(':checked'))
    {
        json_request.use_all_data = 1;
        use_all_data = true;
    }
    
    //tipo di ricerca
    json_request.search_type = $('#search_type').val();

    //modalità strict
    if($('#strict').is(':checked'))
        json_request.strict = 1;

    //per la ricerca per articoli
    if((json_request.search_type === 'article' || json_request.search_type === 'all') && !use_all_data)
    {
        json_request.a_title = $('#a_title').val();
        json_request.a_tags = $('#a_tags').val().replace(/\s+/g, ' ').trim().split(' ').filter(function(item, pos, self){return self.indexOf(item) == pos;}).join(';');
        json_request.a_content = $('#a_content').val();
        json_request.a_min_timestamp = $('#a_min_timestamp').val();
        json_request.a_max_timestamp = $('#a_max_timestamp').val();
        json_request.a_author = $('#a_author').val();
    }

    //per la ricerca per utenti
    if((json_request.search_type === 'article' || json_request.search_type === 'all') && !use_all_data)
    {
        json_request.u_nickname = $('#u_nickname').val();
    }
    */
    var json_request = {
        'use_all_data' : ($('#use_all_data').is(':checked') ? 1 : 0),
        'search_type' : $('#search_type').val(),
        'strict' : ($('#strict').is(':checked') ? 1 : 0),
        'a_title' : $('#a_title').val(),
        'a_tags' : $('#a_tags').val().replace(/\s+/g, ' ').trim().split(' ').filter(function(item, pos, self){return self.indexOf(item) == pos;}).join(';'),
        'a_content' : $('#a_content').val(),
        'a_min_timestamp' : $('#a_min_timestamp').val(),
        'a_max_timestamp' : $('#a_max_timestamp').val(),
        'a_author' : $('#a_author').val(),
        'u_nickname' : $('#u_nickname').val()
    };

    return json_request;
}



//esegue la ricerca
function search()
{
    //dati da inviare al server
    console.log(getSearchData());
    var json_data =  JSON.stringify(getSearchData());
    //console.log(json_data);

    //richiesta
    $.ajax({
        url : '../php/search_engine.php',
        method : 'GET',
        data : 
        {
            use_interface : 'json',
            json : json_data
        },
        success : showResults
    });
}



//applica nella pagina i risultato della ricerca effettuata
function showResults(data)
{
    data = JSON.parse(data);
    if(data.lenght > 0)
    {
        //trovati dal motore di ricerca
        var result = data.content;

        result.forEach(r => {
            console.log(r);
        });
    }
    else
    {
        //nessun risultato
    }
}


//ritorna l'html per un utente
function getUserHTML(user_info)
{

}


//ritorna l'html per un articolo
function getArticleHTML(article_data)
{
    
}