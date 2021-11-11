<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 18,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 21,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 22,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 23,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 24,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 25,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 26,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 27,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 28,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 29,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 30,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 31,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 32,
                'title' => 'payment_show',
            ],
            [
                'id'    => 33,
                'title' => 'payment_access',
            ],
            [
                'id'    => 34,
                'title' => 'pay_now_access',
            ],
            [
                'id'    => 35,
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => 36,
                'title' => 'BioHealth_Student',
            ],
            [
                'id'    => 37,
                'title' => 'Egyptology_Student',
            ],
            [
                'id'    => 86,
                'title' => 'job_create',
            ],
            [
                'id'    => 87,
                'title' => 'job_edit',
            ],
            [
                'id'    => 88,
                'title' => 'job_show',
            ],
            [
                'id'    => 89,
                'title' => 'job_delete',
            ],
            [
                'id'    => 90,
                'title' => 'job_access',
            ],
            [
                'id'    => 91,
                'title' => 'job_application_create',
            ],
            [
                'id'    => 92,
                'title' => 'job_application_edit',
            ],
            [
                'id'    => 93,
                'title' => 'job_application_show',
            ],
            [
                'id'    => 94,
                'title' => 'job_application_delete',
            ],
            [
                'id'    => 95,
                'title' => 'job_application_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
