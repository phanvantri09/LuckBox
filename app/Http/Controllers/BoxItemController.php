<?php

namespace App\Http\Controllers;


use App\Repositories\BoxItemRepositoryInterface;
use App\Repositories\BoxRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        $getBox = $this->boxRepository->all();
        
        return view('admin.boxItem.add', compact(['idEvent','getBox']));
    }
    public function createPost($id, Request $request)
    {
        $idUser = Auth::user()->id;
        $data = [
            'id_user_create' => $idUser,
            'id_user_update' => $idUser,
            'id_box_event' => $id,
            'id_box' => $request->id_box,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end
        ];
        
        $this->boxItemRepository->create($data);
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
    public function update($id, Request $request){
        $data = $request->all();
        
        $this->boxItemRepository->update($data,$id);
        return back()->with('success','Thành Công');
    }
    public function destroy($id){
        $this->boxItemRepository->delete($id);
        return back()->with('success','Thành Công');
    }
}
