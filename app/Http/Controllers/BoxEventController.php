<?php

namespace App\Http\Controllers;

use App\Http\Requests\Box\CreateBoxEvent;
use Illuminate\Http\Request;
use App\Repositories\BoxEventRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ConstCommon;
class BoxEventController extends Controller
{
    protected $boxEventRepository;

    public function __construct(BoxEventRepositoryInterface $boxEventRepository)
    {
        $this->boxEventRepository = $boxEventRepository;
    }

    public function create(){
        return view('admin.boxEvent.add');
    }
    public function createPost(CreateBoxEvent $request){
        $idUser = Auth::user()->id;
        if($request->link_image){
            //thời gian upload
            $current_time = time();
            $time_string = date('d-m-Y-H-i-s', $current_time);
            $file = $request->link_image ;
            // lấy tên đuôi của file
            $ext = $file->extension();
            //tên đường dẫn được lưa vào folder và database
            $imageName =  'Box_event'.'_user'.'-'.$idUser.'-'. $time_string.'.'.$ext;
            ConstCommon::addImageToStorage($file,$imageName);
        }

        $data = [
            'id_user_create' => $idUser,
            'id_user_update' => $idUser,
            'title' => $request->title,
            'description' => $request->description,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
            'link_image' => $imageName
        ];
        
        $this->boxEventRepository->create($data);
        return redirect()->route('box.box_event.index')->with('success', 'Thành công');
    }

    public function list()
    {
        $title = "Danh sách các sự kiện";
        $getEvent = $this->boxEventRepository->all();
        
        return view('admin.boxEvent.list',compact('getEvent','title'));
    }

    public function changeStatus(Request $request, $id )
    {
        $this->boxEventRepository->changeStatus($request, $id);
    }
    public function edit($id)
    {
        $getEvent = $this->boxEventRepository->show($id);
        return view('admin.boxEvent.edit', compact('getEvent'));
    }
    public function update(Request $request, $id){
        $idUser = Auth::user()->id;
        if($request->link_image){
            //thời gian upload
            $current_time = time();
            $time_string = date('d-m-Y-H-i-s', $current_time);
            $file = $request->link_image ;
            // lấy tên đuôi của file
            $ext = $file->extension();
            //tên đường dẫn được lưa vào folder và database
            $imageName =  'Box_event'.'_user'.'-'.$idUser.'-'. $time_string.'.'.$ext;
            ConstCommon::addImageToStorage($file,$imageName);
            $data = [
                'id_user_create' => $idUser,
                'id_user_update' => $idUser,
                'title' => $request->title,
                'description' => $request->description,
                'time_start' => $request->time_start,
                'time_end' => $request->time_end,
                'link_image' => $imageName
            ];
            $this->boxEventRepository->update($data, $id);
            return back()->with('success', 'Cập nhật thành công');
        }

        $data = [
            'id_user_create' => $idUser,
            'id_user_update' => $idUser,
            'title' => $request->title,
            'description' => $request->description,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
            
        ];
        $this->boxEventRepository->update($data, $id);
        return back()->with('success', 'Cập nhật thành công');
    }
    public function show($id)
    {
        $showEvent = $this->boxEventRepository->show($id);
        return view('admin.boxEvent.show',compact('showEvent'));
    }
    public function destroy($id)
    {
        $this->boxEventRepository->delete($id);
        return back()->with('success','Thành Công');
    }
}
