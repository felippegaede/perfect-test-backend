<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Sale;
use App\Product;

class HomeController extends Controller
{
    private $sale;
    private $product;

    public function __construct(Sale $sale, Product $product, Customer $customer)
    {
        $this->sale = $sale;
        $this->product = $product;
        $this->customer = $customer;
    }

    public function index(Request $request)
    {
        $filters = ['customer' => '', 'period' => ''];
        $startDate = '';
        $endDate = '';

        if (request('filterSearch')) {

            $period = request('filterDate');
            $dateSplit = explode('-', $period);
            $startDate = convertDate($dateSplit[0]);
            $endDate = convertDate($dateSplit[1]);

            if ($startDate != $endDate) {

                $sales = $this->sale->where('customer_id', request('filterSearch'))->where('date', '>=', $startDate)->where('date', '<=', $endDate)->paginate(5)->appends('filterSearch', request('filterSearch'))->appends('filterDate', request('filterDate'));
            } else {

                $sales = $this->sale->where('customer_id', request('filterSearch'))->paginate(5)->appends('filterSearch', request('filterSearch'))->appends('filterDate', request('filterDate'));
            }

            $filters = [
                'customer' => request('filterSearch'),
                'period' => $period
            ];
        } elseif (request('filterDate') and !request('filterSearch')) {

            $period = request('filterDate');
            $dateSplit = explode('-', $period);
            $startDate = convertDate($dateSplit[0]);
            $endDate = convertDate($dateSplit[1]);

            if ($startDate != $endDate) {

                $sales = $this->sale->where('date', '>=', $startDate)->where('date', '<=', $endDate)->paginate(5)->appends('filterSearch', request('filterSearch'))->appends('filterDate', request('filterDate'));
            }else{

                $sales = $this->sale->paginate(5);

                flash('O período deve ser superior a um dia.')->warning();
            }
        } else {

            $sales = $this->sale->paginate(5);
        }

        $products = $this->product->paginate(5);
        $customers = $this->customer->all();
        $totalSales = $this->sale->all();

        $amountByStatus = [
            'Aprovado' => $totalSales->where('status', 'Aprovado')->count(),
            'Cancelado' => $totalSales->where('status', 'Cancelado')->count(),
            'Devolvido' => $totalSales->where('status', 'Devolvido')->count(),
        ];

        $totalByStatus = [
            'Aprovado' => $totalSales->where('status', 'Aprovado')->sum('total'),
            'Cancelado' => $totalSales->where('status', 'Cancelado')->sum('total'),
            'Devolvido' => $totalSales->where('status', 'Devolvido')->sum('total'),
        ];

        return view('dashboard', compact('sales', 'products', 'customers', 'amountByStatus', 'totalByStatus', 'filters'));
    }
}
