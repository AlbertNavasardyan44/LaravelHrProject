@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-sm-12 ">
            <div class="white-box ">
                <div class="d-flex justify-content-center p-4">
                    <h3 class="box-title">Բոլոր Ուսանողական հաստատությունները</h3>
                </div>
                <div class="d-flex justify-content-right float-right p-2">

                    {{--                   / <h3 class="box-title">Դիմումների աղյուսակ</h3>--}}
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="  {{ route ('newEducation') }} "
                       aria-expanded="false">
                        {{--                        <i class="fa fa-table" aria-hidden="true"></i>--}}
                        <span class="hide-menu btn btn-success">Ավելացնել</span>
                    </a>
                </div>
                <div class="table-responsive ">
                    <table class="table text-nowrap table-bordered ">
                        <thead>
                        <tr>
                            <th class="border-top-0 text-center">#</th>
                            <th class="border-top-0 text-center">Համալսարանի անունը</th>
                            <th class="border-top-0 text-center">Ֆակուլտետներ</th>
{{--                            <th class="border-top-0 text-center">Հեռացնել ցուցակից</th>--}}

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Education as $data)
                            <tr>
                                <td class="text-center">{{$data['id']}}</td>

                                <td class="text-center">{{$data->place_of_study}}
                                 <a class="btn text-warning  " href="{{route('editUni',$data->id)}}">
                                    <button class="btn text-warning editUni" type="button"> <i class="fa-solid fa-pen"></i></button>
                                 </a>
                                </td>

                                <td class="text-center">
                                    <a class=" text-warning" href="{{route('editEdu',$data->id)}}">ֆակուլտետներ
                                        <button class="btn text-warning editUni" type="button"> <i class="fa-solid fa-pen"></i></button>
                                    </a>
                                </td>

{{--                                <td class="text-center">--}}
{{--                                    <button class="btn text-danger deleteEdu" data-id="{{$data->id}}"><i--}}
{{--                                                class="fa-solid fa-trash"></i></button>--}}
{{--                                </td>--}}

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade deleteEduModal">
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
                    <p>Իսկապե՞ս ցանկանում եք ջնջել այս ուսման հաստատությունը և նրա ֆակուլտետները: Այս գործընթացը հնարավոր չէ հետարկել:</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Չեղարկել</button>
                    <button type="button" class="btn btn-danger confirmModal deleteEdu"  data-dismiss="modal" data-id="">Ջնջել</button>
                </div>
            </div>
        </div>
    </div>




@endsection
@section('js')
<script>

</script>
@endsection