<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCheckInventoryRequest;
use App\Models\CheckInventory;
use App\Http\Controllers\Controller;
use App\Models\CheckInventoryProduct;
use App\Models\Product;
use App\Services\CheckInventoryServiceInterface;

class CheckInventoryController extends Controller
{
    protected $checkInventoryService;

    public function __construct(CheckInventoryServiceInterface $checkInventoryService)
    {
        $this->checkInventoryService = $checkInventoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checkInventories = CheckInventory::all();
        return view('admin.check_inventories.index', compact('checkInventories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('status', Product::STATUS_ACTIVE)->get();
        return view('admin.check_inventories.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCheckInventoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCheckInventoryRequest $request)
    {
        $this->checkInventoryService->createCheckInventory($request->all());
        flash('Thêm mới kiểm kho thành công!')->success();
        return redirect()->route('admin.check_inventories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $checkInventory = CheckInventory::findOrFail($id);
        $checkInventoryProducts = CheckInventoryProduct::where('check_inventory_id', $checkInventory->id)
            ->get(['product_id', 'inventory_reality', 'difference'])->toArray();
        $productIds = [];
        foreach ($checkInventoryProducts as $checkInventoryProduct) {
            array_push($productIds, $checkInventoryProduct['product_id']);
        }

        $products = Product::whereIn('id', $productIds)->get()->toArray();
        $productNews = [];
        foreach ($products as $product) {
            foreach ($checkInventoryProducts as $checkInventoryProduct) {
                if ($product['id'] == $checkInventoryProduct['product_id']) {
                   $product['inventory_reality'] = $checkInventoryProduct['inventory_reality'];
                   $product['difference'] = $checkInventoryProduct['difference'];
                    array_push($productNews, $product);
                }
            }
        }

        return view('admin.check_inventories.show', compact('checkInventory', 'productNews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::where('status', Product::STATUS_ACTIVE)->get();
        $checkInventory = CheckInventory::where('status', CheckInventory::STATUS_TEMPORARY)->findOrFail($id);
        $checkInventoryProducts = $checkInventory->checkInventoryProducts()->select('product_id', 'inventory_reality', 'id')->get();
        return view('admin.check_inventories.edit', compact('products', 'checkInventory', 'checkInventoryProducts'));}

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCheckInventoryRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCheckInventoryRequest $request, $id)
    {
        $this->checkInventoryService->updateCheckInventory($request->all(), $id);
        flash('Cập nhật kiểm kho thành công!')->success();
        return redirect()->route('admin.check_inventories.index');
    }

    public function balance($id)
    {
        $checkInventory = CheckInventory::findOrFail($id);
        $checkInventoryProducts = $checkInventory->checkInventoryProducts()->get();
        foreach ($checkInventoryProducts as $checkInventoryProduct) {
            Product::findOrFail($checkInventoryProduct->product_id)->update([
                'inventory' => $checkInventoryProduct->inventory_reality,
            ]);
        }
        $checkInventory->update([
            'time_balance' => now(),
            'status' => CheckInventory::STATUS_BALANCE
        ]);

        flash('Đã cân bằng kho!')->success();
        return redirect()->back();
    }

}
