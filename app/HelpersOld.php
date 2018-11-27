<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;

use Storage;
use Flysystem;
use MESL\AutopayResponse;
use MESL\LoanRatingOption;

use Mail;

class HelpersOld extends Model
{

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

  public static function send_mail($email, $memo) {
    Mail::send('mails.call_memo', ['email' => $email, 'memo' => $memo], function($message) use($email, $memo) {
      $message->to($email);
      $message->subject('Memo For Meeting With '.$memo->customer->Customer);
    });
  }

}
