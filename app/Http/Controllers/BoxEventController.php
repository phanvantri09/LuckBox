<?php

namespace App\Http\Controllers;

use App\Http\Requests\Box\CreateBoxEvent;
use Illuminate\Http\Request;
use App\Repositories\BoxEventRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ConstCommon;

use Carbon\Carbon;

class BoxEventController extends Controller
{
    protected $boxEventRepository;
    protected $categoryRepository;
    public function __construct(BoxEventRepositoryInterface $boxEventRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->boxEventRepository = $boxEventRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function create(){
        $category = $this->categoryRepository->getAllByType(ConstCommon::ListTypeCatogory['event']);
        return view('admin.boxEvent.add', compact(['category']));

    }
    public function createPost(CreateBoxEvent $request){
        $idUser = Auth::user()->id;
        //dd($request->all());
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
        // Y-m-d H:i:s
        $time_start = $request->time_start;
        $time_end = $request->time_end;
        // Tạo đối tượng Carbon từ chuỗi thời gian
        $carbon_start = Carbon::createFromFormat('Y-m-d\TH:i', $time_start);
        $carbon_end = Carbon::createFromFormat('Y-m-d\TH:i', $time_end);

        // Định dạng lại chuỗi thời gian theo định dạng Y-m-d H:i:s
        $data = [
            'id_user_create' => $idUser,
            'id_user_update' => $idUser,
            'id_category' => $request->id_category,
            'title' => $request->title,
            // 2023-07-17 16:55:44
            'description' => $request->description,

            'time_start' => $carbon_start->format('Y-m-d H:i:s'),
            'time_end' => $carbon_end->format('Y-m-d H:i:s'),
            'link_image' => $imageName, 
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
        $category = $this->categoryRepository->getAllByType(ConstCommon::ListTypeCatogory['event']);
        return view('admin.boxEvent.edit', compact(['category', 'getEvent']));
    }
    public function update(Request $request, $id){
        $idUser = Auth::user()->id;
        
        $time_start = $request->time_start;
        $time_end = $request->time_end;
        // Tạo đối tượng Carbon từ chuỗi thời gian
        $carbon_start = Carbon::createFromFormat('Y-m-d\TH:i', $time_start);
        $carbon_end = Carbon::createFromFormat('Y-m-d\TH:i', $time_end);

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
                'time_start' => $carbon_start->format('Y-m-d H:i:s'),
                'time_end' => $carbon_end->format('Y-m-d H:i:s'),
                'link_image' => $imageName, 
                'id_category' => $request->id_category
                
            ];
            $this->boxEventRepository->update($data, $id);
            return back()->with('success', 'Cập nhật thành công');
        }

        $data = [
            'id_user_create' => $idUser,
            'id_user_update' => $idUser,
            'title' => $request->title,
            'description' => $request->description,
            'time_start' => $carbon_start->format('Y-m-d H:i:s'),
            'time_end' => $carbon_end->format('Y-m-d H:i:s'), 
            'id_category' => $request->id_category
        ];
        $this->boxEventRepository->update($data, $id);
        return back()->with('success', 'Cập nhật thành công');
    }
    public function show($id)
    {
        $showEvent = $this->boxEventRepository->show($id);
        $getBoxItem = $showEvent->boxItem()->get();
        $dataMain = [];
        foreach ($getBoxItem as $key => $boxItem) {
            $dataMain[$key] = [$boxItem, $boxItem->box()->get()];
        }
        return view('admin.boxEvent.show',compact('showEvent','getBoxItem', 'dataMain'));
    }
    public function destroy($id)
    {
        $this->boxEventRepository->delete($id);
        return back()->with('success','Thành Công');
    }
}
