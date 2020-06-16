<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use App\Models\Trademark;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductsImport implements ToModel, WithChunkReading, WithStartRow
{
    use Importable;

    /**
     * @var errors
     */
    private $errors;

    /**
     * @var row
     */
    private $row = 1;

    /**
     * UsersImport constructor.
     * @param StoreEntity $store
     */
    public function __construct($errors = [])
    {
        $this->errors = $errors;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (array_key_exists(++$this->row, $this->errors)) {
            return null;
        }

        $validator = Validator::make($row, [
            '0' => 'required|unique:products,product_code|string|max:10',
            '1' => 'required|unique:products,name|string|max:64',
            '2' => 'nullable|max:1024',
            '3' => 'required|in:' . Category::pluck('id')->implode(','),
            '4' => 'nullable|in:' . Trademark::pluck('id')->implode(','),
            '5' => 'required|digits_between:4,10',
            '6' => 'required|digits_between:4,10',
            '7' => 'required|integer|max:999',
            '8' => 'nullable|string|max:64',
            '9' => 'required|integer|between:0,999',
            '10' => 'required|integer|between:0,999',
            '11' => 'required|in:' . implode(',', array_keys(Product::$statuses)),
            '12' => 'nullable|string|max:255',
            '13' => 'nullable|string|max:65535'
        ]);

        if ($validator->fails()) {
            return null;
        }

        DB::beginTransaction();
        try {
            Product::create([
                'product_code' => $row[0],
                'name' => $row[1],
                'image_url' => $row[2],
                'category_id' => $row[3],
                'trademark_id' => $row[4],
                'sale_price' => $row[5],
                'entry_price' => $row[6],
                'inventory' => $row[7],
                'location' => $row[8],
                'inventory_level_min' => $row[9],
                'inventory_level_max' => $row[10],
                'status' => $row[11],
                'description' => $row[12],
                'note' => $row[13],
            ]);
            DB::commit();
        } catch (Exceptions $e) {
            DB::rollBack();
            Log::debug($e);
        }
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function startRow(): int
    {
        return 2;
    }
}
