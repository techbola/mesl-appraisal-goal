<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Storage;
use Flysystem;
use App\AutopayResponse;
use App\LoanRatingOption;

class HelpersOld extends Model
{

  public static function autopay_get_response($doc_name){

    // CHECK ERROR FOLDER
    $files = Storage::disk('interswitch')->files('ERROR/');
    foreach ($files as $file) {
      if (strpos($file, $doc_name) !== false) {
          // $filename = substr($file, strpos($file, 'Northline'));
          $filename = $file;
      }
      continue;
    }

    if (!empty($filename)) {
      $error_file_contents = Flysystem::connection('interswitch')->read($filename);
      $lines = explode("\r\n", $error_file_contents);
      foreach ($lines as $line) {
        $error_codes = AutopayResponse::pluck('code');

        $code = substr($line, strrpos($line, ",") + 1);
        // dd($code);
        $get_error = AutopayResponse::where('code', $code)->first();
        if(count($get_error) > 0)
        break;
      }
      if(count($get_error) > 0)
      return $get_error;

    }

    // CHECK OUT FOLDER
    $out_files = Storage::disk('interswitch')->files('OUT/');
    foreach ($out_files as $out_file) {
      if (strpos($out_file, $doc_name) !== false) {
          // $filename = substr($file, strpos($file, 'Northline'));
          $out_filename = $out_file;
          // break;
      }
    }

    if (!empty($out_filename)) {
      $out_file_contents = Flysystem::connection('interswitch')->read($out_filename);
      $out_lines = explode("\r\n", $out_file_contents);
      foreach ($out_lines as $out_line) {
        $error_codes = AutopayResponse::pluck('code');

        $out_code = substr($out_line, strrpos($out_line, ",") + 1);
        // dd($code);
        $get_out = AutopayResponse::where('code', $out_code)->first();
        if(count($get_out) > 0)
        break;
      }
      if(count($get_out) > 0)
      return $get_out;
    }

  }

  public static function autopay_update_log($id, $code){
    if (empty($id) || empty($code)) {
      return FALSE;
    } else {
      $log = AutopayLog::where('id', $id)->first();
      $log->ResponseCode = $code;
      $log->save();
      return TRUE;
    }
  }

  public static function num_words($num)
  {
    $array = [
      'One' => '1',
      'Two' => '2',
      'Three' => '3',
      'Four' => '4',
      'Five' => '5',
      'Six' => '6',
      'Seven' => '7',
      'Eight' => '8',
      'Nine' => '9',
    ];
    foreach ($array as $key => $value) {
      if($num == $value)
        $word = $key;
        continue;
    }
    return $word;
  }

  public static function get_option($slug, $num)
  {
    $key = LoanRatingOption::where('Slug', $slug)->first();

    return $key->{Static::num_words($num)};
  }

}
