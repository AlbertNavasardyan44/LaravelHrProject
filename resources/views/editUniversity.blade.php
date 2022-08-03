@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-sm-12 ">
            <div class="white-box ">
                <div class="d-flex justify-content-center p-4">
                    <h3 class="box-title">Փոփոխություններ</h3>
                </div>
                <form method="POST" action="{{ route('saveUpdatedUni', $Education['id'])}}">
                    @csrf
                        <div class="table-responsive d-flex justify-content-center">

                                <table class="table  table-hover text-nowrap table-bordered col-lg-8">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0 text-center">#</th>
                                            <th class="border-top-0 text-center">Համալսարան</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                            <tr>
                                                <td> {{$Education['id']}}</td>
                                                 <td>
                                                     <input type="text" class="form-control" name="educationName" onkeypress="noDigits(event)"  value="{{$Education['place_of_study']}}">
                                                 </td>
                                            </tr>

                                    </tbody>
                                 </table>


                        </div>
                            <button type="submit" class="btn text-white btn-primary  editUniversityBtn">
                                {{ __('Թարմացնել') }}
                            </button>

                        </form>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script>


    </script>
@endsection
