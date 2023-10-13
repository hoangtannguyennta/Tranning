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
        $result = $this->drinkingRepo->createDrinking($request);
        if ($result) {
            return redirect()->back()->with('success', '#');
        }
        return redirect()->back()->with('errors', '#');
    }

    public function edit($id)
    {
        $drinks = Drinking::with('drinkingPubs')->find($id);
        $pubs = Pub::get(['id', 'product_name', 'amount']);

        return view('home.edit', compact('drinks', 'pubs'));
    }

    public function update(Request $request, $id)
    {
        $result = $this->drinkingRepo->updateDrinking($request, $id);
        if ($result) {
            return redirect()->back()->with('success', '#');
        }
        return redirect()->back()->with('errors', '#');
    }

    public function destroy($id)
    {
        $this->drinkingRepo->deleteDrinking($id);

        return redirect()->back()->with('success', '#');
    }

    public function onChange(Request $request)
    {
        $pub = Pub::where('id', $request->drinking)->first();

        $html = '';
        $html .= '<div data-form-id='.$request->drinking.' class="form-content render-form">';
        $html .=    '<label class="title_drinking" for="fname">'. $pub->product_name .'</label>';
        $html .=    '<input min="1" data-price=' . $pub->price . ' data-id-amount=' . $request->drinking . ' class="input drinking_amount" type="number" id="lname" name="amount['.$pub->id.']"  value="1" placeholder="Nhập số lượng">';
        $html .=    '<img class="image-drinking" src="'. asset('files_pubs/'. json_decode($pub->images)[0]) .'"></img>';
        $html .=    '<label data-price=' . $pub->price . ' class="price_total" for="fname">'. number_format($pub->price, 0, '', ',') .' ₫</label>';
        $html .=    '<br>';
        $html .=    '<a data-price=' . $pub->price . '  data-id="'.$request->drinking.'" class="button button_delete">Xóa</a>';
        $html .= '</div>';

        return response()->json([
            'status' => true,
            'html' => $html,
        ]);
    }

    public function onchangeValidation(Request $request)
    {
        $pub = Pub::where('id', $request->drinking_tow)->first()->toArray();

        return response()->json([
            'status' => true,
            'data' => $pub,
        ]);
    }

    public function onShow(Request $request)
    {
        $drink = Drinking::with('drinkingPubs')->find($request->id);
        $date_create_at = date('Y:m:d H:i:s', strtotime($drink->created_at));
        $date_deleted_at = null;
        if (!empty($drink->deleted_at)) {
            $date_deleted_at = date('Y:m:d H:i:s', strtotime($drink->deleted_at));
        }

        $htmlDrinkingPubs = '';
        foreach ($drink->drinkingPubs as $value) {
            $total = (int) ($value->price) * (int) $value->pivot->amount;
            $htmlDrinkingPubs .= '<div>' . $value->product_name;
            $htmlDrinkingPubs .= '</div>';
            $htmlDrinkingPubs .= '<div>' . $value->pivot->amount;
            $htmlDrinkingPubs .= '</div>';
            $htmlDrinkingPubs .= '<div>' . $value->product_name;
            $htmlDrinkingPubs .= '</div>';
            $htmlDrinkingPubs .= '<div>' . number_format($value->price, 0, '', ',');
            $htmlDrinkingPubs .= '</div>';
            $htmlDrinkingPubs .= '<div>' . $total;
            $htmlDrinkingPubs .= '</div>';
        }

        return response()->json([
            'status' => true,
            'data' => $drink,
            'date_create_at' => $date_create_at,
            'date_deleted_at' => $date_deleted_at,
            'htmlDrinkingPubs' => $htmlDrinkingPubs,
        ]);
    }
}
