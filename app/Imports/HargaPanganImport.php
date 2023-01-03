<?php

namespace App\Imports;

use App\Models\HargaPangan;
use App\Models\KategoriPangan;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class HargaPanganImport implements
    ToModel,
    WithHeadingRow,
    WithValidation,
    SkipsOnFailure
{
    use Importable, SkipsFailures;

    public function __construct($pangan_id)
    {
        $this->pangan_id = $pangan_id;
    }

    public function model(array $row)
    {
        $kategori = KategoriPangan::where('kategori', $row['kategori'])->first();

        return new HargaPangan([
            'pangan_id' => $this->pangan_id,
            'kategori' => $kategori->id,
            'nama' => $row['nama'],
            'harga' => $row['harga']
        ]);
    }

    public function rules(): array
    {
        return [
            'kategori' => 'required',
            'nama' => 'required',
            'harga' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'kategori.required' => 'Kategori kosong!',
            'nama.required' => 'Nama kosong!',
            'harga.required' => 'Harga kosong!',
        ];
    }
}
