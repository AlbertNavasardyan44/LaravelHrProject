@extends('layouts.admin')

@section('content')

    <div class="d-flex justify-content-center">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="white-box">
                    <div class="d-flex justify-content-center p-4">
                        <h3 class="box-title text-info">ԿԱՏԱՐԵԼ ՓՈՓՈԽՈՒԹՅՈՒՆՆԵՐ</h3>
                    </div>
                    <form method="POST" action="{{ route('saveUpdated', $Employee->id)}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="empID" value="{{$Employee->id}}">
                        <div class="form-group d-flex justify-content-center row ">
                            <div class="'card border border-primary  col-lg-7 p-3 mb-3">
                                <h4 class="text-center text-info">ԸՆԴՀԱՆՈՒՐ ՏԵՂԵԿԱՏՎՈՒԹՅՈՒՆ</h4>
                                <label for="exampleFormControlInput1"> {{ __('Դիմելու ամսաթիվ (օր/ամիս/տարի)') }}<span class="text-danger">*</span></label>

                                <input type="text" class="form-control date @error('applicationDate') is-invalid @enderror"  name="applicationDate" id="applicationDate"
                                       value="{{(($Employee-> application_date)? date('d.m.Y',strtotime($Employee-> application_date)):'')}}"><br>
                                @error('applicationDate')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror
                                <label for="exampleFormControlInput1">{{ __('Հարցազրույցի ամսաթիվ (օր/ամիս/տարի)') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control date @error('interviewDate') is-invalid @enderror" name="interviewDate" id="interviewDate"
                                       value="{{(($Employee-> interview_date)? date('d.m.Y',strtotime($Employee-> interview_date)):'')}}"><br>
                                @error('interviewDate')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror
                                <label for="exampleFormControlInput1">{{ __('Անուն Ազգանուն ') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nameLastName') is-invalid @enderror" name="nameLastName" id="nameLastName"
                                       placeholder="Անուն ազգանուն" value="{{$Employee->name_last_name}}"><br>
                                @error('nameLastName')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror
                                <label for="exampleFormControlInput1"> {{ __('Ծննդյան ամսաթիվ (օր/ամիս/տարի)') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control date @error('birthDay') is-invalid @enderror" name="birthDay" id="birthDay"
                                     value="{{(($Employee-> birth_date)? date('d.m.Y',strtotime($Employee-> birth_date)):'')}}"><br>
                                @error('birthDay')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror
                                <label for="exampleFormControlInput1"> {{ __('Մասնագիտություն') }}</label>
                                <input type="text" class="form-control" name="profession" id="profession"
                                       placeholder="Մասնագիտություն" value="{{$Employee->profession}}"><br>
                            </div>

                            <div class="card border border-info p-3 mb-3  col-lg-7">
                                <h4 class="text-center text-info">ԿՐԹՈՒԹՅՈՒՆ</h4>
                                <button class="btn btn-success mb-3 addMoreEduEdit" type="button">Ավելացնել</button>
                                <table class=" table text-nowrap table-bordered educationCardEdit" id="educationCardEdit">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Կրթության վայր</th>
                                            <th class="border-top-0">ֆակուլտետ</th>
                                            <th class="border-top-0">Հեռացնել</th>
                                        </tr>

                                    </thead>

                                     @if($Employee->employeeEdu)


                                          @foreach($Employee->employeeEdu as $key =>$f)
                                                <tr>
                                                    <td class="col-lg-6">
                                                        <select class="form-control education_name_edit" name="expEdu[{{$key}}][educationNameEdit]" id="education">
{{--                                                            <option class="checkedopt" value="" selected >{{(($f->faculty AND $f->faculty->facultyEmp) ? $f->faculty->facultyEmp->place_of_study : '')}} </option>--}}


                                                            @foreach($Education as $data)


                                                                <option id="{{$data->id}}" value="{{$data->id}}" @if($data->id === $f->faculty->facultyEmp->id) selected @endif>{{ $data->place_of_study }}</option>

                                                            @endforeach

                                                        </select>
                                                    </td>
                                                            <td class="col-lg-6">

                                                                <select class="form-control faculty_name_edit " name="expEdu[{{$key}}][facultyNameEdit]" id="faculty">

                                                                 <option id="{{$f->faculty->id}}" value="{{$f->faculty->id}}" selected>{{(($f->faculty) ? $f->faculty->faculty_name : '')}}</option>
                                                                </select>
                                                            </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn text-danger delEmployeeEdu" data-id="{{$f->faculty->id}}"><i class="fa-solid fa-trash"></i></button>
                                                    </td>

                                                </tr>
                                        @endforeach
                                    @endif
                                </table>
                                <button class="btn btn-success mb-3 addMoreEduCompWrite" type="button">Ավելացնել</button>
                                <table class="table text-nowrap table-bordered educationCardCompWrite" id="educationCardCompWrite" >
                                    <thead>
                                    <P class="text-info">ԳՐՈՎԻ ՏԱՐԲԵՐԱԿ</P>

                                    <tr>
                                        <th class="col-lg-6">Կրթության վայր</th>
                                        <th>Բաժին/տեսակ</th>
                                        <th class="border-top-0">Հեռացնել</th>
                                    </tr>

                                    </thead>

                                    <tbody>
                                    @if($Employee->otherEdu)


                                        @foreach($Employee->otherEdu as $key =>$f)
                                    <tr>
                                        <td>

                                            <input list="browsers" class="form-control education_write  " onkeypress="noDigits(event)" name="expW[{{$key}}][educationWrite]" id="education" value="{{$f->education_name}}">
                                            <datalist id="browsers">

                                            </datalist>

                                        </td>

                                        <td>
                                            <input list="browsers" class="form-control faculty_write " onkeypress="noDigits(event)" name="expW[{{$key}}][facultyWrite]" id="faculty" value="{{$f->faculty_name}}">
                                            <datalist id="browsers">

                                            </datalist>
                                        </td>
                                    <td class="text-center">
                                        <button type="button" class="btn text-danger delEmpEduWrite" data-id="{{$f->id}}"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                    </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>

                            </div>


                            <div class="card border border-info p-3 mb-3  col-lg-7 ">
                                <h4 class="text-center text-info text-uppercase	">Աշխատանքային փորձ</h4>
                                <button class="btn btn-success mb-3 addMore" type="button">Ավելացնել</button>
                                <table class="table text-nowrap table-bordered experienceCard" id="experienceCard">
                                    <thead>
                                    <tr>
                                        <th>Ընկերության անունը</th>
                                        <th>Պաշտոն/հաստիք</th>
                                        <th>Սկիզբ </th>
                                        <th>Ավարտ </th>
                                        <th>Աշխատավարձ (դրամ)</th>
                                    </tr>

                                    </thead>
                                    @foreach($Employee->experience as $key => $expm)
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" name="exp[{{$key}}][companyName]"
                                                       value="{{$expm->company_name}}" id="companyName" placeholder="Ընկերության անունը">
                                            </td>

                                            <td>
                                                <input type="text" class="form-control"  name="exp[{{$key}}][position]"  id="position" placeholder="Պաշտոն/հաստիք "  value="{{$expm->position}}">
                                            </td>

                                            <td>
                                                <input type="text" class="form-control date" name="exp[{{$key}}][start]"
                                                       id="start" value="{{(($expm->start)? date('d.m.Y',strtotime($expm->start)):'')}}" >
                                            </td>
                                            <td><input type="text" class="form-control date" name="exp[{{$key}}][end]"
                                                       id="end" value="{{(($expm->end)? date('d.m.Y',strtotime($expm->end)):'')}}"
                                                      ></td>
                                            <td><input type="number" class="form-control" name="exp[{{$key}}][salary]"
                                                       value="{{$expm->salary}}"
                                                       id="salary" placeholder="Աշխատավարձ" min="1"></td>
                                        </tr>
                                    @endforeach
                                </table>


                            </div>

                            <div class="card border border-info p-3 mb-3  col-lg-7 ">
                                <h4 class="text-center text-info text-uppercase">Կոնտակտներ</h4>
                                <label for="exampleFormControlTextarea1"> {{ __('Մեկնաբանություններ') }}</label>
                                <textarea class="form-control" name="comments" id="comments" rows="5"
                                          value="{{$Employee->comments}}">{{$Employee->comments}}</textarea><br>

{{--                                <label for="exampleFormControlInput1">{{ __(' Բջջ․ հեռ․ ') }}<span class="text-danger">*</span></label>--}}
{{--                                <input type="text" class="form-control @error('contacts') is-invalid @enderror" name="contacts" id="contacts" placeholder="Հեռ"--}}
{{--                                       value="{{$Employee->contacts}}"><br><br>--}}
{{--                                @error('contacts')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                    </span><br>--}}
{{--                                @enderror--}}

                                <div class="d-flex">
                                    <div class="col-lg-4 pl-0 pr-5">
                                        <label for="exampleFormControlInput1">{{ __('Երկիր ') }} <span class="text-danger">*</span></label>
                                        <select type="text" class="form-control{{-- @error('contacts') is-invalid @enderror--}} countries" name="contacts"  id="countries" placeholder="Հեռ" value="{{old('contacts')}}">
                                            @foreach($countries as $phone)

                                                <option  id="{{$phone->id}}" @if($phone->id == $Employee->country_id) selected @endif value="{{$phone->id}}">{{$phone->nicename}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div  class="col-lg-6 p-0">
                                        <label for="exampleFormControlInput1">{{ __('Բջջ․ հեռ․ ') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('contacts') is-invalid @enderror phone" name="contacts"  id="contacts" placeholder="Հեռ" value="{{$Employee->contacts}}">
                                        <div class="d-flex flex-row">
{{--                                            <input readonly type="text" class="form-control col-lg-2 @error('contacts') is-invalid @enderror phone "  name="phoneCode"  id="contacts" placeholder="+" value="--}}{{-- @if($phone->id == $Employee->country_id) {{$Employee->phonecode}} @endif--}}{{--">--}}

{{--                                            <input readonly type="tel" oninput="chk(event)" class="form-control  @error('phoneNumber') is-invalid @enderror phoneNumber"  name="phoneNumber"  id="phoneNumber" placeholder="Հեռ" value="{{$Employee->contacts}}">--}}
                                        </div>
                                        @error('contacts')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                        @enderror
                                    </div>
                                </div><br><br>


{{--                                <input type="text" class="form-control" name="links" id="links"--}}
{{--                                       placeholder="Սոց․ կայքեր" value="{{$Employee->social_sites}}"><br><br>--}}
                                <div class="LinksCard mb-3 p-2">
                                    <button class="btn btn-success mb-3 addMoreLink" type="button">Ավելացնել</button><br>
                                    <label for="exampleFormControlInput1">{{ __('Հղումներ') }}</label>
                                @foreach($Employee->SocSites as $key=> $sc)


{{--                                        <input type="text" class="form-control" name="expLink[0][Links]" id="links" placeholder="Սոց․ կայքեր" value="{{old('links')}}"><br>--}}

                                    <input type="text" class="form-control" name="expLink[{{$key}}][Links]" id="links"
                                           placeholder="Սոց․ կայքեր" value="{{$sc->link}}"><br><br>
                                @endforeach
                                </div>
                                @foreach($Employee->cvs as $key => $file)
                                    <div class="col-lg-3 border d-flex justify-content-between align-items-center">
                                        <span
                                                id="documentName"><a href="{{$file->path}}" download={{$file->name}}>{{$file->name}}</a>
                                        </span>

                                        <button type="button"  data-id="{{$file->id}}" class="btn file-remove -align-right  ml-2 delete_cv"><i class="fa-solid fa-file-circle-xmark"></i></button>

                                    </div>
                                    <br>

                                @endforeach
                                <label class="form-label" for="customFile">{{ __('Ներբեռնել (pdf,docx)') }} <span class="text-danger">*</span></label>

                                <input value="{{((isset($file) ? $file->path: ''))}}}" type="file" class="form-control   @error('files.0','files') is-invalid @enderror" id="customFile"  name="files[]" multiple /><br>
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
                                <label for="exampleFormControlInput1">{{ __('Ակնկալիք աշխատավարձ (դրամ)') }}
                                     <span class="text-danger">Մաքուր</span>
                                </label>
                                <input type="number" class="form-control" name="expected_salary" id="expected_salary"
                                       placeholder="Ակնկալիք աշխատավարձ" min="1" value="{{$Employee->expected_salary}}">

                            </div>
                        </div>
                        <button type="submit" class="btn text-white btn-primary empEditBtn">
                            {{ __('Թարմացնել') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

{{--faile modal--}}
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="fa-solid fa-trash-arrow-up"></i>
                    </div>
                    <h4 class="modal-title w-100">
                        Համոզված ե՞ք</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Իսկապե՞ս ցանկանում եք ջնջել կցված ֆայլը։</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Չեղարկել</button>
                    <button type="button" class="btn btn-danger  deleteCvFile"  data-dismiss="modal" data-id="">Ջնջել</button>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal fade deleteEdu_forEmp">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="fa-solid fa-trash-arrow-up"></i>
                    </div>
                    <h4 class="modal-title w-100">
                        Համոզված ե՞ք</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Իսկապե՞ս ցանկանում եք ջնջել կրթությունը։</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Չեղարկել</button>
                    <button type="button" class="btn btn-danger  deleteEdu_forEmpModalbtn"  data-dismiss="modal" data-id="">Ջնջել</button>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal fade deleteEduWrite">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="fa-solid fa-trash-arrow-up"></i>
                    </div>
                    <h4 class="modal-title w-100">
                        Համոզված ե՞ք</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Իսկապե՞ս ցանկանում եք ջնջել կրթությունը։</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Չեղարկել</button>
                    <button type="button" class="btn btn-danger  delEmpEduWriteModal"  data-dismiss="modal" data-id="">Ջնջել</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

    <script>

        $(document).ready(function () {



            $(".addMoreEduCompWrite").click(function () {
                var rowCount = $('#educationCardCompWrite tr').length - 1;
                if (rowCount < 0) {
                    rowCount = 0;
                }
                $(".educationCardCompWrite").append(
                    `<tr>
                        <td>
                           <input list="browsers" class="form-control education_write  " onkeypress="noDigits(event)"  name="expW[${rowCount}][educationWrite]" id="education">
                             <datalist id="browsers">
                             </datalist>
                        </td>

                        <td>
                            <input list="browsers" class="form-control faculty_write " onkeypress="noDigits(event)" name="expW[${rowCount}][facultyWrite]" id="faculty">
                               <datalist id="browsers">
                               </datalist>
                        </td>
                          <td class="text-center">
                                <button type="button" class="btn text-danger  delEmpEduAdded" data-id=""><i class="fa-solid fa-trash"></i></button>
                          </td>
                     </tr>`
                );

            });
            $(document).on("click",".delEmpEduAdded",function(){
           // $(".delEmpEduAdded").click(function () {

                $(this).parent().parent().remove();
            });

            $(document).on("click",".delEmployeeEduAdded",function(){
            //$(".delEmployeeEdu2").click(function () {

                $(this).parent().parent().remove();
            });

            $(".addMoreEduEdit").click(function () {
                var rowCount = $('#educationCardEdit tr').length - 1;
                if (rowCount < 0) {
                    rowCount = 0;
                }

                $(".educationCardEdit").append(
                    `<tr>
                    <td class='col-lg-5 border'>
                        <select class="form-control education_name_edit " name="expEdu[${rowCount}]educationNameEdit" >
                            <option value=""></option>
                            @foreach($Education as $data)

                        <option id="{{$data->id}}" value="{{$data->id}}">{{$data->place_of_study}}</option>

                            @endforeach
                        </select>
                    </td>

                    <td class='col-lg-5 border'>
                        <select class="form-control faculty_name_edit " name="expEdu[${rowCount}][facultyNameEdit]" ></select>
                    </td>

                     <td class="text-center col-lg-2 border">
                          <button type="button" class="btn text-danger delEmployeeEduAdded" data-id=""><i class="fa-solid fa-trash"></i></button>


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
            $(document).on("change", ".education_name_edit", function (e) {
                var id = e.target.value;

                $.ajax({
                    url: "/auth/editEmployeeEducation/" + id,
                    type: 'GET',
                    success: function (data) {
                        $(e.target).parent().next('td').find('.faculty_name_edit:first').empty();
                        Object.keys(data).forEach((row) => {
                            $(e.target).parent().next('td').find('.faculty_name_edit:first').append(`<option value="${data[row].id}"> ${data[row].faculty_name} </option>`);



                        });
                       // $(e.target).parent().next('td').next('td').append(` <button type="button" class="btn text-danger delEmployeeEdu2" ><i class="fa-light fa-x"></i></button>`);
                       //  $(".delEmployeeEdu2").click(function () {
                       //      console.log(123);
                       //      $(this).parent().parent().remove();
                       //  });
                    }
                });
            });


        /*konkret fakulteti heracum dimordic*/
        $(".delEmployeeEdu").click(function () {
            var m = $(this).parent().parent();
            $('.deleteEdu_forEmp').modal('show');

            var id = $(this).data('id');
           // console.log(id);
            var empID=$('.empID').val();
            //var fac
           // console.log(empID);
            $('.deleteEdu_forEmpModalbtn').click(function () {

                $.ajax({
                    url: "/auth/deleteEduForEmp/" + id +"/" + empID,
                    type: 'GET',
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


            $(".delEmpEduWrite").click(function () {
                var m = $(this).parent().parent();

                $('.deleteEduWrite').modal('show');

                var id = $(this).data('id');
                console.log(id);
                //var empID=$('.empID').val();
                //var fac
               // console.log(empID);
                $('.delEmpEduWriteModal').click(function () {

                    $.ajax({
                        url: "/auth/deleteEduWrite/" + id  ,
                        type: 'GET',
                        data: {

                            "_token": "{{ csrf_token() }}",
                            "id": id,

                        },
                        success: function () {
                            console.log(123456);
                            m.remove();
                            console.log("education is deleted");

                        }

                    });
                });
            });
    });

    </script>

@endsection
