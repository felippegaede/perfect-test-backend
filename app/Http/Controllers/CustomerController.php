<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{
    private $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(CustomerRequest $request)
    {
        $customer = $this->customer->create($request->all());

        flash('Cliente cadastrado com sucesso')->success();

        return redirect()->route('sale.create');
    }

    public function edit($customer)
    {
        $customer = $this->customer->findOrFail($customer);

        return view('customers.edit', compact('customer'));
    }

    public function update(CustomerRequest $request, $customer)
    {
        $customer = $this->customer->find($customer);

        $customer->update($request->all());

        flash('Cliente atualizado com sucesso')->success();

        return redirect()->route('sale.create');
    }
}
