<?php

namespace App\Http\Controllers;


use App\Repositories\BoxItemRepositoryInterface;
use App\Repositories\BoxRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\BoxItem\UpdateRequestBoxItem;
use App\Http\Requests\BoxItem\CreateRequestBoxItem;
class BoxItemController extends Controller
{
    protected $boxItemRepository;
    protected $boxRepository;
    public function __construct(BoxItemRepositoryInterface $boxItemRepository, BoxRepositoryInterface $boxRepository){

        $this->boxItemRepository = $boxItemRepository;
        $this->boxRepository = $boxRepository;
    }

    public function create($id)
    {
        $idEvent = $id;
        $getBox = $this->boxRepository->boxItemForEventRepository($id);
        return view('admin.boxItem.add', compact(['idEvent','getBox']));
    }
    public function createPost($id, CreateRequestBoxItem $request)
    {
        $idUser = Auth::user()->id;
        $data = [
            'id_user_create' => $idUser,
            'id_user_update' => $idUser,
            'id_box_event' => $id,
            'id_box' => $request->id_box,
            'amount' => $request->amount,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end
        ];

        $box = $this->boxRepository->show($request->id_box);
        if ($box->amount > $request->amount) {
            if ($this->boxRepository->update(['amount'=>$box->amount-$request->amount], $request->id_box)) {
                $this->boxItemRepository->create($data);
                return redirect()->route('box.box_event.index')->with('success','Thành công');
            } else {
                return redirect()->back()->with('error', 'Vui lòng thử lại');
            }
        } else {
            return redirect()->back()->with('error', 'Số lượng lớn hơn trong kho hiện có vui lòng nhập số lượng nhỏ hơn'.$box->amount);
        }
        return redirect()->route('box.box_event.index')->with('success','Thành công');
    }
    public function changeStatus($id, Request $request)
    {
        $this->boxItemRepository->changeStatus($id,$request->status);
        return back()->with('success', 'Thành Công');
    }
    public function edit($id){
        $getBoxItem = $this->boxItemRepository->show($id);
        $getBox = $this->boxRepository->all();
        return view('admin.boxItem.edit', compact('getBoxItem','getBox'));
    }
    public function update($id, UpdateRequestBoxItem $request){
        $data = $request->all();

        $this->boxItemRepository->update($data,$id);
        return back()->with('success','Thành Công');
    }
    public function destroy($id){
        $this->boxItemRepository->delete($id);
        return back()->with('success','Thành Công');
    }
}
