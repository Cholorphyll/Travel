<?php

namespace App\Http\Controllers;
use App\Models\TPHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HotelsController extends Controller
{
    public function index()
    {
        return view('hotels');
    }
    public function filter_hotel(request $request){
        $val =  $request->get('value');
        
            $getlisting = DB::table('TPHotel')
               ->select('id','hotelid','name')
                ->where(function ($query) use ($val) {
                        $query->where(
                            'id', 'LIKE', '%' . $val . '%')->orWhere(
                                'name', 'LIKE', '%' . $val . '%')->orWhere(
                                    'slug', 'LIKE', '%' . $val . '%');
                })->limit(2)
                ->get();
            
            return view('hotels.filter_hotel',['hotellisting'=>$getlisting]);
    }
 public function edit_hotel($id){ 
        $getcountry = DB::table('Country')->get();
        $TPHotel_types = DB::table('TPHotel_types')->get();
     
        $gethotel = DB::table('TPHotel')
        ->Leftjoin('TPLocations', 'TPHotel.location_id', '=', 'TPLocations.id')
        ->select('TPHotel.*', 'TPLocations.countryName','TPLocations.cityName as Lname')
        ->where('TPHotel.id',$id)
        ->get();
        $location_id =$gethotel[0]->location_id;
        $CtName ="";
        if(!empty($gethotel)){
            $CtName = $gethotel[0]->countryName;
        }
        $getHotelCountry = DB::table('Country')->where('Name',$CtName)->get();
        $gettemp = DB::table('Temp_Mapping')->select('Tid')->where('LocationId',$location_id)->get();
        $Tid ="";
        if(!$gettemp->isEmpty()){
            $Tid = $gettemp[0]->Tid;  
        }
        $Neighborhoods = collect();
       
        if($Tid != ""){           
             $Neighborhoods = DB::table('Neighborhood')->where('LocationID',$Tid)->get();
        //  return   print_r($Neighborhoods);
        }else{
            $Neighborhoods = DB::table('Neighborhood')->get();
        }
	 
             
      
       $TPneighborhood = DB::table('TPhotelNbData')->select('display_name')->where('hotelid',$id)->get();
      
        return view('hotels.edit_hotel',['gethotel'=>$gethotel,'country'=>$getcountry,'getHotelCountry'=>$getHotelCountry,'neighborhoodlist'=>$Neighborhoods,'TPneighborhood'=>$TPneighborhood,'TPHotel_types'=>$TPHotel_types]);
    }
    public function searchCity(request $request){
        $search = $request->get('val');

        $result = array();
    
        $query = DB::table('TPLocations')
            ->Leftjoin('Country', 'TPLocations.countryName', '=', 'Country.Name')
            ->select('TPLocations.locationId','TPLocations.cityName as lname','TPLocations.countryName','Country.CountryId')
            ->where('TPLocations.cityName', 'LIKE', '%' . $search . '%')
            ->limit(4)
            ->get();
    
        foreach ($query as $loc) {
            $result[] = [
                'id' => $loc->locationId,
                'value' => $loc->lname,
                'country' => $loc->countryName,
                'countryid' => $loc->CountryId
            ];
        }
    
        return response()->json($result);
    }

    public function updateHotel(request $request,$id){

   
        $request->validate([
            'hotel_name' => 'required',
            'slug' => 'required',            
        ]);   

         $city = $request->get('ctname');
        $county = $request->get('country');
        $ct =  $city.', '. $county;
		$c = 0;
        if( $city  != ""){
			
            $getct = DB::table('TPLocations')->where('fullName',$ct)->get();
			if(!$getct->isEmpty()){
			$c = 1;
			   $cityId = $getct[0]->id;
               $iata = $getct[0]->iata;
			}
          
        }
        
        
        

        $stationNames = $request->input('station_name');
        $times = $request->input('time');
        $durations = $request->input('duration');

        $nearest_station = [];

        // Loop through the input arrays
        for ($i = 0; $i < count($stationNames); $i++) {
            $nearest_station[] = [
                'station_name' => $stationNames[$i],
                'time' => $times[$i],
                'duration' => $durations[$i]
            ];
        }

        $jsonData = json_encode($nearest_station);


        $data = array(
            'name'=>$request->get('hotel_name'),
            'slug'=>$request->get('slug'),
            'metaTagTitle'=>$request->get('MetaTagTitle'),
            'MetaTagDescription'=>$request->get('MetaTagDescription'),
            'address'=>$request->get('addressline1').', '.$request->get('addressline2'),
          
           
            'Pincode'=>$request->get('pincode'),
            'Latitude'=>$request->get('Latitude'),
            'longnitude'=>$request->get('Longitude'), 
            'Website'=>$request->get('website'),
            'Phone'=>$request->get('phone'),
            'Email'=>$request->get('email'),
            'about'=>$request->get('about'),
 			'short_description'=>$request->get('short_description'),

            'stars'=>$request->get('stars'),
            'pricefrom'=>$request->get('pricefrom'),
            'propertyType'=>$request->get('propertyType'),
            'amenities'=>$request->get('amenities'), 
            'shortFacilities'=>$request->get('shortFacilities'),
            'Languages'=>$request->get('Languages'),
            'room_aminities'=>$request->get('room_aminities'),
            'location_score'=>$request->get('location_score'),


            'NearestStations'=> $jsonData,
           
            'dt_created'=>now(),
          
        );
        if ($c == 1){
            $data['location_id'] = $cityId;
            $data['cityId'] = $cityId;
            $data['iata'] = $iata;
            
     }
        DB::table('TPHotel')->where('id',$id)->update($data);
     //   return $request->get('neighborhood');
        if($request->get('neighborhood') != ""){
          //  return $id;
            $nid = $request->get('neighborhood');
            $getnb =  DB::table('Neighborhood')->where('NeighborhoodId',$nid)->get();
            $Name = $getnb[0]->Name;
            $NeighborhoodId = $getnb[0]->NeighborhoodId;
            $LocationID = $getnb[0]->LocationID;

          

            $neighborhood = array(
                'neibourhood_id' => $NeighborhoodId,
                'display_name' => $Name,             
                'hotelid'=>$id,  
                'location_id'=>$LocationID, 
             
            );
            $check_neibour =  DB::table('TPhotelNbData')->where('hotelid',$id)->get();


            if(!$check_neibour->isEmpty()){
                DB::table('TPhotelNbData')->where('hotelid',$id)->update($neighborhood);        
            }else{
                DB::table('TPhotelNbData')->insert($neighborhood);          
            }
        }else{
            $check_neibour =  DB::table('TPhotelNbData')->where('hotelid',$id)->get();


            if(!$check_neibour->isEmpty()){
                DB::table('TPhotelNbData')->where('hotelid', $id)->delete();   
            } 
        }
       

     

        return redirect()->route('hotels')
        ->with('success','Hotel Updated successfully.'); 


    
    }


  	public function add_hotel(){
        $TPHotel_types = DB::table('TPHotel_types')->get();
        $Neighborhoods = DB::table('Neighborhood')->get();

      
        return view('hotels.add_hotel',['neighborhoodlist'=>$Neighborhoods,'TPHotel_types'=>$TPHotel_types]);
     }

  public function storeHotel(request $request){
      
        // $getlastid = DB::table('TPHotel')->orderby('hotelid','desc');
        // $lasthotelid = $getlastid->hotelid;
        $request->validate([
            'hotel_name' => 'required',
            'slug' => 'required',
        ]); 
        
        $city = $request->get('ctname');
        $getct = DB::table('TPLocations')->where('cityName',$city)->get();
        $cityId = $getct[0]->locationId;
        $iata = $getct[0]->iata;

        $stationNames = $request->input('station_name');
        $times = $request->input('time');
        $durations = $request->input('duration');
   
        $nearest_station = [];
   
        // Loop through the input arrays
        for ($i = 0; $i < count($stationNames); $i++) {
           $nearest_station[] = [
               'station_name' => $stationNames[$i],
               'time' => $times[$i],
               'duration' => $durations[$i]
           ];
        }
   
   $jsonData = json_encode($nearest_station);
   
   
       $data = array(
           'hotelid'=>'00',
           'name'=>$request->get('hotel_name'),
           'slug'=>$request->get('slug'),
           'metaTagTitle'=>$request->get('MetaTagTitle'),
           'MetaTagDescription'=>$request->get('MetaTagDescription'),
           'address'=>$request->get('addressline1').', '.$request->get('addressline2'),
           'location_id'=>$cityId,
           'cityId'=>$cityId,
           'Pincode'=>$request->get('pincode'),
           'Latitude'=>$request->get('Latitude'),
           'longnitude'=>$request->get('Longitude'), 
           'Website'=>$request->get('website'),
           'Phone'=>$request->get('phone'),
           'Email'=>$request->get('email'),
           'about'=>$request->get('about'),
		   'short_description'=>$request->get('short_description'),
           'iata'=>$iata,
           'NearestStations'=> $jsonData,
           'dt_created'=>now(),
        //    'hotelid'=>$lasthotelid + 1,
       );  
      
       $hotelId = DB::table('TPHotel')->insertGetId($data);
       
       

       if($request->get('neighborhood') != ""){
        //  return $id;
          $nid = $request->get('neighborhood');
          $getnb =  DB::table('Neighborhood')->where('NeighborhoodId',$nid)->get();
          $Name = $getnb[0]->Name;
          $NeighborhoodId = $getnb[0]->NeighborhoodId;
          $LocationID = $getnb[0]->LocationID;

        

          $neighborhood = array(
              'neibourhood_id' => $NeighborhoodId,
              'display_name' => $Name,             
              'hotelid'=>$hotelId,  
              'location_id'=>$LocationID, 
           
          );

          DB::table('TPhotelNbData')->insert($neighborhood); 

          
      }

   

       return redirect()->route('hotels')
       ->with('success','Hotel Added successfully.'); 
       }

    // manage reviews 

    public function edit_review($id){
        $gethid = DB::table('TPHotel')->where('hotelid',$id)->get();
      //  $hotel_id = $gethid[0]->hotelid;
        $getreviews =  DB::table('HotelReview')->where('HotelId',$id)->where('IsApprove',0)->get();
        
        return view('hotels.edit_hotel_reviews',['hotelreview'=>$getreviews,'gethid'=>$gethid]);
    }

    public function sortHotelReview(request $request){
        if($request->get('val') != ""){
            $orderby = $request->get('val');
        }else{
            $orderby = "desc";
        }
        $id = $request->get('id');

        $gethid = DB::table('TPHotel')->where('HotelId',$id)->get();

        if(!empty($request->get('filter_option'))){
            //filter with options like aprove
            
            $filter_option = $request->get('filter_option');
            $getreviews =  DB::table('HotelReview')->where('HotelId',$id)->where('IsApprove',$filter_option)->orderby('HotelReviewId',$orderby)->get();
        }else{
          $filter_option = 0;
            $getreviews =  DB::table('HotelReview')->where('HotelId',$id)->orderby('HotelReviewId',$orderby)->where('IsApprove',$filter_option)->get();
        }
     
       // $hotel_id = $gethid[0]->hotelid;
    
        
        return view('hotels.sortHotelReview',['hotelreview'=>$getreviews,'gethid'=>$gethid,'val'=>$filter_option]);
    }
   
    public function filterhotelbyid(request $request){ 
        
        $val = $request->get('val');
        $getreviews =  DB::table('HotelReview')->where(function($query) use ($val) {
            if (strlen($val) <= 1) {
                $query->where('HotelReviewId', 'LIKE', '%' . $val . '%');
            } else {
                $query->where('HotelReviewId', $val);
            }
        })
        ->limit(3)->get();
         return view('hotels.sortHotelReview',['hotelreview'=>$getreviews]);  
        
    }  
    public function ftrhotelrewview(request $request){
        $val1 = $request->get('val');
        $id = $request->get('id');

        if (strpos($val1, ',') !== false) {
            $explodedValues = explode(',', $val1);
             $val1 =  $explodedValues[0];
             $val2 =  $explodedValues[1];
             $val3 =  $explodedValues[2];
             $getreviews =  DB::table('HotelReview')->where('HotelId',$id)->where('IsApprove',$val1)->orWhere('IsApprove',$val2)->orWhere('IsApprove',$val3)->get();
        } else {
            $getreviews =  DB::table('HotelReview')->where('HotelId',$id)->where('IsApprove',$val1)->get();
        }
       
        
        return view('hotels.sortHotelReview',['hotelreview'=>$getreviews,'val'=>$val1]);  
    }

      public function update_hotelreview(request $request){
      $id = $request->get('id');
      
      $hotelid = $request->get('hotelid');
      DB::table('HotelReview')->where('HotelReviewId',$id)->update(['IsApprove'=>$request->get('value')]);
       
       $filter_option = $request->get('value');
       $gethid = DB::table('TPHotel')->where('HotelId',$hotelid)->get();
       $getreviews =  DB::table('HotelReview')->where('HotelId',$hotelid)->where('IsApprove',$filter_option)->get();
       
       return view('hotels.sortHotelReview',['hotelreview'=>$getreviews,'gethid'=>$gethid,'val'=>$filter_option]);
    }

    // edit hotle Faq

    public function edit_hotel_faqs($id){
        $hotelfaq = DB::table('HotelQuestion')
        ->Leftjoin('TPHotel','HotelQuestion.HotelId', '=' ,'TPHotel.hotelid')
        ->select('HotelQuestion.*','TPHotel.name')
        ->where('HotelQuestion.HotelId',$id)->get();
        return view('hotels.edit_hotel_faqs',['getfaq'=>$hotelfaq]);
    }

    public function update_hotel_faq(request $request){

        $id =  $request->get('faqId');
       // $currentDate = Carbon::today()->toDateString();
        $data = array(
            'Question' => $request->get('question'),
            'Answer' => $request->get('answer'),
            'IsActive' => 1,
            'CreatedDate' => now(),
        );
        
        return  DB::table('HotelQuestion')->where('hotelQuestionId',$id)->update($data);

    }

    public function add_hotel_faq(request $request){
       $question = $request->get('checkboxText');
       $hotelid = $request->get('hotelid');
       $data = array(
            'Question'=>$question,
            'HotelId'=>$hotelid,
            'IsActive' => 1,
            'CreatedDate' => now(),
       );
       DB::table('HotelQuestion')->insert($data);

       $hotelfaq = DB::table('HotelQuestion')
       ->Leftjoin('TPHotel','HotelQuestion.HotelId', '=' ,'TPHotel.hotelid')
       ->select('HotelQuestion.*','TPHotel.name')
       ->where('HotelQuestion.HotelId',$hotelid)->get();
      return view('hotels.updated_faq',['getfaq'=>$hotelfaq]);
    }

    /*-------------Hotel Category--------------*/

    public function edit_hotel_category($id){
    
        $categoryIds = DB::table('TPHotel')
        ->where('hotelid', $id)
        ->pluck('CategoryId')
        ->toArray();
        $hname = DB::table('TPHotel')
        ->where('hotelid', $id)->get();
       
        
        $hotel_categories = [];
        
        foreach ($categoryIds as $categoryId) {
            $categoryTypes = DB::table('TPHotel_types')
                ->whereIn('id', explode(',', $categoryId))->get();
              
        
            // foreach ($categoryTypes as $type) {
            //     $hotel_categories[] = ['id' => $type->id, 'name' => $type->type];
            // }
        }
        
     
    
        return view('hotels.edit_hotel_category',['hotel_category'=>$categoryTypes,'hname'=>$hname]);
    }

     public function updateHotelCategory(request $request){
        $categoryid =  $request->get('id');
        $hotelid =  $request->get('hotelid');      
        $getcat = DB::table('TPHotel')->where('hotelid',$hotelid)->get();

        $checkcat = $getcat[0]->CategoryId;

        $query = DB::table('TPHotel')
        ->where('hotelid', $hotelid)
        ->whereRaw("FIND_IN_SET($categoryid, TRIM(BOTH ',' FROM CategoryId))")
        ->update([    
            'CategoryId' => DB::raw("REPLACE(CategoryId, ',$categoryid', '')")
        ]);

           
           $categoryIds = DB::table('TPHotel')
           ->where('hotelid', $hotelid)
           ->pluck('CategoryId')
           ->toArray();
           $hname = DB::table('TPHotel')
           ->where('hotelid', $hotelid)->get();
          
           
           $hotel_categories = [];
           
           foreach ($categoryIds as $categoryId) {
               $categoryTypes = DB::table('TPHotel_types')
                   ->whereIn('id', explode(',', $categoryId))->get();
                 
           
               // foreach ($categoryTypes as $type) {
               //     $hotel_categories[] = ['id' => $type->id, 'name' => $type->type];
               // }
           }
           
        
       
           return view('hotels.filterCategory',['hotel_category'=>$categoryTypes,'hname'=>$hname]);
    }

    public function search_category(Request $request)
    {
      
        $search = $request->get('val');

        $result = array();
    
        $query = DB::table('TPHotel_types')
            ->where('TPHotel_types.type', 'LIKE', '%' . $search . '%')
            ->limit(4)
            ->get();
    
        foreach ($query as $cat) {
            $result[] = [
                'id' => $cat->id,
                'value' => $cat->type,
            ];
        }
    
        return response()->json($result);
    }

	public function addhotelcat(Request $request)
	{
		$cat_type = $request->input('value');

		$getcat = DB::table('TPHotel_types')
			->where('type', $cat_type)   
			->get();
	  //return print_r($getcat);
		$CategoryId = "";
		if (!$getcat->isEmpty()) {
			$CategoryId = $getcat[0]->id;
		}else{
			return 'false';
		}

		$hotelId = $request->input('id');

		$hotel = DB::table('TPHotel')->where('hotelid', $hotelId)->first();

		if ($hotel) {
			$existingCategoryIds = explode(',', $hotel->CategoryId);

			// Check if the category ID already exists in the CategoryId column
			if (!in_array($CategoryId, $existingCategoryIds)) {
				// Append the new category ID to the existing IDs
				$newCategoryIds = implode(',', array_merge($existingCategoryIds, [$CategoryId]));

				// Update the CategoryId column with the new value
				DB::table('TPHotel')
					->where('hotelid', $hotelId)
					->update(['CategoryId' => $newCategoryIds]);
			}else{
				return 2;
			}
		}


		$categoryIds = DB::table('TPHotel')
			->where('hotelid', $hotelId)
			->pluck('CategoryId')
			->toArray();

		$hname = DB::table('TPHotel')
			->where('hotelid', $hotelId)
			->get();

		$categoryTypes = [];

		foreach ($categoryIds as $categoryId) {
			$types = DB::table('TPHotel_types')
				->whereIn('id', explode(',', $categoryId))
				->get();

			//$categoryTypes = array_merge($categoryTypes, $types);
		}
		  //  return print_r($hotel);
		return view('hotels.filterCategory', ['hotel_category' => $types, 'hname' => $hname]);
	}

    //edit landing page
    public function edit_hotel_landing($id){
       $getlanding = DB::table('TPHotel_landing')
       ->Leftjoin('TPHotel','TPHotel.hotelid','=','TPHotel_landing.hotelid')
       ->select('TPHotel_landing.*','TPHotel.name','TPHotel.hotelid')
       ->where('TPHotel_landing.hotelid',$id)->get();
       return view('hotels.edit_hotel_landing',['getlanding'=>$getlanding]);
    }

    public function updateLanding(request $request){
        
        $landingid =  $request->get('landing');
        $value =  $request->get('value');
        $colid =  $request->get('colid');
        if($colid ==1){
            $data = array(
                'Name' => $request->get('value'),
            );
        }elseif($colid==2){
            $data = array(
                'Slug' => $request->get('value'),
            );
        }elseif($colid==3){
            $data = array(
                'MetaTagTitle' => $request->get('value'),
            );
        }elseif($colid==4){
            $data = array(
                'MetaTagDescription' => $request->get('value'),
            );
        }elseif($colid==5){
            $data = array(
                'About' => $request->get('value'),
            );
        }
       
        
        return  DB::table('TPHotel_landing')->where('id',$landingid)->update($data);

    }
    public function hidepage(){
        $landingid =  $request->get('landing');
            $data = array(
                'status' => 0,
            );
        
        return DB::table('TPHotel_landing')->where('id',$landingid)->update($data);
    }

    public function delete_landing(){
     $landingid =  $request->get('landing');
      return  DB::table('table_name')->where('id',$landing)->delete();

    }

    public function add_landing_page(){
        return view('hotels.add_landing_page');
    }

    public function search_hotel(Request $request)
    {
      
        $val = $request->get('val');

        $result = array();
    
        $query = DB::table('TPHotel')
        ->where(function ($query) use ($val) {
            $query->where(
                'hotelid', 'LIKE', '%' . $val . '%')->orWhere(
                    'name', 'LIKE', '%' . $val . '%')->orWhere(
                        'slug', 'LIKE', '%' . $val . '%');
    })
            ->limit(4)
            ->get();
    
        foreach ($query as $cat) {
            $result[] = [
                'id' => $cat->hotelid,
                'value' => $cat->name,
            ];
        }
    
        return response()->json($result);
    }
    public function search_restaurent(Request $request)
    {
      
        $val = $request->get('val');

        $result = array();
    
        $query = DB::table('Restaurant')
        ->where(function ($query) use ($val) {
            $query->where(
                'RestaurantId', 'LIKE', '%' . $val . '%')->orWhere(
                    'Title', 'LIKE', '%' . $val . '%');
        })
            ->limit(4)
            ->get();
    
        foreach ($query as $cat) {
            $result[] = [
                'id' => $cat->RestaurantId,
                'value' => $cat->Title,
            ];
        }
    
        return response()->json($result);
    }
    public function search_neighborhood(Request $request)
    {
      
        $val = $request->get('val');

        $result = array();
    
        $query = DB::table('Neighborhood')
        ->where(function ($query) use ($val) {
            $query->where(
                'NeighborhoodId', 'LIKE', '%' . $val . '%')->orWhere(
                    'Name', 'LIKE', '%' . $val . '%');
        })
            ->limit(4)
            ->get();
    
        foreach ($query as $cat) {
            $result[] = [
                'id' => $cat->NeighborhoodId,
                'value' => $cat->Name,
            ];
        }
    
        return response()->json($result);
    }

    public function search_hotel_amenti(Request $request){
        $val = $request->get('val');
        $hotelAmenities = [
            'Private Parking', 'Free Parking', 'Invoice provided', 'Luggage storage', 'Express check-in/check-out',
            '24-hour front desk', 'Board games/puzzles', 'Daily housekeeping', 'Ironing service', 'Dry cleaning',
            'Laundry', 'Meeting/banquet facilities', 'Fire extinguishers', 'CCTV outside property', 'CCTV in common areas',
            'Smoke alarms', 'Security alarm', 'Key card access', 'Key access', '24-hour security', 'Safety deposit box',
            'Free Wifi', 'Fitness', 'Fitness centre', 'Carbon monoxide detector', 'Shared lounge/TV area',
            'Air conditioning', 'Non-smoking throughout', 'Allergy-free room', 'Heating', 'Soundproofing',
            'Laptop safe', 'Soundproof rooms', 'Lift', 'Family rooms', 'Facilities for disabled guests',
            'Non-smoking rooms', 'Iron',
        ];
    
        $searchTerm = strtolower($val);
    
        $matchingAmenities = [];
        $count = 0;
        foreach ($hotelAmenities as $amenity) {
            // Convert the amenity to lowercase for case-insensitive comparison
            $amenityLowercase = strtolower($amenity);
    
            // Check if the search term is found in the amenity (case-insensitive search)
            if (strpos($amenityLowercase, $searchTerm) !== false) {
                $matchingAmenities[] = ['value' => $amenity];
                $count++;
    
                if ($count >= 4) {
                    break; // Limit the result to 4, break out of the loop
                }
            }
        }
    
        return response()->json($matchingAmenities);
    }

    
    public function get_Room_type(Request $request){
        $val = $request->get('val');
        $hotelAmenities = [
            'Non-Smoking Rooms', 'test', 
        ];
    
        $searchTerm = strtolower($val);
    
        $matchingAmenities = [];
        $count = 0;
        foreach ($hotelAmenities as $amenity) {
            // Convert the amenity to lowercase for case-insensitive comparison
            $amenityLowercase = strtolower($amenity);
    
            // Check if the search term is found in the amenity (case-insensitive search)
            if (strpos($amenityLowercase, $searchTerm) !== false) {
                $matchingAmenities[] = ['value' => $amenity];
                $count++;
    
                if ($count >= 4) {
                    break; // Limit the result to 4, break out of the loop
                }
            }
        }
    
        return response()->json($matchingAmenities);
    }
    public function get_hotel_type(Request $request){
        $val = $request->get('val');
        $hoteltype = [
            'hotel-type 1', 'hotel type 2','test type 3' 
        ];    
        $searchTerm = strtolower($val);
    
        $matchingAmenities = [];
        $count = 0;
        foreach ($hoteltype as $amenity) {
           
            $amenityLowercase = strtolower($amenity);
    
         
            if (strpos($amenityLowercase, $searchTerm) !== false) {
                $matchingAmenities[] = ['value' => $amenity];
                $count++;
    
                if ($count >= 4) {
                    break; 
                }
            }
        }
    
        return response()->json($matchingAmenities);
    } 

    public function get_onsight_restaurant(Request $request){
        $val = $request->get('val');
        $hoteltype = [
            'restaurant value 1', 'restaurant value 2','test value 3' 
        ];    
        $searchTerm = strtolower($val);
    
        $matchingAmenities = [];
        $count = 0;
        foreach ($hoteltype as $amenity) {
           
            $amenityLowercase = strtolower($amenity);
    
         
            if (strpos($amenityLowercase, $searchTerm) !== false) {
                $matchingAmenities[] = ['value' => $amenity];
                $count++;
    
                if ($count >= 4) {
                    break; 
                }
            }
        }
    
        return response()->json($matchingAmenities);
    } 
    public function get_hotel_tags(Request $request){
        $val = $request->get('val');
        $hoteltype = [
            'hotel tag 1', 'hotel tag 2','hotel tag 3' 
        ];    
        $searchTerm = strtolower($val);
    
        $matchingAmenities = [];
        $count = 0;
        foreach ($hoteltype as $amenity) {
           
            $amenityLowercase = strtolower($amenity);
    
         
            if (strpos($amenityLowercase, $searchTerm) !== false) {
                $matchingAmenities[] = ['value' => $amenity];
                $count++;
    
                if ($count >= 4) {
                    break; 
                }
            }
        }
    
        return response()->json($matchingAmenities);
    } 
    public function get_public_transit(Request $request){
        $val = $request->get('val');
        $hoteltype = [
            'public transit 1', 'public transit 2','text transit 3' 
        ];    
        $searchTerm = strtolower($val);
    
        $matchingAmenities = [];
        $count = 0;
        foreach ($hoteltype as $amenity) {
           
            $amenityLowercase = strtolower($amenity);
    
         
            if (strpos($amenityLowercase, $searchTerm) !== false) {
                $matchingAmenities[] = ['value' => $amenity];
                $count++;
    
                if ($count >= 4) {
                    break; 
                }
            }
        }
    
        return response()->json($matchingAmenities);
    } 
    public function get_access(Request $request){
        $val = $request->get('val');
        $hoteltype = [
            'access 1', 'access 2','text transit 3' 
        ];    
        $searchTerm = strtolower($val);
    
        $matchingAmenities = [];
        $count = 0;
        foreach ($hoteltype as $amenity) {
           
            $amenityLowercase = strtolower($amenity);
    
         
            if (strpos($amenityLowercase, $searchTerm) !== false) {
                $matchingAmenities[] = ['value' => $amenity];
                $count++;
    
                if ($count >= 4) {
                    break; 
                }
            }
        }
    
        return response()->json($matchingAmenities);
    } 
	
/*	
public function spotlightSection()
{
    // Fetch hotels where spotlight is enabled or not null (depending on your logic)
    $spotlightHotels = DB::table('TPHotel')
            ->whereNotNull('Spotlights') // Ensure Spotlights column is not null
        ->where('Spotlights', '!=', '') // Ensure Spotlights column is not an empty string
        ->select('id', 'name', 'Spotlights', 'feature1', 'feature2', 'feature3') // Select relevant columns
        ->get(); // Fetch the results
	
    // Pass the data to the view
    return view('hotels.spotlight', ['spotlightHotels' => $spotlightHotels]);
}
*/



    public function store_landing(request $request){
 
        $name = $request->name;
        $slug = $request->slug;
        $meta_title = $request->meta_title;
        $meta_desc = $request->meta_desc;
        $about = $request->about; 
        $hotelId = $request->hotelId;  
        $nearbytype = $request->nearbytype;
        $nearby = $request->nearby;

        // $nearbyid = "";

        // if($nearby != ""){
            
        //     if($nearbytype == 'Attraction'){
        //         $sight =  DB::table('Sight')->where('Title',$nearby)->get();
        //         $nearbyid = $sight[0]->SightId;
        //     }elseif($nearbytype == 'Hotel'){
        //         $hotel =  DB::table('TPHotel')->where('name',$nearby)->get();
        //         $nearbyid = $hotel[0]->id;
        //     }elseif($nearbytype == 'Restaurent'){
        //         $Restaurant =  DB::table('Restaurant')->where('Title',$nearby)->get();
        //         $nearbyid = $Restaurant[0]->RestaurantId;
        //     }elseif($nearbytype == 'Neighborhood'){
        //         $Neighborhood =  DB::table('Neighborhood')->where('Name',$nearby)->get();
        //         $nearbyid = $Neighborhood[0]->NeighborhoodId;
        //     }

        // }



        
        $roommntArray = json_encode($request->roommntArray);
        $ratingarray = json_encode($request->ratingarray);
        $hotelmntarray = json_encode($request->hotelmntarray);
        $HotelPricing_array = json_encode($request->HotelPricing_array);

        $room_type_array = json_encode($request->room_type_array);
        $distance_array = json_encode($request->distance_array);
        $hotelstyle_array = json_encode($request->hotelstyle_array);
        $onsiterestaurants_array = json_encode($request->onsiterestaurants_array);

        $Hotel_Tags_array = json_encode($request->Hotel_Tags_array);
        $Public_Transit_array = json_encode($request->Public_Transit_array);
        $Access_value_array = json_encode($request->Access_value_array);


       $data = array(
        'Name' => $name,
        'Slug' => $slug,
        'hotel_tags' => $Hotel_Tags_array,
        'RoomFeatures' => $name,
        'RoomType' => $room_type_array,
        'MetaTagTitle' => $meta_title,
        'MetaTagDescription' => $meta_desc,
        'About' => $about,
        'HotelAmenities' => $hotelmntarray,
        'Rating' => $ratingarray,  
        'Room_Amenities' => $roommntArray,
        'Hotel_Pricing' => $HotelPricing_array,
        'Distance' => $distance_array,
        'Hotel_Style' => $hotelstyle_array,
        'OnSiteRestaurants' => $onsiterestaurants_array,
        'PublicTransitAccess' => $Public_Transit_array,
        'hotelid'=> $hotelId,
        'Nearby_Type'=>$nearbytype,
        'NearbyId'=>$nearby,
        'Access'=>$Access_value_array,

       );
 
       return DB::table('TPHotel_landing')->insert($data);
    }

  public function update_landingfilter(request $request){
 
        $hotelId = $request->hotelId;  
        $id = $request->id; 
        $nearbytype = $request->nearbytype;
        $nearby = $request->nearby;

        // $nearbyid = "";

        // if($nearby != ""){
            
        //     if($nearbytype == 'Attraction'){
        //         $sight =  DB::table('Sight')->where('Title',$nearby)->get();
        //         $nearbyid = $sight[0]->SightId;
        //     }elseif($nearbytype == 'Hotel'){
        //         $hotel =  DB::table('TPHotel')->where('name',$nearby)->get();
        //         $nearbyid = $hotel[0]->id;
        //     }elseif($nearbytype == 'Restaurent'){
        //         $Restaurant =  DB::table('Restaurant')->where('Title',$nearby)->get();
        //         $nearbyid = $Restaurant[0]->RestaurantId;
        //     }elseif($nearbytype == 'Neighborhood'){
        //         $Neighborhood =  DB::table('Neighborhood')->where('Name',$nearby)->get();
        //         $nearbyid = $Neighborhood[0]->NeighborhoodId;
        //     }

        // }

        $ratingArray = $request->ratingarray;

        if(!empty($ratingArray)){
             // Using str_replace to remove " Star" from each element in the array
            $ratingArray = array_map(function ($rating) {
                return str_replace(' Star', '', $rating);
            }, $ratingArray);

            // Now $ratingArray doesn't contain the word "Star"
        }
       

      
        $roommntArray = json_encode($request->roommntArray);
        $ratingarray = json_encode($ratingArray);
        $hotelmntarray = json_encode($request->hotelmntarray);
        $HotelPricing_array = json_encode($request->HotelPricing_array);

        $room_type_array = json_encode($request->room_type_array);
        $distance_array = json_encode($request->distance_array);
        $hotelstyle_array = json_encode($request->hotelstyle_array);
        $onsiterestaurants_array = json_encode($request->onsiterestaurants_array);

        $Hotel_Tags_array = json_encode($request->Hotel_Tags_array);
        $Public_Transit_array = json_encode($request->Public_Transit_array);
        $Access_value_array = json_encode($request->Access_value_array);
        $amenities_array = json_encode($request->amenities_array);

       $data = array(
        
        'hotel_tags' => $Hotel_Tags_array,
        'RoomType' => $room_type_array,      
        'HotelAmenities' => $hotelmntarray,
        'Rating' => $ratingarray,  
        'Room_Amenities' => $roommntArray,
        'Hotel_Pricing' => $HotelPricing_array,
        'Distance' => $distance_array,
        'Hotel_Style' => $hotelstyle_array,
        'OnSiteRestaurants' => $onsiterestaurants_array,
        'PublicTransitAccess' => $Public_Transit_array,
        'hotelid'=> $hotelId,
        'Nearby_Type'=>$nearbytype,
        'NearbyId'=>$nearby,
        'Access'=>$Access_value_array,
        'Amenities'=>$amenities_array,

       );
 
       return DB::table('TPHotel_landing')->where('id',$id)->update($data);
    }
	
	// FUNCTION FOR SPOTLIGHT
	
	public function spotlightSection()
{
    // Fetch hotels where spotlight is enabled or not null (depending on your logic)
    $spotlightHotels = DB::table('TPHotel')
            ->whereNotNull('Spotlights') // Ensure Spotlights column is not null
        ->where('Spotlights', '!=', '') // Ensure Spotlights column is not an empty string
        ->select('id', 'name', 'Spotlights', 'feature1', 'feature2', 'feature3') // Select relevant columns
        ->get(); // Fetch the results
    
    // Pass the data to the view
    return view('hotels.spotlight', ['spotlightHotels' => $spotlightHotels]);
}

	//FUNCTION FOR THINGS TO KNOW
public function showHotelDetails($hotelId) {
    // Fetch hotel details including Things to Know from the TPHotel table
    $hotel = TPHotel::where('hotelid', $hotelid)->first();
    
    // Assume 'things_to_know' is a field in TPHotel table containing the data
    $ThingstoKnow = $hotel ? explode(',', $hotel->ThingstoKnow) : [];

    return view('hotel-details', [
        'hotel' => $hotel,
        'ThingstoKnow' => $ThingstoKnow,
    ]);
}

	 public function addHotledetailFaq(request $request){
            $bhv = 0;
            $expervar = 0;
            $cheapestHOt =0;
                $hotelid = $request->get('hotelid');
                $Latitude = $request->get('Latitude');
                $longnitude = $request->get('longnitude');
                // $getloc = DB::table('TPLocations')->select('cityName')
                // ->where('id',$locationid)
                // ->get();
    
             //   if(!$getloc->isEmpty()){
                  //  $lname = $getloc[0]->cityName;  
    
                    //quest 1
                    $att_bestH = DB::table('HotelQuestion')
                    ->where('HotelId', $hotelid)
                    ->where('Question', 'What Attractions are nearby?')
                    ->get();
                
                    if ($att_bestH->isEmpty()) {
                        $bhv = 1;               
                     
                        $searchradius = 50; 
                        $nearby_sight = DB::table("Sight")
                        ->select('SightId', 'Title', 'LocationId', 'Slug',
                            DB::raw("6371 * acos(cos(radians(" . $Latitude . "))
                                * cos(radians(Sight.Latitude))
                                * cos(radians(Sight.Longitude) - radians(" . $longnitude . "))
                                + sin(radians(" . $Latitude . "))
                                * sin(radians(Sight.Latitude))) AS distance"))
                        ->groupBy("Sight.SightId")
                        ->having('distance', '<=', $searchradius)                      
                        ->orderBy('distance')
                        ->limit(5)
                        ->where('IsMustSee', 1)
                        ->get();


                     // return  print_r($nearby_sight);
                    
                        $best_hotel = [];
                        if (!$nearby_sight->isEmpty()) {
                            foreach ($nearby_sight as $bh) {
                                $best_hotel[] = [
                                    'name' => $bh->Title,
                                    'url' =>  $bh->LocationId.'-'.$bh->SightId.'-'.$bh->Slug                                 
                                    
                                ];
                            }
                        }
                        if(!empty($best_hotel)){
                            $bestharray = array(
                                'HotelId'=>$hotelid,
                                'Question'=>'What Attractions are nearby?',
                                'Answer' =>  'There are several exciting attractions near the hotel that cater to a variety of interests.',
                                'Listing'=>json_encode($best_hotel),
                                'CreatedDate' => now(),
                                'IsActive'=>1,
                            );
                           DB::table('HotelQuestion')->insert($bestharray);
                        }
                    }
    
                //quest 1 end
    
           
    
    
               
                if($bhv = 1 && $expervar = 1 &&  $cheapestHOt = 1){
                         
                    $faq =  DB::table('HotelQuestion')->where('HotelId',$hotelid)->get();
                    $html3 = view('frontend.hotel.hotel_detail_faq',['faq'=>$faq])->render();
                 
           
                    return response()->json([ 'html' => $html3]);
                }
    
    
                //end
    
           //    }
             
        }
	
	
	  //landing amenities 
    public function amenties(Request $request){ 
        $val = $request->get('val');
        $hotelAmenities = [
            'TV',
                        'Business center',
                        'Shower',
                        'Non-smoking rooms',
                        'Restaurant',
                        'Separate shower and tub',
                        'Air conditioning',
                        'Shops',
                        'Laundry service',
                        'Bar',
                        'Sauna',
                        'Mini bar',
                        'Meeting facilities',
                        'Elevator',
                        'Bathroom',
                        '24hr room service',
                        'Internet Access',
                        'Room Service',
                        'Bathtub',
                        'Pets allowed',
                        'Disabled facilities',
                        'Balcony/terrace',
                        'Garden',
                        'Outdoor pool',
                        'Swimming Pool',
                        'Gym / Fitness Centre',
                        'Conference Facilities',
                        'Massage',
                        'Hotel/airport transfer',
                        'Kitchenette',
                        'Free parking',
                        'Car parking',
                        'Jacuzzi',
                        'Wheelchair accessible',
                        'Microwave',
                        'Inhouse movies',
                        'Babysitting',
                        'Banquet Facilities',
                        'Spa',
                        'Refrigerator',
                        'Crib available',
                        'Indoor pool',
                        'Golf course (on-site)',
                        'Tennis courts',
                        'Water sports (non-motorized)',
                        'Playground',
                        'Wi-Fi Available',
                        'Heated pool',
                        'Kids pool',
                        'Launderette',
                        'Washing machine',
                        'Table tennis',
                        'Casino',
                        'Steam Room',
                        'Rent a car in the hotel',
                        'Barbecue Area',
                        'Games Room',
                        'Video/DVD Player',
                        'Billiards',
                        'Private beach',
                        'Squash courts',
                        'Nightclub',
                        'LGBT friendly',
                        'Valet service',
                        'Horse Riding',
                        'Mini Golf',
                        'Bowling',
                        'Gift Shop',
                        'Eco Friendly',
                        'Wheelchair access',
                        'Security Guard',
                        'Children care/activities',
                        'In-house movie',
                        'Handicapped Room',
                        'Water Sports',
                        'Wi-Fi in public areas',
                        'Smoking room',
                        'Connecting rooms',
                        'English',
                        'French',
                        'Deutsch',
                        'Spanish',
                        'Arabic',
                        'Italian',
                        'Chinese',
                        'Russian',
                        'Deposit',
                        'Private Bathroom',
                        'Adults only',
        ];
    
        $searchTerm = strtolower($val);
    
        $matchingAmenities = [];
        $count = 0;
        foreach ($hotelAmenities as $amenity) {
            // Convert the amenity to lowercase for case-insensitive comparison
            $amenityLowercase = strtolower($amenity);
    
            // Check if the search term is found in the amenity (case-insensitive search)
            if (strpos($amenityLowercase, $searchTerm) !== false) {
                $matchingAmenities[] = ['value' => $amenity];
                $count++;
    
                if ($count >= 4) {
                    break; // Limit the result to 4, break out of the loop
                }
            }
        }
    
        return response()->json($matchingAmenities);
    }
	 
}