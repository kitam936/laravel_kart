<?php

namespace App\Http\Controllers;

use App\Models\EvtComment;
use App\Http\Requests\StoreEvtCommentRequest;
use App\Http\Requests\UpdateEvtCommentRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Jobs\SendCommentMail;
use InterventionImage;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\User;
use GuzzleHttp\Psr7\Request;

use function Laravel\Prompts\select;

class EvtCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    //
    }

    public function evtComment_create($id)
    {
        $login_user = User::findOrFail(Auth::id());

        $event = Event::findOrFail($id);

        // dd($login_user,$ev_comment);

        return view('events.comment.comment_create',compact('login_user','event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store2(StoreEvtCommentRequest $request)
    {
        $login_user = User::findOrFail(Auth::id());
        $evt_id = $request->evt_id2;
        $folderName='ev_comment';
        if(!is_null($request->file('evt_image1'))){
            $fileName1 = uniqid(rand().'_');
            $extension1 = $request->file('evt_image1')->extension();
            $fileNameToStore1 = $fileName1. '.' . $extension1;
            $resizedImage1 = InterventionImage::make($request->file('evt_image1'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/event/' . $fileNameToStore1, $resizedImage1 );
        }else{
            $fileNameToStore1 = '';
        };

        if(!is_null($request->file('evt_image2'))){
            $fileName2 = uniqid(rand().'_');
            $extension2 = $request->file('evt_image2')->extension();
            $fileNameToStore2 = $fileName2. '.' . $extension2;
            $resizedImage2 = InterventionImage::make($request->file('evt_image2'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/event/' . $fileNameToStore2, $resizedImage2 );
        }else{
            $fileNameToStore2 = '';
        };
        if(!is_null($request->file('evt_image3'))){
            $fileName3 = uniqid(rand().'_');
            $extension3 = $request->file('evt_image3')->extension();
            $fileNameToStore3 = $fileName3. '.' . $extension3;
            $resizedImage3 = InterventionImage::make($request->file('evt_image3'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/event/' . $fileNameToStore3, $resizedImage3 );
        }else{
            $fileNameToStore3 = '';
        };


        if(!is_null($request->file('evt_image4'))){
            $fileName4 = uniqid(rand().'_');
            $extension4 = $request->file('evt_image4')->extension();
            $fileNameToStore4 = $fileName4. '.' . $extension4;
            $resizedImage4 = InterventionImage::make($request->file('evt_image4'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/event/' . $fileNameToStore4, $resizedImage4 );
        }else{
            $fileNameToStore4 = '';
        };

        // dd($request->sh_id,$request->comment);
        EvtComment::create([
            'user_id' => $login_user->id,
            'event_id' => $request->evt_id2,
            'title' => $request->title,
            'evt_image1' => $fileNameToStore1,
            'evt_image2' => $fileNameToStore2,
            'evt_image3' => $fileNameToStore3,
            'evt_image4' => $fileNameToStore4,
            'ev_comment' => $request->ev_comment,
        ]);



        return to_route('event_detail',['event'=>$evt_id])->with(['message'=>'コメントが登録されました','status'=>'info']);
    }

    public function store(StoreEvtCommentRequest $request)
    {
        $login_user = User::findOrFail(Auth::id());
        $evt_id = $request->evt_id2;
        $folderName='ev_comment';

        if(!is_null($request->file('evt_image1'))){
            $fileName1 = uniqid(rand().'_');
            $extension1 = $request->file('evt_image1')->extension();
            $fileNameToStore1 = $fileName1. '.' . $extension1;
            $resizedImage1 = InterventionImage::make($request->file('evt_image1'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/event/' . $fileNameToStore1, $resizedImage1 );
        }else{
            $fileNameToStore1 = '';
        };

        if(!is_null($request->file('evt_image2'))){
            $fileName2 = uniqid(rand().'_');
            $extension2 = $request->file('evt_image2')->extension();
            $fileNameToStore2 = $fileName2. '.' . $extension2;
            $resizedImage2 = InterventionImage::make($request->file('evt_image2'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/event/' . $fileNameToStore2, $resizedImage2 );
        }else{
            $fileNameToStore2 = '';
        };
        if(!is_null($request->file('evt_image3'))){
            $fileName3 = uniqid(rand().'_');
            $extension3 = $request->file('evt_image3')->extension();
            $fileNameToStore3 = $fileName3. '.' . $extension3;
            $resizedImage3 = InterventionImage::make($request->file('evt_image3'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/event/' . $fileNameToStore3, $resizedImage3 );
        }else{
            $fileNameToStore3 = '';
        };


        if(!is_null($request->file('evt_image4'))){
            $fileName4 = uniqid(rand().'_');
            $extension4 = $request->file('evt_image4')->extension();
            $fileNameToStore4 = $fileName4. '.' . $extension4;
            $resizedImage4 = InterventionImage::make($request->file('evt_image4'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/event/' . $fileNameToStore4, $resizedImage4 );
        }else{
            $fileNameToStore4 = '';
        };

        // dd($request->sh_id,$request->comment);
        EvtComment::create([
            'user_id' => $login_user->id,
            'event_id' => $request->evt_id2,
            'title' => $request->title,
            'evt_image1' => $fileNameToStore1,
            'evt_image2' => $fileNameToStore2,
            'evt_image3' => $fileNameToStore3,
            'evt_image4' => $fileNameToStore4,
            'ev_comment' => $request->ev_comment,
        ]);

        // ここでメール送信
        // $user = User::findOrFail(Auth::id())
        // ->toArray();

        $users = Reservation::with('user:id,name,email')
        ->where('event_id',$request->evt_id2)
        ->distinct()
        ->select('user_id')
        ->get()
        ->toArray();

        $event_info = Event::findOrFail($request->evt_id2)
        ->toArray();

        // dd($users,$event_info);

        foreach($users as $user){
            $user = $user['user'];
            // dd($user,$event_info);
            SendCommentMail::dispatch($event_info,$user);
        }

        return to_route('event_detail',['event'=>$evt_id])->with(['message'=>'コメントが登録されました','status'=>'info']);
    }


    /**
     * Display the specified resource.
     */
    public function show(EvtComment $evtComment)
    {
        //
    }

    public function evComment_detail($id)
    {
        $ev_comment=DB::table('evt_comments')
        ->join('users','users.id','=','evt_comments.user_id')
        ->join('events','events.id','=','evt_comments.event_id')
        ->select(['evt_comments.id','evt_comments.event_id','events.event_name','evt_comments.user_id','users.name','evt_comments.title','evt_comments.ev_comment','evt_comments.evt_image1','evt_comments.evt_image2','evt_comments.evt_image3','evt_comments.evt_image4','evt_comments.created_at'])
        ->where('evt_comments.id',$id)
        ->first();

        $login_user = User::findOrFail(Auth::id());

        // dd($ev_comment,$login_user,$ev_comment);

        return view('events.comment.comment_detail',compact('ev_comment','login_user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ev_comment=DB::table('evt_comments')
        ->join('users','users.id','=','evt_comments.user_id')
        ->join('events','events.id','=','evt_comments.event_id')
        ->select(['evt_comments.id','evt_comments.event_id','events.event_name','evt_comments.user_id','users.name','evt_comments.title','evt_comments.ev_comment','evt_comments.evt_image1','evt_comments.evt_image2','evt_comments.evt_image3','evt_comments.evt_image4','evt_comments.created_at'])
        ->where('evt_comments.id',$id)
        ->first();

        $login_user = User::findOrFail(Auth::id());

        // dd($ev_comment,$login_user,$ev_comment->user_id);

        return view('events.comment.comment_edit',compact('ev_comment','login_user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function evComment_update0(UpdateEvtCommentRequest $request, $id)
    {
        // $login_user = User::findOrFail(Auth::id());
        $ev_comment=EvtComment::findOrFail($id);
        $evt_id = $request->evt_id2;
        $folderName='ev_comment';
        if(!is_null($request->file('evt_image1'))){
            $fileName1 = uniqid(rand().'_');
            $extension1 = $request->file('evt_image1')->extension();
            $fileNameToStore1 = $fileName1. '.' . $extension1;
            $resizedImage1 = InterventionImage::make($request->file('evt_image1'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/event/' . $fileNameToStore1, $resizedImage1 );
        }else{
            $fileNameToStore1 = $ev_comment->evt_image1;
        };

        if(!is_null($request->file('evt_image2'))){
            $fileName2 = uniqid(rand().'_');
            $extension2 = $request->file('evt_image2')->extension();
            $fileNameToStore2 = $fileName2. '.' . $extension2;
            $resizedImage2 = InterventionImage::make($request->file('evt_image2'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/event/' . $fileNameToStore2, $resizedImage2 );
        }else{
            $fileNameToStore2 = $ev_comment->evt_image2;
        };
        if(!is_null($request->file('evt_image3'))){
            $fileName3 = uniqid(rand().'_');
            $extension3 = $request->file('evt_image3')->extension();
            $fileNameToStore3 = $fileName3. '.' . $extension3;
            $resizedImage3 = InterventionImage::make($request->file('evt_image3'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/event/' . $fileNameToStore3, $resizedImage3 );
        }else{
            $fileNameToStore3 = $ev_comment->evt_image3;
        };


        if(!is_null($request->file('evt_image4'))){
            $fileName4 = uniqid(rand().'_');
            $extension4 = $request->file('evt_image4')->extension();
            $fileNameToStore4 = $fileName4. '.' . $extension4;
            $resizedImage4 = InterventionImage::make($request->file('evt_image4'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/event/' . $fileNameToStore4, $resizedImage4 );
        }else{
            $fileNameToStore4 = $ev_comment->evt_image4;
        };
            // $ev_comment->user_id -> $login_user->id;
            // $ev_comment->event_id -> $request->evt_id2;
            $ev_comment->title = $request->title;
            $ev_comment->evt_image1 = $fileNameToStore1;
            $ev_comment->evt_image2 = $fileNameToStore2;
            $ev_comment->evt_image3 = $fileNameToStore3;
            $ev_comment->evt_image4 = $fileNameToStore4;
            $ev_comment->ev_comment = $request->ev_comment;

            // dd($ev_comment->title,$ev_comment->ev_comment);

            $ev_comment->save();

        return to_route('event_detail',['event'=>$ev_comment->event_id])->with(['message'=>'コメントが更新されました','status'=>'info']);
    }

    public function evComment_update(UpdateEvtCommentRequest $request, $id)
    {
        // $login_user = User::findOrFail(Auth::id());
        $ev_comment=EvtComment::findOrFail($id);
        $evt_id = $request->evt_id2;
        $folderName='ev_comment';

        $filrPath1 = 'public/event/' . $ev_comment->evt_image1;
        if(!empty($request->evt_image1) && (Storage::exists($filrPath1))){
            Storage::delete($filrPath1);
            // dd($filrPath1,$request->photo1);
        }
        $filrPath2 = 'public/event/' . $ev_comment->evt_image2;
        if(!empty($request->evt_image2) && (Storage::exists($filrPath2))){
            Storage::delete($filrPath2);
            // dd($filrPath1,$request->photo1);
        }

        $filrPath3 = 'public/event/' . $ev_comment->evt_image3;
        if(!empty($request->evt_image3) && (Storage::exists($filrPath3))){
            Storage::delete($filrPath3);
            // dd($filrPath1,$request->photo1);
        }
        $filrPath4 = 'public/event/' . $ev_comment->evt_image4;
        if(!empty($request->evt_image4) && (Storage::exists($filrPath4))){
            Storage::delete($filrPath4);
            // dd($filrPath1,$request->photo1);
        }


        if(!is_null($request->file('evt_image1'))){
            $fileName1 = uniqid(rand().'_');
            $extension1 = $request->file('evt_image1')->extension();
            $fileNameToStore1 = $fileName1. '.' . $extension1;
            $resizedImage1 = InterventionImage::make($request->file('evt_image1'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/event/' . $fileNameToStore1, $resizedImage1 );
        }else{
            $fileNameToStore1 = $ev_comment->evt_image1;
        };

        if(!is_null($request->file('evt_image2'))){
            $fileName2 = uniqid(rand().'_');
            $extension2 = $request->file('evt_image2')->extension();
            $fileNameToStore2 = $fileName2. '.' . $extension2;
            $resizedImage2 = InterventionImage::make($request->file('evt_image2'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/event/' . $fileNameToStore2, $resizedImage2 );
        }else{
            $fileNameToStore2 = $ev_comment->evt_image2;
        };
        if(!is_null($request->file('evt_image3'))){
            $fileName3 = uniqid(rand().'_');
            $extension3 = $request->file('evt_image3')->extension();
            $fileNameToStore3 = $fileName3. '.' . $extension3;
            $resizedImage3 = InterventionImage::make($request->file('evt_image3'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/event/' . $fileNameToStore3, $resizedImage3 );
        }else{
            $fileNameToStore3 = $ev_comment->evt_image3;
        };


        if(!is_null($request->file('evt_image4'))){
            $fileName4 = uniqid(rand().'_');
            $extension4 = $request->file('evt_image4')->extension();
            $fileNameToStore4 = $fileName4. '.' . $extension4;
            $resizedImage4 = InterventionImage::make($request->file('evt_image4'))->resize(400, 400,function($constraint){$constraint->aspectRatio();})->encode();
            Storage::put('public/event/' . $fileNameToStore4, $resizedImage4 );
        }else{
            $fileNameToStore4 = $ev_comment->evt_image4;
        };

            // $ev_comment->user_id -> $login_user->id;
            // $ev_comment->event_id -> $request->evt_id2;
            $ev_comment->title = $request->title;
            $ev_comment->evt_image1 = $fileNameToStore1;
            $ev_comment->evt_image2 = $fileNameToStore2;
            $ev_comment->evt_image3 = $fileNameToStore3;
            $ev_comment->evt_image4 = $fileNameToStore4;
            $ev_comment->ev_comment = $request->ev_comment;

            // dd($ev_comment->title,$ev_comment->ev_comment);

            $ev_comment->save();

        // ここでメール送信
        // $user = User::findOrFail(Auth::id())
        // ->toArray();

        $users = Reservation::with('user:id,name,email')
        ->where('event_id',$request->evt_id2)
        ->distinct()
        ->select('user_id')
        ->get()
        ->toArray();

        $event_info = Event::findOrFail($request->evt_id2)
        ->toArray();

        // dd($users,$event_info);

        foreach($users as $user){
            $user = $user['user'];
            // dd($user,$event_info);
            SendCommentMail::dispatch($event_info,$user);
        }


        return to_route('event_detail',['event'=>$ev_comment->event_id])->with(['message'=>'コメントが更新されました','status'=>'info']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function evComment_destroy($id)
    {

        $evtComment = EvtComment::findorfail($id);
        $evt_id2 = $evtComment->event_id;
        // dd($evt_id2);
        $filrPath1 = 'public/event/' . $evtComment->evt_image1;
        if(Storage::exists($filrPath1)){
            Storage::delete($filrPath1);
        }
        $filrPath2 = 'public/event/' . $evtComment->evt_image2;
        if(Storage::exists($filrPath2)){
            Storage::delete($filrPath2);
        }
        $filrPath3 = 'public/event/' . $evtComment->evt_image3;
        if(Storage::exists($filrPath3)){
            Storage::delete($filrPath3);
        }
        $filrPath4 = 'public/event/' . $evtComment->evt_image4;
        if(Storage::exists($filrPath4)){
            Storage::delete($filrPath4);
        }

        EvtComment::findOrFail($id)->delete();
        return to_route('event_detail',['event'=>$evt_id2])->with(['message'=>'コメントが削除されました','status'=>'alert']);
        // return to_route('eventlist')->with(['message'=>'コメントが削除されました','status'=>'alert']);
    }
}
