<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use App\Models\Hotel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
class DataController extends Controller
{
	 public function formatDate($date) {
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return $date;
        } else {
            $date = str_replace('-', ' ', $date);
            return Carbon::createFromFormat('d M Y', $date)->format('Y-m-d');
        }
    }

       public function homepage(){
        $searchresults =null;
       return view('welcome')->with('searchresults',array());
    }



	  public function listLocation(Request $request)
    {
        if ($request->has('search')) {
            $searchText = $request->input('search');

            // Create a unique cache key based on the search text
            $cacheKey = 'locations_search_' . md5($searchText);

            // Attempt to retrieve the locations from the cache
            $locations = Cache::remember($cacheKey, 600, function() use ($searchText) {
                // First query to check for matching names
                $query = DB::table('Location')
                    ->select('slugid AS id', DB::raw("CONCAT(Name, ', ', country) AS displayName"), 'Slug')
                    ->where('Name', 'LIKE', $searchText . '%')
                    ->orderBy('avg_monthly_searches', 'desc')
                    ->limit(10);

                $locations = $query->get();

                // If no results found, try a more flexible search
                if ($locations->isEmpty()) {
                    $query = DB::table('Location AS l')
                        ->select('slugid AS id', DB::raw("CONCAT(Name, ', ', country) AS displayName"), 'Slug AS Slug')
                        ->where(function ($query) use ($searchText) {
                            $query->where(DB::raw("LOWER(CONCAT(l.Name, ' ', l.country))"), 'LIKE', '%' . strtolower($searchText) . '%');
                        })
                        ->orderBy('l.avg_monthly_searches', 'desc')
                        ->limit(10);

                    $locations = $query->get();
                }

                // If still no results, try searching by Slug
                if ($locations->isEmpty()) {
                    $query = DB::table('Location AS l')
                        ->select('slugid AS id', DB::raw("CONCAT(l.Name, ', ', l.country) AS displayName"), 'Slug AS Slug')
                        ->where('l.Slug', 'LIKE', $searchText . '%')
                        ->orderBy('l.avg_monthly_searches', 'desc')
                        ->limit(10);

                    $locations = $query->get();
                }

                return $locations; // Return the result to cache
            });

            $result = [];
            if (!$locations->isEmpty()) {
                foreach ($locations as $loc) {
                    $result[] = ['id' => $loc->id, 'Slug' => $loc->Slug, 'value' => $loc->displayName];
                }
            } else {
                $result[] = ['value' => "Result not found"];
            }

            return view('mainpage_result', ['searchresults' => $result]);
        }
    }

    public function recenthistory(Request $request){

        if (Session::has('lastsearch')) {
            $serializedData = Session::get('lastsearch');
            $search = unserialize($serializedData);
            $lastFive = array_slice($search, -5);
        $result = [];

            foreach ($lastFive as $value) {
                $result[] = [
                    'id' => $value['id'],
                    'Slug' => $value['key'],
                    'value' => $value['Name'],
                ];
            }

        }else{
            $searcht = array(
                array(
                    'id' => 11600011,
                    'key' => 'goa-india',
                    'Name' => 'Goa,india'
                ),
                array(
                    'id' => 131000090189,
                    'key' => 'london-ontario',
                    'Name' => 'London,Canada'
                ),
                array(
                    'id' => 129600030001,
                    'key' => 'Dubai-emirate-of-Dubai',
                    'Name' => 'Dubai,United Arab Emirates'
                )
            );


            $result = array();

            foreach ($searcht as $item) {
                $result[] = array(
                    'id' => $item['id'],
                    'Slug' => $item['key'],
                    'value' => $item['Name']
                );
            }


        }

        return view('mainpage_result', ['searchresults' => $result]);

    }
	   public function singleLocation($segment, Request $request){

        $parts = explode('-', $segment);
	    $id = null;
        $slug = null;
        if (count($parts) > 1) {
            $id = array_shift($parts);
            $slug = implode('-', $parts);
        }
        $explocname = $slug;
		$dist =50;
        $rest = implode('-', $parts);
        $is_rest ="";
        $ismustsee ="";
        $is_rest ="";
        $rest_avail ="";
        $getSightCat ="";
        $explocname = $slug;
        $location_name ="";
        $getloccheck = DB::table('Location')
            ->select('Name','LocationId')
            ->where('Slug', $slug)
            ->where('slugid', $id)
            ->get();

       if($getloccheck->isEmpty()){
		    if ($id != null) {
				$checkgetloc = DB::table('Location')
				->select('slugid')
				->where('LocationId', $id)
				->get();
				if(!$checkgetloc->isEmpty()){
					$id =  $checkgetloc[0]->slugid;

					return redirect()->route('search.results', [$id.'-'.$slug]);
				 }
          }
          abort(404, 'NOT FOUND');
        }

        $location_name =$getloccheck[0]->Name;
        $locationID=$getloccheck[0]->LocationId;
        $lociID = $locationID ;
        $locn=$getloccheck[0]->Name;

		 //cat code
		$catid = $request->get('category');
		$catid= str_replace('ct','',$catid);
		$lid = $request->session()->get('locId');


		if($lid != $locationID){
			foreach (request()->session()->all() as $key => $value) {
                if (str_starts_with($key, 'cat_') || str_starts_with($key, 'catid_')) {
                    request()->session()->forget($key);
                }
            }
		  $request->session()->forget('locId');
		  $request->session()->forget('mustSee');
		  $request->session()->forget('isrestaurant');
		}
		$getcat = DB::table('Category')->where('CategoryId', $catid)->get();
		$names ="";
        //must see
        $top_attractions = 0;
		//return $request->session()->all();
        if($catid =='mustsee'){
            $top_attractions = 1;
            $request->session()->put('locId', $locationID);
			  $request->session()->put('mustSee',1);


            if (!$request->session()->has('catid_' . $catid)) {
                $sessionVariableName = 'catid_' . $catid;
                $request->session()->put($sessionVariableName, $catid);

            }
            if (!$request->session()->has('cat_' . $catid)) {

                $catNameAndId = $names . '_' . $catid;

                $sessionVariableName = 'cat_' . $catid;
                $request->session()->put($sessionVariableName, $catNameAndId);
            }
       }else{
		 $request->session()->forget('catid_mustsee');
			 $request->session()->forget('cat_mustsee');
			 $request->session()->forget('locId');
			$request->session()->forget('mustSee');
		}
       //must see
  // return    $request->session()->all();
		// session()->flush();
			if(!$getcat->isEmpty()){
				$names= $getcat[0]->Title;
				$catid= $getcat[0]->CategoryId;
				$request->session()->put('locId', $locationID);


				if (!$request->session()->has('catid_' . $catid)) {
					$sessionVariableName = 'catid_' . $catid;
					$request->session()->put($sessionVariableName, $catid);

				}
				if (!$request->session()->has('cat_' . $catid)) {

					$catNameAndId = $names . '_' . $catid;

					$sessionVariableName = 'cat_' . $catid;
					$request->session()->put($sessionVariableName, $catNameAndId);
				}
		   }
           $getSightCat = DB::table('Sight')
           ->select('Category.CategoryId', 'Category.Title')
           ->distinct()
           ->join('Category', 'Sight.categoryId', '=', 'Category.categoryId')
           ->where('Sight.LocationId', $locationID)
           ->get();
	    	//end cat code
            $faq = DB::table('LocationQuestion')
            ->where('LocationId', $locationID)
            ->get();
            //end faq
            //fetch data
            $searchresults = DB::table('Sight as s')
            ->select('s.SightId', 's.IsMustSee', 's.Title', 's.TAAggregateRating', 's.LocationId', 's.Slug', 'IsRestaurant', 'Address', 's.Latitude', 's.Longitude', 's.CategoryId', 'c.Title as CategoryTitle', 'l.CountryId', 'l.Name as LName', 'l.Slug as Lslug', 'l.MetaTagTitle as mTitle', 'l.MetaTagDescription as mDesc', 'l.tp_location_mapping_id', 'co.Name as CountryName', 'l.About', 'l.slugid', 'l.Longitude as loc_longitude', 'l.Lat as loc_latitude', 's.TATotalReviews','s.ticket','s.MicroSummary')
            ->leftJoin('Category as c', 's.CategoryId', '=', 'c.CategoryId')
            ->join('Location as l', 's.LocationId', '=', 'l.LocationId')
            ->leftJoin('Country as co', 'l.CountryId', '=', 'co.CountryId')
         //   ->leftJoin('Sight_image as img', function ($join) {
           //     $join->on('s.SightId', '=', 'img.Sightid');
          //      $join->whereRaw('img.Image = (SELECT Image FROM Sight_image WHERE Sightid = s.SightId LIMIT 1)');
          //  })

            ->where('l.Slug', $slug)
            ->where('l.slugid', $id);
            $categoryIds = [];
            $lid = $request->session()->get('locId');
            $mustsee ="";
            if($lid == $locationID){
                foreach (session()->all() as $key => $value) {
                    if (str_starts_with($key, 'catid_')  && $value !== null && $value !== 'null' && !str_starts_with($key, 'catid_must')) {
                        $categoryIds[] = $value;
                    }
                    if (str_starts_with($key, 'catid_must')) {
                        $mustsee =1;
                    }
                }
            }

            if ($mustsee == 1) {
                $searchresults = $searchresults->where('s.IsMustSee', 1);
            }
            if (!empty($categoryIds)) {
                $searchresults = $searchresults->whereIn('s.CategoryId', $categoryIds);
            }
            $searchresults = $searchresults->distinct();
            if (empty($categoryIds)) {

                $searchresults = $searchresults->orderBy('s.TATotalReviews', 'desc')->limit(10)->get()->toArray();
            }else{
                $searchresults = $searchresults->orderBy('s.IsMustSee', 'asc')->limit(10)->get()->toArray();
            }
        //end fetch data
        //make count query


           // return print_r($searchresults);
        $totalCountResults = 0;
        $countResults = DB::table('Sight as s')
        ->leftJoin('Category as c', 's.CategoryId', '=', 'c.CategoryId')
        ->join('Location as l', 's.LocationId', '=', 'l.LocationId')
        ->leftJoin('Country as co', 'l.CountryId', '=', 'co.CountryId')
     //   ->leftJoin('Sight_image as img', function ($join) {
      //      $join->on('s.SightId', '=', 'img.Sightid');
      //      $join->whereRaw('img.Image = (SELECT Image FROM Sight_image WHERE Sightid = s.SightId LIMIT 1)');
     //   })
        ->where('l.slugid', $id);
        if (!empty($categoryIds)) {
            $countResults = $countResults->whereIn('s.CategoryId', $categoryIds);
        }
        if (!empty($mustsee)) {
            $countResults = $countResults->where('s.IsMustSee', 1);
        }
        $totalCountResults = $countResults->distinct()->count();
        //end count query
        $loid =$locationID;
        //empty query 1
        if(empty($searchresults)){
          $loc = DB::table('Location')
          ->select('LocationId', 'parentid','LocationLevel')
          ->where('LocationId', $locationID)
          ->first();
          if(!empty($loc)){
               $parentId =$loc->parentid;
              $LocationLevel =$loc->LocationLevel;
              while ($parentId !== null && $LocationLevel !=1) {
                      $parent = DB::table('Location')
                      ->select('LocationId', 'ParentId')
                      ->where('LocationId', $parentId)
                      ->first();
                  if ($parent) {
                      $isParentInSight = DB::table('Sight')
                        ->where('LocationId', $parent->LocationId)
                        ->exists();
                      if ($isParentInSight) {
                          $parentId = $parent->LocationId;
                          break;
                      } else {
                          $parentId = $parent->ParentId;
                      }
                  } else {
                      $parentId = null;
                  }
              }
          }
          $loid =$parentId;
          $searchresults = DB::table('Sight as s')
          ->select('s.SightId','s.IsMustSee','s.Title','s.TAAggregateRating','s.LocationId','s.Slug','IsRestaurant','Address', 's.Latitude','s.Longitude','s.CategoryId', 'c.Title as CategoryTitle', 'l.CountryId', 'l.Name as LName', 'l.Slug as Lslug', 'l.MetaTagTitle as mTitle', 'l.MetaTagDescription as mDesc', 'l.tp_location_mapping_id', 'co.Name as CountryName','l.slugid','l.Longitude as loc_longitude','l.Lat as loc_latitude','s.TATotalReviews','l.About','s.ticket')
          ->leftJoin('Category as c', 's.CategoryId', '=', 'c.CategoryId')
          ->join('Location as l', 's.LocationId', '=', 'l.LocationId')
          ->leftJoin('Country as co', 'l.CountryId', '=', 'co.CountryId')
          //  ->leftJoin('Sight_image as img', function ($join) {
         //   $join->on('s.SightId', '=', 'img.Sightid');
         //   $join->whereRaw('img.Image = (SELECT Image FROM Sight_image WHERE Sightid = s.SightId LIMIT 1)');
        //  })
          ->where('l.LocationId', $parentId);
        if (!empty($categoryIds)) {
            $searchresults = $searchresults->whereIn('s.CategoryId', $categoryIds);
        }
        if (!empty($mustsee)) {
            $searchresults = $searchresults->where('s.IsMustSee', 1);
        }
        $searchresults = $searchresults->distinct();
        if (empty($categoryIds)) {

            $searchresults = $searchresults->orderBy('s.TATotalReviews', 'desc')->limit(1)->get()->toArray();
        }else{
			$searchresults = $searchresults->limit(10)->orderBy('s.IsMustSee', 'asc')->get()->toArray();
		}
      }
        //empty query 2
      if(empty($searchresults)){
          $parentId = $locationID;
          $loc = null;
          while ($parentId !== null) {
              $locations = DB::table('Location')
                  ->select('LocationId')
                  ->where('parentid', $parentId)
                  ->limit(2)
                  ->get()
                  ->pluck('LocationId');
              if ($locations->isEmpty()) {
                  break;
              }
              $isInSight = DB::table('Sight')
                  ->whereIn('LocationId', $locations)
                  ->exists();

              if ($isInSight) {
                  $loc = $locations->first();
                  break;
              }
              $parentId = $locations->last();
          }
        //end
      $childIds = [];
      $parentId = $locationID;
      while ($parentId !== null) {
          $locations = DB::table('Location')
              ->select('LocationId')
              ->where('parentid', $parentId)
              ->limit(5)
              ->get();
          foreach ($locations as $location) {
              $childIds[] = $location->LocationId;
          }
          $parentId = count($locations) > 0 ? $locations[0]->LocationId : null;
      }

        $searchresults =  DB::table('Sight as s')
          ->select('s.SightId','s.IsMustSee','s.Title','s.TAAggregateRating','s.LocationId','s.Slug','IsRestaurant','Address', 's.Latitude','s.Longitude','s.CategoryId', 'c.Title as CategoryTitle', 'l.CountryId', 'l.Name as LName', 'l.Slug as Lslug', 'l.MetaTagTitle as mTitle', 'l.MetaTagDescription as mDesc', 'l.tp_location_mapping_id', 'co.Name as CountryName','l.About','l.slugid','l.Longitude as loc_longitude','l.Lat as loc_latitude','s.TATotalReviews','s.ticket')

          ->leftJoin('Category as c', 's.CategoryId', '=', 'c.CategoryId')
          ->join('Location as l', 's.LocationId', '=', 'l.LocationId')
          ->leftJoin('Country as co', 'l.CountryId', '=', 'co.CountryId')
	//	 ->leftJoin('Sight_image as img', function ($join) {
	//		$join->on('s.SightId', '=', 'img.Sightid');
	//		$join->whereRaw('img.Image = (SELECT Image FROM Sight_image WHERE Sightid = s.SightId LIMIT 1)');
	//	   })
          ->whereIn('l.LocationId', $childIds)	;
        if (!empty($categoryIds)) {
            $searchresults = $searchresults->whereIn('s.CategoryId', $categoryIds);
        }
		 if (!empty($mustsee)) {
				$searchresults = $searchresults->where('s.IsMustSee', 1);
		   }
		    $searchresults = $searchresults->distinct();
        if (empty($categoryIds)) {

            $searchresults = $searchresults->orderBy('s.TATotalReviews', 'desc')->limit(10)->get()->toArray();
         }else{
			$searchresults = $searchresults->orderBy('s.IsMustSee', 'asc')->limit(10)->get()->toArray();
		}


        if(!empty($searchresults)){
            $loid =$searchresults[0]->LocationId;
        }

      }
      //end query 2
	   //start distance code

$getexp = collect();
$countresult = count($searchresults);
$restaurantdata = [];
$firstRecord = null;

if ($countresult > 2) {
    if (!empty($searchresults)) {
        foreach ($searchresults as $record) {
            if (!empty($record->Latitude) && !empty($record->Longitude)) {
                $firstRecord = $record;
                break;
            }
        }

        if ($firstRecord != null) {
            $dist = 50; // Distance threshold
            $lat = $firstRecord->Latitude;
            $lon = $firstRecord->Longitude;
            $recordCount = 10;
            $locid = $locationID;

            // Clear existing data in the TempWorking table
            DB::table('TempWorking')->truncate();
            DB::table('TempSuggestedTrip')->truncate();

            // Insert data into TempWorking
      //      DB::statement('
         //       INSERT INTO TempWorking (SightId, IsMustSee, Title, TAAggregateRating, LocationId, Slug, IsRestaurant, Address, Latitude, Longitude, CategoryId, ticket, distance)
          //      SELECT
             //       SightId, IsMustSee, Title, TAAggregateRating, LocationId, Slug, IsRestaurant, Address, Latitude, Longitude, CategoryId, ticket,
              //      (6371 * ACOS(
               //         COS(RADIANS(' . $lat . ')) * COS(RADIANS(Latitude)) * COS(RADIANS(Longitude) - RADIANS(' . $lon . ')) +
               //         SIN(RADIANS(' . $lat . ')) * SIN(RADIANS(Latitude))
               //     )) AS distance
              //  FROM Sight
              //  WHERE LocationId = ' . $loid . '
              //  HAVING distance < ' . $dist . '
            //    ORDER BY distance ASC
           //     LIMIT ' . $recordCount
          //  );

			$query = '
				INSERT INTO TempWorking (
					SightId, IsMustSee, Title, TAAggregateRating, LocationId, Slug,
					IsRestaurant, Address, Latitude, Longitude, CategoryId, ticket, MicroSummary,distance
				)
				SELECT
					SightId, IsMustSee, Title, TAAggregateRating, LocationId, Slug,
					IsRestaurant, Address, Latitude, Longitude, CategoryId,MicroSummary, ticket,
					(6371 * ACOS(
						COS(RADIANS(' . $lat . ')) * COS(RADIANS(Latitude)) * COS(RADIANS(Longitude) - RADIANS(' . $lon . ')) +
						SIN(RADIANS(' . $lat . ')) * SIN(RADIANS(Latitude))
					)) AS distance
				FROM Sight
				WHERE LocationId = ' . $loid;

			// Add filters based on `$mustsee` and `$categoryIds`
			if ($mustsee == 1) {
				$query .= ' AND IsMustSee = 1';
			}

			if (!empty($categoryIds)) {
				$query .= ' AND CategoryId IN (' . implode(',', array_map('intval', $categoryIds)) . ')';
			}

			// Include HAVING clause to filter by distance
			$query .= ' HAVING distance < ' . $dist;

			// Finish the query with ordering and limiting
			$query .= ' ORDER BY IsMustSee ASC, distance ASC LIMIT ' . $recordCount;

			DB::statement($query);

            // Insert top 2 records into TempSuggestedTrip
          DB::statement('
				INSERT INTO TempSuggestedTrip (SightId, IsMustSee, Title, TAAggregateRating, LocationId, Slug, IsRestaurant, Address, Latitude, Longitude, distance, CategoryId, ticket,MicroSummary)
				SELECT SightId, IsMustSee, Title, TAAggregateRating, LocationId, Slug, IsRestaurant, Address, Latitude, Longitude, distance, CategoryId, ticket,MicroSummary
				FROM TempWorking
				ORDER BY distance
				LIMIT 2
				ON DUPLICATE KEY UPDATE
					IsMustSee = VALUES(IsMustSee),
					Title = VALUES(Title),
					TAAggregateRating = VALUES(TAAggregateRating),
					LocationId = VALUES(LocationId),
					Slug = VALUES(Slug),
					IsRestaurant = VALUES(IsRestaurant),
					Address = VALUES(Address),
					Latitude = VALUES(Latitude),
					Longitude = VALUES(Longitude),
					distance = VALUES(distance),
					CategoryId = VALUES(CategoryId),
					ticket = VALUES(ticket),
					MicroSummary=VALUES(MicroSummary)
			');


            $tempSuggestedTripResults = DB::table('TempSuggestedTrip')
                ->select('SightId', 'Latitude', 'Longitude', 'LocationId')
                ->orderBy('SightId', 'desc')
                ->limit(1)
                ->first();

            if ($tempSuggestedTripResults) {
                $thisplace = $tempSuggestedTripResults->SightId;
                $thisLat = $tempSuggestedTripResults->Latitude;
                $thisLong = $tempSuggestedTripResults->Longitude;
                $thisLocationId = $tempSuggestedTripResults->LocationId;

                // Remove the already suggested trip from TempWorking
              //  DB::table('TempWorking')->where('SightId', $thisplace)->delete();

                // Delete the top 2 records from TempWorking to ensure the suggested trips are removed
                DB::table('TempWorking')->orderBy('distance')->limit(2)->delete(); // Ensure this remains

                $countRows = DB::table('TempWorking')->select('SightId')->count();





                do {
                    $tempWorkingData = DB::table('TempWorking')
                        ->selectRaw('*, (6371 * ACOS(
                            COS(RADIANS(' . $thisLat . ')) * COS(RADIANS(Latitude)) * COS(RADIANS(Longitude) - RADIANS(' . $thisLong . ')) +
                            SIN(RADIANS(' . $thisLat . ')) * SIN(RADIANS(Latitude))
                        )) AS distance')
                        ->having('distance', '<', $dist)
                        ->whereNotIn('SightId', function ($query) {
                            $query->select('SightId')->from('TempSuggestedTrip');
                        })

                        ->orderBy('distance', 'ASC')
                        ->limit(1)
                        ->get();

                    if ($tempWorkingData->count() > 0) {
                        DB::table('TempSuggestedTrip')->insert((array) $tempWorkingData->first());
                        DB::table('TempWorking')->where('SightId', $tempWorkingData->first()->SightId)->delete();
                    }

                    $countRows = DB::table('TempWorking')->select('SightId')->count();
                } while ($countRows > 0);

                // Final result
                $searchresults = DB::table('TempSuggestedTrip as s')
                    ->join('Location as l', 'l.LocationId', '=', 's.LocationId')
                    ->leftJoin('Category as c', 's.CategoryId', '=', 'c.CategoryId')
                    ->leftJoin('Country as co', 'co.CountryId', '=', 'l.CountryId')
                    ->leftJoin('Sight_image as img', function ($join) {
                        $join->on('s.SightId', '=', 'img.Sightid');
                        $join->whereRaw('img.Image = (SELECT Image FROM Sight_image WHERE Sightid = s.SightId LIMIT 1)');
                    })
                    ->select(
                        's.SightId', 's.IsMustSee', 's.Title', 's.TAAggregateRating', 's.LocationId', 's.Slug', 's.IsRestaurant',
                        's.Address', 's.Latitude', 's.Longitude', 's.CategoryId',
                        'c.Title as CategoryTitle', 'l.CountryId', 'l.Name as LName',
                        'l.Slug as Lslug', 'l.MetaTagTitle as mTitle',
                        'l.MetaTagDescription as mDesc', 'l.tp_location_mapping_id',
                        'co.Name as CountryName', 'l.slugid',
                        'l.Longitude as loc_longitude', 'l.Lat as loc_latitude',
                        'l.About', 'img.Image', 's.ticket','s.MicroSummary'
                    )
                    ->get();


                   //new code
                if (count($searchresults) < 10) {
                    $searchresults1 = DB::table('Sight as s')
                    ->select('s.SightId', 's.IsMustSee', 's.Title', 's.TAAggregateRating', 's.LocationId', 's.Slug', 'IsRestaurant', 'Address', 's.Latitude', 's.Longitude', 's.CategoryId', 'c.Title as CategoryTitle', 'l.CountryId', 'l.Name as LName', 'l.Slug as Lslug', 'l.MetaTagTitle as mTitle', 'l.MetaTagDescription as mDesc', 'l.tp_location_mapping_id', 'co.Name as CountryName', 'l.About', 'l.slugid', 'l.Longitude as loc_longitude', 'l.Lat as loc_latitude', 's.TATotalReviews','s.ticket','s.MicroSummary')
                    ->leftJoin('Category as c', 's.CategoryId', '=', 'c.CategoryId')
                    ->join('Location as l', 's.LocationId', '=', 'l.LocationId')
                    ->leftJoin('Country as co', 'l.CountryId', '=', 'co.CountryId')
                    ->where('l.slugid', $id)
                    ->whereNull('s.Latitude');
                    $categoryIds = [];
                    $lid = $request->session()->get('locId');
                    $mustsee ="";
                    if($lid == $locationID){
                        foreach (session()->all() as $key => $value) {
                            if (str_starts_with($key, 'catid_')  && $value !== null && $value !== 'null' && !str_starts_with($key, 'catid_must')) {
                                $categoryIds[] = $value;
                            }
                            if (str_starts_with($key, 'catid_must')) {
                                $mustsee =1;
                            }
                        }
                    }
                    if ($mustsee == 1) {
                        $searchresults1 = $searchresults1->where('s.IsMustSee', 1);
                    }
                    if (!empty($categoryIds)) {
                        $searchresults1 = $searchresults1->whereIn('s.CategoryId', $categoryIds);
                    }
                    $searchresults1 = $searchresults1->distinct()->limit(10 - count($searchresults));

                        $searchresults1 = $searchresults1->orderBy('s.IsMustSee', 'asc')->get()->toArray();


                    $searchresults = $searchresults->merge($searchresults1);

                }

                //new code
  // return print_r($searchresults);
                $fetchfunarray = $this->getrestaurents($searchresults, $locationID);
                $restaurantdata = $fetchfunarray['restaurant'];
                $getexp = $fetchfunarray['getexp'];

            }
        }
    }
}
$sightIds = []; // Initialize the array to hold SightId values
$sightImages =collect();
if (!empty($searchresults)) {
    // Check if $searchresults is a collection or array of objects
    if (is_array($searchresults)) {
        // If it's an array, iterate over the array and check if each element is an object
        foreach ($searchresults as $sight) {
            if (is_object($sight) && isset($sight->SightId)) {
                $sightIds[] = $sight->SightId; // Collect SightId
            }
        }
    } elseif (is_object($searchresults)) {
        // If $searchresults is a single object, directly use pluck()
        $searchresults = collect($searchresults); // Convert to collection if needed
        $sightIds = $searchresults->pluck('SightId')->toArray();
    }

    // Now that you have $sightIds, fetch sight images if it's not empty
    if (!empty($sightIds)) {
        $sightImages = DB::table('Sight_image')
            ->whereIn('Sightid', $sightIds)
            ->get();

        // You can return or print $sightImages for debugging
      //  return print_r($sightImages);
    }
}

//end check distance code
    $start2 =  date("H:i:s");



      $breadcumb=[];

            $breadcumb  = DB::table('Location as l')
      ->select('l.CountryId', 'l.Name as LName', 'l.Slug as Lslug', 'co.Name as CountryName','l.LocationId','co.slug as cslug','co.CountryId','cont.Name as ccName','cont.CountryCollaborationId as contid')
      ->Join('Country as co', 'l.CountryId', '=', 'co.CountryId')
       ->leftJoin('CountryCollaboration as cont','cont.CountryCollaborationId','=','co.CountryCollaborationId')
      ->where('l.LocationId', $locationID)
      ->get()
      ->toArray();

    $start3 =  date("H:i:s");
   //    echo $start1.'---'.$start3;
	//   die();
  //   echo $start.'---'.$start2.'--'.$start3;
  //   die();
     //end replace procedure



      if(!empty($searchresults[0]->LocationId)){
          $locaionid = $searchresults[0]->LocationId;

          $rest_avail = 0;
          if (!empty($searchresults)) {
              foreach ($searchresults as $searchresult) {
                  $restcheck = $searchresult->IsRestaurant;
                  if ($restcheck == 1) {
                      $rest_avail = 1;
                      break;
                  }
              }
          }

          $ismustsee = 0;
          if (!empty($searchresults)) {
              foreach ($searchresults as $searchresult) {
                  $IsMustSee = $searchresult->IsMustSee;
                  if ($IsMustSee == 1) {
                      $ismustsee = 1;
                      break;
                  }
              }
          }

      }


     $tplocname=array();
     if(!empty($searchresults[0]->tp_location_mapping_id)){
       $tplocname =  DB::table('TPLocations')->select('cityName','countryName','LocationId')->where('LocationId',$searchresults[0]->tp_location_mapping_id)->get();
     }

     $getparent = DB::table('Location')->where('LocationId', $lociID)->get();

     $locationPatent = [];

     if (!empty($getparent) && $getparent[0]->LocationLevel != 1) {
         $loopcount = $getparent[0]->LocationLevel;
         $lociID = $getparent[0]->ParentId;
         for ($i = 1; $i < $loopcount; $i++) {
             $getparents = DB::table('Location')->where('LocationId', $lociID)->get();
             if (!empty($getparents)) {
                  $locationPatent[] = [
                      'LocationId' => $getparents[0]->slugid,
                      'slug' => $getparents[0]->Slug,
                      'Name' => $getparents[0]->Name,
                  ];
                 if (!empty($getparents) && $getparents[0]->ParentId != "") {
                 $lociID = $getparents[0]->ParentId;
              }
             } else {
                 break; // Exit the loop if no more parent locations are found
             }
         }
     }
       $getrest=collect();
        if(!empty($searchresults[0]->LocationId)){
         $getrest = DB::table('Restaurant')->select('Title','RestaurantId','LocationId','Slug','Address','PriceRange')->where('LocationId',$searchresults[0]->LocationId)->get();
        }


      $experience =collect();
       if(!empty($searchresults[0]->LocationId)){
          $experience =  DB::table('Experience')->where('LocationId',$searchresults[0]->LocationId)->get();
     }

       //new code
      $percentageRecommended = 0;
      if (!empty($searchresults)) {

          foreach ($searchresults as $results) {
              $sightId = $results->SightId;

              $Sightcat = DB::table('SightCategory')
                  ->join('Category', 'SightCategory.CategoryId', '=', 'Category.CategoryId')
                  ->select('Category.Title')
                  ->where('SightCategory.SightId', '=', $sightId)
                  ->get();

              $results->Sightcat = $Sightcat;

              $timing = DB::select("SELECT * FROM SightTiming WHERE SightId = ?", [$sightId]);
              $results->timing = $timing;

          }
          //end code



      }
       //nearby hotel
          //nearby hotel

        $nearby_hotel =collect();

        /*end nearby hotels */


        $getloc = DB::table('Location')->where('LocationId',$locationID)->get();


        if(!empty($getloc)){
          $latitude = $getloc[0]->Lat;
          $longitude = $getloc[0]->Longitude ;




              //hotel list id
          //hotel list id
        $gethotellistiid =collect();
        $gethotellistiid = DB::table('Temp_Mapping as tm')
        ->select('tpl.*')
        ->join('TPLocations as tpl','tpl.locationId','=','tm.LocationId')
        ->where('tm.Tid',$locationID)
        ->get();

        $CountryId ="";
  $formattedDateTime = date("H:i:s");
             if($gethotellistiid->isEmpty()){
          $getlocid = DB::table('Location')->select('ParentId','CountryId')->where('LocationId',$locationID)->get();
          if(!$getlocid->isEmpty()){
           $CountryId =$getlocid[0]->CountryId;
          }
             }


  if($gethotellistiid->isEmpty()){
          $getlocid = DB::table('Location')->select('ParentId','CountryId')->where('LocationId',$locationID)->get();
          if(!$getlocid->isEmpty()){
              $locationID = $getlocid[0]->ParentId;
              $CountryId =$getlocid[0]->CountryId;


          $gethotellistiid = DB::table('Temp_Mapping as tm')
          ->select('tpl.*')
          ->join('TPLocations as tpl','tpl.locationId','=','tm.LocationId')
          ->where('tm.Tid',$locationID)
          ->get();
          }
  }



      if ($gethotellistiid->isEmpty()) {
          $gethotellistiid = DB::table('Temp_Mapping as tm')
              ->select('tpl.locationId')
              ->join('TPLocations as tpl', 'tpl.locationId', '=', 'tm.LocationId')
              ->join('Location as l', 'l.locationId', '=', 'tm.Tid')
              ->where('l.CountryId', $CountryId)
              ->limit(1)
              ->get();
      }

        // end hotel list id


        // end hotel list id
        }

          //end nearby hotel
      $lname  =$location_name;


     $type ="h";
      return view('listing')->with('searchresults',$searchresults)->with('searchlocation',$locn)->with('faq',$faq)->with('getSightCat',$getSightCat)->with('rest_avail',$rest_avail)->with('ismustsee',$ismustsee)->with('tplocname',$tplocname)->with('locationPatent',$locationPatent)->with('getrest',$getrest)->with('experience',$experience)->with('gethotellistiid',$gethotellistiid)->with('breadcumb',$breadcumb)->with('restaurantdata',$restaurantdata)->with('getexp',$getexp)->with('location_name',$location_name)->with('type',$type)->with('lname',$lname)->with('totalCountResults',$totalCountResults)->with('sightImages',$sightImages)->with('top_attractions',$top_attractions);
  }
  public function getrestaurents( $searchresults,$locationId)
  {

    $dist = config('custom_variables.distance_value');
    $dist = 50;
    $insertData = [];
    $getexp = [];

    if (count($searchresults) > 0) {
        foreach ($searchresults as $val) {
            $LocationId = $val->LocationId;
            $Longitude = $val->Longitude;
            $Latitude = $val->Latitude;
            $SightId = $val->SightId;

            if ($Longitude !== null && $Latitude !== null) {
                $tempWorkingData = DB::table('Restaurant as s')
                    ->join('Location as l', 's.LocationId', '=', 'l.LocationId')
                    ->select(
                        's.RestaurantId', 's.PriceRange', 's.Title', 's.Slug', 'l.slugid', 's.Address',
                        's.Latitude as Latitude', 's.Longitude as Longitude', 'l.Name as locname',
                        's.TAAggregateRating', 's.Timings', 's.PriceRange', 's.category', 's.features',
                        DB::raw('(6371 * ACOS(
                            COS(RADIANS(' . $Latitude . ')) * COS(RADIANS(s.Latitude)) *
                            COS(RADIANS(s.Longitude) - RADIANS(' . $Longitude . ')) +
                            SIN(RADIANS(' . $Latitude . ')) * SIN(RADIANS(s.Latitude))
                        )) AS distance')
                    )
                    ->whereNotNull('s.Latitude') // Check Latitude is not null
                    ->whereNotNull('s.Longitude') // Check Longitude is not null
                    ->having('distance', '<', $dist)
                    ->where('s.LocationId', $LocationId)
                    ->orderBy('distance', 'ASC')
                    ->limit(1)
                    ->get();

                foreach ($tempWorkingData as $restaurant) {
                    $restaurantArray = (array) $restaurant;
                    $restaurantArray['SightId'] = $SightId;
                    $insertData[] = $restaurantArray;
                }
            }
        }

        $locid = $locationId;

        $getexp = [];
        $processedExperiences = [];

        foreach ($searchresults as $val) {
            $LocationId = $val->LocationId;
            $Longitude = $val->Longitude;
            $Latitude = $val->Latitude;
            $SightId = $val->SightId;

            if ($Longitude !== null && $Latitude !== null) {
                $expdata1 = DB::table('Experience as e')
                    ->join('ExperienceItninerary as ei', 'e.ExperienceId', '=', 'ei.ExperienceId')
                    ->join('Sight as s', 's.SightId', '=', 'ei.SightId')
                    ->select(
                        'e.slugid', 'e.ExperienceId', 'e.Slug', 'e.viator_url', 'e.Name', 'e.adult_price',
                        'e.Img1', 'e.Img2', 'e.Img3',
                        DB::raw('(6371 * ACOS(
                            COS(RADIANS(' . $Latitude . ')) * COS(RADIANS(s.Latitude)) *
                            COS(RADIANS(s.Longitude) - RADIANS(' . $Longitude . ')) +
                            SIN(RADIANS(' . $Latitude . ')) * SIN(RADIANS(s.Latitude))
                        )) AS distance')
                    )
                    ->where('e.LocationId', $LocationId)
                    ->where('ei.ItninerarySequence', 1)
                    ->whereNotNull('ei.SightId')
                    ->whereNotNull('s.Latitude') // Ensure non-null Latitude
                    ->whereNotNull('s.Longitude') // Ensure non-null Longitude
                    ->having('distance', '<', 10)
                    ->orderBy('distance', 'ASC')
                    ->limit(3)
                    ->get();

                foreach ($expdata1 as $exp) {
                    if (!isset($processedExperiences[$exp->ExperienceId][$SightId])) {
                        $expArray = (array) $exp;
                        $expArray['SightId'] = $SightId;
                        $getexp[] = $expArray;
                        $processedExperiences[$exp->ExperienceId][$SightId] = true;
                    }
                }
            }
        }

        $end = date('Y-m-d H:i:s');

        return ['restaurant' => $insertData, 'getexp' => $getexp];
    }


  }







  public function loadMoreAttractions(Request $request)
  {
      $page = $request->input('page');
      $perPage = 10;
      $locationID = $request->input('locid');
      $explocname = $request->input('slug');


      if ($page == 1) {
          return response()->json(['html' => '']);
      }

      $offset = ($page - 1) * $perPage;

       $searchresults = DB::table('Sight as s')
          ->join('Location as l','l.LocationId','=','s.LocationId')
          ->leftJoin('Category', 's.categoryId', '=', 'Category.categoryId')
          ->leftJoin('Sight_image as img', function ($join) {
              $join->on('s.SightId', '=', 'img.Sightid');
              $join->whereRaw('img.Image = (SELECT Image FROM Sight_image WHERE Sightid = s.SightId LIMIT 1)');
             })
          ->select('s.*','l.slugid','img.Image','l.Name as LName','Category.Title as CategoryTitle')
          ->where('s.LocationId', $locationID)
        //  ->where('s.TATotalReviews', '>', 20)
		   ->orderBy('s.IsMustSee', 'asc')
          ->get();

      $attractions = collect($searchresults)
          ->slice($offset, $perPage)
          ->values();

            // set timing cat values

	  // return $result;
$sightImages = collect();
$sightIds = []; // Initialize the array to hold SightId values

if (!empty($result)) {
       $sightIds = $result->pluck('SightId')->toArray();
    if (!empty($sightIds)) {
        // Fetch sight images if $sightIds is not empty
        $sightImages = DB::table('Sight_image')
            ->whereIn('Sightid', $sightIds)
            ->get();
    }
}


if (!empty($attractions)) {

  foreach ($attractions as $results) {
      $sightId = $results->SightId;

      $Sightcat = DB::table('SightCategory')
          ->join('Category', 'SightCategory.CategoryId', '=', 'Category.CategoryId')
          ->select('Category.Title')
          ->where('SightCategory.SightId', '=', $sightId)
          ->get();

      $results->Sightcat = $Sightcat;

      $timing = DB::select("SELECT * FROM SightTiming WHERE SightId = ?", [$sightId]);
      $results->timing = $timing;

      // Retrieve reviews for the sight using a raw SQL query
      $reviews = DB::select("SELECT * FROM SightReviews WHERE SightId = ?", [$sightId]);

      // Merge the reviews into the result directly
      $results->reviews = $reviews;
  }
}


//end set timing cat val
$mergedData = [];

// Loop through attractions and associate them with categories
if (!empty($attractions)) {
  foreach ($attractions as $att) {
      if (!empty($att->Sightcat)) {
          // Loop through categories and create an associative array
          foreach ($att->Sightcat as $category) {
              if ($category->Title != "") {
                  $categoryTitle = $category->Title;
              } else {
                  $categoryTitle = '';
              };

              if (!empty($att->Latitude) && !empty($att->Longitude)) {
                  // Check if $att->timing is set and contains the required properties
                  if (isset($att->timing->timings)) {
                      // Calculate the opening and closing time
                      $schedule = json_decode($att->timing->timings, true);
                      $currentDay = strtolower(date('D'));
                      $currentTime = date('H:i');
                      $openingtime = $schedule['time'][$currentDay]['start'];
                      $closingTime = $schedule['time'][$currentDay]['end'];
                      $isOpen = false;
                      $formatetime = '';

                      if ($openingtime === '00:00' && $closingTime === '23:59') {
                          $formatetime = '12:00';
                          $closingTime = '11:59';
                      }

                      if ($currentTime >= $openingtime && $currentTime <= $closingTime) {
                          $isOpen = true;
                      }

                      $timingInfo = $isOpen ? $formatetime . ' Open Now' : 'Closed Today';
                  } else {
                      $timingInfo = '';
                  }
                    if($att->TAAggregateRating != ""  && $att->TAAggregateRating != 0){
                      $recomd = rtrim($att->TAAggregateRating, '.0') * 20;
                      $recomd = $recomd . '%';
                 }else{
                     $recomd ='--';
                 }
                 $imagepath ="";
                 if($att->Image !=""){
                        $imagepath = asset('public/sight-images/'. $att->Image) ;
                 }else{
                        $imagepath = asset('public/images/Hotel lobby.svg');
                 }



                 // cityName, tm, imagePath
                  $locationData = [
                      'Latitude' => $att->Latitude,
                      'Longitude' => $att->Longitude,
                      'SightId' => $att->SightId,
                      'ismustsee' => $att->IsMustSee,
                      'name' => $att->Title,
                      'recmd' => $recomd,
                      'cat' => $categoryTitle,
                      'tm' => $timingInfo, // Include the timing in the locationData array
                      'cityName'=>'City of '.$att->LName,
                      'imagePath'=>$imagepath,
                  ];

                  $mergedData[] = $locationData; // Add the locationData directly to mergedData
              }
          }
      } else {
          // If there are no categories, create a default "uncategorized" category
          if (!empty($att->Latitude) && !empty($att->Longitude)) {
              // Check if $att->timing is set and contains the required properties
              if (isset($att->timing->timings)) {
                  // Calculate the opening and closing time (same as above)
                  // ...
                  // ...
                 if($att->TAAggregateRating != ""  && $att->TAAggregateRating != 0){
                      $recomd = rtrim($att->TAAggregateRating, '.0') * 20;
                      $recomd = $recomd . '%';
                 }else{
                     $recomd ='Unavailable';
                 }
                 $imagepath ="";
                 if($att->Image !=""){
                        $imagepath = asset('public/sight-images/'. $att->Image) ;
                 }else{
                        $imagepath = asset('public/images/Hotel lobby.svg');
                 }

                  $locationData = [
                      'Latitude' => $att->Latitude,
                      'Longitude' => $att->Longitude,
                      'SightId' => $att->SightId,
                      'ismustsee' => $att->IsMustSee,
                      'name' => $att->Title,
                      'recmd' => $recomd,
                      'cat' => ' ',
                      'tm' => $timingInfo,
                      'cityName'=>'City of '.$att->LName,
                      'imagePath'=>$imagepath,
                  ];

                  $mergedData[] = $locationData;
              }
          }
      }
  }
}

// Encode data as JSON
$locationDataJson = json_encode($mergedData);

// Rest of your code...

          if($attractions->isEmpty()){
              return response()->json(['html' => '']);
          }
      $html = view('getloclistbycatid')->with('searchresults', $attractions)->with("sightImages",$sightImages)->with('type','loadmore')->render();

      return response()->json(['mapData' => $locationDataJson, 'html' => $html]);
  }

  public function filtersightbycat(request $request){

    $locId = $request->input('locationId');
    $catid = $request->input('catid');
    $names = $request->input('names');
    $delcatid = $request->input('delcatid');

    $clearfilter = $request->input('clearfilter');
    if($clearfilter == 1){
        foreach (request()->session()->all() as $key => $value) {
            if (str_starts_with($key, 'cat_') || str_starts_with($key, 'catid_')) {
                request()->session()->forget($key);
            }
        }
    }

    $lid = $request->session()->get('locId');
    if($lid != $locId){
        foreach ($request->session()->all() as $key => $value) {
            if (str_starts_with($key, 'catid_')) {
                $request->session()->forget($key);
            }
        }

      $request->session()->forget('locId');
      $request->session()->forget('mustSee');
      $request->session()->forget('isrestaurant');
    }
    if( $delcatid != ""){
        foreach ($request->session()->all() as $key => $value) {
            if (str_starts_with($key, 'catid_') && $value == $delcatid) {
                $request->session()->forget($key);
            }
        }
        foreach ($request->session()->all() as $key => $value) {
            if (str_starts_with($key, 'cat_')) {
                $catId = explode('_', $value)[1];

                if ($catId == $delcatid) {
                    $request->session()->forget($key);
                }
            }
        }

    }
    if($delcatid = "mustsee"){
      $request->session()->forget('mustSee');
    }
    if($delcatid = "isrestaurant"){
      $request->session()->forget('isrestaurant');
    }

    $request->session()->put('locId', $locId);

    if (!$request->session()->has('catid_' . $catid)) {
        $sessionVariableName = 'catid_' . $catid;
        $request->session()->put($sessionVariableName, $catid);

    }


    if (!$request->session()->has('cat_' . $catid)) {

        $catNameAndId = $names . '_' . $catid;

        $sessionVariableName = 'cat_' . $catid;
        $request->session()->put($sessionVariableName, $catNameAndId);
    }


    $categoryIds = [];
       $mustSee = 0;
    $isRestaurant = 0;




 foreach ($request->session()->all() as $key => $value) {
        if (str_starts_with($key, 'catid_')) {
             if ($value != 'mustsee' && $value != 'isrestaurant' && $value != null) {

                    $categoryIds[] = $value;

             }
            if ($value === 'mustsee') {
                $mustSee = 1;
                $request->session()->put('mustSee', 1);
            } elseif ($value === 'isrestaurant') {
                $isRestaurant = 1;
                $request->session()->put('isrestaurant', 1);
            }
        }
    }

    $getSight = [];
    $getSight2 = [];
    $getSight3 = [];


  $allResults = [];
$result=[];
// Fetch data based on 'mustSee' flag
//return $categoryIds
//return $request->session()->all();
// Fetch data based on category IDs
if (!empty($categoryIds) || isset($categoryIds[0])  && $categoryIds[0] == null) {

$getSightCategory = DB::table('Sight')
     ->join('Location','Location.LocationId','=','Sight.LocationId')
    ->leftJoin('Category', 'Sight.categoryId', '=', 'Category.categoryId')

    ->leftJoin('Sight_image as img', function ($join) {
        $join->on('Sight.SightId', '=', 'img.Sightid');
        $join->whereRaw('img.Image = (SELECT Image FROM Sight_image WHERE Sightid =Sight.SightId LIMIT 1)');
       })

    ->where('Sight.LocationId', $locId)
    ->whereIn('Sight.CategoryId', $categoryIds)
    ->select('Sight.SightId', 'Sight.IsMustSee', 'Sight.Title', 'Sight.TAAggregateRating', 'Sight.LocationId', 'Sight.Slug', 'IsRestaurant', 'Address', 'Sight.Latitude', 'Sight.Longitude', 'Sight.CategoryId', 'Category.Title as CategoryTitle', 'Location.Name as LName', 'Location.slugid',  'img.Image', 'Sight.TATotalReviews','Sight.ticket','Sight.MicroSummary')
  //  ->select('Category.Title as CategoryTitle', 'Sight.*','Location.slugid', 'img.Image','Location.Name as LName')
  //   ->orderByRaw("FIELD(Sight.CategoryId, " . implode(',', $categoryIds) . ")")
	  ->orderBy('Sight.IsMustSee', 'asc')
    ->get()
    ->toArray();



$result = array_merge($result, $getSightCategory);
$result = array_reverse($result);

}

if ($mustSee == 1) {
$getSightMustSee = DB::table('Sight')
    ->join('Location','Location.LocationId','=','Sight.LocationId')
    ->leftJoin('Sight_image as img', function ($join) {
        $join->on('Sight.SightId', '=', 'img.Sightid');
        $join->whereRaw('img.Image = (SELECT Image FROM Sight_image WHERE Sightid = Sight.SightId LIMIT 1)');
       })
    ->leftJoin('Category', 'Sight.categoryId', '=', 'Category.categoryId')
    ->where('Sight.LocationId', $locId)
    ->where('Sight.IsMustSee', 1)
    ->select('Sight.SightId', 'Sight.IsMustSee', 'Sight.Title', 'Sight.TAAggregateRating', 'Sight.LocationId', 'Sight.Slug', 'IsRestaurant', 'Address', 'Sight.Latitude', 'Sight.Longitude', 'Sight.CategoryId', 'Category.Title as CategoryTitle', 'Location.Name as LName', 'Location.slugid',  'img.Image', 'Sight.TATotalReviews','Sight.ticket','Sight.MicroSummary')
	->orderBy('Sight.IsMustSee', 'asc')
    //->select('Category.Title as CategoryTitle', 'Sight.*','Location.slugid', 'img.Image','Location.Name as LName')
    ->get()
    ->toArray();

$result = array_merge($result, $getSightMustSee);
if( $catid == 'mustsee'){
     $result = array_reverse($result);
}

}




$result = array_unique($result, SORT_REGULAR);
//	return $request->session()->all() ;


if (!$request->session()->has('mustSee') && !$request->session()->has('isrestaurant') && (empty($categoryIds) || $categoryIds[0] == null)) {
    $result =[];
    $result = DB::table('Sight')
    ->join('Location','Location.LocationId','=','Sight.LocationId')
    ->leftJoin('Sight_image as img', function ($join) {
        $join->on('Sight.SightId', '=', 'img.Sightid');
        $join->whereRaw('img.Image = (SELECT Image FROM Sight_image WHERE Sightid = Sight.SightId LIMIT 1)');
       })
    ->leftJoin('Category', 'Sight.categoryId', '=', 'Category.categoryId')
    ->where('Sight.LocationId', $locId)
   // ->select('Category.Title  as CategoryTitle', 'Sight.*','Location.slugid', 'img.Image','Location.Name as LName')
     ->select('Sight.SightId', 'Sight.IsMustSee', 'Sight.Title', 'Sight.TAAggregateRating', 'Sight.LocationId', 'Sight.Slug', 'IsRestaurant', 'Address', 'Sight.Latitude', 'Sight.Longitude', 'Sight.CategoryId', 'Category.Title as CategoryTitle', 'Location.Name as LName', 'Location.slugid',  'img.Image', 'Sight.TATotalReviews','Sight.ticket','Sight.MicroSummary')
		->orderBy('Sight.IsMustSee', 'asc')
    //->orderBy('Sight.TATotalReviews','desc')
    ->limit(10)
    ->get()->toArray();

}
// return $result;
$sightImages = collect();
$sightIds = []; // Initialize the array to hold SightId values

if (!empty($result)) {
    // Check if $result is an array of stdClass objects
    if (is_array($result)) {
        // Use foreach to collect SightId from each stdClass object
        foreach ($result as $sights) {
            // Ensure $sights is an object and then access the SightId
            if (is_object($sights) && isset($sights->SightId)) {
                $sightIds[] = $sights->SightId; // Collect SightId from object
            }
        }
    }

    // After collecting SightId, check if $sightIds is not empty
    if (!empty($sightIds)) {
        // Fetch sight images if $sightIds is not empty
        $sightImages = DB::table('Sight_image')
            ->whereIn('Sightid', $sightIds)
            ->get();
    }
} else {
    $result = []; // If no results, set result to empty array
}




// Final result as an array
$result = array_values($result);
//	$result = $result->toArray();
    //new code
if (!empty($result)) {

foreach ($result as $results) {
    $sightId = $results->SightId;

    $Sightcat = DB::table('SightCategory')
        ->join('Category', 'SightCategory.CategoryId', '=', 'Category.CategoryId')
        ->select('Category.Title')
        ->where('SightCategory.SightId', '=', $sightId)
        ->get();

    $results->Sightcat = $Sightcat;

    $timing = DB::select("SELECT * FROM SightTiming WHERE SightId = ?", [$sightId]);
    $results->timing = $timing;

    // Retrieve reviews for the sight using a raw SQL query
    $reviews = DB::select("SELECT * FROM SightReviews WHERE SightId = ?", [$sightId]);

    // Merge the reviews into the result directly
    $results->reviews = $reviews;
}
}


//end set timing cat val
$mergedData = [];

// Loop through attractions and associate them with categories
if (!empty($result)) {
foreach ($result as $att) {
    if (!empty($att->Sightcat)) {
        // Loop through categories and create an associative array
        foreach ($att->Sightcat as $category) {
            if ($category->Title != "") {
                $categoryTitle = $category->Title;
            } else {
                $categoryTitle = '';
            };

            if (!empty($att->Latitude) && !empty($att->Longitude)) {
                // Check if $att->timing is set and contains the required properties
                if (isset($att->timing->timings)) {
                    // Calculate the opening and closing time
                    $schedule = json_decode($att->timing->timings, true);
                    $currentDay = strtolower(date('D'));
                    $currentTime = date('H:i');
                    $openingtime = $schedule['time'][$currentDay]['start'];
                    $closingTime = $schedule['time'][$currentDay]['end'];
                    $isOpen = false;
                    $formatetime = '';

                    if ($openingtime === '00:00' && $closingTime === '23:59') {
                        $formatetime = '12:00';
                        $closingTime = '11:59';
                    }

                    if ($currentTime >= $openingtime && $currentTime <= $closingTime) {
                        $isOpen = true;
                    }

                    $timingInfo = $isOpen ? $formatetime . ' Open Now' : 'Closed Today';
                } else {
                    $timingInfo = '';
                }
                 if($att->TAAggregateRating != ""  && $att->TAAggregateRating != 0){
                    $recomd = rtrim($att->TAAggregateRating, '.0') * 20;
                    $recomd = $recomd . '%';
               }else{
                   $recomd ='--';
               }

               $imagepath ="";
               if($att->Image !=""){
                      $imagepath = asset('public/sight-images/'. $att->Image) ;
               }else{
                      $imagepath = asset('public/images/Hotel lobby.svg');
               }
                $locationData = [
                    'Latitude' => $att->Latitude,
                    'Longitude' => $att->Longitude,
                    'SightId' => $att->SightId,
                    'ismustsee' => $att->IsMustSee,
                    'name' => $att->Title,
                    'recmd' => $recomd,
                    'cat' => $categoryTitle,
                    'tm' => $timingInfo, // Include the timing in the locationData array
                    'cityName'=>'City of '.$att->LName,
                    'imagePath'=>$imagepath,
                ];

                $mergedData[] = $locationData; // Add the locationData directly to mergedData
            }
        }
    } else {
        // If there are no categories, create a default "uncategorized" category
        if (!empty($att->Latitude) && !empty($att->Longitude)) {
            // Check if $att->timing is set and contains the required properties
            if (isset($att->timing->timings)) {

               if($att->TAAggregateRating != ""  && $att->TAAggregateRating != 0){
                    $recomd = rtrim($att->TAAggregateRating, '.0') * 20;
                   $recomd = $recomd . '%';
               }else{
                   $recomd ='--';
               }
               $imagepath ="";
               if($att->Image !=""){
                      $imagepath = asset('public/sight-images/'. $att->Image) ;
               }else{
                      $imagepath = asset('public/images/Hotel lobby.svg');
               }
                $locationData = [
                    'Latitude' => $att->Latitude,
                    'Longitude' => $att->Longitude,
                    'SightId' => $att->SightId,
                    'ismustsee' => $att->IsMustSee,
                    'name' => $att->Title,
                    'recmd' => $recomd,
                    'cat' => ' ',
                    'tm' => $timingInfo,
                    'cityName'=>'City of '.$att->LName,
                    'imagePath'=>$imagepath,
                ];

                $mergedData[] = $locationData;
            }
        }
    }
}
}

	    $result = array_reverse($result);
//return print_r($result);
// Encode data as JSON
$locationDataJson = json_encode($mergedData);

    $html = view('getloclistbycatid')->with('searchresults', $result)->with('sightImages',$sightImages)->with('type','filter')->render();

return response()->json(['mapData' => $locationDataJson, 'html' => $html]);

}

    public function explore(request $request,$id)
    {
        $pt = $request->input('sloc');

        $sighid =null;
        $locationID=null;
        $slug ="";

        $parts = explode('-', $id);
        $locationID = $parts[0];
        $sighid = $parts[1];
        array_shift($parts);
        array_shift($parts);
        $slug = implode('-', $parts);

		$locid =	$locationID;

		// get parent
     $getparent1 = DB::table('Location')->select('LocationId')->where('slugid', $locationID)->get();

     if (!$getparent1->isEmpty()){
        $locationID = $getparent1[0]->LocationId;
	 }else{
	  if ($locid != null) {

				 $checkgetloc = DB::table('Location')
					 ->select('slugid')
					 ->where('LocationId', $locid)
					 ->get();


				 if(!$checkgetloc->isEmpty()){
					 $lid =  $checkgetloc[0]->slugid;

					 return redirect()->route('sight.details', [$lid.'-'.$sighid.'-'.$slug]);
				 }



			 }

		   abort(404, 'NOT FOUND');
	 }

     $lname ="";


        //stored procedure to query start
     $searchresults = DB::table('Sight')
      ->Leftjoin('Location', 'Sight.LocationId', '=', 'Location.LocationId')
      ->Leftjoin('Country', 'Location.CountryId', '=', 'Country.CountryId')
 ->Leftjoin('Category', 'Sight.CategoryId', '=', 'Category.CategoryId')
 ->select('Sight.Title','Sight.Address','Sight.SightId','Sight.LocationId','Sight.Longitude','Sight.Latitude','Sight.TAAggregateRating','Sight.About','Sight.Phone' , 'Sight.Website', 'Sight.CategoryId','Sight.TATotalReviews', 'Location.Name', 'Location.Slug as Lslug', 'Country.Name as countryName','Location.slugid','Sight.IsMustSee','Sight.duration','Sight.ReviewSummaryLabel','Sight.ReviewSummary','Sight.Award','Sight.Award_description','Sight.Email','Sight.MetaTagTitle','Sight.MetaTagDescription')
      ->where('Sight.SightId', $sighid)
      ->where('Location.LocationId', $locationID)
      ->where('Sight.Slug', $slug)
      ->get()->toArray();
   // return print_r( $searchresults);
		 if(empty($searchresults)){


			 if ($locid != null) {

				 $checkgetloc = DB::table('Location')
					 ->select('slugid')
					 ->where('LocationId', $locid)
					 ->get();


				 if(!$checkgetloc->isEmpty()){
					 $lid =  $checkgetloc[0]->slugid;

					 return redirect()->route('sight.details', [$lid.'-'.$sighid.'-'.$slug]);
				 }



			 }

		   abort(404, 'NOT FOUND');
		  }

          $lname =$searchresults[0]->Name;

		// get parent
        $get_nearby_rest = DB::table('Sight_nearby_restaurant')->where('SightId',$sighid)->get();

  $getparent = DB::table('Location')->select('LocationLevel','ParentId')->where('slugid', $locationID)->get();
       // return print_r($getparent );
     $locationPatent = [];
     if (!$getparent->isEmpty()){
     //   $locationID = $getparent[0]->LocationId;
     if ( $getparent[0]->LocationLevel != 1) {
         $loopcount = $getparent[0]->LocationLevel;
         $lociID = $getparent[0]->ParentId;
         for ($i = 1; $i < $loopcount; $i++) {
             $getparents = DB::table('Location')->select('LocationId','Slug','ParentId','Name')->where('LocationId', $lociID)->get();
             if (!empty($getparents)) {
                  $locationPatent[] = [
                      'LocationId' => $getparents[0]->LocationId,
                      'slug' => $getparents[0]->Slug,
                      'Name' => $getparents[0]->Name,
                  ];
                 if (!empty($getparents) && $getparents[0]->ParentId != "") {
                    $lociID = $getparents[0]->ParentId;
                 }
             } else {
                 break;
             }
         }
     }
  }
  // end parent
		   $breadcumb  = DB::table('Location as l')
          ->select('l.CountryId', 'l.Name as LName', 'l.Slug as Lslug', 'co.Name as CountryName','l.LocationId','co.slug as cslug','co.CountryId','cont.Name as ccName','cont.CountryCollaborationId as contid','l.slugid')
          ->Join('Country as co', 'l.CountryId', '=', 'co.CountryId')
          ->leftJoin('CountryCollaboration as cont','cont.CountryCollaborationId','=','co.CountryCollaborationId')
          ->where('l.LocationId', $locationID)
          ->get()
          ->toArray();
     // $sightimages = DB::table('SightImages')->where('SightId',$sighid)->get();
   $sightreviews = DB::table('SightReviews')->whereNotNull('SightReviews.Name')->select('SightReviews.Name','SightReviews.ReviewDescription','SightReviews.IsRecommend','SightReviews.ReviewRating','SightReviews.CreatedDate')->where('SightReviews.SightId',$sighid)->limit(20)->get();


     $faq = DB::table('SightListingDetailFaq')->select('SightListingDetailFaq.Faquestion','SightListingDetailFaq.Answer')->where('SightListingDetailFaq.SightId',$sighid)->get()->toArray();


      //stored procedure to query end


      $nearby_sight=collect();
      $getcat =collect();
      $nearbyatt =collect();
      $gettiming =collect();
      $nearby_hotel =collect();
      $within ="";

      if(!empty($searchresults)) {

       $getcat = DB::table('SightCategory')
              ->join('Category','Category.CategoryId','=','SightCategory.CategoryId')
		   	   ->select('Category.Title')
              ->where('SightCategory.SightId',$searchresults[0]->SightId)
              ->distinct('SightCategory.CategoryId')
              ->get();
        $gettiming = DB::table('SightTiming')->select('SightTiming.main_hours','SightTiming.timings')->where('SightTiming.SightId',$searchresults[0]->SightId)->get();

        $longitude = $searchresults[0]->Longitude;
        $latitude = $searchresults[0]->Latitude;
        $LocationId = $searchresults[0]->LocationId;
        $sightid = $searchresults[0]->SightId;
        $locationIds = array_column($locationPatent, 'LocationId');

        if( $latitude =="" || $longitude==""){
            //$LocationId
            $getsight = DB::table('Sight')->select('Latitude','Longitude','SightId')->where('LocationId',$LocationId)->whereNotNull('Latitude')->whereNotNull('Longitude')->limit(1)->get();

            if(!$getsight->isEmpty()){
                $longitude = $getsight[0]->Longitude;
                $latitude = $getsight[0]->Latitude;
            }else{

                $getsight = DB::table('Location as l')
                ->join('Sight as s', 'l.LocationId', '=', 's.LocationId')
                ->select('s.Latitude','s.Longitude','s.SightId')
                ->whereIn('l.LocationId', $locationIds)
                ->whereNotNull('s.Latitude')
                ->whereNotNull('s.Longitude')
                ->limit(1)
                ->get();



                if(!$getsight->isEmpty()){
                    $longitude = $getsight[0]->Longitude;
                    $latitude = $getsight[0]->Latitude;
                }

            }

        }


          if($longitude !="" && $latitude !=""){

              $searchradius = 50;
              $attempts = 0;
              $maxAttempts = 3;





                $nearby_sight =  DB::table('Sight_nearby_sights')->where('Sid',$sightid)->orderby('distance','asc')->get();
                $nearbyatt = DB::table('Sight_nbsight')->where('Sid',$sightid)->get();
            	$nearby_hotel =  DB::table('Sight_nearby_hotels')->where('SightId',$sightid)->get();

             }

                //start experience


                $get_experience = DB::table('ExperienceItninerary as e')
                ->join('Experience as exp', 'exp.ExperienceId', '=', 'e.ExperienceId')
                ->leftJoin('ExperienceReview as rr', 'exp.ExperienceId', '=', 'rr.ExperienceId')
					->select('exp.Img1','exp.Img2','exp.Img3','exp.slugid','exp.ExperienceId',
							 'exp.Slug','exp.Name','exp.viator_url','exp.Duration','exp.Cost','exp.TAAggregationRating',DB::raw("COUNT(rr.Id) as review_count"))
                ->where('e.SightId', $sighid)
                ->groupBy('exp.ExperienceId')
                ->orderBy('TAAggregationRating', 'desc')
                ->limit(4)
                ->get();
              //  end experience
          }

                $Sight_image = DB::table('Sight_image')
				->select('Sight_image.Image')
                ->where('Sightid',$sightid)
                ->get();

     return view('sightdetails')->with('searchresult',$searchresults)
	 ->with('get_experience', $get_experience)
     ->with('sightreviews',$sightreviews)
     ->with('faq',$faq)
     ->with('sloc',$pt)
     ->with('locationPatent',$locationPatent)
     ->with('nearby_sight',$nearby_sight)
     ->with('nearbyatt',$nearbyatt)
    ->with('getcat',$getcat)
    ->with('gettiming',$gettiming)
    ->with('nearby_hotel',$nearby_hotel)
    ->with('breadcumb',$breadcumb)
    ->with('Sight_image',$Sight_image)
    ->with('type','explore')
    ->with('lname',$lname)
    ->with('get_nearby_rest',$get_nearby_rest);

    }
      public function save_sight_nb_hotel(request $request){

        $latitude = $request->get('Latitude');
        $longitude = $request->get('Longitude');
        $sightId = $request->get('sightId');
        $nbh = 0;
        $nbs = 0;
        $nearatt = 0;
        $nearrest =0;
        if($latitude != "" && $longitude !=""){
            $get_nearby_hotel = DB::table('Sight_nearby_hotels')->where('SightId',$sightId)->get();


            if (!$get_nearby_hotel->count() >= 4) {

                $nbh = 1;
                $searchradius = 50;
                $nearby_hotel = DB::table("TPHotel")
                    ->join('Temp_Mapping as m','m.LocationId','=','TPHotel.location_id')
                    //->join('Location as l','l.LocationId','=','m.Tid')
                   ->select('m.slugid','TPHotel.id', 'TPHotel.name','TPHotel.location_id','TPHotel.slug','TPHotel.address','TPHotel.pricefrom','TPHotel.stars','TPHotel.hotelid',
                        DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                        * cos(radians(TPHotel.Latitude))
                        * cos(radians(TPHotel.longnitude) - radians(" . $longitude . "))
                        + sin(radians(" . $latitude . "))
                        * sin(radians(TPHotel.Latitude))) AS distance"))
                    ->having('distance', '<=', $searchradius)
                    ->orderBy('distance')
                    ->limit(4)
                    ->get();

                if(!$nearby_hotel->isEmpty()){

                    foreach ($nearby_hotel as $nearby_hotels) {
                        $slug = $nearby_hotels->slug;
                        $Title = $nearby_hotels->name;
                        $LocationId = $nearby_hotels->slugid;
                        $distance = round($nearby_hotels->distance,2);
                        $address = $nearby_hotels->address;

                        $id = $nearby_hotels->id;

						$pricefrom = $nearby_hotels->pricefrom;
                        $stars = $nearby_hotels->stars;
                        $hotel_id = $nearby_hotels->hotelid;

                        $data3= array(
                            'name'=>$Title,
                            'slug'=>$slug,
                            'hotelid'=>$id,
                            'location_id'=>$LocationId,
                            'distance'=>$distance,
                            'radius'=>$searchradius,
                            'address'=>$address,
                            'SightId'=>$sightId,
                            'dated'=>now(),


							'pricefrom'=>$pricefrom,
                            'stars'=>$stars,
                            'hotel_id'=>$hotel_id,
                        );


                        $insertdata3 = DB::table('Sight_nearby_hotels')->insert($data3);
                    //   return print_r($data2);
                    }


                }
            }

    //end nearby hotel



            //Nearby Attractions

            $get_nearby_sight = DB::table('Sight_nbsight')->where('Sid',$sightId)->get();


            if (!$get_nearby_sight->count() >= 4) {

                $nearatt = 1;
                $sradius = 50;
                $nearbyatt = DB::table("Sight")
                ->leftJoin('SightTiming','SightTiming.SightId','=','Sight.SightId')
                ->leftJoin('SightCategory', 'SightCategory.SightId', '=', 'Sight.SightId')
                ->leftJoin('Category', 'Category.CategoryId', '=', 'SightCategory.CategoryId')
                ->leftJoin('Location as l', 'l.LocationId', '=', 'Sight.LocationId')
                    ->select('Sight.SightId', 'Sight.Title','l.slugid','Sight.Slug','Sight.Address','SightTiming.timings','Sight.TAAggregateRating','Category.Title as ctitle',
                        DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                        * cos(radians(Sight.Latitude))
                        * cos(radians(Sight.Longitude) - radians(" . $longitude . "))
                        + sin(radians(" . $latitude . "))
                        * sin(radians(Sight.Latitude))) AS distance"))

                    ->having('distance', '<=', $sradius)
					 ->where('Sight.SightId', '!=', $sightId)
                    ->orderBy('distance')
                    ->limit(4)
                    ->get();

       //  return print_r($nearbyatt );
                if(!$nearbyatt->isEmpty()){

                    $recordWithLargestDistance = $nearbyatt->last();

                    // Access the distance using $recordWithLargestDistance->distance
                    $largestDistance = round($recordWithLargestDistance->distance, 2);

                    if ($largestDistance < 1) {
                        $within = 1;
                    } elseif ($largestDistance < 5) {
                        $within = 5;
                    } elseif ($largestDistance < 10) {
                        $within = 10;
                    } elseif ($largestDistance < 20) {
                        $within = 20;
                    } elseif ($largestDistance < 50) {
                        $within = 50;
                    } else {

                        $within = null;
                    }

                    foreach ($nearbyatt as $nearbyatts) {

                        $Slug = $nearbyatts->Slug;
                        $Title = $nearbyatts->Title;
                        $LocationId = $nearbyatts->slugid;
                        $distance = round($nearbyatts->distance,2);
                        $id = $nearbyatts->SightId;
                        $ctitle = $nearbyatts->ctitle;
                        $Address = $nearbyatts->Address;
                        $timings = $nearbyatts->timings;
                        $TAAggregateRating = $nearbyatts->TAAggregateRating;





                        $data1= array(
                            'Title'=>$Title,
                            'SightId'=>$id,
                            'Slug'=>$Slug,
                            'LocationId'=>$LocationId,
                            'distance'=>$distance,
                            'radius'=>$within,
                            'Sid'=>$sightId,
                            'ctitle'=>$ctitle,
                            'Address'=>$Address,
                            'timings'=>$timings,
                            'TAAggregateRating'=>$TAAggregateRating,
                            'dated'=>now(),
                        );


                        $insertdata3 = DB::table('Sight_nbsight')->insert($data1);
                    //   return print_r($data2);
                    }


                }
            }

            //Nearby Attractions



            //nearby restaurant

            $get_nearby_rest = DB::table('Sight_nearby_restaurant')->where('SightId',$sightId)->get();


            if (!$get_nearby_rest->count() >= 4) {

                $nearrest =1;
                $restradus = 5;
                $nearby_rest = DB::table("Restaurant as r")
                ->leftJoin('RestaurantReview as rr', 'r.RestaurantId', '=', 'rr.RestaurantId')
                ->select('r.Title','r.TATrendingScore','r.slugid','r.RestaurantId','r.Slug',
                        DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                        * cos(radians(r.Latitude))
                        * cos(radians(r.Longitude) - radians(" . $longitude . "))
                        + sin(radians(" . $latitude . "))
                        * sin(radians(r.Latitude))) AS distance"),
                        DB::raw("COUNT(rr.RestaurantReviewId) as review_count"))
                ->groupBy("r.RestaurantId")
                ->having('distance', '<=', $restradus)
                ->orderBy('distance')
                ->limit(4)
                ->get();
        //  return print_r($nearby_sight);
                if(!$nearby_rest->isEmpty()){

                    $data_rest = [];

                    foreach ($nearby_rest as $restaurant) {
                        $data_rest[] = [
                            'SightId' => $sightId,
                            'RestaurantId' => $restaurant->RestaurantId,
                            'radius' => $restradus,
                            'slugid' => $restaurant->slugid,
                            'Slug' => $restaurant->Slug,
                            'Title' => $restaurant->Title,
                            'distance' => $restaurant->distance,
                            'TATrendingScore' => $restaurant->TATrendingScore,
                            'review_count' => $restaurant->review_count,
                        ];
                    }

                    DB::table('Sight_nearby_restaurant')->insert($data_rest);


                }
            }



            //end nearby restaurant



        }

        if($nbh == 1 ||  $nbs == 1 || $nearatt==1 || $nearrest==1){

           $nearby_hotel =  DB::table('Sight_nearby_hotels')->where('SightId',$sightId)->get();
           $html3 = view('explore_results.sight_nearby_hotels',['nearby_hotel'=>$nearby_hotel])->render();


           $nearbyatt =  DB::table('Sight_nbsight')->where('Sid',$sightId)->get();
           $nearbyattCount = $nearbyatt->count();
           $html4 = view('explore_results.nearby_attraction',['nearbyatt'=>$nearbyatt,'nearbyattCount'=> $nearbyattCount])->render();
           $html4 = (string) $html4;

           $nearby_rest =  DB::table('Sight_nearby_restaurant')->where('SightId',$sightId)->get();
           $nearbyattrest = $nearby_rest->count();
           $html5 = view('explore_results.nearby_restaurant',['get_nearby_rest'=>$nearby_rest,'nearbyattrest'=>$nearbyattrest])->render();
           $html5 = (string) $html5;
           return response()->json([ 'html' => $html3,'html4'=>$html4,'html5'=>$html5]);
       }
    }



    public function landing()
    {
       // $searchresults = DB::select("CALL landingpage($slug)");

        //echo "<pre>";
       // print_r($searchresults);

        print_r(now());


       return view('landingpage');
    }
	public function hotel_list($segment,request $request)
    {
    $id = null;
    $slug = null;
    $desiredId = null;
   		$st="";
		$amenity="";
		if($request->get('st') !=""){
			$st =trim($request->get('st')) ;
		}
		if($request->get('amenity') !=""){
			$amenity = trim(str_replace('_',' ',$request->get('amenity')) );
		}
   // return $amenity;
    // Split segment by '-' to separate the ID and slug
    $parts = explode('-', $segment);
    if (count($parts) > 1) {
        $id = array_shift($parts);
        $slug = implode('-', $parts);
    }

   $metadata =collect();
    $filterPattern = '/(fl[a-z]+[0-9a-zA-Z_]+)/';


		preg_match_all($filterPattern, $slug, $matches);

		if (!empty($matches[0])) {
			foreach ($matches[0] as $filter) {

				$filterType = substr($filter, 0, 3);
				$filterValue= substr($filter, 3);


				$slug = str_replace($filter, '', $slug);
			}


			$slug = trim($slug, '-');
		}

		$explocname = $slug;
		$slgid = $id;
		$desiredId = $id;
		$agencyData =[];

        $searchresultscount=0;
        $guest =null;
        $Tid =null;
        $hotel = null;
        $gethoteltype = collect();
        $getlocationexp = collect();
        $searchresults =collect();
        $countryname ="";
        $lname ="";
        $hlid="";
        $pagetype="";

        $chkin = $request->get('checkin');
        $checout = $request->get('checkout');

        $count_result = null;

        if( $chkin !="" && $checout !=""){
  			 session()->forget('filterd');
            $pagetype="withdate";
            $chkin = $this->formatDate($chkin);
            $checout = $this->formatDate($checout);
            $getval =  $chkin .'_'. $checout;
            $rooms = $request->get('rooms');
            $guest = $request->get('guest')  ?: 1;
            $slug = $segment;
            $locationid =  $request->get('locationid')?: $request->get('lid');
            session([
                'checkin' => $getval,
                'rooms' => $rooms,
                'guest' => $guest,
				 'slug' => $slug,
                'slugid'=>$locationid,
            ]);
            $fullname = "";
            $tplocationid =$locationid;
            $getloclink = DB::table('Temp_Mapping')
                ->select('LocationId', 'Tid','cityName','countryName','fullName')
                ->where('slugid', $locationid)
                ->first();

            // return   print_r($getloclink);
            if ($getloclink) {
                $locationid = $getloclink->LocationId;
                $tplocationid = $locationid;
                $Tid = $getloclink->Tid;
            }


            $locationPatent =[];

			$metadata = DB::table('Location')->select('HotelTitleTag','HotelMetaDescription','MetaTagTitle','MetaTagDescription')->where('slugid', $slgid)->get();

            $gethoteltype = DB::table('TPHotel_types')->orderby('hid','desc')->get();

          //  $getloc = DB::table('TPLocations')->select('fullName','cityName','countryName')->where('id',$locationid)->first();

            if (!$getloclink) {
                abort(404, 'Not FOUND');
            }
            if($fullname ==""){
                $fullname = $getloclink->fullName;
            }
            $lname = $getloclink->cityName;
            $countryName = $getloclink->countryName;

            $countryname  = $getloclink->countryName;

            $getloclink =collect();
            $getcontlink =collect();

            //start session
            $searchEntry = [
                'checkin' => $chkin,
                'checkout' => $checout,
                'rooms' => $rooms,
                'guest' => $guest,
                'slug' => $segment,
                'locationid' => $desiredId,
                'fullname' => $fullname,
            ];
            $recentSearches = session('recent_searches', []);
            $exists = false;
            foreach ($recentSearches as $entry) {
                if ($entry['locationid'] == $searchEntry['locationid']) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $recentSearches[] = $searchEntry;
                if (count($recentSearches) > 4) {
                    $recentSearches = array_slice($recentSearches, -4);
                }
                session(['recent_searches' => $recentSearches]);
            }
            //  $end =  date("H:i:s");
            //  return $start.'=='.$end;
            //end session

            //api code
            $checkinDate =  $chkin;
            $checkoutDate = $checout;
            $adultsCount = $guest;
            $customerIP = '49.156.89.145';
            $childrenCount = '1';
            $chid_age = '10';
            $lang = 'en';
            $currency ='USD';
            $waitForResult ='0';
            $iata= $tplocationid;
            $TRAVEL_PAYOUT_TOKEN = "27bde6e1d4b86710997b1fd75be0d869";
            $TRAVEL_PAYOUT_MARKER = "299178";
            $SignatureString = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$adultsCount.":".
                $checkinDate.":".
                $checkoutDate.":".
                $chid_age.":".
                $childrenCount.":".
                $iata.":".
                $currency.":".
                $customerIP.":".
                $lang.":".
                $waitForResult;
            $signature = md5($SignatureString);

            $url ='http://engine.hotellook.com/api/v2/search/start.json?cityId='.$iata.'&checkIn='. $checkinDate.'&checkOut='.$checkoutDate.'&adultsCount='.$adultsCount.'&customerIP='.$customerIP.'&childrenCount='.$childrenCount.'&childAge1='.$chid_age.'&lang='.$lang.'&currency='.$currency.'&waitForResult='.$waitForResult.'&marker=299178&signature='.$signature;

            $response = Http::withoutVerifying()->get($url);

            if ($response->successful()) {
                $data = json_decode($response);
                if(!empty($data)){
                    $searchId = $data->searchId;
                    $limit = 40;
                    $offset=0;
                    $roomsCount=0;
                    $sortAsc=0;
                    $sortBy='stars';
                    $SignatureString2 = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$limit.":".$offset.":".$roomsCount.":".$searchId.":".$sortAsc.":".$sortBy;
                    $sig2 =  md5($SignatureString2);
                    $url2 = 'http://engine.hotellook.com/api/v2/search/getResult.json?searchId='.$searchId.'&limit=40&sortBy=stars&sortAsc=0&roomsCount=0&offset=0&marker=299178&signature='.$sig2;


                    //new code

                      $maxAttempts = 6;
                      $retryInterval = 2;
                      $status = 0; // Default status

                      try {
                          // Make the HTTP request with retries
                          $response2 = Http::withoutVerifying()
                              ->timeout(0)
                              ->retry($maxAttempts, $retryInterval)
                              ->get($url2);


                          $responseData = $response2->json();


                          if (isset($responseData['errorCode']) && $responseData['errorCode'] === 4) {
                              $status = 4;
                          } else {
                              $status = 1;
                          }

                          // If the status indicates a successful search
                      if ($status == 1 && $response2->successful()) {

                          $hotel = json_decode($response2);
						  //start agency code
                          $agencyData = [];
                          foreach ($hotel->result as $hotelData) {
                              foreach ($hotelData->rooms as $room) {
                                  $agencyName = $room->agencyName;

                                  if (!in_array($agencyName, $agencyData)) {
                                      $agencyData[] = $agencyName;
                                  }
                              }
                          }
                           //end agency code

                          $idArray = array_column($hotel->result, 'id');
                          $idArray = array_filter($idArray, function ($ids) {
                              return isset($ids);
                          });
                          $idArray = array_unique($idArray);

                           $searchresults = DB::table('TPHotel as h')
      ->select('h.hotelid','h.id', 'h.name', 'h.slug','h.stars','h.rating', 'h.amenities', 'h.distance','h.slugid','h.room_aminities','h.CityName','h.short_description','h.Latitude','h.longnitude','h.MicroSummary',
                             // DB::raw('GROUP_CONCAT(DISTINCT a.name ORDER BY a.name SEPARATOR ", ") as amenity_names'))
			      DB::raw('GROUP_CONCAT(CONCAT(a.shortName, "|", a.image) ORDER BY a.name SEPARATOR ", ") as amenity_info'))
                                ->leftJoin('TPHotel_amenities as a', DB::raw('FIND_IN_SET(a.id, h.shortFacilities)'), '>', DB::raw('0'))
                              ->whereIn('h.hotelid',$idArray)
                              ->whereNotNull('h.slugid')
                              ->groupBy('h.hotelid', 'h.id', 'h.name', 'h.slug', 'h.stars', 'h.rating', 'h.amenities', 'h.distance', 'h.slugid', 'h.room_aminities', 'h.CityName')
                              ->get();

                          $count_result = count($searchresults);
                       }

                  } catch (\Exception $e) {

                          $searchresults =collect();
                  }




                   // end new code

                }

            } else {

                //  return 2;
            }

  			  /*breadcrumb*/
            $getloclink =collect();

            $getloclink = DB::table('Location as l')
            ->select('l.LocationLevel','l.ParentId','l.LocationId','l.Slug')
            ->where('l.slugid', $desiredId)
            ->limit(1)
            ->get();

            $getcontlink =collect();
            $getcontlink = DB::table('Country as co')
                ->join('Location as l', 'l.CountryId', '=', 'co.CountryId')
                ->join('CountryCollaboration as cont','cont.CountryCollaborationId','=','co.CountryCollaborationId')
                ->select('co.CountryId','co.Name','co.slug','cont.Name as cName','cont.CountryCollaborationId as contid')
                ->where('l.LocationId', $getloclink[0]->LocationId)
                ->get();

            $locationPatent = [];
            if(!$getloclink->isEmpty()){
              //  $Tid = $getloclink[0]->Tid;
               // $locationid = $getloclink[0]->LocationId;
                $getlocationexp = DB::table('Location')->select('slugid','LocationId','Name','Slug')->where('LocationId',  $getloclink[0]->LocationId)->get();

                if (!$getloclink->isEmpty() &&  $getloclink[0]->LocationLevel != 1) {
                    $loopcount =  $getloclink[0]->LocationLevel;

                    $lociID = $getloclink[0]->ParentId;
                    for ($i = 1; $i < $loopcount; $i++) {
                        $getparents = DB::table('Location')->select('slugid','LocationId','Name','Slug','ParentId')->where('LocationId', $lociID)->get();
                        if (!empty($getparents)) {
                            $locationPatent[] = [
                                'LocationId' => $getparents[0]->slugid,
                                'slug' => $getparents[0]->Slug,
                                'Name' => $getparents[0]->Name,
                            ];
                            if (!empty($getparents) && $getparents[0]->ParentId != "") {
                                $lociID = $getparents[0]->ParentId;
                            }
                        } else {
                            break;
                        }
                    }
                }
            }

            /*breadcrumb*/

        }else{
            $pagetype="withoutdate";
            $getloc = DB::table('Temp_Mapping as tm')
                // ->leftjoin('TPLocations as l', 'l.id', '=', 'tm.LocationId')
                // ,'l.location'
                ->select('tm.LocationId','tm.cityName','tm.countryName')
                ->where('tm.slugid', $desiredId)
                ->where('tm.slug', $slug)
                ->limit(1)
                ->get();

            if($getloc->isEmpty()){
                if($id){
                    $checkgetloc = DB::table('Temp_Mapping as tm')
                        ->select('tm.slugid','tm.slug')
                        ->where('tm.Tid', $id)
                        ->limit(1)
                        ->get();
                    if(!$checkgetloc->isEmpty()){
                        $id =  $checkgetloc[0]->slugid;
                        $slug = $checkgetloc[0]->slug;
                        return redirect()->route('hotel.list', [$id.'-'.$slug]);
                    }
                    // Redirect to the new URL
                    $checkgetloc2 = DB::table('Temp_Mapping as tm')
                        ->select('tm.slugid','tm.slug')
                        ->where('tm.LocationId', $id)
                        ->get();
                    if(!$checkgetloc2->isEmpty()){
                        $id =  $checkgetloc2[0]->slugid;
                        $slug = $checkgetloc[0]->slug;
                        return redirect()->route('hotel.list', [$id.'-'.$slug]);
                    }

                }
                abort(404,'Not found');
            }
            if(!$getloc->isEmpty()){
                $desiredId =  $getloc[0]->LocationId;
                $lname = $getloc[0]->cityName;
                $countryname = $getloc[0]->countryName;
            }

            $locationid =  $desiredId;


            // header searchbar link
            $hlid =$desiredId;

            $locationgeo ="";



            $gethoteltype = DB::table('TPHotel_types')->orderby('hid','desc')->get();

            $getloclink =collect();


            $getloclink = DB::table('Temp_Mapping as tm')
                ->join('Location as l', 'l.LocationId', '=', 'tm.Tid')
                ->select('l.LocationLevel','l.ParentId','l.LocationId','l.Slug','tm.Tid')
                ->where('tm.LocationId', $desiredId)
                ->limit(1)
                ->get();


            $getcontlink =collect();

            $getcontlink = DB::table('Country as co')
                ->join('Location as l', 'l.CountryId', '=', 'co.CountryId')
                ->join('CountryCollaboration as cont','cont.CountryCollaborationId','=','co.CountryCollaborationId')
                ->select('co.CountryId','co.Name','co.slug','cont.Name as cName','cont.CountryCollaborationId as contid')
                ->where('l.LocationId', $getloclink[0]->LocationId)
                ->get();




            $locationPatent = [];
            if(!$getloclink->isEmpty()){
                $Tid = $getloclink[0]->Tid;
                $locationid = $getloclink[0]->LocationId;
                $getlocationexp = DB::table('Location')->select('slugid','LocationId','Name','Slug')->where('LocationId', $locationid)->get();

                if (!$getloclink->isEmpty() &&  $getloclink[0]->LocationLevel != 1) {
                    $loopcount =  $getloclink[0]->LocationLevel;

                    $lociID = $getloclink[0]->ParentId;
                    for ($i = 1; $i < $loopcount; $i++) {
                        $getparents = DB::table('Location')->select('slugid','LocationId','Name','Slug','ParentId')->where('LocationId', $lociID)->get();
                        if (!empty($getparents)) {
                            $locationPatent[] = [
                                'LocationId' => $getparents[0]->slugid,
                                'slug' => $getparents[0]->Slug,
                                'Name' => $getparents[0]->Name,
                            ];
                            if (!empty($getparents) && $getparents[0]->ParentId != "") {
                                $lociID = $getparents[0]->ParentId;
                            }
                        } else {
                            break;
                        }
                    }
                }
            }


         $metadata = DB::table('Location')->select('HotelTitleTag','HotelMetaDescription','MetaTagTitle','MetaTagDescription')->where('slugid', $slgid)->get();

         $searchresults = DB::table('TPHotel as h')
		->leftJoin('TPHotel_amenities as a', DB::raw('FIND_IN_SET(a.id, h.shortFacilities)'), '>', DB::raw('0')) // Join with amenities
		->select(
			'h.hotelid',
			'h.id',
			'h.name',
			'h.slug',
			'h.stars',
			'h.pricefrom',
			'h.rating',
			'h.amenities',
			'h.distance',
			'h.image',
			'h.about',
			'h.room_aminities',
			'h.shortFacilities',
			'h.slugid',
			'h.CityName',
		    'h.short_description',
			 'h.ReviewSummary',
			 'h.Latitude',
			 'h.longnitude',
			 'h.OverviewShortDesc',
		//	DB::raw('GROUP_CONCAT(a.name ORDER BY a.name SEPARATOR ", ") as amenity_names') // Aggregated amenity names
			    DB::raw('GROUP_CONCAT(CONCAT(a.shortName, "|", a.image) ORDER BY a.name SEPARATOR ", ") as amenity_info')
		)
		->where('h.slugid', $slgid)
		->whereNotNull('h.slugid') ;

			if (!empty($st)) {
				$searchresults->where('h.stars', $st);
			}
			if (!empty($amenity)) {

				$searchresults->whereExists(function($subquery) use ($amenity) {
					$subquery->select(DB::raw(1))
						->from('TPHotel_amenities as a2')
						->whereRaw('FIND_IN_SET(a2.id, h.shortFacilities)')
						->where('a2.name', 'LIKE', '%' . trim($amenity) . '%');
				});
			}
		$searchresults->orderBy(DB::raw('h.short_description IS NULL'), 'asc');
		// Group by necessary columns
		$searchresults->groupBy('h.id');
		$searchresults = $searchresults->limit(20)
		->get();
		$count_result = count($searchresults);



        }



        //return print_r($gethoteltype);

        $type = "hotel";
        return view('hotel_listing')->with('searchresults',$searchresults)->with('hotels',$hotel)
			  ->with('metadata',$metadata)
			 ->with('agencyData',$agencyData)
			->with('st',$st)
            ->with('amenity',$amenity)
            ->with('pagetype',$pagetype)
            ->with('gethoteltype',$gethoteltype)
            ->with('lname',$lname)
            ->with('countryname',$countryname)
            // ->with('locationgeo',$locationgeo)
            ->with('id',$id)
            ->with('locationPatent',$locationPatent)
            ->with('getlocationexp',$getlocationexp)
            ->with('getcontlink',$getcontlink)
            ->with('Tid',$Tid)
            ->with('type',$type)
            ->with('hlid',$hlid)
            ->with('slgid',$slgid )
            ->with('locationid',$locationid )
            ->with('count_result',$count_result)
			->with('slugdata',$explocname);
    }

    public function getwithoutdatedata(Request $request) {
        $pagetype = "withoutdate";
        $desiredId = $request->get('locationid');
        $lname = $request->get('lname');
         $st="";
        $amenity="";
        if($request->get('starrating') !=""){
            $st =trim($request->get('starrating')) ;
        }
        if($request->get('amenity') !=""){
            $amenity = trim(str_replace('_',' ',$request->get('amenity')) );
        }


       if($amenity ==""){
        // Define the base query
        $query = DB::table('TPHotel as h')
            ->leftJoin('TPHotel_amenities as a', DB::raw('FIND_IN_SET(a.id, h.shortFacilities)'), '>', DB::raw('0')) // Join with amenities
            ->select(
                'h.hotelid',
                'h.id',
                'h.name',
                'h.slug',
                'h.stars',
                'h.pricefrom',
                'h.rating',
                'h.amenities',
                'h.distance',
                'h.image',
                'h.about',
                'h.room_aminities',
                'h.shortFacilities',
                'h.slugid',
                'h.CityName',
				'h.short_description',
				'h.ReviewSummary',
			'h.OverviewShortDesc',
			   DB::raw('GROUP_CONCAT(CONCAT(a.shortName, "|", a.image) ORDER BY a.name SEPARATOR ", ") as amenity_info')
              //  DB::raw('GROUP_CONCAT(a.name ORDER BY a.name SEPARATOR ", ") as amenity_names')
            )
            ->where('h.slugid', $desiredId)
            ->whereNotNull('h.slugid');
            if ($st !="") {
				$query->where('h.stars', $st);
			}
       $query->orderBy(DB::raw('h.short_description IS NULL'), 'asc');
        $query->groupBy('h.id');
        $searchresults = $query->paginate(30);
      }

        if($amenity !=""){
            $query = DB::table('TPHotel as h')
            // ->leftJoin('TPHotel_amenities as a', DB::raw('FIND_IN_SET(a.id, h.facilities)'), '>', DB::raw('0')) // Join with amenities
            ->leftJoin('TPHotel_amenities as a', DB::raw('FIND_IN_SET(a.id, h.shortFacilities)'), '>', DB::raw('0')) // Join with
            ->select(
                'h.hotelid',
                'h.id',
                'h.name',
                'h.slug',
                'h.stars',
                'h.pricefrom',
                'h.facilities',
                'h.rating',
                'h.distance',
                'h.image',
                'h.about',
                'h.slugid',
                'h.CityName',
                'h.short_description',
                'h.ReviewSummary',
				'h.OverviewShortDesc',
              //  DB::raw('GROUP_CONCAT(a.name ORDER BY a.name SEPARATOR ", ") as amenity_names') // Concatenating amenity names
				   DB::raw('GROUP_CONCAT(CONCAT(a.shortName, "|", a.image) ORDER BY a.name SEPARATOR ", ") as amenity_info')
            )
            ->where('h.slugid', $desiredId)
            ->whereNotNull('h.slugid');
            if (!empty($st)) {
                $query->where('h.stars', $st);
            }
            if (!empty($amenity)) {

                $query->whereExists(function($subquery) use ($amenity) {
                    $subquery->select(DB::raw(1))
                        ->from('TPHotel_amenities as a2')
                        ->whereRaw('FIND_IN_SET(a2.id, h.shortFacilities)')
                        ->where('a2.name', 'LIKE', '%' . trim($amenity) . '%');
                });
            }

            $query->orderBy(DB::raw('h.short_description IS NULL'), 'asc');
            $query->groupBy('h.id');
            $searchresults = $query->paginate(30);
        }


        $paginationLinks = $searchresults->appends($request->except(['_token']))->links('hotellist_pagg.default');


        $count_result = $searchresults->total();


        return view('frontend.hotel.hoteldata_withoutdate', [
            'count_result' => $count_result,
            'searchresults' => $searchresults,
            'lname' => $lname,
        ]);
    }
    public function gethotellist_withoutdate_test(request $request){
            $id = $request->get('id');
            $desiredId = $request->get('locationid');
            $lname = $request->get('lname');
            $countryname = $request->get('countryname');
               $Tid = $request->get('Tid');

		$LocationId = $Tid;
		   $start  =  date("H:i:s");
      //  return $desiredId;

		   $searchresults = Hotel::leftJoin('TPHotel_types as ty', 'ty.hid', '=', 'TPHotel.propertyType')
    ->select('TPHotel.hotelid', 'TPHotel.id', 'TPHotel.name', 'TPHotel.address', 'TPHotel.slug', 'TPHotel.cityId', 'TPHotel.iata', 'TPHotel.location_id as loc_id', 'TPHotel.stars', 'TPHotel.pricefrom', 'TPHotel.rating', 'TPHotel.popularity', 'TPHotel.amenities', 'TPHotel.distance', 'TPHotel.image', 'ty.type as propertyType')
    ->where('TPHotel.location_id', $desiredId)
	->orderBy('TPHotel.hotelid','asc')
     ->paginate(10);
		   $end  =  date("H:i:s");
     //     return   $start.'--'.$end;
              $url = 'ho-'.$id;
              $searchresults->appends(request()->except(['_token', 'locationid', 'lname', 'countryname', 'id']));

              $searchresults->setPath($url);
              $paginationLinks = $searchresults->links('hotellist_pagg.default');

         return view('frontend.hotel.get_hotel_listing_result_withoutdate')->with('searchresults',$searchresults)->with('lname',$lname)->with('countryname',$countryname)->with('LocationId',$LocationId);

    }

     public function getSignature(request $request){
       $cityId = $request->get('lid');
       $hotelId = $request->get('hid');
       $cityName = $request->get('cityName') ;

       $guests = Session()->get('guest');
       $rooms = Session()->get('rooms');

       $stchin = $request->get('checkin');
       $checkout = $request->get('checkout');

       $cmbdate = $request->get('checkin').'_'.$request->get('checkout');


        $checkin = Session()->get('checkin');

        if($cmbdate === $checkin ||  empty($checkout) && !empty($checkin)){

            $expdate = explode('_', $checkin);

            $checkin_date = trim($expdate[0]);
            $checkout_date = trim($expdate[1]);


            $date_stchin = strtotime($checkin_date);
            $chkin = date("Y-m-d", $date_stchin);

            $date_chout= strtotime($checkout_date);
            $checout = date("Y-m-d", $date_chout);


        }else{
            if(!empty($stchin) && !empty($checkout)){

                $date_stchin = strtotime($stchin);
                $chkin = date("Y-m-d", $date_stchin);

                $date_chout= strtotime($checkout);
                $checout = date("Y-m-d", $date_chout);

			     $cmbdate = $chkin.'_'.$checout;

  				 session()->put('checkin',$cmbdate);


            }else{
               $checkinTimestamp = strtotime("+1 day");
                $chkin = date("Y-m-d", $checkinTimestamp);

                // Get the checkout date by adding 4 days
                $checkoutTimestamp = strtotime("+5 days", $checkinTimestamp);
                $checout = date("Y-m-d", $checkoutTimestamp);
            }
        }
       if(empty($chkin) && empty($checout)){
            return 0;
       }




        //new code start
        $checkinDate = $chkin;
        $checkoutDate = $checout;
        $adultsCount = 2; //$guests;
        $customerIP = '49.156.89.145';
        $childrenCount = '1';
        $chid_age = '10';
        $lang = 'en';
        $currency ='USD';
        $waitForResult ='0';
        $iata=$hotelId;

        $TRAVEL_PAYOUT_TOKEN = "27bde6e1d4b86710997b1fd75be0d869";
        $TRAVEL_PAYOUT_MARKER = "299178";



       $SignatureString = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$adultsCount.":".
        $checkinDate.":".
        $checkoutDate.":".
        $chid_age.":".
        $childrenCount.":".
        $currency.":".
        $customerIP.":".
        $iata.":".
        $lang.":".
        $waitForResult;


      $signature = md5($SignatureString);
   //  $signature = '3193e161e98200459185e43dd7802c2c';

     $url ='http://engine.hotellook.com/api/v2/search/start.json?hotelId='.$iata.'&checkIn='. $checkinDate.'&checkOut='.$checkoutDate.'&adultsCount='.$adultsCount.'&customerIP='.$customerIP.'&childrenCount='.$childrenCount.'&childAge1='.$chid_age.'&lang='.$lang.'&currency='.$currency.'&waitForResult='.$waitForResult.'&marker=299178&signature='.$signature;



          $response = Http::withoutVerifying()->get($url);

        if ($response->successful()) {


          $data = json_decode($response);
            if(!empty($data)){
              $searchId = $data->searchId;


            $limit =10;
            $offset=0;
            $roomsCount=10;
            $sortAsc=1;
            $sortBy='price';

            $SignatureString2 = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$limit.":".$offset.":".$roomsCount.":".$searchId.":".$sortAsc.":".$sortBy;
                 $sig2 =  md5($SignatureString2);

            $url2 = 'http://engine.hotellook.com/api/v2/search/getResult.json?searchId='.$searchId.'&limit=10&sortBy=price&sortAsc=1&roomsCount=10&offset=0&marker=299178&signature='.$sig2;
   // $response2 = Http::withoutVerifying()->get($url2);

		   $maxAttempts = 5;
		   $retryInterval = 1; // seconds
           $response2 = Http::withoutVerifying()
           ->timeout(0)
           ->retry($maxAttempts, $retryInterval)
           ->get($url2);
            $jsonResponse = json_decode($response2, true);


            if (isset($jsonResponse['errorCode']) && $jsonResponse['errorCode'] === 4) {
                $jsonResponse['data_status'] = 4;

            }

         return   view('hotel_result',['hotels'=>$jsonResponse]);

            }else{
                return 'search id not found';
            }

        } else {

            return 2;
        }

    }

   //HOTEL DETAIL Page
		//start hotel detail
       public function hotel_detail($id,Request $request) {

            $currentTime  = now();
            $checkin = $request->get('checkin');
            $checkout = $request->get('checkout');


            $TPRoomtype = collect();
            $gethotel = collect();

            $rooms = [];
            $uniqueAmenities =[];
            $locid = 0;
            $hotelid = null;
            $slug = "";
            $locname = "";
            $ctname = "";
            $LocationId =null;
            $location_slugid=null;
            $parts = explode('-', $id);
            if (count($parts) >= 3) {
                $LocationId = $parts[0];
                $location_slugid = $parts[0];
                $hotelid = $parts[1];
                $slg = implode('-', array_slice($parts, 2));
                $slug = str_replace('!', '#', $slg);
            }

           $getloclink = DB::table('Temp_Mapping as m')
           ->select('m.LocationId','m.cityName')
           ->where('m.slugid', $LocationId)
           ->get();
           if(!$getloclink->isEmpty()){
            $locid = $getloclink[0]->LocationId;
           }
           $hlid =$locid;


           $searchresults = DB::table('TPHotel as h')
           ->select('h.name','h.location_id','h.id','h.hotelid','h.metaTagTitle','h.MetaTagDescription','h.Latitude','h.longnitude','h.stars','h.address','h.pricefrom','h.about','h.location_score','h.room_aminities',
            'h.amenities','h.shortFacilities','h.Phone','h.Email','h.Website', 'h.photoCount','h.cntRooms','h.Languages','h.maxprice','h.minprice','h.checkIn','h.checkOut','l.cityName'   ,'h.photosByRoomType','h.propertyTypeId','h.GreatForScore','h.GreatFor','h.facilities','h.rating','h.ratingcount','h.photoCount','h.ReviewSummary','h.ReviewSummaryLabel','h.Spotlights','h.ThingstoKnow','h.slugid','h.slug')
            ->leftJoin('TPLocations as l', 'l.id', '=', 'h.location_id')
            ->where('h.id', $hotelid)
            ->where('h.slugid', $location_slugid)
            ->where('h.slug', $slug)
            ->get()->toArray();

         //   return  print_r( $searchresults);

            if (empty($searchresults)) {
                    if ($LocationId) {
                    $redirect = DB::table('Temp_Mapping as m')
                    ->select('m.slugid')
                    ->where('m.Tid', $LocationId)
                    ->get();
                    if(!$redirect->isEmpty()){
                        $locid = $redirect[0]->slugid;
                        return redirect('hd-' .$locid.'-'.$hotelid . '-' . $slug);
                    }
                    // Redirect to the new URL
                    $checkgetloc2 = DB::table('Temp_Mapping as tm')
                        ->select('tm.slugid')
                        ->where('tm.LocationId', $LocationId)
                        ->get();


                    if(!$checkgetloc2->isEmpty()){
                        $locid =  $checkgetloc2[0]->slugid;
                        return redirect('hd-' .$locid.'-'.$hotelid . '-' . $slug);
                    }
                    // Redirect to the new URL

                    }
                abort(404, 'Hotel not found');
            }
             $shortfacilityIds = explode(',', $searchresults[0]->shortFacilities);
                $shortFacilities = DB::table('TPHotel_amenities')
                ->whereIn('id', $shortfacilityIds)
                ->get();


          $facilityIds = explode(',', $searchresults[0]->facilities); // Convert comma-separated IDs to array

          $facilityNames = DB::table('TPHotel_amenities')
              ->whereIn('id', $facilityIds)

              ->get();


           $hotid= 0;
           $getroomtype =collect();
           $getreview = collect();
           $getquest =collect();
        $getreview =  DB::table('HotelReview')->where('HotelId',$hotelid)->get();

           if(!empty($searchresults)){
               $hotid = $searchresults[0]->hotelid;
               $hoid = $searchresults[0]->id;
               $TPRoomtype = DB::table('TPRoomtype')->select('Roomdesc')->where('hotelid',$hotid)->get();
               $photosByRoomType = json_decode($searchresults[0]->photosByRoomType, true);
               if (!empty($photosByRoomType)) {
                    foreach ($photosByRoomType as $key => $value) {
                        $roomtyids[] = $key;
                    }
                    $getroomtype = DB::table('TPRoom_types')->select('rid','type')->whereIn('rid', $roomtyids)->get();
               }

           }


           $url = 'https://yasen.hotellook.com/photos/hotel_photos?id='.$hotid ;
          $response = Http::withoutVerifying()->get($url);
          $images = $response->json();

           //nearby attraction

         $within = null;
         $nearby_hotel = collect();
         $nearby_sight = collect();
         $near_sight = collect();
         $nearby_rest =collect();
         $get_experiences =collect();
         $sighid = null;
         if(!empty($searchresults)){
           $latitude = $searchresults[0]->Latitude;
           $longitude = $searchresults[0]->longnitude ;
           $location_id = $searchresults[0]->location_id ;


           $restradus= 1;
           $Tid =null;
         }


        $getloclink =collect();
        $getcontlink =collect();
        $getlocationexp =collect();

        $locationPatent = [];
        $getloclink = DB::table('Temp_Mapping as tm')
        ->join('Location as l', 'l.LocationId', '=', 'tm.Tid')
        ->select('l.LocationId','l.LocationLevel','l.ParentId','l.CountryId')
        ->where('tm.LocationId', $locid)
        ->get();

         if(!$getloclink->isEmpty() ){
             $getcontlink = DB::table('Country as co')
             ->join('CountryCollaboration as cont','cont.CountryCollaborationId','=','co.CountryCollaborationId')
             ->select('co.CountryId','co.slug','co.Name','cont.Name as cName','cont.CountryCollaborationId as contid')
             ->where('co.CountryId', $getloclink[0]->CountryId)
             ->get();

             if(!$getloclink->isEmpty()){

                  $locationid = $getloclink[0]->LocationId;
                     $getlocationexp = DB::table('Location')->select('slugid','LocationId','Name','Slug')->where('LocationId', $locationid)->get();

                 if (!$getloclink->isEmpty() &&  $getloclink[0]->LocationLevel != 1) {

                     $loopcount =  $getloclink[0]->LocationLevel;
                     $lociID = $getloclink[0]->ParentId;
                     for ($i = 1; $i < $loopcount; $i++) {
                         $getparents = DB::table('Location')->select('slugid','Name','Slug','ParentId')->where('LocationId', $lociID)->get();
                         if (!empty($getparents)) {
                             $locationPatent[] = [
                                 'LocationId' => $getparents[0]->slugid,
                                 'slug' => $getparents[0]->Slug,
                                 'Name' => $getparents[0]->Name,
                             ];
                             if (!empty($getparents) && $getparents[0]->ParentId != "") {
                             $lociID = $getparents[0]->ParentId;
                         }
                         } else {
                             break;
                         }
                     }

                 }
             }


        }

            $amenity_desc = collect();

            $matching_amenities =[];
            $amenity_desc =[];


          //end


        $rooms =[];
        $pgtype = '';
        $Roomdesc =[];
        $filteredAmenitiesData =[];
        // $TPRoomtype = DB::table('TPRoomtype')->select('Roomdesc')->where('hotelid',$hotid)->get();

          $TPRoomtype1 = DB::table('TPRoomtype_tmp')->select('*')
          ->where('hotelid',$hotid)->get()->toArray();
          if(!empty($TPRoomtype1))
          {
              foreach ($TPRoomtype1 as $key => $value)
              {
                  foreach ($value as $key1 => $value1)
                  {
                      if($value1==1)
                      {
                          $amenitiesListNew[] = $key1;
                      }
                  }
              }
          }
          if(!empty($amenitiesListNew)){
              $valuesToRemove = [0,1,2,3];
              $filteredAmenitiesData = array_diff(array_unique($amenitiesListNew), $valuesToRemove);
          }
          $pgtype = '';
          if($checkin !=""  &&   $checkout !=""){
              $pgtype = 'withdate';
          }else{
              $pgtype = 'withoutdate';
          }
          $type = "hotel";
          $lname = $searchresults[0]->cityName;



		   //start price code
			$getprice =collect();
			$hotelid = $searchresults[0]->hotelid;

			$getprice =DB::table('hotelbookingstemp')->where('hotelid',$hotelid )->orderby('price','asc')->get();
		//end price code
           return view('hotel_detail')->with('searchresult',$searchresults)
           ->with('images',$images)
           ->with('review',$getreview)
           ->with('faq',$getquest)
           ->with('RoomsData',$TPRoomtype1)
           ->with('nearby_sight',$nearby_sight)
           ->with('nearby_hotel',$nearby_hotel)
           ->with('getroomtype',$getroomtype)
           ->with('getloclink',$getloclink)
           ->with('locationPatent',$locationPatent)
           ->with('within',$within)
           ->with('amenity_desc',$amenity_desc)
           ->with('TPRoomtype',$TPRoomtype)
           ->with('near_sight',$near_sight)
           ->with('getlocationexp',$getlocationexp)
           ->with('getcontlink',$getcontlink)
           ->with('hlid',$hlid)
           ->with('type',$type)
           ->with('amenitiesListroom',$filteredAmenitiesData)
           ->with('rooms',$rooms)
           ->with('pgtype', $pgtype)
           ->with('roomdt',$rooms)
           ->with('nearby_rest',$nearby_rest)
           ->with('restradus',$restradus)
           ->with('get_experience',$get_experiences)
           ->with('tid',$Tid)
           ->with('currentTime',$currentTime)
           ->with('location_slugid',$location_slugid)
            ->with('lname',$lname)
            ->with('facilityNames',$facilityNames)
			->with('shortFacilities',$shortFacilities)
			->with('getprice',$getprice);

        }

    public function hotel_detailfaqs(request $request){

        $hotelid = $request->get('hotelid');

        $hname = $request->get('hname');
        $hid = $request->get('hid');

        $nearby_sight =  DB::table('TPhotel_neaby_sight')->select('radius','distance','LocationId','SightId','slug','name','TAAggregateRating','category')->where('hotelid',$hid)->get();

        $get_experiences =collect();
        if(!$nearby_sight->isEmpty() ){

            $sighid = $nearby_sight[0]->SightId;
            $location_id = $nearby_sight[0]->LocationId;
            $mapping =  DB::table('Temp_Mapping')->select('Tid')->where('slugid',$location_id)->get();


            if(!$mapping->isEmpty()){
                $Tid = $mapping[0]->Tid;
                $get_experiences = DB::table('ExperienceItninerary as e')
                ->join('Experience as exp', 'exp.ExperienceId', '=', 'e.ExperienceId')
                ->leftJoin('ExperienceReview as rr', 'exp.ExperienceId', '=', 'rr.ExperienceId')
                    ->select('exp.Img1','exp.Img2','exp.Img3','exp.slugid','exp.ExperienceId',
                                'exp.Slug','exp.Name','exp.viator_url','exp.Duration','exp.Cost','exp.TAAggregationRating' ,DB::raw("COUNT(rr.Id) as review_count"))
                ->where('exp.LocationId', $Tid)
                ->groupBy('exp.ExperienceId')
                ->orderBy('exp.TAAggregationRating', 'desc')
                ->limit(4)
                ->get();


            }

       }


        //  $nearby_hotel =  DB::table('TPNearby_hotel')->where('hid',$hotelid)->get();



         $getquest =  DB::table('HotelQuestion')->select('User_Name','CreatedDate','Question','updatedOn','Listing','Answer')->where('HotelId',$hid)->get();

         $getreview =  DB::table('HotelReview')->where('HotelId',$hid)->get();
      // return print_r($getreview);
         $html1 = view('hotel_detail_result.Near_by_Attractions',['nearby_sight'=>$nearby_sight])->render();

       //  $html2 = view('frontend.hotel.hotel_detail_nearby_hotel',['nearby_hotel'=>$nearby_hotel,'hname'=>$hname])->render();
         $html3 = view('frontend.hotel.hotel_detail_faq',['faq'=>$getquest])->render();
         $html4 = view('frontend.hotel.hotel_review_result',['review'=>$getreview])->render();

         $html5 = view('frontend.hotel.hotel_detail_nearby_exp',['get_experience'=>$get_experiences,'hname'=>$hname])->render();

         $html1 = (string) $html1;
     //    $html2 = (string) $html2;
         $html3 = (string) $html3;
         $html4 = (string) $html4;
         $html5 = (string) $html5;
         return response()->json([ 'html1' => $html1,'html3'=>$html3,'html4'=>$html4,'html5'=>$html5]);
    }


    public function hotel_detail_perfect_sight(request $request){

        $hname = $request->get('hname');
        $hotelid = $request->get('hotelid');
        $hid = $request->get('hid');
        $near_sight =  DB::table('TPHotelPerfectLocSights')->select('distance','name')->where('hotelid',$hid)->get();

        $html1 = view('hotel_detail_result.perfect_location',['near_sight'=>$near_sight])->render();
        $html1 = (string) $html1;
        return response()->json(['html1' => $html1]);

    }
    public function hoteldetailnearbyrest(request $request){

        $latitude = $request->get('latitude');
        $longitude = $request->get('longnitude');
        $tid = $request->get('tid');
        $hid = $request->get('hid');
        $hname = $request->get('hname');
        $hotelid = $request->get('hotelid');

        $nearby_rest =  DB::table('TPhotel_nearby_restaurant')->where('hotelid',$hid)->get();
        $nearby_hotel =  DB::table('TPNearby_hotel')->where('hid',$hid)->get();


         $html1 = view('frontend.hotel.hotel_detail_nearbyrest',['nearby_rest'=>$nearby_rest])->render();

         $html2 = view('frontend.hotel.hotel_detail_nearby_hotel',['nearby_hotel'=>$nearby_hotel,'hname'=>$hname])->render();


         $html1 = (string) $html1;
         $html2 = (string) $html2;

         return response()->json(['html1' => $html1, 'html2' => $html2]);
    }

    public function add_hoteldetail_nearbyrest(request $request){

        $latitude = $request->get('latitude');
        $longitude = $request->get('longnitude');
        $hid = $request->get('hid');
        $hname = $request->get('hname');

        $nearby_restcheck =  DB::table('TPhotel_nearby_restaurant')->where('hotelid',$hid)->get();
        $restradus= 1;

        if($nearby_restcheck->isEmpty() &&  $latitude !="" && $longitude !="" ){

            $nearby_rest = DB::table("Restaurant as r")
            ->leftJoin('RestaurantReview as rr', 'r.RestaurantId', '=', 'rr.RestaurantId')
            ->select('r.Title','r.TATrendingScore','r.slugid','r.RestaurantId','r.Slug',
                    DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                    * cos(radians(r.Latitude))
                    * cos(radians(r.Longitude) - radians(" . $longitude . "))
                    + sin(radians(" . $latitude . "))
                    * sin(radians(r.Latitude))) AS distance"),
                    DB::raw("COUNT(rr.RestaurantReviewId) as review_count"))
            ->groupBy("r.RestaurantId")
            ->having('distance', '<=', $restradus)
            ->orderBy('distance')
            ->limit(4)
            ->get();
            if (!$nearby_rest->isEmpty()) {
               $data = [];

               foreach ($nearby_rest as $restaurant) {
                   $data[] = [
                       'hotelid' => $hid,
                       'RestaurantId' => $restaurant->RestaurantId,
                       'radius' => $restradus,
                       'slugid' => $restaurant->slugid,
                       'Slug' => $restaurant->Slug,
                       'Title' => $restaurant->Title,
                       'distance' => $restaurant->distance,
                       'TATrendingScore' => $restaurant->TATrendingScore,
                       'review_count' => $restaurant->review_count,
                   ];
               }

               DB::table('TPhotel_nearby_restaurant')->insert($data);
           }



            $nearby_restdata =  DB::table('TPhotel_nearby_restaurant')->where('hotelid',$hid)->get();

            $html1 = view('frontend.hotel.hotel_detail_nearbyrest',['nearby_rest'=>$nearby_rest,'restradus'=>$restradus])->render();



            $html1 = (string) $html1;


            return response()->json([ 'html1' => $html1]);
        }


    }

  // add hotel detail description


  public function insert_hotel_desction(request $request){

    $timeout = PHP_INT_MAX;
 //   $checkinDate = date('Y-m-d');

    $checkin = $request->get('checkin');
    $checkout = $request->get('checkout');
    $hid = $request->get('hid');
    $chkin = $checkin;
    $checout = $checkout;

       $guests = 2;
       $rooms = 1;

       $stchin = $checkin;
       $checkout = $checkout;

       $cmbdate = $checkin.'_'.$checkout;
       $checkin =  $checkin;


       //new code start
       $checkinDate = $checkin;
       $checkoutDate = $checkout;
       $adultsCount = 2; //$guests;
       $customerIP = '49.156.89.145';
       $childrenCount = '1';
       $chid_age = '10';
       $lang = 'en';
       $currency ='USD';
       $waitForResult ='0';
       $iata=$hid;

       $TRAVEL_PAYOUT_TOKEN = "27bde6e1d4b86710997b1fd75be0d869";
       $TRAVEL_PAYOUT_MARKER = "299178";

       $SignatureString = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$adultsCount.":".
       $checkinDate.":".
       $checkoutDate.":".
       $chid_age.":".
       $childrenCount.":".
       $currency.":".
       $customerIP.":".
       $iata.":".
       $lang.":".
       $waitForResult;


       $signature = md5($SignatureString);


       $url ='http://engine.hotellook.com/api/v2/search/start.json?hotelId='.$iata.'&checkIn='. $checkinDate.'&checkOut='.$checkoutDate.'&adultsCount='.$adultsCount.'&customerIP='.$customerIP.'&childrenCount='.$childrenCount.'&childAge1='.$chid_age.'&lang='.$lang.'&currency='.$currency.'&waitForResult='.$waitForResult.'&marker=299178&signature='.$signature;



       $response = Http::withoutVerifying()->get($url);

       if ($response->successful()) {


       $data = json_decode($response);
           if(!empty($data)){
           $searchId = $data->searchId;


           $limit =10;
           $offset=0;
           $roomsCount=10;
           $sortAsc=1;
           $sortBy='price';

           $SignatureString2 = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$limit.":".$offset.":".$roomsCount.":".$searchId.":".$sortAsc.":".$sortBy;
           $sig2 =  md5($SignatureString2);

           $url2 = 'http://engine.hotellook.com/api/v2/search/getResult.json?searchId='.$searchId.'&limit=10&sortBy=price&sortAsc=1&roomsCount=10&offset=0&marker=299178&signature='.$sig2;

           $maxAttempts = 4;
           $retryInterval = 1;
           $response2 = Http::withoutVerifying()
           ->timeout(0)
           ->retry($maxAttempts, $retryInterval)
           ->get($url2);

           $jsonResponse = json_decode($response2, true);

           if ($jsonResponse['status'] == 'ok') {
               $hotels = $jsonResponse['result'];
               $rooms = [];
               $roomsData = [];

               foreach ($hotels as $hotel) {
                   if (isset($hotel['rooms']) && is_array($hotel['rooms'])) {

                       foreach ($hotel['rooms'] as $room) {
                           $rooms[] = [
                               'options' => $room['options'],
                               'desc' => $room['desc'],
                           ];
                           $roomName = $room['desc'];
                           $amenities = $room['options'];
                           $roomsData[$roomName] = $amenities;
                       }
                   }
               }

               $getdata =  DB::table('TPRoomtype')->where('hotelid',$hid)->get();
                if(!$getdata->isEmpty()){
                    $roomData = [];
                    foreach ($rooms as $room) {
                        $desc = $room['desc'];
                        $options = $room['options'];
                        $roomData[$desc] = $options;

                    }
                    $decodedRoomDesc = json_decode($getdata[0]->Roomdesc, true);
                    $difference = array_diff_key($roomData, $decodedRoomDesc);

                    if (empty($difference)) {
                        return "match"; // All data matches
                    } else {

                        $updateData = [];
                        foreach ($difference as $desc => $options) {
                            $updateData[$desc] = $options;
                        }
                        $updatedData = array_merge_recursive($decodedRoomDesc, $roomData);
                        $updatedData = json_encode($updatedData);
                        $roomty = array(
                            'Roomdesc'=>$updatedData
                        );
                    //   return $roomty;

                    return     $getdata =DB::table('TPRoomtype')->where('hotelid',$hid)->update($roomty);

                    }



                }else{
                    $roomData = [];
                    foreach ($rooms as $room) {
                        $desc = $room['desc'];
                        $options = $room['options'];
                        $roomData[$desc] = $options;

                    }
                    $roomData = json_encode($roomData);
                    $roomty = array(

                        'Roomdesc'=>$roomData,
                        'hotelid'=>$hid
                    );

                     return   $getdata =DB::table('TPRoomtype')->insert($roomty);



                }






            }

           //end new code



           }

       }



    }





// end add hotel detail description
	//end hotel detail section
	  public function saveTphotel_nearby(request $request){

        $latitude = $request->get('Latitude');
        $longitude = $request->get('longitude');
        $hotelid = $request->get('hotelid');
        $locationid = $request->get('locationid');
        $stars = $request->get('stars');

        $nbs =0;
        $nbh = 0;
        $ns =0;

        $nb_sighttable = DB::table('TPhotel_neaby_sight')->where('hotelid',$hotelid)->get();

           if($latitude != "" && $longitude !=""){
               if (!$nb_sighttable->count() >= 4) {
                   $sredius= 50;
                    $nearby_sights = DB::table("Sight")
                            ->join('Location as l','l.LocationId','=','Sight.LocationId')
                            ->leftjoin('Category as c','c.CategoryId','=','Sight.CategoryId')
                            ->select('Sight.SightId', 'l.slugid','Sight.Title','Sight.LocationId','Sight.Slug',
                            'c.Title as catname','Sight.TAAggregateRating',
                            'Sight.Latitude','Sight.Longitude',
                                    DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                                * cos(radians(Sight.Latitude))
                                * cos(radians(Sight.Longitude) - radians(" . $longitude . "))
                                + sin(radians(" . $latitude . "))
                                * sin(radians(Sight.Latitude))) AS distance"))
                            ->groupBy("Sight.SightId")
                            ->having('distance', '<=', $sredius)
                            ->orderBy('distance')
                            ->limit(4)
                            ->where('Sight.IsMustSee',1)
                            ->get();


               if (!$nearby_sights->isEmpty()) {
                   $nbs =1;
                   foreach ($nearby_sights as $nearby_sight) {
                       $sightId = $nearby_sight->SightId;
                       $slug = $nearby_sight->Slug;
                       $Title = $nearby_sight->Title;
                       $catname = $nearby_sight->catname;
                       $TAAggregateRating = $nearby_sight->TAAggregateRating;
                       $LocationId = $nearby_sight->slugid;
                       $distance = round($nearby_sight->distance,2);

                       $data= array(
                           'SightId'=>  $sightId,
                           'name'=>$Title,
                           'slug'=>$slug,
                           'LocationId'=>$LocationId,
                           'hotelid'=>$hotelid,
                           'distance'=>$distance,
                           'radius'=>50,
                           'dated'=>now(),
                           'category'=>$catname,
                           'TAAggregateRating'=>$TAAggregateRating
                       );

                       $insertdata = DB::table('TPhotel_neaby_sight')->insert($data);
                   }
               }




           }







            $get_nearby_hotel = DB::table('TPNearby_hotel')->where('hid',$hotelid)->get();

         if (!$get_nearby_hotel->count() >= 5) {
           //  return print_r($get_nearby_hotel);
                $searchradius = 10;
             $nearby_hotel = DB::table("TPHotel as h")
               ->join('Temp_Mapping as m','m.LocationId','=','h.location_id')
            //   ->join('Location as l','l.LocationId','=','m.Tid')
               ->select('h.id','m.slugid','h.name','h.location_id','h.slug','h.address','h.pricefrom','h.stars','h.hotelid as hotid',
                       DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                   * cos(radians(h.Latitude))
                   * cos(radians(h.longnitude) - radians(" . $longitude . "))
                   + sin(radians(" . $latitude . "))
                   * sin(radians(h.Latitude))) AS distance"))
               ->having('distance', '<=', $searchradius)
               ->where('h.location_id',$locationid)
               ->where('h.id', '!=', $hotelid)
               ->orWhere('h.stars',$stars)
               ->orderBy('distance')
               ->limit(6)

               ->get();
                $savedCount = 0;
           // return print_r($nearby_hotel);
            if(!$nearby_hotel->isEmpty()){

                $nbh =1;


               foreach ($nearby_hotel as $nearby_hotels) {
                        $id = $nearby_hotels->id;
                   if($id != $hotelid){
                       $hot_id = $nearby_hotels->hotid;
                       $slug = $nearby_hotels->slug;
                       $Title = $nearby_hotels->name;
                       $LocationId = $nearby_hotels->slugid;
                       $distance = round($nearby_hotels->distance,2);
                       $address = $nearby_hotels->address;
                       $stars = $nearby_hotels->stars;
                       $pricefrom = $nearby_hotels->pricefrom;


                       $data3= array(
                           'name'=>$Title,
                           'slug'=>$slug,
                           'hotelid'=>$id,
                           'hotel_id'=> $hot_id,
                           'LocationId'=>$LocationId,
                           'distance'=>$distance,
                           'radius'=>$searchradius,
                           'address'=>$address,
                           'stars'=>$stars,
                           'pricefrom'=>$pricefrom,
                           'hid'=>$hotelid,
                           'dated'=>now(),
                       );


                       $insertdata3 = DB::table('TPNearby_hotel')->insert($data3);
                       $savedCount++;
                       if ($savedCount >= 5) {
                           break;
                       }
                   }
               }


           }
         }


        }

     if( $nbs ==1 || $nbh == 1){

           $updated_data = DB::table('TPhotel_neaby_sight')->where('hotelid',$hotelid)->get();
           $html_view = view('hotel_detail_result.Near_by_Attractions', ['nearby_sight' => $updated_data])->render();

           $nearby_hotel =  DB::table('TPNearby_hotel')->where('hid',$hotelid)->get();
           $html3 = view('hotel_detail_result.nearby_hotels',['nearby_hotel'=>$nearby_hotel])->render();
           $html3 = (string) $html3;
               // Return the updated data and HTML as a JSON response
           return response()->json([ 'html' => $html_view,'html3'=>$html3]);
       }



      }

     public function similarhotel(request $request){
           $locid =  $request->get('lid');

        //new code start
        $chkin = date("Y-m-d");
        $checkinDate = date("Y-m-d",strtotime($chkin . ' +2 days'));
        $checkoutDate = date("Y-m-d", strtotime($chkin . ' +8 days'));
        $adultsCount = 2; //$guests;
        $customerIP = '49.156.89.145';
        $childrenCount = '1';
        $chid_age = '10';
        $lang = 'en';
        $currency ='USD';
        $waitForResult ='0';
        $iata=$locid;

        $TRAVEL_PAYOUT_TOKEN = "27bde6e1d4b86710997b1fd75be0d869";
        $TRAVEL_PAYOUT_MARKER = "299178";



       $SignatureString = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$adultsCount.":".
        $checkinDate.":".
        $checkoutDate.":".
        $chid_age.":".
        $childrenCount.":".
        $iata.":".
        $currency.":".
        $customerIP.":".
        $lang.":".
        $waitForResult;

    //  return $SignatureString;
      $signature = md5($SignatureString);
   //  $signature = '3193e161e98200459185e43dd7802c2c'; iata=HKT

     $url ='http://engine.hotellook.com/api/v2/search/start.json?cityId='.$iata.'&checkIn='. $checkinDate.'&checkOut='.$checkoutDate.'&adultsCount='.$adultsCount.'&customerIP='.$customerIP.'&childrenCount='.$childrenCount.'&childAge1='.$chid_age.'&lang='.$lang.'&currency='.$currency.'&waitForResult='.$waitForResult.'&marker=299178&signature='.$signature;



          $response = Http::withoutVerifying()->get($url);

        if ($response->successful()) {


          $data = json_decode($response);
            if(!empty($data)){
              $searchId = $data->searchId;


            $limit =5;
            $offset=0;
            $roomsCount=0;
            $sortAsc=1;
            $sortBy='price';

              $SignatureString2 = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$limit.":".$offset.":".$roomsCount.":".$searchId.":".$sortAsc.":".$sortBy;
                 $sig2 =  md5($SignatureString2);

                 $url2 = 'http://engine.hotellook.com/api/v2/search/getResult.json?searchId='.$searchId.'&limit=5&sortBy=price&sortAsc=1&roomsCount=0&offset=0&marker=299178&signature='.$sig2;

                    $response2 = Http::withoutVerifying()->get($url2);
                         $hotel = json_decode($response2, true);

            }else{
                return 'search id not found';
            }

        } else {

            return 2;
        }


        return view('filter_similar_hotel',['gethotel'=>$hotel,'locid'=>$locid]);
    }



	public function filter_hotel_list(request $request)
	{
		$locationid = $request->get('locationid');

		$minPrice = $request->get('priceFrom');
		$priceTo = $request->get('priceTo');
		$typeHotel = $request->get('hoteltype');
		$starRating = $request->get('starRating');
		$mnt = $request->get('mnt');

		$amenities = [];
		if(is_string($mnt)){
			$amenities = explode(',', $mnt);
		}

		$typeHotels = [];
		if (is_string($typeHotel)) {
			$typeHotels = explode(',', $typeHotel);
		}

		$userrating = $request->get('userrating');
		$user_rating = [];
		if (is_string($userrating)) {
			$user_rating = explode(',', $userrating);
		}


		$address = $request->get('address');
		$distance = $request->get('distance');




		$st = "";
		if($starRating ==1){
			$st = 0;
		}
		// [$searchresults] = DB::selectResultSets(
		//     "CALL getHotelsListFiltered('$id','$minPrice','$priceTo','$typeHotel','$userrating','$starRating','$distance','$neibourhood')"
		//     );
		$searchresults =collect();

		if (!empty($minPrice) && !empty($priceTo) && !empty($amenities) && !empty($user_rating) && !empty($starRating) && !empty($typeHotels) && $address ) {

			$searchresults  = DB::table('TPHotel as h')
				->select('h.hotelid', 'h.id', 'h.location_id as loc_id', 'h.name', 'h.address', 'h.slug', 'h.distance', 'h.stars', 'h.pricefrom', 'h.rating',
						 'h.photos', 'h.facilities', 'h.amenities', 'h.shortFacilities',
						 'l.fullName', 'l.countryName', 'l.cityName', 'ty.type as propertyType')
				->join('TPLocations as l', 'l.locationId', '=', 'h.location_id')
				->leftjoin('TPHotel_types as ty', 'ty.hid', '=', 'h.propertyType')
				->where('h.location_id', $locationid)
				->where('h.distance', '<=', $distance)
				->where('h.stars', $starRating)
				->where(function ($query) use ($typeHotels) {
					$query->whereIn('h.propertyType', $typeHotels);
				})
				->whereBetween('h.pricefrom', [$minPrice, $priceTo])
				->where(function ($query) use ($amenities) {
					foreach ($amenities as $amenity) {
						$query->where('h.amenities', 'LIKE', $amenity . '%');
					}
				})
				->where(function ($query) use ($user_rating) {
					$query->whereIn('h.amenities', $user_rating);
				})
				->where('h.distance', '>=',$distance)
				->where('h.address', 'LIKE', $address . '%')
				->where('h.Pincode', $address)
				->limit(10)
				->get();
		} elseif (!empty($starRating) && !empty($amenities) && !empty($starRating)) {

			$searchresults = DB::table('TPHotel as h')
				->select('h.hotelid', 'h.id', 'h.location_id as loc_id', 'h.name', 'h.address', 'h.slug', 'h.distance', 'h.stars', 'h.pricefrom', 'h.rating',
						 'h.photos', 'h.facilities', 'h.amenities', 'h.shortFacilities',
						 'l.fullName', 'l.countryName', 'l.cityName', 'ty.type as propertyType')
				->join('TPLocations as l', 'l.locationId', '=', 'h.location_id')
				->leftjoin('TPHotel_types as ty', 'ty.hid', '=', 'h.propertyType')
				->where('h.location_id', $locationid)
				->where('h.distance', '<=', $distance)
				->where('h.stars', $starRating)
				->where(function ($query) use ($amenities) {
					foreach ($amenities as $amenity) {
						$query->where('h.amenities', 'LIKE', $amenity . '%');
					}
				})
				->limit(10)
				->get();
		} elseif (!empty($starRating) && !empty($amenities)) {

			$searchresults = DB::table('TPHotel as h')
				->select('h.hotelid', 'h.id', 'h.location_id as loc_id', 'h.name', 'h.address', 'h.slug', 'h.distance', 'h.stars', 'h.pricefrom', 'h.rating',
						 'h.photos', 'h.facilities', 'h.amenities', 'h.shortFacilities',
						 'l.fullName', 'l.countryName', 'l.cityName', 'ty.type as propertyType')
				->join('TPLocations as l', 'l.locationId', '=', 'h.location_id')
				->leftjoin('TPHotel_types as ty', 'ty.hid', '=', 'h.propertyType')
				->where('h.location_id', $locationid)
				->where('h.distance', '<=', $distance)
				->where('h.stars', $starRating)
				->where(function ($query) use ($amenities) {
					foreach ($amenities as $amenity) {
						$query->where('h.amenities', 'LIKE', $amenity . '%');
					}
				})
				->limit(10)
				->get();
		} elseif (!empty($amenities) && !empty($user_rating) ) {

			$searchresults= DB::table('TPHotel as h')
				->select('h.hotelid', 'h.id', 'h.location_id as loc_id', 'h.name', 'h.address', 'h.slug', 'h.distance', 'h.stars', 'h.pricefrom', 'h.rating',
						 'h.photos', 'h.facilities', 'h.amenities', 'h.shortFacilities',
						 'l.fullName', 'l.countryName', 'l.cityName', 'ty.type as propertyType')
				->join('TPLocations as l', 'l.locationId', '=', 'h.location_id')
				->leftjoin('TPHotel_types as ty', 'ty.hid', '=', 'h.propertyType')
				->where('h.location_id', $locationid)
				->where('h.distance', '<=', $distance)
				->where(function ($query) use ($amenities) {
					foreach ($amenities as $amenity) {
						$query->where('h.amenities', 'LIKE', $amenity . '%');
					}
				})
				->orWhere(function ($query) use ($user_rating) {
					$query->whereIn('h.amenities', $user_rating);
				})
				->limit(10)
				->get();

		}elseif (!empty($starRating) ) {

			$searchresults = DB::table('TPHotel as h')
				->select('h.hotelid', 'h.id', 'h.location_id as loc_id', 'h.name', 'h.address', 'h.slug', 'h.distance', 'h.stars', 'h.pricefrom', 'h.rating',
						 'h.photos', 'h.facilities', 'h.amenities', 'h.shortFacilities',
						 'l.fullName', 'l.countryName', 'l.cityName', 'ty.type as propertyType')
				->join('TPLocations as l', 'l.locationId', '=', 'h.location_id')
				->leftjoin('TPHotel_types as ty', 'ty.hid', '=', 'h.propertyType')
				->where('h.location_id', $locationid)
				->where('h.distance', '<=', $distance)
				->where('h.stars', $starRating)
				->where(function ($query) use ($amenities) {
					foreach ($amenities as $amenity) {
						$query->where('h.amenities', 'LIKE', $amenity . '%');
					}
				})
				->limit(10)
				->get();

		}elseif (!empty($minPrice) && !empty($priceTo) && !empty($amenities)) {

			$searchresults = DB::table('TPHotel as h')
				->select('h.hotelid', 'h.id', 'h.location_id as loc_id', 'h.name', 'h.address', 'h.slug', 'h.distance', 'h.stars', 'h.pricefrom', 'h.rating',
						 'h.photos', 'h.facilities', 'h.amenities', 'h.shortFacilities',
						 'l.fullName', 'l.countryName', 'l.cityName', 'ty.type as propertyType')
				->join('TPLocations as l', 'l.locationId', '=', 'h.location_id')
				->leftjoin('TPHotel_types as ty', 'ty.hid', '=', 'h.propertyType')
				->where('h.location_id', $locationid)
				->where('h.distance', '<=', $distance)
				->whereBetween('h.pricefrom', [$minPrice, $priceTo])
				->where(function ($query) use ($amenities) {
					foreach ($amenities as $amenity) {
						$query->where('h.amenities', 'LIKE', $amenity . '%');
					}
				})
				->whereBetween('h.pricefrom', [$minPrice, $priceTo])
				->limit(10)
				->get();



		}elseif (!empty($minPrice) && !empty($priceTo) ) {

			$searchresults = DB::table('TPHotel as h')
				->select('h.hotelid', 'h.id', 'h.location_id as loc_id', 'h.name', 'h.address', 'h.slug', 'h.distance', 'h.stars', 'h.pricefrom', 'h.rating',
						 'h.photos', 'h.facilities', 'h.amenities', 'h.shortFacilities',
						 'l.fullName', 'l.countryName', 'l.cityName', 'ty.type as propertyType')
				->join('TPLocations as l', 'l.locationId', '=', 'h.location_id')
				->leftjoin('TPHotel_types as ty', 'ty.hid', '=', 'h.propertyType')
				->where('h.location_id', $locationid)
				->where('h.distance', '<=', $distance)

				->limit(10)
				->get();


		} elseif (!empty($amenities)) {

			$searchresults = DB::table('TPHotel as h')
				->select('h.hotelid', 'h.id', 'h.location_id as loc_id', 'h.name', 'h.address', 'h.slug', 'h.distance', 'h.stars', 'h.pricefrom', 'h.rating',
						 'h.photos', 'h.facilities', 'h.amenities', 'h.shortFacilities',
						 'l.fullName', 'l.countryName', 'l.cityName', 'ty.type as propertyType')
				->join('TPLocations as l', 'l.locationId', '=', 'h.location_id')
				->leftjoin('TPHotel_types as ty', 'ty.hid', '=', 'h.propertyType')
				->where('h.location_id', $locationid)
				->where('h.distance', '<=', $distance)
				->where(function ($query) use ($amenities) {
					foreach ($amenities as $amenity) {
						$query->where('h.amenities', 'LIKE', $amenity . '%');
					}
				})
				->limit(10)
				->get();
		} elseif (!empty($user_rating)) {

			$searchresults = DB::table('TPHotel as h')
				->select('h.hotelid', 'h.id', 'h.location_id as loc_id', 'h.name', 'h.address', 'h.slug', 'h.distance', 'h.stars', 'h.pricefrom', 'h.rating',
						 'h.photos', 'h.facilities', 'h.amenities', 'h.shortFacilities',
						 'l.fullName', 'l.countryName', 'l.cityName', 'ty.type as propertyType')
				->join('TPLocations as l', 'l.locationId', '=', 'h.location_id')
				->leftjoin('TPHotel_types as ty', 'ty.hid', '=', 'h.propertyType')
				->where('h.location_id', $locationid)
				->where('h.distance', '<=', $distance)
				->where(function ($query) use ($user_rating) {
					$query->whereIn('h.amenities', $user_rating);
				})
				->limit(10)
				->get();
		} elseif (!empty($starRating)) {

			$searchresults = DB::table('TPHotel as h')
				->select('h.hotelid', 'h.id', 'h.location_id as loc_id', 'h.name', 'h.address', 'h.slug', 'h.distance', 'h.stars', 'h.pricefrom', 'h.rating',
						 'h.photos', 'h.facilities', 'h.amenities', 'h.shortFacilities',
						 'l.fullName', 'l.countryName', 'l.cityName', 'ty.type as propertyType')
				->join('TPLocations as l', 'l.locationId', '=', 'h.location_id')
				->leftjoin('TPHotel_types as ty', 'ty.hid', '=', 'h.propertyType')
				->where('h.location_id', $locationid)
				->where('h.distance', '<=', $distance)
				->where('h.stars', $starRating)
				->limit(10)
				->get();
		} elseif (!empty($address)) {

			$searchresults = DB::table('TPHotel as h')
				->select('h.hotelid', 'h.id', 'h.location_id as loc_id', 'h.name', 'h.address', 'h.slug', 'h.distance', 'h.stars', 'h.pricefrom', 'h.rating',
						 'h.photos', 'h.facilities', 'h.amenities', 'h.shortFacilities',
						 'l.fullName', 'l.countryName', 'l.cityName', 'ty.type as propertyType')
				->join('TPLocations as l', 'l.locationId', '=', 'h.location_id')
				->leftjoin('TPHotel_types as ty', 'ty.hid', '=', 'h.propertyType')
				->where('h.location_id', $locationid)
				->where('h.distance', '<=', $distance)
				->where('h.address', 'LIKE', $address . '%')
				->where('h.Pincode', $address)
				->limit(10)
				->get();
		}else{
			$searchresults = DB::table('TPHotel as h')
				->select('h.hotelid', 'h.id', 'h.location_id as loc_id', 'h.name', 'h.address', 'h.slug', 'h.distance', 'h.stars', 'h.pricefrom', 'h.rating',
						 'h.photos', 'h.facilities', 'h.amenities', 'h.shortFacilities',
						 'l.fullName', 'l.countryName', 'l.cityName', 'ty.type as propertyType')
				->join('TPLocations as l', 'l.locationId', '=', 'h.location_id')
				->leftjoin('TPHotel_types as ty', 'ty.hid', '=', 'h.propertyType')
				->where('h.location_id', $locationid)
				->where('h.distance', '<=', $distance)
				->limit(10)
				->get();
		}





		$lname ="";
		$countryName ="";
		if(!$searchresults->isEmpty()){
			$lname = $searchresults[0]->cityName;
			$countryName = $searchresults[0]->countryName;
		}


		return view('filter_hotel_list')->with('searchresults',$searchresults)->with('lname',$lname)->with('countryname',$countryName);
	}

	public function getfilteredhotellist(request $request){

		$gethoteltype =collect();
		$locationid = $request->get('locationid');
		$rooms = $request->get('rooms');
		if( $rooms ==""){
			$rooms = 1;
		}
		$guest = $request->get('guest');

		$Tid = $request->get('Tid');
		session(['rooms' => $rooms]);
		session(['guest' => $guest]);
		if(session()->has('checkin')){
			$getval = session('checkin');
			$value=  explode('_',$getval);
			$chkin = $value[0];
			$checout = $value[1];

		}else{
			$chkin = $request->get('checkin');
			$checout = $request->get('checkout');

		}


		$searchresults = collect();

		$datavalues = [];
		$checkinDate = $chkin;
		$checkoutDate = $checout;
		$adults = (int) $request->get('guest');

		// Initialize session variables to prevent undefined variable notices
		$session_adult_count = 0;
		$sessionCheckin = null;
		$sessionCheckout = null;
		//return session()->all();
		// Check if 'data_save' exists in the session
		if (session()->has('data_save')) {
			$sessionCheckin = session('checkinDate');
			$sessionCheckout = session('checkoutDate');
			$session_adult_count = session('table_guestcount');
			$lo_id = session('lo_id');
		}
		//return session()->all();
		if ($checkinDate != $sessionCheckin || $checkoutDate != $sessionCheckout || !session()->has('data_save') || intval($lo_id) != intval($Tid) ) {
	      DB::table('hotelbookingstemp')->truncate();

			//new code start
			$checkinDate =  $chkin;
			$checkoutDate = $checout;
			$adultsCount = $guest;
			$customerIP = '49.156.89.145';
			$childrenCount = '1';
			$chid_age = '10';
			$lang = 'en';
			$currency ='USD';
			$waitForResult ='0';
			$iata= $locationid ;//24072

			$TRAVEL_PAYOUT_TOKEN = "27bde6e1d4b86710997b1fd75be0d869";
			$TRAVEL_PAYOUT_MARKER = "299178";
			$SignatureString = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$adultsCount.":".
				$checkinDate.":".
				$checkoutDate.":".
				$chid_age.":".
				$childrenCount.":".
				$iata.":".
				$currency.":".
				$customerIP.":".
				$lang.":".
				$waitForResult;

			$signature = md5($SignatureString);

			$url ='http://engine.hotellook.com/api/v2/search/start.json?cityId='.$iata.'&checkIn='. $checkinDate.'&checkOut='.$checkoutDate.'&adultsCount='.$adultsCount.'&customerIP='.$customerIP.'&childrenCount='.$childrenCount.'&childAge1='.$chid_age.'&lang='.$lang.'&currency='.$currency.'&waitForResult='.$waitForResult.'&marker=299178&signature='.$signature;

			$response = Http::withoutVerifying()->get($url);

			if ($response->successful()) {
				$data = json_decode($response);
				if(!empty($data)){
					$searchId = $data->searchId;
					$limit = 0;
					$offset=0;
					$roomsCount=0;
					$sortAsc=0;
					$sortBy='stars';
					$SignatureString2 = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$limit.":".$offset.":".$roomsCount.":".$searchId.":".$sortAsc.":".$sortBy;
					$sig2 =  md5($SignatureString2);
					$url2 = 'http://engine.hotellook.com/api/v2/search/getResult.json?searchId='.$searchId.'&limit=0&sortBy=stars&sortAsc=0&roomsCount=0&offset=0&marker=299178&signature='.$sig2;
					$maxAttempts = 3;
					$retryInterval = 1;
					$response2 = Http::withoutVerifying()->timeout(0)->retry($maxAttempts, $retryInterval)->get($url2);

					$responseData = $response2->json();

					// $end =  date("H:i:s");

					//     return $start.'=='.$end;
					if ($responseData['status'] === 'error' && $responseData['errorCode'] === 409) {
						$status = 4;
						return 'Search is not finished.';
					}else{
						$status = 1;
					}


					if ($response2->successful()) {
						$hotel = json_decode($response2);
						$idArray = array_column($hotel->result, 'id');
						$idArray = array_filter($idArray, function ($id) {
							return isset($id);
						});
						$idArray = array_unique($idArray);

						//  $limitedIdArray = array_slice($idArray, 0, 100);
					  $searchresults = DB::table('TPHotel as h')
                                    ->select('h.hotelid', 'h.id', 'h.name', 'h.slug', 'h.stars', 'h.rating',
                                      'h.amenities', 'h.distance', 'h.slugid', 'h.room_aminities','h.Latitude','h.longnitude','h.CountryName','h.CityName','h.short_description',
                                              DB::raw('GROUP_CONCAT(CONCAT(a.shortName, "|", a.image) ORDER BY a.name SEPARATOR ", ") as amenity_info'))
                                    ->leftJoin('TPHotel_amenities as a', DB::raw('FIND_IN_SET(a.id, h.shortFacilities)'), '>', DB::raw('0'))
                                    ->whereIn('h.hotelid', $idArray)
                                    ->whereNotNull('h.slugid')
                                    ->groupBy('h.id')
						            ->orderby('h.stars','desc')
                                    ->paginate(30)
                                    ->withQueryString();

						$url = 'filter_availble_hotel.html';
						$searchresults->appends(request()->except(['_token']));

						$searchresults->setPath($url);
						$paginationLinks = $searchresults->links('hotellist_pagg.default');

						$hotelpage = 'hotelpage';

						$count_result = $searchresults->total();
						// Start code



						//	|| $adults != $session_adult_count


						// Clear specific session values
						Session::forget('checkinDate');
						Session::forget('checkoutDate');
						Session::forget('table_guestcount');
						Session::forget('data_save');

						// Store the new values in session
						Session::put('checkinDate', $checkinDate);
						Session::put('checkoutDate', $checkoutDate);
						Session::put('table_guestcount', $adults);
						Session::put('data_save', '1');
						Session::put('lo_id', $Tid);



						// If session values are different, proceed with inserting data
						if (!empty($hotel->result)) {
							foreach ($hotel->result as $hotel_results) {
								$id = $hotel_results->id;
								foreach ($hotel_results->rooms as $room) {
									$price = $room->total;
									$agencyId = $room->agencyId;
									$fullurl = $room->fullBookingURL;
									$options = $room->options;
									$desc = $room->desc;
									$agency_name = $room->agencyName;
									$agencyId = $room->agencyId;
									$beds = isset($options->beds) ? (array) $options->beds : [];
									$saveValue = in_array(1, $beds) ? 1 : null;

									// Convert the object to an array for filtering
									$trueOptions = array_keys(array_filter((array) $options, function ($value, $key) {
										return $value === true && $key != 'beds';
									}, ARRAY_FILTER_USE_BOTH));

									$optionsString = implode(',', $trueOptions);

									$datavalues[] = [
										'booking_checkin_date' => $checkinDate,
										'booking_checkout_date' => $checkoutDate,
										'hotelid' => $id,
										'rooms' => $saveValue,
										'amenity' => $optionsString,
										'room_type' => $desc,
										'agency_name' => $agency_name,
										'booking_link' => $fullurl,
										'guest' => $adults, // Use $adults here to match the session variable
										'price' => $price,
										'agency_id' => $agencyId,

									];
								}
							}

							// Insert all data at once

							if (!empty($datavalues)) {
								DB::table('hotelbookingstemp')->insert($datavalues);
								DB::table('historic_cost')->insert($datavalues);
							}
						}
						//}


						// end insert data
						// Retrieve and return the updated session values
						$updated_adult_count = session('table_guestcount');
						$updated_checkinDate = session('checkinDate');
						$updated_checkoutDate = session('checkoutDate');

						// End code
						$hotelIds = array_unique($searchresults->pluck('hotelid')->toArray()) ;
						$hotelpricedata = DB::table('hotelbookingstemp')
							->whereIn('hotelid', $hotelIds)
							->get();
						  $uniqueAgencies =null;
                        if(!$hotelpricedata->isEmpty()){
                            $uniqueAgencies = $hotelpricedata->pluck('agency_name')->unique();
                        }
						$html = view('frontend.hotel.get_filtered_hotels', [
							'hotels' => $hotelpricedata,
							'TRAVEL_PAYOUT_TOKEN' => $TRAVEL_PAYOUT_TOKEN,
							'locid' => $locationid,
							'searchresults' => $searchresults,
							'LocationId' => $Tid,
							'checkinDate' => $checkinDate,
							'checkoutDate' => $checkoutDate,
							'count_result' => $count_result,
						])->render();

						//return print_r(	session()->all());
 					if (!session()->has('filterd')) {
						// Return JSON response

						return response()->json([
							'html' => $html,
							'count_result' => $count_result,
							 'uniqueAgencies' => $uniqueAgencies,
						]);
					}

					}


				}else{
					return 'search id not found';
				}

			} else {

				return 2;
			}


		}else{

			$hotelpricedata = DB::table('hotelbookingstemp as h')
				->select('h.hotelid','h.amenity', 'h.room_type', 'h.booking_link','h.price','h.agency_id')
				->get();
			$hotelIds = array_unique($hotelpricedata->pluck('hotelid')->toArray()) ;
          //  $uniqueAgencies = $hotelpricedata->pluck('agency_name')->unique();


  		  $getagenc = DB::table('hotelbookingstemp as h')
			->leftJoin('TPHotel as t', 't.hotelid','=','h.hotelid')
			->select('agency_name')
			->get();

			$uniqueAgencies =null;
			if(!$getagenc->isEmpty()){
				$uniqueAgencies = $getagenc->pluck('agency_name')->unique();
			}

			$searchresults = DB::table('TPHotel as h')
			->select(
				'h.hotelid',
				'h.id',
				'h.name',
				'h.slug',
				'h.stars',
				'h.rating',
				'h.amenities',
				'h.distance',
				'h.slugid',
				'h.room_aminities',
				'h.CityName','h.short_description','h.Latitude','h.longnitude','h.CountryName',
			  DB::raw('GROUP_CONCAT(CONCAT(a.shortName, "|", a.image) ORDER BY a.name SEPARATOR ", ") as amenity_info')
			)
			->leftJoin('TPHotel_amenities as a', DB::raw('FIND_IN_SET(a.id, h.shortFacilities)'), '>', DB::raw('0'))
			->whereNotNull('h.slugid')
			->whereIn('h.hotelid', $hotelIds)
			->groupBy('h.id') // Group by hotel ID to use GROUP_CONCAT
			->orderby('h.stars','desc')
			->paginate(30)
			->withQueryString();

			$url = 'filter_availble_hotel.html';
			$searchresults->appends(request()->except(['_token']));
			$searchresults->setPath($url);
			$paginationLinks = $searchresults->links('hotellist_pagg.default');
			$hotelpage = 'hotelpage';

			$count_result =  $searchresults->total();

			$html = view('frontend.hotel.get_filtered_hotels', [
				'hotels' => $hotelpricedata,
				'locid' => $locationid,
				'searchresults' => $searchresults,
				'LocationId' => $Tid,
				'checkinDate' => $checkinDate,
				'checkoutDate' => $checkoutDate,
				'count_result' => $count_result,
			])->render();
	//return print_r(	session()->all());

			if (!session()->has('filterd')) {
					return response()->json([
						'html' => $html,
						'count_result' => $count_result,
						 'uniqueAgencies' => $uniqueAgencies,
					]);
			}
		}





	}
	// dowload logo and update min max price


	public function donload_agencyimg(request  $request){


    $chkin = $request->get('checkin');
    $checout = $request->get('checkout');

     $rooms = $request->get('rooms');
     $guest = $request->get('guest');

     $locationid =  $request->get('locationid');

     $searchresults =collect();


     //new code start
     $checkinDate =  $chkin;
     $checkoutDate = $checout;
     $adultsCount = $guest;
     $customerIP = '49.156.89.145';
     $childrenCount = '1';
     $chid_age = '10';
     $lang = 'en';
     $currency ='USD';
     $waitForResult ='0';
     $iata= $locationid ;//24072

     $TRAVEL_PAYOUT_TOKEN = "27bde6e1d4b86710997b1fd75be0d869";
     $TRAVEL_PAYOUT_MARKER = "299178";



    $SignatureString = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$adultsCount.":".
     $checkinDate.":".
     $checkoutDate.":".
     $chid_age.":".
     $childrenCount.":".
     $iata.":".
     $currency.":".
     $customerIP.":".
     $lang.":".
     $waitForResult;


   $signature = md5($SignatureString);
//  $signature = '3193e161e98200459185e43dd7802c2c'; iata=HKT

  $url ='http://engine.hotellook.com/api/v2/search/start.json?cityId='.$iata.'&checkIn='. $checkinDate.'&checkOut='.$checkoutDate.'&adultsCount='.$adultsCount.'&customerIP='.$customerIP.'&childrenCount='.$childrenCount.'&childAge1='.$chid_age.'&lang='.$lang.'&currency='.$currency.'&waitForResult='.$waitForResult.'&marker=299178&signature='.$signature;



       $response = Http::withoutVerifying()->get($url);

     if ($response->successful()) {


       $data = json_decode($response);
         if(!empty($data)){
           $searchId = $data->searchId;


         $limit =0;
         $offset=0;
         $roomsCount=0;
         $sortAsc=1;
         $sortBy='price';

           $SignatureString2 = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$limit.":".$offset.":".$roomsCount.":".$searchId.":".$sortAsc.":".$sortBy;
              $sig2 =  md5($SignatureString2);

              $url2 = 'http://engine.hotellook.com/api/v2/search/getResult.json?searchId='.$searchId.'&limit=0&sortBy=price&sortAsc=1&roomsCount=0&offset=0&marker=299178&signature='.$sig2;

                     $gethoteltype =collect();
                 $response2 = Http::withoutVerifying()->timeout(30)->get($url2);
            //    $response2 = Http::timeout(30)->retry(3, 100)->get($url2);
            sleep(5);

             $responseData = $response2->json();
                 if ($responseData['status'] === 'error' && $responseData['errorCode'] === 4) {
                    $status = 4;
                    return 'Search is not finished.';
                    //  $response2 = Http::withoutVerifying()->get($url2);

                }else{
                    $status = 1;
                }

             $maxRetries = 10; // Set a maximum number of retries
            //	$retryInterval = 5; // Set the interval between retries in seconds

                //for ($i = 0; $i < $maxRetries; $i++) {

                //}
                 if ($response2->successful()) {

                     $hotel = json_decode($response2);

                     $idArray = array();

                     foreach ($hotel->result as $hotelInfo) {
                         if (isset($hotelInfo->id)) {
                             $idArray[] = $hotelInfo->id;
                         }
                     }

                     $getpricenull = DB::table('TPHotel as h')
                     ->select('h.hotelid','h.minprice','h.maxprice')
                     ->whereIn('h.hotelid', $idArray)
                     ->where(function($query) {
                         $query->whereNull('h.minprice')
                               ->orWhereNull('h.maxprice');
                     })
                     ->get();

                        foreach ($hotel->result as $searchresult) {

                        $hotelid = $searchresult->id;
                     //   $getprice =  DB::table('TPHotel')->select('minprice','maxprice')->where('hotelid',$hotelid)->get();
                        // $minprice =  $getprice[0]->minprice;
                        // $maxprice =  $getprice[0]->maxprice;

                     //   if($maxprice == "" || $minprice=""){
                        if($getpricenull->isEmpty()){
                            $minPriceTotal = $searchresult->minPriceTotal;
                            $maxPrice = $searchresult->maxPrice;

                            $price=array(
                                'minprice'=>$minPriceTotal,
                                'maxprice'=> $maxPrice,
                            );

                           DB::table('TPHotel')->where('hotelid',$hotelid)->update($price);
                        }
                      }

                     foreach ($hotel->result as $searchresult) {

                        foreach ($searchresult->rooms as $room) {


                            $agencyId =  $room->agencyId;

                            $getagency = DB::table('agencies')->where('agencyId', $agencyId)->get();

                            if ($getagency->isEmpty()) {
                                $imagePath = 'public/agency-image/' . $agencyId . '.png';

                              if (!File::exists($imagePath)) {
                                $imageUrl = 'http://pics.avs.io/hl_gates/100/100/' . $agencyId . '.png';
                                $storagePath = 'public/agency-image/' . $agencyId . '.png';

                                $response = Http::withoutVerifying()->get($imageUrl);

                                if ($response->successful()) {

                                    File::put($storagePath, $response->body());

                                    DB::table('agencies')->insert([
                                        'agencyId' => $agencyId,
                                        'agencyName' => $room->agencyName,
                                        'imageUrl' => $imageUrl,
                                        'imagepath' => 'agency/' . $agencyId . '.png',
                                    ]);


                                    continue;
                                } else {

                                    return "Failed to download the image for agency ID $agencyId.";
                                }
                            } else {
                                return "Image for agency ID $agencyId already exists.";
                            }


                            }
                        }



                    }
                    //end


                     // end download logo



                 }


         }else{
             return 'search id not found';
         }

     } else {

         return 2;
     }


}

//end save logo


   public function filter_availble_hotel_old(request $request){
       $getval = $request->get('checkin') .'-'.$request->get('checkout');
       $chkin = $request->get('checkin');
       $checout = $request->get('checkout');

        // $value=  explode('-',$getval);
        // $checkin = $value[0];
        // $checkout = $value[1];
        $rooms = $request->get('rooms');
        $guest = $request->get('guest');
        $lid =  $request->get('lid');
      //  $rooms = $request->get('child1');
      //  $guest = $request->get('child2');
            // if (session()->has('checkin')) {
            //     session()->forget('checkin');
            // }


        session(['checkin' => $getval]);
        session(['rooms' => $rooms]);
        session(['guest' => $guest]);


      //  $id='675';
        // if (!empty($getval)) {
        //    $chkin =  date('Y-m-d',strtotime( $checkin));
        //    $checout =  date('Y-m-d',strtotime( $checkout));

        // } else {
        //     return 0;
        // }


        //new code start
        $checkinDate =  $chkin;
        $checkoutDate = $checout;
        $adultsCount = 2; //$guests;
        $customerIP = '49.156.89.145';
        $childrenCount = '1';
        $chid_age = '10';
        $lang = 'en';
        $currency ='USD';
        $waitForResult ='0';
        $iata= 24072;// $lid ;

        $TRAVEL_PAYOUT_TOKEN = "27bde6e1d4b86710997b1fd75be0d869";
        $TRAVEL_PAYOUT_MARKER = "299178";



       $SignatureString = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$adultsCount.":".
        $checkinDate.":".
        $checkoutDate.":".
        $chid_age.":".
        $childrenCount.":".
        $iata.":".
        $currency.":".
        $customerIP.":".
        $lang.":".
        $waitForResult;

    //  return $SignatureString;
      $signature = md5($SignatureString);
   //  $signature = '3193e161e98200459185e43dd7802c2c'; iata=HKT
//locationId
     $url ='http://engine.hotellook.com/api/v2/search/start.json?cityId='.$iata.'&checkIn='. $checkinDate.'&checkOut='.$checkoutDate.'&adultsCount='.$adultsCount.'&customerIP='.$customerIP.'&childrenCount='.$childrenCount.'&childAge1='.$chid_age.'&lang='.$lang.'&currency='.$currency.'&waitForResult='.$waitForResult.'&marker=299178&signature='.$signature;



          $response = Http::withoutVerifying()->get($url);

        if ($response->successful()) {


          $data = json_decode($response);
            if(!empty($data)){
              $searchId = $data->searchId;


            $limit =10;
            $offset=0;
            $roomsCount=0;
            $sortAsc=1;
            $sortBy='price';

              $SignatureString2 = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$limit.":".$offset.":".$roomsCount.":".$searchId.":".$sortAsc.":".$sortBy;
                 $sig2 =  md5($SignatureString2);

                 $url2 = 'http://engine.hotellook.com/api/v2/search/getResult.json?searchId='.$searchId.'&limit=10&sortBy=price&sortAsc=1&roomsCount=0&offset=0&marker=299178&signature='.$sig2;

                    $response2 = Http::withoutVerifying()->get($url2);

                    if ($response2->successful() ) {

                        $hotel = json_decode($response2);


    				 //     $responseContent = $response2->body();
					//  if (strpos($responseContent, 'errorCode: 4') !== false) {
							// Handle the case when the response contains "errorCode: 4"
						//	$hotel['data_status'] = 4;

						//}


                        return view('hotel_list_api_result',['hotels'=> $hotel,'TRAVEL_PAYOUT_TOKEN'=>$TRAVEL_PAYOUT_TOKEN,'locid'=>$locationid]);
                    }


            }else{
                return 'search id not found';
            }

        } else {

            return 2;
        }

        // [$searchresults] = DB::selectResultSets(
        //     "CALL getHotelsListFiltered('$id','$minPrice','$priceTo','$typeHotel','$userrating','$starRating','$distance','$neibourhood')"
        //     );


        // return view('filter_hotel_list')->with('searchresults',$searchresults);
    }


public function add_hoteldata()
{
    $url = 'http://engine.hotellook.com/api/v2/static/hotels.json?locationId=895&token=27bde6e1d4b86710997b1fd75be0d869';
    $response = Http::get($url);

    if ($response->successful()) {
        $hotelsData = $response->json();


        if (isset($hotelsData['pois'])) {

            $hotels = $hotelsData['pois'];

            foreach ($hotels as $hotel) {
                // Store the hotel data in the 'hotels' table
        //      echo   $hotel['location']['lon'];
        //    echo  $hotel['name'];

                // DB::table('PriyankaT')->insert([
                //     'id' => $hotel['id'],
                //         'name' => $hotel['name'],
                //     'rating' => $hotel['rating'],
                //     'category' => $hotel['category'],
                //     'lat' => $hotel['location']['lat'],
                //     'lon' => $hotel['location']['lon'],
                //     'type' => "Point",
                //     'created_at' => now(),
                //     'updated_at' => now(),
                // ]);
            }


        } else {
            $this->error('No hotels data found in the API response.');
        }
    } else {
        $this->error('Failed to fetch hotels data from the API.');
    }
}

public function addLocationfaqfont(request $request){

    $locationid = $request->get('locationIdValue');




    $getloc = DB::table('Location')->where('LocationId',$locationid)->get();
      $lname = $getloc[0]->Name;

          //kids outdoor activity


$titlesToMatch = [
  'Disney Parks & Activities',
  'Theme Parks',
  'Water Parks',
  'Aquariums',
  'Other Zoos & Aquariums',
  'Zoos',
  'Bowling Alleys',
  'Game & Entertainment Centers',
  'Mini Golf',
  'Other Fun & Games',
  'Playgrounds',
  'Rides & Activities',
  'Room Escape Games',
  "Children's Museums",
  'Parks',
  'Playgrounds',
];

$categoryIdsks = DB::table('Category')
  ->whereIn('Title', $titlesToMatch)
  ->pluck('CategoryId','Title')
  ->toArray();


$getkidsoutdoor = DB::table('Sight as s')
    ->join('Location as l','l.LocationId','=','s.LocationId')
    ->where('s.LocationId', $locationid)
    ->where('s.TATotalReviews', '>', 20)
    ->whereIn('s.CategoryId', $categoryIdsks)
    ->select('s.Title','s.SightId','s.Slug','l.slugid')
    ->limit(5)
    ->get();


$outkids_site = [];

foreach ($getkidsoutdoor as $ks) {
    $outkids_site[] = [
        'name' => $ks->Title,
        'url' => $ks->SightId.'-'.$ks->Slug,
    ];
}

//   /* delete faq if exist*/


//     DB::table('LocationQuestion')
//    ->where('LocationId', $locationid)
//    ->where('Question', 'What are the best outdoor activities in '. $lname )
//    ->delete();

// Now $outdoorloc contains the matched outdoor locations
$existingEntry_outdoor = DB::table('LocationQuestion')
->where('LocationId', $locationid)
->where('Question', 'What the best outdoor activities for Kids in '. $lname )
->exists();

if (!$existingEntry_outdoor) {
        if(!empty($outkids_site)){
            $outdoorkds = array(
                'LocationId'=>$locationid,
                'slugid'=>$getkidsoutdoor[0]->slugid,
                'Question'=>'What the best outdoor activities for Kids in '. $lname,
                'Answer' => 'The best outdoor activities for Kids in ' . $lname.' are:',
                'listing'=>json_encode($outkids_site),
                'CreatedDate' => now(),
            );
              DB::table('LocationQuestion')->insert($outdoorkds);
        }
    }else{
         'record already exist';
      //    if(!empty($outkids_site)){
      //       $outdoor = array(
      //           'LocationId'=>$locationid,
      //           'Question'=>'What are the best outdoor activities in '. $lname,
      //           'Answer' => 'The best outdoor activities in ' . $lname.' are:',
      //           'listing'=>json_encode($outdoorloc),
      //           'CreatedDate' => now(),
      //       );
      //       DB::table('LocationQuestion')->where('LocationId',$locationid)->where('Question', 'What are the best outdoor activities in '. $lname )->update($outdoor);
      //   }
    }






  //end kids outdoor activity
             DB::table('LocationQuestion')
   ->where('LocationId', $locationid)
   ->where('Question', 'What are the top attractions to visit in ' . $lname)
   ->delete();
    $existingEntry = DB::table('LocationQuestion')
          ->where('LocationId', $locationid)
          ->where('Question', 'What are the top attractions to visit in ' . $lname)
          ->exists();



      //dt
      $gettopatt = DB::table('Sight as s')
      ->join('Location as l','l.LocationId','=','s.LocationId')
      ->select('s.Title','s.SightId','s.Slug','l.slugid')
      ->where('s.LocationId',$locationid)
      ->where('s.TATotalReviews', '>', 20)
      ->orderby('s.TAAggregateRating','desc')
      ->limit(5)
      ->get();

          $sightIds = [];

          foreach ($gettopatt as $gettopatts) {
              $sights[] = [
                  'name' => $gettopatts->Title,
                  'url' => $gettopatts->SightId.'-'.$gettopatts->Slug,
              ];
          }



  if (!$existingEntry) {

      if(!empty($sights)){
      $data = array(
          'LocationId'=>$locationid,
          'slugid'=>$gettopatt[0]->slugid,
          'Question'=>'What are the top attractions to visit in '. $lname,
          'Answer' => 'The top attractions to visit in ' . $lname.' are:',
          'listing'=>json_encode($sights),
          'CreatedDate' => now(),
      );
      DB::table('LocationQuestion')->insert($data);
    }
  }else{
      'record already exist';
      if(!empty($sights)){

      $data = array(
          'LocationId'=>$locationid,
          'slugid'=>$gettopatt[0]->slugid,
          'Question'=>'What are the top attractions to visit in '. $lname,
          'Answer' => 'The top attractions to visit in ' . $lname.' are:',
          'listing'=>json_encode($sights),
          'CreatedDate' => now(),
      );

       DB::table('LocationQuestion')->where('LocationId',$locationid)->where('Question', 'What are the top attractions to visit in ' . $lname)->update($data);
    }
  }

  // outdoor activity

  $get_out_cat = DB::table('Category')->where('ParentId', 1238)->get();

  $ctids = [];

  foreach ($get_out_cat as $cat) {
      $ctids[] = $cat->CategoryId;
  }

  $getoutdoor = DB::table('Sight as s')
      ->join('Location as l','l.LocationId','=','s.LocationId')
      ->select('s.Title','s.SightId','s.Slug','l.slugid',)
      ->where('s.LocationId', $locationid)
      ->whereIn('s.CategoryId', $ctids)
      ->where('s.TATotalReviews', '>', 20)
      ->orderBy('s.TAAggregateRating', 'desc')
      ->limit(5)
      ->get();


  $outdoorloc = [];

  foreach ($getoutdoor as $sight) {
      $outdoorloc[] = [
          'name' => $sight->Title,
          'url' => $sight->SightId.'-'.$sight->Slug,
      ];
  }

  /* delete faq if exist*/


    DB::table('LocationQuestion')
   ->where('LocationId', $locationid)
   ->where('Question', 'What are the best outdoor activities in '. $lname )
   ->delete();

  // Now $outdoorloc contains the matched outdoor locations
  $existingEntry_outdoor = DB::table('LocationQuestion')
  ->where('LocationId', $locationid)
  ->where('Question', 'What are the best outdoor activities in '. $lname )
  ->exists();
  if (!$existingEntry_outdoor) {
          if(!empty($outdoorloc)){
              $outdoor = array(
                  'LocationId'=>$locationid,
                  'slugid'=>$getoutdoor[0]->slugid,
                  'Question'=>'What are the best outdoor activities in '. $lname,
                  'Answer' => 'The best outdoor activities in ' . $lname.' are:',
                  'listing'=>json_encode($outdoorloc),
                  'CreatedDate' => now(),
              );
                DB::table('LocationQuestion')->insert($outdoor);
          }
      }else{
           'record already exist';
           if(!empty($outdoorloc)){
              $outdoor = array(
                  'LocationId'=>$locationid,
                  'Question'=>'What are the best outdoor activities in '. $lname,
                  'Answer' => 'The best outdoor activities in ' . $lname.' are:',
                  'listing'=>json_encode($outdoorloc),
                  'CreatedDate' => now(),
              );
              DB::table('LocationQuestion')->where('LocationId',$locationid)->where('Question', 'What are the best outdoor activities in '. $lname )->update($outdoor);
          }
      }

      // childern
      $get_child_loc = DB::table('Category')->where('ParentId', 1349)->orWhere('ParentId', 1353)->get();

      $catid = [];

      foreach ($get_child_loc as $get_child_loc) {
          $catid[] = $get_child_loc->CategoryId;
      }

      $getsights_child = DB::table('Sight as s')
      ->join('Location as l','l.LocationId','=','s.LocationId')
      ->select('s.Title','s.SightId','s.Slug','l.slugid',)
      ->where('s.LocationId', $locationid)
      ->whereIn('s.CategoryId', $catid)
          ->where('s.TATotalReviews', '>', 20)
          ->orderBy('s.TAAggregateRating', 'desc')
          ->limit(5)
          ->get();


      $child_loc = [];

      foreach ($getsights_child as $getsights_childs) {
          $child_loc[] = [
              'name' => $getsights_childs->Title,
              'url' => $getsights_childs->SightId.'-'.$getsights_childs->Slug,
          ];
      }


      $alredyexist = DB::table('LocationQuestion')
      ->where('LocationId', $locationid)
      ->where('Question', 'What are the most popular things to do in '. $lname. ' with children')
      ->exists();
      if (!$alredyexist) {
              if(!empty($child_loc)){
                  $childlocdata = array(
                      'LocationId'=>$locationid,
                      'slugid'=>$getsights_child[0]->slugid,
                      'Question'=>'What are the most popular things to do in '. $lname. ' with children',
                      'Answer' => 'The most popular things to do in ' . $lname.' with children are:',
                      'listing'=>json_encode($child_loc),
                      'CreatedDate' => now(),
                  );
                  DB::table('LocationQuestion')->insert($childlocdata);
              }
      }else{
           'record already exist';
           if(!empty($child_loc)){
              $childlocdata = array(
                  'LocationId'=>$locationid,
                  'slugid'=>$getsights_child[0]->slugid,
                  'Question'=>'What are the most popular things to do in '. $lname. ' with children',
                  'Answer' => 'The most popular things to do in ' . $lname.' with children are:',
                  'listing'=>json_encode($child_loc),
                  'CreatedDate' => now(),
              );
              DB::table('LocationQuestion')->where('LocationId',$locationid)->where('Question', 'What are the most popular things to do in '. $lname. ' with children')->update($childlocdata);
          }
      }
      $faq =  DB::table('LocationQuestion')->where('locationid',$locationid)->get();
      return view('get_faq_data',['faq'=>$faq,'lname'=>$lname,'locid'=>$locationid]);
  }



  //end  sight faq


//start sight faq

     public function addsightfaqfront(request $request){
        $locationid = $request->get('locationIdValue');
        $sightid = $request->get('sightId');

        $getsightname = DB::table('Sight')->where('SightId',$sightid)->limit(1)->get();
           $Sname = $getsightname[0]->Title;

        $gettiming = DB::table('SightTiming')->where('SightId',$sightid)->get();

        $existingEntry = DB::table('SightListingDetailFaq')
            ->where('SightId', $sightid)
            ->where('Faquestion', 'When is ' . $Sname . ' open')
            ->exists();

        if(!$gettiming->isEmpty()){

            if (!$existingEntry) {
            $data = array(
                'SightId'=>$sightid,
                'Faquestion'=>'When is ' . $Sname . ' open',
                'Answer' => 'The ' . $Sname.' is open:',
                'timing' =>$gettiming[0]->timings,
                'CreatedOn' => now(),
                'OrderFaq' => 1,
            );
                DB::table('SightListingDetailFaq')->insert($data);

            }else{
                'record already exist';
            }
        }
            $faq =  DB::table('SightListingDetailFaq')->where('SightId',$sightid)->get();
                return view('add_explorefaq',['faq'=>$faq,'Sname'=>$Sname]);
        }

     //    aad reviews

        public function add_sightreview(request $request){

        //     if (Auth::check()) {
        //         $userId = Auth::id();
        //        $getuser = DB::table('user')->where('userid',$userId)->get();
        //        return  $email = $getuser[0]->EmailAddress;
        //          $Name = $getuser[0]->GivenName.' '.$getuser[0]->Surname;
        //        $data = array(
        //         'Name' => $Name,
        //         'Email' => $email,
        //         'ReviewDescription' => $request->get('review'),
        //         'ReviewRating' => $request->get('rating'),
        //         'SightId' =>$request->get('sightId'),
        //     );

        //     } else {

        //         $data = array(
        //             'Name' => $request->get('name'),
        //             'Email' => $request->get('email'),
        //             'ReviewDescription' => $request->get('review'),
        //             'ReviewRating' => $request->get('rating'),
        //             'SightId' =>$request->get('sightId'),
        //         );
        //     }
        //    $result = DB::table('SightReviews')->insert($data);
        //    if($result){
        //     return 'Review added successfully.';
        //    }

              $uploadedFiles = $request->file('files');

           $data = array(
            'Name' => $request->get('name'),
            'Email' => $request->get('email'),
            'ReviewDescription' => $request->get('review'),
            'IsRecommend' => $request->get('rating'),
            'SightId' =>$request->get('sightId'),
            'CreatedDate' => now(),
           );

            $result = DB::table('SightReviews')->insertGetId($data);

            if(!empty($uploadedFiles)){
                foreach ($uploadedFiles as $image) {
                    if ($image->isValid()) {
                        $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('review-images'), $imageName);


                        $data = [
                            'SightReviewId'=>$result,
                            'Image' => $imageName,
                            'created_at'=>now(),
                        ];

                        $getreview = DB::table('sight_review_image')->insert($data);
                    }
                }
             }
            if($result){
              $getrv = DB::table('SightReviews')->where('SightId',$request->get('sightId'))->get();
             if(!$getrv->isEmpty()){
                $totalReviews = $getrv->count();
                $recommendedCount = $getrv->where('IsRecommend', 1)->count();
                $notRecommendedCount = $totalReviews - $recommendedCount;
                $positiveReviews = $recommendedCount;
                $negativeReviews = $notRecommendedCount;
                $averageRating = ($positiveReviews * 5 + $negativeReviews * 1) / $totalReviews;
               $averageRatingPercentage = round(($averageRating / 5) * 100, 2);
               $averageRatingPercentage = floor($averageRatingPercentage);
             }


               $reviewhtml =  view('updated_sight_review',[ 'sightreviews'=>$getrv])->render();
               return response()->json(['reviewhtml'=>$reviewhtml,'positiveReviews'=>$positiveReviews,'negativeReviews'=>$negativeReviews,'averageRatingPercentage'=>$averageRatingPercentage]);
            }
        }
        public function add_hotelreview(request $request){

            // if (Auth::check()) {
            //     $userId = Auth::id();
            //    $getuser = DB::table('user')->where('userid',$userId)->get();
            //    return  $email = $getuser[0]->EmailAddress;
            //      $Name = $getuser[0]->GivenName.' '.$getuser[0]->Surname;
            //    $data = array(
            //     'Name' => $Name,
            //     'Email' => $email,
            //     'Description' => $request->get('review'),
            //     'Rating' => $request->get('rating'),
            //     'HotelId' =>$request->get('hotelid'),
            //     'UserId' => 0,
            //     'IsActive'=>0,
            // );

            // } else {

            //     $data = array(
            //         'Name' => $request->get('name'),
            //         'Email' => $request->get('email'),
            //         'Description' => $request->get('review'),
            //         'Rating' => $request->get('rating'),
            //         'HotelId' =>$request->get('hotelid'),
            //         'UserId' => 0,
            //         'IsActive'=>0,
            //     );

            // }
            // $result = DB::table('HotelReview')->insert($data);
            // if($result){
            //  return 'Review added successfully.';
            // }


            $data = array(
                'Name' => $request->get('name'),
                'Email' => $request->get('email'),
                'Description' => $request->get('review'),
                'Rating' => $request->get('rating'),
                'HotelId' =>$request->get('hotelid'),
                'UserId' => 0,
                'IsActive'=>0,
                'CreatedOn'=>now(),
            );
            $result = DB::table('HotelReview')->insert($data);
            if($result){
             //return 'Review added successfully.';
            }


			//send email to hotel

			  $hotel = DB::table('TPHotel')->where('id', $request->get('hotelid'))->first();

            // Customize the email subject and body
			if(!$hotel->isEmpty()){
			return	$subject = 'New Review for ' . $hotel->name;
				$body = 'A new review has been added for ' . $hotel->name . '. Rating: ' . $request->get('rating') . '. Review: ' . $request->get('review');



				$to = 'priyathakur141997@gmail.com';
			   // $to = $request->get('hotel_email');

				try {
					// Attempt to send the email
					Mail::raw($body, function ($message) use ($to, $subject) {
						$message->to($to)
								->subject($subject);
					});

					// Email sent successfully
					return response()->json(['message' => 'Email sent successfully'], 200);
				} catch (\Exception $e) {
					// Email sending failed
					\Log::error('Failed to send email: ' . $e->getMessage());
					return response()->json(['message' => 'Failed to send email: ' . $e->getMessage()], 500);
				}

			}

			//end send email

        }

       // aad reviews end


 // add reviews end

        /*--------------------Restaurant page------------------*/

       public function restaurant($id){


            $rest_id =null;
            $locationID=null;
            $slug ="";



            $parts = explode('-', $id);
            $locationID = $parts[0];
            $rest_id = $parts[1];
            array_shift($parts);
            array_shift($parts);
            $slug = implode('-', $parts);

            $rest =  DB::table('Restaurant as r')
             ->select('r.*','l.Slug as LSlug','l.Name as Lname','c.Name as Cname','l.slugid')
             ->leftjoin('Location as l','l.LocationId','=','r.LocationId')
             ->leftjoin('Country as c','c.CountryId','=','l.CountryId')
             ->where('r.RestaurantId',$rest_id)
             ->where('r.slug',$slug)
             ->where('l.Slugid',$locationID)
             ->get();

             if($rest->isEmpty()){
                  $checkgetloc =  DB::table('Location as lo')
                  ->select('lo.slugid')
                 ->where('lo.LocationId',$locationID)
                 ->get();

                      if(!$checkgetloc->isEmpty()){
                         $id =  $checkgetloc[0]->slugid;

                         return redirect()->route('restaurant_detail', [$id.'-'.$rest_id.'-'.$slug]);
                      }
                 abort('404','url not found');
             }
             if(!$rest->isEmpty()){
                $locationID = $rest[0]->LocationId;
             }


		       $breadcumb  = DB::table('Location as l')
               ->select('l.CountryId', 'l.Name as LName', 'l.Slug as Lslug', 'co.Name as CountryName','l.LocationId','co.slug as cslug','co.CountryId','cont.Name as ccName','cont.CountryCollaborationId as contid','l.slugid')
               ->Join('Country as co', 'l.CountryId', '=', 'co.CountryId')
               ->join('CountryCollaboration as cont','cont.CountryCollaborationId','=','co.CountryCollaborationId')
               ->where('l.LocationId', $locationID)
               ->get()
               ->toArray();

                $getcuisine = DB::table('RestaurantCuisineAssociation')
              ->join('RestaurantCuisine','RestaurantCuisineAssociation.RestaurantCuisineId','=','RestaurantCuisine.RestaurantCuisineId')->where('RestaurantCuisineAssociation.RestaurantId',$rest_id)->get();

              $getfetures=collect();
              $restreview=collect();
              $getfetures = DB::table('RestaurantFeatureAssociation')
              ->join('RestaurantFeature','RestaurantFeature.RestaurantFeatureId','=','RestaurantFeatureAssociation.RestaurantFeatureId')->where('RestaurantFeatureAssociation.RestaurantId',$rest_id)->get();

              $getspecialdt = DB::table('RestaurantSpecialDietAssociation')
              ->join('RestaurantSpecialDiet','RestaurantSpecialDiet.RestaurantSpecialDietId','=','RestaurantSpecialDietAssociation.RestaurantSpecialDietId')->where('RestaurantSpecialDietAssociation.RestaurantId',$rest_id)->get();

              $near_restaurant = [];
              if (!$rest->isEmpty()) {
                  if (!empty($rest[0]->Longitude)) {
                      $longitude = $rest[0]->Longitude;
                      $latitude = $rest[0]->Latitude;

                      $searchradius = 5;
                      $near_restaurant = DB::table('Restaurant as r')
                            ->leftjoin('Location as l','l.LocationId','=','r.LocationId')
                          ->select('r.Title','r.RestaurantId','r.LocationId','r.Slug','l.slugid')
                          ->selectRaw('(6371 * ACOS(COS(RADIANS(?)) * COS(RADIANS(r.Latitude)) * COS(RADIANS(r.Longitude) - RADIANS(?)) + SIN(RADIANS(?)) * SIN(RADIANS(r.Latitude)))) as distance', [$latitude, $longitude, $latitude])
                          ->whereNotNull('r.Longitude') // Filter out restaurants with NULL longitude
                          ->whereNotNull('r.Latitude')  // Filter out restaurants with NULL latitude
                          ->orderBy('distance')
                          ->limit(4)
                          ->get();
                  }
              }
               $restreview =  DB::table('RestaurantReview')->where('RestaurantId',$rest_id    )->limit(8)->get();


                 $gethoteltype = DB::table('TPHotel_types')->orderby('hid','asc')->get();


                //get tplocation
                 $gethotellistiid =collect();
                 $gethotellistiid = DB::table('Temp_Mapping as tm')
                 ->select('tpl.*')
                 ->join('TPLocations as tpl','tpl.locationId','=','tm.LocationId')
                 ->where('tm.Tid',$locationID)
                 ->get();
                 $CountryId ="";

                   if($gethotellistiid->isEmpty()){

                   $lid = DB::table('Location')->where('LocationId',$locationID)->get();

                   if(!$lid->isEmpty()){
                     $CountryId = $lid->CountryId;
                   }
                   $countryLocations = DB::table('Location as l')
                   ->select('l.LocationId')
                   ->where('l.CountryId', $CountryId)
                   ->get();

                     foreach ($countryLocations as $location) {
                         $gethotellistiid = DB::table('Temp_Mapping as tm')
                             ->select('tpl.*')
                             ->join('TPLocations as tpl', 'tpl.locationId', '=', 'tm.LocationId')
                             ->join('Location as l', 'l.locationId', '=', 'tm.Tid')
                             ->where('l.LocationId', $location->LocationId)
                             ->get();

                         // If records are found, break the loop
                         if (!$gethotellistiid->isEmpty()) {
                             // Do something with $gethotellistiid
                             break;
                         }
                     }
                 }

          //end get tplocation
         //get location parent
          $getparent = DB::table('Location')->where('LocationId', $locationID)->get();

          $locationPatent = [];
         if (!$getparent->isEmpty()){
          if ( $getparent[0]->LocationLevel != 1) {
              $loopcount = $getparent[0]->LocationLevel;
              $lociID = $getparent[0]->ParentId;
              for ($i = 1; $i < $loopcount; $i++) {
                  $getparents = DB::table('Location')->where('LocationId', $lociID)->get();
                  if (!empty($getparents)) {
                       $locationPatent[] = [
                           'LocationId' => $getparents[0]->slugid,
                           'slug' => $getparents[0]->Slug,
                           'Name' => $getparents[0]->Name,
                       ];
                      if (!empty($getparents) && $getparents[0]->ParentId != "") {
                      $lociID = $getparents[0]->ParentId;
                   }
                  } else {
                      break;
                  }
              }
          }
         }
          //end get location Parent

                return view('restaurant',['rest'=> $rest,'getcuisine'=> $getcuisine,'getfetures'=>$getfetures,'near_restaurant'=>$near_restaurant,'restreview'=>$restreview,'getspecialdiet'=>$getspecialdt,'gethotellistiid'=>$gethotellistiid,'locationPatent'=>$locationPatent,'breadcumb'=>$breadcumb]);
             }

        public function add_rest_review(Request $request) {
            $desc = $request->input('desc');
            $uploadedFiles = $request->file('files');
            $name = $request->input('name');
            $email = $request->input('email');
            $rating = $request->input('rating');
            $restid = $request->input('restid');

            $data1 = [
                'RestaurantId' => $restid,
                'Rating' => $rating,
                'Description'=> $desc,
                'Email' =>$email,
                'Name'  =>$name,
                'CreatedOn'=>now(),
            ];

             $add = DB::table('RestaurantReview')->insertGetId($data1);

         if(!empty($uploadedFiles)){
            foreach ($uploadedFiles as $image) {
                if ($image->isValid()) {
                    $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('rest-img'), $imageName);


                    $data = [
                       'RestaurantReviewId'=>$add,
                        'Image' => $imageName,
                        'created_at'=>now(),
                    ];

                    $getreview = DB::table('Restaurant_review_image')->insert($data);
                }
            }
         }


            $restreview =  DB::table('RestaurantReview')->where('RestaurantId',$restid)->limit(8)->get();

            return view('updated_rest_review',['restreview'=>$restreview]);
        }
  //restaurant
        public function restaurant_listing($id){

            $getrest = DB::table('Restaurant')->where('LocationId',$id)->get();
            $getsight = DB::table('Sight')->where('LocationId',$id)->where('IsMustSee',1)->limit(1)->get();

            $specialdiet = collect(); // Initialize a new Laravel Collection

            if (!$getrest->isEmpty()) {
                foreach ($getrest as $value) {
                    // Fetch special diets and append them to the $specialdiet collection
                    $specialdietsForRestaurant = DB::table('RestaurantSpecialDiet')
                        ->join('RestaurantSpecialDietAssociation', 'RestaurantSpecialDietAssociation.RestaurantSpecialDietId', '=', 'RestaurantSpecialDiet.RestaurantSpecialDietId')
                        ->select('RestaurantSpecialDiet.*')
                        ->where('RestaurantSpecialDietAssociation.RestaurantId', $value->RestaurantId)
                        ->get();

                    $specialdiet = $specialdiet->concat($specialdietsForRestaurant);
                }
            }

            // Now you can convert the Laravel Collection to an array and print it


            $experience = DB::table('Experience')->where('LocationId',$id)->limit(1)->get();
            return view('restaurant_listing',['getrest'=>$getrest,'specialdiet'=>$specialdiet,'getsight'=>$getsight,'experience'=>$experience]);
        }



        public function search_rest(request $request)
        {

            if(request('search')){

                $searchText = request('search');
                $lastSpaceIndex = strrpos($searchText, ' ');

                if($lastSpaceIndex != ""){
                    $locationText = trim(substr($searchText, 0, $lastSpaceIndex));
                     $countryText = trim(substr($searchText, $lastSpaceIndex + 1));
                }


                $query = DB::table('Location AS l')
                    ->select('l.LocationId AS id', DB::raw("CONCAT(l.Name, ', ', c.Name) AS displayName"),DB::raw("CONCAT(l.Slug, '-', c.Name) AS Slug"))
                    ->join('Country AS c', 'l.CountryId', '=', 'c.CountryId')
                    ->where('l.Slug', 'LIKE', $searchText . '%') // First match against location names
                    ->orWhere('l.Slug', 'LIKE', ','. $searchText. '%')
                    ->limit(5);

                    $locations = $query->get();



                if (empty($locations)) {


                    $query = DB::table('Location AS l')
                    ->select('l.LocationId AS id', DB::raw("CONCAT(l.Name, ', ', c.Name) AS displayName"),DB::raw("CONCAT(l.Slug, '-', c.Name) AS Slug"))
                    ->join('Country AS c', 'l.CountryId', '=', 'c.CountryId')
                    ->where('l.Name', 'LIKE', '%' . $locationText . '%')
                    ->where('c.Name', 'LIKE', '%' . $countryText . '%')
                    ->limit(5);
                    $locations = $query->get();

                }

                $result = [];
                if(!empty($locations)){
                    foreach ($locations as $loc) {
                        $result[] = ['id'=>$loc->id, 'Slug' => $loc->Slug,'value' => $loc->displayName,];
                        }
                }else{

                     $result[]  = [ 'value' => "Result not founds"];
                }


                return view('restaurant_search_result',['searchresults' => $result]);


             }


        }

        public function recenthistory_restaurant(Request $request){

            // if (Session::has('lastsearch')) {
            //     $serializedData = Session::get('lastsearch');
            //     $search = unserialize($serializedData);
            //     $lastFive = array_slice($search, -5);
            // $result = [];

            //     foreach ($lastFive as $value) {
            //         $result[] = [
            //             'id' => $value['id'],
            //             'Slug' => $value['key'],
            //             'value' => $value['Name'],
            //         ];
            //     }

            // }else{
                $searcht = array(
                    array(
                        'id' => 742277,
                        'key' => 'goa_india-india',
                        'Name' => 'Goa,india'
                    ),
                    array(
                        'id' => 687665,
                        'key' => 'london_ontario-Canada',
                        'Name' => 'London,Canada'
                    ),
                    array(
                        'id' => 822509,
                        'key' => 'Dubai_emirate_of_Dubai-United_Arab_Emirates',
                        'Name' => 'Dubai,United Arab Emirates'
                    )
                );

                $result = array();

                foreach ($searcht as $item) {
                    $result[] = array(
                        'id' => $item['id'],
                        'Slug' => $item['key'],
                        'value' => $item['Name']
                    );
                }


           // }

            return view('restaurant_search_result', ['searchresults' => $result]);

        }

         public function filterrestbycat(request $request){
            $locId = $request->input('locationId');
            $catname = $request->input('catid');


            $getids = DB::table('RestaurantSpecialDiet')
                ->where('Name', $catname)
                ->pluck('RestaurantSpecialDietId');

            if (!empty($getids)) {

                $getrest = DB::table('Restaurant')
                    ->join('RestaurantSpecialDietAssociation', 'RestaurantSpecialDietAssociation.RestaurantId', '=', 'Restaurant.RestaurantId')
                    ->whereIn('RestaurantSpecialDietAssociation.RestaurantSpecialDietId', $getids)
                    ->where('Restaurant.LocationId', $locId)
                    ->select('Restaurant.*')
                    ->get();
            } else {

                $getrest = [];
            }

            if ($catname == "Must See") {
                $getrest = DB::table('Restaurant')
                    ->where('LocationId', $locId)
                    ->where('IsMustSee', 1)
                    ->select('Restaurant.*')
                    ->get() ;
            }


            $experience = DB::table('Experience')->where('LocationId',$locId)->limit(1)->get();

            // return view('filter_restby_cat',['getrest'=>$getrest,'experience'=>$experience]);

              // Extract latitude and longitude into a separate array
        $locationData = [];
        if(!empty($getrest)){
            foreach ($getrest as $restaurant) {
                if (!empty($restaurant->Latitude) && !empty($restaurant->Longitude)) {
                    $locationData[] = [
                        'Latitude' => $restaurant->Latitude,
                        'Longitude' => $restaurant->Longitude,
                        'RestaurantId' => $restaurant->RestaurantId,
                    ];
                }
            }
        }


        // Encode data as JSON
        $locationDataJson = json_encode($locationData);
            return response()->json(['mapData' => $locationDataJson, 'htmlView' => view('filter_restby_cat', ['getrest'=>$getrest,'experience'=>$experience])->render()]);


        }

	/*timing */
      public function editSighttiming(Request $request){

            $selectedDaysIds = $request->input('selectedDays', []);
            $selectedCount = count($selectedDaysIds);
            $uncheckedCount = 7 - $selectedCount;
            $mainhours = $request->input('mainhours');
            // Determine if open 24 hours or closed
            $open24Hours = $request->input('open24Hours') == 1 ? 1 : 0;
            $closed = $request->input('closed') == 1 ? 7 : $uncheckedCount;

            // Get opening and closing times from the request
            $openingTimes = $request->input('openingTimes', []);
            $closingTimes = $request->input('closingTimes', []);

            // Validate array sizes
            if (count($openingTimes) !== count($closingTimes)) {
                return response()->json(['error' => 'Invalid data'], 400);
            }

            // Mapping array for day IDs to day names
            $dayIdToName = [
                'r1' => 'sun',
                'r2' => 'mon',
                'r3' => 'tue',
                'r4' => 'wed',
                'r5' => 'thu',
                'r6' => 'fri',
                'r7' => 'sat'
            ];

            // Create an array to store the time data
            $timeData = [];

            // Loop through all days and set their timing data
           if($open24Hours == 1){
                $sameTime = [
                    'start' => '00:00',
                    'end' => '23:59',
                ];

                // Set the same time for all selected days
                foreach ($selectedDaysIds as $dayId) {
                    $dayName = $dayIdToName[$dayId];
                    $timeData[$dayName] = $sameTime;
                }

            }else{
    foreach ($dayIdToName as $dayId => $dayName) {
                $index = array_search($dayId, $selectedDaysIds);
                if ($index !== false) {
                    // Day is selected, use provided opening and closing times
                    $timeData[$dayName] = [
                        'start' => $openingTimes[$index],
                        'end' => $closingTimes[$index]
                    ];

                }elseif($open24Hours == 1){

                } else {
                    // Day is not selected, set default start and end times
                    $timeData[$dayName] = [
                        'start' => '00:00',
                        'end' => '00:00'
                    ];
                }
            }

            }

            // Create the final JSON object
            $jsonData = [
                'time' => $timeData,
                'open_closed' => [
                    'open24' => $open24Hours,
                    'closed' => $closed
                ]
            ];

            $jsonString = json_encode($jsonData);

            // Check if the record exists and update or insert accordingly
            $gettiming = DB::table('SightTiming')->where('SightId', $request->input('sightid'))->first();
            if($gettiming === null){
                $data = [
                    'SightId' => $request->input('sightid'),
                    'timings' => $jsonString,
                    'dt_added' => now(),
                    'dt_modify' => now(),
                    'main_hours' =>$mainhours,
                ];
                DB::table('SightTiming')->insert($data);
            } else {
                $data = [
                    'timings' => $jsonString,
                    'dt_modify' => now(),
                    'main_hours' => $mainhours,
                ];
                DB::table('SightTiming')->where('SightId', $request->input('sightid'))->update($data);
            }

            // Fetch the updated timing data
            $gettiming = DB::table('SightTiming')->where('SightId', $request->input('sightid'))->get();

            return view('updated_timing', ['gettiming' => $gettiming]);
        }

	//end timing


	public function add_sight_images(Request $request)
	{
	  $sightid = $request->input('sight_id');

            foreach ($request->file('files') as $key => $file) {
                $title = $request->input('title')[$key];
                $originalName = $file->getClientOriginalName();
              //  $extension = $file->getClientOriginalExtension(); // Get the file extension

                $randomNumber = rand(1000, 9999);
                $filename = time() . '_' . $randomNumber . '_' . $originalName; // Use the original name for display purposes
                $file->move('public/sight-images', $filename);

                $data = [
                    'title' => $title,
                    'Image' => $filename,
                    'Sightid' => $sightid,
                  // Save the extension to the database
                ];

                DB::table('Sight_image')->insert($data);
            }
            $Sight_image = DB::table('Sight_image')
            ->where('Sightid',$sightid)
            ->get();


            return view('sight_image',['Sight_image'=>$Sight_image]);
	}
	public function about_us(){
            return view('about_us');
    }
      public function term_condition(){
            return view('term_condition');
	  }

	public function trust_and_safety(){
		return view('trust_and_safety');
	}
	public function career(){
		return view('career');
	}

	public function accessibility_statement(){
		return view('accessibility_statement');
	}
	public function contact_us(){
        return view('contact_us');
    }
	public function privacy_policy(){
		return view('privacy_policy');
	}

	public function hotel_homepage(){
        return view('hotel_homepage');
     }


     public function list_hotelsloc(Request $request)
     {



          if (request('search')) {
             $searchText = request('search');
                $city = request('city');

           // $locations = Cache::remember($cacheKey, 600, function() use ($searchText) {

             $query = DB::table('Location as l')
             ->join('TPHotel as h', 'h.LocationId', '=', 'l.LocationId')
             ->select('l.slugid AS id', DB::raw("CONCAT(l.Name, ', ', l.country) AS displayName"), 'l.Slug')
             ->distinct()
             ->where('l.Name', 'LIKE', $searchText . '%')
             ->limit(5);
              $locations = $query->get();


              //check parent
              if ($locations->isEmpty()) {
                 $query = DB::table('Location AS l')
                     ->select('l.slugid AS id',
                             DB::raw('REPLACE(CONCAT(l.Name, ", ", l.country), "-district", "") as displayName'),
                             'l.Slug as Slug')
                    ->join('TPHotel as h', 'h.LocationId', '=', 'l.LocationId')
                     ->leftjoin('Location as parent', 'parent.LocationId', '=', 'l.ParentId')
                     ->leftjoin('Location as parent2', 'parent2.LocationId', '=', 'parent.ParentId')
                     ->leftjoin('Location as parent3', 'parent3.LocationId', '=', 'parent2.ParentId')
                     ->leftjoin('Location as parent4', 'parent4.LocationId', '=', 'parent3.ParentId')
                     ->where(function($query) use ($searchText) {
                         $query->orWhere(DB::raw('CONCAT(l.Name, " ", IFNULL(parent.Name, ""), " ", IFNULL(parent2.Name, ""), " ", IFNULL(parent3.Name, ""), " ", IFNULL(parent4.Name, ""), " ", IFNULL(l.Name, ""))'), 'LIKE', '%' . $searchText . '%');

                         $query->orWhere(DB::raw('CONCAT(l.Name, " ", IFNULL(parent2.Name, ""), " ", IFNULL(parent.Name, ""), " ", IFNULL(parent3.Name, ""), " ", IFNULL(parent4.Name, ""), " ", IFNULL(l.Name, ""))'), 'LIKE', '%' . $searchText . '%');
                 $query->orWhere(DB::raw('CONCAT(l.Name, " ", IFNULL(parent2.Name, ""), " ", IFNULL(parent3.Name, ""), " ", IFNULL(parent3.Name, ""), " ", IFNULL(parent4.Name, ""), " ", IFNULL(l.Name, ""))'), 'LIKE', '%' . $searchText . '%');
                         $query->orWhere(DB::raw('CONCAT(l.Name, " ", IFNULL(parent2.Name, ""), " ", IFNULL(parent4.Name, ""), " ", IFNULL(parent3.Name, ""), " ", IFNULL(parent4.Name, ""), " ", IFNULL(l.Name, ""))'), 'LIKE', '%' . $searchText . '%');
                     $query->orWhere(DB::raw('CONCAT(l.Name, " ", IFNULL(parent2.Name, ""), " ", IFNULL(parent3.Name, ""), " ", IFNULL(parent4.Name, ""), " ", IFNULL(l.Name, ""))'), 'LIKE', '%' . $searchText . '%');
                         $query->orWhere(DB::raw('CONCAT(l.Name, " ", IFNULL(parent3.Name, ""), " ", IFNULL(parent2.Name, ""), " ", IFNULL(parent.Name, ""), " ", IFNULL(parent4.Name, ""), " ", IFNULL(l.Name, ""))'), 'LIKE', '%' . $searchText . '%');

                         $query->orWhere(DB::raw('CONCAT(l.Name, " ", IFNULL(parent4.Name, ""), " ", IFNULL(parent2.Name, ""), " ", IFNULL(parent.Name, ""), " ", IFNULL(parent4.Name, ""), " ", IFNULL(l.Name, ""))'), 'LIKE', '%' . $searchText . '%');

                         $query->orWhere(DB::raw('CONCAT(l.Name, " ",IFNULL(parent.Name, ""), " ",IFNULL(parent2.Name, ""), " ", IFNULL(l.Name, ""))'), 'LIKE',  $searchText . '%');
                         $query->orWhere(DB::raw('CONCAT(l.Name, " ",IFNULL(parent2.Name, ""), " ",IFNULL(parent.Name, ""), " ", IFNULL(l.Name, ""))'), 'LIKE',  $searchText . '%');
                         $query->orWhere(DB::raw('CONCAT(l.Name, " ",IFNULL(parent.Name, ""), " ", IFNULL(l.Name, ""))'), 'LIKE',  $searchText . '%');
                         $query->orWhere(DB::raw('CONCAT(l.Name, " ",IFNULL(parent2.Name, ""), " ", IFNULL(l.Name, ""))'), 'LIKE',  $searchText . '%');
                         $query->orWhere(DB::raw('CONCAT(l.Name, " ",IFNULL(parent3.Name, ""), " ", IFNULL(l.Name, ""))'), 'LIKE',  $searchText . '%');
                         $query->orWhere(DB::raw('CONCAT(l.Name, " ",IFNULL(parent4.Name, ""), " ", IFNULL(l.Name, ""))'), 'LIKE',  $searchText . '%');
                         $query->orWhere(DB::raw('CONCAT(l.Name, " ", IFNULL(l.Name, ""))'), 'LIKE',  $searchText . '%');
                     })
                     ->limit(5);

                 $locations = $query->get();


          }

              //end check parent

         //start parent



       if ($locations->isEmpty()) {

         $searchWords = explode(' ', $searchText);

             $gp= DB::table('Location');

             foreach ($searchWords as $word) {
                 $gp->where('Slug', 'LIKE', '%' . $word . '%');
             }

             $getpare = $gp->get();

             $ParentId = "";
             if(!$getpare->isEmpty()){
                 $locname = $getpare[0]->Name;
                 $ParentId = $getpare[0]->ParentId;
                 $query = DB::table('Location AS l')
                 ->select('l.slugid AS id',
                         DB::raw('REPLACE(CONCAT("' . $locname . '", ", ", l.country), "-district", "") as displayName'),
                         'l.Slug as Slug')
                 ->join('TPHotel as h', 'h.LocationId', '=', 'l.LocationId')
                 ->where('l.LocationId', $ParentId)
                 ->limit(5);
                 $locations = $query->get();
             }
         }

          if ($locations->isEmpty()) {
             $getpare2 = DB::table('Location')->where('LocationId', $ParentId)->get();
             $ParentId2="";
             if(!$getpare2->isEmpty()){
                 $ParentId2 = $getpare2[0]->ParentId;
                 $LocationLevel = $getpare2[0]->LocationLevel;
                 if($LocationLevel != 1){
                 $query = DB::table('Location AS l')
                 ->select('l.slugid AS id',
                         DB::raw('REPLACE(CONCAT("' . $locname . '", ", ", l.Name), "-district", "") as displayName'),
                         'l.Slug as Slug')
                 ->join('TPHotel as h', 'h.LocationId', '=', 'l.LocationId')
                 ->where('l.LocationId',$ParentId2)
                 ->limit(5);
                 $locations = $query->get();
                 }
             }
         }

         if ($locations->isEmpty()) {
                 $ParentId3="";
                 $getpare3 = DB::table('Location')->where('LocationId', $ParentId2)->get();
                 if(!$getpare3->isEmpty()){
                     $ParentId3 = $getpare3[0]->ParentId;
                     $LocationLevel = $getpare3[0]->LocationLevel;
                     if($LocationLevel != 1){
                     $query = DB::table('Location AS l')
                     ->select('l.slugid AS id',
                             DB::raw('REPLACE(CONCAT("' . $locname . '", ", ", l.country), "-district", "") as displayName'),
                             'l.Slug as Slug')
                     ->join('TPHotel as h', 'h.LocationId', '=', 'l.LocationId')
                   //  ->join('Temp_Mapping as mp','mp.Tid','=','l.LocationId')
                    // ->join('TPLocations as tpl','tpl.id','=','mp.LocationId')
                   //  ->where('l.LocationId',$ParentId3)
                     ->limit(5);
                     $locations = $query->get();
                     }
                 }
         }

         if ($locations->isEmpty()) {
             $ParentId4="";
             $getpare4 = DB::table('Location')->where('LocationId', $ParentId3)->get();
             if(!$getpare4->isEmpty()){
                 $ParentId4 = $getpare3[0]->ParentId;
                 $LocationLevel = $getpare4[0]->LocationLevel;
                 if($LocationLevel != 1){
                     $query = DB::table('Location AS l')
                     ->select('l.slugid AS id',
                             DB::raw('REPLACE(CONCAT("' . $locname . '", ", ", l.country), "-district", "") as displayName'),
                             'l.Slug as Slug')
                   ->join('TPHotel as h', 'h.LocationId', '=', 'l.LocationId')
                   //  ->join('Country as c', 'c.CountryId', '=', 'l.CountryId')
                    // ->join('Temp_Mapping as mp','mp.Tid','=','l.LocationId')
                    // ->join('TPLocations as tpl','tpl.id','=','mp.LocationId')
                     ->where('l.LocationId',$ParentId4)
                     ->limit(5);
                     $locations = $query->get();
                 }
             }
         }

       //end parent id
        //start hotel
             $h = 0;
             if ($locations->isEmpty()) {

                   $query = DB::table('TPHotel AS h')
                     ->select(
                         'h.id AS hid',
                         DB::raw('REPLACE(CONCAT(h.name, ", ", h.CityName), "-district", "") as displayName'),
                         'h.slug AS Slug',
                         'h.slugid AS id',
                         'h.CityName'
                     )
                     ->whereNotNull('h.slugid')
                     ->where(function($q) use ($searchText) {
                         $q->where(DB::raw("LOWER(CONCAT(h.name, ' ', h.CityName))"), 'LIKE',  strtolower($searchText) . '%');
                     })
                   //  ->orderByRaw('CASE WHEN LOWER(h.CityName) = ? THEN 1 ELSE 2 END', [strtolower($city)])
                     ->distinct()
                     ->limit(5);

                     $locations = $query->get();

                 $h =1;

              }
         //end hotel
     //seach location country



             $result = [];
             if (!empty($locations)) {
                 if($h==1){
                         foreach ($locations as $loc) {
                             $result[] = ['id' => $loc->id, 'Slug' =>$loc->hid.'-'.$loc->Slug, 'value' => $loc->displayName,'hotel'=>1];

                           }
                     }else{
                         foreach ($locations as $loc) {
                $result[] = ['id' => $loc->id, 'Slug' => strtolower( str_replace(' ', '_',$loc->Slug)), 'value' => $loc->displayName,'hotel'=>0];
                         }
                   }
             } else {
                 $result[] = [] ;//['value' => "Result not found"];
             }
              return response()->json($result);
          //   return view('hotel_loc_result', ['searchresults' => $result]);
         }
     }

public function recenthotels(Request $request){


        $searcht = array(
            array(
                'id' => 1255000400080007,
                'key' => 'fuegen-austria',
                'Name' => 'Fuegen,Austria'
            ),

        );

        $result = array();

        foreach ($searcht as $item) {
            $result[] = array(
                'id' => $item['id'],
                'Slug' => $item['key'],
                'value' => $item['Name']
            );



    }
    return response()->json($result);
   // return view('hotel_loc_result', ['searchresults' => $result]);

}




	public function insert_data(){

    $timeout = PHP_INT_MAX;

    $TRAVEL_PAYOUT_TOKEN = "27bde6e1d4b86710997b1fd75be0d869";
    $TRAVEL_PAYOUT_MARKER = "299178";

    $batchSize = 1;
    $delaySeconds = 130;
    $delayafterloop = 60;
    $offset = 0;

    $getamenties = "http://engine.hotellook.com/api/v2/static/amenities/en.json?token=".$TRAVEL_PAYOUT_TOKEN;
    $allmnt = Http::withoutVerifying()->timeout($timeout)->get($getamenties);
    $mnt = json_decode($allmnt);
       $rateLimitLimit = $allmnt->header('X-RateLimit-Limit');
        $rateLimitRemaining = $allmnt->header('X-RateLimit-Remaining');
        $rateLimitReset = $allmnt->header('X-RateLimit-Reset');

        // If rate limit headers are present, you can use them to avoid exceeding the limit
        if ($rateLimitRemaining == 0) {
            // You've hit the rate limit, so wait until it resets
            $resetTimestamp = (int)$rateLimitReset;
            $resetSeconds = max($resetTimestamp - time(), 0); // Time in seconds until the limit resets
            sleep($resetSeconds);
        }

    do {
        // Select a batch of records with a limit and offset
        $data = DB::table('TPHotel')
            ->select('location_id')
        //    ->orderBy('location_id', 'desc')
			->where('amenities',null)
			->where('location_id','!=',1677251)
			 ->distinct()
            ->limit($batchSize)
            ->get();
        // Select a batch of records with a limit and offset

        if ($data->isEmpty()) {
            // No more records to process, exit the loop
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

                $rLimit = $gethot->header('X-RateLimit-Limit');
				$rateLRemaining = $gethot->header('X-RateLimit-Remaining');
				$rateLReset = $gethot->header('X-RateLimit-Reset');
			 if ($rateLRemaining == 0) {

				 $resetTimest = (int)$rateLReset;
				 $restSeconds = max($resetTimest - time(), 0); // Time in seconds until the limit resets
				 sleep($restSeconds);
			  }


               if (is_object($dt2) && property_exists($dt2, 'hotels')) {
                   $hotels = $dt2->hotels;
           $j =1;
                   // Insert the fetched hotel data into your database here
			  $b =1;
         foreach ($hotels as $hotel) {

			 $b++;


					      $hid = $hotel->id;
				 $check_amenti = DB::table('TPHotel')
					->select('location_id')
					->where('hotelid',$hid)
					->whereNotNull('amenities')
					->get();

          if ($check_amenti->isEmpty()) {


                 //start mnt
                       $facilities = $hotel->facilities;
                       $amenitiesNames = [];


			           $languageString = [];
                       $roomsaminityString = [];
                       $propertymntString = [];
			  			$languages =[];
						 $roommnt = [];

                        foreach ($facilities as $facilityId) {
                           $matchingAmenity = array_filter($mnt, function ($amenity) use ($facilityId) {
                               return $amenity->id == $facilityId;
                           });



                           if (!empty($matchingAmenity)) {
                               $amenityName = reset($matchingAmenity)->name;
                               $groupName = reset($matchingAmenity)->groupName;

                               $amenitiesNames[] = $amenityName;

							 $roomsaminity[$groupName] = $amenityName;
							$roommnt = json_encode($roomsaminity);

                               if($groupName  == "Staff languages"){
                                $languages [] = $amenityName;
                               }





                           }
                       }
                       $languageString = implode(', ', $languages);
                       $amenitiesString = implode(', ', $amenitiesNames);


                      //end mnt



                    date_default_timezone_set('Asia/Kolkata');
                    //start ct
                    $ctid =$hotel->cityId;





                       $star =$hotel->stars;
                       $pricefrom = $hotel->pricefrom;
                       $rating = $hotel->rating;
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


                       $shortFacilities = $hotel->shortFacilities;
                       $loc = $hotel->location;
                       $lon = $loc->lon;
                       $lat = $loc->lat;
                       $link = $hotel->link;


                        $dt = array(

                            'pricefrom' =>$pricefrom,
                            'rating' => $rating,
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
                            'cntFloors' => null,
                            'facilities' => null,
                            'amenities' => $amenitiesString ,
                            'shortFacilities' => json_encode($shortFacilities),
                            'Latitude' => $lon,
                            'longnitude' => $lat,
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
  							'Languages' => $languageString,
							'room_aminities' => $roommnt,

                        );

                        DB::table('TPHotel')->where('hotelid',$hid)->update($dt);

	 sleep($delayafterloop);
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



	    public function update_location_geo(){


            $chunkSize = 2;
            $delaySeconds =2;
            $offset =0;

             //start session code
             $maxRequestsPerDay = 5000;
            //  session_start();
            //     $sessions = session()->all();
            //    //	return print_r($sessions);
            //  if (!session()->has('requestsMade')) {
            //     $_SESSION['requestsMade'] = 0;

            //     }

            //     if (!session()->has('lastResetDate')) {
            //     $_SESSION['lastResetDate'] = date('Y-m-d');
            // }
           //session end


            $skipOuterLoop = false;

            while (true) {
                 //session start
                // if (date('Y-m-d') !== $_SESSION['lastResetDate']) {
                //     $_SESSION['requestsMade'] = 0;
                //     $_SESSION['lastResetDate'] = date('Y-m-d');
                // }

                //session end

                    $locations = DB::table('Location as l')
                    ->select('l.LocationId','l.LocationLevel','l.ParentId','l.Name as Place','c.Name as country',DB::raw('(SELECT IFNULL(l1.Name,"") FROM Location as l1 where l1.LocationId=l.ParentId) as Address') )
                    ->join('Country as c','c.CountryId','=','l.CountryId')
                    ->where('l.lat',null)
                    ->offset($offset)
                    ->limit($chunkSize)
                    ->orderby('LocationId','desc')
                    ->get();


    //   return print_r($locations);

                if ($locations->isEmpty()) {

                    break;
                }

                foreach ($locations as $location) {
                    $place = $location->Place;
                    $Address = $location->Address;
                    $country = $location->country;



                    $add = "";
                    if ($place !== "") {
                        $add .= $place;
                    }
                    if (!empty($Address)) {
                        $add .= ',' . $Address;
                    }

                 $add .= ',' . $country;

                 //pk.5afe8ffa47e9ad018968fd02a9c3e0ec
                 //pk.58953ccedd458eeabd120ef183e78efb
                $api = "https://us1.locationiq.com/v1/search?key=pk.5afe8ffa47e9ad018968fd02a9c3e0ec&q=$add&format=json&limit=1";
               //   $api = "https://us1.locationiq.com/v1/autocomplete?q=$add&tag=place%3Acity&key=pk.5afe8ffa47e9ad018968fd02a9c3e0ec&limit=1";
                          //session
                        //        session(['requestsMade' => session('requestsMade', 0) + 1]);
                         //session

                   $getdata = Http::withoutVerifying()->get($api);
                    $decode = json_decode($getdata, true);
                   if (isset($decode['error']) && $decode['error'] == 'Unable to geocode') {
                                        // Set the flag to true and break out of the inner loop
                                        $skipOuterLoop = true;
                                        break;
                  }

                //    print_r($location);
                //      return print_r($decode);

                    sleep($delaySeconds);
                     if (isset($decode['error'])) {
                        // Set the flag to true and break out of the inner loop
                      return $decode['error'];
                    }


                    //session start
                   // if ($locations->isEmpty() || $_SESSION['requestsMade'] >= $maxRequestsPerDay) {
                   //     break;
                   // }
                    //sesstion end


                   if ($skipOuterLoop) {

                    $skipOuterLoop = false;
                    continue;

                }

                    if (is_array($decode)) {
                        foreach ($decode as $value) {

                          $lat = null;
                          $long =  null;

                          if (is_array($value) && isset($value['lat'])) {
                            $lat = $value['lat'];
                           }
                           if (is_array($value) && isset($value['lon'])) {
                            $long = $value['lon'];
                           }

                          $countpt = $location->LocationLevel;
                          $par = $countpt +1;


                        if (is_array($value) && isset($value['display_name'])) {
                              $parts =  explode(',',$value['display_name']);
                         }else{
                             $parts =[];
                        }


                                $countpt = count($parts);
                                $countpt = count($parts);


            //	    echo '-------'. $long;

                   if($lat != null && $long !=null){
                           $Locname ="";
                                $variableName="";
                                $country_name="";
                        //    if ($countpt >= $par) {
                                $Locname = isset($parts[0]) ? $parts[0] : null;
                                    $country_name = isset($parts[$countpt - 1]) ? $parts[$countpt - 1] : null;
                            //       $country_name =  $value['country'];
                                    $parents = [];
                                    for ($i = 1; $i <= $par - 2; $i++) {
                                        $variableName = 'parent' . $i;
                                        $parents[$i - 1] = isset($parts[$i]) ? $parts[$i] : null;
                                    }
                                    $parentsString = implode(', ', $parents);

                                //    return  $country_name .'--'.$Locname.'---'.$parentsString;

                            //    }



                                    //      echo $Locname.'--';
                                    //      echo  $country_name .'--';
                                    //    echo $parentsString;

                                     date_default_timezone_set('Asia/Kolkata');
                                       $parentid = $location->ParentId;

                                       $valuearray = array(
                                        'Lat'=>$lat,
                                        'Longitude'=>$long,
                                        'updated_at'=>now(),
                                       );
                                          $Locname = trim($Locname);
                                          $country_name = trim($country_name);


                                        if(empty($parentid)){

                                            $update = DB::table('Location as l')
                                                ->join('Country as c', 'l.CountryId', '=', 'c.CountryId')
                                                ->where('c.Name', $country_name)
                                                ->where('l.Name', $Locname)
                                                ->update($valuearray);
                                        }else{

                                            $parentsString = trim(str_replace(['ë', 'ç'], ['e', 'c'], $parentsString));



                                            $update = DB::table('Location as l')
                                            ->select('l.LocationId')
                                            ->join('Country as c', 'l.CountryId', '=', 'c.CountryId')
                                            ->Join('Location as pt', 'l.ParentId', '=', 'pt.LocationId')
                                            ->where('c.Name', $country_name)
                                            ->where('l.Name', $Locname)
                                            ->where('pt.Name', 'LIKE', $parentsString);

                                            $getid = $update->get();
                                          //  print_r($getid);
                                            $locId = 0;
                                            if (!$getid->isEmpty()) {
                                                $firstRecord = $getid->first();
                                                $locId = $firstRecord->LocationId;
                                            }

                                             DB::table('Location')->where('LocationId',$locId)->update($valuearray);
                                          // if($locId !=0){
                                          //          return '---'.$locId;
                                         //       }


                                        }

                                }

                        }
                    } else {

                        echo "Error decoding JSON data";
                    }


                }

                sleep($delaySeconds);

                $offset += $chunkSize;
            }
        sleep($delaySeconds);
        }


	  //experience

   public function experince($id){
    $idSegments = explode('-', $id);

    $locationID = 0;
    $sighid ="";
    $location_slug="";
    $sight_slug ="";

    $parts = explode('-', $id);
    if (count($idSegments) > 1) {
           $locationID = $parts[0];
           $exp_id = $idSegments[1];
       $sight_slug = implode('-', array_slice($parts, 2, -1));
       $location_slug =  end($parts);
     $slug = $sight_slug.'-'.$location_slug;
    } else {
        $explocname = $id;
    }
      $getexprv =collect();

    $getexprv = DB::table('ExperienceReview')->where('ExperienceId',$exp_id)->get();

    $getexp = DB::table('Experience')
    ->leftJoin('ExperienceContactDetail','ExperienceContactDetail.ExperienceId','=','Experience.ExperienceId')
    ->select('Experience.*','ExperienceContactDetail.Address','ExperienceContactDetail.Email','ExperienceContactDetail.Phone','c.Name as Cname','l.Slug as LSlug','l.Name as Lname','l.slugid')
    ->Join('Location as l','l.LocationId','=','Experience.LocationId')
    ->leftJoin('Country as c','c.CountryId','=','c.CountryId')
    ->where('Experience.ExperienceId',$exp_id)
    ->where('Experience.Slug',$slug)
    ->where('l.slugid',$locationID)
    ->limit(1)
    ->get();
    //  ->paginate(1);
//return  print_r($getexp);

    if(!$getexp->isEmpty()){
        $locationID =$getexp[0]->LocationId;
    }

    $languageData = collect();
    if(!$getexp->isEmpty()){
  //  foreach ($getexp as $val) {
        $languageData = DB::table('ExperienceLanguageAssociation')
            ->leftJoin('ExperienceLanguage', 'ExperienceLanguage.ExperienceLanguageId', '=', 'ExperienceLanguageAssociation.ExperienceLanguageId')
            ->where('ExperienceLanguageAssociation.ExperienceId', $getexp[0]->ExperienceId)
            ->get();

        // Store language data for each experience in the array

    //}

   }
   $breadcumb  = DB::table('Location as l')
   ->select('l.CountryId', 'l.Name as LName', 'l.Slug as Lslug', 'co.Name as CountryName','l.LocationId','co.slug as cslug','co.CountryId','cont.Name as ccName','cont.CountryCollaborationId as contid','l.slugid')
   ->Join('Country as co', 'l.CountryId', '=', 'co.CountryId')
   ->join('CountryCollaboration as cont','cont.CountryCollaborationId','=','co.CountryCollaborationId')
   ->where('l.LocationId', $locationID)
   ->get()
   ->toArray();

   $iteneryday = [];

    if(!$getexp->isEmpty()){
        foreach($getexp as $val){
          $iten =  DB::table('ExperienceItninerary as e')
          ->join('Sight as s','s.SightId','=','e.SightId')
          ->join('Location as l','l.LocationId','=','s.LocationId')
          ->select('e.*','l.slugid','s.Slug')
          ->where('e.ExperienceId',$val->ExperienceId)->orderby('e.ItninerarySequence','asc')->get();
            $iteneryday[$val->ExperienceId] = $iten;
        }
    }

  // return print_r( $iteneryday );
    $itenerytime = [];
    if(!$getexp->isEmpty()){
        foreach($getexp as $exp){
            $getiten =  DB::table('ExperienceItnineraryStartEnd')->where('ExperienceId',$val->ExperienceId)->get();
            $itenerytime[$val->ExperienceId] = $getiten;
        }

    }

    $reviews = [];
    $nearby_exp =collect();
    $getreview =collect();
    if(!$getexp->isEmpty()){

        foreach($getexp as $exp){
            $getreviews =  DB::table('ExperienceItnineraryStartEnd')->where('ExperienceId',$val->ExperienceId)->get();
            $reviews[$val->ExperienceId] = $getreviews;
        }
        $latitude = $getexp[0]->Latitude;
        $longitude = $getexp[0]->Longitude;
        if($latitude !="" &&  $longitude !=""){
            //similar experience
            $searchradius = 50;
            $nearby_exp= DB::table("Experience as exp")
            ->select('ExperienceId', 'Name','Slug','LocationId','slugid','Img1','adult_price',
                        DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                * cos(radians(exp.Latitude))
                * cos(radians(exp.Longitude) - radians(" . $longitude . "))
                + sin(radians(" . $latitude . "))
                * sin(radians(exp.Latitude))) AS distance"))
            ->having('distance', '<=', $searchradius)
            ->where('LocationId',$locationID)
            ->whereNotIn('ExperienceId', [$exp_id])
            //   ->orWhere('stars',$star)
            ->orderBy('distance')
            ->limit(5)
            ->get();
            //end similar experience

        }else{
            $nearby_exp= DB::table("Experience as exp")

            ->select('ExperienceId', 'Name','Slug','LocationId','adult_price','slugid','Img1')
            ->where('LocationId',$locationID)
            ->where('ExperienceId','!=', $exp_id)
            ->limit(5)
            ->get();
        }

            $getreview = DB::table('ExperienceReview')->where('ExperienceId',$exp_id)->get();


    }
$getparent = DB::table('Location')->select('LocationLevel','ParentId')->where('LocationId', $locationID)->get();

$locationPatent = [];

if (!empty($getparent) && $getparent[0]->LocationLevel != 1) {
   $loopcount = $getparent[0]->LocationLevel;
   $lociID = $getparent[0]->ParentId;
   for ($i = 1; $i < $loopcount; $i++) {
       $getparents = DB::table('Location')->select('LocationId','Slug','Name','ParentId','slugid')->where('LocationId', $lociID)->get();
       if (!empty($getparents)) {
            $locationPatent[] = [
                'LocationId' => $getparents[0]->slugid,
                'slug' => $getparents[0]->Slug,
                'Name' => $getparents[0]->Name,
            ];
           if (!empty($getparents) && $getparents[0]->ParentId != "") {
           $lociID = $getparents[0]->ParentId;
        }
       } else {
           break; // Exit the loop if no more parent locations are found
       }
   }
}




      //get tplocation
      $gethotellistiid =collect();
      $gethotellistiid = DB::table('Temp_Mapping as tm')
      ->select('tpl.*')
      ->join('TPLocations as tpl','tpl.locationId','=','tm.LocationId')
      ->where('tm.Tid',$locationID)
      ->get();
      $CountryId ="";

        if($gethotellistiid->isEmpty()){

        $lid = DB::table('Location')->where('LocationId',$locationID)->get();

        if(!$lid->isEmpty()){
          $CountryId = $lid[0]->CountryId;
        }
        $countryLocations = DB::table('Location as l')
        ->select('l.LocationId')
        ->where('l.CountryId', $CountryId)
        ->get();

          foreach ($countryLocations as $location) {
              $gethotellistiid = DB::table('Temp_Mapping as tm')
                  ->select('tpl.*')
                  ->join('TPLocations as tpl', 'tpl.locationId', '=', 'tm.LocationId')
                  ->join('Location as l', 'l.locationId', '=', 'tm.Tid')
                  ->where('l.LocationId', $location->LocationId)
                  ->get();

              // If records are found, break the loop
              if (!$gethotellistiid->isEmpty()) {
                  // Do something with $gethotellistiid
                  break;
              }
          }
      }



//end get tplocation   Latitude varchar(50)  Longitude



    return view('experience',['getexp'=>$getexp,'languageData' => $languageData,'iteneryday'=>$iteneryday,'itenerytime'=>$itenerytime,'reviews'=>$reviews,'gethotellistiid'=>$gethotellistiid,'nearby_exp'=>$nearby_exp,'locationPatent'=>$locationPatent,'getexprv'=>$getexprv,'breadcumb'=>$breadcumb]);
}
	//weather
	    public function weather(){
            return view('weather');
        }
      //filter hotel list
          public function hotel_all_filters(request $request)
        {

			  session(['filterd' => 1]);
           $locationid = $request->get('locationid');
           $chkin = $request->get('Cin');
           $checout = $request->get('Cout');
           $rooms = $request->get('rooms');
           $guest = $request->get('guest');
           $minPrice = $request->get('priceFrom');
           $priceTo = $request->get('priceTo');
           $typeHotel = $request->get('hoteltype');
           $starRating = $request->get('starRating');
           $mnt = $request->get('mnt');
           $Smnt = $request->get('Smnt');
           $agencydt = $request->get('agency');

           $sort_field = '';
           $sort_direction = '';
           $sort_by = $request->get('sort_by');
           if($sort_by !=""){
                if ($sort_by == 'Recommended') {
                    $sort_field = 'h.rating';
                    $sort_direction = 'desc';
                }
                $sort_direction = trim($sort_direction);
           }



            $stars = [];
            if (is_string($starRating)) {
                $stars = explode(',', $starRating);
            }
            $amenities = [];
            if(is_string($mnt)){
                $amenities = explode(',', $mnt);
            }

            $Specamenities = [];
            if(is_string($Smnt)){
                $Specamenities = explode(',', $Smnt);
            }
            $typeHotels = [];
            if (is_string($typeHotel)) {
                $typeHotels = explode(',', $typeHotel);
            }
            //agency
            $agency =[];
            if(is_string($agencydt)){
                $agency = explode(',', $agencydt);
            }
          //  $address = $request->get('address');
            $distance = $request->get('distance');
            if($distance ==0){
                $distance = "";
            }

            $searchresults = DB::table('TPHotel as h')
           ->join('hotelbookingstemp as hotemp','hotemp.hotelid','=','h.hotelid')
           ->leftJoin('TPHotel_amenities as a', DB::raw('FIND_IN_SET(a.id, h.shortFacilities)'), '>', DB::raw('0'))
           ->select(
               'h.hotelid', 'h.id', 'h.name', 'h.slug', 'h.stars', 'h.rating','h.Latitude','h.longnitude',
               'h.amenities', 'h.distance', 'h.slugid', 'h.room_aminities', 'h.CityName','h.short_description','h.CountryName',
                DB::raw('GROUP_CONCAT(CONCAT(a.shortName, "|", a.image) ORDER BY a.name SEPARATOR ", ") as amenity_info')
           )
		->distinct()
           ->whereNotNull('h.slugid');
			//->distinct('h.id');

            if (!empty($stars)) {
                $searchresults->whereIn('h.stars', $stars);
            }
            if (!empty($typeHotels)) {
                $searchresults->whereIn('h.propertyType',$typeHotels);
            }
            if (!empty($amenities)) {
                foreach ($amenities as $amenity) {
                    $searchresults->where('h.amenities', 'LIKE', '%' . $amenity . '%');
                }
            }
            //new code
            if (!empty($agency)) {
                $searchresults->whereIn('hotemp.agency_name', $agency);
            }
           if (!empty($Specamenities)) {
                $searchresults->where(function ($q) use ($Specamenities) {
                    foreach ($Specamenities as $amenity) {
                        $q->where('hotemp.amenity', 'LIKE', '%' . $amenity . '%');
                    }
                });
            }

            if ($minPrice !="" && $priceTo !="") {
                $searchresults->where('hotemp.price', '>=', $minPrice)
                            ->where('hotemp.price', '<=', $priceTo);
            }

            if (!empty($sort_by)) {

				if($sort_by == 'Top-rated'){
					$searchresults->where('h.rating', '>=', 8.0);
                }elseif ($sort_by == 'Price: High to Low') {

                    $searchresults->orderBy(DB::raw('(SELECT MIN(hotemp.price) FROM hotelbookingstemp hotemp WHERE hotemp.hotelid = h.hotelid)'), 'desc');
                }elseif ($sort_by == 'Price: Low to High') {

                    $searchresults->orderBy(DB::raw('(SELECT MIN(hotemp.price) FROM hotelbookingstemp hotemp WHERE hotemp.hotelid = h.hotelid)'), 'asc');
                }else{
                    $searchresults->orderBy($sort_field, $sort_direction);
                }


            }else{
			 $searchresults->orderBy('h.stars', 'desc');
			}
         //   $searchresults = $searchresults->distinct('h.id')

            $searchresults = $searchresults->groupBy('h.id', 'hotemp.price', 'h.hotelid', 'h.name', 'h.slug', 'h.stars', 'h.rating', 'h.amenities', 'h.distance', 'h.slugid', 'h.room_aminities', 'h.CityName');   //groupBy('h.id');
		//	  $searchresults = $searchresults->distinct('h.hotelid');
            $searchresults = $searchresults->paginate(30)->withQueryString();


            $sthotelIds = $searchresults->pluck('hotelid')->toArray() ;

            $hotelpricedata = DB::table('hotelbookingstemp')
            ->whereIn('hotelid', $sthotelIds)
            ->get();


            //end new code


           $resultcount = $searchresults->total();
           $result = view('all_hotel_filter')
               ->with('searchresults',$searchresults)
               ->with('hotels',$hotelpricedata)
			    ->with('chkin',$chkin)
                ->with('checout',$checout)
			    ->with('resultcount',$resultcount)
			   ->render();
           return response()->json(['result'=>$result,'resultcount'=>$resultcount]);
        }

//neighbourhood
	    public function hotel_neighbourhood(request $request){
       $getval = $request->get('checkin') .'_'.$request->get('checkout');
        $chkin = $request->get('checkin');
        $checout = $request->get('checkout');

         $rooms = $request->get('rooms');
         $guest = $request->get('guest');
         $slug = $request->get('slug');
         $locationid =  $request->get('locationid');
	     $neighbourhood="";
         $neighbourhood =  $request->get('neighborhood');

         if( $locationid == ""){
            $locationid =  $request->get('lid');
         }else{
            $locationid = $locationid;
         }

          $fullname = $request->get('locname');
          $countryname ="";
       //   $lname ="";
       $Neighborhood =[];
       $Neighborhood = DB::table('Neighborhood as n')
       ->select('n.NeighborhoodId','n.LocationID','n.Name','Hn.hotelid')
       ->Leftjoin('TPHotelNeighbourhood as Hn','n.NeighborhoodId','=','Hn.NeighborhoodID')
       ->where('n.NeighborhoodId',$neighbourhood)->where('n.LocationID',$locationid)->get()->toArray();
         if(empty($Neighborhood)){
            abort('404','Neibourhood not found');
         }
       $getloc = DB::table('Temp_Mapping as tm')
         ->join('Location as l','l.LocationId','=','tm.Tid')
         ->select('tm.locationId')
         ->where('tm.Tid',$locationid)
         ->get();

         if(!$getloc->isEmpty()){
            $locationid = $getloc[0]->locationId;
         }

       if(!empty($Neighborhood)){
           if($fullname ==""){
          // $fullname = $Neighborhood[0]->Name;
           }
           $neibhood_name = $Neighborhood[0]->Name;

       }
            $getloc = DB::table('TPLocations')->select('fullName','cityName','countryName')->where('id',$locationid)->get();

            if(!$getloc->isEmpty()){
                if($fullname ==""){
                    $fullname = $getloc[0]->fullName;
            }
                $lname2 = $getloc[0]->cityName;
                $countryName = $getloc[0]->countryName;
            }
            $getloclink =collect();

            $getloclink = DB::table('Temp_Mapping as tm')
            ->join('Location as l','l.LocationId','=','tm.Tid')
            ->select('l.*')
            ->where('tm.LocationId',$locationid)
            ->get();

            $locationPatent = [];
            if(!$getloclink->isEmpty()){


                if (!$getloclink->isEmpty() &&  $getloclink[0]->LocationLevel != 1) {
                    $loopcount =  $getloclink[0]->LocationLevel;

                    $lociID = $getloclink[0]->ParentId;
                    for ($i = 1; $i < $loopcount; $i++) {
                        $getparents = DB::table('Location')->where('LocationId', $lociID)->get();
                        if (!empty($getparents)) {
                            $locationPatent[] = [
                                'LocationId' => $getparents[0]->LocationId,
                                'slug' => $getparents[0]->Slug,
                                'Name' => $getparents[0]->Name,
                            ];
                            if (!empty($getparents) && $getparents[0]->ParentId != "") {
                            $lociID = $getparents[0]->ParentId;
                        }
                        } else {
                            break; // Exit the loop if no more parent locations are found
                        }
                    }
                }
            }

            $hotelpage ="hotelpage";
            $gethoteltype = DB::table('TPHotel_types')->orderby('hid','asc')->get();
            return view('hotel_Neighbourhood',['locid'=>$locationid,'gethoteltype'=>$gethoteltype,'fullname'=>$fullname,'lname2'=>$lname2,'countryname'=>$countryName,'getloclink'=>$getloclink,'locationPatent'=>$locationPatent,'neibhood_name'=>$neibhood_name,'locationid'=>$locationid,'hotelpage'=>$hotelpage]);


     }
    public function fetch_neighb_listing_with_api(request $request){
        $searchresults =collect();
        $getval = $request->get('checkin') .'_'.$request->get('checkout');

        $chkin = $request->get('checkin');
        $checout = $request->get('checkout');
        $rooms = $request->get('rooms');
        $guest = $request->get('guest');
        $slug = $request->get('slug');
        $fullname = $request->get('locname');
        $id =   $request->get('neighborhood');
        $locationid =  $request->get('locationid');

        $Neighborhood = [];

        $Neighborhood = DB::table('TPHotelNeighbourhood')
        ->select('hotelid')
        ->where('NeighborhoodID',$id)->get()->toArray();


        $getloc = DB::table('TPLocations')->select('fullName','cityName','countryName')->where('id',$locationid)->get();
        $cityName ="";
        $countryName ="";
        if(!$getloc->isEmpty()){
            $countryName = $getloc[0]->countryName;
            $cityName =$getloc[0]->cityName;
        }

         session(['checkin' => $getval]);
         session(['rooms' => $rooms]);
         session(['guest' => $guest]);

         //new code start
         $checkinDate =  $chkin;
         $checkoutDate = $checout;
         $adultsCount = $guest;
         $customerIP = '49.156.89.145';
         $childrenCount = '1';
         $chid_age = '10';
         $lang = 'en';
         $currency ='USD';
         $waitForResult ='0';
         $iata= $locationid ;//24072

         $TRAVEL_PAYOUT_TOKEN = "27bde6e1d4b86710997b1fd75be0d869";
         $TRAVEL_PAYOUT_MARKER = "299178";



        $SignatureString = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$adultsCount.":".
         $checkinDate.":".
         $checkoutDate.":".
         $chid_age.":".
         $childrenCount.":".
         $iata.":".
         $currency.":".
         $customerIP.":".
         $lang.":".
         $waitForResult;


       $signature = md5($SignatureString);

      $url ='http://engine.hotellook.com/api/v2/search/start.json?cityId='.$iata.'&checkIn='. $checkinDate.'&checkOut='.$checkoutDate.'&adultsCount='.$adultsCount.'&customerIP='.$customerIP.'&childrenCount='.$childrenCount.'&childAge1='.$chid_age.'&lang='.$lang.'&currency='.$currency.'&waitForResult='.$waitForResult.'&marker=299178&signature='.$signature;

           $response = Http::withoutVerifying()->get($url);

         if ($response->successful()) {


           $data = json_decode($response);
             if(!empty($data)){
               $searchId = $data->searchId;


             $limit =0;
             $offset=0;
             $roomsCount=0;
             $sortAsc=1;
             $sortBy='price';

               $SignatureString2 = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$limit.":".$offset.":".$roomsCount.":".$searchId.":".$sortAsc.":".$sortBy;
                  $sig2 =  md5($SignatureString2);

                  $url2 = 'http://engine.hotellook.com/api/v2/search/getResult.json?searchId='.$searchId.'&limit=0&sortBy=price&sortAsc=1&roomsCount=0&offset=0&marker=299178&signature='.$sig2;

                         $gethoteltype =collect();
				     $response2 = Http::withoutVerifying()->timeout(30)->get($url2);
                //    $response2 = Http::timeout(30)->retry(3, 100)->get($url2);


				 $responseData = $response2->json();
				 	if ($responseData['status'] === 'error' && $responseData['errorCode'] === 4) {
						$status = 4;
						return 'Search is not finished.';
						//  $response2 = Http::withoutVerifying()->get($url2);

					}else{
						$status = 1;
					}

				 $maxRetries = 10;
                     if ($response2->successful()) {

                         $hotel = json_decode($response2);


                        $idArray = array();

                        // Iterate through the $hotel array
                        foreach ($hotel->result as $hotelInfo) {
                            // Check if the 'id' key exists in the inner array
                            if (isset($hotelInfo->id)) {
                                // Add the 'id' value to the $idArray
                                $idArray[] = $hotelInfo->id;
                            }
                        }
                        //return  print_r($idArray);
                        $neighborhoodHotelIds = array_map(function ($item) {
                            return $item->hotelid;
                        }, $Neighborhood);

                        // Find common hotel IDs
                        $commonHotelIds = array_intersect($neighborhoodHotelIds, $idArray);


                         // end download logo
                            $searchresults = DB::table('TPHotel as h')
                         ->select('h.hotelid','h.id', 'h.name', 'h.address', 'h.slug', 'h.cityId', 'h.iata', 'h.location_id as loc_id','h.stars', 'h.pricefrom', 'h.rating', 'h.popularity', 'h.amenities', 'h.distance', 'h.propertyType')

                         ->whereIn('h.hotelid',$commonHotelIds)->paginate(5)  ;

                        $searchresults->appends($request->except('_token'));
                         $searchresults->setPath('hotel_neighborhood.html');

                         return view('frontend.hotel.get_hotel_landing_result',['hotels'=> $hotel,'locid'=>$locationid,'searchresults'=>$searchresults,'fullname'=>$fullname,'cityName'=>$cityName,'countryname'=>$countryName]);
                     }


             }else{
                 return 'search id not found';
             }

         } else {

             return 2;
         }
     }
     public function hotel_neiborhood_listing($id,$nid,$slug)
     {
        $gethoteltype = [];
         $searchresults=[];
         $neib = DB::table('Neighborhood')->select('Name')->where('NeighborhoodID', $nid)->where('slug',$slug)->where('LocationID',$id)->get();
         if($neib->isEmpty()){
            abort('404','url not found');
         }
         $lname = "";
          $breadcumb  = DB::table('Location as l')
             ->select('l.CountryId', 'l.Name as LName', 'l.Slug as Lslug', 'co.Name as CountryName','l.LocationId','co.slug as cslug','co.CountryId','cont.Name as ccName','cont.CountryCollaborationId as contid')
             ->leftJoin('Country as co', 'l.CountryId', '=', 'co.CountryId')
             ->leftJoin('CountryCollaboration as cont','cont.CountryCollaborationId','=','co.CountryCollaborationId')
             ->where('l.LocationId', $id)
             ->get()
             ->toArray();
         if(!$neib->isEmpty()){
          $neibhood_name=$neib[0]->Name;
         }
         $neib_ids = DB::table('TPHotelNeighbourhood')->where('NeighborhoodID', $nid)->pluck('hotelid')->toArray();
             $searchresults = DB::table('TPHotel as tph')
             ->join('Temp_Mapping as t','t.LocationId','=','tph.location_id')
             ->select('tph.hotelid', 'tph.id', 'tph.name', 'tph.address', 'tph.slug', 'tph.cityId', 'tph.iata', 'tph.location_id as loc_id', 'tph.stars', 'tph.pricefrom', 'tph.rating', 'tph.popularity', 'tph.amenities', 'tph.distance', 'tph.propertyType','t.slugid')

             ->whereIn('hotelid', $neib_ids)
             ->paginate(10);

             $locmap = DB::table('Temp_Mapping')
             ->where('Tid',$id)
             ->get();
             if(!$locmap->isEmpty()){
               $id = $locmap[0]->LocationId;
                $loc = DB::table('TPLocations')
                ->where('id',$id)
                ->get();
                if(!$loc->isEmpty()){
                    $lname2 =$loc[0]->cityName;
                    $countryname = $loc[0]->countryName;
                }
             }


     //   $end  =  date("H:i:s");

      //  echo  $start .'---'.$st2 .'---'. $end ;

        $gethoteltype = DB::table('TPHotel_types')->orderby('hid','asc')->get();


        $getloclink =collect();

        $getloclink = DB::table('Temp_Mapping as tm')
        ->join('Location as l','l.LocationId','=','tm.Tid')
        ->select('l.*')
        ->where('l.LocationId',$id)
        ->get();

	    $locationPatent = [];
        if(!$getloclink->isEmpty()){


            if (!$getloclink->isEmpty() &&  $getloclink[0]->LocationLevel != 1) {
                $loopcount =  $getloclink[0]->LocationLevel;

                $lociID = $getloclink[0]->ParentId;
                for ($i = 1; $i < $loopcount; $i++) {
                    $getparents = DB::table('Location')->where('LocationId', $lociID)->get();
                    if (!empty($getparents)) {
                        $locationPatent[] = [
                            'LocationId' => $getparents[0]->slugid,
                            'slug' => $getparents[0]->Slug,
                            'Name' => $getparents[0]->Name,
                        ];
                        if (!empty($getparents) && $getparents[0]->ParentId != "") {
                        $lociID = $getparents[0]->ParentId;
                    }
                    } else {
                        break; // Exit the loop if no more parent locations are found
                    }
                }
            }
        }
        $hotelpage ='hotelpage';
         return view('hotel_neiborhood_listing')->with('searchresults',$searchresults)->with('gethoteltype',$gethoteltype)->with('neibhood_name',$neibhood_name)->with('countryname',$countryname)->with('getloclink',$getloclink)->with('locationPatent',$locationPatent)->with('lname2',$lname2)->with('locationid',$id)->with('hotelpage',$hotelpage)->with('breadcumb',$breadcumb);
     }
  public function hotel_landing($lid,$landid,$slug)
     {

        $id = str_replace('ld',' ',$landid);
        $locid =$lid;
        $gethoteltype = [];
        $searchresults=[];

        $getloc = DB::table('Temp_Mapping as m')
        ->select('m.LocationId')
        ->where('m.slugid',$lid)
        ->get();
       // return print_r($getloc);
        if(!$getloc->isEmpty()){
            $lid = $getloc[0]->LocationId;
        }

        $getlanding = DB::table('TPHotel_landing')
        ->select('Amenities','Rating','location_id')
        ->where('id', $id)
        ->where('slug', $slug)
        ->where('location_id',$lid)
        ->get();

		if($getlanding->isEmpty()){
            abort('404','url not found');
         }
        $amenities='';
        $Rating=[];
        $locationid = "";
        if(!$getlanding->isEmpty()){
            $locationid = $getlanding[0]->location_id;
            if($getlanding[0]->Amenities !=""){

                // if(is_string($getlanding[0]->Amenities)){
                //     $amenities = explode(',', $getlanding[0]->Amenities);
                // }

                if(!empty($getlanding[0]->Amenities)){
                    $amenities = json_decode($getlanding[0]->Amenities);
                }
            }
            $Rating=[];
            if($getlanding[0]->Rating !=""){

                 $rating[] = $getlanding[0]->Rating;
                if(!empty($rating)){
                    $Rating[] = json_decode($getlanding[0]->Rating);
                }


                // if (strpos($rating, ',') !== false) {
                //     $explodedRating = explode(',', $rating);
                //     $Rating = array();

                //     foreach ($explodedRating as $value) {
                //         $Rating[] = trim($value);
                //     }


                // } else {
                //     $Rating[] = $getlanding[0]->Rating;
                // }
           }
         //  return print_r( $Rating);

        }
       $start =  date("H:i:s");


     $searchresults = DB::table('TPHotel as tph')
     //->join('Temp_Mapping as m','m.LocationId','=','tph.location_id')
    ->select('tph.hotelid', 'tph.id', 'tph.name', 'tph.slug','tph.location_id as loc_id', 'tph.stars', 'tph.pricefrom', 'tph.rating', 'tph.amenities','tph.distance','tph.room_aminities','tph.Languages','tph.slugid')
    ->where('tph.location_id', $locationid);
	if (!empty($amenities) || !empty($Rating)) {
		$searchresults->where(function ($query) use ($amenities, $Rating) {

			if (!empty($amenities)) {
				foreach ($amenities as $amenity) {
					$query->orWhere('tph.amenities', 'LIKE', '%' . $amenity . '%');
				}
			}
            if (!empty($amenities)) {
				foreach ($amenities as $amenity) {
					$query->orWhere('tph.room_aminities', 'LIKE', '%' . $amenity . '%');
				}
			}
            if (!empty($amenities)) {
				foreach ($amenities as $amenity) {
					$query->orWhere('tph.Languages', 'LIKE', '%' . $amenity . '%');
				}
			}
			if (!empty($Rating)) {
				$query->orWhereIn('tph.stars',$Rating);
			}
		});
	}


	$searchresults = $searchresults->limit(7)->get();

	     $st2 =  date("H:i:s");




        $countryname ="";
        $lname2="";
        $lname ="";


        $getloc = DB::table('TPLocations')->select('cityName','countryName')->where('id',$locationid)->get();
            if(!$getloc->isEmpty()){
            $lname2 =$getloc[0]->cityName;
            $countryname = $getloc[0]->countryName;
            $lname =$getloc[0]->cityName;
            }
  $end  =  date("H:i:s");
            $neibhood_name =str_replace('-',' ',$slug);




        $gethoteltype = DB::table('TPHotel_types')->orderby('hid','asc')->get();


        $getloclink =collect();

        $getloclink = DB::table('Temp_Mapping as tm')
        ->join('Location as l','l.LocationId','=','tm.Tid')
        ->select('l.*')
        ->where('tm.LocationId',$locid)
        ->get();
	  $breadcumb=[];
        if(!$getloclink->isEmpty()){
        $locationid = $getloclink[0]->LocationId;


            $breadcumb  = DB::table('Location as l')
            ->select('l.CountryId', 'l.Name as LName', 'l.Slug as Lslug', 'co.Name as CountryName','l.LocationId','co.slug as cslug','co.CountryId','cont.Name as ccName','cont.CountryCollaborationId as contid','l.slugid')
            ->Join('Country as co', 'l.CountryId', '=', 'co.CountryId')
            ->join('CountryCollaboration as cont','cont.CountryCollaborationId','=','co.CountryCollaborationId')
            ->where('l.LocationId', $locationid)
            ->get()
            ->toArray();
        }
//   return print_r($getloclink);
	    $getlocationexp = collect();
        $locationPatent = [];
        if(!$getloclink->isEmpty()){
            $locationid = $getloclink[0]->LocationId;
            $getlocationexp = DB::table('Location')->select('LocationId','Name','Slug','slugid')->where('LocationId', $locationid)->get();

            if (!$getloclink->isEmpty() &&  $getloclink[0]->LocationLevel != 1) {

                $loopcount =  $getloclink[0]->LocationLevel;

                $lociID = $getloclink[0]->ParentId;
                for ($i = 1; $i < $loopcount; $i++) {
                    $getparents = DB::table('Location')->where('LocationId', $lociID)->get();
                    if (!empty($getparents)) {
                        $locationPatent[] = [
                            'LocationId' => $getparents[0]->slugid,
                            'slug' => $getparents[0]->Slug,
                            'Name' => $getparents[0]->Name,
                        ];
                        if (!empty($getparents) && $getparents[0]->ParentId != "") {
                        $lociID = $getparents[0]->ParentId;
                    }
                    } else {
                        break; // Exit the loop if no more parent locations are found
                    }
                }
            }
        }
	$hotelpage ='hotelpage';
         return view('frontend.hotel.hotel_landing')->with('searchresults',$searchresults)->with('gethoteltype',$gethoteltype)->with('sname',$neibhood_name)->with('countryname',$countryname)->with('getloclink',$getloclink)->with('locationPatent',$locationPatent)->with('lname2',$lname2)->with('locationid',$id)->with('locid',$locid)->with('lname',$lname)->with('amenities',$amenities)->with('Rating',$Rating)->with('getloc',$getloc)->with('hotelpage',$hotelpage)->with('getlocationexp',$getlocationexp)->with('breadcumb',$breadcumb);
     }
   //hotel landing with date
  //hotel landing with date
   public function hotel_landing_with_date(request $request){
      $start  =  date("H:i:s");
         $requiredParameters = ['checkin', 'checkout','guest','id'];
        foreach ($requiredParameters as $param) {
            if (!$request->filled($param)) {
                abort(404, "The '$param' parameter is required.");
            }
        }
        if (!$request->filled('locationid') && !$request->filled('lid')) {
            abort(404, 'Either locationid or lid is required.');
        }

          $getval = $request->get('checkin') .'_'.$request->get('checkout');

          $chkin = $request->get('checkin');
          $checout = $request->get('checkout');
          $rooms = $request->get('rooms');
          $guest = $request->get('guest');
          $slug = $request->get('slug');
          $landid =  $request->get('id');
          $id = str_replace('ld',' ',$landid);
          $locationid =  $request->get('locationid');

          $fullname = $request->get('locname');
          $countryname ="";
          $lname ="";
          $lname2 ="";
          $neibhood_name =str_replace('-',' ',$slug);

          $getloc = DB::table('TPLocations')->select('fullName','cityName','countryName')->where('id',$locationid)->get();
            if($getloc->isEmpty()){
                abort(404,'Not FOUND');
            }
          if(!$getloc->isEmpty()){
              if($fullname ==""){
                  $fullname = $getloc[0]->fullName;
          }
              $lname2 = $getloc[0]->cityName;
              $lname = $getloc[0]->cityName;
              $countryName = $getloc[0]->countryName;

          }

          $gethoteltype = DB::table('TPHotel_types')->orderby('hid','asc')->get();
          $searchresults =collect();
	     $hotelpage = 'hotelpage';
	       $getloclink =collect();

          $getloclink = DB::table('Temp_Mapping as tm')
          ->join('Location as l','l.LocationId','=','tm.Tid')
          ->select('l.*')
          ->where('tm.LocationId',$locationid)
          ->get();

	      $breadcumb =[];
          if(!$getloclink->isEmpty()){
            $locationid = $getloclink[0]->LocationId;
            $breadcumb  = DB::table('Location as l')
            ->select('l.CountryId', 'l.Name as LName', 'l.Slug as Lslug', 'co.Name as CountryName','l.LocationId','co.slug as cslug','co.CountryId','cont.Name as ccName','cont.CountryCollaborationId as contid')
            ->Join('Country as co', 'l.CountryId', '=', 'co.CountryId')
            ->join('CountryCollaboration as cont','cont.CountryCollaborationId','=','co.CountryCollaborationId')
            ->where('l.LocationId', $locationid)
            ->get()
            ->toArray();
        }
  //   return print_r($getloclink);
          $getlocationexp = collect();
          $locationPatent = [];
          if(!$getloclink->isEmpty()){
              $locationid = $getloclink[0]->LocationId;
              $getlocationexp = DB::table('Location')->select('LocationId','Name','Slug')->where('LocationId', $locationid)->get();

              if (!$getloclink->isEmpty() &&  $getloclink[0]->LocationLevel != 1) {

                  $loopcount =  $getloclink[0]->LocationLevel;

                  $lociID = $getloclink[0]->ParentId;
                  for ($i = 1; $i < $loopcount; $i++) {
                      $getparents = DB::table('Location')->where('LocationId', $lociID)->get();
                      if (!empty($getparents)) {
                          $locationPatent[] = [
                              'LocationId' => $getparents[0]->LocationId,
                              'slug' => $getparents[0]->Slug,
                              'Name' => $getparents[0]->Name,
                          ];
                          if (!empty($getparents) && $getparents[0]->ParentId != "") {
                          $lociID = $getparents[0]->ParentId;
                      }
                      } else {
                          break; // Exit the loop if no more parent locations are found
                      }
                  }
              }
          }

          return view('frontend.hotel.hotel_landing_with_date',['searchresults'=>$searchresults,'locid'=>$locationid,'fullname'=>$fullname,'lname2'=>$lname2,'countryname'=>$countryName,'neibhood_name'=>$neibhood_name,'locationid'=>$locationid,'lname'=>$lname,'gethoteltype'=>$gethoteltype,'hotelpage'=>$hotelpage,'getlocationexp'=>$getlocationexp,'locationPatent'=>$locationPatent,'breadcumb'=>$breadcumb]);

       }

       public function get_hotel_landing_result(request $request){

        $start  =  date("H:i:s");
        $searchresults =collect();
        $getval = $request->get('checkin') .'_'.$request->get('checkout');
        $chkin = $request->get('checkin');
        $checout = $request->get('checkout');

        $rooms = $request->get('rooms');
        $guest = $request->get('guest');
        $slug = $request->get('slug');
        $landid =  $request->get('id');
         $id = str_replace('ld',' ',$landid);
        $locationid =  $request->get('locationid');
        //new code
        $md  =  date("H:i:s");
        $getlanding = DB::table('TPHotel_landing')->select('Amenities','Rating','location_id')->where('id', $id)->where('slug', $slug)->get();


        $amenities=[];
        $Rating=[];
        $locationid = "";
        if(!$getlanding->isEmpty()){
            $locationid = $getlanding[0]->location_id;

           $amenities="";
			$Rating="";
			$locationid = "";
			if(!$getlanding->isEmpty()){
				$locationid = $getlanding[0]->location_id;
				if($getlanding[0]->Amenities !=""){

					// if(is_string($getlanding[0]->Amenities)){
					//     $amenities = explode(',', $getlanding[0]->Amenities);
					// }

					if(!empty($getlanding[0]->Amenities)){
						$amenities = json_decode($getlanding[0]->Amenities);
					}
				}
				$Rating='';
				if($getlanding[0]->Rating !=""){

					 $rating = $getlanding[0]->Rating;
					if(!empty($rating)){
						$Rating = json_decode($getlanding[0]->Rating);
					}
				}
        }
        $end  =  date("H:i:s");

       //end new code


         session(['checkin' => $getval]);
         session(['rooms' => $rooms]);
         session(['guest' => $guest]);

         //new code start
         $checkinDate =  $chkin;
         $checkoutDate = $checout;
         $adultsCount = $guest;
         $customerIP = '49.156.89.145';
         $childrenCount = '1';
         $chid_age = '10';
         $lang = 'en';
         $currency ='USD';
         $waitForResult ='0';
         $iata= $locationid ;//24072

         $TRAVEL_PAYOUT_TOKEN = "27bde6e1d4b86710997b1fd75be0d869";
         $TRAVEL_PAYOUT_MARKER = "299178";

        $SignatureString = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$adultsCount.":".
         $checkinDate.":".
         $checkoutDate.":".
         $chid_age.":".
         $childrenCount.":".
         $iata.":".
         $currency.":".
         $customerIP.":".
         $lang.":".
         $waitForResult;

          $signature = md5($SignatureString);
          $url ='http://engine.hotellook.com/api/v2/search/start.json?cityId='.$iata.'&checkIn='. $checkinDate.'&checkOut='.$checkoutDate.'&adultsCount='.$adultsCount.'&customerIP='.$customerIP.'&childrenCount='.$childrenCount.'&childAge1='.$chid_age.'&lang='.$lang.'&currency='.$currency.'&waitForResult='.$waitForResult.'&marker=299178&signature='.$signature;

             $response = Http::withoutVerifying()->get($url);

         if ($response->successful()) {
             $data = json_decode($response);
             if(!empty($data)){
               $searchId = $data->searchId;
             $limit =0;
             $offset=0;
             $roomsCount=0;
             $sortAsc=1;
             $sortBy='price';

            $SignatureString2 = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$limit.":".$offset.":".$roomsCount.":".$searchId.":".$sortAsc.":".$sortBy;
             $sig2 =  md5($SignatureString2);

            $url2 = 'http://engine.hotellook.com/api/v2/search/getResult.json?searchId='.$searchId.'&limit=0&sortBy=price&sortAsc=1&roomsCount=0&offset=0&marker=299178&signature='.$sig2;
            $gethoteltype =collect();
            $response2 = Http::withoutVerifying()->timeout(30)->get($url2);
            $responseData = $response2->json();
                if ($responseData['status'] === 'error' && $responseData['errorCode'] === 4) {
                    $status = 4;
                    return 'Search is not finished.';
                }else{
                    $status = 1;
                }
                 $maxRetries = 10;
                     if ($response2->successful()) {
                        $hotel = json_decode($response2);
                        $idArray = array();
                        foreach ($hotel->result as $hotelInfo) {
                            if (isset($hotelInfo->id)) {
                                $idArray[] = $hotelInfo->id;
                            }
                        }
                        $st2  =  date("H:i:s");


                               $searchresults = DB::table('TPHotel as tph')
                          ->select('tph.hotelid', 'tph.id', 'tph.name', 'tph.slug','tph.location_id as loc_id', 'tph.stars', 'tph.pricefrom', 'tph.rating', 'tph.amenities','tph.distance','tph.room_aminities','tph.Languages')
                            ->whereIn('tph.hotelid',$idArray) ;
                          if (!empty($amenities) || !empty($Rating)) {
                              $searchresults->where(function ($query) use ($amenities, $Rating) {

                                  if (!empty($amenities)) {
                                      foreach ($amenities as $amenity) {
                                          $query->orWhere('tph.amenities', 'LIKE', '%' . $amenity . '%');
                                      }
                                  }
                                  if (!empty($amenities)) {
                                      foreach ($amenities as $amenity) {
                                          $query->orWhere('tph.room_aminities', 'LIKE', '%' . $amenity . '%');
                                      }
                                  }
                                  if (!empty($amenities)) {
                                      foreach ($amenities as $amenity) {
                                          $query->orWhere('tph.Languages', 'LIKE', '%' . $amenity . '%');
                                      }
                                  }
                              if (!empty($Rating)) {
                                  $query->orWhereIn('tph.stars', $Rating);
                              }
                          });
                      }

                      $searchresults = $searchresults->paginate(5);

                      // Manually append existing query parameters to pagination links
                      $searchresults->appends($request->except('_token'));


                    $searchresults->setPath('hotel_landing.html');


                    $getloc = DB::table('TPLocations')->select('cityName','countryName')->where('id',$locationid)->limit(1)->get();
						 $cityName ="";
					     $countryname ="";
							if(!$getloc->isEmpty()){
								$lname2 =$getloc[0]->cityName;
								$countryname = $getloc[0]->countryName;
								$cityName =$getloc[0]->cityName;
							}

                      // end save id if not found in TPhotel table


              return view('frontend.hotel.get_hotel_landing_result_withdate', ['hotels' => $hotel, 'locid' => $locationid, 'searchresults' => $searchresults, 'amenities' => $amenities, 'Rating' => $Rating, 'cityName' => $cityName, 'countryname' => $countryname])->render();


                     }


             }else{
                 return 'search id not found';
             }

         } else {

             return 2;
         }

       }
	   }
     public function saveNearbyhotel_hotellist(request $request){

        $locationJson = $request->get('Latitude');

        // Decode JSON string
        $locationData = json_decode($locationJson, true);

        // Extract latitude and longitude values
        $latitude = $locationData['lat'];
        $longitude = $locationData['lon'];


        $locationid = $request->get('locationid');


        $nbs =0;
        $nbh = 0;
        $ns =0;

           if($latitude != "" && $longitude !=""){
            $get_nearby_hotel = DB::table('TPhotel_listing_NBhotel')->where('LocationId',$locationid)->get();


        if (!$get_nearby_hotel->count() >= 5) {
            $nbh = 1;
             $searchradius = 10;
            $nearby_hotel = DB::table("TPHotel")
            ->select('id', 'name','location_id','slug','address','pricefrom','stars',
                    DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                * cos(radians(TPHotel.Latitude))
                * cos(radians(TPHotel.longnitude) - radians(" . $longitude . "))
                + sin(radians(" . $latitude . "))
                * sin(radians(TPHotel.Latitude))) AS distance"))
            ->having('distance', '<=', $searchradius)
            ->where('location_id',$locationid)

            ->orderBy('distance')
            ->limit(5)

            ->get();
       //   return print_r($nearby_hotel);
         if(!$nearby_hotel->isEmpty()){




            foreach ($nearby_hotel as $nearby_hotels) {
                $slug = $nearby_hotels->slug;
                $Title = $nearby_hotels->name;
                $LocationId = $nearby_hotels->location_id;
                $distance = round($nearby_hotels->distance,2);
                $address = $nearby_hotels->address;
                $stars = $nearby_hotels->stars;
                $pricefrom = $nearby_hotels->pricefrom;
                $id = $nearby_hotels->id;

                $data3= array(
                    'name'=>$Title,
                    'slug'=>$slug,
                    'hotelid'=>$id,
                    'LocationId'=>$LocationId,
                    'distance'=>$distance,
                    'radius'=>$searchradius,
                    'address'=>$address,
                    'stars'=>$stars,
                    'pricefrom'=>$pricefrom,

                    'dated'=>now(),
                );


                $insertdata3 = DB::table('TPhotel_listing_NBhotel')->insert($data3);
            //   return print_r($data2);
            }


         }
      }


        }
        if($nbh = 1){

           $nearby_hotel =  DB::table('TPhotel_listing_NBhotel')->where('LocationId',$locationid)->get();
           $html3 = view('hotel_detail_result.nearby_hotels',['nearby_hotel'=>$nearby_hotel])->render();


           return response()->json([ 'html' => $html3]);
       }
    }
	 public function sightlist_saveNearbyhotel(request $request){


              $locid = $request->get('locationid');
        $getloc = DB::table('Location')->where('LocationId',$locid)->get();


        $nbh = 0;

        $nearby_hotel =collect();
        if(!empty($getloc)){
            $latitude = $getloc[0]->Lat;
            $longitude = $getloc[0]->Longitude ;
            $LocationId = $getloc[0]->LocationId ;


       if($latitude != "" && $longitude !=""){
            $get_nearby_hotel = DB::table('SightListingNBhotels')->where('loc_id',$locid)->get();


        if (!$get_nearby_hotel->count() >= 1) {
            $nbh = 1;
             $searchradius = 10;
             $nearby_hotel = DB::table("TPHotel")
                 ->select('id', 'name','location_id','slug','address','stars','pricefrom',
                     DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                     * cos(radians(TPHotel.Latitude))
                     * cos(radians(TPHotel.longnitude) - radians(" . $longitude . "))
                     + sin(radians(" . $latitude . "))
                     * sin(radians(TPHotel.Latitude))) AS distance"))
               //  ->groupBy("TPHotel.SightId")
                 ->having('distance', '<=', $searchradius)
                // ->where('TPHotel.hotelid', '!=', $sightid)
                 ->orderBy('distance')
                 ->limit(4)

                 ->get();


         if(!$nearby_hotel->isEmpty()){




            foreach ($nearby_hotel as $nearby_hotels) {
                $slug = $nearby_hotels->slug;
                $Title = $nearby_hotels->name;
                $LocationId = $nearby_hotels->location_id;
                $distance = round($nearby_hotels->distance,2);
                $address = $nearby_hotels->address;
                $stars = $nearby_hotels->stars;
                $pricefrom = $nearby_hotels->pricefrom;
                $id = $nearby_hotels->id;

                $data3= array(
                    'name'=>$Title,
                    'slug'=>$slug,
                    'hotelid'=>$id,
                    'LocationId'=>$LocationId,
                    'distance'=>$distance,
                    'radius'=>$searchradius,
                    'address'=>$address,
                    'stars'=>$stars,
                    'pricefrom'=>$pricefrom,
                    'dated'=>now(),
                    'loc_id'=>$locid,
                );


                $insertdata3 = DB::table('SightListingNBhotels')->insert($data3);
            //   return print_r($data2);
            }


         }
      }


        }
    }
        if($nbh = 1){

           $nearby_hotel =  DB::table('SightListingNBhotels')->where('loc_id',$locid)->get();

           $html3 = view('frontend.explore.loc_nearby_hotels_result',['nearby_hotel'=>$nearby_hotel])->render();


           return response()->json([ 'html' => $html3]);
       }
    }


	 public function hotel_all_filters_without_date(request $request)
    {

         $locationid = $request->get('locationid');

         $chkin = $request->get('Cin');
         $checout = $request->get('Cout');

        $rooms = $request->get('rooms');
        $guest = $request->get('guest');


        $minPrice = $request->get('priceFrom');
        $priceTo = $request->get('priceTo');
        $typeHotel = $request->get('hoteltype');
        $starRating = $request->get('starRating');
        $mnt = $request->get('mnt');
        $Smnt = $request->get('Smnt');

        $stars = [];
        if (is_string($starRating)) {
            $stars = explode(',', $starRating);
        }

        $amenities = [];
        if(is_string($mnt)){
            $amenities = explode(',', $mnt);
        }

        $Specamenities = [];
        if(is_string($Smnt)){
            $Specamenities = explode(',', $Smnt);
        }
         $Specamenities;


        $typeHotels = [];
        if (is_string($typeHotel)) {
            $typeHotels = explode(',', $typeHotel);
        }

        $userrating = $request->get('userrating');
        $user_rating = [];
        if (is_string($userrating)) {
            $user_rating = explode(',', $userrating);
        }


        $address = $request->get('address');
        $distance = $request->get('distance');
      if($distance ==0){
        $distance = "";
      }


                    $searchresults = DB::table('TPHotel as h')
                    ->select([
                        'h.hotelid',
                        'h.id',
                        'h.location_id as loc_id',
                        'h.name',
                        'h.address',
                        'h.slug',
                        'h.distance',
                        'h.stars',
                        'h.pricefrom',
                        'h.rating',
                        'h.photos',
                        'h.facilities',
                        'h.amenities',
                        'h.shortFacilities',
                        'l.fullName',
                        'l.countryName',
                        'l.cityName',
                        'ty.type as propertyType',
                        'h.image',
                    ])
                    ->join('TPLocations as l', 'l.locationId', '=', 'h.location_id')
                    ->leftJoin('TPHotel_types as ty', 'ty.hid', '=', 'h.propertyType')
                    ->when(!empty($stars), function ($query) use ($stars) {
                        $query->whereIn('h.stars', $stars);
                    })
                    // ->when(!empty($distance), function ($query) use ($distance) {
                    //     $query->orWhere('h.distance', '<=', $distance);
                    // })
                    ->when(!empty($address), function ($query) use ($address) {
                        $query->where('h.address', 'like','%'. $address . '%');
                    })
                    ->when(!empty($typeHotels), function ($query) use ($typeHotels) {
                        $query->whereIn('h.propertyType', $typeHotels);
                    })
                    ->when(!empty($user_rating), function ($query) use ($user_rating) {
                        $query->whereIn('h.rating', $user_rating);
                    })
					 ->when(!empty($user_rating), function ($query) use ($user_rating) {
                        $query->whereIn('h.rating', $user_rating);
                    })
					->when(!empty($minPrice) && !empty($priceTo), function ($query) use ($minPrice, $priceTo) {
						$query->whereBetween('h.pricefrom', [$minPrice, $priceTo]);
					})
                    ->when(!empty($amenities), function ($query) use ($amenities) {
                        foreach ($amenities as $amenity) {
                            $query->where('h.amenities', 'LIKE', '%' . $amenity . '%');
                        }
                    })
                 //   ->limit(30)
                   ->paginate(10);

                    $url = 'ho-'.$locationid;
                    $searchresults->appends(request()->except(['_token']));

                    $searchresults->setPath($url);
                    $paginationLinks = $searchresults->links('hotellist_pagg.default');








//return   print_r($searchresults);
//    echo '---';
//    print_r($hotel);
//    die();

        $lname ="";
        $countryName ="";
        if(!$searchresults->isEmpty()){
            $lname = $searchresults[0]->cityName;
            $countryName = $searchresults[0]->countryName;
        }


        return view('frontend.hotel.get_hotel_listing_result_withoutdate')->with('searchresults',$searchresults)->with('lname',$lname)->with('countryname',$countryName);
    }




 public function explore_country_list($id,$slug){
    $is_rest ="";
    $ismustsee ="";
    $is_rest ="";
    $rest_avail ="";
    $getSightCat ="";

    $start =  date("H:i:s");


    $cont = DB::table('Country')
    ->select('Country_Content','Name','CountryId')
    ->where('CountryId', $id)
    ->where('slug', $slug)
    ->get()
    ->toArray();

     if(empty($cont)){
          abort(404, 'NOT FOUND');
     }

     $countryname = $cont[0]->Name;


       //end

    $faq= collect();

    $getloc = DB::table('Location')
    ->select('LocationId')
    ->where('CountryId', $id)
    ->get()
    ->toArray();
    $locationIds = array_column($getloc, 'LocationId');

    $searchresults = DB::table('Sight as s')
    ->select('s.*', 'c.Title as CategoryTitle', 'l.CountryId', 'l.Name as LName', 'l.Slug as Lslug', 'l.MetaTagTitle as mTitle', 'l.MetaTagDescription as mDesc', 'l.tp_location_mapping_id', 'co.Name as CountryName','l.About')
    ->leftJoin('Category as c', 's.CategoryId', '=', 'c.CategoryId')
    ->join('Location as l', 's.LocationId', '=', 'l.LocationId')
    ->Join('Country as co', 'l.CountryId', '=', 'co.CountryId')
  //  ->where('s.LocationId', $locationIds)
  ->whereIn('s.LocationId', $locationIds)
  //  ->where('co.slug', $slug)
    //->where('l.LocationLevel',1)
  //  ->where('co.CountryId', $id)
    ->where('s.IsMustSee',1)
    ->orderBy('s.TATrendingScore', 'desc')
    ->limit(10)
    ->get()
    ->toArray();





    $getSightCat = DB::table('Sight')
        ->select('Category.CategoryId', 'Category.Title')
        ->distinct()
        ->join('Category', 'Sight.categoryId', '=', 'Category.categoryId')
        ->whereIn('Sight.LocationId', $locationIds) // Use location IDs obtained from the first query
        ->get();



        $breadcumb=[];

        $breadcumb  = DB::table('Country as c')
        ->select('co.*','c.Name as cname')
        ->join('CountryCollaboration as co', 'c.CountryCollaborationId', '=', 'co.CountryCollaborationId')
        ->where('c.CountryId', $id)
        ->get()
        ->toArray();


     $locn ="";
     $tplocname=array();
     $locationPatent = [];

     $getrest=collect();
     $experience =collect();
     $nearby_hotel =collect();
     $gethotellistiid =collect();

     if(!empty($searchresults)){
      $locationID  = $searchresults[0]->LocationId;
      $lociID = $searchresults[0]->LocationId;
      $locn =  $searchresults[0]->LocationId;

      if(empty($searchresults)){


        $loc = DB::table('Location')
        ->select('LocationId', 'parentid','LocationLevel')
        ->where('LocationId', $locationID)
        ->first();

        if(!empty($loc)){
                $parentId =$loc->parentid;
            $LocationLevel =$loc->LocationLevel;


            while ($parentId !== null && $LocationLevel !=1) {
                $parent = DB::table('Location')
                    ->select('LocationId', 'ParentId')
                    ->where('LocationId', $parentId)
                    ->first();


                if ($parent) {
                    $isParentInSight = DB::table('Sight')
                        ->where('LocationId', $parent->LocationId)
                        ->exists();

                    if ($isParentInSight) {
                        $parentId = $parent->LocationId;
                        break;
                    } else {
                        $parentId = $parent->ParentId;
                    }
                } else {
                    $parentId = null;
                }
            }
        }


            $searchresults = DB::table('Sight as s')
            ->select('s.*', 'c.Title as CategoryTitle', 'l.CountryId', 'l.Name as LName', 'l.Slug as Lslug', 'l.MetaTagTitle as mTitle', 'l.MetaTagDescription as mDesc', 'l.tp_location_mapping_id', 'co.Name as CountryName')
            ->leftJoin('Category as c', 's.CategoryId', '=', 'c.CategoryId')
            ->join('Location as l', 's.LocationId', '=', 'l.LocationId')
            ->leftJoin('Country as co', 'l.CountryId', '=', 'co.CountryId')
           // ->where('l.Slug', $explocname)
            ->where('l.LocationId', $parentId)
            ->orderBy('s.TATrendingScore', 'desc')
            ->limit(10)
            ->get()
            ->toArray();
        }



      $start3 =  date("H:i:s");


       if(!empty($searchresults[0]->tp_location_mapping_id)){
         $tplocname =  DB::table('TPLocations')->select('cityName','countryName','LocationId')->where('LocationId',$searchresults[0]->tp_location_mapping_id)->get();
       }

       $getparent = DB::table('Location')->where('LocationId', $lociID)->get();


       if (!$getparent->isEmpty()){
       if (!empty($getparent) && $getparent[0]->LocationLevel != 1) {
           $loopcount = $getparent[0]->LocationLevel;
           $lociID = $getparent[0]->ParentId;
           for ($i = 1; $i < $loopcount; $i++) {
               $getparents = DB::table('Location')->where('LocationId', $lociID)->get();
               if (!empty($getparents)) {
                    $locationPatent[] = [
                        'LocationId' => $getparents[0]->LocationId,
                        'slug' => $getparents[0]->Slug,
                        'Name' => $getparents[0]->Name,
                    ];
                   if (!empty($getparents) && $getparents[0]->ParentId != "") {
                   $lociID = $getparents[0]->ParentId;
                }
               } else {
                   break; // Exit the loop if no more parent locations are found
               }
           }
       }
    }

          if(!empty($searchresults[0]->LocationId)){
           $getrest = DB::table('Restaurant')->select('Title','RestaurantId','LocationId','Slug','Address','PriceRange')->whereIn('LocationId',$locationIds)->get();
          }


         if(!empty($searchresults[0]->LocationId)){
            $experience =  DB::table('Experience')->whereIn('LocationId',$locationIds)->get();
        }

	     //new code
        $percentageRecommended = 0;
        if(!empty($searchresults)){
     //   if (!$searchresults->isEmpty()) {

            foreach ($searchresults as $results) {
                $sightId = $results->SightId;

                $Sightcat = DB::table('SightCategory')
                    ->join('Category', 'SightCategory.CategoryId', '=', 'Category.CategoryId')
                    ->select('Category.Title')
                    ->where('SightCategory.SightId', '=', $sightId)
                    ->get();

                $results->Sightcat = $Sightcat;

                $timing = DB::select("SELECT * FROM SightTiming WHERE SightId = ?", [$sightId]);
                $results->timing = $timing;

            }
            //end code



		}
       //nearby hotel


          $nearby_hotel =  DB::table('SightListingNBhotels')->where('loc_id',$locationID)->get();
          /*end nearby hotels */


          $getloc = DB::table('Location')->where('LocationId',$locationID)->get();


          if(!$getloc->isEmpty()){
            $latitude = $getloc[0]->Lat;
            $longitude = $getloc[0]->Longitude ;

		   //hotel list id

          $gethotellistiid = DB::table('Temp_Mapping as tm')
          ->select('tpl.*')
          ->join('TPLocations as tpl','tpl.locationId','=','tm.LocationId')
          //  ->where('tm.Tid',$locationID)
           ->whereIn('tm.Tid',$locationIds)
          ->get();


          $CountryId ="";
         $formattedDateTime = date("H:i:s");
		 if($gethotellistiid->isEmpty()){
            $getlocid = DB::table('Location')->select('ParentId','CountryId')->where('LocationId',$locationID)->get();
            if(!$getlocid->isEmpty()){
             $CountryId =$getlocid[0]->CountryId;
			}
		 }


        if($gethotellistiid->isEmpty()){
                $getlocid = DB::table('Location')->select('ParentId','CountryId')->where('LocationId',$locationID)->get();
                if(!$getlocid->isEmpty()){
                    $locationID = $getlocid[0]->ParentId;
                    $CountryId =$getlocid[0]->CountryId;


                $gethotellistiid = DB::table('Temp_Mapping as tm')
                ->select('tpl.*')
                ->join('TPLocations as tpl','tpl.locationId','=','tm.LocationId')
            // ->where('tm.Tid',$locationID)
                ->whereIn('tm.Tid',$locationIds)
                ->get();
                }
        }

    }


    //end record nit available

        if ($gethotellistiid->isEmpty()) {
            $gethotellistiid = DB::table('Temp_Mapping as tm')
                ->select('tpl.locationId')
                ->join('TPLocations as tpl', 'tpl.locationId', '=', 'tm.LocationId')
                ->join('Location as l', 'l.locationId', '=', 'tm.Tid')
                ->where('l.CountryId', $CountryId)
                ->limit(1) // limit the result to 1 row
                ->get();
        }


          // end hotel list id
          }



            //end nearby hotel

        return view('country_sight_listing')->with('searchresults',$searchresults)->with('searchlocation',$locn)->with('faq',$faq)->with('getSightCat',$getSightCat)->with('rest_avail',$rest_avail)->with('ismustsee',$ismustsee)->with('tplocname',$tplocname)->with('locationPatent',$locationPatent)->with('getrest',$getrest)->with('experience',$experience)->with('nearby_hotel',$nearby_hotel)->with('gethotellistiid',$gethotellistiid)->with('breadcumb',$breadcumb)->with('countryname',$countryname)->with('cont',$cont);




    }



    public function loadMoresightbycontry(Request $request)
    {
        $page = $request->input('page');
        $perPage = 10;
        $contid = $request->input('locid');

        if ($page == 1) {
            return response()->json(['html' => '']);
        }

        $offset = ($page - 1) * $perPage;

        $searchresults = DB::table('Sight as s')
        ->select('s.*', 'c.Title as CategoryTitle', 'l.CountryId', 'l.Name as LName', 'l.Slug as Lslug', 'l.MetaTagTitle as mTitle', 'l.MetaTagDescription as mDesc', 'l.tp_location_mapping_id', 'co.Name as CountryName','l.About')
        ->leftJoin('Category as c', 's.CategoryId', '=', 'c.CategoryId')
        ->join('Location as l', 's.LocationId', '=', 'l.LocationId')
        ->Join('Country as co', 'l.CountryId', '=', 'co.CountryId')
        //  ->where('co.slug', $slug)
        ->where('l.LocationLevel',1)
        ->where('co.CountryId', $contid)
        ->where('s.IsMustSee',1)
        ->orderBy('s.TATrendingScore', 'desc')
        ->get();

        $attractions = collect($searchresults)
            ->slice($offset, $perPage)
            ->values();

            if (!empty($attractions)) {

                foreach ($attractions as $results) {
                    $sightId = $results->SightId;

                    $Sightcat = DB::table('SightCategory')
                        ->join('Category', 'SightCategory.CategoryId', '=', 'Category.CategoryId')
                        ->select('Category.Title')
                        ->where('SightCategory.SightId', '=', $sightId)
                        ->get();

                    $results->Sightcat = $Sightcat;

                    $timing = DB::select("SELECT * FROM SightTiming WHERE SightId = ?", [$sightId]);
                    $results->timing = $timing;

                    // Retrieve reviews for the sight using a raw SQL query
                    $reviews = DB::select("SELECT * FROM SightReviews WHERE SightId = ?", [$sightId]);

                    // Merge the reviews into the result directly
                    $results->reviews = $reviews;
                }
            }


            //end set timing cat val
            $mergedData = [];

            // Loop through attractions and associate them with categories
            if (!empty($attractions)) {
                foreach ($attractions as $att) {
                    if (!empty($att->Sightcat)) {
                        // Loop through categories and create an associative array
                        foreach ($att->Sightcat as $category) {
                            if ($category->Title != "") {
                                $categoryTitle = $category->Title;
                            } else {
                                $categoryTitle = '';
                            };

                            if (!empty($att->Latitude) && !empty($att->Longitude)) {
                                // Check if $att->timing is set and contains the required properties
                                if (isset($att->timing->timings)) {
                                    // Calculate the opening and closing time
                                    $schedule = json_decode($att->timing->timings, true);
                                    $currentDay = strtolower(date('D'));
                                    $currentTime = date('H:i');
                                    $openingtime = $schedule['time'][$currentDay]['start'];
                                    $closingTime = $schedule['time'][$currentDay]['end'];
                                    $isOpen = false;
                                    $formatetime = '';

                                    if ($openingtime === '00:00' && $closingTime === '23:59') {
                                        $formatetime = '12:00';
                                        $closingTime = '11:59';
                                    }

                                    if ($currentTime >= $openingtime && $currentTime <= $closingTime) {
                                        $isOpen = true;
                                    }

                                    $timingInfo = $isOpen ? $formatetime . ' Open Now' : 'Closed Today';
                                } else {
                                    $timingInfo = '';
                                }
                                if($att->TAAggregateRating != ""){
                                    $recomd = rtrim($att->TAAggregateRating, '.0') * 20;
                            }else{
                                $recomd ='Unavailable';
                            }
                                $locationData = [
                                    'Latitude' => $att->Latitude,
                                    'Longitude' => $att->Longitude,
                                    'SightId' => $att->SightId,
                                    'ismustsee' => $att->IsMustSee,
                                    'name' => $att->Title,
                                    'recmd' => $recomd,
                                    'cat' => $categoryTitle,
                                    'tm' => $timingInfo, // Include the timing in the locationData array
                                ];

                                $mergedData[] = $locationData; // Add the locationData directly to mergedData
                            }
                        }
                    } else {
                        // If there are no categories, create a default "uncategorized" category
                        if (!empty($att->Latitude) && !empty($att->Longitude)) {
                            // Check if $att->timing is set and contains the required properties
                            if (isset($att->timing->timings)) {
                                // Calculate the opening and closing time (same as above)
                                // ...
                                // ...
                                if($att->TAAggregateRating != ""){
                                    $recomd = rtrim($att->TAAggregateRating, '.0') * 20;
                                }else{
                                    $recomd ='Unavailable';
                                }
                                $locationData = [
                                    'Latitude' => $att->Latitude,
                                    'Longitude' => $att->Longitude,
                                    'SightId' => $att->SightId,
                                    'ismustsee' => $att->IsMustSee,
                                    'name' => $att->Title,
                                    'recmd' => $recomd,
                                    'cat' => ' ',
                                    'tm' => $timingInfo,
                                ];

                                $mergedData[] = $locationData;
                            }
                        }
                    }
                }
            }

            // Encode data as JSON
            $locationDataJson = json_encode($mergedData);



            if ($attractions->isEmpty()) {
                return response()->json(['html' => '']);
            }
            $html = view('getloclistbycatid')->with('searchresults', $attractions)->render();

            return response()->json(['mapData' => $locationDataJson, 'html' => $html]);

    }
	public function explore_continent_list($id,$slug){

        $is_rest ="";
        $ismustsee ="";
        $is_rest ="";
        $rest_avail ="";
        $getSightCat ="";

        $start =  date("H:i:s");

        $slug = str_replace('-',' ',$slug);
        $cont = DB::table('CountryCollaboration')
        ->select('CountryCollaborationId','Name')
        ->where('CountryCollaborationId', $id)
        ->where('Name', $slug)
        ->get()
        ->toArray();

         if(empty($cont)){
              abort(404, 'NOT FOUND');
         }

         $countryname = $cont[0]->Name;


        $faq= collect();

        $getcount = DB::table('Country as c')
        ->join('CountryCollaboration as clb', 'clb.CountryCollaborationId', '=', 'c.CountryCollaborationId')
        ->select('c.CountryId', 'c.Name')
        ->where('clb.CountryCollaborationId', $id)
       // ->limit(20)

        ->get()
        ->toArray();
        //return print_r($getcount);
        $countryId = array_column($getcount, 'CountryId');
        $getloc = DB::table('Location as l')
        ->select('l.LocationId', 'l.Name')
        ->whereIn('l.CountryId', $countryId)
        ->limit(50)
        ->get()
        ->toArray();


     //   return  $getloc;
        $locationIds = array_column($getloc, 'LocationId');

        $searchresults = DB::table('Sight as s')
        ->select('s.*', 'c.Title as CategoryTitle', 'l.CountryId', 'l.Name as LName', 'l.Slug as Lslug', 'l.MetaTagTitle as mTitle', 'l.MetaTagDescription as mDesc', 'l.tp_location_mapping_id', 'co.Name as CountryName','l.About')
        ->leftJoin('Category as c', 's.CategoryId', '=', 'c.CategoryId')
        ->join('Location as l', 's.LocationId', '=', 'l.LocationId')
        ->Join('Country as co', 'l.CountryId', '=', 'co.CountryId')
      //  ->where('s.LocationId', $locationIds)
      ->whereIn('s.LocationId', $locationIds)
      //  ->where('co.slug', $slug)
        //->where('l.LocationLevel',1)
      //  ->where('co.CountryId', $id)
        ->where('s.IsMustSee',1)
        // ->orderBy('s.TATrendingScore', 'desc')
        ->limit(10)
        ->get()
        ->toArray();





        $getSightCat = DB::table('Sight')
            ->select('Category.CategoryId', 'Category.Title')
            ->distinct()
            ->join('Category', 'Sight.categoryId', '=', 'Category.categoryId')
            ->whereIn('Sight.LocationId', $locationIds) // Use location IDs obtained from the first query
            ->get();




         $locn ="";
         $tplocname=array();
         $locationPatent = [];

         $getrest=collect();
         $experience =collect();
         $nearby_hotel =collect();
         $gethotellistiid =collect();

         if(!empty($searchresults)){
          $locationID  = $searchresults[0]->LocationId;
          $lociID = $searchresults[0]->LocationId;
          $locn =  $searchresults[0]->LocationId;

          if(empty($searchresults)){


            $loc = DB::table('Location')
            ->select('LocationId', 'parentid','LocationLevel')
            ->where('LocationId', $locationID)
            ->first();

            if(!empty($loc)){
                    $parentId =$loc->parentid;
                    $LocationLevel =$loc->LocationLevel;


                while ($parentId !== null && $LocationLevel !=1) {
                    $parent = DB::table('Location')
                        ->select('LocationId', 'ParentId')
                        ->where('LocationId', $parentId)
                        ->first();


                    if ($parent) {
                        $isParentInSight = DB::table('Sight')
                            ->where('LocationId', $parent->LocationId)
                            ->exists();

                        if ($isParentInSight) {
                            $parentId = $parent->LocationId;
                            break;
                        } else {
                            $parentId = $parent->ParentId;
                        }
                    } else {
                        $parentId = null;
                    }
                }
            }


                $searchresults = DB::table('Sight as s')
                ->select('s.*', 'c.Title as CategoryTitle', 'l.CountryId', 'l.Name as LName', 'l.Slug as Lslug', 'l.MetaTagTitle as mTitle', 'l.MetaTagDescription as mDesc', 'l.tp_location_mapping_id', 'co.Name as CountryName')
                ->leftJoin('Category as c', 's.CategoryId', '=', 'c.CategoryId')
                ->join('Location as l', 's.LocationId', '=', 'l.LocationId')
                ->leftJoin('Country as co', 'l.CountryId', '=', 'co.CountryId')
               // ->where('l.Slug', $explocname)
                ->where('l.LocationId', $parentId)
                ->orderBy('s.TATrendingScore', 'desc')
                ->limit(10)
                ->get()
                ->toArray();




            }


            $locids = []; // Initialize an empty array to store LocationIds

            foreach ($searchresults as $result) {
                // Assuming 'LocationId' is a property of the result object
                if (isset($result->LocationId)) {
                    $locids[] = $result->LocationId;
                }
            }
       //     return print_r($locids);

          $start3 =  date("H:i:s");


           if(!empty($searchresults[0]->tp_location_mapping_id)){
             $tplocname =  DB::table('TPLocations')->select('cityName','countryName','LocationId')->where('LocationId',$searchresults[0]->tp_location_mapping_id)->get();
           }

           $getparent = DB::table('Location')->where('LocationId', $lociID)->get();


           if (!$getparent->isEmpty()){
           if (!empty($getparent) && $getparent[0]->LocationLevel != 1) {
               $loopcount = $getparent[0]->LocationLevel;
               $lociID = $getparent[0]->ParentId;
               for ($i = 1; $i < $loopcount; $i++) {
                   $getparents = DB::table('Location')->where('LocationId', $lociID)->get();
                   if (!empty($getparents)) {
                        $locationPatent[] = [
                            'LocationId' => $getparents[0]->LocationId,
                            'slug' => $getparents[0]->Slug,
                            'Name' => $getparents[0]->Name,
                        ];
                       if (!empty($getparents) && $getparents[0]->ParentId != "") {
                       $lociID = $getparents[0]->ParentId;
                    }
                   } else {
                       break; // Exit the loop if no more parent locations are found
                   }
               }
           }
        }



             //new code
            $percentageRecommended = 0;
            if(!empty($searchresults)){
         //   if (!$searchresults->isEmpty()) {

                foreach ($searchresults as $results) {
                    $sightId = $results->SightId;

                    $Sightcat = DB::table('SightCategory')
                        ->join('Category', 'SightCategory.CategoryId', '=', 'Category.CategoryId')
                        ->select('Category.Title')
                        ->where('SightCategory.SightId', '=', $sightId)
                        ->get();

                    $results->Sightcat = $Sightcat;

                    $timing = DB::select("SELECT * FROM SightTiming WHERE SightId = ?", [$sightId]);
                    $results->timing = $timing;

                }
                //end code



            }



       if(!empty($locids)){
	   $getrest = DB::table('Restaurant')->select('Title','RestaurantId','LocationId','Slug','Address','PriceRange')->whereIn('LocationId',$locids)->get();
        $nearby_hotel =  DB::table('SightListingNBhotels')->whereIn('loc_id',$locids)->get();
        $experience =  DB::table('Experience')->whereIn('LocationId',$locids)->get();
       }
           //nearby hotel


              /*end nearby hotels */
     //     return print_r( $nearby_hotel);

              $getloc = DB::table('Location')->where('LocationId',$locationID)->get();


              if(!$getloc->isEmpty()){
                $latitude = $getloc[0]->Lat;
                $longitude = $getloc[0]->Longitude ;

               //hotel list id

              $gethotellistiid = DB::table('Temp_Mapping as tm')
              ->select('tpl.*')
              ->join('TPLocations as tpl','tpl.locationId','=','tm.LocationId')
              //  ->where('tm.Tid',$locationID)
               ->whereIn('tm.Tid',$locationIds)
              ->get();


              $CountryId ="";
             $formattedDateTime = date("H:i:s");
             if($gethotellistiid->isEmpty()){
                $getlocid = DB::table('Location')->select('ParentId','CountryId')->where('LocationId',$locationID)->get();
                if(!$getlocid->isEmpty()){
                 $CountryId =$getlocid[0]->CountryId;
                }
             }


            if($gethotellistiid->isEmpty()){
                    $getlocid = DB::table('Location')->select('ParentId','CountryId')->where('LocationId',$locationID)->get();
                    if(!$getlocid->isEmpty()){
                        $locationID = $getlocid[0]->ParentId;
                        $CountryId =$getlocid[0]->CountryId;


                    $gethotellistiid = DB::table('Temp_Mapping as tm')
                    ->select('tpl.*')
                    ->join('TPLocations as tpl','tpl.locationId','=','tm.LocationId')
                // ->where('tm.Tid',$locationID)
                    ->whereIn('tm.Tid',$locationIds)
                    ->get();
                    }
            }

        }


        //end record nit available

            if ($gethotellistiid->isEmpty()) {
                $gethotellistiid = DB::table('Temp_Mapping as tm')
                    ->select('tpl.locationId')
                    ->join('TPLocations as tpl', 'tpl.locationId', '=', 'tm.LocationId')
                    ->join('Location as l', 'l.locationId', '=', 'tm.Tid')
                    ->where('l.CountryId', $CountryId)
                    ->limit(1) // limit the result to 1 row
                    ->get();
            }


              // end hotel list id
              }



                //end nearby hotel

            return view('continent_sight_listing')->with('searchresults',$searchresults)->with('searchlocation',$locn)->with('faq',$faq)->with('getSightCat',$getSightCat)->with('rest_avail',$rest_avail)->with('ismustsee',$ismustsee)->with('tplocname',$tplocname)->with('locationPatent',$locationPatent)->with('getrest',$getrest)->with('experience',$experience)->with('nearby_hotel',$nearby_hotel)->with('gethotellistiid',$gethotellistiid)->with('countryname',$countryname)->with('cont',$cont);




        }


        public function loadMoresightbycontinent(Request $request)
        {
            $page = $request->input('page');
            $perPage = 50;
            $contlim = 50;
            $contid = $request->input('locid');

            if ($page == 1) {
                return response()->json(['html' => '']);
            }

            $offset = ($page - 1) * $perPage;
            $offset2 = $page  * $contlim;


            $getcount = DB::table('Country as c')
            ->join('CountryCollaboration as clb', 'clb.CountryCollaborationId', '=', 'c.CountryCollaborationId')
            ->select('c.CountryId', 'c.Name')
            ->where('clb.CountryCollaborationId', $contid)
           // ->limit(20)

            ->get()
            ->toArray();
            //return print_r($getcount);
            $countryId = array_column($getcount, 'CountryId');
            $getloc = DB::table('Location as l')
     //   ->join('Country as c', 'c.CountryId', '=', 'l.CountryId')
       // ->join('CountryCollaboration as clb', 'clb.CountryCollaborationId', '=', 'c.CountryCollaborationId')
        ->select('l.LocationId')
        ->whereIn('l.CountryId', $countryId)
       ->limit($offset2)
        ->get()
        ->toArray();


         //   return  $getloc;
            $locationIds = array_column($getloc, 'LocationId');


            $attraId = collect($getloc)
            ->slice($offset, $perPage)
            ->values()
            ->toArray();

            $attraIdValues = array_column($attraId, 'LocationId');
         //   print_r($attraIdValues);

                   $attractions = DB::table('Sight as s')

            ->select('s.*', 'c.Title as CategoryTitle', 'l.CountryId', 'l.Name as LName', 'l.Slug as Lslug', 'l.MetaTagTitle as mTitle', 'l.MetaTagDescription as mDesc', 'l.tp_location_mapping_id', 'co.Name as CountryName','l.About')
            ->leftJoin('Category as c', 's.CategoryId', '=', 'c.CategoryId')
            ->join('Location as l', 's.LocationId', '=', 'l.LocationId')
            ->Join('Country as co', 'l.CountryId', '=', 'co.CountryId')
          //  ->where('s.LocationId', $locationIds)
          ->whereIn('s.LocationId', $attraIdValues)
          //  ->where('co.slug', $slug)
            //->where('l.LocationLevel',1)
          //  ->where('co.CountryId', $id)
            ->orWhere('s.IsMustSee',1)
            // ->orderBy('s.TATrendingScore', 'desc')
            ->limit(10)
            ->get();







                if (!empty($attractions)) {

                    foreach ($attractions as $results) {
                        $sightId = $results->SightId;

                        $Sightcat = DB::table('SightCategory')
                            ->join('Category', 'SightCategory.CategoryId', '=', 'Category.CategoryId')
                            ->select('Category.Title')
                            ->where('SightCategory.SightId', '=', $sightId)
                            ->get();

                        $results->Sightcat = $Sightcat;

                        $timing = DB::select("SELECT * FROM SightTiming WHERE SightId = ?", [$sightId]);
                        $results->timing = $timing;

                        // Retrieve reviews for the sight using a raw SQL query
                        $reviews = DB::select("SELECT * FROM SightReviews WHERE SightId = ?", [$sightId]);

                        // Merge the reviews into the result directly
                        $results->reviews = $reviews;
                    }
                }


                //end set timing cat val
                $mergedData = [];

                // Loop through attractions and associate them with categories
                if (!empty($attractions)) {
                    foreach ($attractions as $att) {
                        if (!empty($att->Sightcat)) {
                            // Loop through categories and create an associative array
                            foreach ($att->Sightcat as $category) {
                                if ($category->Title != "") {
                                    $categoryTitle = $category->Title;
                                } else {
                                    $categoryTitle = '';
                                };

                                if (!empty($att->Latitude) && !empty($att->Longitude)) {
                                    // Check if $att->timing is set and contains the required properties
                                    if (isset($att->timing->timings)) {
                                        // Calculate the opening and closing time
                                        $schedule = json_decode($att->timing->timings, true);
                                        $currentDay = strtolower(date('D'));
                                        $currentTime = date('H:i');
                                        $openingtime = $schedule['time'][$currentDay]['start'];
                                        $closingTime = $schedule['time'][$currentDay]['end'];
                                        $isOpen = false;
                                        $formatetime = '';

                                        if ($openingtime === '00:00' && $closingTime === '23:59') {
                                            $formatetime = '12:00';
                                            $closingTime = '11:59';
                                        }

                                        if ($currentTime >= $openingtime && $currentTime <= $closingTime) {
                                            $isOpen = true;
                                        }

                                        $timingInfo = $isOpen ? $formatetime . ' Open Now' : 'Closed Today';
                                    } else {
                                        $timingInfo = '';
                                    }
                                  //  if($att->TAAggregateRating != ""){
                                    if (isset($att->TAAggregateRating) && $att->TAAggregateRating !== null && $att->TAAggregateRating > 0) {
                                        // ... code inside the condition ...
                                        $recomd = rtrim($att->TAAggregateRating, '.0') * 20;
                                }else{
                                    $recomd ='Unavailable';
                                }
                                    $locationData = [
                                        'Latitude' => $att->Latitude,
                                        'Longitude' => $att->Longitude,
                                        'SightId' => $att->SightId,
                                        'ismustsee' => $att->IsMustSee,
                                        'name' => $att->Title,
                                        'recmd' => $recomd,
                                        'cat' => $categoryTitle,
                                        'tm' => $timingInfo, // Include the timing in the locationData array
                                    ];

                                    $mergedData[] = $locationData; // Add the locationData directly to mergedData
                                }
                            }
                        } else {
                            // If there are no categories, create a default "uncategorized" category
                            if (!empty($att->Latitude) && !empty($att->Longitude)) {
                                // Check if $att->timing is set and contains the required properties
                                if (isset($att->timing->timings)) {
                                    // Calculate the opening and closing time (same as above)
                                    // ...
                                    // ...
                                    if($att->TAAggregateRating != ""){
                                        $recomd = rtrim($att->TAAggregateRating, '.0') * 20;
                                    }else{
                                        $recomd ='Unavailable';
                                    }
                                    $locationData = [
                                        'Latitude' => $att->Latitude,
                                        'Longitude' => $att->Longitude,
                                        'SightId' => $att->SightId,
                                        'ismustsee' => $att->IsMustSee,
                                        'name' => $att->Title,
                                        'recmd' => $recomd,
                                        'cat' => ' ',
                                        'tm' => $timingInfo,
                                    ];

                                    $mergedData[] = $locationData;
                                }
                            }
                        }
                    }
                }

                // Encode data as JSON
                $locationDataJson = json_encode($mergedData);



                if ($attractions->isEmpty()) {
                    return response()->json(['html' => '']);
                }
                $html = view('getloclistbycatid')->with('searchresults', $attractions)->render();

                return response()->json(['mapData' => $locationDataJson, 'html' => $html]);

        }
      public function updatemetadesc(request $request){
       $id = $request->get('id');
       $locationid = $request->get('locationid');
       $gethotel = DB::table('TPHotel')->where('id',$id)->get();
        $name = $gethotel[0]->name;
        $amenities = $gethotel[0]->amenities;
        $room_aminities = $gethotel[0]->room_aminities;
        $location_score = $gethotel[0]->location_score;
        $stars = $gethotel[0]->stars;
        $MetaTagDescription = $gethotel[0]->MetaTagDescription;
        $pricefrom = $gethotel[0]->pricefrom;
        $hotelid = $gethotel[0]->hotelid;
        if($MetaTagDescription ==""){

            if($amenities !="" || $room_aminities !=""){

                $amenitiesArray = explode(',', $amenities);
                $roomAmenitiesArray = explode(',', $room_aminities);
                $selectedAmenities = array_slice($amenitiesArray, 0, 4);
                if (count($selectedAmenities) < 4) {
                    $remainingAmenitiesCount = 4 - count($selectedAmenities);
                    $selectedRoomAmenities = array_slice($roomAmenitiesArray, 0, $remainingAmenitiesCount);
                    $selectedAmenities = array_merge($selectedAmenities, $selectedRoomAmenities);
                }
                if($name !="" && $selectedAmenities !="" && $stars !="" && $location_score !="" ){
                    $desc ="Compare and Find the best prices for $name. Equipped with Amenities like ".implode(', ', $selectedAmenities).", $name has a user rating of $stars and location score or $location_score or Read Reviews, See Photos and Read Reviews for $name, Location";

                    DB::table('TPHotel')->where('id', $id)->update(['MetaTagDescription' => $desc]);

                }
            }
       }

       if($locationid !=""){
        $getLocation = DB::table('TPLocations')->where('id',$locationid)->get();
        $cityName = $getLocation[0]->cityName;
       }

       $getLocation = DB::table('TPHotelNeighbourhood as nb')
       ->join('Neighborhood as n','nb.NeighborhoodID','=','n.NeighborhoodID')
       ->where('nb.hotelid',$hotelid)->get();
       $neb ="";
       if(!$getLocation->isEmpty() && $pricefrom !="" && $cityName !=""){
         $neb = $getLocation[0]->Name;

         $title = $name.', '.$neb.' '.$cityName.'@'.$pricefrom;
       }
       if($pricefrom !=""){
        $title = $name.', '.$cityName.'@'.$pricefrom;
       }else{
        $title = $name.', '.$cityName;
       }


     return  DB::table('TPHotel')->where('id', $id)->update(['metaTagTitle' => $title]);


    }



    //search sight



    public function search_sights(request $request){

        $locId = $request->input('locationId');
        $val = $request->input('val');
        $res_type = $request->input('res_type');
     //   session()->flush();
        $result_rest =[];

        $rest =0;
        $exp =0;
       $recentSearches = session()->get('recent_sightlist_searches', []);

        if (!empty($val)) {
            $currentSearch = [
                'locationId' => $locId,
                'val' => $val,
                'type' => $res_type
            ];

            // Check if the current search already exists in recent searches
            $isDuplicate = false;
            foreach ($recentSearches as $search) {
                if ($search['locationId'] === $currentSearch['locationId'] &&
                    $search['val'] === $currentSearch['val'] &&
                    $search['type'] === $currentSearch['type']) {
                    $isDuplicate = true;
                    break;
                }
            }

            // Add the current search only if it is not a duplicate
            if (!$isDuplicate) {
                array_unshift($recentSearches, $currentSearch);
                $recentSearches = array_slice($recentSearches, 0, 4); // Limit to 4 recent searches
                session(['recent_sightlist_searches' => $recentSearches]);
            }
        }


        if(empty($val)){
            $result = DB::table('Sight')
            ->leftJoin('Category', 'Sight.categoryId', '=', 'Category.categoryId')
            ->join('Location','Location.LocationId','=','Sight.LocationId')
            ->leftJoin('Sight_image as img', function ($join) {
                $join->on('Sight.SightId', '=', 'img.Sightid');
                $join->whereRaw('img.Image = (SELECT Image FROM Sight_image WHERE Sightid =Sight.SightId LIMIT 1)');
               })
            ->where('Sight.LocationId', $locId)
            ->select('Sight.SightId', 'Sight.IsMustSee', 'Sight.Title', 'Sight.TAAggregateRating', 'Sight.LocationId', 'Sight.Slug', 'IsRestaurant', 'Address', 'Sight.Latitude', 'Sight.Longitude', 'Sight.CategoryId', 'Category.Title as CategoryTitle', 'Location.Name as LName', 'Location.slugid',  'img.Image', 'Sight.TATotalReviews','Sight.ticket')
           // ->select('Category.Title as CategoryTitle', 'Sight.*')
			->where('Sight.IsMustSee', 1)
            ->limit(10)
            ->get()
            ->toArray();
        }

        if($val == "Must See" || $val == "must see" || $val == "mustsee"){
            $result = DB::table('Sight')
            ->leftJoin('Category', 'Sight.categoryId', '=', 'Category.categoryId')
            ->join('Location','Location.LocationId','=','Sight.LocationId')
            ->leftJoin('Sight_image as img', function ($join) {
                $join->on('Sight.SightId', '=', 'img.Sightid');
                $join->whereRaw('img.Image = (SELECT Image FROM Sight_image WHERE Sightid =Sight.SightId LIMIT 1)');
            })
            ->where('Sight.LocationId', $locId)
            ->where('Sight.IsMustSee', 1)
            ->select('Sight.SightId', 'Sight.IsMustSee', 'Sight.Title', 'Sight.TAAggregateRating', 'Sight.LocationId', 'Sight.Slug', 'IsRestaurant', 'Address', 'Sight.Latitude', 'Sight.Longitude', 'Sight.CategoryId', 'Category.Title as CategoryTitle', 'Location.Name as LName', 'Location.slugid',  'img.Image', 'Sight.TATotalReviews','Sight.ticket')
            ->limit(5)
            ->get()
            ->toArray();
        }
        if(empty($result) && $val == "Restaurant" || $val == "restaurant"){
            $rest =1;
            $result_rest = DB::table('Restaurant as r')
            ->join('Location','Location.slugid','=','r.slugid')
            ->where('r.LocationId', $locId)
            ->where(function ($query) use ($val) {
                $query->where('r.Title', 'LIKE','%'. $val . '%') ;
            })
            ->select('r.LocationId','r.RestaurantId','r.Title','r.Timings','r.TAAggregateRating','r.category','r.features','r.slugid','r.PriceRange','Location.Name as Lname')
            ->limit(5)
            ->get()
            ->toArray();
         //   return print_r(result_rest);
        }
        if(empty($result) && $val == "experience" || $val == "Experience"){
            $exp =1;
            $result_rest = DB::table('Experience as e')
            ->join('Location','Location.slugid','=','e.slugid')
            ->where('e.LocationId', $locId)
            ->select('e.slugid','e.ExperienceId','e.Slug','e.Name','e.adult_price','Location.Name as Lname','e.Img1','e.Img2','e.Img3')
            ->limit(5)
            ->get()
         ->toArray();
        //  return print_r($result_rest);
        }

        if(empty($result) &&  empty($result_rest)){
            $result = DB::table('Sight')
            ->leftJoin('Category', 'Sight.categoryId', '=', 'Category.categoryId')
            ->join('Location','Location.LocationId','=','Sight.LocationId')
            ->leftJoin('Sight_image as img', function ($join) {
                $join->on('Sight.SightId', '=', 'img.Sightid');
                $join->whereRaw('img.Image = (SELECT Image FROM Sight_image WHERE Sightid =Sight.SightId LIMIT 1)');
            })
            ->where('Sight.LocationId', $locId)
            ->where(function ($query) use ($val) {
                $query->where('Sight.Title', 'LIKE', $val . '%');
            })
            ->select('Sight.SightId', 'Sight.IsMustSee', 'Sight.Title', 'Sight.TAAggregateRating', 'Sight.LocationId', 'Sight.Slug', 'IsRestaurant', 'Address', 'Sight.Latitude', 'Sight.Longitude', 'Sight.CategoryId', 'Category.Title as CategoryTitle', 'Location.Name as LName', 'Location.slugid',  'img.Image', 'Sight.TATotalReviews','Sight.ticket')
        // ->select('Category.Title as CategoryTitle', 'Sight.*')
            ->limit(5)
            ->get()
            ->toArray();
       }


        if(empty($result) && empty($result_rest)){
            $result = DB::table('Sight')
            ->leftJoin('Category', 'Sight.categoryId', '=', 'Category.categoryId')
            ->join('Location','Location.LocationId','=','Sight.LocationId')
            ->leftJoin('Sight_image as img', function ($join) {
                $join->on('Sight.SightId', '=', 'img.Sightid');
                $join->whereRaw('img.Image = (SELECT Image FROM Sight_image WHERE Sightid =Sight.SightId LIMIT 1)');
            })
            ->where('Sight.LocationId', $locId)
            ->where(function ($query) use ($val) {
                $query->where('Category.Title', 'LIKE', $val . '%');
            })
            ->select('Sight.SightId', 'Sight.IsMustSee', 'Sight.Title', 'Sight.TAAggregateRating', 'Sight.LocationId', 'Sight.Slug', 'IsRestaurant', 'Address', 'Sight.Latitude', 'Sight.Longitude', 'Sight.CategoryId', 'Category.Title as CategoryTitle', 'Location.Name as LName', 'Location.slugid',  'img.Image', 'Sight.TATotalReviews','Sight.ticket')
            ->limit(5)
            ->get()
            ->toArray();
        }
        if(empty($result) && empty($result_rest)){
            $result = DB::table('Sight')
            ->leftJoin('Category', 'Sight.categoryId', '=', 'Category.categoryId')
            ->join('Location','Location.LocationId','=','Sight.LocationId')
            ->leftJoin('Sight_image as img', function ($join) {
                $join->on('Sight.SightId', '=', 'img.Sightid');
                $join->whereRaw('img.Image = (SELECT Image FROM Sight_image WHERE Sightid =Sight.SightId LIMIT 1)');
            })
             ->where('Sight.LocationId', $locId)
            ->where(function ($query) use ($val) {
                $query->where('Sight.About', 'LIKE',  '%'. $val . '%');
            })
            ->select('Sight.SightId', 'Sight.IsMustSee', 'Sight.Title', 'Sight.TAAggregateRating', 'Sight.LocationId', 'Sight.Slug', 'IsRestaurant', 'Address', 'Sight.Latitude', 'Sight.Longitude', 'Sight.CategoryId', 'Category.Title as CategoryTitle', 'Location.Name as LName', 'Location.slugid',  'img.Image', 'Sight.TATotalReviews','Sight.ticket')
            ->limit(5)
            ->get()
            ->toArray();

          // return print_r($result);
        }
        if(empty($result) && empty($result_rest)){
            $result = DB::table('Sight')
            ->leftJoin('Category', 'Sight.categoryId', '=', 'Category.categoryId')
            ->join('Location','Location.LocationId','=','Sight.LocationId')
            ->leftJoin('Sight_image as img', function ($join) {
                $join->on('Sight.SightId', '=', 'img.Sightid');
                $join->whereRaw('img.Image = (SELECT Image FROM Sight_image WHERE Sightid =Sight.SightId LIMIT 1)');
            })
            ->leftJoin('SightReviews', 'Sight.SightId', '=', 'SightReviews.SightId')
            ->where('Sight.LocationId', $locId)
            ->where(function ($query) use ($val) {
                $query->where('SightReviews.ReviewDescription', 'LIKE','%'. $val . '%');
            })
            ->select('Sight.SightId', 'Sight.IsMustSee', 'Sight.Title', 'Sight.TAAggregateRating', 'Sight.LocationId', 'Sight.Slug', 'IsRestaurant', 'Address', 'Sight.Latitude', 'Sight.Longitude', 'Sight.CategoryId', 'Category.Title as CategoryTitle', 'Location.Name as LName', 'Location.slugid',  'img.Image', 'Sight.TATotalReviews','Sight.ticket')
            ->limit(5)
            ->get()
            ->toArray();


        }
//image code
	$sightImages = collect();
    $sightIds = []; // Initialize the array to hold SightId values

if (!empty($result)) {
    // Check if $result is an array of stdClass objects
    if (is_array($result)) {
        // Use foreach to collect SightId from each stdClass object
        foreach ($result as $sights) {
            // Ensure $sights is an object and then access the SightId
            if (is_object($sights) && isset($sights->SightId)) {
                $sightIds[] = $sights->SightId; // Collect SightId from object
            }
        }
    }




    // After collecting SightId, check if $sightIds is not empty
    if (!empty($sightIds)) {
        // Fetch sight images if $sightIds is not empty
        $sightImages = DB::table('Sight_image')
            ->whereIn('Sightid', $sightIds)
            ->get();
    }
}

//image code


		//return print_r($result);

        //restaurant
      //  $rest =0;
     //   $exp =0;
        if(empty($result)){

            $rest =1;
            if(empty($result_rest)){
                $result_rest = DB::table('Restaurant as r')
                ->join('Location','Location.slugid','=','r.slugid')
                ->where('r.LocationId', $locId)
                ->where(function ($query) use ($val) {
                    $query->where('r.Title', 'LIKE','%'. $val . '%') ;
                })
                ->select('r.LocationId','r.RestaurantId','r.Title','r.Timings','r.TAAggregateRating','r.category','r.features','r.slugid','r.PriceRange','Location.Name as Lname')
                ->limit(5)
                ->get()
                ->toArray();
            }

            if(empty($result_rest)){
                $result_rest = DB::table('Restaurant as r')
                ->join('Location','Location.slugid','=','r.slugid')
                ->where('r.LocationId', $locId)
                ->where(function ($query) use ($val) {
                    $query->where('r.About', 'LIKE','%'. $val . '%');
                })
                ->select('r.LocationId','r.RestaurantId','r.Title','r.Address','r.Timings','r.TAAggregateRating','r.category','r.features','r.slugid','r.PriceRange','Location.Name as Lname')
                ->limit(5)
                ->get()
                ->toArray();
            }
            if(empty($result_rest)){
                $result_rest = DB::table('Restaurant as r')
                ->join('Location','Location.slugid','=','r.slugid')
                ->join('RestaurantCuisineAssociation as ra','ra.RestaurantId','=','r.RestaurantId')
                ->join('RestaurantCuisine as rc','ra.RestaurantCuisineId','=','rc.RestaurantCuisineId')
                ->where('r.LocationId', $locId)
                ->where(function ($query) use ($val) {
                    $query->where('rc.Name', 'LIKE','%'. $val . '%');
                })
                ->select('r.LocationId','r.RestaurantId','r.Title','r.Address','r.Timings','r.TAAggregateRating','r.category','r.features','r.slugid','r.PriceRange','Location.Name as Lname')
                ->limit(5)
                ->get()
                ->toArray();
            }
             if(empty($result_rest)){
                $result_rest = DB::table('Restaurant as r')
                ->join('Location','Location.slugid','=','r.slugid')
                ->join('RestaurantReview as rv','rv.RestaurantId','=','r.RestaurantId')
                ->where('r.LocationId', $locId)
                ->where(function ($query) use ($val) {
                    $query->where('rv.Description', 'LIKE','%'. $val . '%');
                })
                ->select('r.LocationId','r.RestaurantId','r.Title','r.Address','r.Timings','r.TAAggregateRating','r.category','r.features','r.slugid','r.PriceRange','Location.Name as Lname')
                ->limit(5)
                ->get()
                ->toArray();
            }

            if(empty($result_rest)){
               $exp =1;
                $result_rest = DB::table('Experience as e')
                ->join('Location','Location.slugid','=','e.slugid')
                ->where('e.LocationId', $locId)
                ->where(function ($query) use ($val) {
                    $query->where('e.Name', 'LIKE','%'. $val . '%');
                })
                ->select('e.slugid','e.ExperienceId','e.Slug','e.Name','e.adult_price','Location.Name as Lname','e.Img1','e.Img2','e.Img3')
                ->limit(5)
                ->get()
                ->toArray();
            }
            if(empty($result_rest)){
                $exp =1;
                 $result_rest = DB::table('Experience as e')
                 ->join('Location','Location.slugid','=','e.slugid')
                 ->where('e.LocationId', $locId)
                 ->where(function ($query) use ($val) {
                     $query->where('e.Inclusive', 'LIKE','%'. $val . '%');
                 })
                 ->select('e.slugid','e.ExperienceId','e.Slug','e.Name','e.adult_price','Location.Name as Lname','e.Img1','e.Img2','e.Img3')
                 ->limit(5)
                 ->get()
                 ->toArray();
             }

             if(empty($result_rest)){
                $exp =1;
                 $result_rest = DB::table('Experience as e')
                 ->join('Location','Location.slugid','=','e.slugid')
                 ->join('ExperienceItninerary as  et','et.ExperienceId','=','e.ExperienceId')
                 ->where('e.LocationId', $locId)
                 ->where(function ($query) use ($val) {
                     $query->where('et.Name', 'LIKE','%'. $val . '%');
                 })
                 ->select('e.slugid','e.ExperienceId','e.Slug','e.Name','e.adult_price','Location.Name as Lname','e.Img1','e.Img2','e.Img3')
                 ->limit(5)
                 ->get()
                 ->toArray();
             }
         //  return print_r($result_rest);
            if(empty($result_rest)){
                $exp =1;
                $result_rest = DB::table('Experience as e')
				->join('Location','Location.slugid','=','e.slugid')
                ->join('ExperienceReview as  rv','rv.ExperienceId','=','e.ExperienceId')
                ->where('e.LocationId', $locId)
                ->where(function ($query) use ($val) {
                    $query->where('rv.Description', 'LIKE','%'. $val . '%');
                })
                ->select('e.slugid','e.ExperienceId','e.Slug','e.Name','e.adult_price','Location.Name as Lname','e.Img1','e.Img2','e.Img3')
                ->limit(5)
                ->get()
                ->toArray();
            }

        }


        //end restaurant


		//new code
   if (!empty($result)) {

    foreach ($result as $results) {
         $sightId = $results->SightId;

        $Sightcat = DB::table('SightCategory')
            ->join('Category', 'SightCategory.CategoryId', '=', 'Category.CategoryId')
            ->select('Category.Title')
            ->where('SightCategory.SightId', '=', $sightId)
            ->get();

        $results->Sightcat = $Sightcat;

        $timing = DB::select("SELECT * FROM SightTiming WHERE SightId = ?", [$sightId]);
        $results->timing = $timing;

        // Retrieve reviews for the sight using a raw SQL query
        $reviews = DB::select("SELECT * FROM SightReviews WHERE SightId = ?", [$sightId]);

        // Merge the reviews into the result directly
        $results->reviews = $reviews;
    }
}


//end set timing cat val
$mergedData = [];

// Loop through attractions and associate them with categories
if (!empty($result)) {
    foreach ($result as $att) {
        if (!empty($att->Sightcat)) {
            // Loop through categories and create an associative array
            foreach ($att->Sightcat as $category) {
                if ($category->Title != "") {
                    $categoryTitle = $category->Title;
                } else {
                    $categoryTitle = '';
                };

                if (!empty($att->Latitude) && !empty($att->Longitude)) {
                    // Check if $att->timing is set and contains the required properties
                    if (isset($att->timing->timings)) {
                        // Calculate the opening and closing time
                        $schedule = json_decode($att->timing->timings, true);
                        $currentDay = strtolower(date('D'));
                        $currentTime = date('H:i');
                        $openingtime = $schedule['time'][$currentDay]['start'];
                        $closingTime = $schedule['time'][$currentDay]['end'];
                        $isOpen = false;
                        $formatetime = '';

                        if ($openingtime === '00:00' && $closingTime === '23:59') {
                            $formatetime = '12:00';
                            $closingTime = '11:59';
                        }

                        if ($currentTime >= $openingtime && $currentTime <= $closingTime) {
                            $isOpen = true;
                        }

                        $timingInfo = $isOpen ? $formatetime . ' Open Now' : 'Closed Today';
                    } else {
                        $timingInfo = '';
                    }
 					if($att->TAAggregateRating != ""  && $att->TAAggregateRating != 0){
                        $recomd = rtrim($att->TAAggregateRating, '.0') * 20;
						$recomd = $recomd . '%';
                   }else{
                       $recomd ='--';
                   }

                   $imagepath ="";
                   if($att->Image !=""){
                          $imagepath = asset('public/sight-images/'. $att->Image) ;
                   }else{
                          $imagepath = asset('public/images/Hotel lobby.svg');
                   }
                    $locationData = [
                        'Latitude' => $att->Latitude,
                        'Longitude' => $att->Longitude,
                        'SightId' => $att->SightId,
                        'ismustsee' => $att->IsMustSee,
                        'name' => $att->Title,
                        'recmd' => $recomd,
                        'cat' => $categoryTitle,
                        'tm' => $timingInfo,
                        'cityName'=>'City of '.$att->LName,
                        'imagePath'=>$imagepath,
                    ];

                    $mergedData[] = $locationData; // Add the locationData directly to mergedData
                }
            }
        } else {
            // If there are no categories, create a default "uncategorized" category
            if (!empty($att->Latitude) && !empty($att->Longitude)) {
                // Check if $att->timing is set and contains the required properties
                if (isset($att->timing->timings)) {
                    // Calculate the opening and closing time (same as above)
                    // ...
                    // ...
				   if($att->TAAggregateRating != ""  && $att->TAAggregateRating != 0){
                        $recomd = rtrim($att->TAAggregateRating, '.0') * 20;
					   $recomd = $recomd . '%';
                   }else{
                       $recomd ='--';
                   }
                   $imagepath ="";
                   if($att->Image !=""){
                          $imagepath = asset('public/sight-images/'. $att->Image) ;
                   }else{
                          $imagepath = asset('public/images/Hotel lobby.svg');
                   }
                    $locationData = [
                        'Latitude' => $att->Latitude,
                        'Longitude' => $att->Longitude,
                        'SightId' => $att->SightId,
                        'ismustsee' => $att->IsMustSee,
                        'name' => $att->Title,
                        'recmd' => $recomd,
                        'cat' => ' ',
                        'tm' => $timingInfo,
                        'cityName'=>'City of '.$att->LName,
                        'imagePath'=>$imagepath,
                    ];

                    $mergedData[] = $locationData;
                }
            }
        }
    }
	}
  // return $mergedData;
	// Encode data as JSON
	    $locationDataJson = json_encode($mergedData);

        if($exp == 1){
            $html = view('get_location_filtered_experience')->with('result', $result_rest)->with('type','search')->render();
        }elseif($rest == 1){
            $html = view('get_location_filtered_Restaurant')->with('result', $result_rest)->with('type','search')->render();
        }else{
            $html = view('getloclistbycatid')->with('sightImages',$sightImages)->with('searchresults', $result)->with('type','search')->render();
        }


        return response()->json(['mapData' => $locationDataJson, 'html' => $html]);

    }


	//end filter


       public function update_sight_desc(request $request){
        $desc = $request->get('desc');
        $sightid = $request->get('id');
        if($sightid != ''){
            $update = DB::table('Sight')
            ->where('SightId', $sightid)
            ->update(['About' => $desc]);
        }


        $get_about = DB::table('Sight')->select('About')->where('SightId',$sightid)->get();
        return  view('get_about',['searchresult'=>$get_about]);

    }

    public function restaurant_landing(request $request){
   //echo $locationID =828104;  // 840749;
        $category ="";
        $category = $request->get('q');
        $locationID = $request->get('location');

        if( $locationID !=""){
             $getloc = DB::table('Location')->select('LocationId')->where('slugid', $locationID)->get();

            if(!$getloc->isEmpty()){
                $locationID =  $getloc[0]->LocationId;
            }
        }


        $breadcumb=[];
        $locationPatent = [];
       if( $locationID != ""){

        $breadcumb  = DB::table('Location as l')
        ->select('l.CountryId', 'l.Name as LName', 'l.Slug as Lslug', 'co.Name as CountryName','l.LocationId','co.slug as cslug','co.CountryId','cont.Name as ccName','cont.CountryCollaborationId as contid')
        ->Join('Country as co', 'l.CountryId', '=', 'co.CountryId')
        ->leftJoin('CountryCollaboration as cont','cont.CountryCollaborationId','=','co.CountryCollaborationId')
        ->where('l.LocationId', $locationID)
        ->get()
        ->toArray();

     //  return print_r( $breadcumb);

        $getparent = DB::table('Location')->select('LocationId','slug','Name','LocationLevel','ParentId')->where('LocationId', $locationID)->get();




      if (!empty($getparent) && $getparent[0]->LocationLevel != 1) {
          $loopcount = $getparent[0]->LocationLevel;
          $lociID = $getparent[0]->ParentId;
          for ($i = 1; $i < $loopcount; $i++) {
              $getparents = DB::table('Location')->where('LocationId', $lociID)->get();
              if (!empty($getparents)) {
                   $locationPatent[] = [
                       'LocationId' => $getparents[0]->slugid,
                       'slug' => $getparents[0]->Slug,
                       'Name' => $getparents[0]->Name,
                   ];
                  if (!empty($getparents) && $getparents[0]->ParentId != "") {
                  $lociID = $getparents[0]->ParentId;
               }
              } else {
                  break; // Exit the loop if no more parent locations are found
              }
          }
      }

  }

      $searchresults = DB::table('Restaurant as r')
      ->leftjoin('Location as l', 'l.LocationId', '=', 'r.LocationId')
      ->select('r.*', 'l.Longitude as loc_longitude', 'l.Lat as loc_latitude','l.Name as lname','l.slugid')
      ->whereRaw("CONCAT(',', r.category, ',') LIKE '%,{$category},%'");

        if ($locationID !="") {
            $searchresults->where('r.LocationId', $locationID);
        }

          $searchresults = $searchresults->limit(15)->get();
          $lname ="";
          if(!$searchresults->isEmpty()){
            $lname =  $searchresults[0]->lname;
          }


        return view('restaurant_landing',['breadcumb'=>$breadcumb,'locationPatent'=>$locationPatent,'searchresults'=>$searchresults,'category'=>$category,'lname'=>$lname]);
    }

public function hotel_room_desc(Request $request) {
    $checkin = $request->get('checkin');
    $checkout = $request->get('checkout');
    $cityId = $request->get('lid');
    $hotelId = $request->get('hid');

    // Other variables and initial setup...

    // Fetch room data
    $roomsData = [];

    if($checkin !=""  && $checkout !="") {
        $pgtype = 'withdate';

        //   $start  =  date("H:i:s");
        $pgtype = 'withdate';

       // $cityName = $request->get('cityName') ;

       $guests = 2; //Session()->get('guest');
       $rooms = 1;//Session()->get('rooms');

       $stchin = $checkin;
       $checkout = $checkout;

       $cmbdate = $checkin.'_'.$checkout;
       $checkin =  $checkin;


       //new code start
       $checkinDate = $checkin;
       $checkoutDate = $checkout;
       $adultsCount = 2; //$guests;
       $customerIP = '49.156.89.145';
       $childrenCount = '1';
       $chid_age = '10';
       $lang = 'en';
       $currency ='USD';
       $waitForResult ='0';
       $iata=$hotelId;

       $TRAVEL_PAYOUT_TOKEN = "27bde6e1d4b86710997b1fd75be0d869";
       $TRAVEL_PAYOUT_MARKER = "299178";



       $SignatureString = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$adultsCount.":".
       $checkinDate.":".
       $checkoutDate.":".
       $chid_age.":".
       $childrenCount.":".
       $currency.":".
       $customerIP.":".
       $iata.":".
       $lang.":".
       $waitForResult;


       $signature = md5($SignatureString);
       //  $signature = '3193e161e98200459185e43dd7802c2c';

       $url ='http://engine.hotellook.com/api/v2/search/start.json?hotelId='.$iata.'&checkIn='. $checkinDate.'&checkOut='.$checkoutDate.'&adultsCount='.$adultsCount.'&customerIP='.$customerIP.'&childrenCount='.$childrenCount.'&childAge1='.$chid_age.'&lang='.$lang.'&currency='.$currency.'&waitForResult='.$waitForResult.'&marker=299178&signature='.$signature;



       $response = Http::withoutVerifying()->get($url);

       if ($response->successful()) {


       $data = json_decode($response);
           if(!empty($data)){
           $searchId = $data->searchId;


           $limit =10;
           $offset=0;
           $roomsCount=10;
           $sortAsc=1;
           $sortBy='price';

           $SignatureString2 = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$limit.":".$offset.":".$roomsCount.":".$searchId.":".$sortAsc.":".$sortBy;
               $sig2 =  md5($SignatureString2);

           $url2 = 'http://engine.hotellook.com/api/v2/search/getResult.json?searchId='.$searchId.'&limit=10&sortBy=price&sortAsc=1&roomsCount=10&offset=0&marker=299178&signature='.$sig2;
       // $response2 = Http::withoutVerifying()->get($url2);

           $maxAttempts = 4;
           $retryInterval = 1; // seconds
           $response2 = Http::withoutVerifying()
           ->timeout(0) // Maximum time for an individual request
           ->retry($maxAttempts, $retryInterval)
           ->get($url2);
           $jsonResponse = json_decode($response2, true);

           //new code 1
           if ($jsonResponse['status'] == 'ok') {


               $hotels = $jsonResponse['result'];
               $rooms = [];
               $roomsData = [];

                if ($jsonResponse['status'] == 'ok') {
                    $hotels = $jsonResponse['result'];

                    foreach ($hotels as $hotel) {
                        if (isset($hotel['rooms']) && is_array($hotel['rooms'])) {
                            foreach ($hotel['rooms'] as $room) {
                                $roomsData[$room['desc']] = [
                                    'price' => $room['total'],
                                    'agencyId' => $room['agencyId'],
                                    'fullBookingURL' => $room['fullBookingURL']
                                ];
                            }
                        }

                   //     return $roomsData;
                    }
                }


            }
        }
    }
}

    $TPRoomtype = DB::table('TPRoomtype')->select('Roomdesc')->where('hotelid', $hotelId)->get();
	$tpdesc =[];
    return response()->json([
        'roomsData' => $roomsData,
        'TPRoomtype' => $TPRoomtype,
		 'tpdesc' => $tpdesc
    ]);
}
//filter hotel room detail page


   public function filter_hotel_room(Request $request)
    {
        $value = $request->get('value'); // Example: ['breakfast', 'deposit']
        $hotelid = $request->get('hotelid');

        // Retrieve the rooms for the specified hotel
        $rooms = DB::table('TPRoomtype')
            ->where('hotelid', $hotelid)
            ->get();

        // Retrieve the hotel data
        $hotel = DB::table('TPHotel')
            ->select('photosByRoomType', 'hotelid', 'photoCount')
            ->where('hotelid', $hotelid)
            ->get();

        // Decode room descriptions
        $roomDesc = json_decode($rooms[0]->Roomdesc, true);

        $updatedRoomDescJson = []; // Initialize the array to store filtered room data

        if (!empty($value)) {
            foreach ($roomDesc as $key => $desc) {
                $includeRoom = true;

                foreach ($value as $filterValue) {
                    // Check if each filter value is set and true in the description
                    if (isset($desc[$filterValue]) && $desc[$filterValue] == true) {
                        $updatedRoomDescJson[$key] = $desc;
                    }
                }

            }

            $updatedRoomDescJson = json_encode($updatedRoomDescJson);
        } else {
            // If no filters provided, return all room descriptions
            $updatedRoomDescJson = json_encode($roomDesc);
        }

        // Retrieve room types
        $getroomtype = collect();
        $photosByRoomType = json_decode($hotel[0]->photosByRoomType, true);

        if (!empty($photosByRoomType)) {
            $roomtyids = array_keys($photosByRoomType);

            $getroomtype = DB::table('TPRoom_types')
                ->select('rid', 'type')
                ->whereIn('rid', $roomtyids)
                ->get();
        }

        // Return the view with the filtered room data
        return view('frontend.hotel.filter_room_result', [
            'TPRoomtype' => $rooms,
            'updatedRoomDescJson' => $updatedRoomDescJson,
            'searchresult' => $hotel,
            'getroomtype' => $getroomtype
        ]);
    }




 public function filter_hotel_room_with_date(request $request){
         $value = $request->get('value');

         $hotelid = $request->get('hotelid');

         $checkout = $request->get('checkout');
         $checkin = $request->get('checkin');

         $hoteldata = DB::table('TPHotel')
         ->select('photosByRoomType','hotelid','photoCount')
         ->where('hotelid',$hotelid)
         ->get();

         $roomsprice = [];

         $roomsData = [];
            $rooms =[];
            $pgtype = '';

            //start room
            if($checkin !=""  &&   $checkout !=""){

            $pgtype = 'withdate';



            $guests = 2; //Session()->get('guest');
            $rooms = 1;//Session()->get('rooms');

            $stchin = $checkin;
            $checkout = $checkout;

            $cmbdate = $checkin.'_'.$checkout;


            $checkin =  $checkin;

            //new code start
            $checkinDate = $checkin;
            $checkoutDate = $checkout;
            $adultsCount = 2; //$guests;
            $customerIP = '49.156.89.145';
            $childrenCount = '1';
            $chid_age = '10';
            $lang = 'en';
            $currency ='USD';
            $waitForResult ='0';
            $iata=$hotelid;

            $TRAVEL_PAYOUT_TOKEN = "27bde6e1d4b86710997b1fd75be0d869";
            $TRAVEL_PAYOUT_MARKER = "299178";



            $SignatureString = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$adultsCount.":".
            $checkinDate.":".
            $checkoutDate.":".
            $chid_age.":".
            $childrenCount.":".
            $currency.":".
            $customerIP.":".
            $iata.":".
            $lang.":".
            $waitForResult;


            $signature = md5($SignatureString);
            //  $signature = '3193e161e98200459185e43dd7802c2c';

            $url ='http://engine.hotellook.com/api/v2/search/start.json?hotelId='.$iata.'&checkIn='. $checkinDate.'&checkOut='.$checkoutDate.'&adultsCount='.$adultsCount.'&customerIP='.$customerIP.'&childrenCount='.$childrenCount.'&childAge1='.$chid_age.'&lang='.$lang.'&currency='.$currency.'&waitForResult='.$waitForResult.'&marker=299178&signature='.$signature;



            $response = Http::withoutVerifying()->get($url);

            if ($response->successful()) {
               $data = json_decode($response);
                if(!empty($data)){
                $searchId = $data->searchId;


                $limit =10;
                $offset=0;
                $roomsCount=10;
                $sortAsc=1;
                $sortBy='price';

                $SignatureString2 = "". $TRAVEL_PAYOUT_TOKEN .":".$TRAVEL_PAYOUT_MARKER.":".$limit.":".$offset.":".$roomsCount.":".$searchId.":".$sortAsc.":".$sortBy;
                $sig2 =  md5($SignatureString2);

                $url2 = 'http://engine.hotellook.com/api/v2/search/getResult.json?searchId='.$searchId.'&limit=10&sortBy=price&sortAsc=1&roomsCount=10&offset=0&marker=299178&signature='.$sig2;
            // $response2 = Http::withoutVerifying()->get($url2);

                $maxAttempts = 4;
                $retryInterval = 1; // seconds
                $response2 = Http::withoutVerifying()
                ->timeout(0) // Maximum time for an individual request
                ->retry($maxAttempts, $retryInterval)
                ->get($url2);
                $jsonResponse = json_decode($response2, true);

                //new code 1

                if ($jsonResponse['status'] == 'ok') {
                    $hotels = $jsonResponse['result'];
                    $roomsdsc = [];


                    //new code
                    foreach ($hotels as $hotel) {
                        if (isset($hotel['rooms']) && is_array($hotel['rooms'])) {
                            foreach ($hotel['rooms'] as $room) {
                                $includeRoom = false;

                                foreach ($value as $values) {
                                    if (isset($room['options'][$values]) && $room['options'][$values] === true) {
                                        $includeRoom = true;
                                        break; // Exit the innermost foreach loop once a match is found
                                    }
                                }

                                if ($includeRoom) {
                                    $roomsdsc[] = [
                                        'options' => $room['options'],
                                        'desc' => $room['desc'],
                                        'price' => $room['price'],
                                        'bookingURL' => $room['bookingURL'],
                                        'fullBookingURL' => $room['fullBookingURL'],
                                        'agencyId' => $room['agencyId'],
                                        'agencyName' => $room['agencyName'],
                                    ];

                                    $roomName = $room['desc'];
                                    $amenities = $room['options'];
                                    $roomsData[$roomName] = $amenities;
                                    $roomsprice[$roomName] = [
                                        'agencyId' => $room['agencyId'],
                                        'price' => $room['price'],
                                        'fullBookingURL' => $room['fullBookingURL']
                                    ];
                                }
                            }
                        }
                    }


                    //end new code


        //end dd

        }

     //end new code

     if (isset($jsonResponse['errorCode']) && $jsonResponse['errorCode'] === 4) {
         $jsonResponse['data_status'] = 4;
          return   $jsonResponse;
     }

        //return val

     }else{
         return 'search id not found';
     }

 }

}


        //end

//start code
       $rooms = DB::table('TPRoomtype')
           ->where('hotelid',$hotelid)
           ->get();

        $Roomdesc =  $rooms[0]->Roomdesc;

        $roomsData = [];
        $roomDesc = json_decode($rooms[0]->Roomdesc, true);
        if(!empty($value)){
          //  foreach ($rooms as $room) {


                foreach ($roomDesc as $key => $desc) {
                    $includeRoom = true;

                    foreach ($value as $values) {
                        // Check if each value is set and true in the description
                        if (isset($desc[$values]) && $desc[$values] == true) {
                            $roomsData[$key] = $desc;
                        }else{
                            $includeRoom = false;
                            break;
                        }
                    }

                    if ($includeRoom) {
                        $roomsData[$key] = $desc;
                    }
                }
                // return $roomsData;

        }else{
            $roomsData =  $roomDesc;
        }







       //end
       $getroomtype = collect();
       $photosByRoomType = json_decode($hoteldata[0]->photosByRoomType, true);

          if (!empty($photosByRoomType)) {
              foreach ($photosByRoomType as $key => $value) {
                  $roomtyids[] = $key;
              }

              $getroomtype = DB::table('TPRoom_types')->select('rid','type')->whereIn('rid', $roomtyids)->get();


           }

        //   return print_r($roomsprice);
       //end code

      return  view('frontend.hotel.filter_room_with_date',['TPRoomtype'=> $rooms,'searchresult'=>$hoteldata,'getroomtype'=>$getroomtype,'roomsdsc'=>$roomsData,'roomsprice'=>$roomsprice]);

    }

//end filter hotel room
   public function view_hotel_all_images(request $request){
        $hotid = $request->get('hotelid');
        $url = 'https://yasen.hotellook.com/photos/hotel_photos?id='.$hotid ;
        $response = Http::withoutVerifying()->get($url);
        $images = $response->json();
        return  view('hotel_detail_data.hoteldetail_view_all_images')->with('images',$images)->with('hotelid',$hotid);
    }
    public function gethotel_galary_image(request $request){
        $hotid = $request->get('hotelid');
        $url = 'https://yasen.hotellook.com/photos/hotel_photos?id='.$hotid ;
        $response = Http::withoutVerifying()->get($url);
        $images = $response->json();
        return  view('hotel_detail_data.hotel_galary_image')->with('images',$images)->with('hotelid',$hotid);
    }


    public function hotel_detail_nearby_city_and_sights(request $request){

        $location_id = $request->get('locationid');
        $location_slugid = $request->get('location_slugid');
        $hotellatitude = $request->get('Latitude');
        $hotellongitude = $request->get('longitude');
        $hotelid = $request->get('hotelid');
        $hname = $request->get('hname');
        $hid = $request->get('hid');
        $getlocation =  DB::table('Location')->select('Lat','Longitude')->where('slugid',$location_slugid)->get();
        $lat ="";



        $searchradius = 100;
        $nearby_city = collect();
		$nearby_Sight  = collect();
	    $city_hotel_count = [];
		$sight_hotel_count = [];
		$sight_hotel_count_grouped = [];
		$sight_hotelcount  = null;
        if(!$getlocation->isEmpty() ){
            $latitude = $getlocation[0]->Lat;
            $longitude = $getlocation[0]->Longitude;
            if ($latitude != "" && $longitude != "") {
                $nearby_city = DB::table("Location")
                    ->join('Temp_Mapping as t', 'Location.slugid', '=', 't.slugid')
                    ->select(
                        'Location.LocationId',
                        'Location.Name',
                        't.LocationId as locid','t.slugid','t.slug',
                        DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                            * cos(radians(Location.Lat))
                            * cos(radians(Location.Longitude) - radians(" . $longitude . "))
                            + sin(radians(" . $latitude . "))
                            * sin(radians(Location.Lat))) AS distance")
                    )
                    ->having('distance', '<=', $searchradius)
                    ->where('Location.slugid', '!=', $location_slugid)
                    ->orderBy('distance')
                    ->limit(10)
                    ->get();


            if (!$nearby_city->isEmpty()) {

                foreach ($nearby_city as $value) {
                    $hotel_count = DB::table('TPHotel')->where('location_id', $value->locid)->count();
                    $city_hotel_count[] = [
                        'city_name' => $value->Name,
                        'hotel_count' => $hotel_count,
                        'slug'=>'ho-'.$value->slugid.'-'.$value->slug,

                    ];
                }
            }

            //get location
            $searchradius =50;
            $nearby_Sight = DB::table("Sight")
                ->join('Temp_Mapping as t', 'Sight.LocationId', '=', 't.tid')
                ->join('Category as c', 'c.CategoryId', '=', 'Sight.CategoryId')
                ->select(
                    'Sight.LocationId',
                    'Sight.Title','t.slugid','t.slug',
                    't.LocationId as locid', 'c.Title as ctitle','Sight.Latitude','Sight.Longitude',
                    DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                        * cos(radians(Sight.Latitude))
                        * cos(radians(Sight.Longitude) - radians(" . $longitude . "))
                        + sin(radians(" . $latitude . "))
                        * sin(radians(Sight.Latitude))) AS distance")
                )
                ->having('distance', '<=', $searchradius)
                ->orWhere('Sight.IsMustSee', '=', 1)

                ->orderBy('distance')
                ->limit(10)
                ->get();

		  }


        if (!$nearby_Sight->isEmpty()) {

            foreach ($nearby_Sight as $val) {
                $slat = $val->Latitude;
                $slongitude = $val->Longitude;

                $searchradius =10;
                $sight_hotelcount = DB::table("TPHotel as h")
                ->select(DB::raw("6371 * acos(cos(radians(" . $slat . "))
                    * cos(radians(h.Latitude))
                    * cos(radians(h.longnitude) - radians(" . $slongitude . "))
                    + sin(radians(" . $slat . "))
                    * sin(radians(h.Latitude))) AS distance"))
                ->having('distance', '<=', $searchradius)
                ->count();

            $sight_hotel_count[] = [
                'category' => $val->ctitle,
                'Title' => $val->Title,
                'hotelcount' => $sight_hotelcount,
                'slug'=>'ho-'.$val->slugid.'-'.$val->slug,
            ];
            }


            foreach ($sight_hotel_count as $sightval) {
                $sight_hotel_count_grouped[$sightval['category']][] = $sightval;
            }


        }


        }


       return view('frontend.hotel.where_to_stay',['sight_hotel_count'=>$sight_hotel_count,'city_hotel_count'=>$city_hotel_count,'sight_hotel_count_grouped'=>$sight_hotel_count_grouped,'hname'=>$hname]);


    }

    public function stays()
    {

          $searchresults = DB::table('UniqueHotel as TPHotel')
          ->leftJoin('TPHotel_types as ty', 'ty.hid', '=', 'TPHotel.propertyType')
          ->select('TPHotel.hotelid', 'TPHotel.id', 'TPHotel.name', 'TPHotel.slug', 'TPHotel.stars', 'TPHotel.pricefrom', 'TPHotel.rating', 'TPHotel.amenities', 'TPHotel.distance', 'TPHotel.image', 'ty.type as propertyType','TPHotel.slugid','TPHotel.CityName as cityName','TPHotel.room_aminities')
		 ->whereNotNull('TPHotel.slugid')
         // ->where('TPHotel.stars',5)
        //  ->limit(8)
           ->get();

         $locationIds = "";
         $hotels ="";
         $citiesWithHotels="";



          // Inspect the data



        $type = "hotel";
        return view('stays')->with('searchresults',$searchresults)->with('citiesWithHotels',$citiesWithHotels)->with('locationIds',$locationIds);
    }
    public function stayslocdata(request $request)
    {


        $locationIds = [ 786371, 740257, 750174, 682061,  837452, 697010, 820094,
          665939, 840749, 797023, 683796, 763119, 845571,837009,668729
       ];


          $cities = DB::table(DB::raw('(SELECT DISTINCT l.Name, l.slugid, l.Slug, l.LocationId
            FROM Location as l
            JOIN TPHotel as h ON h.slugid = l.slugid) AS subquery'))
            ->select('subquery.Name', 'subquery.slugid', 'subquery.Slug')
              ->whereIn('subquery.LocationId', $locationIds)
            ->get();

            $locationIds = $cities->pluck('slugid');
		     $hotels = DB::table('TPHotel')
           ->select('name', 'slug', 'pricefrom', 'slugid', 'id')
            ->whereIn('slugid', $locationIds)
            ->get();


        $citiesWithHotels = $cities->map(function($city) use ($hotels) {
            $city->hotels = $hotels->filter(function($hotel) use ($city) {
                return $hotel->slugid == $city->slugid;
            })->take(10);

            return $city;
        });

        return view('stays_location_data')->with('citiesWithHotels',$citiesWithHotels);
    }



    //sight listing search

    public function searchsightlisting(Request $request)
    {
        if ($request->has('val')) {
            $searchText = $request->input('val');
            $locId = $request->input('locId');


            $type = 'attraction';
            $result = DB::table('Sight')
                ->where('Sight.LocationId', $locId)
                ->where(function ($query) use ($searchText) {
                    $query->where('Sight.Title', 'LIKE', $searchText . '%');
                })
                ->select('Sight.SightId as id', 'Sight.Title as displayname')
                ->limit(5)
                ->get();
            if(empty($result) && $searchText =="must see"){
                $result[] = [
                    'id' => '1',
                    'displayname' =>"Must See",
                    'type' => "Category"
                ];
            }
            if ($result->isEmpty()) {
                $type = 'Category';
                $result = DB::table('Sight')
                    ->leftJoin('Category', 'Sight.categoryId', '=', 'Category.categoryId')
                    ->join('Location', 'Location.LocationId', '=', 'Sight.LocationId')
                    ->where('Sight.LocationId', $locId)
                    ->where(function ($query) use ($searchText) {
                        $query->where('Category.Title', 'LIKE', $searchText . '%');
                    })
				    ->distinct()
                    ->select('Category.categoryId as id', 'Category.Title as displayname')
                    ->limit(5)
                    ->get();
            }
    //  return print_r($result);
            if ($result->isEmpty()) {
                $type = 'Restaurant';
                $result = DB::table('Restaurant as r')
                ->join('Location','Location.slugid','=','r.slugid')
                ->where('Location.LocationId', $locId)
               ->where(function ($query) use ($searchText) {
                     $query->where('r.Title', 'LIKE','%'. $searchText . '%') ;
                })
			    ->distinct()
                ->select('r.RestaurantId  as id','r.Title as displayname')
                ->limit(5)
                ->get();

            }
            if ($result->isEmpty()) {
                $type = 'Restaurant';
                $result = DB::table('Restaurant as r')
                ->join('Location','Location.slugid','=','r.slugid')
                ->where('Location.LocationId', $locId)
               ->where(function ($query) use ($searchText) {
                     $query->where('r.About', 'LIKE','%'. $searchText . '%') ;
                })
                ->select('r.RestaurantId  as id','r.Title as displayname')
                ->limit(5)
                ->get();

            }
            if ($result->isEmpty()) {
                $type = 'Restaurant';
                $result = DB::table('Restaurant as r')
                    ->join('Location', 'Location.slugid', '=', 'r.slugid')
                    ->join('RestaurantCuisineAssociation as ra', 'ra.RestaurantId', '=', 'r.RestaurantId')
                    ->join('RestaurantCuisine as rc', 'ra.RestaurantCuisineId', '=', 'rc.RestaurantCuisineId')
                    ->where('Location.LocationId', $locId)
                    ->where(function ($query) use ($searchText) {
                        $query->where('rc.Name', 'LIKE', '%' . $searchText . '%');
                    })
                    ->select('r.RestaurantId as id', 'r.Title as displayname')
                    ->limit(5)
                    ->get();
            }



            $response = [];

            if (!$result->isEmpty()) {
                foreach ($result as $loc) {
                    $response[] = [
                        'id' => $loc->id,
                        'value' => $loc->displayname,
                        'type' => $type
                    ];
                }
            } elseif ($searchText == "must see") {

                $response[] = [
                    'id' => '1',
                    'value' => "Must See",
                    'type' => "Category"
                ];
            } else {
                $response[] = ['value' => "Result not found"];
            }

            return response()->json($response);
        }

        // Optionally, return an empty response if no 'val' is provided
       // return response()->json([]);
    }

    public function sightlistinghistory(Request $request)
    {
        $recentSearches = session()->get('recent_sightlist_searches', []);



            $recentSearches = array_unique($recentSearches, SORT_REGULAR);
            $recentSearches = array_slice($recentSearches, 0, 4);
            session(['recent_sightlist_searches' => $recentSearches]);
            $response = [];

        if (Session::has('recent_sightlist_searches')) {
            $recentSearches = session('recent_sightlist_searches');
            foreach ($recentSearches as $value) {
                $response[] = [
                    'id' => $value['locationId'],
                    'value' => $value['val'],
                    'type' => $value['type'],
                ];
            }
        }else{

                $response[] = [
                    'id' => '',
                    'value' => 'Restaurant',
                    'type' => '',
                    'id' => '',
                    'value' => 'Experience',
                    'type' => '',
                ];

        }

        return response()->json($response);
    }


    //end sight listing search

        public function filterReviews(Request $request)
    {
        $filter = $request->input('filter');
        $sightId = $request->input('sightId');
        $rcmd =null;

        if($filter =="recommended"){
            $rcmd = 1;
        }elseif($filter =="not_recommended"){
            $rcmd = 0;
        }
        $reviews = DB::table('SightReviews')
            ->where('IsRecommend',$rcmd)->where('SightId',$sightId)
            ->get();
        //    return  print_r($reviews);

        return view('explore_results.filtered_reviews',['sightreviews'=>$reviews]);
    }
}
