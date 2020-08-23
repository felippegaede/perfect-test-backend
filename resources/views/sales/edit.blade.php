@extends('layout')

@section('content')
    <h1>Editar Venda</h1>
    <div class='card'>
        <div class='card-body'>
            <a id = "new-customer" href='{{route('customer.create')}}' class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-edit'></i> Editar
                cliente</a></h5>
            <form action="{{route('sale.update', ['sale'=>$sale->id])}}" method="POST">
                @csrf
                @method('PUT')
                <h5>Selecione cliente</h5>
                <div class="form-group">
                    <label for="customer_id">Cliente</label>
                    <select id="customer_id" name="customer_id" class="form-control @error('customer_id') is-invalid @enderror">
                        <option value=''>Escolha...</option>
                        @foreach ($customers as $customer)
                        <option @if ($customer->id == $sale->customer_id) selected @endif value='{{$customer->id}}'>{{$customer->name}}</option>
                        @endforeach
                    </select>
                    @error('customer_id')
                    <small class='invalid-feedback'>{{$message}}</small>
                    @enderror
                </div>
                <h5 class='mt-5'>Informações da venda</h5>
                <div class="form-group">
                    <label for="product_id">Produto</label>
                    <select name="product_id" class="form-control @error('product_id') is-invalid @enderror">
                        <option value='' selected>Escolha...</option>
                        @foreach ($products as $product)
                        <option @if ($product->id == $sale->product_id) selected @endif value='{{$product->id}}'>{{$product->name}}</option>
                        @endforeach
                    </select>
                    @error('product_id')
                    <small class='invalid-feedback'>{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="date">Data</label>
                    <input type="text" class="form-control single_date_picker" name="date" value="{{$sale->date}}">
                </div>
                <div class="form-group">
                    <label for="amount">Quantidade</label>
                    <input type="text" class="form-control @error('amount') is-invalid @enderror" value="{{$sale->amount}}" name="amount" placeholder="1 a 10">
                    @error('amount')
                    <small class='invalid-feedback'>{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="discount">Desconto</label>
                    <input type="text" class="form-control @error('discount') is-invalid @enderror" value="{{number_format($sale->discount,'2',',','')}}" name="discount" placeholder="100,00 ou menor">
                    @error('discount')
                    <small class='invalid-feedback'>{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                        <option value='' selected>Escolha...</option>
                        <option @if ($sale->status == 'Aprovado') selected @endif>Aprovado</option>
                        <option @if ($sale->status == 'Cancelado') selected @endif>Cancelado</option>
                        <option @if ($sale->status == 'Devolvido') selected @endif>Devolvido</option>
                    </select>
                    @error('status')
                    <small class='invalid-feedback'>{{$message}}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
@section('script')
<script>

    const btn = document.querySelector('#new-customer');

    const selectCustomer = document.querySelector('#customer_id');

    selectCustomer.addEventListener('change', (e)=>{

        if (selectCustomer.value > 0){

            btn.innerHTML = "<i class='fa fa-edit'></i> Editar Cliente"
            btn.href = `/customers/${selectCustomer.value}/edit`

        }else{

            btn.innerHTML = "<i class='fa fa-plus'></i> Novo Cliente"
            btn.href = "{{route('customer.create')}}"
        }
    })

</script>
@endsection
