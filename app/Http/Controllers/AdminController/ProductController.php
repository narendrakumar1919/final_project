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
    protected $productUpdateService;
    public function __construct()
    {
        $this->fileService=new FileService();
        $this->productService= new ProductService();
        $this->productUpdateService=new ProductUpdateService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $query= Product::query()->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.id', 'products.product_name', 'products.description', 'categories.category_name', 'products.image', 'products.status');

            if (isset($request->status) && isset($request->category_id)) {
                $query = $query->where(function ($query) use ($request) {
                    $query->where('products.status', $request->status)
                          ->orWhere('categories.id', $request->category_id);
                });
            } elseif (isset($request->status)) {
                $query = $query->where('products.status', $request->status);
            } elseif (isset($request->category_id)) {
                $query = $query->where('categories.id', $request->category_id);
            }

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

        $inputs=[

            'product_name' => $validateData['product_name'],
            'category_id' => $validateData['category_id'],
            'description' => $validateData['description'],
            'image' => $image,
            'status'=>'1',

        ];

        $product=$this->productService->create($inputs);

        return redirect()->route('products.index');
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
        $inputs=[
            'product_name' => $validateData['product_name'],
            'category_id' => $validateData['category_id'],
            'description' => $validateData['description'],
        ];

        $product=$this->productService->update($inputs,$id);
        }else
        {
            $file = $request->file('image');
            //Move Uploaded File
            $destinationPath = 'assets/media/photos';

            $image=$this->fileService->fileUpload($file,$destinationPath);

            $inputs=[
                'product_name' => $validateData['product_name'],
                'category_id' => $validateData['category_id'],
                'description' => $validateData['description'],
                'image' => $image,
            ];
            $product=$this->productService->updateWithImage($inputs,$id);
        }

        return redirect()->back()->with('success', "Updated");

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::find($id)->delete();
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ],200);
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

        return response()->json([
            'success' => 'Record has been updated successfully!'
        ],200);

    }


}
