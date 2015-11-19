<?php

namespace SolutionBook\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SolutionBook\Entities\JudgesList;
use SolutionBook\Entities\Problem;
use SolutionBook\Entities\Tools;

use SolutionBook\Http\Requests;
use SolutionBook\Http\Requests\AddJudgeRequest;
use SolutionBook\Http\Controllers\Controller;

class JudgesController extends Controller
{
    //
    public function addJudge(AddJudgeRequest $request)
    {
        //        dd($request);
        $name=$request->name;
        $url=$request->addressWeb;
        $facebook=$request->facebook;
        $twitter=$request->twitter;
        $image=$request->images;
        $nameI="";
        if($image!=null)
            $nameI = $image->getClientOriginalName();
        $judge=JudgesList::create([
            'name'=>$name,
            'addressWeb'=>$url,
            'facebook'=> $facebook,
            'twitter'=> $twitter,

        ]);
        $path="judges/".$judge->id."/";
        if($image!=null){
            $judge->update(['image' =>$path.$nameI,] );
            $image->move($path,$nameI);
        }
        if($request->ajax()){
            return response()->json(['success' 		=> 	true,'message' 		=> 	'<option value="'.$judge->id.'" selected="selected">'.$judge->name.'</option>']);
        }

        return redirect()->back();

    }

    public function updateJudge(AddJudgeRequest $request)
    {
        //        dd($request);
        $name=$request->name;
        $id=$request->id;
        $url=$request->addressWeb;
        $facebook=$request->facebook;
        $twitter=$request->twitter;
        $image=$request->images;
        $nameI="";
        if($image!=null)
            $nameI = $image->getClientOriginalName();

        $judge=JudgesList::find($id);
           $judge->update([
            'name'=>$name,
            'addressWeb'=>$url,
            'facebook'=> $facebook,
            'twitter'=> $twitter,

        ]);
        $path="judges/".$id."/";
        if($image!=null){
            if($judge->image!=null)
                unlink($judge->image);
            $judge->update(['image' =>$path.$nameI,] );
            $image->move($path,$nameI);
        }

        return redirect()->back();

    }

    public function showJudges(){
        $judges=JudgesList::paginate(10);
        foreach ($judges as $key => $j) {
            # code...
            if($j->image==null)
                $j->image="Judging.jpg";
        }
        return view('super/showJudges',compact('judges'));
    }

    public function deleteJudge($id){
        $judge=JudgesList::find($id);
        $problemas=$judge->problem();
        $idj=null;
        //dd($problemas);
        foreach ($problemas as $key => $p) {
            # code...
            Problem::find($p->id)->update(['judgeList_id'=>$idj]);
        }
        $path="judges/".$judge->id."/";
        Tools::deleteDirectory($path); 
        $judge->delete();
        
        return redirect()->back();
    }
}
