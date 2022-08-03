@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-sm-12 ">
            <div class="white-box ">
                <div class="d-flex justify-content-center p-4">
                    <h3 class="box-title">Փոփոխություններ</h3>
                </div>
                <div class="d-flex justify-content-right float-right p-2 addNewEdu">

                    {{--                   / <h3 class="box-title">Դիմումների աղյուսակ</h3>--}}
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="  {{ route ('newEducation') }} "
                       aria-expanded="false">
                        {{--                        <i class="fa fa-table" aria-hidden="true"></i>--}}
                        <span class="hide-menu btn btn-success">Ավելացնել</span>
                    </a>
                </div>
                <form method="POST" action="{{ route('saveUpdatedEdu', $Education->id)}}">
                    @csrf
                        <div class="table-responsive d-flex justify-content-center">

                                <table class="table   text-nowrap table-bordered col-lg-8">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0 text-center">#</th>
                                            <th class="border-top-0 text-center"> {{$Education->place_of_study}}ի Ֆակուլտետները</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($Education->education as $key => $data)
                                            <tr>
                                                <td> {{$data['id']}}</td>
                                                 <td>
                                                     <input type="text" class="form-control" name="expEdu[{{$key}}][facultyName]" onkeypress="noDigits(event)" value="{{$data['faculty_name']}}">
                                                     <input type="hidden" class="form-control" name="expEdu[{{$key}}][id]" onkeypress="noDigits(event)" value="{{$data['id']}}">
                                                 </td>
                                            </tr>
                                         @endforeach
                                    </tbody>
                                 </table>


                        </div>
                            <button type="submit" class="btn text-white btn-primary  editEduBtn">
                                {{ __('Թարմացնել') }}
                            </button>

                        </form>
            </div>
        </div>
    </div>

    <script>
        function noDigits(event) {
            if ("1234567890+=?@#`~!<>)([]{}".indexOf(event.key) != -1)
                event.preventDefault();
        }
    </script>

@endsection
