<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Services\FileService;
use App\Http\Services\ProductService;
use App\Http\Services\ProductUpdateService;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $fileService;
    protected $productService;

    public function __construct()
    {
        $this->fileService=new FileService();
        $this->productService= new ProductService();

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $this->productService->index($request);
        if($request->ajax()){
        return datatables()->eloquent($query)->toJson();
        }else
        $data = Category::pluck('category_name' ,'id');
        return view('admin.product.index',['categories'=>$data]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Category::pluck('category_name' ,'id');
        return view('admin.product.create',['categories'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $validateData=$request->validated();

        $file = $request->file('image');
        //Move Uploaded File
        $destinationPath = 'assets/media/photos';

        $image=$this->fileService->fileUpload($file,$destinationPath);

        $product=$this->productService->create($validateData,$image);

        return redirect()->route('products.index')->with('success',"Added");
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
        $product = Product::where('id',$id)->with('category')->first();
        return view('admin.product.detail',['show'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::where('id',$id)->with('category')->first();
        // dd($product,$product->category->category_name);
        $data = Category::pluck('category_name' ,'id');
        return view('admin.product.edit',['edit'=>$product,'categories'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {


        $validateData=$request->validated();
        if(($request->image)==null)
        {
            // dd("redfs");

        $product=$this->productService->update($validateData,$id);
        }else
        {
            $file = $request->file('image');
            //Move Uploaded File
            $destinationPath = 'assets/media/photos';

            $image=$this->fileService->fileUpload($file,$destinationPath);
            unset($validateData['image']);

            $product=$this->productService->updateWithImage($destinationPath,$image, $id);
        }

        return redirect()->back()->with('success', "Updated");

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $product= Product::find($id)->delete();
       if($product){
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ],200);
      }else{
        return response()->json([
            'success' => 'Record has not deleted!'
        ],401);
      }
    }

    /**
     * update status from storage.
     */
    public function statusUpdate(Request $request, string $id)
    {
    //    dd("hj");
        $request->validate([
            'status'=>'required|boolean',
        ]);

        $product=Product::where('id',$id)->update([
            'status'=>$request->status,
        ]);
        if($product){
        return response()->json([
            'success' => 'Record has been updated successfully!'
        ],200);
       }else{
        return response()->json([
            'success' => 'Record has not updated !'
        ],401);
       }

    }


}
