<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryAddRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Services\CategoryService;
use App\Models\Category;
use App\Models\Product;
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
    public function store(CategoryAddRequest $request)
    {
        $file = $request->file('image');
        //Move Uploaded File
        $destinationPath = 'assets/media/photos';

        $image=$this->fileService->fileUpload($file,$destinationPath);

        $inputs=[
            'category_name' => $request->category_name,
            'description' => $request->description,
            'image' => $image,
            'status'=>'1'

        ];
        $blog=$this->categoryService->create($inputs);

        return redirect()->route('categories.index');
    }

    // public function (Request $request)
    // {
    //     if($request->ajax()){
    //         return datatables()->eloquent(Blog::query())->toJson();
    //     }else{

    //     return view('blog.admin');
    //     }

    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Category::where('id',$id)->first();
        return view('admin.category.detail',['show'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Category::where('id',$id)->first();
        return view('admin.category.edit',['edit'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
        // dd(request()->all());
        if($request->image==null)
        {
        $product=Category::where('id',$id)->update([
            'category_name' => $request->category_name,
            'description' => $request->description,
        ]);
        }else
        {
            $file = $request->file('image');
            //Move Uploaded File
            $destinationPath = 'assets/media/photos';

            $image=$this->fileService->fileUpload($file,$destinationPath);

            $inputs=[
                'category_name' => $request->category_name,
                'description' => $request->description,
                'image' => $image,
            ];
            $product=Category::where('id',$id)->update($inputs);
        }

        $product = Category::where('id',$id)->first();
        return view('admin.category.edit',['edit'=>$product]);
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
