<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta name="csrf-token" content="{{ csrf_token() }}"/>
{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">




    <title>{{ config('app.name', 'ITresources') }}</title>

{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/"/>

{{--    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('plugins/images/favicon.png')}}">--}}

    <link href="{{asset('css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/myStyle.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet" />

</head>
<body>
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
     data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header " data-logobg="skin6">

                <a class="navbar-brand" href="{{ route('Dashboard') }}">

                    <b class="logo-icon">

                        <img src="{{asset('plugins/images/orange-01.png')}}" alt="homepage"/>
                    </b>

                </a>

                <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                   href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            </div>

            <div class="navbar-collapse collapse admin-nav" id="navbarSupportedContent" data-navbarbg="skin5">


                <ul class="navbar-nav ms-auto d-flex align-items-center">


                    <li class=" in">
{{--                        <form role="search" class="app-search d-none d-md-block me-3">--}}
{{--                            <input type="text" placeholder="Search..." class="form-control mt-0">--}}
{{--                            <a href="" class="active">--}}
{{--                                <i class="fa fa-search"></i>--}}
{{--                            </a>--}}
{{--                        </form>--}}
                    </li>

                    <li>
                        <a class="profile-pic" href="#">
{{--                            <img src="{{asset('plugins/images/users/varun.jpg')}}" alt="user-img" width="36"--}}
{{--                                 class="img-circle">--}}
                            <span class="text-white font-medium">    {{ Auth::user()->name }}</span></a>

                        <div class="dropdown-menu dropdown-menu-right dropdown-log  text-center" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item " href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>


                </ul>
            </div>
        </nav>
    </header>
    <aside class="left-sidebar" data-sidebarbg="skin6">

        <div class="scroll-sidebar">

            <nav class="sidebar-nav">
                <ul id="sidebarnav">

                    <li class="sidebar-item pt-2">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route ('Dashboard') }}"
                           aria-expanded="false">
                            <i class="fa-solid fa-table-cells" aria-hidden="true"></i>
                            <span class="hide-menu">Վահանակ</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route ('EduDashboard') }}"
                           aria-expanded="false">
                            <i class="fa-solid fa-graduation-cap" aria-hidden="true"></i>
                            <span class="hide-menu">Կրթություն</span>
                        </a>
                    </li>
{{--                    <li class="sidebar-item">--}}
{{--                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="basic-table.html"--}}
{{--                           aria-expanded="false">--}}
{{--                            <i class="fa fa-table" aria-hidden="true"></i>--}}
{{--                            <span class="hide-menu">Basic Table</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}


                </ul>

            </nav>

        </div>

    </aside>
    <div class="container" style="margin-left:240px">
        @yield('content')
    </div>
</div>


<script src="{{asset('plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}

<script src="{{asset('js/jquery_ui.js')}}"></script>

<script src="{{asset('js/app-style-switcher.js')}}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="{{asset('js/waves.js')}}"></script>

<script src="{{asset('js/sidebarmenu.js')}}"></script>

<script src="{{asset('js/custom.js')}}"></script>

<script src="{{asset('js/jquery_ui.js')}}"></script>

<script src="{{asset('js/inputmask.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script>

    $(".comments").show();
    $("#check").click(function() {
        if($(this).is(":checked")) {
            $(".comments").hide();
        } else {
            $(".comments").show();
        }
    });
    $(".expsalary").show();
    $("#check2").click(function() {
        if($(this).is(":checked")) {
            $(".expsalary").hide();
        } else {
            $(".expsalary").show();
        }
    });

    $(".soc").show();
    $("#check3").click(function() {
        if($(this).is(":checked")) {
            $(".soc").hide();
        } else {
            $(".soc").show();
        }
    });

    $(document).ready(function(){



        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $(document).ready(function () {
        $(".profile-pic").click(function () {
            $( ".dropdown-log" ).toggle( "slow", function() {

            });

        });



        $("#birthDay").datepicker(
            {
                minDate: new Date(1950,1-1,1), maxDate: '-16Y',
                dateFormat: 'dd-mm-yy',
                // changeMonth: true,
                // changeYear: true,
                yearRange: '-110:-15',
                firstDay: 1,
                closeText: 'Փակել',
                prevText: 'Նախորդ',
                nextText: 'Հաջորդ',
                currentText: 'Այսօր',
                monthNames: ['Հունվար','Փետրվար','Մարտ','Ապրիլ','Մայիս','Հունիս', 'Հուլիս','Օգոստոս','Սեպտեմբեր','Հոկտեմբեր','Նոյեմբեր','Դեկտեմբեր'],
                monthNamesShort: ['Հունվ','Փետր','Մարտ','Ապր','Մայիս','Հունիս', 'Հուլ','Օգս','Սեպ','Հոկ','Նոյ','Դեկ'],
                dayNames: ['կիրակի','եկուշաբթի','երեքշաբթի','չորեքշաբթի','հինգշաբթի','ուրբաթ','շաբաթ'],
                dayNamesShort: ['կիր','երկ','երք','չրք','հնգ','ուրբ','շբթ'],
                dayNamesMin: ['կիր','երկ','երք','չրք','հնգ','ուրբ','շբթ'],
                weekHeader: 'ՇԲՏ',
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            }
        );
        $('.date').datepicker({
            dateFormat: 'dd-mm-yy',
            firstDay: 1,
            closeText: 'Փակել',
            prevText: 'Նախորդ',
            nextText: 'Հաջորդ',
            currentText: 'Այսօր',
            monthNames: ['Հունվար','Փետրվար','Մարտ','Ապրիլ','Մայիս','Հունիս', 'Հուլիս','Օգոստոս','Սեպտեմբեր','Հոկտեմբեր','Նոյեմբեր','Դեկտեմբեր'],
            monthNamesShort: ['Հունվ','Փետր','Մարտ','Ապր','Մայիս','Հունիս', 'Հուլ','Օգս','Սեպ','Հոկ','Նոյ','Դեկ'],
            dayNames: ['կիրակի','եկուշաբթի','երեքշաբթի','չորեքշաբթի','հինգշաբթի','ուրբաթ','շաբաթ'],
            dayNamesShort: ['կիր','երկ','երք','չրք','հնգ','ուրբ','շբթ'],
            dayNamesMin: ['կիր','երկ','երք','չրք','հնգ','ուրբ','շբթ'],
            weekHeader: 'ՇԲՏ',
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        });
        $('.date').inputmask({"mask": "99/99/9999"});







        $(document).on('change','.education_name', function(e){
            var id = e.target.value;
            $.ajax({
                url: "/auth/addEducationForEmp/" + id,
                type: 'GET',
                success: function (data) {
                    $(e.target).parent().next('td').find('.faculty_name:first').empty();
                    Object.keys(data).forEach((row) => {
                        $(e.target).parent().next('td').find('.faculty_name:first').append(`<option value="${data[row].id}"> ${data[row].faculty_name} </option>`);
                    });
                }
            });
        })
    });

    $(".addMore").click(function () {


        var rowCount = $('#experienceCard tr').length - 1;
        if (rowCount < 0) {
            rowCount = 0;
        }
        $(".experienceCard").append(
            `<tr>
                  <td><input type="text" class="form-control" name="exp[${rowCount}][companyName]" id="companyName" placeholder="Ընկերության անունը"></td>
                  <td><input type="text" class="form-control"  name="exp[${rowCount}][position]"  id="position" placeholder="Պաշտոն/հաստիք " ></td>
                  <td><input type="text" class="form-control date" name="exp[${rowCount}][start]"  ></td>
                  <td><input type="text" class="form-control date" name="exp[${rowCount}][end]"  ></td>
                  <td><input type="number" class="form-control" name="exp[${rowCount}][salary]" id="salary" placeholder="Աշխատավարձ" min="1"></td>

            </tr>`
        );
        $('.date').datepicker({
            dateFormat: 'dd-mm-yy'
        });
        $('.date').inputmask({"mask": "99/99/9999"});
    });

    $(".addMoreEduInput").click(function () {
        var rowCount = $('#educationCard tr').length - 1;
        if (rowCount < 0) {
            rowCount = 0;
        }
        $(".educationCardInput").append(
            `<tr>
                <td><input type="text" class="form-control" name="expEdu[${ rowCount}][educationName]"
                                               id="educationName" placeholder="Կրթության վայր"></td>
                                    <td><input type="text" class="form-control" name="expEdu[${ rowCount}][facultyName]"
                                               id="facultyName" placeholder="ֆակուլտետ"></td>
            </tr>`
        );

    });

    $(".addMoreEdu").click(function () {
        var rowCount = $('#educationCard tr').length - 1;
        if (rowCount < 0) {
            rowCount = 0;
        }
        $(".educationCard").append(
            `<tr>
                <td><select class="form-control education_name " name="expEdu[${rowCount}][educationName]" ></select></td>
                <td><select class="form-control faculty_name " name="expEdu[${rowCount}][facultyName]" ></select></td>

            </tr>`
        );

    });


    $(document).ready(function () {

        $(document).on('change', '.education_name', function (e) {
            var id = e.target.value;

            $.ajax({
                url: "/auth/addEducationForEmp/" + id,
                type: 'GET',
                success: function (data) {
                    $(e.target).parent().next('td').find('.faculty_name:first').empty();
                    Object.keys(data).forEach((row) => {
                        $(e.target).parent().next('td').find('.faculty_name:first').append(`<option value="${data[row].id}"> ${data[row].faculty_name} </option>`);
                    });
                }
            });
        });


        $(document).on('change', '.countries', function (e) {

          //  console.log(e)
          //  $('.phone').prop('disabled',false);
            var id = e.target.value;
            $('.phoneNumber').prop('readonly',false);

            $.ajax({
                url: "/auth/addPhone",
                type: 'GET',
                success: function (data) {


                    $('.phone').val(`+${data[id-1].phonecode}`);
                    // if( $('.phone').val(`(+${data[id-1].phonecode})`)){
                    //
                    // }

                }
            });

        });
    });



          //###delete_Employee###//
    $(document).ready(function () {

        $(".delete_employee").click(function () {
            var m = $(this).parent().parent();
            $('#myModal').modal('show');

            var id = $(this).data('id');
            $('.confirmModal').click(function () {
                // alert(id)
                $.ajax({
                    url: "/auth/deleteEmployee/" + id,
                    type: 'GET',
                    data: {
                        "id": id,
                    },
                    success: function () {
                        m.remove();
                        console.log("user is deleted");

                    }

                });
            });
        });


    });
            //###delete-cv###//
    $(document).ready(function () {

        $(".delete_cv").click(function () {
            var m = $(this).parent();

            $('#myModal').modal('show');

            var id = $(this).data('id');

            $('.deleteCvFile').click(function () {


                $.ajax({
                    url: "/auth/deleteCv/" + id,
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,

                    },
                    success: function () {
                        m.remove();
                        console.log("user is deleted");

                    }

                });
            });
        });


    });

    $(document).ready(function () {

        {{--$(".deleteEdu").click(function () {--}}
        {{--    var m = $(this).parent().parent();--}}

        {{--    $('#myModal').modal('show');--}}

        {{--    var id = $(this).data('id');--}}

        {{--    $('.deleteEdu').click(function () {--}}


        {{--        $.ajax({--}}
        {{--            url: "/auth/deleteEducation/" + id,--}}
        {{--            type: 'POST',--}}
        {{--            data: {--}}
        {{--                "_token": "{{ csrf_token() }}",--}}
        {{--                "id": id,--}}

        {{--            },--}}
        {{--            success: function () {--}}
        {{--                m.remove();--}}
        {{--                console.log("education is deleted");--}}

        {{--            }--}}

        {{--        });--}}
        {{--    });--}}
        {{--});--}}

        $(".editUni").click(function () {
            var m = $(this).parent().parent();

            $('.editUni').modal('show');

            var id = $(this).data('id');

            $('.editUni').click(function () {


                $.ajax({
                    url: "/auth/deleteEducation/" + id,
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,

                    },
                    success: function () {
                        m.remove();
                        console.log("education is deleted");

                    }

                });
            });
        });


    });
    function noDigits(event) {
        if ("1234567890+=?@#`~!<>)([]{}".indexOf(event.key) != -1)
            event.preventDefault();
    }

    function formatDate3() {
        var d1 = document.getElementById("interviewDate").value;
        var  day1 = d1.slice(0,2);
        var month1 = d1.slice(3,5);
        var   year1 = d1.slice(6,10);
        if ((day1[0] == 0)&& (day1[1]==0)){
            $("#interviewDate").addClass('is-invalid');
            $("#interviewDate").parent().find('span').remove();
            $('#interviewDate').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }
        if ((month1[0] == 0)&& (month1[1]==2)&& (day1>29)){
            $("#interviewDate").addClass('is-invalid');
            $("#interviewDate").parent().find('span').remove();
            $('#interviewDate').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }
        if ((month1[0] == 1)&& (month1[1]==1)&& (day1>30)){
            $("#interviewDate").addClass('is-invalid');
            $("#interviewDate").parent().find('span').remove();
            $('#interviewDate').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }
        if ((month1[0] == 0)&& (month1[1]==4)&& (day1>30)){
            $("#interviewDate").addClass('is-invalid');
            $("#interviewDate").parent().find('span').remove();
            $('#interviewDate').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" > ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }
        if ((month1[0] == 0)&& (month1[1]==6)&& (day1>30)){
            $("#interviewDate").addClass('is-invalid');
            $("#interviewDate").parent().find('span').remove();
            $('#interviewDate').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }
        if ((month1[0] == 0)&& (month1[1]==9)&& (day1>30)){
            $("#interviewDate").addClass('is-invalid');
            $("#interviewDate").parent().find('span').remove();
            $('#interviewDate').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" > ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }
        if(day1>31){
            $("#interviewDate").addClass('is-invalid');
            $("#interviewDate").parent().find('span').remove();
            $('#interviewDate').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }

        if(month1<1||month1>12){
            $("#interviewDate").addClass('is-invalid');
            $("#interviewDate").parent().find('span').remove();
            $('#interviewDate').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" > ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }


        $("#interviewDate").parent().find('span').remove();
        $("#interviewDate").removeClass('is-invalid');

    }

    function formatDate2() {
        var d1 = document.getElementById("birthDay").value;
        var  day1 = d1.slice(0,2);
        var month1 = d1.slice(3,5);
        var   year1 = d1.slice(6,10);
        if ((day1[0] == 0)&& (day1[1]==0)){
            $("#birthDay").addClass('is-invalid');
            $("#birthDay").parent().find('span').remove();
            $('#birthDay').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }
        if ((month1[0] == 0)&& (month1[1]==2)&& (day1>29)){
            $("#birthDay").addClass('is-invalid');
            $("#birthDay").parent().find('span').remove();
            $('#birthDay').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }
        if ((month1[0] == 1)&& (month1[1]==1)&& (day1>30)){
            $("#birthDay").addClass('is-invalid');
            $("#birthDay").parent().find('span').remove();
            $('#birthDay').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }
        if ((month1[0] == 0)&& (month1[1]==4)&& (day1>30)){
            $("#birthDay").addClass('is-invalid');
            $("#birthDay").parent().find('span').remove();
            $('#birthDay').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }
        if ((month1[0] == 0)&& (month1[1]==6)&& (day1>30)){
            $("#birthDay").addClass('is-invalid');
            $("#birthDay").parent().find('span').remove();
            $('#birthDay').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }
        if ((month1[0] == 0)&& (month1[1]==9)&& (day1>30)){
            $("#birthDay").addClass('is-invalid');
            $("#birthDay").parent().find('span').remove();
            $('#birthDay').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }
        if(day1>31){
            $("#birthDay").addClass('is-invalid');
            $("#birthDay").parent().find('span').remove();
            $('#birthDay').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }

        if(month1<1||month1>12){
            $("#birthDay").addClass('is-invalid');
            $("#birthDay").parent().find('span').remove();
            $('#birthDay').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }
        if(year1<1950 || year1>new Date().getFullYear() - 16){
            $("#birthDay").addClass('is-invalid');
            $("#birthDay").parent().find('span').remove();
            $('#birthDay').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ</span>
               `
            );
            return
        }

        $("#birthDay").parent().find('span').remove();
        $("#birthDay").removeClass('is-invalid');

    }

    function formatDate4() {
        var d1 = document.getElementById("applicationDate").value;
        var  day1 = d1.slice(0,2);
        var month1 = d1.slice(3,5);
        var   year1 = d1.slice(6,10);
        if ((day1[0] == 0)&& (day1[1]==0)){
            $("#applicationDate").addClass('is-invalid');
            $("#applicationDate").parent().find('span').remove();
            $('#applicationDate').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }
        if ((month1[0] == 0)&& (month1[1]==2)&& (day1>29)){
            $("#applicationDate").addClass('is-invalid');
            $("#applicationDate").parent().find('span').remove();
            $('#applicationDate').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }
        if ((month1[0] == 1)&& (month1[1]==1)&& (day1>30)){
            $("#applicationDate").addClass('is-invalid');
            $("#applicationDate").parent().find('span').remove();
            $('#applicationDate').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }
        if ((month1[0] == 0)&& (month1[1]==4)&& (day1>30)){
            $("#applicationDate").addClass('is-invalid');
            $("#applicationDate").parent().find('span').remove();
            $('#applicationDate').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }
        if ((month1[0] == 0)&& (month1[1]==6)&& (day1>30)){
            $("#applicationDate").addClass('is-invalid');
            $("#applicationDate").parent().find('span').remove();
            $('#applicationDate').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }
        if ((month1[0] == 0)&& (month1[1]==9)&& (day1>30)){
            $("#applicationDate").addClass('is-invalid');
            $("#applicationDate").parent().find('span').remove();
            $('#applicationDate').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }
        if(day1>31){
            $("#applicationDate").addClass('is-invalid');
            $("#applicationDate").parent().find('span').remove();
            $('#applicationDate').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }

        if(month1<1||month1>12){
            $("#applicationDate").addClass('is-invalid');
            $("#applicationDate").parent().find('span').remove();
            $('#applicationDate').parent().append(
                `
               <span class="invalid-feedback d-flex justify-content-end" >  ամսաթիվը վավեր չէ </span>
               `
            );
            return
        }


        $("#applicationDate").parent().find('span').remove();
        $("#applicationDate").removeClass('is-invalid');

    }




</script>
@yield('js')
</body>
</html>
