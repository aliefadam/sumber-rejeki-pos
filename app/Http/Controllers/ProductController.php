<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return view("app.product.index", [
            "title" => "Data Produk",
            "products" => Product::all(),
        ]);
    }

    public function search($keyword)
    {
        $products = Product::where("name", "like", "%$keyword%")->get();

        return response()->json([
            "view" => view('components.product-item', [
                "products" => $products,
            ])->render(),
        ]);
    }

    public function create()
    {
        return view("app.product.create", [
            "title" => "Tambah Produk",
            "units" => Unit::all(),
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $newProduct = [
                "name" => $request->name,
                "unit_id" => $request->unit_id,
                "price" => $request->price,
                "is_active" => true,
            ];

            if ($request->hasFile("product_image")) {
                $file = $request->file("product_image");
                $fileName = "PRODUCT_IMAGE_" . date("Ymdhis") . "." . $file->extension();
                $file->move(public_path("uploads/products"), $fileName);
                $newProduct["image"] = $fileName;
            }

            Product::create($newProduct);
            DB::commit();

            return redirect_user("success", "Berhasil menambahkan produk", "admin.product.index");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect_user("error", $e->getMessage());
        }
    }

    public function edit($id)
    {
        return view("app.product.edit", [
            "title" => "Edit Produk",
            "product" => Product::find($id),
            "units" => Unit::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $updatedProduct = [
                "name" => $request->name,
                "unit_id" => $request->unit_id,
                "price" => $request->price,
            ];

            if ($request->hasFile("product_image")) {
                $file = $request->file("product_image");
                $fileName = "PRODUCT_IMAGE_" . date("Ymdhis") . "." . $file->extension();
                $file->move(public_path("uploads/products"), $fileName);
                $updatedProduct["image"] = $fileName;
            }

            Product::find($id)->update($updatedProduct);
            DB::commit();

            return redirect_user("success", "Berhasil mengubah produk", "admin.product.index");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect_user("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Product::find($id)->delete();
            DB::commit();

            notificationFlash("success", "Berhasil menghapus produk");
            return response()->json(["success" => true]);
        } catch (\Exception $e) {
            DB::rollback();

            notificationFlash("success", $e->getMessage());
            return response()->json(["success" => false]);
        }
    }
}
