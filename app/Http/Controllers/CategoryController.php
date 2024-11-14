<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
  public function index(){
    return view('category.index');
  }

  public function edit_att_category($id){
    $getsitecat =  DB::table('SightCategory')->leftJoin('Sight','Sight.SightId','=','SightCategory.SightId')->leftJoin('Category','Category.CategoryId','=','SightCategory.CategoryId')->select('SightCategory.*','Category.Title as ctitle','Sight.Title as stitle')->where('SightCategory.SightId',$id)->get();
      return view('category.edit_att_category',['get_cat'=> $getsitecat]);
  }
  public function search_cat_attracion(request $request){
    $val =  $request->get('value');
    
    $getatr = DB::table('Sight')
        ->select('Sight.*')
        ->where(function ($query) use ($val) {
                $query->where(
                    'Sight.SightId', 'LIKE', $val . '%')->orWhere(
                        'Sight.Title', 'LIKE',  $val . '%')->orWhere(
                            'Sight.Slug', 'LIKE',  $val . '%');
        })->limit(2)
        ->get();
        
    return view('category.filter_att',['attraction'=>$getatr,'val'=>'attraction']);

   }

 
    public function search_cat_hotel(request $request){
        $val =  $request->get('value');        
        $getlisting = DB::table('TPHotels')         
            ->where(function ($query) use ($val) {
                    $query->where(
                        'hotelid', 'LIKE', $val . '%')->orWhere(
                            'name', 'LIKE', $val . '%')->orWhere(
                                'slug', 'LIKE', $val . '%');
            })->limit(2)
            ->get();        
        return view('category.filter_att',['hotellisting'=>$getlisting,'val'=>'hotel']);
    }
    public function edit_hotelcategory($id){
        
        $categoryIds = DB::table('TPHotels')
        ->where('hotelid', $id)
        ->pluck('CategoryId')
        ->toArray();
        $hname = DB::table('TPHotels')
        ->where('hotelid', $id)->get();
    
        
        $hotel_categories = [];
        
        foreach ($categoryIds as $categoryId) {
            $categoryTypes = DB::table('TPHotel_types')
                ->whereIn('id', explode(',', $categoryId))->get();
            
        }
        
        return view('category.edit_hotel_category',['hotel_category'=>$categoryTypes,'hname'=>$hname]);
    }

    public function search_cat_experience(request $request){
        $val =  $request->get('value');
            
        $getatr = DB::table('Experience')
        ->select('Experience.*')
        ->where(function ($query) use ($val) {
                $query->where(
                    'Experience.ExperienceId', 'LIKE', $val . '%')->orWhere(
                        'Experience.Name', 'LIKE',  $val . '%')->orWhere(
                        'Experience.Slug', 'LIKE',  $val . '%');
        })->limit(2)
        ->get();

        return view('category.filter_experience',['data'=>$getatr]);
    }

    public function edit_experience_category($id){
        $get_cat = DB::table('CategoryExperienceAssociation')
        ->join('CategoryExperience','CategoryExperience.CategoryExperienceId','CategoryExperienceAssociation.CategoryExperienceId')
        ->select('CategoryExperienceAssociation.*','CategoryExperience.*')
        ->where('CategoryExperienceAssociation.ExperienceId',$id)->get();

        return view('category.edit_exp_category',['get_cat'=>$get_cat]);
    }



}
