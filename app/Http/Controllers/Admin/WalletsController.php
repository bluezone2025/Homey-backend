<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\ValidationException;

class WalletsController extends Controller
{
    use MDT_Query, MDT_Method_Action;

    public function __construct()
    {
        $this->middleware('haveRole:wallets.index')->only('index');
        $this->middleware('haveRole:wallets.create')->only(['create' , 'store']);

    }


    public function index(\Illuminate\Http\Request $request)
    {


        $wallets = User::whereHas('wallets') // Only users with wallets
        ->with(['wallets' => function ($query) {
            $query->select('user_id', \DB::raw("SUM(CASE WHEN wallet_type = 'deposit' THEN amount ELSE 0 END) as total_deposit"))
                ->selectRaw("SUM(CASE WHEN wallet_type = 'withdraw' THEN amount ELSE 0 END) as total_withdraw")
                ->groupBy('user_id');
        }])->paginate(100);


        //dd($wallets);


        /*
        $query = Wallet::query();


        if ($search = $request->get('search')) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('wallet_type', 'like', "%$search%")
                ->orWhere('amount', 'like', "%$search%")
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                });
        }

        $wallets = $query->orderBy('id', 'desc')->paginate(50);*/


        return view('admin.pages.wallets.index', compact('wallets'));
    }


    public function view($id){


        $query = Wallet::query();

        $query->where('user_id',$id);

        $wallets = $query->orderBy('id', 'desc')->get();


        return view('admin.pages.wallets.view', compact('wallets'));
    }

    public function create()
    {

        return  view('admin.pages.wallets.create');
    }


    public function edit($id)
    {

        $wallet = Wallet::find($id);

        return  view('admin.pages.wallets.edit', compact('wallet'));
    }



    public function update(\Illuminate\Http\Request $request, $id)
    {


        // Validate the incoming request data
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:0', // Validate the amount as a number greater than or equal to 0
        ]);

        $wallet = Wallet::find($id);


        $wallet->amount = $request->get('amount');
        $wallet->title = $request->get('title');
        $wallet->save();

        return  redirect()->route('admin.wallets.view',$wallet->user_id)->with('success' ,'تم تعديل القيمة بنجاح');
    }

    public function store(\Illuminate\Http\Request $request)
    {

        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required|array', // Ensure it's an array for multiple selection
            'user_id.*' => 'exists:users,id', // Ensure each user ID exists in the users table
            'wallet_type' => 'required|string|in:deposit', // Only allow 'deposit' as the wallet_type
            'title' => 'required|string|max:255', // Validate the title as a string with max length 255
            'amount' => 'required|numeric|min:0', // Validate the amount as a number greater than or equal to 0
        ]);

        // Iterate over each selected user and create a wallet entry for each
        foreach ($validatedData['user_id'] as $userId) {
            Wallet::create([
                'user_id' => $userId,
                'wallet_type' => $validatedData['wallet_type'],
                'title' => $validatedData['title'],
                'amount' => $validatedData['amount'],
            ]);
        }



        return  back()->with('success' , __('form.response.create wallet'));
    }



}
