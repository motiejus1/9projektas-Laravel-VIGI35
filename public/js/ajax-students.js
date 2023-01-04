//paleisk skripta tik tada kai puslapis pilnai uzsikrove
// mums javascript gali nerasti input ir apskritai neveikti
//javascript pradeda veikti iskart ijungus puslapi
$(document).ready(function() {

    // document.querySelector("#ajaxSearch")
    // document.getElementById('ajaxSearch')

    // document.querySelector("#ajaxSearch").addEventListener('submit',function(e){
// 
    // })


    // $.ajax({ JQuery ajax nera paprastos javascript alternatyvos

    // # - id
    // . - class

    $('#ajaxSearch').on('submit', function(e){
        e.preventDefault();

        var route = $(this).attr('data-ajax-action-url'); //
        var method ='GET';



        console.log(new FormData(this));

        // FormData - perkelia visus duomenis is formos i JSON objekta
        // visi duomenys kurie yra formos inputuose pavirs i JSON objekta

        $.ajax({
            url: route, // formoje nurodome action
            method: method, // metodas bus GET
            data: new FormData(this),
            dataType: 'json', // numatytasis JSON, priklausomai nuo jqeury versijos gali skirtis sis numatytasis nustatymas XML
            //forma su persikrovimu mums grizta HTML, HTML reikalingas tam tikras duomenu apdorojimas
            // JSON duomenis kuriu apdoroti NEREIKIA !!!!! processData: false
            processData: false,
            success:function(response) {

                // response - tai yra JSON objektas
                // response == $students siuo atveju. Surasti studentai
                console.log(response);
            },
            error:function(response) {
                console.log(response); //404- nerasta
            },
        });

        console.log(route);

    });

});