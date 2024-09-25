<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\UploadService;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Stint;
use App\Models\Document;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class DocumentController extends Controller
{
    public function index(Request $request, $id)
    {
        //

    }

    public function create($id)
    {
    //

    }

    public function list(Request $request)
    {
        //

    }

    public function doc_upload(Request $request)
    {
        //
    }

    public function doc_download($id)
    {
        //
    }

    public function edit($id)
    {
        //

    }

    public function doc_update(Request $request)
    {
        //
    }

    public function doc_destroy(Request $request, $id)
    {
        //
    }

    public function manual_download()
    {
        $user_role = User::findOrFail(Auth::id())->role_id;
        // dd($user_role);
        if($user_role > 7){
            $dl_filename1='メンバーマニュアル.pdf';
            $file_path1 = 'public/manual/'.$dl_filename1;
            $mimeType1 = Storage::mimeType($file_path1);
            $headers1 = [['Content-Type' =>$mimeType1]];
            // dd($dl_filename1,$file_path1,$user_role);
            return Storage::download($file_path1,  $dl_filename1, $headers1);
        }

        if($user_role <= 7){
            $dl_filename2='スタッフマニュアル.pdf';
            $file_path2 = 'public/manual/'.$dl_filename2;
            $mimeType2 = Storage::mimeType($file_path2);
            $headers2 = [['Content-Type' =>$mimeType2]];
            // dd($dl_filename2,$file_path2,$mimeType2,$user_role);
            return Storage::download($file_path2,  $dl_filename2, $headers2);
        }

        // return to_route('doc_index',['event'=>$event_id])->with(['message'=>'ファイルをダウンロードしました','status'=>'info']);
    }

    public function data_edit($id)
    {
        $stint = DB::table('stints')
        ->join('users','users.id','=','stints.user_id')
        ->join('circuits','circuits.id','=','stints.cir_id')
        ->where('stints.user_id',Auth::id())
        ->select('stints.id as stint_id','stints.user_id','stints.start_date','circuits.cir_name','users.name as username','stints.filename')
        ->where('stints.id' ,$id)
        // ->select('reservations.id as resv_id','reservations.event_id','events.start_date','events.end_date','events.event_name',
        // 'events.place','reservations.secondary_category_id','secondary_categories.secondary_name','reservations.sub_category_id',
        // 'sub_categories.sub_name','reservations.number','reservations.real_name','reservations.real_name_kana','reservations.resv_info',
        // 'reservations.number_of_sub','reservations.number_of_main','events.main_fee','events.sub_fee')
        ->first();

        // dd($stint);

        return view('stints.data_upload',compact('stint'));

    }

    public function data_download($id)
    {
        $stint = Stint::findorfail($id);
        if(!empty($stint->filename)){
            $file_path1 = 'public/data/'.$stint->filename;
            $mimeType1 = Storage::mimeType($file_path1);
            $headers1 = [['Content-Type' =>$mimeType1]];
            // dd($dl_filename1,$file_path1,$user_role);
            return Storage::download($file_path1,  $stint->filename, $headers1);
        }
    }

    // public function data_upload(Request $request)
    // {
    //     $stint_id = $request->stint_id;
    //     $filename = $request->file('files');
    //     if(!is_null($filename)){
    //         foreach($filename as $DocFile){
    //             $fileNameToStore = UploadService::upload($DocFile, $stint_id);
    //             $isExist = Stint::where('filename',$fileNameToStore)
    //                 ->exists();
    //                 // dd($fileNameToStore,$isExist);
    //             if(!$isExist)
    //             {
    //                 $stint = Stint::findorfail($request->stint_id);
    //                 $stint->filename=$fileNameToStore;
    //                 // dd($document->event_id,$document->doc_title,$document->doc_information,$document->doc_filename);
    //                 $stint->save();
    //                 return to_route('my_stint_show',['stint'=>$stint_id])->with(['message'=>'Dataをアップロードしました','status'=>'info']);
    //             }else{
    //                 return to_route('stint_data_edit',['stint'=>$request->stint_id])->with(['message'=>'そのDataは既にアップロードされています','status'=>'alert']);
    //             };
    //         }
    //     }else{
    //         return to_route('stint_data_edit',['stint'=>$request->stint_id])->with(['message'=>'Dataが選択されていません','status'=>'info']);
    //     }
    // }

    public function data_upload(Request $request)
    {
        $stint_id = $request->stint_id;
        $stint_filename = Stint::findorfail($stint_id)->filename;
        $file_path = 'public/data/'.$stint_filename;
        $filename = $request->file('files');
        if(!is_null($filename)){
            foreach($filename as $DocFile){
                $fileNameToStore = UploadService::upload($DocFile, $stint_id);
                   // dd($fileNameToStore,$isExist);
                if((!empty($fileNameToStore))&&(Storage::exists($file_path)))
                {
                    Storage::delete($file_path);
                    $stint = Stint::findorfail($request->stint_id);
                    $stint->filename=$fileNameToStore;
                    // dd($document->event_id,$document->doc_title,$document->doc_information,$document->doc_filename);
                    $stint->save();
                    return to_route('my_stint_show',['stint'=>$stint_id])->with(['message'=>'Dataをアップロードしました','status'=>'info']);
                }else{
                    return to_route('stint_data_edit',['stint'=>$request->stint_id])->with(['message'=>'そのDataは既にアップロードされています','status'=>'alert']);
                };
            }
        }else{
            return to_route('stint_data_edit',['stint'=>$request->stint_id])->with(['message'=>'Dataが選択されていません','status'=>'info']);
        }
    }


    public function data_destroy(Request $request, $id)
    {
        $stint_id = DB::table('stints')
        ->where('stints.id','=',$id)
        ->first();
        $stint_id2 = $request->stint_id;
        $filename = Stint::findorfail($id)->filename;
        $file_path = 'public/data/'.$filename;
        // dd($file_path,$event_id,$event_id2,$filename);
        if(Storage::exists($file_path)){
            Storage::delete($file_path);
        }
        $stint = Stint::findorfail($request->stint_id);
        $stint->filename="";
        // dd($document->event_id,$document->doc_title,$document->doc_information,$document->doc_filename);
        $stint->save();

        return to_route('my_stint_show',['stint'=>$stint_id2])->with(['message'=>'Dataが削除されました','status'=>'alert']);
    }
}
