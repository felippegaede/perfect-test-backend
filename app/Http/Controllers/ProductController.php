<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {

            $image = $this->imageUpload($request);

            $data['image'] = $image;
        }

        $data['price'] = (float)(str_replace(",",".",$data['price']));

        $product = $this->product->create($data);

        flash('Produto cadastrado com sucesso')->success();

        return redirect()->route('home');
    }

    public function edit($product)
    {
        $product = $this->product->findOrFail($product);

        return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, $product)
    {
        $product = $this->product->find($product);

        $data = $request->all();

        if ($request->hasFile('image')) {

            $image = $this->imageUpload($request);

            $data['image'] = $image;
        }

        $data['price'] = (float)(str_replace(",",".",$data['price']));

        $product->update($data);

        flash('Produto atualizado com sucesso')->success();

        return redirect()->route('home');
    }

    public function destroy($product)
    {
        try {
            $product = $this->product->find($product);

            $product->delete();

            flash('Produto excluído com sucesso')->success();
        } catch (\Exception $e) {

            if ($e->getCode() == '23000') {

                flash("O produto não pode ser excluído, pois há vendas cadastradas com esse produto.")->error();
            } else {

                flash("O produto não pode ser excluído. Código do erro {$e->getCode()}")->error();
            }
        }

        return redirect()->route('home');
    }

    private function imageUpload(Request $request)
    {
        $image = $request->file('image');

        return $image->store('products', 'public');
    }

    public function imageRemove(Request $request)
    {
        $imageName = $request->get('imageName');

        if (Storage::disk('public')->exists($imageName)) Storage::disk('public')->delete($imageName);

        $product_id = Product::where('image', $imageName)->first()->id;

        Product::where('image', $imageName)->update(['image' => null]);

        flash('Imagem excluída com sucesso');

        return redirect()->route('product.edit', ['product' => $product_id]);
    }
}
