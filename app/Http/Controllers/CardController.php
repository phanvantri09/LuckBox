<?php

namespace App\Http\Controllers;

use App\Helpers\ConstCommon;
use App\Http\Requests\Card\CreateRequestCard;
use App\Repositories\CardRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CardController extends Controller
{
    protected $cardRepository;

    public function __construct(CardRepositoryInterface $cardRepository)
    {
        $this->cardRepository = $cardRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->cardRepository->allUser();
        return view('admin.card.list', compact([ 'data' ]));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function indexAdmin()
    {
        $data = $this->cardRepository->allAdmin();
        return view('admin.cardAdmin.list', compact([ 'data' ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $banks = ConstCommon::BankVN;
        return view('admin.card.add', compact('banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequestCard $request)
    {
        $currentUser = Auth::user();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = Storage::disk('public')->putFileAs('images', $file, $file->getClientOriginalName());
            $request->merge(['image_ql_code' => $path]);
        }

        $id_user_create = $currentUser->id;
        $id_user_update = $currentUser->id;
        $request->merge([
            "id_user_create"=>$id_user_create,
            'id_user_update' => $id_user_update
        ]);
        $data = $request->all();
        $this->cardRepository->create($data);
        return redirect()->route('card.index')->with('success', 'data created successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function createAdmin()
    {
        $banks = ConstCommon::BankVN;
        return view('admin.cardAdmin.add', compact('banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAdmin(CreateRequestCard $request)
    {
        $currentUser = Auth::user();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = Storage::disk('public')->putFileAs('images', $file, $file->getClientOriginalName());
            $request->merge(['image_ql_code' => $path]);
        }

        $id_user_create = $currentUser->id;
        $id_user_update = $currentUser->id;
        $request->merge([
            "id_user_create"=>$id_user_create,
            'id_user_update' => $id_user_update,
            'type' => ConstCommon::TypeAdmin
        ]);
        $data = $request->all();
        $this->cardRepository->create($data);
        return redirect()->route('card.indexAdmin')->with('success', 'data created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->cardRepository->show($id);
        $banks = ConstCommon::BankVN;
        return view('admin.card.edit', compact('data', 'banks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CreateRequestCard $request, $id)
    {
        $currentUser = Auth::user();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = Storage::disk('public')->putFileAs('images', $file, $file->getClientOriginalName());
            $request->merge(['image_ql_code' => $path]);
        }

        $id_user_update = $currentUser->id;
        $request->merge([
            'id_user_update' => $id_user_update
        ]);
        $data = $request->all();
        $this->cardRepository->update($data, $id);
        return redirect()->route('card.index')->with('success', 'data updated successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function editAdmin($id)
    {
        $data = $this->cardRepository->show($id);
        $banks = ConstCommon::BankVN;
        return view('admin.cardAdmin.edit', compact('data', 'banks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAdmin(CreateRequestCard $request, $id)
    {
        $currentUser = Auth::user();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = Storage::disk('public')->putFileAs('images', $file, $file->getClientOriginalName());
            $request->merge(['image_ql_code' => $path]);
        }

        $id_user_update = $currentUser->id;
        $request->merge([
            'id_user_update' => $id_user_update
        ]);
        $data = $request->all();
        $this->cardRepository->update($data, $id);
        return redirect()->route('card.indexAdmin')->with('success', 'data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->cardRepository->delete($id);
        return redirect()->route('card.index')->with('success', 'Xóa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyAdmin($id)
    {
        $this->cardRepository->delete($id);
        return redirect()->route('card.indexAdmin')->with('success', 'Xóa thành công');
    }
}
