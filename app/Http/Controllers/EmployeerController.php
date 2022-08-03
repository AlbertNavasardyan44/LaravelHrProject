<?php

namespace App\Http\Controllers;


use App\Cvs;
use App\Employee;
use App\Experience;
use App\Education;
use App\Faculty;
use App\Countries;
use App\employeeEducation;
use App\SocSites;
use App\OtherEducation;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\In;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;


class EmployeerController extends Controller
{

    public function addNewEmployee(Request $request)
    {

//        dd($request->all());
        DB::beginTransaction();
        try {

            $validator = Validator::make($request->all(), [
                 'applicationDate' => 'required|date_format:d/m/Y|before:today',
                'interviewDate' => 'required|date_format:d/m/Y|after_or_equal:applicationDate',
                'nameLastName' => 'required|max:60|regex:/^[\pL\s\-]+$/u',
               'phoneNumber' => 'required|not_regex:/[a-z]/',
                'birthDay' => 'required|before:today-15 years',
//                'exp.*.start'=>'nullable|date_format:d/m/Y|before:today',
//                'exp.*.end'=>'nullable|date_format:d/m/Y|after_or_equal:start',
                'files' => 'required',
                'files.*' => 'mimes:pdf,doc',

            ], [
                'applicationDate.required' => 'դաշտը պարտադիր է',
                'applicationDate.before' => 'Դիմելու օրը պետք է լինի մինչ այսօր և հարցազրույցի օրից առաջ',
                'interviewDate.required' => 'դաշտը պարտադիր է',
                'interviewDate.after_or_equal'=>'Հարցազրույցի օրը պետք է լինի դիմելու օրից հետո',
                'nameLastName.required' => 'Անուն դաշտը պարտադիր է',
                'nameLastName.regex' => 'Անուն դաշտը պետք է բաղկացած լինի տառերից',
                'birthDay.required' => 'Ծննդյան օրը պարտադիր է',
                'birthDay.before' => 'Ծննդյան օրը անվավեր է',
//                'exp.*.start.before'=>'սկիզբը  պետք է լինի մինչ այսօր',
//                'exp.*.end.after_or_equal'=>'ավարտը պետք է լինի սկզբից հետո',
                'phoneNumber.required' => 'Կոնտակտներ դաշտը պարտադիր է',
//                'contacts.regex'=>'Կոնտակտների ձևաչափն անվավեր է123456',
                'phoneNumber.not_regex'=>'Կոնտակտների ձևաչափն անվավեր է',
                'files.required' => 'դաշտը պարտադիր է',
                'files.*.mimes' => ' Միայն  pdf,doc տիպի ֆայլեր',

            ]);

            if ($validator->fails())
           // dd($validator->errors());
                return redirect('/auth/addEmployee')->withErrors($validator)->withInput($request->all());

            $employee = new Employee();
            $employee->application_date = ((Input::get('applicationDate')) ? date('Y-m-d', strtotime(str_replace('/', '-', Input::get('applicationDate')))) : null);
            $employee->interview_date = ((Input::get('interviewDate')) ? date('Y-m-d', strtotime(str_replace('/', '-', Input::get('interviewDate')))) : null);
            $employee->name_last_name = Input::get('nameLastName');
            $employee->birth_date = ((Input::get('birthDay')) ? date('Y-m-d', strtotime(str_replace('/', '-', Input::get('birthDay')))) : null);
            $employee->profession = Input::get('profession');
            $employee->comments = Input::get('education_id');
            $employee->comments = Input::get('comments');
            $employee->contacts = Input::get('phoneCode')."".Input::get('phoneNumber');
            $employee->country_id=Input::get('contacts');


           // $employee->social_sites = Input::get('links');
            $employee->expected_salary = Input::get('expected_salary');


            if ($employee->save()) {

                $data = Input::get("expEdu");
            if($data) {
                foreach ($data as $item) {
                    if (!$item['educationName'])
                        continue;
                    $education = new employeeEducation();
                    $education->faculty_id = $item['facultyName'];
                    $employee->employeeEdu()->save($education);


                }
            }


                $Link = Input::get("expLink");
                //dd($Link);
                if ($Link) {
                    foreach ($Link as $item) {
//dd($item);
                        $socSites = new SocSites();
                        $socSites->employee_id = $employee->id;
                        $socSites->link = $item['Links'];
                        $employee->SocSites()->save($socSites);
                    }
                }

                $exp = Input::get("exp");
                foreach ($exp as /*$k =>*/ $item) {

                    $experience = new Experience();
                    $experience->company_name = $item['companyName'];
                    $experience->salary = $item['salary'];
                    $experience->position = $item['position'];
                    $experience->start = (($item['start']) ? date('Y-m-d', strtotime(str_replace('/', '-', $item['start']))) : null);
                    $experience->end = (($item['end']) ? date('Y-m-d', strtotime(str_replace('/', '-', $item['end']))) : null);
                    $employee->experience()->save($experience);


                }
                $otherEdu = Input::get("expW");
                //dd($otherEdu);

                foreach ($otherEdu as $item) {
//dd($item);
                    $eduW = new OtherEducation();
                    $eduW->employee_id = $employee->id;
                    $eduW->education_name = $item['educationWrite'];
                    $eduW->faculty_name = $item['facultyWrite'];
                    $employee->otherEdu()->save($eduW);
                }

                if ($request->file('files')) {

                    $fileFolder = storage_path("app\public\content\\file_{$employee->id}");
                    if (!File::exists($fileFolder))
                        File::makeDirectory($fileFolder, $mode = 0777, true, true);

                    foreach ($request->file('files') as $key => $file) {

                        $fileName = Str::random(4) . time() . '.' . $file->getClientOriginalExtension();
                        Storage::disk('local')->put("public/content/file_{$employee->id}/" . $fileName, file_get_contents($file));
                        $filePath = asset("storage/content/file_{$employee->id}/$fileName");

                        $file = new Cvs();
                        $file->name = $fileName;
                        $file->path = $filePath;
                        $file->employee_id = $employee->id;
                        $file->save();
                    }

                }

            }
            DB::commit();
        } catch (\Error $error) {

            DB::rollBack();
        }

        return redirect()->route('Dashboard');

    }


    public function showEmployee(Request $request)
    {
        $data = Employee::with('experienceEchEmp', 'cvs', 'employeeEdu.faculty','SocSites','otherEdu');

        if($request->has('searchName')){
            Session::put('searchName', (($request->has('searchName') AND $request->searchName) ? $request->searchName : ''));
        }/*else
            Session::forget('searchName');*/

        if(Session::get('searchName'))
            $data = $data->where('name_last_name', 'like', '%'.Session::get('searchName').'%');



        if($request->has('searchProfession')){
            Session::put('searchProfession', (($request->has('searchProfession') AND $request->searchProfession) ? $request->searchProfession : ''));
        }/*else
            Session::forget('searchName');*/

        if(Session::get('searchProfession'))
            $data = $data->where('profession', 'like', '%'.Session::get('searchProfession').'%');



        $data = $data->orderBy('id','DESC')->Paginate(7);
        /* ->get();*/
        return view('dashboard', ['Employee' => $data]);

    }


    public function newEmployee(Request $request)
    {
        $data = Education::get(['id', 'place_of_study']);

        $phone = Countries::get(['id','nicename','phonecode']);

        return view('newEmployee', ['education' => $data, 'faculty' => [],'countries'=>$phone]);
    }

    public function newPhoneNumber(){
        $phone = Countries::get(['id','phonecode']);

        return response()->json($phone);
    }

    public function editEmployee($id, Request $request)
    {

        $Employee = Employee::with('experience', 'cvs', 'employeeEdu.faculty.facultyEmp.education','SocSites')->where('id', $id)->first();
        $data = Education::get();
        $phone = Countries::get(['id','nicename','phonecode']);
        //dd($phone);

        return view('editEmp', ['Employee' => $Employee, 'Education' => $data, 'faculty' => [],'countries'=>$phone]);
    }

    public function saveUpdated($id, Request $request)
    {


        DB::beginTransaction();
        try {
            $employee = Employee::with('cvs', 'experience','SocSites')->find($id);
           // dd($employee);
            $education=Education::get();
            $countries=Countries::get();
            if (!$employee)
                return redirect('auth/dashboard');


            $rules = [
                'applicationDate' => 'required|date_format:d/m/Y|before:today',
                'interviewDate' => 'required|date_format:d/m/Y|after_or_equal:applicationDate',
                'nameLastName' => 'required|max:60|regex:/^[\pL\s\-]+$/u',
                'phoneNumber' => 'required|not_regex:/[a-z]/',
                'birthDay' => 'required|before:today-15 years',
//                'exp.*.start'=>'nullable|date_format:d/m/Y|before:today',
//                'exp.*.end'=>'nullable|date_format:d/m/Y|after_or_equal:start',
//                'files' => 'required',
//                'files.*' => 'mimes:pdf,doc',
            ];
            if (!$employee->cvs OR !count($employee->cvs)) {
                $rules['files'] = 'required';
                $rules['files.*'] = 'mimes:pdf,doc';
            }
            if ($request->file('files')) {
                $rules['files'] = 'required';
                $rules['files.*'] = 'mimes:pdf,doc';
            }
            //dd(123);
            $validator = Validator::make($request->all(), $rules, [
                'applicationDate.required' => 'դաշտը պարտադիր է',
                'applicationDate.before' => 'Դիմելու օրը պետք է լինի մինչ այսօր և հարցազրույցի օրից առաջ',
                'interviewDate.required' => 'դաշտը պարտադիր է',
                'interviewDate.after_or_equal'=>'Հարցազրույցի օրը պետք է լինի դիմելու օրից հետո',
                'nameLastName.required' => 'Անուն դաշտը պարտադիր է',
                'nameLastName.regex' => 'Անուն դաշտը պետք է բաղկացած լինի տառերից',
                'birthDay.required' => 'Ծննդյան օրը պարտադիր է',
                'birthDay.before' => 'Ծննդյան օրը անվավեր է',
//                'exp.*.start.before'=>'սկիզբը  պետք է լինի մինչ այսօր',
//                'exp.*.end.after_or_equal'=>'ավարտը պետք է լինի սկզբից հետո',
                'phoneNumber.required' => 'Կոնտակտներ դաշտը պարտադիր է',
//                'contacts.regex'=>'Կոնտակտների ձևաչափն անվավեր է123456',
                'phoneNumber.not_regex'=>'Կոնտակտների ձևաչափն անվավեր է',
                'files.required' => 'դաշտը պարտադիր է',
                'files.*.mimes' => ' Միայն  pdf,doc տիպի ֆայլեր',

            ]);
            if ($validator->fails())
                return view('editEmp', ['Employee' => $employee,'Education'=>$education, 'countries'=>$countries])->withErrors($validator)->withInput($request->all());

            //  dd($validator->errors());
            $employee->application_date = ((Input::get('applicationDate')) ? date('Y-m-d', strtotime(str_replace('/', '-', Input::get('applicationDate')))) : null);
            $employee->interview_date = ((Input::get('interviewDate')) ? date('Y-m-d', strtotime(str_replace('/', '-', Input::get('interviewDate')))) : null);
            $employee->name_last_name = Input::get('nameLastName');
            $employee->birth_date = ((Input::get('birthDay')) ? date('Y-m-d', strtotime(str_replace('/', '-', Input::get('interviewDate')))) : null);
            $employee->profession = Input::get('profession');
            $employee->comments = Input::get('comments');
            $employee->contacts = Input::get('contacts');
            //$employee->social_sites = Input::get('links');
            $employee->expected_salary = Input::get('expected_salary');
            $employee->update();



            $otherEdu = Input::get("expW");
            //dd($otherEdu);
            if($otherEdu){
            OtherEducation::where('employee_id', $employee->id)->delete();
            foreach ($otherEdu as $item) {
//dd($item);
                $eduW = new OtherEducation();
                $eduW->employee_id = $employee->id;
                $eduW->education_name = $item['educationWrite'];
                $eduW->faculty_name = $item['facultyWrite'];
                $employee->otherEdu()->save($eduW);
            }
            }

            $exp = Input::get("exp");
//dd($exp);
            Experience::where('employee_id', $employee->id)->delete();
            foreach ($exp as $k => $item) {

                $experience = new Experience();

                $experience->employee_id = $employee->id;

                $experience->company_name = $item['companyName'];

                $experience->position = $item['position'];

                $experience->salary = $item['salary'];

                $experience->start = (($item['start']) ? date('Y-m-d', strtotime(str_replace('/', '-', $item['start']))) : null);

                $experience->end = (($item['end']) ? date('Y-m-d', strtotime(str_replace('/', '-', $item['end']))) : null);

                $experience->save();

            }


            if ($request->file('files')) {

                $fileFolder = storage_path("app\public\content\\file_{$employee->id}");

                if (!File::exists($fileFolder)) {
                    File::makeDirectory($fileFolder, $mode = 0777, true, true);
                }
                foreach ($request->file('files') as $key => $file) {

                    $fileName = Str::random(4) . time() . '.' . $file->getClientOriginalExtension();

                    Storage::disk('local')->put("public/content/file_{$employee->id}/" . $fileName, file_get_contents($file));
                    $filePath = asset("storage/content/file_{$employee->id}/$fileName");

                    $file = new Cvs();
                    $file->name = $fileName;
                    $file->path = $filePath;
                    $file->employee_id = $employee->id;
                    $file->save();
                }
            }
            $Link = Input::get("expLink");
      //    dd($Link);
           SocSites::where('employee_id', $id)->delete();
            //  dd($Link);

                foreach ($Link as $item) {
                  //dd(!$item);
//dd($item);
                if ($item) {
                    $socSites = new SocSites();
                    $socSites->employee_id = $employee->id;
                    $socSites->link = $item['Links'];
                    $employee->SocSites()->save($socSites);
                }
         }


            $data = Input::get("expEdu");
            employeeEducation::where('employee_id', $id)->delete();
            if($data){
                foreach ($data as $item) {

                    $education = new employeeEducation();
                    $education->faculty_id = $item['facultyNameEdit'];

                    $employee->employeeEdu()->save($education);
                    }
                }



            DB::commit();
        } catch (\Error $error) {

            DB::rollBack();
        }
        return redirect('auth/dashboard')->with('success', 'Profile updated!');

    }

    public function editEmployeeEducation($id, Request $request)
    {

        $data = Faculty::where('uni_id',$id)->get();

        return response()->json($data);

    }



    public function deleteEduForEmp($id,$k){

        Faculty::where('uni_id',$id)->get();
        employeeEducation::where(['employee_id' =>$k, 'faculty_id'=>$id])->delete();

        return response()->json();
    }

    public function deleteEduWrite($id){

      //  Faculty::where('uni_id',$id)->get();
       // employeeEducation::where(['employee_id' =>$k, 'faculty_id'=>$id])->delete();


        OtherEducation::find($id)->delete();
        return response()->json();
    }

    public function deleteEmp($id)
    {
        $employee = Employee::findOrFail($id);

        if ($employee) {
            Experience::where('employee_id', $employee->id)->delete();
            EmployeeEducation::where('employee_id', $employee->id)->delete();
            SocSites::where('employee_id',$employee->id)->delete();
            OtherEducation::where('employee_id',$employee->id)->delete();
            $path = storage_path("app\public\content\\file_{$employee->id}");

            if (File::exists($path)) {
                try {
                    File::deleteDirectory($path);
                    Cvs::where('employee_id', $employee->id)->delete();

                } catch (\Error $exp) {
                    return Response::json(['success' => false, 'err' => $exp->getMessage()], 400);
                }

            }
        }
        $employee->delete();

        return redirect()->route('showEmployee');

    }

    public function deleteCv($id)
    {

        $file = Cvs::find($id);

        $path = storage_path("app\public\content\\file_{$file->employee_id}\\{$file->name}");

        $path2 = storage_path("app\public\content\\file_{$file->employee_id}");

        if (File::exists($path)) {
            try {
                File::delete($path);
                $file->delete();


            } catch (\Error $exp) {
                return Response::json(['success' => false, 'err' => $exp->getMessage()], 400);
            }

        }
        if (count(glob("$path2/*")) === 0) {
            File::deleteDirectory($path2);

        }
        return Response::json(['success' => true], 200);
    }

    public function newEducation()
    {
        return view('addEducation');
    }

    public function AddNewEducation(Request $request)
    {

        DB::beginTransaction();
        try {
            $expEdu = Input::get("expEdu");

            foreach ($expEdu as $edu) {
                $education = Education::where('place_of_study', $edu['educationName'])->first();
                if (!$education)
                    $education = new Education();
                $education->place_of_study = $edu['educationName'];
                $education->save();

                $find_faculty = Faculty::where(['faculty_name' => $edu['facultyName'], 'uni_id' => $education->id])->first();

                if (!$find_faculty)
                    $find_faculty = new Faculty();
                $find_faculty->faculty_name = $edu['facultyName'];
                $find_faculty->uni_id = $education->id;
                $find_faculty->save();

                DB::commit();
            }
        } catch (\Error $error) {

            DB::rollBack();

        }

        return redirect()->route('newEducation');

    }

    public function showEducation(Request $request)
    {

        $data = Education::with('education')->get();
        //dd($data);
        return view('educationDashboard', ['Education' => $data]);

    }

    public function newEmployeeEdu($id)
    {

        $faculty = Faculty::where('uni_id', $id)->get();
        return Response::json($faculty);
    }

    public function editEducation($id, Request $request)
    {
        $Education = Education::with('education')->find($id);

        return view('editEducation', ['Education' => $Education]);


    }

    public function saveUpdatedEdu($id, Request $request)
    {

        DB::beginTransaction();
        try {
            $expEdu = Input::get("expEdu");

            foreach ($expEdu as $k => $edu) {
                Faculty::where('id', $edu['id'])->update(['faculty_name' => $edu['facultyName']]);
            }
            DB::commit();

        } catch (\Error $error) {

            DB::rollBack();

        }

        return redirect()->route('EduDashboard');
    }


    public function editUni($id, Request $request)
    {
        $Education = Education::find($id);
//dd($Education);
        return view('editUniversity', ['Education' => $Education]);


    }

    public function saveUpdatedUni($id, Request $request)
    {

        DB::beginTransaction();
        try {
            $Education = Education::find($id);
            $Education->place_of_study = Input::get('educationName');
            $Education->save();
            DB::commit();


        } catch (\Error $error) {

            DB::rollBack();

        }

        return redirect()->route('EduDashboard');
    }


//    public function deleteEdu($id)
//    {
//        $education = Employee::with( 'employeeEdu.faculty.facultyEmp')->get();
//        dd($education);
//        $education = Education::findOrFail($id);
//
//        if ($education) {
//            Faculty::where('uni_id', $education->id)->delete();
//
//        }
//        $education->delete();
//    }

    public function infoEmployee($id)
    {

        $data = Employee::with('experienceEchEmp', 'cvs', 'employeeEdu.faculty','SocSites','otherEdu')->where('id', $id)->first();

        $edu = Education::get();
        $phone = Countries::get(['id','name','phonecode']);

      //  return view('editEmp', ['Employee' => $Employee, 'Education' => $data, 'faculty' => [],'countries'=>$phone]);
        return view('employeeInfo',  ['Employee' => $data,'Education' => $edu]);

    }


    public function index()
    {
        $data = \DB::table('employees')->paginate(10);
        return view('dashboard', compact('data'));
    }
    public function simple(Request $request)
    {
        $data = \DB::table('people');
        if( $request->input('search')){
            $data = $data->where('name', 'LIKE', "%" . $request->search . "%");
        }
        $data = $data->paginate(10);
        return view('dashboard', compact('data'));
    }
//    public function advance(Request $request)
//    {
//        $data = \DB::table('employees');
//        if ($request->name) {
//            $data = $data->where('name_last_name', 'LIKE', "%" . $request->name . "%");
//        }
//        if ($request->address) {
//            $data = $data->where('profession', 'LIKE', "%" . $request->address . "%");
//        }
////        if ($request->min_age && $request->max_age) {
////            $data = $data->where('age', '>=', $request->min_age)
////                ->where('age', '<=', $request->max_age);
////        }
//        $data = $data->paginate(10);
//        return view('dashboard', compact('data'));
//    }
}
//<input type="text" class="form-control" placeholder="Type the name" aria-describedby="basic-addon2" name="search">
