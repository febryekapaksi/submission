<?php

namespace App\Http\Controllers;

use App\Models\BulanMaster;
use App\Models\DetailKejadian;
use Illuminate\Http\Request;
use App\Models\DetailKerugian;
use App\Models\DivisiMaster;
use App\Models\QuarterMaster;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        // Validasi file yang diunggah
        $request->validate([
            'jsonFile' => 'required|mimes:json|max:2048'
        ]);

        // Membaca isi file JSON
        $jsonFile = $request->file('jsonFile');
        $jsonData = file_get_contents($jsonFile->getPathName());
        $data = json_decode($jsonData, true);

        // Proses data jika ada
        foreach ($data as $item) {
            if ($item['name'] === 'Detail Kejadian Risiko Operasional') {
                $this->prosesDetailKejadian($item['payloads']);
            } elseif ($item['name'] === 'Detail Kerugian') {
                $this->prosesDetailKerugian($item['payloads']);
            }
        }

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }

    protected function prosesDetailKejadian($payloads)
    {
        $id = null;
        $bulanPelaporanId = null;
        $quarterId = null;
        $tanggalKejadian = null;
        $tanggalDitemukan = null;
        $deskripsiKejadian = null;
        $deskripsiPenyebab = null;

        foreach ($payloads as $payload) {
            if ($payload['label'] === 'Bulan Pelaporan') {
                $bulanPelaporanId = $payload['answer']['value'][0]['id'];
                foreach ($payload['options'] as $option) {
                    BulanMaster::updateOrCreate(['id' => $option['id']], ['label' => $option['label']]);
                }
            } elseif ($payload['label'] === 'Quarter') {
                $quarterId = $payload['answer']['value'][0]['id'];
                foreach ($payload['options'] as $option) {
                    QuarterMaster::updateOrCreate(['id' => $option['id']], ['label' => $option['label']]);
                }
            } elseif ($payload['label'] === 'Tanggal Kejadian') {
                $tanggalKejadian = $payload['answer']['value'];
            } elseif ($payload['label'] === 'Tanggal Ditemukan') {
                $tanggalDitemukan = $payload['answer']['value'];
            } elseif ($payload['label'] === 'Deskripsi Kejadian') {
                $deskripsiKejadian = $payload['answer']['value'];
            } elseif ($payload['label'] === 'Deskripsi Penyebab / Root Cause Terjadinya Kejadian') {
                $deskripsiPenyebab = $payload['answer']['value'];
            }
        }

        $id = $payload['parent_id'];

        DetailKejadian::create([
            'id' => $id,
            'bulan_pelaporan_id' => $bulanPelaporanId,
            'quarter_id' => $quarterId,
            'tanggal_kejadian' => $tanggalKejadian,
            'tanggal_ditemukan' => $tanggalDitemukan,
            'deskripsi_kejadian' => $deskripsiKejadian,
            'deskripsi_penyebab' => $deskripsiPenyebab
        ]);
    }

    protected function prosesDetailKerugian($payloads)
    {
        $id = null;
        $terkenaDampak = [];
        $kerugianFinancial = null;
        $potensialKerugianFinancial = null;
        $status = null;
        $kerugianNonFinancial = null;
    
        foreach ($payloads as $payload) {
            if ($payload['label'] === 'Terkena Dampak') {
                $terkenaDampak = $payload['answer']['value'];
                // Simpan divisi yang terkena dampak ke dalam tabel master divisi
                foreach ($payload['options'] as $option) {
                    DivisiMaster::updateOrCreate(['id' => $option['id']], ['label' => $option['label']]);
                }
            } elseif ($payload['label'] === 'Kerugian Financial') {
                $kerugianFinancial = $payload['answer']['value'] !== '-' ? $payload['answer']['value'] : null;
            } elseif ($payload['label'] === 'Potensial Kerugian Financial') {
                $potensialKerugianFinancial = $payload['answer']['value'];
            } elseif ($payload['label'] === 'Status') {
                $status = $payload['answer']['value'];
            } elseif ($payload['label'] === 'Kerugian Non-Financial') {
                $kerugianNonFinancial = $payload['answer']['value'];
            }
        }
    
        // Mendapatkan ID dari JSON payload
        $id = $payload['parent_id'];
    
        // Simpan data ke dalam tabel detail_kerugian
        $detailKerugian = DetailKerugian::create([
            'id' => $id,
            'kerugian_financial' => $kerugianFinancial,
            'potensial_kerugian_financial' => $potensialKerugianFinancial,
            'status' => $status,
            'kerugian_non_financial' => $kerugianNonFinancial,
        ]);
    
        // Simpan relasi dengan divisi yang terkena dampak
        $detailKerugian->divisi()->sync($terkenaDampak);
    }
}
