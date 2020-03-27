<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use App\Models\Trademark;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductsImport implements ToModel, ShouldQueue, WithChunkReading, WithStartRow
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
            '1' => 'nullable|string|max:64',
            '2' => 'required|unique:products,name|string|max:64',
            '3' => 'nullable|max:1024',
            '4' => 'required|in:' . Category::pluck('id')->implode(','),
            '5' => 'nullable|in:' . Trademark::pluck('id')->implode(','),
            '6' => 'required|digits_between:4,10',
            '7' => 'required|digits_between:4,10',
            '8' => 'required|integer|max:999',
            '9' => 'nullable|string|max:64',
            '10' => 'required|integer|between:0,999',
            '11' => 'required|integer|between:0,999',
            '12' => 'required|in:' . implode(',', array_keys(Product::$statuses)),
            '13' => 'required|in:' . implode(',', array_keys(Product::$types)),
            '14' => 'nullable|string|max:255',
            '15' => 'nullable|string|max:65535'
        ]);

        if ($validator->fails()) {
            return null;
        }

        DB::beginTransaction();
        try {
            Product::create([
                'product_code' => $row[0],
                'qr_code' => $row[1],
                'name' => $row[2],
                'image_url' => $row[3],
                'category_id' => $row[4],
                'trademark_id' => $row[5],
                'sale_price' => $row[6],
                'entry_price' => $row[7],
                'inventory' => $row[8],
                'location' => $row[9],
                'inventory_level_min' => $row[10],
                'inventory_level_max' => $row[11],
                'status' => $row[12],
                'type' => $row[13],
                'description' => $row[14],
                'note' => $row[15],
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
