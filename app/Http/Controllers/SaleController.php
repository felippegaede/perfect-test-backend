<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Sale;
use App\Product;
use App\Customer;
use App\Http\Requests\SaleRequest;
use Illuminate\Support\Str;

class SaleController extends Controller
{
    private $sale;

    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }

    public function create()
    {
        $products = Product::all();

        $customers = Customer::all();

        return view('sales.create', compact('products', 'customers'));
    }

    public function store(SaleRequest $request)
    {
        $data = $request->all();

        $date = $data['date'];

        $date = convertDate($date);

        $data['date'] = $date;

        $product = Product::find($data['product_id']);

        $data['discount'] = (float)(str_replace(",",".",$data['discount']));

        $data['total'] = ($product->price * $data['amount']) - $data['discount'];

        $sale = $this->sale->create($data);

        flash('Venda cadastrada com sucesso')->success();

        return redirect()->route('home');
    }

    public function edit($sale)
    {
        $sale = $this->sale->findOrFail($sale);

        $date = $sale['date'];

        $splitDate = explode('-', $date);

        $date = "{$splitDate[2]}/{$splitDate[1]}/{$splitDate[0]}";

        $sale['date'] = $date;

        $products = Product::all();
        $customers = Customer::all();

        return view('sales.edit', compact('sale', 'products', 'customers'));
    }

    public function update(SaleRequest $request, $sale)
    {
        $sale = $this->sale->find($sale);

        $data = $request->all();

        $date = $data['date'];

        $splitDate = explode('/', $date);

        $date = "{$splitDate[2]}-{$splitDate[1]}-{$splitDate[0]}";

        $data['date'] = $date;

        $data['discount'] = (float)(str_replace(",",".",$data['discount']));

        $product = Product::find($data['product_id']);

        $data['total'] = ($product->price * $data['amount']) - $data['discount'];

        $sale->update($data);

        flash('Venda atualizado com sucesso')->success();

        return redirect()->route('home');
    }

    public function destroy($sale)
    {
        $sale = $this->sale->find($sale);

        $sale->delete();

        flash('Venda excluído com sucesso')->success();

        return redirect()->route('home');
    }
}
