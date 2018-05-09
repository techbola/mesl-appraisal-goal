<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
  protected $table   = 'tblAssets';
  protected $guarded = ['AssetRef'];
  public $primaryKey = 'AssetRef';
  public $dates = ['PurchaseDate'];

  public function category()
  {
    return $this->belongsTo('App\AssetCategory', 'CategoryID');
  }

  public function location()
  {
    return $this->belongsTo('App\Location', 'LocationID');
  }

  public function allotee()
  {
    return $this->belongsTo('App\Staff', 'AlloteeID');
  }

}
