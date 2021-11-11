<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class JobApplication extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public const GENDER_RADIO = [
        'Female' => 'Female',
        'Male'   => 'Male',
    ];

    public const DISABILITY_RADIO = [
        'Yes'               => 'Yes',
        'No'                => 'No',
        'Prefer not to say' => 'Prefer not to say',
    ];

    public const TITLE_SELECT = [
        'Ms'   => 'Ms',
        'MR'   => 'MR',
        'Mrs'  => 'Mrs',
        'Dr'   => 'Dr',
        'Prof' => 'Prof',
    ];

    public const RELIGION_RADIO = [
        'Muslim'    => 'Muslim',
        'Christian' => 'Christian',
        'Jewish'    => 'Jewish',
        'Other'     => 'Other',
    ];

    public const AGE_GROUPS_RADIO = [
        '18-25' => '18-25',
        '26-35' => '26-35',
        '36-45' => '36-45',
        '46-55' => '46-55',
        '56-65' => '56-65',
    ];

    public const KNOW_US_RADIO = [
        'IDU website'   => 'IDU website',
        'Social media'  => 'Social media',
        'Word of mouth' => 'Word of mouth',
        'Other'         => 'Other',
    ];

    public const HIGHEST_DEGREE_RADIO = [
        'BSc'                  => 'BSc',
        'BA'                   => 'BA',
        'MSc'                  => 'MSc',
        'PhD'                  => 'PhD',
        'Postgraduate Studies' => 'Postgraduate Studies',
        'Other'                => 'Other',
    ];

    public $table = 'job_applications';

    protected $appends = [
        'cv',
    ];

    protected $dates = [
        'birth_date',
        'start_date',
        'end_date',
        'history_start_date',
        'history_end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'job_id',
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'birth_date',
        'street_address',
        'city',
        'post_code',
        'email_address',
        'phone_number_1',
        'phone_number_2',
        'linked_in_profile',
        'highest_degree',
        'field_of_study',
        'institute',
        'country',
        'start_date',
        'end_date',
        'high_school_name',
        'certificate_type',
        'grade',
        'comments',
        'history_title',
        'history_type_of_institute',
        'history_city',
        'history_country',
        'history_start_date',
        'history_end_date',
        'history_reason_of_leaving',
        'current_notice_period',
        'best_candidate',
        'nationality',
        'race',
        'age_groups',
        'gender',
        'religion',
        'disability',
        'disability_yes',
        'know_us',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function getBirthDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getHistoryStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setHistoryStartDateAttribute($value)
    {
        $this->attributes['history_start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getHistoryEndDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setHistoryEndDateAttribute($value)
    {
        $this->attributes['history_end_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getCvAttribute()
    {
        return $this->getMedia('cv')->last();
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
