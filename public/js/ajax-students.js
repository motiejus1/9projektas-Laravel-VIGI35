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


    function getFormData($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};
    
        $.map(unindexed_array, function(n, i){
            indexed_array[n['name']] = n['value'];
        });
    
        return indexed_array;
    }

    // Events

    // mygtuko paspaudimas
    //pelytes kito klaviso paspaudimas
    //puslapio nuscrolinimas(nuvedimas zemyn)

    //change - ekrano pasikeitima


    //keyup - kai paspaudziama bet kuri klavisa

    $("#search").on('keyup', function(e) {
        var route = $('#ajaxSearch').attr('data-ajax-action-url')+'?search='+$(this).val(); //
        var method ='GET';


        // console.log(new FormData(this));

        // FormData - perkelia visus duomenis is formos i JSON objekta
        // visi duomenys kurie yra formos inputuose pavirs i JSON objekta

        $.ajax({
            url: route, // formoje nurodome action
            method: 'GET', // metodas bus GET
            //data: new FormData(this), //POST metodui
            dataType: 'JSON', // numatytasis JSON, priklausomai nuo jqeury versijos gali skirtis sis numatytasis nustatymas XML
            //forma su persikrovimu mums grizta HTML, HTML reikalingas tam tikras duomenu apdorojimas
            // JSON duomenis kuriu apdoroti NEREIKIA !!!!! processData: false
            processData: false,
            contentType: false,
            cache: false,
            success:function(response) {

                // response - tai yra JSON objektas
                // response == $students siuo atveju. Surasti studentai
                //console.log(response);

                var tbody = $('.students');
                
                tbody.html('');
                var generatedHtml = '';
                for (var i = 0; i < response.length; i++) {
                    generatedHtml += '<tr>';
                    generatedHtml += '<td>'+response[i].id+'</td>';
                    generatedHtml += '<td>'+response[i].name+'</td>';
                    generatedHtml += '<td>'+response[i].surname+'</td>';
                    generatedHtml += '<td>'+response[i].email+'</td>';
                    generatedHtml += '<td>'+response[i].avg_grade+'</td>';
                    generatedHtml += '</tr>';
                }
                tbody.append(generatedHtml);

            },
            error:function(response) {
                console.log(response); //404- nerasta
            },
        });

        console.log(route);
    });


     // blogai var csrf = $('meta[name="csrf-token"]').attr('content');

    $('#createStudent').on('click', function(e) {
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        var route = $('#ajaxCreate').attr('data-ajax-action-url'); //
        var method='POST';

        // var data = {
        //    //blogai _token: csrf,
        //     student_name:  $('#name').val(),
        //     surname: $('#surname').val(),
        //     email: $('#email').val(),
        //     avg_grade: $('#avg_grade').val(),
        // };


        $.ajax({
            url: route, // formoje nurodome action
            method: 'POST', // metodas bus GET
            data: {
                student_name: $('#name').val(),
                surname: $('#surname').val(),
                email: $('#email').val(),
                avg_grade: $('#avg_grade').val()
            }, //POST metodui
            dataType: 'JSON', // numatytasis JSON, priklausomai nuo jqeury versijos gali skirtis sis numatytasis nustatymas XML
            //forma su persikrovimu mums grizta HTML, HTML reikalingas tam tikras duomenu apdorojimas
            // JSON duomenis kuriu apdoroti NEREIKIA !!!!! processData: false
            //post metodas - proccessData: false

            //POST metodas duomenu bazes irasymui
            // POST gali grazinti arba HTML, arba JSON arba paprastu tekstu
            success:function(response) {
                


                // 1. kai paspaudziamas create mygtukas, uzdaryti modal langa x
                // 2. prie tbody prideti studenta 
                // 3. isvalyti formos laukus
                // 4. isvalyti klaidu pranesimus
                // 5. ir atvaizduoti sekmes pranesima                
                var tbody = $('.students');
                var generatedHtml = '';
                generatedHtml += '<tr>';
                generatedHtml += '<td>'+response.student.id+'</td>';
                generatedHtml += '<td>'+response.student.name+'</td>';
                generatedHtml += '<td>'+response.student.surname+'</td>';
                generatedHtml += '<td>'+response.student.email+'</td>';
                generatedHtml += '<td>'+response.student.avg_grade+'</td>';
                generatedHtml += '</tr>';
                tbody.append(generatedHtml);

                $('#name').val('');
                $('#surname').val('');
                $('#email').val('');
                $('#avg_grade').val('');

                var modal = $('#studentCreateModal');
                modal.modal('hide');

                alert = $('.alert');
                alert.removeClass('d-none');
                alert.html('');
                alert.removeClass('alert-danger');
                alert.addClass('alert-success');
                alert.html(response.success);





            },
            error:function(response) {
                console.log(response); //404- nerasta
            },
        });

        // console.log(data);


    })


    //150 kazkiek
    $('.delete-button').on('click', function(e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        


        var student_id = $(this).attr('data-student-id');
        var route=$(this).attr('data-ajax-action-url');

        $.ajax({
            url: route, // formoje nurodome action
            method: 'POST', // metodas bus GET
            data: {
                student_id: student_id,
            }, //POST metodui
            dataType: 'JSON', // numatytasis JSON, priklausomai nuo jqeury versijos gali skirtis sis numatytasis nustatymas XML
            //forma su persikrovimu mums grizta HTML, HTML reikalingas tam tikras duomenu apdorojimas
            // JSON duomenis kuriu apdoroti NEREIKIA !!!!! processData: false
            //post metodas - proccessData: false

            //POST metodas duomenu bazes irasymui
            // POST gali grazinti arba HTML, arba JSON arba paprastu tekstu
            success:function(response) {
                console.log(response)
                console.log(student_id)

                var tr = $('.student' + student_id); //kuri studenta tryneme
                tr.remove();

                alert = $('.alert');
                alert.removeClass('d-none');
                alert.html('');
                alert.removeClass('alert-danger');
                alert.addClass('alert-success');
                alert.html(response.success);
            },
            error:function(response) {
                console.log(response); //404- nerasta
            },
        });
    })


    // $('#ajaxSearch').on('submit', function(e){
    //     e.preventDefault();

    //     var route = $(this).attr('data-ajax-action-url')+'?search='+$('#search').val(); //
    //     var method ='GET';


    //     // console.log(new FormData(this));

    //     // FormData - perkelia visus duomenis is formos i JSON objekta
    //     // visi duomenys kurie yra formos inputuose pavirs i JSON objekta

    //     $.ajax({
    //         url: route, // formoje nurodome action
    //         method: 'GET', // metodas bus GET
    //         //data: new FormData(this), //POST metodui
    //         dataType: 'JSON', // numatytasis JSON, priklausomai nuo jqeury versijos gali skirtis sis numatytasis nustatymas XML
    //         //forma su persikrovimu mums grizta HTML, HTML reikalingas tam tikras duomenu apdorojimas
    //         // JSON duomenis kuriu apdoroti NEREIKIA !!!!! processData: false
    //         processData: false,
    //         contentType: false,
    //         cache: false,
    //         success:function(response) {

    //             // response - tai yra JSON objektas
    //             // response == $students siuo atveju. Surasti studentai
    //             //console.log(response);

    //             var tbody = $('.students');
                
    //             tbody.html('');
    //             var generatedHtml = '';
    //             for (var i = 0; i < response.length; i++) {
    //                 generatedHtml += '<tr>';
    //                 generatedHtml += '<td>'+response[i].id+'</td>';
    //                 generatedHtml += '<td>'+response[i].name+'</td>';
    //                 generatedHtml += '<td>'+response[i].surname+'</td>';
    //                 generatedHtml += '<td>'+response[i].email+'</td>';
    //                 generatedHtml += '<td>'+response[i].avg_grade+'</td>';
    //                 generatedHtml += '</tr>';
    //             }
    //             tbody.append(generatedHtml);

    //         },
    //         error:function(response) {
    //             console.log(response); //404- nerasta
    //         },
    //     });

    //     console.log(route);

    // });

});