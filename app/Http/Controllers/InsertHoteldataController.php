<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class InsertHoteldataController extends Controller
{

    
    public function inserthoteldetail(){
   
        $timeout = PHP_INT_MAX; 
    
        $TRAVEL_PAYOUT_TOKEN = "27bde6e1d4b86710997b1fd75be0d869"; 
        $TRAVEL_PAYOUT_MARKER = "299178"; 
       //start amenities
        $getamenties = "http://engine.hotellook.com/api/v2/static/amenities/en.json?token=".$TRAVEL_PAYOUT_TOKEN;
        $allmnt = Http::withoutVerifying()->timeout($timeout)->get($getamenties);
      //  $mnt = json_decode($allmnt);

        //end amenities
        
        $batchSize = 5; 
        $delaySeconds = 100;
        $delayafterloop = 60;
        $offset = 0;
        do {
         
            $data = DB::table('Hotellook_new_hotels')
                ->select('location_id')     
                ->where('updated',null) 
                ->orderBy('location_id', 'asc')                 
                ->distinct()
                ->limit($batchSize)            
                ->get();
            
            if ($data->isEmpty()) {               
                dd('empty data');
                break;                
            }
    
           
           $englishNames = [];
    
       
            if(empty($data)){
              dd('data is empty');
            }
    
            foreach ($data as $cont) {
             $cid = $cont->location_id;      
        
                 $getval = "http://engine.hotellook.com/api/v2/static/hotels.json?locationId=$cid&token=".$TRAVEL_PAYOUT_TOKEN;
                  $gethot = Http::withoutVerifying()->timeout($timeout)->get($getval);
                 
                      $dt2 = json_decode($gethot);              
             
                   if (is_object($dt2) && property_exists($dt2, 'hotels')) {
                      $hotels = $dt2->hotels;
                        $j =1; $b =1;	   
                    foreach ($hotels as $hotel) {  
                            $b++;
                            $hid = $hotel->id;

                            $check_amenti = DB::table('Hotellook_new_hotels')
                                ->select('location_id','id')
                                ->where('id',$hid)
                                ->where('updated',null) 
                                ->get();

                              //  return print_r($check_amenti);
            
                            if (!$check_amenti->isEmpty()) {
                              //  return print_r( $check_amenti);
                                $facilities = $hotel->facilities;   
                                $shortFacilities = $hotel->shortFacilities;  
                                 $facilities = $hotel->facilities;  
                                 $modifyfacilities =null; 

                                 if($facilities !=""){
                                    $modifyfacilities = implode(',', $facilities);
                                 }
                                // return $modifyfacilities;
                                 $shortFacilities = $hotel->shortFacilities; 
                                $mnt = json_decode($allmnt, true); // Decode JSON to an associative array
                                $matchedIds = [];
                                $shortFacility = null;
                                if(!empty($shortFacilities) ){
                                    foreach ($shortFacilities as $sfname) {
                                        $matchingAmenity = array_filter($mnt, function ($amenity) use ($sfname) {
                                            return strtolower(trim($amenity['name'])) == strtolower(trim($sfname));
                                        });
                                    
                                        if (!empty($matchingAmenity)) {
                                            $amenityId = reset($matchingAmenity)['id'];
                                            $matchedIds[] = $amenityId;
    
                                            $matchedIds = array_map('intval', $matchedIds);                                     
                                            $shortFacility = implode(',', $matchedIds);
                                            
                                        }
                                    }
                                }
                              
                                
                               
                                 //end mnt
                              
            
                                date_default_timezone_set('Asia/Kolkata');
                                //start ct
                               $ctid =$hotel->cityId;
                               $star =$hotel->stars;
                                $pricefrom = $hotel->pricefrom;
                                $rating = (float)$hotel->rating; 
                                $rating /= 10; 
                                $formatted_rating = number_format($rating, 1, '.', '');

                                $name = $hotel->name;
                                $hname =  $name->en;
                                $address = $hotel->address;
                                $hadd = $address->en;
                                $popularity = $hotel->popularity;
                
                                $propertyType = $hotel->propertyType;
                                $checkIn = $hotel->checkIn;
                                $checkOut = $hotel->checkOut;
                
                                $distance = $hotel->distance;                    
                                $photoCount = $hotel->photoCount;
                            
                                $photos = $hotel->photos;
                                $photosJSON = json_encode($photos);
                                $photosByRoomType = $hotel->photosByRoomType;
                                $yearOpened = $hotel->yearOpened;
                                $yearRenovated = $hotel->yearRenovated;
                                $cntRooms = $hotel->cntRooms;
                                $cntSuites = $hotel->cntSuites;
            
                                /*new */
            
                                
                                
                                $cntFloors = $hotel->cntFloors;
                              //  $facilitiess = $modifyfacilities;
                                $poi_distance =json_encode($hotel->poi_distance);
                                
                                //end new
                               // 'amenities' => $amenitiesString ,
                              // 'Languages' => $languageString,
                              // 'room_aminities' => $roommnt,
                              //  $shortFacilities = $shortFacility;

                                $loc = $hotel->location;
                                $lon = $loc->lon;
                                $lat = $loc->lat;
                                $link = $hotel->link;
                    
                                
                                    $dt = array(   
                                        'pricefrom' =>$pricefrom,
                                        'rating' => $formatted_rating,                            
                                        'popularity' => $popularity,
                                        'propertyTypeId' =>  $propertyType,
                                        'propertyType' => $propertyType,
                                        'checkIn' => $checkIn,
                                        'checkOut' => $checkOut,
                                        'distance' => $distance,                           
                                        'photos' => $photosJSON,
                                        'photosByRoomType' => json_encode($photosByRoomType),
                                        'photosByRoomTypeNames' => json_encode($photosByRoomType),
                                        'yearOpened' =>  $yearOpened,
                                        'yearRenovated' => $yearRenovated,
                                        'cntRooms' => $cntRooms,
                                        'cntSuites' => $cntSuites,
                                        'cntFloors' => $cntFloors,
                                        'facilities' => $modifyfacilities,                                       
                                        'shortFacilities' => $shortFacility,
                                        'address' =>  $hadd,
                                        'link' => $link,
                                        'metaTagTitle' => '',
                                        'MetaTagDescription' => '',
                                        'poi_distance' => '',
                                        'dt_created' => now(),
                                        'address_flg' => 1,
                                        'IsActive' => 1,
                                        'hotelAPi' => null,
                                        'Location_Api' => null,
                                        'hotelAddFlg' =>null,
                                        'hotelslugFlag' => null,
                                        'Pincode' =>null,
                                        'Phone' => null,
                                        'Email' => '',
                                        'Website' => '',
                                        'NearestStations' => null,
                                        'about' => null,
                                        'CategoryId' => null,
                                      
                                        'poi_distance'=>$poi_distance,
                                        'updated'=>1,
                                        
                                    );                           
                                  
                                    DB::table('Hotellook_new_hotels')->where('id',$hid)->update($dt);            
                                   
              //  sleep($delayafterloop);
                            }

                                
                        $j++;
                    }
                       
                       
                   } else {
                       echo "No 'hotels' found in the response for name: $name\n";
                   }
           
                
               }
                sleep($delaySeconds);
               $offset += $batchSize;
            } while (true);
    
            }
            public function inserthoteldetail1(){
   
                $timeout = PHP_INT_MAX; 
            
                $TRAVEL_PAYOUT_TOKEN = "27bde6e1d4b86710997b1fd75be0d869"; 
                $TRAVEL_PAYOUT_MARKER = "299178"; 
               //start amenities
                $getamenties = "http://engine.hotellook.com/api/v2/static/amenities/en.json?token=".$TRAVEL_PAYOUT_TOKEN;
                $allmnt = Http::withoutVerifying()->timeout($timeout)->get($getamenties);
              //  $mnt = json_decode($allmnt);
        
                //end amenities
                
                $batchSize = 5; 
                $delaySeconds = 100;
                $delayafterloop = 60;
                $offset = 0;
                do {
                 
                    $data = DB::table('Hotellook_new_hotels')
                        ->select('location_id')     
                        ->where('updated',null) 
                        ->orderBy('location_id', 'desc')                 
                        ->distinct()
                        ->limit($batchSize)            
                        ->get();
                    
                    if ($data->isEmpty()) {               
                        dd('empty data');
                        break;                
                    }
            
                   
                   $englishNames = [];
            
               
                    if(empty($data)){
                      dd('data is empty');
                    }
            
                    foreach ($data as $cont) {
                     $cid = $cont->location_id;      
                
                         $getval = "http://engine.hotellook.com/api/v2/static/hotels.json?locationId=$cid&token=".$TRAVEL_PAYOUT_TOKEN;
                          $gethot = Http::withoutVerifying()->timeout($timeout)->get($getval);
                         
                              $dt2 = json_decode($gethot);              
                     
                           if (is_object($dt2) && property_exists($dt2, 'hotels')) {
                              $hotels = $dt2->hotels;
                                $j =1; $b =1;	   
                            foreach ($hotels as $hotel) {  
                                    $b++;
                                    $hid = $hotel->id;
        
                                    $check_amenti = DB::table('Hotellook_new_hotels')
                                        ->select('location_id','id')
                                        ->where('id',$hid)
                                        ->where('updated',null) 
                                        ->get();
                    
                                    if (!$check_amenti->isEmpty()) {
                                      //  return print_r( $check_amenti);
                                        $facilities = $hotel->facilities;   
                                        $shortFacilities = $hotel->shortFacilities;  
                                         $facilities = $hotel->facilities;  
                                         $modifyfacilities =null; 
        
                                         if($facilities !=""){
                                            $modifyfacilities = implode(',', $facilities);
                                         }
                                        // return $modifyfacilities;
                                         $shortFacilities = $hotel->shortFacilities; 
                                        $mnt = json_decode($allmnt, true); // Decode JSON to an associative array
                                        $matchedIds = [];
                                        $shortFacility =null;
                                        if(!empty($shortFacilities) ){
                                            foreach ($shortFacilities as $sfname) {
                                                $matchingAmenity = array_filter($mnt, function ($amenity) use ($sfname) {
                                                    return strtolower(trim($amenity['name'])) == strtolower(trim($sfname));
                                                });
                                            
                                                if (!empty($matchingAmenity)) {
                                                    $amenityId = reset($matchingAmenity)['id'];
                                                    $matchedIds[] = $amenityId;
            
                                                    $matchedIds = array_map('intval', $matchedIds);                                     
                                                    $shortFacility = implode(',', $matchedIds);
                                                    
                                                }
                                            }
                                        }
                                        
                                       
                                         //end mnt
                                      
                    
                                        date_default_timezone_set('Asia/Kolkata');
                                        //start ct
                                       $ctid =$hotel->cityId;
                                       $star =$hotel->stars;
                                        $pricefrom = $hotel->pricefrom;
                                        $rating = (float)$hotel->rating; 
                                        $rating /= 10; 
                                        $formatted_rating = number_format($rating, 1, '.', '');

                                        $name = $hotel->name;
                                        $hname =  $name->en;
                                        $address = $hotel->address;
                                        $hadd = $address->en;
                                        $popularity = $hotel->popularity;
                        
                                        $propertyType = $hotel->propertyType;
                                        $checkIn = $hotel->checkIn;
                                        $checkOut = $hotel->checkOut;
                        
                                        $distance = $hotel->distance;                    
                                        $photoCount = $hotel->photoCount;
                                    
                                        $photos = $hotel->photos;
                                        $photosJSON = json_encode($photos);
                                        $photosByRoomType = $hotel->photosByRoomType;
                                        $yearOpened = $hotel->yearOpened;
                                        $yearRenovated = $hotel->yearRenovated;
                                        $cntRooms = $hotel->cntRooms;
                                        $cntSuites = $hotel->cntSuites;
                    
                                        /*new */
                    
                                        
                                        
                                        $cntFloors = $hotel->cntFloors;
                                        $facilities = $modifyfacilities;
                                        $poi_distance =json_encode($hotel->poi_distance);
                                        
                                        //end new
                                       // 'amenities' => $amenitiesString ,
                                      // 'Languages' => $languageString,
                                      // 'room_aminities' => $roommnt,
                                        $shortFacilities = $shortFacility;
        
                                        $loc = $hotel->location;
                                        $lon = $loc->lon;
                                        $lat = $loc->lat;
                                        $link = $hotel->link;
                            
                                        
                                            $dt = array(   
                                                'pricefrom' =>$pricefrom,
                                                'rating' => $formatted_rating,                            
                                                'popularity' => $popularity,
                                                'propertyTypeId' =>  $propertyType,
                                                'propertyType' => $propertyType,
                                                'checkIn' => $checkIn,
                                                'checkOut' => $checkOut,
                                                'distance' => $distance,                           
                                                'photos' => $photosJSON,
                                                'photosByRoomType' => json_encode($photosByRoomType),
                                                'photosByRoomTypeNames' => json_encode($photosByRoomType),
                                                'yearOpened' =>  $yearOpened,
                                                'yearRenovated' => $yearRenovated,
                                                'cntRooms' => $cntRooms,
                                                'cntSuites' => $cntSuites,
                                                'cntFloors' => $cntFloors,
                                               'facilities' => $modifyfacilities,                                       
                                               'shortFacilities' => $shortFacility,
                                                'address' =>  $hadd,
                                                'link' => $link,
                                                'metaTagTitle' => '',
                                                'MetaTagDescription' => '',
                                                'poi_distance' => '',
                                                'dt_created' => now(),
                                                'address_flg' => 1,
                                                'IsActive' => 1,
                                                'hotelAPi' => null,
                                                'Location_Api' => null,
                                                'hotelAddFlg' =>null,
                                                'hotelslugFlag' => null,
                                                'Pincode' =>null,
                                                'Phone' => null,
                                                'Email' => '',
                                                'Website' => '',
                                                'NearestStations' => null,
                                                'about' => null,
                                                'CategoryId' => null,
                                              
                                                'poi_distance'=>$poi_distance,
                                                'updated'=>1,
                                                
                                            );                           
                                          
                                            DB::table('Hotellook_new_hotels')->where('id',$hid)->update($dt);
                  //  return 1;
                      //  sleep($delayafterloop);
                                    }
        
                                        
                                $j++;
                            }
                               
                               
                           } else {
                               echo "No 'hotels' found in the response for name: $name\n";
                           }
                   
                        
                       }
                        sleep($delaySeconds);
                       $offset += $batchSize;
                    } while (true);
            
                    }
        
        
        
}