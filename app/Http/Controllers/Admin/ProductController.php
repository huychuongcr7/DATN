<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ImportExcelFileRequest;
use App\Http\Requests\StoreProductRequest;
use App\Imports\ProductsImport;
use App\Imports\ValidateExcelFile;
use App\Models\Category;
use App\Models\Product;
use App\Models\Trademark;
use App\Services\ProductServiceInterface;
use App\Http\Controllers\Controller;
use App\Exports\ProductsExport;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $trademarks = Trademark::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $statuses = Product::$statuses;
        $types = Product::$types;
        return view('admin.products.create', compact('trademarks', 'categories', 'statuses', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProductRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request)
    {
        $this->productService->createProduct($request->all());
        flash('Thêm mới sản phẩm thành công!')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id)
    {
        $trademarks = Trademark::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $statuses = Product::$statuses;
        $types = Product::$types;
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product', 'trademarks', 'categories', 'statuses', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(StoreProductRequest $request, $id)
    {
        $this->productService->updateProduct($request->all(), $id);
        flash('Cập nhật sản phẩm thành công!')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        flash('Xóa sản phẩm thành công!')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return new ProductsExport();
    }

    /**
     * @param ImportExcelFileRequest $request
     * @return RedirectResponse
     */
    public function import(ImportExcelFileRequest $request)
    {
        $validator = new ValidateExcelFile();
        Excel::import($validator, $request->file('excel_file'));
        if (count($validator->errors)) {
            $errors = [];
            foreach ($validator->errors as $key => $error) {
                $errors[$key] = $key + 1;
            }
            (new ProductsImport($errors))->queue($request->file('excel_file'));
            flash('Hàng số ' . implode(',', $errors) . ' chứa dữ liệu không chính xác!')->error();
            return redirect()->back();
        } elseif (!$validator->isValidFile) {
            return redirect()->back();
        }

        (new ProductsImport())->queue($request->file('excel_file'));
        flash('Import sản phẩm thành công!')->success();
        return redirect()->back();
    }

    /**
     * stop sale product
     *
     * @param $id
     * @return RedirectResponse
     */
    public function stop($id)
    {
        $product = Product::find($id);
        $product->status = 2;
        $product->save();
        return redirect()->back();
    }

    /**
     * resale product
     *
     * @param $id
     * @return RedirectResponse
     */
    public function active($id)
    {
        $product = Product::find($id);
        $product->status = 1;
        $product->save();
        return redirect()->back();
    }
}
