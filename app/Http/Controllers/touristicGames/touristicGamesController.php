<?php

namespace App\Http\Controllers\touristicGames;

use App\Http\Controllers\Controller;
use App\Models\touristicGames\gameComponents\touristicGameComponent;
use App\Models\touristicGames\touristicGame;
use App\Repositories\touristicGames\touristicGamesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class touristicGamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('touristicGames.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('touristicGames.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'game_name'=>'required|string',
            'game_category'=>'required|string',
            'game_theme'=>'required|string',
            'total_players'=>'required|numeric',
            'age'=>'required|string',
            'tutorial_directory_link'=>'required|url',
            'game_price'=>'required|numeric',
            'mode_of_play'=>'required|string|max:300',
            'development_inspiration'=>'required|string|max:300',
            'game_images.*'=>'required|mimes:jpg,jpeg,png|max:5120|dimensions:max_width:2000,max_height:2000',
        ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $touristicGamesRepo=new touristicGamesRepository();
        $touristicGames=$touristicGamesRepo->storeTouristicGame($input);
        return back()->with('touristicGames',$touristicGames)->withFlashSuccess('Touristic game added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($touristicGameUuid)
    {
        $touristicGame=touristicGame::query()->where('uuid',$touristicGameUuid)->first();
        $touristicGameComponents=touristicGameComponent::query()->where('touristic_game_id',$touristicGame->id)->get();
        return view('touristicGames.view')
            ->with('touristicGameComponents',$touristicGameComponents)
            ->with('touristicGame',$touristicGame);
    }

    public function publicView($touristicGameUuid)
    {
        $touristicGame=touristicGame::query()->where('uuid',$touristicGameUuid)->first();
        $touristicGameComponents=touristicGameComponent::query()->where('touristic_game_id',$touristicGame->id)->get();
        return view('touristicGames.publicView')
            ->with('touristicGameComponents',$touristicGameComponents)
            ->with('touristicGame',$touristicGame);
    }
    public function allTouristicGames()
    {
        $touristicGames=touristicGame::query()->inRandomOrder()->paginate(9);
        return view('touristicGames.allTouristicGames.show')->with('touristicGames',$touristicGames);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($touristicGameUuid)
    {
        $touristicGame=touristicGame::query()->where('uuid',$touristicGameUuid)->first();
        $touristicGameComponents=touristicGameComponent::query()->where('touristic_game_id',$touristicGame->id)->get();
        return view('touristicGames.edit')
            ->with('touristicGameComponents',$touristicGameComponents)
            ->with('touristicGame',$touristicGame);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $touristicGameUuid)
    {
        $validator=Validator::make($request->all(),
            [
                'game_name'=>'required|string',
                'game_category'=>'required|string',
                'game_theme'=>'required|string',
                'total_players'=>'required|numeric',
                'age'=>'required|string',
                'tutorial_directory_link'=>'required|url',
                'game_price'=>'required|numeric',
                'mode_of_play'=>'required|string|max:300',
                'development_inspiration'=>'required|string|max:300',
                'game_images.*'=>'nullable|mimes:jpg,jpeg,png|max:5120|dimensions:max_width:2000,max_height:2000',
            ]);
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input=$request->all();
        $touristicGamesRepo=new touristicGamesRepository();
        $touristicGames=$touristicGamesRepo->updateTouristicGames($input,$touristicGameUuid,$request);
        return back()->withFlashSuccess('Touristic game was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($touristicGameUuid)
    {
        $touristicGame=touristicGame::query()->where('uuid',$touristicGameUuid)->first();
        $touristicGame->delete();
        return back()->withFlashSuccess('Touristic game was deleted successfully');
    }
    public function deleteGameComponent($touristicGameComponentUuid)
    {
        $touristicGameComponent=touristicGameComponent::query()->where('uuid',$touristicGameComponentUuid)->first();
        $touristicGameComponent->delete();
        return back()->withFlashSuccess('Game component was deleted successfully');
    }

    public function activateTouristicGame(Request $request)
    {
        $touristicGame=touristicGame::find($request->id);
        $status=$request->status;
        switch ($status)
        {
            case 0:
                $touristicGame->status=1;
                break;
            case 1:
                $touristicGame->status=0;
                break;
        }
        $touristicGame->save();
        return response()->json(['success'=>true]);
    }
    public function getTouristicGames()
    {
        $touristicGame=touristicGame::query()->orderBy('game_name')->get();
        return DataTables::of($touristicGame)
            ->addindexColumn()
            ->addColumn('game_name',function ($touristicGame){
                return $touristicGame->game_name;
            })
            ->addColumn('game_category',function ($touristicGame){
                return $touristicGame->game_category;
            })
            ->addColumn('total_players',function ($touristicGame){
                return $touristicGame->total_players;
            })
            ->addColumn('age',function ($touristicGame){
                return $touristicGame->age;
            })
            ->addColumn('game_price',function ($touristicGame){
                return number_format($touristicGame->game_price);
            })
            ->addColumn('activateTouristicGame',function($touristicGame){
                $btn='<label class="switch{{$touristicGame->status}}">
                          <input type="checkbox">
                          <span class="slider round"></span>
                        </label>';
                return $btn;
            })
            ->addColumn('game_status',function ($touristicGame){
                return $touristicGame->gameStatusLabel;
            })
            ->addColumn('actions',function ($touristicGame){
                return $touristicGame->buttonActionLabel;
            })
            ->rawColumns(['activateTouristicGame','game_status','actions'])
            ->make(true);
    }
}
