@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="d-flex justify-content-center p-4">
                    <h3 class="box-title">Ավելացնել նոր համալսարան</h3>
                </div>
                <form method="POST" action="{{route ('newEducation') }}">
                    @csrf
                    <div class="form-group d-flex justify-content-center row">

                        <div class="card border border-info p-3 mb-3  col-lg-7">
                            <h4 class="text-center text-info">Կրթություն</h4>
                            <button class="btn btn-success mb-3 addMoreEduInput" type="button">Ավելացնել</button>
                            <table class="table text-nowrap table-bordered educationCardInput" id="educationCard">
                                <thead>
                                <tr>
                                    <th>Կրթության վայր</th>
                                    <th>ֆակուլտետ</th>
                                </tr>

                                </thead>

                                <tr>
                                    <td><input type="text" class="form-control" name="expEdu[0][educationName]"
                                               id="educationName" placeholder="Կրթության վայր" onkeypress="noDigits(event)"></td>
                                    <td><input type="text" class="form-control" name="expEdu[0][facultyName]"
                                               id="facultyName" placeholder="ֆակուլտետ" onkeypress="noDigits(event)"></td>

                                </tr>
                            </table>


                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary addEdu">
                        {{ __('Ավելացնել') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        function noDigits(event) {
            if ("1234567890+=?@#`~!<>)([]{}".indexOf(event.key) != -1)
                event.preventDefault();
        }
    </script>
@endsection
