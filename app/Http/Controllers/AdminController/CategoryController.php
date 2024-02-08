<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\StatusUpdateRequest;
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
            $data = $this->categoryService->index($request);
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
        unset($validateData['image']);

        $blog=$this->categoryService->create($validateData,$image);

        return redirect()->route('categories.index')->with('success',"Created");
    }



    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // $category = Category::where('id',$id)->first();
        return view('admin.category.detail',['show'=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // $category = Category::where('id',$id)->first();
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
        $category=$this->categoryService->update($validateData,$id);
        }else
        {
            $file = $request->file('image');
            //Move Uploaded File
            $destinationPath = 'assets/media/photos';
            $image=$this->fileService->fileUpload($file,$destinationPath);
            unset($validateData['image']);
            $category=$this->categoryService->updateWithImage($validateData,$image,$id);
        }

        return redirect()->back()->with('success', "Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Category::find($id)->delete();
        if($category){
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ],200);
       }
       else{
        return response()->json([
            'success' => 'Record has not deleted !'
        ],422);
       }
    }

    public function statusUpdate(StatusUpdateRequest $request, Category $id)
    {

        $validateData=$request->validated();
        // $category=Category::where('id',$id)->update([
        //     'status'=>$request->status,
        // ]);
        // $category=$id->update([
        //     'status'=>$request->status,
        // ]);
        $category=$this->categoryService->updateStatus($validateData,$id);

        if($category){
            return response()->json([
                'success' => 'Record has been updated successfully!'
            ],200);
        }else{
            return response()->json([
                'success' => 'Record has not updated!'
            ],422);
        }
    }

}
