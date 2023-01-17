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

    $("#search").on('input', function(e) {
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

        $.ajax({
            url: route, // formoje nurodome action
            method: 'POST', // metodas bus GET
            data: {
                student_name: $('#student_name').val(),
                surname: $('#surname').val(),
                email: $('#email').val(),
                avg_grade: $('#avg_grade').val()
            }, 
            dataType: 'JSON', 
            success:function(response) {
                
                //sekme - response.success
                //klaida - response.success elemento netures

                if(response.success) {
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
    
                    $('#student_name').val('');
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
                } else {



                    $('#student_name').removeClass('is-invalid');
                    $('#surname').removeClass('is-invalid');
                    $('#email').removeClass('is-invalid');
                    $('#avg_grade').removeClass('is-invalid');

                    $('.error_student_name').html('');
                    $('.error_surname').html('');
                    $('.error_email').html('');
                    $('.error_avg_grade').html('');

                    //response.errors
                    // kaireje puse mes turime laukeliu vardus desineje mes turime klaidu pranesimus
                    //errors
//: 
// {student_name: ["The student name field is privalomas."],…}
// avg_grade
// : 
// ["The avg grade field is privalomas."]
// email
// : 
// ["The email field is privalomas."]
// student_name
// : 
// ["The student name field is privalomas."]
// surname
// : 
// ["The surname field is privalomas."]
                    //foreach($respone->errors as $key => $value)                    
                    $.each(response.errors, function(key, value){
                        //key yra laukelio vardas
                        $('#'+key).addClass('is-invalid');
                        $('.error_' + key).html('<strong>'+value[0]+'</strong>');
                        console.log(key);//laukelio varda kuriame ivyko klaida
                    })

                    console.log('Klaida');
                }

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

    $('.edit-button').on('click', function(e){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //atidaro modalini langa
        // kai mes uzdedinejame mygtukui funkcionaluma, kuris jau kazka atlieka, gali ivykti konfliktas
        //( arba veiks mano aparsytas funkcionalumas, arba veiks defaultinis funkcionalumas)

        //jeigu nebus konflikot - tiek aprasytas mano funkcionalumas, tiek modalo atsidarymas.

        // console.log('edit button clicked');

        //1. 'sugadinti' edit mygtuka, kad jis neattidarytu modalo.
        //2. modalo atidaryma suprogramuoti sioje funkcijoje
        var student_id = $(this).attr('data-student-id');
        var route = $(this).attr('data-ajax-action-url')+'?student_id='+student_id;
        // console.log(student_id);


        $.ajax({
            url: route,
            method: 'GET', 
            
            dataType: 'JSON', 
            processData: false,
            contentType: false,
            cache: false,
            success:function(response) {
                // console.log(response);
                $('#student_id').val(response.id);
                $('#edit_student_name').val(response.name);
                $('#edit_student_surname').val(response.surname);
                $('#edit_student_email').val(response.email);
                $('#edit_student_avg_grade').val(response.avg_grade);

            },
            error:function(response) {
                console.log(response); //404- nerasta
            },
        });


    });

    $('#editStudent').on('click', function(e) {
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        var route = $('#ajaxEdit').attr('data-ajax-action-url'); //

        $.ajax({
            url: route, // formoje nurodome action
            method: 'POST', // metodas bus GET
            data: {
                student_id: $('#student_id').val(),
                edit_student_name: $('#edit_student_name').val(),
                edit_student_surname: $('#edit_student_surname').val(),
                edit_student_email: $('#edit_student_email').val(),
                edit_student_avg_grade: $('#edit_student_avg_grade').val()
            }, 
            dataType: 'JSON', 
            success:function(response) {
                console.log(response);

                // var tr = $('.student' + response.id);
                //student_name
                // tr.find('.student_name').html(response.name);
                // tr.find('.student_surname').html(response.name);
                // tr.find('.student_email').html(response.name);
                // tr.find('.student_avg_grade').html(response.name);

                $('.student'+$('#student_id').val()+' .student_name').text(response.student.name);
                $('.student'+$('#student_id').val()+' .student_surname').text(response.student.surname);
                $('.student'+$('#student_id').val()+' .student_email').text(response.student.email);
                $('.student'+$('#student_id').val()+' .student_avg_grade').text(response.student.avg_grade);


                var modal = $('#studentEditModal');
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

    $('.addStudentCount').on('click', function(e) {
        var studentsCreateTable = $('.studentsCreateTable');
        var studentTemplate = $('.studentTemplate');
        studentsCreateTable.append(studentTemplate.html());
    })


    //Javascriptas seka pokycius elemente studentsCreateTable
    $('.studentsCreateTable').on('click','.minusStudentCount', function(e) {

        var button = $(this); //mygtukas paspaustas

        
        // button.parent() - div col-1
        //button.parent().parent(); - div row
        // console.log(button.parent().parent());

        button.parent().parent().remove();
    });

    $('.saveAllStudents').on('click',function(e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        var route = $(this).attr('data-ajax-action-url'); //

        //student_name visus studentu vardus is visu input kuriu vardas yra students_name[] iskyrus studentTemplate

        var student_name = $('.studentsCreateTable input[name="student_name[]"]');
        var student_surname = $('.studentsCreateTable input[name="student_surname[]"]');
        var student_email = $('.studentsCreateTable input[name="student_email[]"]');
        var student_avg_grade = $('.studentsCreateTable input[name="student_avg_grade[]"]');



        var student_name_array = [];
        $.each(student_name, function(key, nameInput ) {
            student_name_array.push(nameInput.value);
            
        })

        var student_surname_array = [];
        $.each(student_surname, function(key, surnameInput ) {
            student_surname_array.push(surnameInput.value);           
        })

        var student_email_array = [];
        $.each(student_email, function(key, emailInput ) {
            student_email_array.push(emailInput.value);           
        })

        var student_avg_grade_array = [];
        $.each(student_avg_grade, function(key, avgGradeInput ) {
            student_avg_grade_array.push(avgGradeInput.value);           
        })

        

        // console.log(student_name);



        console.log(route);

        $.ajax({
            url: route, // formoje nurodome action
            method: 'POST', // metodas bus GET
            data: {
                student_name: student_name_array,
                 student_surname: student_surname_array,
                student_email:  student_email_array,
                student_avg_grade: student_avg_grade_array,
            }, 
            dataType: 'JSON', 
            success:function(response) {
                $('.studentsCreateTable .row input').removeClass('is-invalid');
                //css selectoriujue skaiciuojam zmogiskai tai yra nuo 1
                // 2 eilute 3 stulpeli
                
                //var key_array = [];// error masyvo indeksai
                
                // foreach ($response->errors as $key =>$value)
                //yra zinutes reiksme
                $.each(response.errors, function(key, value) {
                    //key_array.push(key);

                    var col = key.split('.')[0];
                    var row = parseInt(key.split('.')[1]) + 1; // css skaiciuoja nuo 1
                    $('.studentsCreateTable .row:nth-child('+row+') input[name="'+ col+'[]"]').addClass('is-invalid');

                    //vienos klaidos atvaizdavimui !!!! Pamastyti, kaip atvaizduot kelias. KLAIDOS GALI GRIZTI KELIOS!!!!!
                    $('.studentsCreateTable .row:nth-child('+row+') input[name="'+ col+'[]"]').next().html('<strong>'+value[0]+'</strong>');



                });

                //key_array = [student_avg_grade.0, student_email.0, student_name.0, student_surname.0, 
                // student_avg_grade.1, student_email.1, student_name.1, student_surname.1 ...]
                // explode(student_avg_grade.0, '.') = [
                // 0,col => student_avg_grade
                // 1,row => 0
                //]

                // mes jame prarandam zinutes reiksme
                // $.each(key_array, function(key, value) { 
                //     //padalinu teksto reiksme pagal .
                //     // explode funkcijai yra lygi split funkcija
                //        var col = value.split('.')[0];
                //         var row = parseInt(value.split('.')[1]) + 1; // css skaiciuoja nuo 1
                //             $('.studentsCreateTable .row:nth-child('+row+') input[name="'+ col+'[]"]').addClass('is-invalid');
                //             // $('.studentsCreateTable .row:nth-child('+row+') input[name="'+ col+'[]"]') - input
                //             //  css selectorius kuris pasirenka salia esanti elementa
                //             $('.studentsCreateTable .row:nth-child('+row+') input[name="'+ col+'[]"]').next().html('<strong>Klaida</strong>');


                // });


               // $('.studentsCreateTable .row:nth-child(2) input[name="student_email[]"]').addClass('is-invalid');




                console.log(response);
            },
            error:function(response) {
                console.log(response); //404- nerasta
            },
        });
    })

});