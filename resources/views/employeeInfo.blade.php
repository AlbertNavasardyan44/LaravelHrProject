@extends('layouts.admin')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/infostyle.css')}}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/resume.css')}}" media="all" />

    <div class="d-flex justify-content-center">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="white-box ">
                    <div id="doc2" class="yui-t7">
                        <div id="inner">

                            <div id="hd">
                                <div class="yui-gc">
                                    <div class="yui-u first">
                                        <h1>{{$Employee-> name_last_name}}</h1>


                                    </div>


                                </div><!--// .yui-gc -->
                            </div><!--// hd -->

                            <div id="bd">
                                <div id="yui-main">
                                    <div class="yui-b">

                                        <div class="yui-gf">
                                            <div class="yui-u first">
                                                <h2 class="">Ընդհանուր տեղեկություն</h2>
                                            </div>
                                            <div class="yui-u border border-info p-2">
                                                <h3> <span class="text-info">դիմելու ամսաթիվ։</span> {{(($Employee-> application_date)? date('d.m.Y',strtotime($Employee-> application_date)):'')}}</h3>
                                                <h3> <span class="text-info">հարցազրույցի ամսաթիվ։</span> {{(($Employee-> interview_date)? date('d.m.Y',strtotime($Employee-> interview_date)):'')}}</h3>
                                                <h3> <span class="text-info">ծննդյան օր։ </span>{{(($Employee-> birth_date)? date('d.m.Y',strtotime($Employee-> birth_date)):'')}}</h3>
                                                <h3>  <span class="text-info">Մասնագիտություն։</span> {{$Employee-> profession}}</h3>
                                            </div>
                                        </div><!--// .yui-gf -->


                                        <div class="yui-gf">

                                            <div class="yui-u first">
                                                <h2 class="">Աշխ․ փորձ</h2>
                                            </div><!--// .yui-u -->

                                            <div class="yui-u border border-info p-2">

                                                @foreach($Employee->experience as  $expm)
                                                <div class="job">
                                                    <h3><span class="text-info">ընկերության անունը: </span>  {{$expm->company_name}}</h3>
                                                    <h3><span class="text-info">պաշտոն/հաստիք: </span>  {{$expm->position}}</h3>
                                                    <h4 class="text-primary">{{(($expm->start)? date('d.m.Y',strtotime($expm->start)):'')}}-{{(($expm->end)? date('d.m.Y',strtotime($expm->end)):'')}}</h4>
                                                    <h3><span class="text-info">աշխատավարձ։</span>  {{$expm->salary}} դրամ</h3>
                                                </div>
                                                @endforeach


                                            </div><!--// .yui-u -->
                                        </div><!--// .yui-gf -->


                                        <div class="yui-gf">
                                            <div class="yui-u first">
                                                <h2 class="">Կրթություն</h2>
                                            </div>
                                            <div class="yui-u border border-info p-2">
{{--                                                @dd($Employee->employeeEdu)--}}
                                                @foreach($Employee->employeeEdu as $key => $f)

                                                    @foreach($Education as $edu)
                                                        <h3>@if($edu->id === $f->faculty->facultyEmp->id )<span class="text-danger">{{ $edu->place_of_study }}</span>     - {{(($f->faculty) ? $f->faculty->faculty_name : '')}}@endif</h3>
                                                    @endforeach
                                                @endforeach
                                                @foreach($Employee->otherEdu as $key =>$f)
                                                 <h3 ><span class="text-danger">{{$f->education_name}}</span> - {{$f->faculty_name}}</h3>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="yui-gf ">
                                            <div class="yui-u first ">
                                                <h2 class="">Ֆայլեր</h2>
                                            </div>
                                            <div class="yui-u border border-info p-2">

                                                @foreach($Employee->cvs as $key => $file)
                                                    <a id="pdf" href="{{$file->path}}" download={{$file->name}}>{{$file->name}}</a>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div class="yui-gf ">
                                            <div class="yui-u first">
                                                <h2 class="">Հղումններ</h2>
                                            </div>
                                            <div class="yui-u border border-info p-2">
                                                {{--                                                @dd($Employee->employeeEdu)--}}
                                                @foreach($Employee->SocSites as $key=> $sc)

                                                    <a class="text-primary link" href="{{$sc->link}}">{{$sc->link}}</a>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div class="yui-gf ">
                                            <div class="yui-u first">
                                                <h2 class="">Կոնտակտներ</h2>
                                            </div>
                                            <div class="yui-u border border-info p-2">
                                                {{--                                                @dd($Employee->employeeEdu)--}}

                                                <h3 class="link">{{$Employee->contacts}}</h3>

                                            </div>
                                        </div>

                                        <div class="yui-gf ">
                                            <div class="yui-u first">
                                                <h2 class="">Քոմենթներ</h2>
                                            </div>
                                            <div class="yui-u border border-info p-2">
                                                {{--                                                @dd($Employee->employeeEdu)--}}
                                               <h3> <span class="text-info">մեկնաբանութոյուններ։</span> {{$Employee->comments}}</h3>
                                                <h3> <span class="text-info">Ակնկալիք աշխատավարձ։ </span> {{$Employee->expected_salary}} դրամ</h3>
                                            </div>
                                        </div><!--// .yui-gf -->

                                    </div><!--// .yui-b -->
                                </div><!--// yui-main -->
                            </div><!--// bd -->

                            <div id="ft">

                            </div><!--// footer -->

                        </div><!-- // inner -->


                    </div><!--// doc -->
            </div>
        </div>
    </div>
{{--    <div class="d-flex justify-content-center">--}}
{{--        {{$Employee->links('pagination::bootstrap-4')}}--}}
{{--    </div>--}}
@endsection
@section('js')
    <script>

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