<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use App\Models\Trademark;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ValidateExcelFile implements ToCollection, WithStartRow
{
    /**
     * @var errors
     */
    public $errors = [];

    /**
     * @var isValidFile
     */
    public $isValidFile = false;

    /**
     * ValidateCsvFile constructor.
     * @param StoreEntity $store
     */
    public function __construct()
    {
        //
    }

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        $errors = [];
        if (count($rows) > 1) {
            $rows = $rows->slice(1);
            foreach ($rows as $key => $row) {
                $validator = Validator::make($row->toArray(), [
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
                    $errors[$key] = $validator;
                }
            }
            $this->errors = $errors;
            $this->isValidFile = true;
        }
    }

    public function startRow(): int
    {
        return 1;
    }
}
