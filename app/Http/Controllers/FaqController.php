<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FaqController extends Controller
{
   public function index(){
     return view('Faq.index');
   }
   public function searchfaqattracion(request $request){
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
        
    return view('Faq.filter_attr',['attraction'=>$getatr,'val'=>'attraction']);
   }

   public function edit_att_faq($id){
        
    $getfaq = DB::table('SightQuestion')->leftJoin('Sight','Sight.SightId','=','SightQuestion.SightId')
    ->select('SightQuestion.*','Sight.Title')
    ->where('SightQuestion.SightId',$id)->get();
    
    return view('Faq.edit_sight_faq',['getfaq'=>$getfaq]);
    }
  

    public function filter_faq_hotel(request $request){
        $val =  $request->get('value');        
        $getlisting = DB::table('TPHotels')         
            ->where(function ($query) use ($val) {
                    $query->where(
                        'hotelid', 'LIKE', $val . '%')->orWhere(
                            'name', 'LIKE', $val . '%')->orWhere(
                                'slug', 'LIKE', $val . '%');
            })->limit(2)
            ->get();        
        return view('Faq.filter_attr',['hotellisting'=>$getlisting,'val'=>'hotel']);
    }


    public function edit_hotel_faq($id){
        $hotelfaq = DB::table('HotelQuestion')
        ->Leftjoin('TPHotels','HotelQuestion.HotelId', '=' ,'TPHotels.hotelid')
        ->select('HotelQuestion.*','TPHotels.name')
        ->where('HotelQuestion.HotelId',$id)->get();
        return view('Faq.edit_hotel_faq',['getfaq'=>$hotelfaq]);

    }


    public function search_faq_restaurant(request $request){
        $val =  $request->get('value');
        
            $getlisting = DB::table('Restaurant')              
                ->where(function ($query) use ($val) {
                        $query->where(
                            'RestaurantId', 'LIKE', $val . '%')->orWhere(
                                'Title', 'LIKE',  $val . '%')->orWhere(
                                    'Slug', 'LIKE', $val . '%');
                })->limit(2)
                ->get();
               
         return view('Faq.filter_rest',['hotellisting'=>$getlisting]);
    }
    public function edit_restaurant_faq($id){
        $getfaq = DB::table('RestaurantQuestion')
        ->Leftjoin('Restaurant','Restaurant.RestaurantId', '=' ,'RestaurantQuestion.RestaurantId')
        ->select('RestaurantQuestion.*','Restaurant.Title')
        ->where('RestaurantQuestion.RestaurantId',$id)->get();
      
        return view('Faq.edit_rest_faq',['getfaq'=>$getfaq]);
    }
    public function search_faq_experience(request $request){
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

   
         return view('Faq.filter_experience',['data'=>$getatr]);
    }
    
 
    public function edit_experience_faq($id){
        $getfaq = DB::table('ExperienceQuestion')
          ->Leftjoin('Experience','ExperienceQuestion.ExperienceId', '=' ,'Experience.ExperienceId')
          ->select('ExperienceQuestion.*','Experience.Name as expName')
          ->where('ExperienceQuestion.ExperienceId',$id)->get();
          return view('Faq.edit_experience_faq',['getfaq'=>$getfaq]);
      }
      
}
