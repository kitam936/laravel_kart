<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\User;
use App\Models\PrimaryCategory;
use App\Models\SubCategory;
use Carbon\Carbon;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Reservation;
use App\Jobs\SendReservationThanksMail;
use App\Jobs\SendReservationThanksMail2;
use App\Jobs\SendPayThanksMail;
use App\Jobs\SendResvReportMail;
use App\Jobs\SendTestMail;

class ReservationController extends Controller
{

    public function index(Request $request)
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        // $resevation = DB::table('reservations')
        // ->join('secondary_categories','secondary_categories.id','=','reservations.secondary_category_id')
        // ->join('events','events.id','=','reservations.event_id')
        // ->join('users','users.id','=','reservations.user_id')
        // ->join('areas','areas.id','=','users.area_id')
        // ->join('primary_categories','primary_categories.id','=','secondary_categories.primary_category_id')
        // ->where('reservations.id',$id)
        // ->first();
        // // dd($event,$users,$number_of_resv,$primaries,$secondaries);
        // return view('events.reservation_list',compact('event','users','primaries','secondaries','number_of_resv'));
    }

    public function my_reservation_list()
    {
        $reservations = DB::table('reservations')
        ->join('secondary_categories','secondary_categories.id','=','reservations.secondary_category_id')
        ->join('events','events.id','=','reservations.event_id')
        ->join('sub_categories','sub_categories.id','=','reservations.sub_category_id')
        ->join('users','users.id','=','reservations.user_id')
        ->join('areas','areas.id','=','events.place_area_id')
        ->join('statuses','statuses.id','=','reservations.status_id')
        ->join('primary_categories','primary_categories.id','=','secondary_categories.primary_category_id')
        ->where('reservations.user_id',Auth::id())
        ->whereNull('reservations.canceled_date')
        ->select('reservations.id','reservations.user_id','reservations.event_id','events.event_name','areas.area_name','primary_categories.primary_name',
        'secondary_categories.secondary_name','sub_categories.sub_name','reservations.status_id','statuses.status','reservations.resv_info','events.start_date')
        ->orderBy('events.start_date','desc')
        ->get();
        // dd($reservations);
        return view('events.my_reservation_list',compact('reservations'));
    }

    public function my_resv_show($id)
    {
        $resv_id = $id;
        $reservation = DB::table('reservations')
        ->join('secondary_categories','secondary_categories.id','=','reservations.secondary_category_id')
        ->join('events','events.id','=','reservations.event_id')
        ->join('sub_categories','sub_categories.id','=','reservations.sub_category_id')
        ->join('users','users.id','=','reservations.user_id')
        ->join('areas','areas.id','=','users.area_id')
        ->join('primary_categories','primary_categories.id','=','secondary_categories.primary_category_id')
        ->where('reservations.user_id',Auth::id())
        ->whereNull('reservations.canceled_date')
        ->where('reservations.id' ,$id)
        // ->select('reservations.id as resv_id','reservations.event_id','events.start_date','events.end_date','events.event_name',
        // 'events.place','reservations.secondary_category_id','secondary_categories.secondary_name','reservations.sub_category_id',
        // 'sub_categories.sub_name','reservations.number','reservations.real_name','reservations.real_name_kana','reservations.resv_info',
        // 'reservations.number_of_sub','reservations.number_of_main','events.main_fee','events.sub_fee')
        ->first();

        $isReserved = DB::table('events')
        ->join('reservations','events.id','=','reservations.event_id')
        ->where('reservations.id',$id)
        ->where('reservations.user_id',Auth::id())
        ->whereNull('reservations.canceled_date')
        // ->select('events.id','events.start_date','events.event_name','events.place_area_id')
        ->exists();
        // dd($isReserved);
        return view('events.my_reservation_show',compact('reservation','resv_id','isReserved'));
    }

    public function staff_reservation_list(Request $request,$id)
    {

        $statuses = DB::table('statuses')
        ->select(['statuses.id as status_id','status'])
        ->get();

        $reservedPeople = DB::table('reservations')
        ->whereNull('reservations.canceled_date')
        ->select('event_id', DB::raw('sum(number_of_main)
        as number_of_main'))
        ->groupBy('event_id');

        $events = DB::table('events')
        ->join('areas','areas.id','=','events.place_area_id')
        ->leftJoinSub($reservedPeople, 'reservedPeople',
        function($join){
        $join->on('events.id', '=', 'reservedPeople.event_id');
        })
        ->where('events.place_area_id','LIKE','%'.($request->ar_id).'%')
        ->where('events.information','LIKE','%'.($request->information).'%')
        ->select('events.id as event_id','events.start_date','events.event_name','events.place_area_id','areas.area_name','events.place','events.is_visible','events.capacity','number_of_main')
        ->orderBy('events.start_date','desc')
        ->paginate(20);

        $event = DB::table('events')
        ->leftJoinSub($reservedPeople, 'reservedPeople',
        function($join){
        $join->on('events.id', '=', 'reservedPeople.event_id');
        })
        ->where('events.id',($id))
        // ->select('events.id as event_id')
        ->first();

        $resvs = DB::table('reservations')
        ->join('secondary_categories','secondary_categories.id','=','reservations.secondary_category_id')
        ->join('events','events.id','=','reservations.event_id')
        ->join('statuses','statuses.id','=','reservations.status_id')
        ->join('users','users.id','=','reservations.user_id')
        ->join('primary_categories','primary_categories.id','=','secondary_categories.primary_category_id')
        ->where('reservations.event_id',($id))
        ->whereNull('reservations.canceled_date')
        ->where('reservations.status_id','LIKE','%'.$request->status.'%')
        ->where('users.name','LIKE','%'.$request->name.'%')
        ->where('reservations.real_name','LIKE','%'.$request->real_name.'%')
        ->where('reservations.id','LIKE','%'.$request->resv_no.'%')
        ->select('reservations.event_id','reservations.id as resvId','users.name','secondary_categories.secondary_name','reservations.real_name','statuses.status','events.main_fee','events.sub_fee','number_of_main','number_of_sub')
        ->orderBy('reservations.updated_at','desc')
        ->get();

        $number_of_resv = DB::table('reservations')
        ->join('secondary_categories','secondary_categories.id','=','reservations.secondary_category_id')
        ->join('events','events.id','=','reservations.event_id')
        ->join('users','users.id','=','reservations.user_id')
        ->join('areas','areas.id','=','users.area_id')
        ->join('primary_categories','primary_categories.id','=','secondary_categories.primary_category_id')
        ->where('reservations.event_id',($id))
        ->whereNull('reservations.canceled_date')
        ->where('reservations.status_id','LIKE','%'.$request->status.'%')
        ->where('users.name','LIKE','%'.$request->name.'%')
        ->where('reservations.id','LIKE','%'.$request->resv_no.'%')
        ->selectRaw('SUM(reservations.number_of_main) as number_of_main')
        ->selectRaw('SUM(reservations.number_of_sub) as number_of_sub')
        ->get();
        // dd($event,$statuses,$reservedPeople,$events,$resvs,$number_of_resv);
        return view('manager.events.staff_reservation_list',compact('statuses','event','events','resvs','number_of_resv'));
        // dd($roles,$areas,$users);
    }

    public function staff_resv_show($id)
    {
        $resv_id = $id;
        $statuses = DB::table('statuses')
        ->select(['statuses.id as status_id','status'])
        ->get();
        $status = DB::table('reservations')
        ->join('statuses','statuses.id','=','reservations.status_id')
        ->where('reservations.id' ,$id)
        ->select(['statuses.id as status_id','status'])
        ->first();
        $reservation = DB::table('reservations')
        ->join('secondary_categories','secondary_categories.id','=','reservations.secondary_category_id')
        ->join('events','events.id','=','reservations.event_id')
        ->join('sub_categories','sub_categories.id','=','reservations.sub_category_id')
        ->join('users','users.id','=','reservations.user_id')
        ->join('areas','areas.id','=','users.area_id')
        ->join('primary_categories','primary_categories.id','=','secondary_categories.primary_category_id')
        ->whereNull('reservations.canceled_date')
        ->where('reservations.id' ,$id)
        // ->select('reservations.id','events.id',)
        ->first();

        // dd($resv_id,$reservation);
        return view('manager.events.staff_reservation_show',compact('reservation','resv_id','statuses','status'));
    }

    public function status_update(Request $request, $id)
    {
        $resv_id = $id;
        $event_id = $request['event_id'];
        $resv = Reservation::findOrFail($id);
        $event_id2 = Reservation::findOrFail($id)->event_id;
        $resv->status_id = $request['status'];
        // dd($resv_id,$event_id2,$resv->status_id);

        $resv->save();

        if($request['status']==3){

            $user = User::findOrFail(Auth::id())
            ->toArray();

            $event_info = Event::findOrFail($event_id2)
            ->toArray();

            // dd($user,$event_info);

            SendPayThanksMail::dispatch($event_info,$user);
        }

        return to_route('staff_reservation_list',['event'=>$resv->event_id])->with(['message'=>'Status変更を受付ました','status'=>'info']);

    }

    public function status_update2(Request $request, $id)
    {
        $resv_id = $id;
        $event_id = $request['event_id'];
        $resv = Reservation::findOrFail($id);
        $resv->status_id = $request['status'];

        // dd($resv_id,$event_id,$resv,$resv->event_id);

        $resv->save();

        return to_route('staff_reservation_list',['event'=>$resv->event_id])->with(['message'=>'Status変更を受付ました','status'=>'info']);

    }


    public function staff_resv_cancel(Request $request ,$id)
    {
        // dd($id);

        $reservation = Reservation::findOrFail($id);
        $reservation->canceled_date = Carbon::now()->format('Y-m-d H:i:s');
        // dd($event_id,$reservation);
        $reservation->save();

        return to_route('staff_reservation_list',['event'=>$reservation->event_id])->with(['message'=>'キャンセルを受付ました','status'=>'alert']);
    }


    public function edit($id)
    {
        $resv_id = $id;
        $categories = PrimaryCategory::with('secondary')
        ->get();
        $sub_categories = SubCategory::all();

        // $user = DB::table('users')
        // ->join('areas','areas.id','=','users.area_id')
        // ->join('roles','roles.id','=','users.role_id')
        // ->where('users.id',$id)
        // ->select('users.id','users.name','users.name_kana','users.realname','users.realname_kana','users.email','users.role_id','roles.role_name','users.area_id','areas.area_name','users.user_info','users.photo1','users.photo2',)
        // ->first();

        $resv = DB::table('reservations')
        ->join('secondary_categories','secondary_categories.id','=','reservations.secondary_category_id')
        ->join('events','events.id','=','reservations.event_id')
        ->join('sub_categories','sub_categories.id','=','reservations.sub_category_id')
        ->join('users','users.id','=','reservations.user_id')
        ->join('areas','areas.id','=','users.area_id')
        ->join('primary_categories','primary_categories.id','=','secondary_categories.primary_category_id')
        ->where('reservations.id',$id)
        // ->select('users.id','users.name','users.name_kana','users.realname','users.realname_kana','users.email','users.role_id','roles.role_name','users.area_id','areas.area_name','users.user_info','users.photo1','users.photo2',)
        ->first();

        $login_user = User::findOrFail(Auth::id());


        // dd($user,$evt_id);
        return view('events.resv_edit',compact('resv','login_user','categories','sub_categories','resv_id'));
    }


    public function update(Request $request, $id)
    {
        $resv_id = $id;

        $resv = DB::table('reservations')
        ->join('secondary_categories','secondary_categories.id','=','reservations.secondary_category_id')
        ->join('events','events.id','=','reservations.event_id')
        ->join('sub_categories','sub_categories.id','=','reservations.sub_category_id')
        ->join('users','users.id','=','reservations.user_id')
        ->join('areas','areas.id','=','users.area_id')
        ->join('primary_categories','primary_categories.id','=','secondary_categories.primary_category_id')
        ->where('reservations.id',$id)
        // ->select('users.id','users.name','users.name_kana','users.realname','users.realname_kana','users.email','users.role_id','roles.role_name','users.area_id','areas.area_name','users.user_info','users.photo1','users.photo2',)
        ->first();

        $login_user = User::findOrFail(Auth::id());

        $resv = Reservation::findOrFail($id);
        $resv->user_id = $request['user_id'];
        $resv->event_id = $request['event_id'];
        $resv->secondary_category_id = $request['category'];
        $resv->sub_category_id = $request['sub_category'];
        $resv->number = $request['number'];
        $resv->real_name = $request['real_name'];
        $resv->real_name_kana = $request['real_name_kana'];
        $resv->resv_info = $request['resv_info'];
        $resv->number_of_main = 1;
        $resv->number_of_sub = $request['number_of_sub'];
        $resv->save();

        return to_route('my_reservation_list')->with(['message'=>'変更を受付ました','status'=>'info']);

    }


    public function destroy($id)
    {
        // dd($id);
        Reservation::findOrFail($id)->delete();

        return to_route('my_reservation_list')->with(['message'=>'変更を受付ました','status'=>'alert']);
    }

    public function cancel($id)
    {
        // dd($id);
        $reservation = Reservation::findOrFail($id);
        $reservation->canceled_date = Carbon::now()->format('Y-m-d H:i:s');
        $reservation->save();

        return to_route('my_reservation_list')->with(['message'=>'キャンセルを受付ました','status'=>'notice']);
    }



    public function reservation_list(Request $request, $id)
    {
        $event = Event::findOrFail($id);


        $primaries=DB::table('primary_categories')
        ->select(['id','primary_name','sort_order'])
        ->orderBy('sort_order','asc')
        ->get();

        $secondaries=DB::table('secondary_categories')
        ->select(['id','secondary_name','sort_order'])
        ->orderBy('sort_order','asc')
        ->get();

        // $users = $event->users;

        $users = DB::table('reservations')
        ->join('secondary_categories','secondary_categories.id','=','reservations.secondary_category_id')
        ->join('events','events.id','=','reservations.event_id')
        ->join('users','users.id','=','reservations.user_id')
        ->join('sub_categories','sub_categories.id','=','reservations.sub_category_id')
        ->join('areas','areas.id','=','users.area_id')
        ->join('statuses','statuses.id','=','reservations.status_id')
        ->join('primary_categories','primary_categories.id','=','secondary_categories.primary_category_id')
        ->where('reservations.event_id',($id))
        ->whereNull('reservations.canceled_date')
        ->where('secondary_categories.primary_category_id','LIKE','%'.$request->primary_id.'%')
        ->where('reservations.secondary_category_id','LIKE','%'.$request->secondary_id.'%')
        // ->select('secondary_categories.secondary_name')
        ->orderBy('reservations.created_at','desc')
        ->get();

        $number_of_resv = DB::table('reservations')
        ->join('secondary_categories','secondary_categories.id','=','reservations.secondary_category_id')
        ->join('events','events.id','=','reservations.event_id')
        ->join('users','users.id','=','reservations.user_id')
        ->join('areas','areas.id','=','users.area_id')
        ->join('primary_categories','primary_categories.id','=','secondary_categories.primary_category_id')
        ->where('reservations.event_id',($id))
        ->whereNull('reservations.canceled_date')
        ->where('secondary_categories.primary_category_id','LIKE','%'.$request->primary_id.'%')
        ->where('reservations.secondary_category_id','LIKE','%'.$request->secondary_id.'%')
        ->selectRaw('SUM(reservations.number_of_main) as number_of_main')
        ->selectRaw('SUM(reservations.number_of_sub) as number_of_sub')
        ->get();

        // dd($event,$users,$number_of_resv,$primaries,$secondaries);


        return view('events.reservation_list',compact('event','users','primaries','secondaries','number_of_resv'));
    }

    public function resv_member_detail($id)
    {
        $user = DB::table('users')
        ->join('areas','areas.id','=','users.area_id')
        ->join('roles','roles.id','=','users.role_id')
        ->where('users.id',$id)
        // ->select('users.id','users.name','users.name_kana','users.realname','users.realname_kana','users.email','users.role_id','roles.role_name','users.area_id','areas.area_name','users.user_info','users.photo1','users.photo2',)
        ->first();

        $resv = DB::table('reservations')
        ->join('secondary_categories','secondary_categories.id','=','reservations.secondary_category_id')
        ->join('events','events.id','=','reservations.event_id')
        ->join('users','users.id','=','reservations.user_id')
        ->join('areas','areas.id','=','users.area_id')
        ->join('primary_categories','primary_categories.id','=','secondary_categories.primary_category_id')
        ->where('reservations.user_id',$id)
        // ->select('users.id','users.name','users.name_kana','users.realname','users.realname_kana','users.email','users.role_id','roles.role_name','users.area_id','areas.area_name','users.user_info','users.photo1','users.photo2',)
        ->first();

        $login_user = User::findOrFail(Auth::id());


        // dd($user,$evt_id);
        return view('events.resv_member_detail',compact('user','resv','login_user'));

    }



    public function reservation_create($id)
    {
        $categories = PrimaryCategory::with('secondary')
        ->get();
        $sub_categories = SubCategory::all();
        $user = User::findOrFail(Auth::id());
        // $event = Event::findOrFail( $id)->first();
        $event = DB::table('events')
        ->where('events.id',$id)
        // ->select('events.id','events.start_date','events.event_name','events.place_area_id')
        ->first();
        $login_user= DB::table('users')
        ->where('users.id',Auth::id())->get();
        $name_kana_ck= DB::table('users')
        ->whereNull('users.name_kana')
        ->where('users.id',Auth::id())->exists();
        $user_info_ck= DB::table('users')
        ->whereNull('users.user_info')
        ->where('users.id',Auth::id())->exists();
        $user_photo_ck= DB::table('users')
        ->whereNull('users.photo1')
        ->where('users.id',Auth::id())->exists();
        $user_area_ck= DB::table('users')
        ->whereNull('users.area_id')
        ->where('users.id',Auth::id())->exists();



        // dd($number_of_resv,$login_user,$name_kana_ck,$user_info_ck,$user_photo_ck,$user_area_ck);

        if($name_kana_ck||$user_info_ck||$user_photo_ck||$user_area_ck) {
            return to_route('ac_info_edit',['user'=>$user->id])->with(['message'=>'アカウント情報の追加入力を先にお願いします','status'=>'notice']);
        }


        return view('events.resv_create',compact('user','event','categories','sub_categories'));
    }

    public function reservation_store(Request $request)
    {
        $event = Event::findOrFail($request->event_id);
        $this_date = Carbon::parse($event->start_date)->format('Y-m-d');
        $this_start_time = Carbon::parse($event->start_date)->format('H:i:s');
        $this_end_time = Carbon::parse($event->end_date)->format('H:i:s');
        $check = DB::table('reservations')
        ->join('events','events.id','=','reservations.event_id')
        ->where('reservations.user_id',Auth::id())
        ->whereNull('reservations.canceled_date')
        ->whereDate('events.end_date',$this_date)
        ->whereTime('events.end_date','>',$this_start_time)
        ->whereTime('events.start_date','<',$this_end_time)
        ->exists();
        // ->select('reservations.id','reservations.event_id','events.start_date','events.end_date')
        // ->get();

        $number_of_resv = DB::table('reservations')
        ->where('reservations.event_id',($request->event_id))
        ->whereNull('reservations.canceled_date')
        ->selectRaw('SUM(reservations.number_of_main) as number_of_main')
        ->selectRaw('SUM(reservations.number_of_sub) as number_of_sub')
        ->first();

            // メール送信テスト
            // $user = User::findOrFail(Auth::id())
            // ->toArray();

            // $event_info = Event::findOrFail($request->event_id)
            // ->toArray();


            // dd($user,$event_info);

        if($check){
            return to_route('my_reservation_list')->with(['message'=>'同時間帯に他イベントの予約があるため予約できません','status'=>'alert']);
        }

        if(is_null($number_of_resv) ||
        $event->capacity >= $number_of_resv->number_of_main +1)
        {Reservation::create([
            'user_id' => $request['user_id'],
            'event_id' => $request['event_id'],
            'status_id' => 1,
            'secondary_category_id' => $request['category'],
            'sub_category_id' => $request['sub_category'],
            'number' => $request['number'],
            'real_name' => $request['real_name'],
            'real_name_kana' => $request['real_name_kana'],
            'resv_info' => $request['resv_info'],
            'number_of_main' => 1,
            'number_of_sub' => $request['number_of_sub'],
        ]);

            // 本来はここでメール送信
        $user = User::findOrFail(Auth::id())
        ->toArray();

        $event_info = Event::findOrFail($request->event_id)
        ->toArray();

        // dd($user,$event_info);

        SendReservationThanksMail2::dispatch($event_info,$user);
        SendResvReportMail::dispatch($event_info,$user);

        return to_route('my_reservation_list')->with(['message'=>'参加申込を受付ました','status'=>'info']);

    }else{
        return to_route('event_detail',['event'=>$request->event_id] )->with(['message'=>'定員オーバーで予約できません','status'=>'alert']);
    }


    }

    public function reservation_store2(Request $request)
    {
        $event = Event::findOrFail($request->event_id);
        $this_date = Carbon::parse($event->start_date)->format('Y-m-d');
        $this_start_time = Carbon::parse($event->start_date)->format('H:i:s');
        $this_end_time = Carbon::parse($event->end_date)->format('H:i:s');
        $check = DB::table('reservations')
        ->join('events','events.id','=','reservations.event_id')
        ->where('reservations.user_id',Auth::id())
        ->whereNull('reservations.canceled_date')
        ->whereDate('events.end_date',$this_date)
        ->whereTime('events.end_date','>',$this_start_time)
        ->whereTime('events.start_date','<',$this_end_time)
        ->exists();
        // ->select('reservations.id','reservations.event_id','events.start_date','events.end_date')
        // ->get();

        $number_of_resv = DB::table('reservations')
        ->where('reservations.event_id',($request->event_id))
        ->whereNull('reservations.canceled_date')
        ->selectRaw('SUM(reservations.number_of_main) as number_of_main')
        ->selectRaw('SUM(reservations.number_of_sub) as number_of_sub')
        ->first();

        // dd($this_date,$this_start_time,$this_end_time,$check);

        if($check){
            return to_route('my_reservation_list')->with(['message'=>'同時間帯に他イベントの予約があるため予約できません','status'=>'alert']);
        }

        if(is_null($number_of_resv) ||
        $event->capacity >= $number_of_resv->number_of_main +1)
        {Reservation::create([
            'user_id' => $request['user_id'],
            'event_id' => $request['event_id'],
            'status_id' => 1,
            'secondary_category_id' => $request['category'],
            'sub_category_id' => $request['sub_category'],
            'number' => $request['number'],
            'real_name' => $request['real_name'],
            'real_name_kana' => $request['real_name_kana'],
            'resv_info' => $request['resv_info'],
            'number_of_main' => 1,
            'number_of_sub' => $request['number_of_sub'],
        ]);

        return to_route('my_reservation_list')->with(['message'=>'参加申込を受付ました','status'=>'info']);
    }else{
        return to_route('event_detail',['event'=>$request->event_id] )->with(['message'=>'定員オーバーで予約できません','status'=>'alert']);
    }


    }




}
