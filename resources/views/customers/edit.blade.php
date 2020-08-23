@extends('layout')

@section('content')
    <h1>Editar Cliente</h1>
    <div class='card'>
        <div class='card-body'>
            <form action="{{route('customer.update', ['customer' => $customer->id])}}" method="POST">
                @csrf
                @method('PUT')
                <h5>Informações do cliente</h5>
                <div class="form-group">
                    <label for="name">Nome do cliente</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{$customer->name}}" name="name">
                    @error('name')
                    <small class='invalid-feedback'>{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{$customer->email}}" name="email">
                    @error('email')
                    <small class='invalid-feedback'>{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control @error('document') is-invalid @enderror" value="{{$customer->document}}" name="document" placeholder="99999999999">
                    @error('document')
                    <small class='invalid-feedback'>{{$message}}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
