<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewNotification;
use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StudentRequest;
use App\Mail\AcceptStudentMail;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;

class StudentController extends Controller
{

    use MDT_Query , MDT_Method_Action;

    public function __construct()
    {

        $this->middleware('haveRole:student.index')->only('index');
        $this->middleware('haveRole:student.create')->only(['create' , 'store']);
        $this->middleware('haveRole:student.update')->only('update');
        $this->middleware('haveRole:student.destroy')->only('destroy');
        $this->middleware('haveRole:student.restore')->only('restore');
        $this->middleware('haveRole:student.finalDelete')->only('finalDelete');

    }

    public function index()
    {
        $is_trash  = \request()->segment(2) === 'trash';

        return  $this->MDT_Query_method(// Start Query
            Student::class ,
            'admin/pages/students/index',
            $is_trash, // Soft Delete
            [ // Other Options
                "orderBy"   => ['row_no','asc'],
                'condition' => ['where' , 'is_active' , '=' , 1],
                'with'      => ['is_trash' => $is_trash ],
            ]

        ); // end query

    }


    public function create()
    {

        return view('admin.pages.students.create');

    }


    public function store(StudentRequest $request)
    {
        $student = Student::create($this->columnsDB($request));

        // get max row
        $next_nor_no = Student::max('row_no');
        if ($next_nor_no < 1) {
            $next_nor_no = 1;
        } else {
            $next_nor_no++;
        }
        $student->row_no = $next_nor_no;
        $student->is_active = 1;
        $student->save();

        // New Notification Here

        try{

            $title_ar = $student->name_ar;
            $title_en = $student->name_en;
            if ($student->gender == 3){
                $name_ar = "تم اضافة براند جديد الان";
                $name_en = "New brand added";
                $type = "brand";
            }else{
                $name_ar = "تم اضافة مشهور جديد الان";
                $name_en = "Famous added now";
                $type = "student";
            }

            $notification = [
                'title_ar'     => "$name_ar",
                'title_en'     => "$name_en",
                'details_ar'   => "اشتري من $title_ar الان ",
                'details_en'   => "Buy from  $title_en now",
                'type'         => $type,
                'reference_id' => $student->id,
                'image'        => asset('assets/images/student/'. $student->img)
            ];
            event(new NewNotification($notification));
        }catch (\Exception $e){

        }

        return back()->with('success' , __('form.response.create student'));

    }

    public function edit($id){
        $student = Student::find($id);
        return view('admin.pages.students.edit',compact('student'));
    }

    public function update(StudentRequest  $request, $id)
    {


        $student = Student::withTrashed()
            ->where('id' , $id)
            ->firstOrFail();

        $student->update($this->columnsDB($request ,$student->img));

        return redirect()->back()->with('success',__('form.response.update student'));

    }

    public function show()
    {

        return  $this->MDT_Query_method(// Start Query
            Student::class ,
            'admin/pages/students/pending',
            false, // Soft Delete
            [ // Other Options
                'condition' => ['where' , 'is_active' , '=' , 0],
                'with'      => ['is_trash' => false ],

            ]

        ); // end query

    }


    public function orders($id){

        $products =  Order::where('brand_id',$id)->where('payment_method','cash')
            ->where('status','!=','reject')
            ->orWhere(function ($qb) use ($id){
                $qb->where('brand_id',$id);
                $qb->where('payment_method','knet')->where('status','!=','pending');
            })->paginate(24);
        //dd($orders);

        /*$products = ProductOrder::where('student_id' ,$id)
            ->with('order', function ($q) use ($id){
                $q->where('brand_id',$id);
                $q->where('payment_method','cash')
                    ->where('status','!=','reject')
                    ->orWhere(function ($qb) use ($id){
                        $qb->where('brand_id',$id);
                        $qb->where('payment_method','knet')
                            ->where('status','!=','pending');
              });
        })->paginate(24);

        dd($products);*/
        return view('admin.pages.students.orders' , compact('products'));

    }

    public function destroy($id)
    {
        return $this->MDT_delete(Student::class , $id);
    }

    public function restore($id)
    {

        return $this->MDT_restore(Student::class , $id);
    }

    public function finalDelete($id)
    {
        return $this->MDT_finalDelete(Student::class , $id);
    }



    public function reject($id){

        Student::where('id' , $id)->forceDelete();

        return 'Delete Success';
    }

    public function accept($id){

        $student = Student::findOrFail($id);

        $student->is_active = 1;

        $student->save();

        \Mail::to($student->email)->send(new AcceptStudentMail($student));

        return 'accept Success';
    }

    public function updatePoints($id){

        $student = Student::findOrFail($id);

        $student->points = (integer) request('points' , 0);

        $student->save();
    }


    ///////////////////////////////////////////////////////
    ////                                               ////
    //// ..........  Methods Clean Code .............. ////
    ////                                               ////
    ///////////////////////////////////////////////////////


    public function columnsDB($request, $oldImage = 'default.svg'){

        $imgName = null;

        $img = $request->file('img');
        if ($img) {
            $imgName = time().$img->getClientOriginalExtension();
            $img->move(public_path('assets/images/student') , $imgName);
        }
        $password = $request->password ? 'password' : '';

        return [
            'name_ar'            => $request->name_ar,
            'name_en'            => $request->name_en,
            'trendat_percentage'            => $request->trendat_percentage,
            'student_percentage'            => $request->student_percentage,
            'gender'            => $request->gender,
            'row_no'            => $request->row_no,
            'email'           => $request->email,
            'phone'           => $request->phone,
            'date'            => $request->date,
            'university'      => $request->university,
            'university_id'   => $request->university_id,
            'major'           => $request->major,
            'img'       => $imgName ?? $oldImage,

            'limit_products'  => $request->limit_products ?? 50,
            $password    => bcrypt($request->password),
        ];
    }
}
