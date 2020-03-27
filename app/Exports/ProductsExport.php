<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel;

class ProductsExport implements FromCollection, WithHeadings, Responsable, ShouldAutoSize
{
    use Exportable;

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'Danh sách sản phẩm.xlsx';

    /**
     * Optional Writer Type
     */
    private $writerType = Excel::XLSX;

    /**
     * Optional headers
     */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $products = Product::all();
        foreach ($products as $row) {
            $product[] = array(
                '0' => $row->product_code,
                '1' => $row->qr_code,
                '2' => $row->name,
                '3' => $row->image_url,
                '4' => $row->category_id,
                '5' => $row->trademark_id,
                '6' => $row->sale_price,
                '7' => $row->entry_price,
                '8' => $row->inventory,
                '9' => $row->location,
                '10' => $row->inventory_level_min,
                '11' => $row->inventory_level_max,
                '12' => $row->status,
                '13' => $row->type,
                '14' => $row->description,
                '15' => $row->note,
            );
        }

        return (collect($product));
    }

    public function headings(): array
    {
        return [
            'Mã sản phẩm',
            'Mã QR',
            'Tên sản phẩm',
            'Hình ảnh',
            'Danh mục',
            'Thương hiệu',
            'Gía bán',
            'Gía gốc',
            'Tồn kho',
            'Nơi đặt',
            'Tồn nhỏ nhất',
            'Tồn lớn nhất',
            'Trạng thái',
            'Loại sản phẩm',
            'Mô tả',
            'Ghi chú',
        ];
    }
}
