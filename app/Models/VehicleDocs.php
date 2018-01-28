<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use OwenIt\Auditing\Auditable;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class VehicleDocs extends Model implements AuditableContract
{
    use Auditable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = ['doctypes', 'expirydate', 'notifytype', 'counter', 'frequency', 'docpath', 'vehicleid', 'ownerid', 'status'];

    /**
     * Attributes to include in the Audit.
     *
     * @var array
     */
    protected $auditInclude = ['doctypes', 'expirydate', 'notifytype', 'counter', 'frequency', 'docpath', 'vehicleid', 'ownerid', 'status'];

    /**
     * {@inheritdoc}
    */
    public static function getAudits($audit_startdate, $audit_enddate) {
        try {
            $auditedData = [];
            VehicleDocs::whereBetween('created_at', [new Carbon($audit_startdate), new Carbon($audit_enddate)])
            ->whereBetween('updated_at', [new Carbon($audit_startdate), new Carbon($audit_enddate)])
            ->chunk(100, function($vehicledocs) use (&$auditedData)
            {
                foreach($vehicledocs as $vehicledoc) {
                    $auditedData[] = $vehicledoc->audits;
                }
            });
            return $auditedData;
        } catch (Exception $e) {
            log::error('Caught Vehicle Documnents Audit exception: ' . $e .  "\n");
            return [];
        }
    }
}
