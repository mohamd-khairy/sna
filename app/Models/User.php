<?php

namespace App\Models;

use App\Notifications\VerifyUserNotification;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \DateTimeInterface;

class User extends Authenticatable implements HasMedia
{
    use SoftDeletes, Notifiable, HasApiTokens, InteractsWithMedia, HasFactory;

    public $table = 'users';

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $appends = [
        'personal_photo',
        'id_photo',
        'degree_photo',
        'certificates',
        'cv',
    ];

    protected $dates = [
        'email_verified_at',
        'verified_at',
        'birth_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const PROGRAM_RADIO = [
        'Bio-Health Informatics'        => 'Bio-Health Informatics',
        'Egyptology by Dr. Zahi Hawass' => 'Egyptology by Dr. Zahi Hawass',
    ];

    const KNOW_US_RADIO = [
        'Social Media'     => 'Social Media',
        'Through a friend' => 'Through a friend',
        'Google search'    => 'Google search',
        'Other'            => 'Other',
    ];
    const KNOW_US_RADIO_AR = [
        'Social Media'     => 'وسائل التواصل الاجتماعي',
        'Through a friend' => 'عبر صديق',
        'Google search'    => 'بحث جوجل',
        'Other'            => 'طريقة أخري',
    ];

    const DEGREE_SELECT = [
        'BSC.'                 => 'BSC.',
        'BA.'                  => 'BA.',
        'Diploma'              => 'Diploma',
        'PHD.'                 => 'PHD.',
        'High School Graduate' => 'High School Graduate',
        'Other'                => 'Other',
    ];
    const DEGREE_SELECT_AR = [
        'BSC.'                 => 'BSC.',
        'BA.'                  => 'BA.',
        'Diploma'              => 'Diploma',
        'PHD.'                 => 'PHD.',
        'High School Graduate' => 'High School Graduate',
        'Other'                => 'Other',
    ];

    protected $fillable = [
        'name',
        'name_title',
        'email',
        'email_verified_at',
        'password',
        'approved',
        'verified',
        'verified_at',
        'verification_token',
        'remember_token',
        'program_id',
        'last_name',
        'full_name_en',
        'full_name_ar',
        'national',
        'birth_date',
        'phone',
        'birth_country',
        'country',
        'state',
        'linkedin',
        'undergraduate',
        'degree',
        'personal_statement',
        'know_us',
        'status',
        'reason',
        'installment',
        'installment_amount',
        'auto_country',
        'nationality',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const UNDERGRADUATE_SELECT = [
        'Anthropology'                                => 'Anthropology',
        'Histroy'                                     => 'Histroy',
        'Linguistics and languages'                   => 'Linguistics and languages',
        'Philosophy'                                  => 'Philosophy',
        'Religion'                                    => 'Religion',
        'The arts'                                    => 'The arts',
        'Economics'                                   => 'Economics',
        'Political science'                           => 'Political science',
        'Psychology'                                  => 'Psychology',
        'Sociology'                                   => 'Sociology',
        'Biology'                                     => 'Biology',
        'Chemistry'                                   => 'Chemistry',
        'Earth science'                               => 'Earth science',
        'Physics'                                     => 'Physics',
        'Astronomy'                                   => 'Astronomy',
        'Computer sciences'                           => 'Computer sciences',
        'Mathematics & Statistics'                    => 'Mathematics & Statistics',
        'Agriculture'                                 => 'Agriculture',
        'Architecture and design'                     => 'Architecture and design',
        'Business'                                    => 'Business',
        'Engineering and technology'                  => 'Engineering and technology',
        'Journalism, media studies and communication' => 'Journalism, media studies and communication',
        'Law'                                         => 'Law',
        'Library and museum studies'                  => 'Library and museum studies',
        'Medicine'                                    => 'Medicine',
        'Public administration'                       => 'Public administration',
        'Social work'                                 => 'Social work',
        'Other'                                       => 'Other',
    ];
    const UNDERGRADUATE_SELECT_AR = [
        'Anthropology'                                => 'علم الانسان',
        'Histroy'                                     => 'التاريخ',
        'Linguistics and languages'                   => 'اللغويات واللغات',
        'Philosophy'                                  => 'علم الفلسفة',
        'Religion'                                    => 'الدين',
        'The arts'                                    => 'الفنون',
        'Economics'                                   => 'الاقتصاد',
        'Political science'                           => 'العلوم السياسية',
        'Psychology'                                  => 'علم النفس',
        'Sociology'                                   => 'علم الاجتماع',
        'Biology'                                     => 'علم الاحياء',
        'Chemistry'                                   => 'علم الكيمياء',
        'Earth science'                               => 'علوم الأرض',
        'Physics'                                     => 'الفيزياء',
        'Astronomy'                                   => 'الفلك',
        'Computer sciences'                           => 'علوم الحاسوب',
        'Mathematics & Statistics'                    => 'الرياضيات والإحصاء',
        'Agriculture'                                 => 'الزراعة',
        'Architecture and design'                     => 'الهندسة المعمارية والتصميم',
        'Business'                                    => 'التجارة',
        'Engineering and technology'                  => 'الهندسة و التكنولوجيا',
        'Journalism, media studies and communication' => 'الصحافة والدراسات الإعلامية والاتصال',
        'Law'                                         => 'القانون',
        'Library and museum studies'                  => 'دراسات المكتبات والمتاحف',
        'Medicine'                                    => 'الطب',
        'Public administration'                       => 'الإدارة العامة',
        'Social work'                                 => 'الخدمة الاجتماعية',
        'Other'                                       => 'مجال آخر',
    ];
    const all_countries =

array(
"AF" => "Afghanistan",
"AL" => "Albania",
"DZ" => "Algeria",
"AS" => "American Samoa",
"AD" => "Andorra",
"AO" => "Angola",
"AI" => "Anguilla",
"AQ" => "Antarctica",
"AG" => "Antigua and Barbuda",
"AR" => "Argentina",
"AM" => "Armenia",
"AW" => "Aruba",
"AU" => "Australia",
"AT" => "Austria",
"AZ" => "Azerbaijan",
"BS" => "Bahamas",
"BH" => "Bahrain",
"BD" => "Bangladesh",
"BB" => "Barbados",
"BY" => "Belarus",
"BE" => "Belgium",
"BZ" => "Belize",
"BJ" => "Benin",
"BM" => "Bermuda",
"BT" => "Bhutan",
"BO" => "Bolivia",
"BA" => "Bosnia and Herzegovina",
"BW" => "Botswana",
"BV" => "Bouvet Island",
"BR" => "Brazil",
"IO" => "British Indian Ocean Territory",
"BN" => "Brunei Darussalam",
"BG" => "Bulgaria",
"BF" => "Burkina Faso",
"BI" => "Burundi",
"KH" => "Cambodia",
"CM" => "Cameroon",
"CA" => "Canada",
"CV" => "Cape Verde",
"KY" => "Cayman Islands",
"CF" => "Central African Republic",
"TD" => "Chad",
"CL" => "Chile",
"CN" => "China",
"CX" => "Christmas Island",
"CC" => "Cocos (Keeling) Islands",
"CO" => "Colombia",
"KM" => "Comoros",
"CG" => "Congo",
"CD" => "Congo, the Democratic Republic of the",
"CK" => "Cook Islands",
"CR" => "Costa Rica",
"CI" => "Cote D'Ivoire",
"HR" => "Croatia",
"CU" => "Cuba",
"CY" => "Cyprus",
"CZ" => "Czech Republic",
"DK" => "Denmark",
"DJ" => "Djibouti",
"DM" => "Dominica",
"DO" => "Dominican Republic",
"EC" => "Ecuador",
"EG" => "Egypt",
"SV" => "El Salvador",
"GQ" => "Equatorial Guinea",
"ER" => "Eritrea",
"EE" => "Estonia",
"ET" => "Ethiopia",
"FK" => "Falkland Islands (Malvinas)",
"FO" => "Faroe Islands",
"FJ" => "Fiji",
"FI" => "Finland",
"FR" => "France",
"GF" => "French Guiana",
"PF" => "French Polynesia",
"TF" => "French Southern Territories",
"GA" => "Gabon",
"GM" => "Gambia",
"GE" => "Georgia",
"DE" => "Germany",
"GH" => "Ghana",
"GI" => "Gibraltar",
"GR" => "Greece",
"GL" => "Greenland",
"GD" => "Grenada",
"GP" => "Guadeloupe",
"GU" => "Guam",
"GT" => "Guatemala",
"GN" => "Guinea",
"GW" => "Guinea-Bissau",
"GY" => "Guyana",
"HT" => "Haiti",
"HM" => "Heard Island and Mcdonald Islands",
"VA" => "Holy See (Vatican City State)",
"HN" => "Honduras",
"HK" => "Hong Kong",
"HU" => "Hungary",
"IS" => "Iceland",
"IN" => "India",
"ID" => "Indonesia",
"IR" => "Iran, Islamic Republic of",
"IQ" => "Iraq",
"IE" => "Ireland",
'IL'=>'ISRAEL',
"IT" => "Italy",
"JM" => "Jamaica",
"JP" => "Japan",
"JO" => "Jordan",
"KZ" => "Kazakhstan",
"KE" => "Kenya",
"KI" => "Kiribati",
"KP" => "Korea, Democratic People's Republic of",
"KR" => "Korea, Republic of",
"KW" => "Kuwait",
"KG" => "Kyrgyzstan",
"LA" => "Lao People's Democratic Republic",
"LV" => "Latvia",
"LB" => "Lebanon",
"LS" => "Lesotho",
"LR" => "Liberia",
"LY" => "Libyan Arab Jamahiriya",
"LI" => "Liechtenstein",
"LT" => "Lithuania",
"LU" => "Luxembourg",
"MO" => "Macao",
"MK" => "Macedonia, the Former Yugoslav Republic of",
"MG" => "Madagascar",
"MW" => "Malawi",
"MY" => "Malaysia",
"MV" => "Maldives",
"ML" => "Mali",
"MT" => "Malta",
"MH" => "Marshall Islands",
"MQ" => "Martinique",
"MR" => "Mauritania",
"MU" => "Mauritius",
"YT" => "Mayotte",
"MX" => "Mexico",
"FM" => "Micronesia, Federated States of",
"MD" => "Moldova, Republic of",
"MC" => "Monaco",
"MN" => "Mongolia",
"MS" => "Montserrat",
"MA" => "Morocco",
"MZ" => "Mozambique",
"MM" => "Myanmar",
"NA" => "Namibia",
"NR" => "Nauru",
"NP" => "Nepal",
"NL" => "Netherlands",
"AN" => "Netherlands Antilles",
"NC" => "New Caledonia",
"NZ" => "New Zealand",
"NI" => "Nicaragua",
"NE" => "Niger",
"NG" => "Nigeria",
"NU" => "Niue",
"NF" => "Norfolk Island",
"MP" => "Northern Mariana Islands",
"NO" => "Norway",
"OM" => "Oman",
"PK" => "Pakistan",
"PW" => "Palau",
"PS" => "Palestinian Territory, Occupied",
"PA" => "Panama",
"PG" => "Papua New Guinea",
"PY" => "Paraguay",
"PE" => "Peru",
"PH" => "Philippines",
"PN" => "Pitcairn",
"PL" => "Poland",
"PT" => "Portugal",
"PR" => "Puerto Rico",
"QA" => "Qatar",
"RE" => "Reunion",
"RO" => "Romania",
"RU" => "Russian Federation",
"RW" => "Rwanda",
"SH" => "Saint Helena",
"KN" => "Saint Kitts and Nevis",
"LC" => "Saint Lucia",
"PM" => "Saint Pierre and Miquelon",
"VC" => "Saint Vincent and the Grenadines",
"WS" => "Samoa",
"SM" => "San Marino",
"ST" => "Sao Tome and Principe",
"SA" => "Saudi Arabia",
"SN" => "Senegal",
"CS" => "Serbia and Montenegro",
"SC" => "Seychelles",
"SL" => "Sierra Leone",
"SG" => "Singapore",
"SK" => "Slovakia",
"SI" => "Slovenia",
"SB" => "Solomon Islands",
"SO" => "Somalia",
"ZA" => "South Africa",
"GS" => "South Georgia and the South Sandwich Islands",
"ES" => "Spain",
"LK" => "Sri Lanka",
"SD" => "Sudan",
"SR" => "Suriname",
"SJ" => "Svalbard and Jan Mayen",
"SZ" => "Swaziland",
"SE" => "Sweden",
"CH" => "Switzerland",
"SY" => "Syrian Arab Republic",
"TW" => "Taiwan, Province of China",
"TJ" => "Tajikistan",
"TZ" => "Tanzania, United Republic of",
"TH" => "Thailand",
"TL" => "Timor-Leste",
"TG" => "Togo",
"TK" => "Tokelau",
"TO" => "Tonga",
"TT" => "Trinidad and Tobago",
"TN" => "Tunisia",
"TR" => "Turkey",
"TM" => "Turkmenistan",
"TC" => "Turks and Caicos Islands",
"TV" => "Tuvalu",
"UG" => "Uganda",
"UA" => "Ukraine",
"AE" => "United Arab Emirates",
"GB" => "United Kingdom",
"US" => "United States",
"UM" => "United States Minor Outlying Islands",
"UY" => "Uruguay",
"UZ" => "Uzbekistan",
"VU" => "Vanuatu",
"VE" => "Venezuela",
"VN" => "Viet Nam",
"VG" => "Virgin Islands, British",
"VI" => "Virgin Islands, U.s.",
"WF" => "Wallis and Futuna",
"EH" => "Western Sahara",
"YE" => "Yemen",
"ZM" => "Zambia",
"ZW" => "Zimbabwe"
);

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (User $user) {
            if (auth()->check()) {
                $user->verified    = 1;
                $user->verified_at = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
                $user->save();
            } elseif (!$user->verification_token) {
                $token     = Str::random(64);
                $usedToken = User::where('verification_token', $token)->first();

                while ($usedToken) {
                    $token     = Str::random(64);
                    $usedToken = User::where('verification_token', $token)->first();
                }

                $user->verification_token = $token;
                $user->save();

                $registrationRole = config('panel.registration_default_role');

                if (!$user->roles()->get()->contains($registrationRole)) {
                    $user->roles()->attach($registrationRole);
                }

                $user->notify(new VerifyUserNotification($user));
            }
        });
    }

    public static function boot()
    {
        parent::boot();
        User::observe(new \App\Observers\UserActionObserver);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function userPayments()
    {
        return $this->hasMany(Payment::class, 'user_id', 'id');
    }
    public function program()
    {
        return $this->belongsTo(Programme::class, 'program_id');
    }
    public function userUserAlerts()
    {
        return $this->belongsToMany(UserAlert::class);
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function getVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setVerifiedAtAttribute($value)
    {
        $this->attributes['verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getPersonalPhotoAttribute()
    {
        $file = $this->getMedia('personal_photo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getIdPhotoAttribute()
    {
        $file = $this->getMedia('id_photo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getBirthDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDegreePhotoAttribute()
    {
        $file = $this->getMedia('degree_photo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getCertificatesAttribute()
    {
        $files = $this->getMedia('certificates');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function getCvAttribute()
    {
        return $this->getMedia('cv')->last();
    }

}
