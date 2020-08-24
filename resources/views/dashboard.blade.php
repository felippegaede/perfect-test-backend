@extends('layout')

@section('content')
<h1>Dashboard de vendas</h1>
<div class='card mt-3'>
    <div class='card-body'>
        <h5 class="card-title mb-5">Tabela de vendas
            <a href='{{route('sale.create')}}' class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i> Nova
                venda</a></h5>
        <form action="{{route('home')}}" method="GET">
            <div class="form-row align-items-center">
                <div class="col-sm-4 my-1">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Clientes</div>
                        </div>
                        <select class="form-control" name="filterSearch">
                            <option value="">Clientes</option>
                            @foreach ($customers as $customer)
                            <option value="{{$customer->id}}" @if ($customer->id == $filters['customer']) selected @endif>{{$customer->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 my-1">
                    <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Período</div>
                        </div>
                        <input type="text" class="form-control date_range" name="filterDate" value="{{$filters['period']}}">
                    </div>
                </div>
                <div class="col-sm-1 my-1">
                    <button type="submit" class="btn btn-primary" style='padding: 14.5px 16px;'> <i class='fa fa-search'></i></button>
                </div>
                <div class="col-sm-1 my-1">
                    <a href="{{route('home')}}"  class="btn btn-primary" style='padding: 14.5px 16px;'><i class='fa fa-times'></i></a>
                </div>
            </div>
        </form>
        <table class='table'>
            <thead>
                <tr>
                    <th scope="col">
                        Produto
                    </th>
                    <th scope="col">
                        Data
                    </th>
                    <th scope="col">
                        Valor
                    </th>
                    <th scope="col">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                <tr>
                    <td>
                        {{$sale->product->name}}
                    </td>
                    <td>
                        {{\Carbon\Carbon::parse($sale->date)->format('d/m/Y')}}
                    </td>
                    <td>
                        R$ {{number_format($sale->total, '2', ',', '.')}}
                    </td>
                    <td>
                        <div class="btn-group">
                            <form action="{{route('sale.destroy', ['sale' => $sale->id])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{route('sale.edit', ['sale'=>$sale->id])}}"class='btn btn-primary' style="margin-right: 5px">Editar</a>
                                <button type="submit" class='btn btn-primary' onclick="return confirm('Deseja deletar esta venda?');">Deletar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination justify-content-center">
            {{$sales->links()}}
        </div>
    </div>
</div>
<div class='card mt-3'>
    <div class='card-body'>
        <h5 class="card-title mb-5">Resultado de vendas</h5>
        <table class='table'>
            <tr>
                <th scope="col">
                    Status
                </th>
                <th scope="col">
                    Quantidade
                </th>
                <th scope="col">
                    Valor Total
                </th>
            </tr>
            <tr>
                <td>
                    Vendidos
                </td>
                <td>
                    {{$amountByStatus['Aprovado']}}
                </td>
                <td>
                    R$ {{number_format($totalByStatus['Aprovado'], '2', ',', '.')}}
                </td>
            </tr>
            <tr>
                <td>
                    Cancelados
                </td>
                <td>
                    {{$amountByStatus['Cancelado']}}
                </td>
                <td>
                    R$ {{number_format($totalByStatus['Cancelado'], '2', ',', '.')}}
                </td>
            </tr>
            <tr>
                <td>
                    Devoluções
                </td>
                <td>
                    {{$amountByStatus['Devolvido']}}
                </td>
                <td>
                    R$ {{number_format($totalByStatus['Devolvido'], '2', ',', '.')}}
                </td>
            </tr>
        </table>
    </div>
</div>

<div class='card mt-3'>
    <div class='card-body'>
        <h5 class="card-title mb-5">Produtos
            <a href='{{route('product.create')}}' class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i> Novo
                produto</a></h5>
        <table class='table'>
            <thead>
                <tr>
                    <th scope="col">
                        Nome
                    </th>
                    <th scope="col">
                        Valor
                    </th>
                    <th>
                        Imagem
                    </th>
                    <th scope="col">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>
                        {{$product->name}}
                    </td>
                    <td>
                        R$ {{number_format($product->price, '2', ',', '.')}}
                    </td>
                    <td>
                        @if ($product->image)
                        <img src="{{asset('storage/'.$product->image)}}" alt="Produto sem foto" style="width: 200px; height: 150px">
                        @else
                        <img src="{{asset('assets/img/no-img.png')}}" alt="Produto sem foto" style="width: 200px; height: 150px">
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <form action="{{route('product.destroy', ['product'=>$product->id])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{route('product.edit', ['product'=>$product->id])}}"class='btn btn-primary' style="margin-right: 5px">Editar</a>
                                <button type="submit" class='btn btn-primary' onclick="return confirm('Deseja deletar este produto?');">Deletar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination justify-content-center">
            {{$products->links()}}
        </div>
    </div>
</div>
@endsection
