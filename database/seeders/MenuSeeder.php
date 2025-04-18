<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newMenu = Menu::create([
            "role" => "admin",
            "name" => "menu",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "dashboard",
            "route" => "admin.dashboard",
            "icon" => "fa-regular fa-home",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "halaman kasir",
            "route" => "admin.transaction.index",
            "icon" => "fa-regular fa-cash-register",
        ]);

        $newMenu = Menu::create([
            "role" => "admin",
            "name" => "master data",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "produk",
            "route" => "admin.product.index",
            "icon" => "fa-regular fa-box",
        ]);

        $newMenu = Menu::create([
            "role" => "admin",
            "name" => "report",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "laporan",
            "route" => "admin.report.index",
            "icon" => "fa-regular fa-chart-simple-horizontal",
        ]);
    }
}
