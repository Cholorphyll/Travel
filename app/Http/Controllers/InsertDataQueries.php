<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Aws\S3\S3Client;

class InsertDataQueries extends Controller
{
    public function uploadsightimages() {
        $batchSize = 10;
        $delaySeconds = 30;
        set_time_limit(10000);  // 10 minutes
        do {



            $data = DB::table('all_sight_images as s')
                ->leftJoin('Sight_image as i', 's.sightId', '=', 'i.SightId')
                ->select('s.sightId as SightId', DB::raw('MIN(s.Img1) as first_img'), 's.Sight_Name')
                ->whereNull('i.SightId')
                ->whereNotNull('s.sightId')
                ->whereNull('s.upload_img')
                ->groupBy('s.sightId', 's.Sight_Name')
                ->orderBy('s.sightId', 'asc')
                ->limit($batchSize)
                ->get();

            if ($data->isEmpty()) {
                dd('empty data');
                break;
            }

            foreach ($data as $dt) {
                $SightId = $dt->SightId;
                $Img = $dt->first_img;
                $name = $dt->Sight_Name;
                if (!empty($Img)) {
                    $s3 = new S3Client([
                        'region' => 'us-west-2',
                        'credentials' => [
                            'key' => 'AKIAYEDFDCST62PQXQO5',
                            'secret' => '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',
                        ],
                    ]);


                    $firstUrl =$Img;

                    try {
                        $headers = @get_headers($firstUrl, 1);
                        if ($headers == false || !isset($headers[0]) || strpos($headers[0], '200') === false) {
                            $errordata = array(
                                'Sightid'=> $SightId,
                                'upload_img'=> '1',

                            );
                             DB::table('all_sight_images')->where('sightid',$SightId)->update($errordata);
                            continue;
                        }
                        $imageContent = file_get_contents($firstUrl);
                        $filename = 'img1-' . $SightId . '.jpg';
                        $s3->putObject([
                            'Bucket' => 's3-travell',
                            'Key' => 'Sight-images/' . $filename,
                            'Body' => $imageContent,
                            'ContentType' => 'image/jpeg',
                            'ACL' => 'private',
                        ]);



                    } catch (\Exception $e) {
                         "Error uploading image: " . $e->getMessage();
                        $errordata = array(
                            'Sightid'=> $SightId,
                            'upload_img'=> '0',

                        );
                         DB::table('all_sight_images')->where('sightid',$SightId)->update($errordata);
                        continue;
                    }
                }

                $dataimage = array(
                    'Sightid'=> $SightId,
                    'Image'=> $filename,
                    'Title'=>$name,
                    'IsPrimary' =>1,
                );
                    DB::table('Sight_image')->insert($dataimage);
            }
            sleep($delaySeconds);
        } while (true);
    }
    public function uploadsightimages1() {
        $batchSize = 10;
        $delaySeconds = 30;
        $delaySeconds1 =5;
        set_time_limit(10000);  // 10 minutes

        do {

            $data = DB::table('all_sight_images as s')
            ->leftJoin('Sight_image as i', 's.sightId', '=', 'i.SightId')
            ->select('s.sightId as SightId', DB::raw('MIN(s.Img1) as first_img'), 's.Sight_Name')
            ->whereNull('i.SightId')
            ->whereNotNull('s.sightId')
            ->whereNull('s.upload_img')
            ->groupBy('s.sightId', 's.Sight_Name')
            ->orderBy('s.sightId', 'desc')
            ->limit($batchSize)
            ->get();


            if ($data->isEmpty()) {
                dd('empty data');
                break;
            }
            //return print_r($data);
          //  die();
            foreach ($data as $dt) {
                $SightId = $dt->SightId;
                $Img = $dt->first_img;
                $name = $dt->Sight_Name;
                if (!empty($Img)) {
                    $s3 = new S3Client([
                        'region' => 'us-west-2',
                        'credentials' => [
                            'key' => 'AKIAYEDFDCST62PQXQO5',
                            'secret' => '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',
                        ],
                    ]);
                    $firstUrl =$Img;

                    try {
                        $headers = @get_headers($firstUrl, 1);
                        if ($headers == false || !isset($headers[0]) || strpos($headers[0], '200') === false) {
                            $errordata = array(
                                'Sightid'=> $SightId,
                                'upload_img'=> '1',

                            );
                             DB::table('all_sight_images')->where('sightid',$SightId)->update($errordata);
                            continue;
                        }
                        $imageContent = file_get_contents($firstUrl);
                        $filename = 'img1-' . $SightId . '.jpg';
                        $s3->putObject([
                            'Bucket' => 's3-travell',
                            'Key' => 'Sight-images/' . $filename,
                            'Body' => $imageContent,
                            'ContentType' => 'image/jpeg',
                            'ACL' => 'private',
                        ]);
                    } catch (\Exception $e) {
                         "Error uploading image: " . $e->getMessage();
                         $errordata = array(
                            'Sightid'=> $SightId,
                            'upload_img'=> '0',

                        );
                         DB::table('all_sight_images')->where('sightid',$SightId)->update($errordata);
                        continue;
                    }
                }

                $dataimage = array(
                    'Sightid'=> $SightId,
                    'Image'=> $filename,
                    'Title'=>$name,
                    'IsPrimary' =>1,
                );
                    DB::table('Sight_image')->insert($dataimage);
                    sleep($delaySeconds1);
            }
            sleep($delaySeconds);
        } while (true);
    }
}
