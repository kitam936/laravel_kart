<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\UploadService;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
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
}
