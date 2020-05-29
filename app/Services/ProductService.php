<?php
namespace App\Services;

use App\Models\Product;
use App\Traits\UploadTrait;

class ProductService implements ProductServiceInterface
{
    use UploadTrait;

    /**
     * create product
     *
     * @param array $params
     * @return \Illuminate\Http\Response
     */
    public function createProduct(array $params)
    {
        \DB::beginTransaction();

        if (!isset($params['product_code'])) {
            $last = Product::orderBy('product_code', 'desc')->first();
            $product_code = $last->product_code;
            $product_code++;
            $params['product_code'] = $product_code;
        }
        if (isset($params['image_url'])) {
            $image = $params['image_url'];
            $name = uniqid();
            $folder = Product::FOLDER;
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $params['image_url'] = $filePath;
        }
        $params['status'] = 1;
        Product::create($params);

        \DB::commit();
    }

    /**
     * update product
     *
     * @param array $params
     * @param int $id
     * @return void
     */
    public function updateProduct(array $params, int $id)
    {
        \DB::beginTransaction();
        $product = Product::findOrFail($id);

        if (isset($params['image_url'])) {
            $image = $params['image_url'];
            $name = uniqid();
            $folder = Product::FOLDER;
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $params['image_url'] = $filePath;
        }
        $product->update($params);

        \DB::commit();
    }
}
