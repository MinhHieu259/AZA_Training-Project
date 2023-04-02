<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class DeliveryDataExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function headings(): array
    {
        return [
            '納入先コード',
            '納入先名',
            'フリガナ',
            '郵便番号',
            '住所',
            '電話番号',
            'FAX番号',
            '納入先分類1',
            '納入先分類2',
            '納入先分類3',
            '備考',
            '登録日付',
            '登録利用者',
            '最終更新',
            '最終利用者名'
        ];
    }

    public function map($delivery): array
    {
        return [
            $delivery->delivery_id,
            $delivery->delivery_name_1,
            $delivery->delivery_furigana_1,
            $delivery->zipcode,
            $delivery->province_name,
            $delivery->phone,
            $delivery->fax_number,
            $delivery->delivery_category_1,
            $delivery->delivery_category_2,
            $delivery->delivery_category_3,
            $delivery->note,
            $delivery->time_created,
            $delivery->author_name,
            $delivery->time_updated,
            $delivery->people_update
        ];
    }

    public function collection()
    {
        $data = [
            (string)$this->request['delivery_id'],
            (string)$this->request['delivery_name'],
            (string)$this->request['furigana'],
            (string)$this->request['address'],
            (string)$this->request['phone'],
            (string)$this->request['delivery_category_1'],
            (string)$this->request['delivery_category_2'],
            (string)$this->request['delivery_category_3']
        ];
        $results = DB::select('EXEC searchDelivery ?, ?, ?, ?, ?, ?, ?, ?', $data);
        return collect($results);
    }

    public function styles(Worksheet $sheet)
    {
        // Thiết lập Style object cho tiêu đề cột
        $styleHeader = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFFF00',
                ]
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];

        // Thiết lập Style object cho các ô chứa dữ liệu
        $styleData = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];

        // Áp dụng Style object cho tiêu đề cột
        $sheet->getStyle('A1:O1')->applyFromArray($styleHeader);

        // Lấy ra vùng dữ liệu
        $dataRange = 'A2:O' . ($sheet->getHighestRow());

        // Áp dụng Style object cho các ô chứa dữ liệu
        $sheet->getStyle($dataRange)->applyFromArray($styleData);

    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('A1:O1')->getFont()->setBold(true);
            },
        ];
    }
}
