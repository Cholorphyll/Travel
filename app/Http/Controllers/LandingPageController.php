<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('landing.index'); 
    }

    public function search_landing_page(request $request){
        $val =  $request->get('value');
        $type =  $request->get('type');

        if($type == 'attraction'){
            $getatr = DB::table('SightLanding')
            ->select('SightLanding.*')
            ->where(function ($query) use ($val) {
                    $query->where(
                        'SightLanding.ID', 'LIKE', '%' . $val . '%')->orWhere(
                            'SightLanding.Page_Name', 'LIKE', '%' . $val . '%')->orWhere(
                              'SightLanding.Slug', 'LIKE', '%' . $val . '%');
            })->limit(2)
            ->get();
        }elseif($type == 'hotel'){

            $getatr = DB::table('TPHotel_landing')
            ->select('TPHotel_landing.*')
            ->where(function ($query) use ($val) {
                    $query->where(
                        'TPHotel_landing.id', 'LIKE', '%' . $val . '%')->orWhere(
                            'TPHotel_landing.Name', 'LIKE', '%' . $val . '%')->orWhere(
                              'TPHotel_landing.Slug', 'LIKE', '%' . $val . '%');
            })->limit(2)
            ->get();

        }elseif($type == 'restaurant'){
          
        }elseif($type == 'experience'){
            $getatr = DB::table('Experience_landing')
            ->select('Experience_landing.*')
            ->where(function ($query) use ($val) {
                    $query->where(
                        'Experience_landing.ID', 'LIKE', '%' . $val . '%')->orWhere(
                            'Experience_landing.Page_Name', 'LIKE', '%' . $val . '%')->orWhere(
                              'Experience_landing.Slug', 'LIKE', '%' . $val . '%');
            })->limit(2)
            ->get();
        }
                 
         return view('landing.filterdata',['data'=>$getatr,'type'=>$type]);
    }

    // edit attraction landing 

    public function add_sight_landing_page($id){
        $result = DB::table('SightLanding')->where('SightId',$id)->get();
        return view('landing.add_sight_landing_page',['result'=>$result]);
    }
   

    public function edit_sight_landing($id){
        $get_landing = DB::table('SightLanding')->where('ID',$id)->get();
        return view('landing.edit_sight_landing_page',['get_landing'=>$get_landing]);
    }
    
 
  //end edit attraction landing

  //edit hotel landing
    public function edit_hotel_landing($id){
        $getlanding = DB::table('TPHotel_landing')
        ->Leftjoin('TPHotels','TPHotels.hotelid','=','TPHotel_landing.hotelid')
        ->select('TPHotel_landing.*','TPHotels.name','TPHotels.hotelid')
        ->where('TPHotel_landing.id',$id)->get();
        return view('landing.edit_hotel_landing_page',['getlanding'=>$getlanding]);
    }
  //end edit hotel landing

    public function search_addlanding(){
        return view('landing.search_addlanding');
    }

    public function search_add_landing_page(request $request){
        $val =  $request->get('value');
        $type =  $request->get('type');

        if($type == 'attraction'){
            $getatr = DB::table('Sight')
            ->select('Sight.*')
            ->where(function ($query) use ($val) {
                    $query->where(
                        'Sight.SightId', 'LIKE', '%' . $val . '%')->orWhere(
                            'Sight.Title', 'LIKE', '%' . $val . '%')->orWhere(
                            'Sight.Slug', 'LIKE', '%' . $val . '%');
            })->limit(2)
            ->get();
        }elseif($type == 'hotel'){

            $getatr = DB::table('TPHotels')
            // ->leftJoin('Country', 'Country.CountryId', '=', 'Location.CountryId')
            // ->select('Location.*', 'Country.Name as countryname')
            ->where(function ($query) use ($val) {
                    $query->where(
                        'hotelid', 'LIKE', '%' . $val . '%')->orWhere(
                            'name', 'LIKE', '%' . $val . '%')->orWhere(
                                'slug', 'LIKE', '%' . $val . '%');
            })->limit(2)
            ->get();

        }elseif($type == 'restaurant'){
            $getatr = DB::table('Sight')
            ->select('Sight.*')
            ->where(function ($query) use ($val) {
                    $query->where(
                        'Sight.SightId', 'LIKE', '%' . $val . '%')->orWhere(
                            'Sight.Title', 'LIKE', '%' . $val . '%')->orWhere(
                            'Sight.Slug', 'LIKE', '%' . $val . '%');
            })->limit(2)
            ->get();
        }elseif($type == 'experience'){
            $getatr = DB::table('Experience')
            ->select('Experience.*')
            ->where(function ($query) use ($val) {
                    $query->where(
                        'Experience.ExperienceId', 'LIKE', '%' . $val . '%')->orWhere(
                            'Experience.Name', 'LIKE', '%' . $val . '%')->orWhere(
                            'Experience.Slug', 'LIKE', '%' . $val . '%');
            })->limit(2)
            ->get();
        }
        
            
        return view('landing.filter_add_result_data',['data'=>$getatr,'type'=>$type]);
    }

    public function add_hotel_landing($id){
        $result = DB::table('TPHotel_landing')->where('hotelid',$id)->get();
        return view('landing.add_hotel_landing',['result'=> $result]);
    }
    public function add_exp_landing($id){
        $get_landing = DB::table('Experience_landing')->where('exp_id',$id)->get();
        return view('landing.add_exp_landing',['get_landing'=>$get_landing]);
    }
  
    public function search_language(Request $request)
    {
        $search = $request->get('val');
        $result = array();
    
        $query = DB::table('ExperienceLanguage')
            ->where('ExperienceLanguage.Language', 'LIKE', '%' . $search . '%')
            ->limit(4)
            ->get();
    
        foreach ($query as $cat) {
            $result[] = [
                'id' => $cat->ExperienceLanguageId,
                'value' => $cat->Language,
            ];
        }
    
        return response()->json($result);
    }

    public function store_exp_landing(request $request){
        $name = $request->name;
        $slug = $request->slug;
        $meta_title = $request->meta_title;
        $meta_desc = $request->meta_desc;
        $about = $request->about; 
        $exp_id = $request->exp_id;  
        $nearbytype = $request->nearbytype;
        $nearby = $request->nearby;
   
        $category_value = json_encode($request->category_value);
        $star_rating = json_encode($request->star_rating);
        $duration_value = json_encode($request->duration_value);
       
        $Experience_Tags_val = json_encode($request->Experience_Tags_val);    
        $Mobile_Ticket_value = json_encode($request->Mobile_Ticket_value);
        $Languages_value = json_encode($request->Languages_value);

        $data = array(
            'Page_Name' =>$name,
            'Slug' =>$slug,
            'Meta_Title' =>$meta_title,
            'Meta_Description' =>$meta_desc,
            'About' =>$about,
            'exp_id' =>$exp_id,
            'Near_Type' =>$nearbytype,
            'Nearby' =>$nearby,
            'Category' =>$category_value,
            'Ratings' =>$star_rating,
            'Duration' =>$duration_value,
            'Experience_Tags' =>$Experience_Tags_val,
            'Mobile_Ticket' =>$Mobile_Ticket_value,
            'Languages' =>$Languages_value,
            'status' => 0,


        );
        return  DB::table('Experience_landing')->insert($data);
         
    }

    public function edit_exp_landing($id){
        $result = DB::table('Experience_landing')->where('ID',$id)->get();
        return view('landing.edit_exp_landing',['get_landing'=>$result]);
    }

 

       public function update_exp_landing(request $request){
        $name = $request->name;
        $slug = $request->slug;
        $meta_title = $request->meta_title;
        $meta_desc = $request->meta_desc;
        $about = $request->about; 
        $exp_id = $request->exp_id;  
        $nearbytype = $request->nearbytype;
        $nearby = $request->nearby;
        $id = $request->id;
        $category_value = json_encode($request->category_value);
        $star_rating = json_encode($request->star_rating);
        $duration_value = json_encode($request->duration_value);
       
        $Experience_Tags_val = json_encode($request->Experience_Tags_val);    
        $Mobile_Ticket_value = json_encode($request->Mobile_Ticket_value);
        $Languages_value = json_encode($request->Languages_value);

        $data = array(
            'Page_Name' =>$name,
            'Slug' =>$slug,
            'Meta_Title' =>$meta_title,
            'Meta_Description' =>$meta_desc,
            'About' =>$about,
            'exp_id' =>$exp_id,
            'Near_Type' =>$nearbytype,
            'Nearby' =>$nearby,
            'Category' =>$category_value,
            'Ratings' =>$star_rating,
            'Duration' =>$duration_value,
            'Experience_Tags' =>$Experience_Tags_val,
            'Mobile_Ticket' =>$Mobile_Ticket_value,
            'Languages' =>$Languages_value,
            'status' => 0,
        );
        return  DB::table('Experience_landing')->where('ID',$id)->update($data);
         
    }

    public function hidepage_exp(request $request){
        $landingid =  $request->get('landing');
            $data = array(
                'status' => 0,
            );
        
        return DB::table('Experience_landing')->where('ID',$landingid)->update($data);
    }

    public function delete_landing_exp(request $request){
        $id =  $request->get('landing');
        return  DB::table('Experience_landing')->where('ID',$id)->delete();   
   }

}
