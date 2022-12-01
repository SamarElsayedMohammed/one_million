<?php

namespace App\Http\Controllers;

use App\DataTables\PeopleDataTable;
use App\Jobs\CSVJob;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Datatables;

class PeopleController extends Controller
{




  public function index()
  {
    return view('upload-file');
  }


  public function upload()
  {
    // return file(request()->myscv);


    if (request()->has('myscv')) {
      $data =  file(request()->myscv);
      $chunks = array_chunk($data, 200);
      $header = [];
      $batch = Bus::batch([])->dispatch();
      foreach ($chunks as $key => $chunk) {
        $data = array_map('str_getcsv', $chunk);

        if ($key == 0) {
          $header = $data[0];
          unset($data[0]);
        }

        // CSVJob::dispatch($data, $header);
        $batch->add(new CSVJob($data, $header));
      }

      return $batch;
    }
  }

  public function batch()
  {

    $batchId = request('id');
    return   $batch = Bus::findBatch($batchId);
  }


  public function home()
  {
    return view('home');
  }
  public function allPeople()
  {
    return Datatables::of(People::query())
      ->setRowClass(function ($user) {
        return $user->id % 2 == 0 ? 'alert-success2' : 'alert-warning2';
      })
      ->setRowId(function ($user) {
        return $user->id;
      })
      ->setRowAttr([
        'align' => 'center',
      ])
      ->make(true);
  }

  public function allPeopleV2(PeopleDataTable $dataTable)
  {
    return $dataTable->render('index');
  }

  public function peopleSearchView()
  {
    return view('search');
  }

  public function peopleSearch()
  {
    $search = request('search');
    return Datatables::of(People::search($search)->get())
      ->make(true);
 
  }
  // public function upload()
  // {
  //   // return file(request()->myscv);

  //   $path = resource_path('temp');
  //   $files = glob("$path/*.csv");



  //   if (request()->has('myscv')) {
  //     // $data = array_map('str_getcsv', file(request()->myscv));
  //     $data =  file(request()->myscv);
  //     $chunks = array_chunk($data, 1000);
  //     //  return (count($chunks));

  //     foreach ($chunks as $key => $chunk) {

  //       $name = "/tmp{$key}.csv";
  //       // mkdir('temp');
  //       $path = resource_path("temp");
  //       file_put_contents($path . $name, $chunk);
  //     }

  //     // foreach ($data as $item) {
  //     //   $storeData = array_combine($header, $item);
  //     //   People::create($storeData);
  //     // }
  //     return "done";
  //   }
  // }
  // public function store()
  // {
  //   $header =[];
  //   $path = resource_path('temp');
  //   $files = glob("$path/*.csv");
  //    foreach ($files as $key=> $file) {

  //       $data = array_map('str_getcsv', file($file));

  //       if ($key == 0) {
  //         $header = $data[0];
  //         unset($data[0]);
  //       }

  //    foreach ($data as $item) {
  //       $storeData = array_combine($header, $item);
  //       People::create($storeData);
  //     }

  //     unlink($file);
  //     }
  //     return 'stored';
  // }


  // public function upload()
  // {
  //   // return file(request()->myscv);

  //   $path = resource_path('temp');
  //   $files = glob("$path/*.csv");

  //   if (request()->has('myscv')) {
  //     // $data = array_map('str_getcsv', file(request()->myscv));
  //     $data =  file(request()->myscv);
  //     $chunks = array_chunk($data, 500);
  //     //  return (count($chunks));

  //     foreach ($chunks as $key => $chunk) {

  //       $name = "/tmp{$key}.csv";
  //       // mkdir('temp');
  //       $path = resource_path("temp");
  //       file_put_contents($path . $name, $chunk);
  //     }

  //     $header = [];
  //     $files = glob("$path/*.csv");
  //     foreach ($files as $key => $file) {

  //       $data = array_map('str_getcsv', file($file));

  //       if ($key == 0) {
  //         $header = $data[0];
  //         unset($data[0]);
  //       }

  //       CSVJob::dispatch($data, $header);

  //       unlink($file);
  //     }

  //     return "done";
  //   }
  // }

  // public function store()
  // {
  //   $header =[];
  //   $path = resource_path('temp');
  //   $files = glob("$path/*.csv");
  //    foreach ($files as $key=> $file) {

  //       $data = array_map('str_getcsv', file($file));

  //       if ($key == 0) {
  //         $header = $data[0];
  //         unset($data[0]);
  //       }

  //  CSVJob::dispatch($data,$header);

  //     unlink($file);
  //     }
  //     return 'stored';
  // }
}
