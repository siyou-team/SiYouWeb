
$(function() {
    if( getCookie('lang') != "" ){
        $("[data-localize]").localize( {pathPrefix: "lang",anguage: getCookie('lang')});
    } else {
        var language = (navigator.language || navigator.browserLanguage);
        console.log( language );
        $("[data-localize]").localize( {pathPrefix: "lang",anguage: language} );
    }
});