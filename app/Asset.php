<?php

namespace MESL;

use Illuminate\Database\Eloquent\Model;
use QRCode;

class Asset extends Model
{
  protected $table   = 'tblAssets';
  protected $guarded = ['AssetRef'];
  public $primaryKey = 'AssetRef';
  public $dates = ['PurchaseDate'];

  // protected $appends = ['qrcode'];

  public function category()
  {
    return $this->belongsTo('MESL\AssetCategory', 'CategoryID');
  }

  public function location()
  {
    return $this->belongsTo('MESL\Location', 'LocationID');
  }

  public function allotee()
  {
    return $this->belongsTo('MESL\Staff', 'AlloteeID');
  }

  public function getQrcodeAttribute()
  {
    return QRCode::text('Asset name: '.strtoupper($this->Description).' // Purchase Date: '.$this->PurchaseDate->format('jS M, Y'))->svg();
  }

}
