<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();

        foreach ($products as $product) {
            if ($product->type == 1) {
                $product->type_name = 'software';
            } else {
                $product->type_name = 'servicio';
            }
        }

        return response()->json($products, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sku)
    {
        $product = Product::where('sku', $sku)->first();

        if ($product) {
            return response()->json(['status' => 'ok', 'response' => $product]);
        } else {
            return response()->json(['status' => 'error', 'response' => 'invalid sku']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'price' => 'required|numeric',
            'type' => ['required', Rule::in([1, 2])],
            'sku' => 'required|unique:products,sku'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'data_validation_failed',
                "error_list" => $validator->errors()
            ], 400);
        }
        $license = null;
        $so = null;
        if ($request->type == 1) {
            $validator = Validator::make($request->all(), [
                'so' => ['required', Rule::in(['Windows', 'Mac'])]
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => 'data_validation_failed',
                    "error_list" => $validator->errors()
                ], 400);
            }

            $so = $request->so;
            $license = $this->getLicense();
        }

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'so' => $so,
            'license' => $license,
            'sku' => $request->sku,
            'type' => $request->type,
            'is_delete' => "0"
        ]);

        return response()->json(['status' => 'ok', 'response' => $product]);
    }

    protected function getLicense()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $license = substr(str_shuffle($permitted_chars), 0, 100);

        $validate = Product::where('license', $license)->first();
        if (!$validate) {
            return $license;
        } else {
            $this->getLicense();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sku)
    {
        $product = Product::where('sku', $sku)->first();
        if ($product) {
            $validator = Validator::make($request->all(), [
                'name' => 'string',
                'price' => 'numeric',
                'sku' => 'unique:products,sku,except,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => 'data_validation_failed',
                    "error_list" => $validator->errors()
                ], 400);
            }

            $product->update([
                'name' => $request->name ?? $product->name,
                'price' => $request->price ?? $product->price,
                'sku' => $request->sku ?? $product->sku
            ]);

            return response()->json(['status' => 'ok', 'response' => $product]);
        } else {
            return response()->json(['status' => 'error', 'response' => 'invalid_sku']);
        }
    }

    public function isDelete($sku)
    {
        $product = Product::where('sku', $sku)->first();
        if ($product) {
            $product->update([
                'is_delete' => '1'
            ]);

            return response()->json(['status' => 'ok', 'response' => $product]);
        } else {
            return response()->json(['status' => 'error']);
        }
    }
}
