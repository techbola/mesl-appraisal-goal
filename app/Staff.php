<?php

namespace App;

use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model implements StaplerableInterface
{
    use EloquentTrait;
    protected $table   = 'tblStaff';
    protected $guarded = ['StaffRef'];
    public $timestamps = false;
    public $primaryKey   = 'StaffRef';

    public function user()
    {
        return $this->belongsTo('App\User', 'UserID');
    }
    public function company()
    {
        return $this->belongsTo('App\Company', 'CompanyID');
    }

    public function getFullNameAttribute()
    {
      return $this->user->FullName;
    }
    public function getFirstNameAttribute()
    {
      return $this->user->first_name;
    }
    public function getMiddleNameAttribute()
    {
      return $this->user->middle_name;
    }
    public function getLastNameAttribute()
    {
      return $this->user->last_name;
    }

    public function __construct(array $attributes = array())
    {
        $this->hasAttachedFile('PhotographLocation', [
            'styles' => [
                'medium' => '300x400',
                'thumb'  => '200x300',
            ],
        ]);

        parent::__construct($attributes);
    }

}
