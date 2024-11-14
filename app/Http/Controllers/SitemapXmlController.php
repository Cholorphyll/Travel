<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\DB;
class SitemapXmlController extends Controller
{
    
	 public function sitemapindex(){        
        $recordsPerPage = 20000;
        $Sight_totalRecords = DB::table('Sight')->count();
        $Sightcount = ceil($Sight_totalRecords / $recordsPerPage);
      //  $location_total = DB::table('Location')->count();
		 $location_total =  DB::table('Location as l')
		->join('Sight as s', 'l.LocationId', '=', 's.LocationId')		
		->distinct()
		->count('l.LocationId');
		
        $locationcount = ceil($location_total  / $recordsPerPage);
        
        $hotellistingcount = DB::table('Temp_Mapping')->distinct()->count('slugid');
        $hotcount = ceil($hotellistingcount / $recordsPerPage);
		 
      //  $tphotelcount = DB::table('TPHotel')->count();
      //  $tpHdetailcount = ceil($tphotelcount / $recordsPerPage);
        // $tphotelcount = DB::table('TPHotel')->whereNotNull('slugid')->distinct()->count('id');
		  $tphotelcount = DB::table('TPHotel as h')->join('Location as l','h.slugid','=','l.slugid')->count();
       	 $tpHdetailcount = ceil($tphotelcount / $recordsPerPage);
		 
  		$landingcount = DB::table('TPHotel_landing')->count();
        $landcnt = ceil($landingcount / $recordsPerPage);
      
        $Neighborhoodcnt = DB::table('Neighborhood')->count();
        $neibcont = ceil($Neighborhoodcnt / $recordsPerPage);

 		$county_explore = DB::table('Country')->count();
        $cont_explore_count = ceil($county_explore / $recordsPerPage);
      
        $continent_exlore = DB::table('CountryCollaboration')->count();
        $continent_expl_count = ceil($continent_exlore / $recordsPerPage);

		 $count_exp_list_cat = DB::table('Location as l')
		->join('Sight as s', 's.LocationId', '=', 'l.LocationId')
		->select(DB::raw('COUNT(DISTINCT s.CategoryId) as category_count'))
		->groupBy('l.LocationId')
		->get();

    // Count distinct category IDs for sights where IsMustSee = 1
        $count_exp_list_catmustsee = DB::table('Location as l')
            ->join('Sight as s', 's.LocationId', '=', 'l.LocationId')
            ->select(DB::raw('COUNT(DISTINCT s.CategoryId) as category_count'))
            ->where('s.IsMustSee', 1) // Only count sights where IsMustSee = 1
            ->groupBy('l.LocationId')
            ->get();
        $count_list_exp = $count_exp_list_cat->sum('category_count');
        $count_list_exp_mustsee = $count_exp_list_catmustsee->sum('category_count');
        $total_count = $count_list_exp + $count_list_exp_mustsee;     
        $total_pages = ceil($total_count / 17000);
   
		 //restaurant
        $rcount = DB::table('Restaurant as r')      
        ->join('Location as l','l.LocationId','=','r.LocationId') 
        ->count();
        $restcount = ceil($rcount / $recordsPerPage);
		 
		 //restaurant landing
		 
		  $rest_landing = DB::table('Location as l')
        ->join('Restaurant as r', 'r.LocationId', '=', 'l.LocationId')
        ->select( 
            DB::raw('GROUP_CONCAT(DISTINCT r.Category) as category_count')
        )
        ->groupBy('l.LocationId')      
        ->get();
        $totalCategories = [];
        foreach ($rest_landing as $row) {
            $categories = explode(',', $row->category_count);
            $totalCategories = array_merge($totalCategories, $categories);
        }
        $totalCategories = array_filter($totalCategories);
           $totalUniqueCategories = count(array_unique($totalCategories));
        
        $totalCount = $totalUniqueCategories * 2;
         $landing_rest_count = ceil($totalCount / $recordsPerPage);
		 
		 //end rest landing
		 
		 
        return response()->view('sitemap.sitemapindex',['Sightcount'=>$Sightcount,'locationcount'=>$locationcount,'hotcount'=>$hotcount,'tpHdetailcount'=>$tpHdetailcount,'landcnt'=>$landcnt,'neibcont'=>$neibcont,'cont_explore_count'=>$cont_explore_count,'continent_expl_count'=>$continent_expl_count,'count_list_exp'=>$total_pages,'restcount'=>$restcount,'landing_rest_count'=>$landing_rest_count])->header('Content-Type', 'text/xml');
    }

	
     public function sitemaping(){
        $recordsPerPage = 20000;
        $Sight_totalRecords = DB::table('Sight')->count();
        $Sightcount = ceil($Sight_totalRecords / $recordsPerPage);
        $location_total = DB::table('Location')->count();
        $locationcount = ceil($location_total  / $recordsPerPage);
        
        $hotellistingcount = DB::table('TPLocations')->count();
        $hotcount = ceil($hotellistingcount / $recordsPerPage);
        $tphotelcount = DB::table('TPHotel')->count();
        $tpHdetailcount = ceil($tphotelcount / $recordsPerPage);
     

      return response()->view('sitemap.sitemaping',['Sightcount'=>$Sightcount,'locationcount'=>$locationcount,'hotcount'=>$hotcount,'tpHdetailcount'=>$tpHdetailcount]);     
     }


    public function location_listing($pagenumber){
        $limit = 20000;
        $offset = ($pagenumber - 1) * $limit;
       // $locations = DB::table('Location')->skip($offset)->limit($limit)->orderBy('LocationId','asc')->get();
	
		
	$locations = DB::table('Location as l')
    ->join('Sight as s', 'l.LocationId', '=', 's.LocationId')
    ->select('l.LocationId', 'l.Slug', 'l.slugid')  // Include LocationId in the SELECT list
    ->distinct()
    ->skip($offset)
    ->limit($limit)
    ->orderBy('l.LocationId', 'asc')  // Now LocationId is part of SELECT list
    ->get();

        return response()->view('sitemap.index',['Location'=>$locations])->header('Content-Type','text/xml');
      }
        public function location_listing_with_cat($pagenumber){
			$limit = 6000;
		
			$offset = ($pagenumber - 1) * $limit;         
		    $locations = DB::table('Location as l')
			  ->join('Sight as s', 's.LocationId', '=', 'l.LocationId')
			  ->select('l.Slug', 'l.slugid', DB::raw('GROUP_CONCAT(DISTINCT CONCAT("ct", s.CategoryId)) as catids'),'s.IsMustSee')
        ->groupBy('l.LocationId', 's.IsMustSee') // Add s.IsMustSee here

			 ->skip($offset)
			 ->limit($limit)     
			  ->orderBy('l.LocationId', 'asc')
			  ->get();
			return response()->view('sitemap.sightlisting_with_cat',['Location'=>$locations])->header('Content-Type','text/xml');
      }
     
     public function handleLocationExplore($pageNumber) {
         $limit = 20000;
         $offset = ($pageNumber - 1) * $limit;
         $locations = DB::table('Sight as s')
         ->join('Location as l','l.LocationId','=','s.LocationId')
         ->select('l.slugid','s.SightId','s.Slug')
         ->skip($offset)
         ->limit($limit)
         ->orderBy('s.SightId', 'asc')->get();    
         
         return response()->view('sitemap.explore', ['Location' => $locations])->header('Content-Type', 'text/xml');
     }

	/*---------end explore site mapping ------------*/

	  	 public function hotellisting($pagenumber){
		  $limit = 20000;
		  $offset = ($pagenumber - 1) * $limit;    

		  $Location =DB::table('Temp_Mapping as m')
		  ->join('Location as l','l.LocationId','=','m.Tid')
		  ->select('m.Tid','m.slug','l.slugid')
		  ->skip($offset)
		  ->distinct()
		  ->limit($limit)
		  ->orderby('m.Tid','asc')
		  ->get(); 

			return response()->view('sitemap.hotel_listing', [
				'Location' => $Location
			])->header('Content-Type', 'text/xml');
		}


		 public function hoteldetail($pagenumber){
			 $limit = 20000;
			 $offset = ($pagenumber - 1) * $limit;     
			 $Location = DB::table('TPHotel as h')    
				 ->join('Location as l','h.slugid','=','l.slugid')
				 ->select('h.id','h.slug','l.slugid')
				 ->skip($offset) 
				 ->skip($offset)
				 ->distinct()->limit($limit)->orderby('h.id','asc')->get();
		
			return response()->view('sitemap.hotelDetail', [
				'Location' => $Location
			])->header('Content-Type', 'text/xml');

		}
	
	    	/*---------end explore site mapping ------------*/
	  	/*---------Landing ------------*/
    public function hotellanding($pagenumber) {
    $limit = 20000;
    $offset = ($pagenumber - 1) * $limit;

    $landing = DB::table('Location as l')
        ->join('TPHotel as h', 'l.slugid', '=', 'h.slugid')
        ->select(
            'l.slugid',
            'l.Slug',
            'h.stars',
            'h.facilities' // Fetch facilities directly
        )
        ->where('h.stars', '>', 0) // Exclude entries where stars are 0
        ->groupBy('l.slugid', 'l.Slug', 'h.stars', 'h.facilities') // Group by necessary columns
        ->orderBy('l.slugid', 'asc') // Order by slugid or Slug
        ->distinct()
        ->skip($offset)
        ->limit($limit)
        ->get();

    // Fetch all amenities
    $amenities = DB::table('TPHotel_amenities')->get();

		return $landing;
    return response()->view('sitemap.hotel_landing', [
        'landing' => $landing,
        'amenities' => $amenities // Renamed to be more descriptive
    ])->header('Content-Type', 'text/xml');
}

	  	/*---------country explore ------------*/
	
	 public function countryexplore($pagenumber){
        $limit = 20000;
        $offset = ($pagenumber - 1) * $limit;
       // $locations = DB::table('Location')->skip($offset)->limit($limit)->orderBy('LocationId','asc')->get();
        $locations = DB::table('Country')   
        ->skip($offset)
        ->limit($limit)      
        ->orderBy('CountryId', 'asc')
        ->get();
		
		
        return response()->view('sitemap.country_explore',['Location'=>$locations])->header('Content-Type','text/xml');
      }

      
      public function continent_explore($pagenumber){
        $limit = 20000;
        $offset = ($pagenumber - 1) * $limit;
       // $locations = DB::table('Location')->skip($offset)->limit($limit)->orderBy('LocationId','asc')->get();
        $locations = DB::table('CountryCollaboration')  
        ->skip($offset)
        ->limit($limit)     
        ->orderBy('CountryCollaborationId', 'asc')
        ->get();
		
		
        return response()->view('sitemap.continent_explore',['Location'=>$locations])->header('Content-Type','text/xml');
      }
	
      public function retaurant_detail($pagenumber){ 
        $limit = 20000;
        $pagenumber =1; 
        $offset = ($pagenumber - 1) * $limit;  

       
       $restaurant = DB::table('Restaurant as r')
       ->select('r.RestaurantId','r.Slug','l.slugid')
       ->join('Location as l','l.LocationId','=','r.LocationId')        
       ->skip($offset)
       ->limit($limit)
       ->orderBy('r.RestaurantId', 'asc')    
       ->get();


        return response()->view('sitemap.restaurant_detail',['restaurant'=>$restaurant])->header('Content-Type','text/xml');
      }
	public function retaurant_category($pagenumber){
       
        $limit = 50000; 
        $offset = ($pagenumber - 1) * $limit;
    
        $locations = DB::table('Location as l')
          ->join('Restaurant as r', 'r.LocationId', '=', 'l.LocationId')
          ->select(             
              'l.slugid',
              DB::raw('GROUP_CONCAT(DISTINCT r.Category) as catids')
          )
          ->groupBy('l.LocationId')
          ->skip($offset)
          ->limit($limit)
          ->orderBy('l.LocationId', 'asc')
          ->get(); 
        return response()->view('sitemap.restarent_categoy_list',['Location'=>$locations,'p'=>$pagenumber])->header('Content-Type','text/xml');
      }

}
