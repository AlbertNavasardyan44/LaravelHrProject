@extends('layouts.admin')

@section('content')

        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <div class="d-flex justify-content-center p-4">
                        <h3 class="box-title text-indo">ԱՎԵԼԱՑՆԵԼ ՆՈՐ ԴԻՄՈՐԴԻ</h3>
                    </div>
                    <form method="POST" action="{{route ('showAddForm'/*, $Education->id*/)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group d-flex justify-content-center row">
                            <div class="card border border-primary p-3 mb-3 col-lg-7">

                                <h4 class="text-center text-info">ԸՆԴՀԱՆՈՒՐ ՏԵՂԵԿԱՏՎՈՒԹՅՈՒՆ</h4>
                                <div class="form-group  d-flex pr-3 pl-3 justify-content-center row">
                                    <label for="exampleFormControlInput1"> {{ __('Դիմելու ամսաթիվ (օր/ամիս/տարի)' ) }} <span class="text-danger">*</span></label>
                                    <input type="text" onkeyup="formatDate4(event)" onkeypress="formatDate4(event)" onchange="formatDate4(event)" class=" form-control appDate date @error('applicationDate') is-invalid @enderror" name="applicationDate" id="applicationDate" value="{{old('applicationDate')}}">
                                    @error('applicationDate')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span><br>
                                    @enderror
                                </div>
                                <div class="form-group d-flex pr-3 pl-3 justify-content-center row">
                            <label for="exampleFormControlInput1">{{ __('Հարցազրույցի ամսաթիվ (օր/ամիս/տարի)') }} <span class="text-danger">*</span></label>
                            <input type="text" onkeyup="formatDate3(event)" onkeypress="formatDate3(event)" onchange="formatDate3(event)" class="form-control date @error('interviewDate') is-invalid @enderror"  name="interviewDate" id="interviewDate" value="{{old('interviewDate')}}">
                                @error('interviewDate')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror
                                </div>
                                <div class="form-group d-flex pr-3 pl-3 justify-content-center row">
                                    <label for="exampleFormControlInput1">{{ __('Անուն Ազգանուն ') }}  <span class="text-danger">*</span></label>
                                    <input type="text"  class="form-control @error('nameLastName') is-invalid @enderror" onkeypress="noDigits(event)"
                                           name="nameLastName" id="nameLastName" placeholder="Անուն ազգանուն" value="{{old('nameLastName')}}">
                                        @error('nameLastName')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span><br>
                                @enderror
                                </div>
                                <div class="form-group d-flex pr-3 pl-3 justify-content-center row">
                            <label for="exampleFormControlInput1"> {{ __('Ծննդյան ամսաթիվ (օր/ամիս/տարի)') }} <span class="text-danger">*</span></label>
                            <input type="text" onkeyup="formatDate2(event)" onkeypress="formatDate2(event)" onchange="formatDate2(event)" class="form-control date @error('birthDay') is-invalid @enderror" name="birthDay" id="birthDay"  value="{{old('birthDay')}}">
                                @error('birthDay')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror
                                </div>
                            <div class="form-group d-flex pr-3 pl-3 justify-content-center row">
                            <label for="exampleFormControlInput1"> {{ __('Մասնագիտություն') }}</label>
                            <input type="text" class="form-control" name="profession" id="profession" placeholder="Մասնագիտություն" value="{{old('profession')}}"><br>

                            </div>
                            </div>

                            <div class="card border border-info p-3 mb-3  col-lg-7">
                                <h4 class="text-center text-info">ԿՐԹՈՒԹՅՈՒՆ</h4>
                                <button class="btn btn-success mb-3 addMoreEduComp" type="button">Ավելացնել</button>
                                <table class="table text-nowrap table-bordered educationCardComp" id="educationCardComp" >
                                    <thead>

                                        <tr>
                                            <th class="col-lg-6">Կրթության վայր</th>
                                            <th>ֆակուլտետ</th>
                                        </tr>

                                    </thead>

                                    <tr>
                                        <td>
                                            <select class="form-control education_name " name="expEdu[0][educationName]" id="education" >
                                                <option selected value="">Ընտրեք Կրթության վայրը</option>

                                                    @foreach($education as $data)


                                                            <option id="{{$data->id}}" value="{{$data->id}}"  >{{$data->place_of_study}}</option>

                                                    @endforeach


                                            </select>

                                        </td>

                                        <td>
                                            <select class="form-control faculty_name " name="expEdu[0][facultyName]" id="faculty" >

                                            </select>
                                        </td>
                                    </tr>
                                </table>

                                <button class="btn btn-success mb-3 addMoreEduCompWrite" type="button">Ավելացնել</button>
                                <table class="table text-nowrap table-bordered educationCardCompWrite" id="educationCardCompWrite" >
                                    <thead>
<P class="text-info">ԳՐՈՎԻ ՏԱՐԲԵՐԱԿ</P>
                                        <tr>
                                            <th class="col-lg-6">Կրթության վայր</th>
                                            <th>Բաժին/տեսակ</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>

                                                <input list="browsers" class="form-control education_write  "  onkeypress="noDigits(event)" name="expW[0][educationWrite]" id="education">
                                                <datalist id="browsers">
                                                    <option value="Երևանի պետական համալսարան">Երևանի պետական համալսարան</option>
                                                    <option value="Հայաստանի պետական տնտեսագիտական համալսարան">Հայաստանի պետական տնտեսագիտական համալսարան</option>
                                                    <option value="Երևանի Թատրոնի և Կինոյի Պետական Ինստիտուտ">Երևանի Թատրոնի և Կինոյի Պետական Ինստիտուտ</option>
                                                    <option value="Հայաստանի ազգային ագրարային համալսարան">Հայաստանի ազգային ագրարային համալսարան</option>
                                                    <option value="Երևանի Պետական Կոնսերվատորիա">Երևանի Պետական Կոնսերվատորիա</option>
                                                    <option value="Հայաստանի ազգային պոլիտեխնիկական համալսարան">Հայաստանի ազգային պոլիտեխնիկական համալսարան</option>
                                                </datalist>

                                            </td>

                                            <td>
                                                <input list="browsers" class="form-control faculty_write " onkeypress="noDigits(event)" name="expW[0][facultyWrite]" id="faculty">
                                                <datalist id="browsers">

                                                </datalist>
                                               </td>

                                    </tr>
                                    </tbody>
                                </table>

                            </div>

                            <div class="card border border-info p-3 mb-3  col-lg-7">
                                <h4 class="text-center text-info">ԱՇԽԱՏԱՆՔԱՅԻՆ ՓՈՐՁ</h4>
                                <button class="btn btn-success mb-3 addMore" type="button">Ավելացնել</button>
                                <table class="table text-nowrap table-bordered experienceCard" id="experienceCard">
                                    <thead>
                                    <tr>

                                        <th>Ընկերության անունը</th>
                                        <th>Պաշտոն/հաստիք</th>
                                        <th>Սկիզբ</th>
                                        <th>Ավարտ</th>
                                        <th>Աշխատավարձ (դրամ)</th>
                                    </tr>

                                    </thead>

                                    <tr>
                                        <td><input type="text" class="form-control"  name="exp[0][companyName]"  id="companyName" placeholder="Ընկերության անունը"  value="{{old('exp.0.companyName')}}"></td>
                                        <td><input type="text" class="form-control"  name="exp[0][position]"  id="position" placeholder="Պաշտոն/հաստիք "  value="{{old('exp.0.position')}}"></td>

                                        <td><input type="text" class="form-control @error('exp.0.start') is-invalid @enderror date" name="exp[0][start]"  id="start" value="{{old('exp.0.start')}}">
                                        @error('exp.0.start')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                        </td>
                                        @enderror
                                        <td><input type="text" class="form-control @error('exp.0.end') is-invalid @enderror date" name="exp[0][end]"   id="end" value="{{old('exp.0.end')}}">
                                        @error('exp.0.end')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                        </td>
                                        @enderror
                                        <td><input type="number" class="form-control"  name="exp[0][salary]"  id="salary" placeholder="Աշխատավարձ" min="1" value="{{old('exp.0.salary')}}"></td>

                                    </tr>
                                </table>



                            </div>

                            <div class="card border border-info p-3 mb-3 col-lg-7  ">
                                <h4 class="text-center text-info">ԿՈՆՏԱԿՏՆԵՐ</h4>
                                <label for="exampleFormControlTextarea1"> {{ __('Մեկնաբանություններ') }}</label>
                                <textarea class="form-control" name="comments" id="comments" rows="5" >{{old('comments')}}</textarea><br>
                    <div class="d-flex">
                        <div class="col-lg-4 pl-0 pr-5">
                                <label for="exampleFormControlInput1">{{ __('Երկիր ') }} <span class="text-danger">*</span></label><br>
                                <select type="text" class="form-control @error('contacts') is-invalid @enderror countries" name="contacts"  id="countries" placeholder="Հեռ" value="{{old('contacts')}}">

                                    <option  value=""selected></option>

                                    @foreach($countries as $phone)

                                        <option  id="{{$phone->id}}" value="{{$phone->id}}">{{$phone->nicename}}</option>
                                    @endforeach

                                </select>
                                @error('contacts')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror
                         </div>
{{--                        <input  type="text" class="form-control col-lg-2 @error('contacts') is-invalid @enderror  "  name="contacts"  id="phone" placeholder="Հեռ" value="{{old('contacts')}}">--}}

                            <div  class="col-lg-6 p-0 ">
                                <label for="exampleFormControlInput1">{{ __('Բջջ․ հեռ․ ') }} <span class="text-danger">*</span></label><br>
                            <div class="d-flex flex-row">
                                    <input readonly type="text" class="form-control col-lg-2 @error('contacts') is-invalid @enderror phone "  name="phoneCode"  id="contacats" placeholder="+" value="{{old('contacts')}}">

                                   <input readonly type="tel" oninput="chk(event)" class="form-control  @error('phoneNumber') is-invalid @enderror phoneNumber"  name="phoneNumber"  id="phoneNumber" placeholder="Հեռ" value="{{old('phoneNumber')}}">

                            </div>
                                @error('phoneNumber')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror
                             </div>
                    </div><br><br>
                                <div class="LinksCard p-2 mb-2">
                                    <button class="btn btn-success mb-3 addMoreLink" type="button">Ավելացնել</button><br>
                                     <label for="exampleFormControlInput1">{{ __('Հղումներ') }}</label>
                                     <input type="text" class="form-control" name="expLink[0][Links]" id="links" placeholder="Սոց․ կայքեր" value="{{old('expLink.0.Links')}}"><br>
                                </div>
                                <label class="form-label" for="customFile">{{ __('Ներբեռնել (pdf,docx)') }} <span class="text-danger">*</span></label>
                                <input type="file" accept=".pdf,.doc" class="form-control @error('files') is-invalid @enderror  @error('files.0') is-invalid @enderror" id="customFile"  name="files[]" multiple/><br>
                                @error('files.0')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror
                                @error('files')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror
                                <label for="exampleFormControlInput1">{{ __('Ակնկալիք աշխատավարձ (դրամ) ') }} <span class="text-danger">Մաքուր</span>   </label>
                                <input type="number" class="form-control" name="expected_salary" id="expected_salary" placeholder="Ակնկալիք աշխատավարձ" min="1" value="{{old('expected_salary')}}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary addEmp">
                            {{ __('Ավելացնել') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
@endsection

<script src="{{asset('plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery_ui.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.js"></script>



@section('js')
        <script>

            // $(document).ready(function() {
            //
            //         // get the selected option and remove it from the DOM
            //         $('#education option:selected').remove();
            //
            // });
            // document.querySelectorAll('.form-outline').forEach((formOutline) => {
            //     new mdb.Input(formOutline).update();
            // });
            function chk() {
                var p1 = document.getElementsByClassName("phoneNumber")[0].value;
                var str = p1.toString();
                document.getElementsByClassName("phoneNumber")[0].value = str.slice(0, 20);
            }

           // var input = document.querySelector("#phone");
           //  window.intlTelInput(input, {
           //      utilsScript: "../../build/js/utils.js?1638200991544" // just for formatting/placeholders etc
           //  });

            function noDigits(event) {
                if ("1234567890+=?@#`~!<>)([]{}".indexOf(event.key) != -1)
                    event.preventDefault();
            }




            $(".addMoreEduComp").click(function () {
                var rowCount = $('#educationCardComp tr').length - 1;
                if (rowCount < 0) {
                    rowCount = 0;
                }
                $(".educationCardComp").append(
                    `<tr>
                        <td>
                            <select class="form-control education_name " name="expEdu[${rowCount}][educationName]" >
                                <option value=""></option>
                                @foreach($education as $data)
                                    <option id="{{$data->id}}" value="{{$data->id}}">{{$data->place_of_study}}</option>
                                @endforeach
                            </select>
                        </td>

                        <td>
                            <select class="form-control faculty_name " name="expEdu[${rowCount}][facultyName]" ></select>
                        </td>
                    </tr>`
                );

            });

            $(".addMoreEduCompWrite").click(function () {
                var rowCount = $('#educationCardCompWrite tr').length - 1;
                if (rowCount < 0) {
                    rowCount = 0;
                }
                $(".educationCardCompWrite").append(
                    `<tr>
                        <td>
                           <input list="browsers" class="form-control education_write" onkeypress="noDigits(event)" name="expW[${rowCount}][educationWrite]" id="education">
                             <datalist id="browsers">

                             </datalist>

                        </td>

                        <td>
                             <input list="browsers" class="form-control faculty_write" onkeypress="noDigits(event)" name="expW[${rowCount}][facultyWrite]" id="faculty">
                               <datalist id="browsers">

                               </datalist>
                        </td>
                    </tr>`
                );

            });

            $(".addMoreLink").click(function () {
                var rowCount = $('.LinksCard input').length ;
                if (rowCount < 0) {
                    rowCount = 0;
                }
                $(".LinksCard").append(
                    `<input type="text" class="form-control" name="expLink[${rowCount}][Links]" id="links" placeholder="Սոց․ կայքեր" value="{{old('links')}}"><br>`
                );

            });

            $(document).on('change', '.education_name', function (e) {
                var id = e.target.value;

                $.ajax({
                    url: "/auth/addEducationForEmp/" + id,
                    type: 'GET',
                    success: function (data) {
                        $(e.target).parent().next('td').find('.faculty_name:first').empty();
                        Object.keys(data).forEach((row) => {
                            $(e.target).parent().next('td').find('.faculty_name:first').append(`<option data-value="${data[row].id}" value="${data[row].faculty_name}"> ${data[row].faculty_name} </option>`);
                        });
                    }
                });
            });


        </script>
        @endsection

