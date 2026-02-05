<?php

namespace App\Queries;
use App\Models\GlobalVariable AS Model;

class GlobalVariableQuery
{
    public static function getConfigRole() {
        return Model::where('param_type','ROLE')->where('param_code','CONFIG_ROLE')->first();
    }

    public static function getKurs() {
        return Model::where('param_type','KURS')->get();
    }

    public static function purchasePesananDibuat(){
        return Model::where('param_type','PURCHASING')->where('param_code','PESANAN_DIBUAT')->first();
    }

    public static function purchaseWaitingApproveDirector(){
        return Model::where('param_type','PURCHASING')->where('param_code','MENUNGGU_APPROVAL_DIREKSI')->first();
    }

    public static function purchaseRevisi(){
        return Model::where('param_type','PURCHASING')->where('param_code','REVISI')->first();
    }

    public static function purchaseSelesai(){
        return Model::where('param_type','PURCHASING')->where('param_code','SELESAI')->first();
    }

    public static function purchaseWaitingItem(){
        return Model::where('param_type','PURCHASING')->where('param_code','MENUNGGU BARANG')->first();
    }

    public static function purchaseApprovedDirector(){
        return Model::where('param_type','PURCHASING')->where('param_code','DISETUJUI DIREKSI')->first();
    }

    public static function paymentBelumBayar(){
        return Model::where('param_type','PAYMENT')->where('param_code','BELUM_DIBAYAR')->first();
    }
    public static function paymentLunas(){
        return Model::where('param_type','PAYMENT')->where('param_code','LUNAS')->first();
    }
    public static function paymentBayarBertahap(){
        return Model::where('param_type','PAYMENT')->where('param_code','BAYAR_BERTAHAP')->first();
    }
    public static function getData($id) {
        return Model::find($id);
    }
}
