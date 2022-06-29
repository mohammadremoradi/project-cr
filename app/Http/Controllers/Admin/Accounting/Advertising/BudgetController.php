<?php

namespace App\Http\Controllers\Admin\Accounting\Advertising;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Accounting\Advertising\BudgetRequest;
use App\Models\Admin\Accounting\Advertising\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:accounting-advertise-budget', ['only' => [
            'index', 'store',
            'create', 'edit', 'update', 'show',
            'destroy'
        ]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgets = Budget::orderBy('id' , 'asc')->get();
        return view('admin.Accounting.advertise.budget.index' , compact('budgets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Accounting.advertise.budget.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BudgetRequest $request)
    {
        $inputs = $request->all();
        Budget::create($inputs);
        return to_route('budget.index')->with('success' , "Budget has been created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Budget $budget)
    {
        return view('admin.Accounting.advertise.budget.edit' , compact('budget'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BudgetRequest $request, Budget $budget)
    {
        $inputs = $request->all();

        $budget->update($inputs);

        return to_route('budget.index')->with('success' , "Budget has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Budget $budget)
    {
        $budget->delete();
        return to_route('budget.index')->with('success' , "Budget has been deleted");
    }
}
