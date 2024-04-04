<?php

namespace App\Imports;

use App\Models\Car;
use App\Models\CarsModel;
use App\Models\CateModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Symfony\Component\Finder\Exception\AccessDeniedException;



class CarsImport implements ToCollection, WithHeadingRow, WithStartRow, WithValidation, WithChunkReading    
{
    private int $countRow = 0;  
    private $resultImport;  
    public function collection(Collection $rows)
    {
        // dd(2,$rows,1);
        foreach ($rows as $key => $value) {
            
            // dd($value);
            $category = CateModel::query()->where('name',$value['cate_id'])->first();
            // dd($category->id);
            $data = [
                'name' => $value['name'],
                'brand' => $value['brand'],
                'seat' => $value['seat'],
                'status' => $value['status'],
                'date' => $value['date'],
                'cate_id' => $category->id,
                'description' => $value['description'],
                'price' => $value['price'],
            ];
            CarsModel::insert($data);
        }
        $this->resultImport = [
            'status' => true,
            'msg' => 'OK'
        ];
        //  

    }

    public function chunkSize(): int
    {
        return 50;
    }


    private function resetRowNumber()
    {
        $this->countRow = 0;
    }


    private function increaseRowNumber()
    {   
        
        $this->countRow++;
    }

    public function getRowNumber(): int
    {
        return $this->startRow() - 1 + $this->countRow;
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function startRow(): int
    {
        return 5;
    }

    public function getResultImport()
    {
        return $this->resultImport;
    }

    public function rules(): array
    {
        $rules = [
            '*.name' => 'required|unique:cars,name',
            '*.brand' => 'required',            
        ];
        return $rules;
    }
};      