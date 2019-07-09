<?php

namespace MESL;

// use Codesleeve\Stapler\ORM\EloquentTrait;
// use Codesleeve\Stapler\ORM\StaplerableInterface;
use Illuminate\Database\Eloquent\Model;
use MESL\ApproverRole;

class Staff extends Model
{

    // implements StaplerableInterface
    // use EloquentTrait;

    protected $table   = 'tblStaff';
    protected $guarded = ['StaffRef', 'YearsOfService', 'RefName', 'RefRelationship', 'RefOccupation', 'RefPhone', 'RefEmail', 'RefAddress', 'Qualification', 'ProfDateObtained',
        'Institution', 'QualificationObtained', 'DateObtained'];
    public $timestamps = false;
    public $primaryKey = 'StaffRef';

    public $with = ['user'];

    public function user()
    {
        return $this->belongsTo('MESL\User', 'UserID');
    }
    public function company()
    {
        return $this->belongsTo('MESL\Company', 'CompanyID');
    }
    public function country()
    {
        return $this->belongsTo('MESL\Country', 'CountryID');
    }
    public function state()
    {
        return $this->belongsTo('MESL\State', 'StateID');
    }

    public function state_of_origin()
    {
        return $this->belongsTo('MESL\State', 'StateofOrigin');
    }

    public function country_of_origin()
    {
        return $this->belongsTo('MESL\Country', 'CountryOfOrigin');
    }

    public function country_of_birth()
    {
        return $this->belongsTo('MESL\Country', 'CountryOfBirth');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'GenderID');
    }

    public function marital_status()
    {
        return $this->belongsTo(MaritalStatus::class, 'MaritalStatusID');
    }

    public function location()
    {
        return $this->belongsTo('MESL\Location', 'LocationID');
    }
    public function tasks()
    {
        return $this->hasMany('MESL\ProjectTask', 'StaffID', 'StaffRef');
    }
    // singular
    public function department()
    {
        return $this->belongsTo(Department::class, 'DepartmentID');
        // return Department::whereIn('DepartmentRef', explode(',', $this->DepartmentID))->get();
    }

    // plural
    public function departments()
    {
        return $this->hasMany(Department::class, 'DepartmentRef', 'DepartmentID');
        // return Department::whereIn('DepartmentRef', explode(',', $this->DepartmentID))->get();
    }

    public function religion()
    {
        return $this->belongsTo('MESL\Religion', 'ReligionID');
    }

    public function company_department()
    {
        return $this->belongsTo(CompanyDepartment::class, 'DepartmentID', 'id');
    }
    public function supervisor()
    {
        return $this->belongsTo(Staff::class, 'SupervisorID', 'StaffRef');
    }
    public function getProjectsAttribute()
    {
        $staff_id = $this->StaffRef;
        $projects = Project::whereHas('tasks', function ($query) use ($staff_id) {
            $query->where('StaffID', $staff_id);
        })->orWhere('SupervisorID', $staff_id)->get();
        return $projects;
    }
    public function getProjectsExtendedAttribute()
    {
        // Same as getProjectsAttribute(), but Including projects I've CREATED (Even if I'm not involved).
        $staff_id = $this->StaffRef;
        $projects = Project::whereHas('tasks', function ($query) use ($staff_id) {
            $query->where('StaffID', $staff_id);
        })->orWhere('SupervisorID', $staff_id)->orWhere('CreatedBy', $this->UserID)->get();
        return $projects;
    }

    public function getFullNameAttribute()
    {
        return $this->user->FullName ?? '';
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

    public function payroll_details()
    {
        return $this->hasMany(PayrollMonthly::class, 'StaffID');
    }

    public function bank()
    {
        return $this->hasOne(Bank::class, 'BankRef', 'BankID');
    }

    public function scorecards()
    {
        return $this->hasMany('MESL\ScoreCard', 'StaffID');
    }

    public function nysc_location()
    {
        return $this->belongsTo('MESL\State', 'NYSCLocationID');
    }

    public function subordinates()
    {
        return $this->hasMany('MESL\Staff', 'SupervisorID');
    }

    public function references()
    {
        return $this->hasMany(Reference::class, 'ReferenceID');
    }

    public function nationality()
    {
        return $this->belongsTo(Country::class, 'Nationality');
    }

    public function approver_role()
    {
        $readable_array = [];

        if (!is_null($this->user->ApproverRoleIDs)) {
            $approver_role_array = explode(',', $this->user->ApproverRoleIDs);
            foreach ($approver_role_array as $key => $value) {
                $role = ApproverRole::find($value)->ApproverRole;
                array_push($readable_array, $role);
            }
        }
        return implode($readable_array, ',');
    }

    // public function __construct(array $attributes = array())
    // {
    //     $this->hasAttachedFile('PhotographLocation', [
    //         'styles' => [
    //             'medium' => '300x400',
    //             'thumb'  => '200x300',
    //         ],
    //     ]);
    //
    //     parent::__construct($attributes);
    // }
    public function staffAppraisals()
    {
        return $this->hasMany('MESL\StaffAppraisal', 'staff_id');
    }

    public function position()
    {
        return $this->belongsTo('MESL\Position', 'PositionID');
    }

}
