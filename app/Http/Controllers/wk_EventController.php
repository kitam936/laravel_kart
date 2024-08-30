<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\User;
use App\Models\Area;
use App\Models\Status;
use Carbon\Carbon;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Reservation;

class EventController extends Controller
{

    public function index(Request $request)
    {

        $areas = DB::table('areas')
        ->select(['areas.id','areas.area_name'])
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
        ->where('events.event_name','LIKE','%'.($request->event_name).'%')
        ->where('events.is_visible','LIKE','%'.($request->is_visible).'%')
        ->select('events.id','events.start_date','events.event_name','events.place_area_id','areas.area_name','events.place','events.is_visible','events.capacity','number_of_main')
        ->orderBy('events.start_date','desc')
        ->paginate(20);

        $is_visibles = DB::table('events')
        ->select('events.is_visible')
        ->groupBy('events.is_visible')
        ->get();




        // dd($is_visibles);

        return view('manager.events.index',compact('areas','events','is_visibles'));
        // dd($roles,$areas,$users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $planner = User::findOrFail(Auth::id());
        $areas = DB::table('areas')
        ->where('areas.id','<',9)
        ->select(['areas.id','areas.area_name'])
        ->get();
        return view('manager.events.create',compact('areas','planner'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $planner = DB::table('users')
        ->where('users.id',Auth::id())
        ->select(['users.id','users.name','users.email','users.name'])
        ->first();

        // dd($planner->email);

        $areas = DB::table('areas')
        ->select(['areas.id','areas.area_name'])
        ->get();

        $check = DB::table('events')
        ->whereDate('start_date', $request['event_date'])
        ->whereTime('end_date' ,'>',$request['start_time'])
        ->whereTime('start_date', '<', $request['end_time'])
        ->exists();


        if($check){
            session()->flash('status', 'この時間帯は既に他の予約が存在します。');
            return view('manager.events.create',compact('areas'));
            // return to_route('events.create')->with(['message'=>'この時間帯は既に他の予約が存在します。','status'=>'info']);
            }

        $start = $request['event_date'] . " " . $request['start_time'];
        $startDate = Carbon::createFromFormat(
        'Y-m-d H:i', $start );

        $end = $request['event_date'] . " " . $request['end_time'];
        $endDate = Carbon::createFromFormat(
        'Y-m-d H:i', $end );

        Event::create([
            'event_name' => $request['event_name'],
            'information' => $request['information'],
            'place_area_id' => $request['area_id'],
            'place' => $request['place'],
            'main_fee' => $request['main_fee'],
            'sub_fee' => $request['sub_fee'],
            'start_date' => $startDate,
            'end_date' => $endDate,
            'capacity' => $request['capacity'],
            'is_visible' => $request['is_visible'],
            'planner' => $request['planner'],
            'planner_name' => $planner->name,
            'planner_email' => $planner->email,
        ]);

        return to_route('events.index')->with(['message'=>'イベントが登録されました','status'=>'info']);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $login_user = User::findOrFail(Auth::id());
        $areas = DB::table('areas')
        ->select(['areas.id','areas.area_name'])
        ->get();

        $event = Event::findOrFail($id);
        $eventDate = $event->eventDate;
        $startTime = $event->startTime;
        $endTime = $event->endTime;
        // dd($event,$eventDate, $startTime, $endTime);
        $event_comments = DB::table('evt_comments')
        ->join('users','users.id','=','evt_comments.user_id')
        ->join('events','events.id','=','evt_comments.event_id')
        ->where('evt_comments.event_id',($id))
        ->select('evt_comments.id','evt_comments.event_id','events.event_name','evt_comments.user_id','users.name','evt_comments.title','evt_comments.ev_comment','evt_comments.created_at','evt_comments.updated_at')
        ->orderBy('evt_comments.created_at','desc')
        ->get();


        $reservedPeople = DB::table('reservations')
        ->whereNull('reservations.canceled_date')
        ->select('event_id', DB::raw('sum(number_of_main)
        as number_of_main'))
        ->groupBy('event_id');

        $events = DB::table('events')
        ->join('areas','areas.id','=','events.place_area_id')
        ->join('users','users.id','=','events.planner')
        ->leftJoinSub($reservedPeople, 'reservedPeople',
        function($join){
        $join->on('events.id', '=', 'reservedPeople.event_id');
        })
        ->where('events.id',($id))
        ->select('events.id','events.start_date','events.end_date','events.event_name','events.information','events.main_fee','sub_fee','events.capacity','events.place_area_id','areas.area_name','events.place','events.is_visible','events.planner','users.name','events.capacity','number_of_main')
        ->orderBy('events.start_date','desc')
        ->get();

        $number_of_resv = DB::table('events')
        ->join('areas','areas.id','=','events.place_area_id')
        ->join('users','users.id','=','events.planner')
        ->leftJoinSub($reservedPeople, 'reservedPeople',
        function($join){
        $join->on('events.id', '=', 'reservedPeople.event_id');
        })
        ->where('events.id',($id))
        ->select('events.id','events.start_date','events.end_date','events.event_name','events.information','events.main_fee','sub_fee','events.capacity','events.place_area_id','areas.area_name','events.place','events.is_visible','events.planner','users.name','events.capacity','number_of_main')
        ->orderBy('events.start_date','desc')
        ->first();

        // dd($number_of_resv);



        return view('manager.events.event_detail',compact('events','event_comments','areas','event', 'eventDate', 'startTime', 'endTime','login_user','number_of_resv'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $areas = DB::table('areas')
        ->select(['areas.id','areas.area_name'])
        ->get();
        $events = DB::table('events')
        ->join('areas','areas.id','=','events.place_area_id')
        ->where('events.id',($id))
        ->select('events.id','events.start_date','events.event_name','events.information','events.main_fee','events.sub_fee','events.capacity','events.place_area_id','areas.area_name','events.place','events.is_visible')
        ->get();
        $event = Event::findOrFail($id);
        $eventDate = $event->editEventDate;
        $startTime = $event->startTime;
        $endTime = $event->endTime;
        // dd($companies,$areas,$shops);

        return view('manager.events.event_edit',compact('areas','events','event', 'eventDate', 'startTime', 'endTime'));
        // dd($roles,$areas,$users);
    }


    public function update(UpdateEventRequest $request, Event $event)
    {

        // $areas = DB::table('areas')
        // ->select(['areas.id','areas.area_name'])
        // ->get();

        // $events = DB::table('events')
        // ->join('areas','areas.id','=','events.place_area_id')
        // ->where('events.id',($event->id))
        // ->select('events.id','events.start_date','events.event_name','events.information','events.main_fee','events.sub_fee','events.capacity','events.place_area_id','areas.area_name','events.place','events.is_visible')
        // ->get();

        // $eventDate = $event->editEventDate;
        // $startTime = $event->startTime;
        // $endTime = $event->endTime;

        $start = $request['event_date'] . " " . $request['start_time'];
        $startDate = Carbon::createFromFormat('Y-m-d H:i', $start );
        $end = $request['event_date'] . " " . $request['end_time'];
        $endDate = Carbon::createFromFormat('Y-m-d H:i', $end );

        $check = DB::table('events')
        ->whereDate('start_date', $request['event_date'])
        ->whereTime('end_date' ,'>',$request['start_time'])
        ->whereTime('start_date', '<', $request['end_time'])
        ->count();

        $event = Event::findOrFail($event->id);
        $event->event_name = $request['event_name'];
        $event->information = $request['information'];
        $event->place_area_id = $request['area_id'];
        $event->place = $request['place'];
        $event->main_fee = $request['main_fee'];
        $event->sub_fee = $request['sub_fee'];
        $event->start_date = $startDate;
        $event->end_date = $endDate;
        $event->capacity = $request['capacity'];
        $event->is_visible = $request['is_visible'];
        $event->save();

        if($check>1){
            session()->flash('status', 'この時間帯は既に他の予約が存在します。');
            return to_route('events.index')->with(['message'=>'イベント情報が更新されました。　　　この時間帯には他のイベントが存在します。','status'=>'notice']);
            // return view('manager.events.event_edit',compact('areas','events','event', 'eventDate', 'startTime', 'endTime'));
            // return to_route('events.create')->with(['message'=>'この時間帯は既に他の予約が存在します。','status'=>'info']);
            }

        return to_route('events.index')->with(['message'=>'イベント情報が更新されました','status'=>'info']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Event::findOrFail($id)->delete();

        return to_route('events.index')->with(['message'=>'イベントが削除されました','status'=>'alert']);
    }

    public function eventlist(Request $request)
    {
        $number_of_capacity = DB::table('events')
        ->select('id', DB::raw('sum(capacity) as capacity'))
        ->groupBy('id')->first();

        $areas = DB::table('areas')
        ->select(['areas.id','areas.area_name'])
        ->get();

        // $events = DB::table('events')
        // ->join('areas','areas.id','=','events.place_area_id')
        // ->select('events.id','events.start_date','events.event_name','events.place_area_id','areas.area_name','events.place','events.is_visible')
        // ->where('events.is_visible',1)
        // ->where('events.place_area_id','LIKE','%'.($request->ar_id).'%')
        // ->where('events.information','LIKE','%'.($request->information).'%')
        // ->orderBy('events.start_date','desc')
        // ->paginate(20);

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
        ->where('events.is_visible',1)
        ->where('events.place_area_id','LIKE','%'.($request->ar_id).'%')
        ->where('events.event_name','LIKE','%'.($request->event_name).'%')
        ->select('events.id','events.start_date','events.event_name','events.place_area_id','areas.area_name','events.place','events.is_visible','events.capacity','number_of_main')
        ->orderBy('events.start_date','desc')
        ->paginate(20);


        // dd($companies,$areas,$shops);

        return view('events.eventlist',compact('areas','events'));
        // dd($roles,$areas,$users);
    }

    public function event_detail($id)
    {
        // $reservedPeople = DB::table('reservations')
        // ->select('event_id', DB::raw('sum(number_of_main)
        // as number_of_main'))
        // ->groupBy('event_id');

        // $events = DB::table('events')
        // ->join('areas','areas.id','=','events.place_area_id')
        // ->leftJoinSub($reservedPeople, 'reservedPeople',
        // function($join){
        // $join->on('events.id', '=', 'reservedPeople.event_id');
        // })
        // ->where('events.id',($id))
        // // ->orderBy('events.start_date', 'asc')
        // ->get();


        $areas = DB::table('areas')
        ->select(['areas.id','areas.area_name'])
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
        ->where('events.is_visible',1)
        ->where('events.id',($id))
        ->select('events.id','events.start_date','events.event_name','events.information','events.main_fee','events.sub_fee','events.place_area_id','areas.area_name','events.place','events.is_visible','events.capacity','number_of_main')
        ->orderBy('events.start_date','desc')
        ->paginate(20);

        // $events = DB::table('events')
        // ->join('areas','areas.id','=','events.place_area_id')
        // ->where('events.id',($id))
        // ->select('events.id','events.start_date','events.event_name','events.information','events.main_fee','sub_fee','events.capacity','events.place_area_id','areas.area_name','events.place')
        // ->get();

        $event = Event::findOrFail($id);
        $eventDate = $event->eventDate;
        $startTime = $event->startTime;
        $endTime = $event->endTime;
        $event_comments = DB::table('evt_comments')
        ->join('users','users.id','=','evt_comments.user_id')
        ->join('events','events.id','=','evt_comments.event_id')
        ->where('evt_comments.event_id',($id))
        ->select('evt_comments.id','evt_comments.event_id','events.event_name','evt_comments.user_id','users.name','evt_comments.title','evt_comments.ev_comment','evt_comments.created_at')
        ->orderBy('evt_comments.created_at','desc')
        ->get();


        $number_of_capacity = DB::table('events')
        ->where('events.id',($id))
        ->select('id', DB::raw('sum(capacity) as capacity'))
        ->groupBy('id')->first();


        $number_of_resv = DB::table('reservations')
        ->where('reservations.event_id',($id))
        ->select('event_id', DB::raw('sum(number_of_main) as
        number_of_main'))
        ->whereNull('canceled_date')
        ->groupBy('event_id')->first();

        $isReserved = DB::table('reservations')
        ->join('events','events.id','=','reservations.event_id')
        ->where('events.id',$id)
        ->where('reservations.user_id',Auth::id())
        ->whereNull('reservations.canceled_date')
        // ->select('events.id','events.start_date','events.event_name','events.place_area_id')
        ->exists();


        // dd($isReserved);

        return view('events.event_detail',compact('events','event_comments','areas','event', 'eventDate', 'startTime', 'endTime','number_of_resv','number_of_capacity','isReserved'));
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
        ->join('areas','areas.id','=','users.area_id')
        ->join('primary_categories','primary_categories.id','=','secondary_categories.primary_category_id')
        ->where('reservations.event_id',($id))
        ->where('secondary_categories.primary_category_id','LIKE','%'.$request->primary_id.'%')
        ->where('reservations.secondary_category_id','LIKE','%'.$request->secondary_id.'%')
        // ->select('secondary_categories.secondary_name')
        // ->orderBy('evt_comments.created_at','desc')
        ->get();

        $number_of_resv = DB::table('reservations')
        ->join('secondary_categories','secondary_categories.id','=','reservations.secondary_category_id')
        ->join('events','events.id','=','reservations.event_id')
        ->join('users','users.id','=','reservations.user_id')
        ->join('areas','areas.id','=','users.area_id')
        ->join('primary_categories','primary_categories.id','=','secondary_categories.primary_category_id')
        ->where('reservations.event_id',($id))
        ->where('secondary_categories.primary_category_id','LIKE','%'.$request->primary_id.'%')
        ->where('reservations.secondary_category_id','LIKE','%'.$request->secondary_id.'%')
        ->selectRaw('SUM(reservations.number_of_main) as number_of_main')
        ->selectRaw('SUM(reservations.number_of_sub) as number_of_sub')
        ->get();

        // dd($event,$users,$number_of_resv,$primaries,$secondaries);


        return view('events.reservation_list',compact('event','users','primaries','secondaries','number_of_resv'));
    }

    public function resv_member_detail(Request $request, $id)
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

        $evt_id = $request->evt_id;

        // dd($user,$evt_id);
        return view('events.resv_member_detail',compact('user','evt_id','resv','login_user'));

    }

    public function reservation_create()
    {
        $planner = User::findOrFail(Auth::id());
        $areas = DB::table('areas')
        ->where('areas.id','<',9)
        ->select(['areas.id','areas.area_name'])
        ->get();
        return view('events.resv_create',compact('areas','planner'));
    }



}
