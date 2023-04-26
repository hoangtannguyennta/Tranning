<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Drinking\DrinkingRepository;
use App\Models\Pub;
use App\Models\Drinking;

class DrinkingController extends Controller
{
    /**
     * @var DrinkingRepositoryInterface|\App\Repositories\Repository
     */
    protected $drinkingRepo;

    public function __construct(DrinkingRepository $drinkingRepo)
    {
        $this->drinkingRepo = $drinkingRepo;
    }

    public function index()
    {
        $data = [
            'drinkings' => $this->drinkingRepo->getProduct(),
        ];

        return view('home.list', $data);
    }


    public function create()
    {
        $pubs = Pub::get(['id', 'product_name', 'amount']);
        return view('home.create', compact('pubs'));
    }

    public function store(Request $request)
    {
        $this->drinkingRepo->createDrinking($request->all());

        return redirect()->back()->with('success', '#');
    }

    public function edit($id)
    {
        $drinks = Drinking::find($id);
        $pubs = Pub::get(['id', 'product_name', 'amount']);
        $pubs_id = $drinks->drinkingPubs->pluck('id')->toArray();
        $pubs_amount = $drinks->drinkingPubs->pluck('amount')->toArray();
        return view('home.edit', compact('drinks', 'pubs', 'pubs_id', 'pubs_amount'));
    }

    public function update(Request $request, $id)
    {
        $this->drinkingRepo->updateDrinking($request->all(), $id);

        return redirect()->back()->with('success', '#');
    }

    public function destroy($id)
    {
        $this->drinkingRepo->find($id)->delete();

        return redirect()->back()->with('success', '#');
    }
}
