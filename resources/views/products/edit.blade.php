@extends('layout')

@section('content')
<h1>Editar Produto</h1>
<div class='card'>
    <div class='card-body'>
        <form action="{{route('product.update', ['product' => $product->id])}}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nome do produto</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{$product->name}}">
                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea type="text" rows='5' class="form-control @error('description') is-invalid @enderror"
                    id="description" name="description">{{$product->description}}</textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">Preço</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                    placeholder="100,00 ou maior" name="price" value="{{number_format($product->price,'2',',','')}}">
                @error('price')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Imagem do produto</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                @error('image')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
        @if ($product->image)
        <div class="row justify-content-center" style="margin-top: 50px">
            <div class="col-auto text-center">
                <img src="{{asset('storage/'.$product->image)}}" style="width: 250px; height: 200px">
                <form action="{{route('products.image.remove')}}" method="POST">
                    <input type="hidden" name="imageName" value="{{$product->image}}">
                    @csrf
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Deseja remover a imagem do produto?');" style="margin-top: 5px">Remover</button>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
