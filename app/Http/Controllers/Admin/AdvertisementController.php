<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\Product;
use App\Models\Student;
use App\MyDataTable\MDT_UploadImag;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    //

    use MDT_UploadImag;

    // Display a listing of the advertisements
    public function index()
    {
        $advertisements = Advertisement::paginate(15);
        return view('admin.pages.advertisements.index', compact('advertisements'));
    }

    // Show the form for creating a new advertisement
    public function create()
    {
        return view('admin.pages.advertisements.create');
    }

    // Store a newly created advertisement in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image',
            'advertisement_type' => 'nullable|in:category_id,product_id,student_id,brand_id,out_source',
            'reference_id' => 'nullable|integer',
            'out_source_link' => 'nullable|url|required_if:advertisement_type,out_source',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Generate a unique filename
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Move the uploaded file to the public/advertisements directory
            $image->move(public_path('advertisements'), $imageName);

            // Save the image path in the validated array
            $validated['image'] = 'advertisements/' . $imageName; // Save the relative path to the database
        }


        Advertisement::create($validated);

        return redirect()->route('admin.advertisements.index')->with('success', 'Advertisement created successfully!');
    }

    // Show the form for editing the specified advertisement
    public function edit($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        return view('admin.pages.advertisements.edit', compact('advertisement'));
    }

    // Update the specified advertisement in the database
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'image' => 'nullable|image',
            'advertisement_type' => 'nullable|in:category_id,product_id,student_id,brand_id,out_source',
            'reference_id' => 'nullable|integer',
            'out_source_link' => 'nullable|url|required_if:advertisement_type,out_source',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Generate a unique filename
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Move the uploaded file to the public/advertisements directory
            $image->move(public_path('advertisements'), $imageName);

            // Save the image path in the validated array
            $validated['image'] = 'advertisements/' . $imageName; // Save the relative path to the database
        }else{
            unset($validated['image']);
        }

        $advertisement = Advertisement::findOrFail($id);
        $advertisement->update($validated);

        return redirect()->route('admin.advertisements.index')->with('success', 'Advertisement updated successfully!');
    }

    // View a single advertisement
    public function show($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        return view('admin.pages.advertisements.show', compact('advertisement'));
    }

    // View a single advertisement
    public function destroy($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        $advertisement->delete();

        return back();
        //return view('admin.pages.advertisements.show', compact('advertisement'));
    }


    // Fetch references based on the selected type
    public function getReferences($type)
    {
        $data = [];

        switch ($type) {
            case 'category_id':
                $data = Category::select('id', 'name_ar')->get();
                break;
            case 'product_id':
                $data = Product::select('id', 'name_ar')->get();
                break;
            case 'student_id':
                $data = Student::select('id', 'name_ar')->whereIn('gender',[1,2])->get();
                break;
            case 'brand_id':
                $data = Student::select('id', 'name_ar')->where('gender',3)->get();
                break;
            default:
                return response()->json([], 400); // Invalid type
        }

        return response()->json($data);
    }
}
