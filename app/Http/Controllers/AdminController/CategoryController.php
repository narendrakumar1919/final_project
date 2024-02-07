<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Services\CategoryService;
use App\Models\Category;
use App\Http\Services\FileService;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    protected $fileService;
    protected $categoryService;
    public function __construct()
    {
        $this->fileService=new FileService();
        $this->categoryService= new CategoryService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // if($request->ajax()){
        //     return datatables()->eloquent(Category::query())->toJson();
        // }else
        // return view('admin.category.index');

        if ($request->ajax()) {
            $data = Category::select('*');
            if(isset($request->status)){
                $data = $data->where('status', $request->status );
            }
            return datatables()->eloquent($data)->toJson();
        }

        return view('admin.category.index');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $validateData=$request->validated();
        $file = $request->file('image');
        //Move Uploaded File
        $destinationPath = 'assets/media/photos';

        $image=$this->fileService->fileUpload($file,$destinationPath);

        $inputs=[
            'category_name' => $validateData['category_name'],
            'description' => $validateData['description'],
            'image' => $image,
            'status'=>'1'
        ];
        $blog=$this->categoryService->create($inputs);

        return redirect()->route('categories.index')->with('success',"Created");
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::where('id',$id)->first();
        return view('admin.category.detail',['show'=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',['edit'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $validateData=$request->validated();
        if(($request->image)==null)
        {
        $inputs=[
            'category_name' => $validateData['category_name'],
            'description' => $validateData['description'],
        ];

        $category=$this->categoryService->update($inputs,$id);
        }else
        {
            $file = $request->file('image');
            //Move Uploaded File
            $destinationPath = 'assets/media/photos';

            $image=$this->fileService->fileUpload($file,$destinationPath);

            $inputs=[
                'category_name' => $validateData['category_name'],
                'description' => $validateData['description'],
                'image' => $image,
            ];
            $category=$this->categoryService->updateWithImage($inputs,$id);
        }

        return redirect()->back()->with('success', "Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();

        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ],200);
    }

    public function statusUpdate(Request $request, string $id)
    {
    //    dd("hj");
        $request->validate([
            'status'=>'required|boolean',
        ]);

        $category=Category::where('id',$id)->update([
            'status'=>$request->status,
        ]);

        return response()->json([
            'success' => 'Record has been updated successfully!'
        ],200);

    }

}
