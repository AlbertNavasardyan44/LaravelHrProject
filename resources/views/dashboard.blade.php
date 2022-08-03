@extends('layouts.admin')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="d-flex justify-content-center">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="white-box ">
                    <div class="d-flex justify-content-center p-4">
                        <h3 class="box-title text-info">ԲՈԼՈՐ ԴԻՄՈՐԴՆԵՐԸ</h3>
                    </div>
                    <div class="d-flex justify-content-right float-right p-2">

                        {{--                   / <h3 class="box-title">Դիմումների աղյուսակ</h3>--}}
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="  {{ route ('newEmp') }} "
                           aria-expanded="false">
                            {{--                        <i class="fa fa-table" aria-hidden="true"></i>--}}
                            <span class="hide-menu btn btn-success">Ավելացնել</span>
                        </a>
                    </div>
         <div class="table-responsive ">
            <div class=" search mb-5 p-3">
                        <div class="form-check  form-switch mb-2 remove">
                            <input class="form-check-input" type="checkbox" name="filter_phone" id="check"   >
                            <label class="form-check-label"  for="comments">Մեկնաբանություններ</label>
                        </div>
                        <div class="form-check form-switch mb-2  remove">
                            <input class="form-check-input" type="checkbox" name="filter_phone" id="check2"  >
                            <label class="form-check-label"  for="salary">Ակնկալիք աշխատավարձ</label>
                        </div>
                        <div class="form-check form-switch mb-2  remove">
                            <input class="form-check-input" type="checkbox" name="filter_phone" id="check3"  >
                            <label class="form-check-label"  for="salary">Սոց կայքեր</label>
                        </div>
                    <form action="{{ route('showEmployee') }}" method="GET">
                        <div class=" mb-3  searchInput">
                            <div class="input-group-append  ">
                                <div class="d-flex flex-column">
                                    <label for="">Որոնում ըստ անվան</label>
                                    <div class="input-group-append mb-2 ">
                                        <input  type="text" class="form-control" placeholder="Որոնում" aria-describedby="basic-addon2"
                                                value="{{((\Illuminate\Support\Facades\Session::get('searchName')) ? \Illuminate\Support\Facades\Session::get('searchName') : '')}}" name="searchName">
                                        <button class="btn btn-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>


                                </div>
                            </div>
                            <div class="input-group-append ">
                                <div class="d-flex flex-column">
                                    <label for="">Որոնում ըստ մասնագիտության</label>
                                    <div class="input-group-append">
                                        <input  type="text" class="form-control" placeholder="Որոնում" aria-describedby="basic-addon2"
                                                value="{{((\Illuminate\Support\Facades\Session::get('searchProfession')) ? \Illuminate\Support\Facades\Session::get('searchProfession') : '')}}" name="searchProfession" >
                                        <button class="btn btn-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </form>
            </div>
                        <table class="table table-bordered dashboard-table" >
                            <thead>
                            <tr>
                                <th class="border-top-0 text-center">#</th>
                                <th class="border-top-0 text-center text-break">Դիմելու <br> ամսաթիվ</th>
                                <th class="border-top-0 text-center">Հարցազրույցի <br> ամսաթիվ</th>
                                <th class="border-top-0 text-center">Անուն <br> Ազգանուն</th>
                                <th class="border-top-0 text-center">Ծննդյան <br> օր</th>
                                <th class="border-top-0 text-center">Մասնագի-<br>տություն</th>
                                <th class="border-top-0 text-center">Կրթություն</th>
                                <th class="border-top-0 text-center">Աշխ․ <br> փորձ (ամիս)</th>
                                <th class="border-top-0  text-center comments">Մեկնաբա-<br>նություններ</th>
                                <th class="border-top-0 text-center">Հեռ․</th>
                                <th class="border-top-0 col-md-1 text-center soc">Սոց․ <br> կայքեր</th>
                                <th class="border-top-0 col-md-1 text-center expsalary">Ակնկալիք <br> աշխատավարձ (դրամ)</th>
                                <th class="border-top-0 text-center">ԻՆքնակեն-<br>սագրական</th>
                                <th class="border-top-0 text-center">Գործողու-<br>թյուններ</th>


                            </tr>
                            </thead>
                            <tbody id="myTable">
                         @foreach($Employee as $data)
                                <tr>
                                    <td class="text-center">{{$data['id']}}</td>
                                    <td class="text-center">{{(($data-> application_date)? date('d.m.Y',strtotime($data-> application_date)):'')}}</td>

                                    <td class="text-center">{{(($data-> interview_date) ? date('d.m.Y',strtotime($data-> interview_date)): '')}}</td>

                                    <td class="text-center">{{$data-> name_last_name}}</td>

                                    <td class="text-center">{{(($data-> birth_date) ? date('d.m.Y',strtotime($data-> birth_date)): '')}}</td>

                                    <td class="text-center">{{$data-> profession}}</td>

                                    <td class="text-center">
                                            @if($data->employeeEdu)
                                                @foreach($data->employeeEdu as $f)
                                                    <span> {{(($f->faculty) ?$f->faculty->faculty_name : '')}}</span><br>
                                                @endforeach
                                            @endif

                                                @if($data->otherEdu)
{{--                                                    @dd($data->otherEdu)--}}
                                                    @foreach($data->otherEdu as $f)
                                                        <span> {{$f->education_name}}-{{$f->faculty_name}}{{--{{(($f->faculty) ?$f->faculty->faculty_name : '')}}--}}</span><br>
                                                    @endforeach
                                                @endif
                                    </td>

                                    <td class="text-center">{{(($data->experienceEchEmp AND isset($data->experienceEchEmp[0])) ? $data->experienceEchEmp[0]->subdates : '')}}</td>
                                    <td class="text-center comments">{{$data-> comments}}</td>
                                    <td class="text-center">{{$data-> contacts}}</td>
                                    <td class="text-center soc">
                                        @if($data->SocSites)
                                            @foreach($data->SocSites as $sc)
                                        <a href="{{$sc->link}}">{{$sc->link}}</a>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="text-center expsalary">{{$data-> expected_salary}}</td>

                                    <td class="text-center">
                                        @if($data->cvs)
                                            @foreach($data->cvs as $file)
                                                <a href="{{$file->path}}" download={{$file->name}}>{{$file->name}}</a><br>
                                            @endforeach
                                        @endif

                                    </td>
                                    <td>
                                        <a class="btn text-warning " href="{{route('editEmp',$data->id)}}"><i
                                                    class="fa-solid fa-pen"></i></a>


                                        <button class="btn text-danger delete_employee" data-id="{{$data->id}}"><i
                                                    class="fa-solid fa-trash"></i></button>

                                        <a class="btn text-info " href="{{route('infoEmp',$data->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                    <p>Իսկապե՞ս ցանկանում եք ջնջել այս դիմորդին: Այս գործընթացը հնարավոր չէ հետարկել:</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Չեղարկել</button>
                    <button type="button" class="btn btn-danger confirmModal deleteEmp"  data-dismiss="modal" data-id="">Ջնջել</button>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{$Employee->appends('searchName',\Illuminate\Support\Facades\Session::get('searchName'))->links('pagination::bootstrap-4')}}
    </div>
@endsection
@section('js')
    <script>
        // var b=$('#myInput').val()
        // sessionStorage.setItem("search",b);
        // sessionStorage.getItem("search");

        // window.onload = function(){
        //     // Щит клавиатуры событий
        //     document.onkeydown = function (){
        //         var e = window.event || arguments[0];
        //         //F12
        //         if(e.keyCode == 123){
        //             return false;
        //             //Ctrl+Shift+I
        //         }else if((e.ctrlKey) && (e.shiftKey) && (e.keyCode == 73)){
        //             return false;
        //             //Shift+F10
        //         }else if((e.shiftKey) && (e.keyCode == 121)){
        //             return false;
        //             //Ctrl+U
        //         }else if((e.ctrlKey) && (e.keyCode == 85)){
        //             return false;
        //         }
        //     };
        //     // Щит правой кнопкой мыши
        //     document.oncontextmenu = function (){
        //         return false;
        //     }
        // }
    </script>
@endsection