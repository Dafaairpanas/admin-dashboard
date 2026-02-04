<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FullBackupSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Table: roles
        DB::table('roles')->truncate();
        DB::table('roles')->insert([
            'id' => '1',
            'name' => 'superadmin',
            'badge_color' => '#ab3090',
            'created_at' => '2026-02-03 06:23:42',
            'updated_at' => '2026-02-04 04:24:05',
            'deleted_at' => null,
        ]);
        DB::table('roles')->insert([
            'id' => '2',
            'name' => 'admin',
            'badge_color' => '#3b609b',
            'created_at' => '2026-02-04 03:15:05',
            'updated_at' => '2026-02-04 04:23:58',
            'deleted_at' => null,
        ]);

        // Table: users
        DB::table('users')->truncate();
        DB::table('users')->insert([
            'id' => '1',
            'name' => 'Admin User',
            'email' => 'admin@approx.com',
            'role' => 'admin',
            'email_verified_at' => '2026-02-02 07:45:58',
            'password' => '$2y$12$8Xsz/pKhtSk3dw.OaHwAjuu5Bknb4WPZ3zKgJbGtbbQT/.TQQAAue',
            'remember_token' => null,
            'created_at' => '2026-02-02 07:45:58',
            'updated_at' => '2026-02-04 03:39:44',
            'deleted_at' => '2026-02-04 03:39:44',
        ]);
        DB::table('users')->insert([
            'id' => '2',
            'name' => 'Manager User',
            'email' => 'manager@approx.com',
            'role' => 'manager',
            'email_verified_at' => '2026-02-02 07:45:58',
            'password' => '$2y$12$xQVAychKO1wPB9bJ1PgEIOEpL8dnrI.g.s.vApMz9xw7V3o0yX9Q6',
            'remember_token' => null,
            'created_at' => '2026-02-02 07:45:58',
            'updated_at' => '2026-02-04 03:39:47',
            'deleted_at' => '2026-02-04 03:39:47',
        ]);
        DB::table('users')->insert([
            'id' => '3',
            'name' => 'Regular User',
            'email' => 'user@approx.com',
            'role' => 'user',
            'email_verified_at' => '2026-02-02 07:45:59',
            'password' => '$2y$12$xTJmlssHrgTfL18SZ4jwUOcnQI1sFAQJeQRv/xjBnA2zzMDqRPoc6',
            'remember_token' => null,
            'created_at' => '2026-02-02 07:45:59',
            'updated_at' => '2026-02-04 03:39:50',
            'deleted_at' => '2026-02-04 03:39:50',
        ]);
        DB::table('users')->insert([
            'id' => '4',
            'name' => 'SuperAdmin',
            'email' => 'admin@broliv.com',
            'role' => 'user',
            'email_verified_at' => '2026-02-04 00:47:44',
            'password' => '$2y$12$st3N1tXdfjHSq/WaPjtEA.WJdNZPG5vD4aGL/uguAfWu21D.tn6SW',
            'remember_token' => 'tnsYcXHMM6',
            'created_at' => '2026-02-04 00:47:45',
            'updated_at' => '2026-02-04 03:39:54',
            'deleted_at' => '2026-02-04 03:39:54',
        ]);
        DB::table('users')->insert([
            'id' => '6',
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'role' => 'user',
            'email_verified_at' => null,
            'password' => '$2y$12$iCbNF5OeXXhcn4k14GxLDOpehJB6Q2K0I3Xv/1U1cFsYsOnCxhN6.',
            'remember_token' => null,
            'created_at' => '2026-02-04 03:15:05',
            'updated_at' => '2026-02-04 03:32:03',
            'deleted_at' => null,
        ]);
        DB::table('users')->insert([
            'id' => '7',
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'user',
            'email_verified_at' => null,
            'password' => '$2y$12$dYOp1Tj4Q46PO0GPNoJ6eeLWmFKvw355g5OC0bnxaIA1XympmzW6K',
            'remember_token' => null,
            'created_at' => '2026-02-04 03:15:05',
            'updated_at' => '2026-02-04 03:15:05',
            'deleted_at' => null,
        ]);
        DB::table('users')->insert([
            'id' => '8',
            'name' => 'adit',
            'email' => 'adit@user.a',
            'role' => 'admin',
            'email_verified_at' => null,
            'password' => '$2y$12$CXyFs3TsuKYCOt8BX21W6OSdkTzItOCnaYtdj8t0Lnyd2ZiAESnMu',
            'remember_token' => null,
            'created_at' => '2026-02-04 03:40:24',
            'updated_at' => null,
            'deleted_at' => null,
        ]);
        DB::table('users')->insert([
            'id' => '9',
            'name' => 'adit',
            'email' => 'adit@super.a',
            'role' => 'superadmin',
            'email_verified_at' => null,
            'password' => '$2y$12$vdJl2bndH1H.pVWmLqe65usT5abixYnQav0OPuN5OHM9De/uc4ubi',
            'remember_token' => null,
            'created_at' => '2026-02-04 03:43:38',
            'updated_at' => null,
            'deleted_at' => null,
        ]);

        // Table: role_user
        DB::table('role_user')->truncate();
        DB::table('role_user')->insert([
            'id' => '1',
            'role_id' => '1',
            'user_id' => '6',
            'created_at' => '2026-02-04 03:15:05',
            'updated_at' => '2026-02-04 03:15:05',
        ]);
        DB::table('role_user')->insert([
            'id' => '2',
            'role_id' => '2',
            'user_id' => '7',
            'created_at' => '2026-02-04 03:15:05',
            'updated_at' => '2026-02-04 03:15:05',
        ]);
        DB::table('role_user')->insert([
            'id' => '3',
            'role_id' => '2',
            'user_id' => '8',
            'created_at' => '2026-02-04 03:40:24',
            'updated_at' => '2026-02-04 03:40:24',
        ]);
        DB::table('role_user')->insert([
            'id' => '4',
            'role_id' => '1',
            'user_id' => '9',
            'created_at' => '2026-02-04 03:43:38',
            'updated_at' => '2026-02-04 03:43:38',
        ]);

        // Table: menus
        DB::table('menus')->truncate();

        // Table: role_menu
        DB::table('role_menu')->truncate();

        // Table: frontend_menus
        DB::table('frontend_menus')->truncate();

        // Table: languages
        DB::table('languages')->truncate();
        DB::table('languages')->insert([
            'id' => '1',
            'code' => 'id',
            'name' => 'Indonesia',
            'is_default' => '0',
            'is_active' => '1',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-04 05:31:54',
            'deleted_at' => null,
            'flag' => 'images/flags/id_1770183114.png',
        ]);
        DB::table('languages')->insert([
            'id' => '2',
            'code' => 'en',
            'name' => 'English',
            'is_default' => '1',
            'is_active' => '1',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-04 05:31:46',
            'deleted_at' => null,
            'flag' => 'images/flags/en_1770183106.png',
        ]);
        DB::table('languages')->insert([
            'id' => '3',
            'code' => 'JP',
            'name' => 'Jepang',
            'is_default' => '0',
            'is_active' => '0',
            'created_at' => '2026-02-03 07:38:03',
            'updated_at' => '2026-02-04 05:33:16',
            'deleted_at' => null,
            'flag' => 'images/flags/JP_1770183157.png',
        ]);
        DB::table('languages')->insert([
            'id' => '4',
            'code' => 'jv',
            'name' => 'Javanese',
            'is_default' => '0',
            'is_active' => '0',
            'created_at' => '2026-02-04 04:30:35',
            'updated_at' => '2026-02-04 05:33:10',
            'deleted_at' => null,
            'flag' => 'images/flags/jv_1770183143.png',
        ]);

        // Table: frontend_menu_translations
        DB::table('frontend_menu_translations')->truncate();

        // Table: global_variables
        DB::table('global_variables')->truncate();

        // Table: master_visitor_categories
        DB::table('master_visitor_categories')->truncate();
        DB::table('master_visitor_categories')->insert([
            'id' => '1',
            'name' => 'Perseorangan',
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
            'has_additional_fields' => '0',
        ]);
        DB::table('master_visitor_categories')->insert([
            'id' => '2',
            'name' => 'Instasi/Perusahaan (B2B)',
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
            'has_additional_fields' => '1',
        ]);

        // Table: master_visitor_category_translations
        DB::table('master_visitor_category_translations')->truncate();
        DB::table('master_visitor_category_translations')->insert([
            'id' => '1',
            'visitor_category_id' => '1',
            'language_code' => 'id',
            'name' => 'Perseorangan',
            'created_at' => null,
            'updated_at' => null,
        ]);
        DB::table('master_visitor_category_translations')->insert([
            'id' => '2',
            'visitor_category_id' => '1',
            'language_code' => 'en',
            'name' => 'Individual',
            'created_at' => null,
            'updated_at' => null,
        ]);
        DB::table('master_visitor_category_translations')->insert([
            'id' => '3',
            'visitor_category_id' => '2',
            'language_code' => 'id',
            'name' => 'Instasi /Perusahaan (B2B)',
            'created_at' => null,
            'updated_at' => null,
        ]);
        DB::table('master_visitor_category_translations')->insert([
            'id' => '4',
            'visitor_category_id' => '2',
            'language_code' => 'en',
            'name' => 'Bussines to Bussines',
            'created_at' => null,
            'updated_at' => null,
        ]);

        // Table: surveys
        DB::table('surveys')->truncate();
        DB::table('surveys')->insert([
            'id' => '1',
            'is_active' => '1',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
            'deleted_at' => null,
        ]);

        // Table: survey_translations
        DB::table('survey_translations')->truncate();

        // Table: type_questions
        DB::table('type_questions')->truncate();
        DB::table('type_questions')->insert([
            'id' => '1',
            'code' => 'text',
            'name' => 'Short Answer (Input)',
            'has_options' => '0',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-04 01:16:47',
            'deleted_at' => null,
        ]);
        DB::table('type_questions')->insert([
            'id' => '2',
            'code' => 'textarea',
            'name' => 'Paragraph (Text Area)',
            'has_options' => '0',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-04 01:16:47',
            'deleted_at' => null,
        ]);
        DB::table('type_questions')->insert([
            'id' => '3',
            'code' => 'radio',
            'name' => 'Radio Button',
            'has_options' => '1',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-04 01:16:47',
            'deleted_at' => null,
        ]);
        DB::table('type_questions')->insert([
            'id' => '4',
            'code' => 'checkbox',
            'name' => 'Checklist (Checkbox)',
            'has_options' => '1',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-04 01:16:47',
            'deleted_at' => null,
        ]);
        DB::table('type_questions')->insert([
            'id' => '5',
            'code' => 'checkbox_card',
            'name' => 'Checkbox Card',
            'has_options' => '1',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-04 01:16:47',
            'deleted_at' => null,
        ]);
        DB::table('type_questions')->insert([
            'id' => '6',
            'code' => 'select',
            'name' => 'Dropdown (Select)',
            'has_options' => '1',
            'created_at' => '2026-02-03 07:43:10',
            'updated_at' => '2026-02-03 07:43:10',
            'deleted_at' => null,
        ]);
        DB::table('type_questions')->insert([
            'id' => '7',
            'code' => 'number',
            'name' => 'Number Input',
            'has_options' => '0',
            'created_at' => '2026-02-04 01:16:47',
            'updated_at' => '2026-02-04 01:16:47',
            'deleted_at' => null,
        ]);
        DB::table('type_questions')->insert([
            'id' => '8',
            'code' => 'dropdown',
            'name' => 'Dropdown (Select)',
            'has_options' => '1',
            'created_at' => '2026-02-04 01:16:47',
            'updated_at' => '2026-02-04 01:16:47',
            'deleted_at' => null,
        ]);

        // Table: questions
        DB::table('questions')->truncate();
        DB::table('questions')->insert([
            'id' => '1',
            'survey_id' => '1',
            'type_question_id' => '1',
            'key' => 'kebutuhan_furniture',
            'urutan' => '1',
            'is_required' => '1',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-04 01:32:40',
            'deleted_at' => '2026-02-04 01:32:40',
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '2',
            'survey_id' => '1',
            'type_question_id' => '2',
            'key' => 'detail_kebutuhan',
            'urutan' => '2',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-04 01:32:44',
            'deleted_at' => '2026-02-04 01:32:44',
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '3',
            'survey_id' => '1',
            'type_question_id' => '3',
            'key' => 'estimasi_budget',
            'urutan' => '3',
            'is_required' => '1',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-04 01:32:54',
            'deleted_at' => '2026-02-04 01:32:54',
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '4',
            'survey_id' => '1',
            'type_question_id' => '3',
            'key' => 'estimasi_waktu',
            'urutan' => '4',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-04 01:32:55',
            'deleted_at' => '2026-02-04 01:32:55',
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '5',
            'survey_id' => '1',
            'type_question_id' => '3',
            'key' => 'estimasi_jumlah',
            'urutan' => '5',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-04 01:32:58',
            'deleted_at' => '2026-02-04 01:32:58',
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '6',
            'survey_id' => '1',
            'type_question_id' => '4',
            'key' => 'preferensi_brand',
            'urutan' => '6',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-04 01:33:01',
            'deleted_at' => '2026-02-04 01:33:01',
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '7',
            'survey_id' => '1',
            'type_question_id' => '1',
            'key' => 'ee',
            'urutan' => '0',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:20:14',
            'updated_at' => '2026-02-04 01:32:38',
            'deleted_at' => '2026-02-04 01:32:38',
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '8',
            'survey_id' => '1',
            'type_question_id' => '5',
            'key' => 'kebutuhan_furniture',
            'urutan' => '1',
            'is_required' => '1',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:32:43',
            'deleted_at' => '2026-02-04 01:32:43',
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '9',
            'survey_id' => '1',
            'type_question_id' => '2',
            'key' => 'detail_kebutuhan',
            'urutan' => '2',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:32:44',
            'deleted_at' => '2026-02-04 01:32:44',
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '10',
            'survey_id' => '1',
            'type_question_id' => '3',
            'key' => 'estimasi_budget',
            'urutan' => '3',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:32:45',
            'deleted_at' => '2026-02-04 01:32:45',
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '11',
            'survey_id' => '1',
            'type_question_id' => '3',
            'key' => 'estimasi_waktu',
            'urutan' => '4',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:32:56',
            'deleted_at' => '2026-02-04 01:32:56',
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '12',
            'survey_id' => '1',
            'type_question_id' => '4',
            'key' => 'estimasi_jumlah',
            'urutan' => '5',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:32:59',
            'deleted_at' => '2026-02-04 01:32:59',
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '13',
            'survey_id' => '1',
            'type_question_id' => '4',
            'key' => 'preferensi_brand',
            'urutan' => '6',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:33:02',
            'deleted_at' => '2026-02-04 01:33:02',
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '14',
            'survey_id' => '1',
            'type_question_id' => '5',
            'key' => 'kebutuhan_furniture',
            'urutan' => '1',
            'is_required' => '1',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:32:52',
            'deleted_at' => '2026-02-04 01:32:52',
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '15',
            'survey_id' => '1',
            'type_question_id' => '2',
            'key' => 'detail_kebutuhan',
            'urutan' => '2',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:32:53',
            'deleted_at' => '2026-02-04 01:32:53',
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '16',
            'survey_id' => '1',
            'type_question_id' => '3',
            'key' => 'estimasi_budget',
            'urutan' => '3',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:32:46',
            'deleted_at' => '2026-02-04 01:32:46',
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '17',
            'survey_id' => '1',
            'type_question_id' => '3',
            'key' => 'estimasi_waktu',
            'urutan' => '4',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:32:57',
            'deleted_at' => '2026-02-04 01:32:57',
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '18',
            'survey_id' => '1',
            'type_question_id' => '4',
            'key' => 'estimasi_jumlah',
            'urutan' => '5',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:32:59',
            'deleted_at' => '2026-02-04 01:32:59',
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '19',
            'survey_id' => '1',
            'type_question_id' => '4',
            'key' => 'preferensi_brand',
            'urutan' => '6',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:33:03',
            'deleted_at' => '2026-02-04 01:33:03',
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '20',
            'survey_id' => '1',
            'type_question_id' => '4',
            'key' => 'wiwok',
            'urutan' => '0',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:35:39',
            'updated_at' => '2026-02-04 01:45:10',
            'deleted_at' => '2026-02-04 01:45:10',
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '21',
            'survey_id' => '1',
            'type_question_id' => '1',
            'key' => 'rumahmudimana',
            'urutan' => '0',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:44:20',
            'updated_at' => '2026-02-04 01:44:20',
            'deleted_at' => null,
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '22',
            'survey_id' => '1',
            'type_question_id' => '2',
            'key' => 'areateks',
            'urutan' => '0',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:48:47',
            'updated_at' => '2026-02-04 01:48:47',
            'deleted_at' => null,
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '23',
            'survey_id' => '1',
            'type_question_id' => '3',
            'key' => '1atau2',
            'urutan' => '0',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:49:23',
            'updated_at' => '2026-02-04 01:49:23',
            'deleted_at' => null,
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '24',
            'survey_id' => '1',
            'type_question_id' => '4',
            'key' => 'kotakcentang',
            'urutan' => '0',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => '1',
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:49:53',
            'updated_at' => '2026-02-04 02:55:53',
            'deleted_at' => null,
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '25',
            'survey_id' => '1',
            'type_question_id' => '6',
            'key' => 'buangbawah',
            'urutan' => '0',
            'is_required' => '0',
            'is_active' => '0',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:50:25',
            'updated_at' => '2026-02-04 02:51:15',
            'deleted_at' => null,
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '26',
            'survey_id' => '1',
            'type_question_id' => '8',
            'key' => 'buangbawah2',
            'urutan' => '0',
            'is_required' => '0',
            'is_active' => '0',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:50:51',
            'updated_at' => '2026-02-04 02:50:36',
            'deleted_at' => null,
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '27',
            'survey_id' => '1',
            'type_question_id' => '7',
            'key' => 'cumaangka',
            'urutan' => '0',
            'is_required' => '0',
            'is_active' => '0',
            'max_selections' => null,
            'grid_columns' => '1',
            'created_at' => '2026-02-04 01:51:08',
            'updated_at' => '2026-02-04 02:50:29',
            'deleted_at' => null,
            'parent_option_id' => null,
        ]);
        DB::table('questions')->insert([
            'id' => '28',
            'survey_id' => '1',
            'type_question_id' => '4',
            'key' => 'a',
            'urutan' => '0',
            'is_required' => '0',
            'is_active' => '1',
            'max_selections' => null,
            'grid_columns' => '3',
            'created_at' => '2026-02-04 03:06:18',
            'updated_at' => '2026-02-04 03:19:43',
            'deleted_at' => null,
            'parent_option_id' => null,
        ]);

        // Table: question_translations
        DB::table('question_translations')->truncate();
        DB::table('question_translations')->insert([
            'id' => '1',
            'question_id' => '1',
            'language_code' => 'id',
            'question_text' => 'Kebutuhan Furniture',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_translations')->insert([
            'id' => '2',
            'question_id' => '1',
            'language_code' => 'en',
            'question_text' => 'Furniture Needs',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_translations')->insert([
            'id' => '3',
            'question_id' => '2',
            'language_code' => 'id',
            'question_text' => 'Detail Kebutuhan Furniture',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_translations')->insert([
            'id' => '4',
            'question_id' => '2',
            'language_code' => 'en',
            'question_text' => 'Furniture Details',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_translations')->insert([
            'id' => '5',
            'question_id' => '3',
            'language_code' => 'id',
            'question_text' => 'Estimasi Budget',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_translations')->insert([
            'id' => '6',
            'question_id' => '3',
            'language_code' => 'en',
            'question_text' => 'Estimated Budget',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_translations')->insert([
            'id' => '7',
            'question_id' => '4',
            'language_code' => 'id',
            'question_text' => 'Estimasi Waktu proyek / Pembelian',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_translations')->insert([
            'id' => '8',
            'question_id' => '4',
            'language_code' => 'en',
            'question_text' => 'Project / Purchase Timeline',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_translations')->insert([
            'id' => '9',
            'question_id' => '5',
            'language_code' => 'id',
            'question_text' => 'Estimasi Jumlah / Item',
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_translations')->insert([
            'id' => '10',
            'question_id' => '5',
            'language_code' => 'en',
            'question_text' => 'Estimated Quantity / Items',
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_translations')->insert([
            'id' => '11',
            'question_id' => '6',
            'language_code' => 'id',
            'question_text' => 'Apa yang paling Anda cari dari sebuah brand furniture? (Pilih maks. 2)',
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_translations')->insert([
            'id' => '12',
            'question_id' => '6',
            'language_code' => 'en',
            'question_text' => 'What do you look for most in a furniture brand? (Choose max. 2)',
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_translations')->insert([
            'id' => '13',
            'question_id' => '1',
            'language_code' => 'JP',
            'question_text' => null,
            'created_at' => '2026-02-03 07:45:00',
            'updated_at' => '2026-02-03 07:45:00',
        ]);
        DB::table('question_translations')->insert([
            'id' => '14',
            'question_id' => '7',
            'language_code' => 'id',
            'question_text' => 'aaa',
            'created_at' => '2026-02-04 01:20:14',
            'updated_at' => '2026-02-04 01:20:14',
        ]);
        DB::table('question_translations')->insert([
            'id' => '15',
            'question_id' => '8',
            'language_code' => 'id',
            'question_text' => 'Kebutuhan Furniture',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_translations')->insert([
            'id' => '16',
            'question_id' => '8',
            'language_code' => 'en',
            'question_text' => 'Furniture Needs',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_translations')->insert([
            'id' => '17',
            'question_id' => '9',
            'language_code' => 'id',
            'question_text' => 'Detail Kebutuhan Furniture',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_translations')->insert([
            'id' => '18',
            'question_id' => '9',
            'language_code' => 'en',
            'question_text' => 'Furniture Details',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_translations')->insert([
            'id' => '19',
            'question_id' => '10',
            'language_code' => 'id',
            'question_text' => 'Estimasi Budget',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_translations')->insert([
            'id' => '20',
            'question_id' => '10',
            'language_code' => 'en',
            'question_text' => 'Estimated Budget',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_translations')->insert([
            'id' => '21',
            'question_id' => '11',
            'language_code' => 'id',
            'question_text' => 'Estimasi Waktu Proyek / Pembelian',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_translations')->insert([
            'id' => '22',
            'question_id' => '11',
            'language_code' => 'en',
            'question_text' => 'Project / Purchase Timeline',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_translations')->insert([
            'id' => '23',
            'question_id' => '12',
            'language_code' => 'id',
            'question_text' => 'Estimasi Jumlah / Item',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_translations')->insert([
            'id' => '24',
            'question_id' => '12',
            'language_code' => 'en',
            'question_text' => 'Estimated Quantity / Items',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_translations')->insert([
            'id' => '25',
            'question_id' => '13',
            'language_code' => 'id',
            'question_text' => 'Apa yang paling Anda cari dari sebuah brand furniture?',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_translations')->insert([
            'id' => '26',
            'question_id' => '13',
            'language_code' => 'en',
            'question_text' => 'What do you look for most in a furniture brand?',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_translations')->insert([
            'id' => '27',
            'question_id' => '14',
            'language_code' => 'id',
            'question_text' => 'Kebutuhan Furniture',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_translations')->insert([
            'id' => '28',
            'question_id' => '14',
            'language_code' => 'en',
            'question_text' => 'Furniture Needs',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_translations')->insert([
            'id' => '29',
            'question_id' => '15',
            'language_code' => 'id',
            'question_text' => 'Detail Kebutuhan Furniture',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_translations')->insert([
            'id' => '30',
            'question_id' => '15',
            'language_code' => 'en',
            'question_text' => 'Furniture Details',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_translations')->insert([
            'id' => '31',
            'question_id' => '16',
            'language_code' => 'id',
            'question_text' => 'Estimasi Budget',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_translations')->insert([
            'id' => '32',
            'question_id' => '16',
            'language_code' => 'en',
            'question_text' => 'Estimated Budget',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_translations')->insert([
            'id' => '33',
            'question_id' => '17',
            'language_code' => 'id',
            'question_text' => 'Estimasi Waktu Proyek / Pembelian',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_translations')->insert([
            'id' => '34',
            'question_id' => '17',
            'language_code' => 'en',
            'question_text' => 'Project / Purchase Timeline',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_translations')->insert([
            'id' => '35',
            'question_id' => '18',
            'language_code' => 'id',
            'question_text' => 'Estimasi Jumlah / Item',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_translations')->insert([
            'id' => '36',
            'question_id' => '18',
            'language_code' => 'en',
            'question_text' => 'Estimated Quantity / Items',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_translations')->insert([
            'id' => '37',
            'question_id' => '19',
            'language_code' => 'id',
            'question_text' => 'Apa yang paling Anda cari dari sebuah brand furniture?',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_translations')->insert([
            'id' => '38',
            'question_id' => '19',
            'language_code' => 'en',
            'question_text' => 'What do you look for most in a furniture brand?',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_translations')->insert([
            'id' => '39',
            'question_id' => '7',
            'language_code' => 'en',
            'question_text' => 'w',
            'created_at' => '2026-02-04 01:32:25',
            'updated_at' => '2026-02-04 01:32:25',
        ]);
        DB::table('question_translations')->insert([
            'id' => '40',
            'question_id' => '7',
            'language_code' => 'JP',
            'question_text' => null,
            'created_at' => '2026-02-04 01:32:25',
            'updated_at' => '2026-02-04 01:32:25',
        ]);
        DB::table('question_translations')->insert([
            'id' => '41',
            'question_id' => '20',
            'language_code' => 'id',
            'question_text' => 'wiwok',
            'created_at' => '2026-02-04 01:35:39',
            'updated_at' => '2026-02-04 01:35:39',
        ]);
        DB::table('question_translations')->insert([
            'id' => '42',
            'question_id' => '21',
            'language_code' => 'id',
            'question_text' => 'rumahmudimana',
            'created_at' => '2026-02-04 01:44:20',
            'updated_at' => '2026-02-04 01:44:20',
        ]);
        DB::table('question_translations')->insert([
            'id' => '43',
            'question_id' => '21',
            'language_code' => 'en',
            'question_text' => 'whereyourhouse',
            'created_at' => '2026-02-04 01:44:20',
            'updated_at' => '2026-02-04 01:44:20',
        ]);
        DB::table('question_translations')->insert([
            'id' => '44',
            'question_id' => '22',
            'language_code' => 'id',
            'question_text' => 'areateks',
            'created_at' => '2026-02-04 01:48:47',
            'updated_at' => '2026-02-04 01:48:47',
        ]);
        DB::table('question_translations')->insert([
            'id' => '45',
            'question_id' => '22',
            'language_code' => 'en',
            'question_text' => 'textarea',
            'created_at' => '2026-02-04 01:48:47',
            'updated_at' => '2026-02-04 01:48:47',
        ]);
        DB::table('question_translations')->insert([
            'id' => '46',
            'question_id' => '23',
            'language_code' => 'id',
            'question_text' => '1atau2',
            'created_at' => '2026-02-04 01:49:23',
            'updated_at' => '2026-02-04 01:49:23',
        ]);
        DB::table('question_translations')->insert([
            'id' => '47',
            'question_id' => '23',
            'language_code' => 'en',
            'question_text' => '1or2',
            'created_at' => '2026-02-04 01:49:23',
            'updated_at' => '2026-02-04 01:49:23',
        ]);
        DB::table('question_translations')->insert([
            'id' => '48',
            'question_id' => '24',
            'language_code' => 'id',
            'question_text' => 'kotakcentang',
            'created_at' => '2026-02-04 01:49:53',
            'updated_at' => '2026-02-04 01:49:53',
        ]);
        DB::table('question_translations')->insert([
            'id' => '49',
            'question_id' => '24',
            'language_code' => 'en',
            'question_text' => 'checkbox',
            'created_at' => '2026-02-04 01:49:53',
            'updated_at' => '2026-02-04 01:49:53',
        ]);
        DB::table('question_translations')->insert([
            'id' => '50',
            'question_id' => '25',
            'language_code' => 'id',
            'question_text' => 'buangbawah',
            'created_at' => '2026-02-04 01:50:25',
            'updated_at' => '2026-02-04 01:50:25',
        ]);
        DB::table('question_translations')->insert([
            'id' => '51',
            'question_id' => '25',
            'language_code' => 'en',
            'question_text' => 'dropdown',
            'created_at' => '2026-02-04 01:50:25',
            'updated_at' => '2026-02-04 01:50:25',
        ]);
        DB::table('question_translations')->insert([
            'id' => '52',
            'question_id' => '26',
            'language_code' => 'id',
            'question_text' => 'buangbawah2',
            'created_at' => '2026-02-04 01:50:51',
            'updated_at' => '2026-02-04 01:50:51',
        ]);
        DB::table('question_translations')->insert([
            'id' => '53',
            'question_id' => '26',
            'language_code' => 'en',
            'question_text' => 'dropdown2',
            'created_at' => '2026-02-04 01:50:51',
            'updated_at' => '2026-02-04 01:50:51',
        ]);
        DB::table('question_translations')->insert([
            'id' => '54',
            'question_id' => '27',
            'language_code' => 'id',
            'question_text' => 'cumaangka',
            'created_at' => '2026-02-04 01:51:08',
            'updated_at' => '2026-02-04 01:51:08',
        ]);
        DB::table('question_translations')->insert([
            'id' => '55',
            'question_id' => '27',
            'language_code' => 'en',
            'question_text' => 'justnumber',
            'created_at' => '2026-02-04 01:51:08',
            'updated_at' => '2026-02-04 01:51:08',
        ]);
        DB::table('question_translations')->insert([
            'id' => '56',
            'question_id' => '27',
            'language_code' => 'JP',
            'question_text' => null,
            'created_at' => '2026-02-04 02:50:29',
            'updated_at' => '2026-02-04 02:50:29',
        ]);
        DB::table('question_translations')->insert([
            'id' => '57',
            'question_id' => '26',
            'language_code' => 'JP',
            'question_text' => null,
            'created_at' => '2026-02-04 02:50:36',
            'updated_at' => '2026-02-04 02:50:36',
        ]);
        DB::table('question_translations')->insert([
            'id' => '58',
            'question_id' => '25',
            'language_code' => 'JP',
            'question_text' => null,
            'created_at' => '2026-02-04 02:51:15',
            'updated_at' => '2026-02-04 02:51:15',
        ]);
        DB::table('question_translations')->insert([
            'id' => '59',
            'question_id' => '24',
            'language_code' => 'JP',
            'question_text' => null,
            'created_at' => '2026-02-04 02:55:53',
            'updated_at' => '2026-02-04 02:55:53',
        ]);
        DB::table('question_translations')->insert([
            'id' => '60',
            'question_id' => '28',
            'language_code' => 'id',
            'question_text' => 'a',
            'created_at' => '2026-02-04 03:06:18',
            'updated_at' => '2026-02-04 03:06:18',
        ]);
        DB::table('question_translations')->insert([
            'id' => '61',
            'question_id' => '28',
            'language_code' => 'en',
            'question_text' => 'a',
            'created_at' => '2026-02-04 03:06:18',
            'updated_at' => '2026-02-04 03:06:18',
        ]);
        DB::table('question_translations')->insert([
            'id' => '62',
            'question_id' => '28',
            'language_code' => 'JP',
            'question_text' => null,
            'created_at' => '2026-02-04 03:19:14',
            'updated_at' => '2026-02-04 03:19:14',
        ]);

        // Table: question_options
        DB::table('question_options')->truncate();
        DB::table('question_options')->insert([
            'id' => '1',
            'question_id' => '1',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_options')->insert([
            'id' => '2',
            'question_id' => '1',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_options')->insert([
            'id' => '3',
            'question_id' => '3',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_options')->insert([
            'id' => '4',
            'question_id' => '3',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_options')->insert([
            'id' => '5',
            'question_id' => '3',
            'urutan' => '3',
            'has_followup' => '0',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_options')->insert([
            'id' => '6',
            'question_id' => '3',
            'urutan' => '4',
            'has_followup' => '0',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_options')->insert([
            'id' => '7',
            'question_id' => '4',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_options')->insert([
            'id' => '8',
            'question_id' => '4',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_options')->insert([
            'id' => '9',
            'question_id' => '4',
            'urutan' => '3',
            'has_followup' => '0',
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_options')->insert([
            'id' => '10',
            'question_id' => '5',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_options')->insert([
            'id' => '11',
            'question_id' => '5',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_options')->insert([
            'id' => '12',
            'question_id' => '5',
            'urutan' => '3',
            'has_followup' => '0',
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_options')->insert([
            'id' => '13',
            'question_id' => '5',
            'urutan' => '4',
            'has_followup' => '0',
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_options')->insert([
            'id' => '14',
            'question_id' => '6',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_options')->insert([
            'id' => '15',
            'question_id' => '6',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_options')->insert([
            'id' => '16',
            'question_id' => '6',
            'urutan' => '3',
            'has_followup' => '0',
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_options')->insert([
            'id' => '17',
            'question_id' => '6',
            'urutan' => '4',
            'has_followup' => '0',
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_options')->insert([
            'id' => '18',
            'question_id' => '8',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_options')->insert([
            'id' => '19',
            'question_id' => '8',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_options')->insert([
            'id' => '20',
            'question_id' => '10',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_options')->insert([
            'id' => '21',
            'question_id' => '10',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_options')->insert([
            'id' => '22',
            'question_id' => '10',
            'urutan' => '3',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_options')->insert([
            'id' => '23',
            'question_id' => '10',
            'urutan' => '4',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_options')->insert([
            'id' => '24',
            'question_id' => '11',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_options')->insert([
            'id' => '25',
            'question_id' => '11',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_options')->insert([
            'id' => '26',
            'question_id' => '11',
            'urutan' => '3',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_options')->insert([
            'id' => '27',
            'question_id' => '12',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_options')->insert([
            'id' => '28',
            'question_id' => '12',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_options')->insert([
            'id' => '29',
            'question_id' => '12',
            'urutan' => '3',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_options')->insert([
            'id' => '30',
            'question_id' => '12',
            'urutan' => '4',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_options')->insert([
            'id' => '31',
            'question_id' => '13',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_options')->insert([
            'id' => '32',
            'question_id' => '13',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_options')->insert([
            'id' => '33',
            'question_id' => '13',
            'urutan' => '3',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_options')->insert([
            'id' => '34',
            'question_id' => '13',
            'urutan' => '4',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_options')->insert([
            'id' => '35',
            'question_id' => '14',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_options')->insert([
            'id' => '36',
            'question_id' => '14',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_options')->insert([
            'id' => '37',
            'question_id' => '16',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_options')->insert([
            'id' => '38',
            'question_id' => '16',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_options')->insert([
            'id' => '39',
            'question_id' => '16',
            'urutan' => '3',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_options')->insert([
            'id' => '40',
            'question_id' => '16',
            'urutan' => '4',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_options')->insert([
            'id' => '41',
            'question_id' => '17',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_options')->insert([
            'id' => '42',
            'question_id' => '17',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_options')->insert([
            'id' => '43',
            'question_id' => '17',
            'urutan' => '3',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_options')->insert([
            'id' => '44',
            'question_id' => '18',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_options')->insert([
            'id' => '45',
            'question_id' => '18',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_options')->insert([
            'id' => '46',
            'question_id' => '18',
            'urutan' => '3',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_options')->insert([
            'id' => '47',
            'question_id' => '18',
            'urutan' => '4',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_options')->insert([
            'id' => '48',
            'question_id' => '19',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_options')->insert([
            'id' => '49',
            'question_id' => '19',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_options')->insert([
            'id' => '50',
            'question_id' => '19',
            'urutan' => '3',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_options')->insert([
            'id' => '51',
            'question_id' => '19',
            'urutan' => '4',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_options')->insert([
            'id' => '52',
            'question_id' => '20',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:35:39',
            'updated_at' => '2026-02-04 01:35:39',
        ]);
        DB::table('question_options')->insert([
            'id' => '53',
            'question_id' => '20',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:35:39',
            'updated_at' => '2026-02-04 01:35:39',
        ]);
        DB::table('question_options')->insert([
            'id' => '54',
            'question_id' => '23',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:49:23',
            'updated_at' => '2026-02-04 01:49:23',
        ]);
        DB::table('question_options')->insert([
            'id' => '55',
            'question_id' => '23',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:49:23',
            'updated_at' => '2026-02-04 01:49:23',
        ]);
        DB::table('question_options')->insert([
            'id' => '56',
            'question_id' => '24',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:49:53',
            'updated_at' => '2026-02-04 01:49:53',
        ]);
        DB::table('question_options')->insert([
            'id' => '57',
            'question_id' => '24',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:49:53',
            'updated_at' => '2026-02-04 01:49:53',
        ]);
        DB::table('question_options')->insert([
            'id' => '58',
            'question_id' => '24',
            'urutan' => '3',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:49:53',
            'updated_at' => '2026-02-04 01:49:53',
        ]);
        DB::table('question_options')->insert([
            'id' => '59',
            'question_id' => '24',
            'urutan' => '4',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:49:53',
            'updated_at' => '2026-02-04 01:49:53',
        ]);
        DB::table('question_options')->insert([
            'id' => '60',
            'question_id' => '25',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:50:25',
            'updated_at' => '2026-02-04 01:50:25',
        ]);
        DB::table('question_options')->insert([
            'id' => '61',
            'question_id' => '25',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:50:25',
            'updated_at' => '2026-02-04 01:50:25',
        ]);
        DB::table('question_options')->insert([
            'id' => '62',
            'question_id' => '25',
            'urutan' => '3',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:50:25',
            'updated_at' => '2026-02-04 01:50:25',
        ]);
        DB::table('question_options')->insert([
            'id' => '63',
            'question_id' => '26',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:50:51',
            'updated_at' => '2026-02-04 01:50:51',
        ]);
        DB::table('question_options')->insert([
            'id' => '64',
            'question_id' => '26',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:50:51',
            'updated_at' => '2026-02-04 01:50:51',
        ]);
        DB::table('question_options')->insert([
            'id' => '65',
            'question_id' => '26',
            'urutan' => '3',
            'has_followup' => '0',
            'created_at' => '2026-02-04 01:50:51',
            'updated_at' => '2026-02-04 01:50:51',
        ]);
        DB::table('question_options')->insert([
            'id' => '66',
            'question_id' => '28',
            'urutan' => '1',
            'has_followup' => '0',
            'created_at' => '2026-02-04 03:06:18',
            'updated_at' => '2026-02-04 03:06:18',
        ]);
        DB::table('question_options')->insert([
            'id' => '67',
            'question_id' => '28',
            'urutan' => '2',
            'has_followup' => '0',
            'created_at' => '2026-02-04 03:06:18',
            'updated_at' => '2026-02-04 03:06:18',
        ]);
        DB::table('question_options')->insert([
            'id' => '68',
            'question_id' => '28',
            'urutan' => '3',
            'has_followup' => '0',
            'created_at' => '2026-02-04 03:19:31',
            'updated_at' => '2026-02-04 03:19:31',
        ]);

        // Table: question_option_translations
        DB::table('question_option_translations')->truncate();
        DB::table('question_option_translations')->insert([
            'id' => '1',
            'question_option_id' => '1',
            'language_code' => 'id',
            'option_text' => 'Indoor Furniture',
            'description' => null,
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '2',
            'question_option_id' => '1',
            'language_code' => 'en',
            'option_text' => 'Indoor Furniture',
            'description' => null,
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '3',
            'question_option_id' => '2',
            'language_code' => 'id',
            'option_text' => 'Outdoor Furniture',
            'description' => null,
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '4',
            'question_option_id' => '2',
            'language_code' => 'en',
            'option_text' => 'Outdoor Furniture',
            'description' => null,
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '5',
            'question_option_id' => '3',
            'language_code' => 'id',
            'option_text' => '< Rp10 juta',
            'description' => null,
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '6',
            'question_option_id' => '3',
            'language_code' => 'en',
            'option_text' => '< IDR 10 million',
            'description' => null,
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '7',
            'question_option_id' => '4',
            'language_code' => 'id',
            'option_text' => 'Rp10 - 50 juta',
            'description' => null,
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '8',
            'question_option_id' => '4',
            'language_code' => 'en',
            'option_text' => 'IDR 10 - 50 million',
            'description' => null,
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '9',
            'question_option_id' => '5',
            'language_code' => 'id',
            'option_text' => 'Rp50 - 200 juta',
            'description' => null,
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '10',
            'question_option_id' => '5',
            'language_code' => 'en',
            'option_text' => 'IDR 50 - 200 million',
            'description' => null,
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '11',
            'question_option_id' => '6',
            'language_code' => 'id',
            'option_text' => '> Rp200 juta',
            'description' => null,
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '12',
            'question_option_id' => '6',
            'language_code' => 'en',
            'option_text' => '> IDR 200 million',
            'description' => null,
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '13',
            'question_option_id' => '7',
            'language_code' => 'id',
            'option_text' => 'Segera (1 - 3 bulan ke depan)',
            'description' => null,
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '14',
            'question_option_id' => '7',
            'language_code' => 'en',
            'option_text' => 'Immediately (1 - 3 months)',
            'description' => null,
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '15',
            'question_option_id' => '8',
            'language_code' => 'id',
            'option_text' => 'Jangka Menengah (3 - 6 bulan ke depan)',
            'description' => null,
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '16',
            'question_option_id' => '8',
            'language_code' => 'en',
            'option_text' => 'Medium Term (3 - 6 months)',
            'description' => null,
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '17',
            'question_option_id' => '9',
            'language_code' => 'id',
            'option_text' => 'Hanya melihat-lihat / Mencari Referensi',
            'description' => null,
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '18',
            'question_option_id' => '9',
            'language_code' => 'en',
            'option_text' => 'Just browsing / Looking for references',
            'description' => null,
            'created_at' => '2026-02-03 06:34:14',
            'updated_at' => '2026-02-03 06:34:14',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '19',
            'question_option_id' => '10',
            'language_code' => 'id',
            'option_text' => '1 Set',
            'description' => null,
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '20',
            'question_option_id' => '10',
            'language_code' => 'en',
            'option_text' => '1 Set',
            'description' => null,
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '21',
            'question_option_id' => '11',
            'language_code' => 'id',
            'option_text' => '< 5 Pcs',
            'description' => null,
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '22',
            'question_option_id' => '11',
            'language_code' => 'en',
            'option_text' => '< 5 Pcs',
            'description' => null,
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '23',
            'question_option_id' => '12',
            'language_code' => 'id',
            'option_text' => '5 - 20 Pcs',
            'description' => null,
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '24',
            'question_option_id' => '12',
            'language_code' => 'en',
            'option_text' => '5 - 20 Pcs',
            'description' => null,
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '25',
            'question_option_id' => '13',
            'language_code' => 'id',
            'option_text' => '> 20 Pcs',
            'description' => null,
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '26',
            'question_option_id' => '13',
            'language_code' => 'en',
            'option_text' => '> 20 Pcs',
            'description' => null,
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '27',
            'question_option_id' => '14',
            'language_code' => 'id',
            'option_text' => 'Desain yang unik & Estetik',
            'description' => null,
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '28',
            'question_option_id' => '14',
            'language_code' => 'en',
            'option_text' => 'Unique & Aesthetic Design',
            'description' => null,
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '29',
            'question_option_id' => '15',
            'language_code' => 'id',
            'option_text' => 'Daya tahan material (Durability)',
            'description' => null,
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '30',
            'question_option_id' => '15',
            'language_code' => 'en',
            'option_text' => 'Material Durability',
            'description' => null,
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '31',
            'question_option_id' => '16',
            'language_code' => 'id',
            'option_text' => 'Harga yang kompetitif',
            'description' => null,
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '32',
            'question_option_id' => '16',
            'language_code' => 'en',
            'option_text' => 'Competitive Pricing',
            'description' => null,
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '33',
            'question_option_id' => '17',
            'language_code' => 'id',
            'option_text' => 'Kemudahan kustomisasi (Custom-made)',
            'description' => null,
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '34',
            'question_option_id' => '17',
            'language_code' => 'en',
            'option_text' => 'Easy Customization (Custom-made)',
            'description' => null,
            'created_at' => '2026-02-03 06:34:15',
            'updated_at' => '2026-02-03 06:34:15',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '35',
            'question_option_id' => '1',
            'language_code' => 'JP',
            'option_text' => null,
            'description' => null,
            'created_at' => '2026-02-03 07:45:00',
            'updated_at' => '2026-02-03 07:45:00',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '36',
            'question_option_id' => '2',
            'language_code' => 'JP',
            'option_text' => null,
            'description' => null,
            'created_at' => '2026-02-03 07:45:00',
            'updated_at' => '2026-02-03 07:45:00',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '37',
            'question_option_id' => '18',
            'language_code' => 'id',
            'option_text' => 'Indoor Furniture',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '38',
            'question_option_id' => '18',
            'language_code' => 'en',
            'option_text' => 'Indoor Furniture',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '39',
            'question_option_id' => '19',
            'language_code' => 'id',
            'option_text' => 'Outdoor Furniture',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '40',
            'question_option_id' => '19',
            'language_code' => 'en',
            'option_text' => 'Outdoor Furniture',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '41',
            'question_option_id' => '20',
            'language_code' => 'id',
            'option_text' => '< Rp10 juta',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '42',
            'question_option_id' => '20',
            'language_code' => 'en',
            'option_text' => '< IDR 10 million',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '43',
            'question_option_id' => '21',
            'language_code' => 'id',
            'option_text' => 'Rp10 - 50 juta',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '44',
            'question_option_id' => '21',
            'language_code' => 'en',
            'option_text' => 'IDR 10 - 50 million',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '45',
            'question_option_id' => '22',
            'language_code' => 'id',
            'option_text' => 'Rp50 - 200 juta',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '46',
            'question_option_id' => '22',
            'language_code' => 'en',
            'option_text' => 'IDR 50 - 200 million',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '47',
            'question_option_id' => '23',
            'language_code' => 'id',
            'option_text' => '> Rp200 juta',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '48',
            'question_option_id' => '23',
            'language_code' => 'en',
            'option_text' => '> IDR 200 million',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '49',
            'question_option_id' => '24',
            'language_code' => 'id',
            'option_text' => 'Segera (1 - 3 bulan ke depan)',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '50',
            'question_option_id' => '24',
            'language_code' => 'en',
            'option_text' => 'Immediately (1 - 3 months)',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '51',
            'question_option_id' => '25',
            'language_code' => 'id',
            'option_text' => 'Jangka Menengah (3 - 6 bulan ke depan)',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '52',
            'question_option_id' => '25',
            'language_code' => 'en',
            'option_text' => 'Medium Term (3 - 6 months)',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '53',
            'question_option_id' => '26',
            'language_code' => 'id',
            'option_text' => 'Hanya melihat-lihat / Mencari Referensi',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '54',
            'question_option_id' => '26',
            'language_code' => 'en',
            'option_text' => 'Just browsing / Looking for references',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '55',
            'question_option_id' => '27',
            'language_code' => 'id',
            'option_text' => '1 Set',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '56',
            'question_option_id' => '27',
            'language_code' => 'en',
            'option_text' => '1 Set',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '57',
            'question_option_id' => '28',
            'language_code' => 'id',
            'option_text' => '< 5 Pcs',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '58',
            'question_option_id' => '28',
            'language_code' => 'en',
            'option_text' => '< 5 Pcs',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '59',
            'question_option_id' => '29',
            'language_code' => 'id',
            'option_text' => '5 - 20 Pcs',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '60',
            'question_option_id' => '29',
            'language_code' => 'en',
            'option_text' => '5 - 20 Pcs',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '61',
            'question_option_id' => '30',
            'language_code' => 'id',
            'option_text' => '> 20 Pcs',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '62',
            'question_option_id' => '30',
            'language_code' => 'en',
            'option_text' => '> 20 Pcs',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '63',
            'question_option_id' => '31',
            'language_code' => 'id',
            'option_text' => 'Desain yang unik & Estetik',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '64',
            'question_option_id' => '31',
            'language_code' => 'en',
            'option_text' => 'Unique & Aesthetic Design',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '65',
            'question_option_id' => '32',
            'language_code' => 'id',
            'option_text' => 'Daya tahan material (Durability)',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '66',
            'question_option_id' => '32',
            'language_code' => 'en',
            'option_text' => 'Material Durability',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '67',
            'question_option_id' => '33',
            'language_code' => 'id',
            'option_text' => 'Harga yang kompetitif',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '68',
            'question_option_id' => '33',
            'language_code' => 'en',
            'option_text' => 'Competitive Pricing',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '69',
            'question_option_id' => '34',
            'language_code' => 'id',
            'option_text' => 'Kemudahan kustomisasi (Custom-made)',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '70',
            'question_option_id' => '34',
            'language_code' => 'en',
            'option_text' => 'Easy Customization (Custom-made)',
            'description' => null,
            'created_at' => '2026-02-04 01:26:01',
            'updated_at' => '2026-02-04 01:26:01',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '71',
            'question_option_id' => '35',
            'language_code' => 'id',
            'option_text' => 'Indoor Furniture',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '72',
            'question_option_id' => '35',
            'language_code' => 'en',
            'option_text' => 'Indoor Furniture',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '73',
            'question_option_id' => '36',
            'language_code' => 'id',
            'option_text' => 'Outdoor Furniture',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '74',
            'question_option_id' => '36',
            'language_code' => 'en',
            'option_text' => 'Outdoor Furniture',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '75',
            'question_option_id' => '37',
            'language_code' => 'id',
            'option_text' => '< Rp10 juta',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '76',
            'question_option_id' => '37',
            'language_code' => 'en',
            'option_text' => '< IDR 10 million',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '77',
            'question_option_id' => '38',
            'language_code' => 'id',
            'option_text' => 'Rp10 - 50 juta',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '78',
            'question_option_id' => '38',
            'language_code' => 'en',
            'option_text' => 'IDR 10 - 50 million',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '79',
            'question_option_id' => '39',
            'language_code' => 'id',
            'option_text' => 'Rp50 - 200 juta',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '80',
            'question_option_id' => '39',
            'language_code' => 'en',
            'option_text' => 'IDR 50 - 200 million',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '81',
            'question_option_id' => '40',
            'language_code' => 'id',
            'option_text' => '> Rp200 juta',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '82',
            'question_option_id' => '40',
            'language_code' => 'en',
            'option_text' => '> IDR 200 million',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '83',
            'question_option_id' => '41',
            'language_code' => 'id',
            'option_text' => 'Segera (1 - 3 bulan ke depan)',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '84',
            'question_option_id' => '41',
            'language_code' => 'en',
            'option_text' => 'Immediately (1 - 3 months)',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '85',
            'question_option_id' => '42',
            'language_code' => 'id',
            'option_text' => 'Jangka Menengah (3 - 6 bulan ke depan)',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '86',
            'question_option_id' => '42',
            'language_code' => 'en',
            'option_text' => 'Medium Term (3 - 6 months)',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '87',
            'question_option_id' => '43',
            'language_code' => 'id',
            'option_text' => 'Hanya melihat-lihat / Mencari Referensi',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '88',
            'question_option_id' => '43',
            'language_code' => 'en',
            'option_text' => 'Just browsing / Looking for references',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '89',
            'question_option_id' => '44',
            'language_code' => 'id',
            'option_text' => '1 Set',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '90',
            'question_option_id' => '44',
            'language_code' => 'en',
            'option_text' => '1 Set',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '91',
            'question_option_id' => '45',
            'language_code' => 'id',
            'option_text' => '< 5 Pcs',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '92',
            'question_option_id' => '45',
            'language_code' => 'en',
            'option_text' => '< 5 Pcs',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '93',
            'question_option_id' => '46',
            'language_code' => 'id',
            'option_text' => '5 - 20 Pcs',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '94',
            'question_option_id' => '46',
            'language_code' => 'en',
            'option_text' => '5 - 20 Pcs',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '95',
            'question_option_id' => '47',
            'language_code' => 'id',
            'option_text' => '> 20 Pcs',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '96',
            'question_option_id' => '47',
            'language_code' => 'en',
            'option_text' => '> 20 Pcs',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '97',
            'question_option_id' => '48',
            'language_code' => 'id',
            'option_text' => 'Desain yang unik & Estetik',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '98',
            'question_option_id' => '48',
            'language_code' => 'en',
            'option_text' => 'Unique & Aesthetic Design',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '99',
            'question_option_id' => '49',
            'language_code' => 'id',
            'option_text' => 'Daya tahan material (Durability)',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '100',
            'question_option_id' => '49',
            'language_code' => 'en',
            'option_text' => 'Material Durability',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '101',
            'question_option_id' => '50',
            'language_code' => 'id',
            'option_text' => 'Harga yang kompetitif',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '102',
            'question_option_id' => '50',
            'language_code' => 'en',
            'option_text' => 'Competitive Pricing',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '103',
            'question_option_id' => '51',
            'language_code' => 'id',
            'option_text' => 'Kemudahan kustomisasi (Custom-made)',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '104',
            'question_option_id' => '51',
            'language_code' => 'en',
            'option_text' => 'Easy Customization (Custom-made)',
            'description' => null,
            'created_at' => '2026-02-04 01:27:13',
            'updated_at' => '2026-02-04 01:27:13',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '105',
            'question_option_id' => '52',
            'language_code' => 'id',
            'option_text' => 'ec',
            'description' => null,
            'created_at' => '2026-02-04 01:35:39',
            'updated_at' => '2026-02-04 01:35:39',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '106',
            'question_option_id' => '53',
            'language_code' => 'id',
            'option_text' => 'yc',
            'description' => null,
            'created_at' => '2026-02-04 01:35:39',
            'updated_at' => '2026-02-04 01:35:39',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '107',
            'question_option_id' => '54',
            'language_code' => 'id',
            'option_text' => '1',
            'description' => null,
            'created_at' => '2026-02-04 01:49:23',
            'updated_at' => '2026-02-04 01:49:23',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '108',
            'question_option_id' => '54',
            'language_code' => 'en',
            'option_text' => '1',
            'description' => null,
            'created_at' => '2026-02-04 01:49:23',
            'updated_at' => '2026-02-04 01:49:23',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '109',
            'question_option_id' => '55',
            'language_code' => 'id',
            'option_text' => '2',
            'description' => null,
            'created_at' => '2026-02-04 01:49:23',
            'updated_at' => '2026-02-04 01:49:23',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '110',
            'question_option_id' => '55',
            'language_code' => 'en',
            'option_text' => '2',
            'description' => null,
            'created_at' => '2026-02-04 01:49:23',
            'updated_at' => '2026-02-04 01:49:23',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '111',
            'question_option_id' => '56',
            'language_code' => 'id',
            'option_text' => '1',
            'description' => null,
            'created_at' => '2026-02-04 01:49:53',
            'updated_at' => '2026-02-04 01:49:53',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '112',
            'question_option_id' => '56',
            'language_code' => 'en',
            'option_text' => '1',
            'description' => null,
            'created_at' => '2026-02-04 01:49:53',
            'updated_at' => '2026-02-04 01:49:53',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '113',
            'question_option_id' => '57',
            'language_code' => 'id',
            'option_text' => '2',
            'description' => null,
            'created_at' => '2026-02-04 01:49:53',
            'updated_at' => '2026-02-04 01:49:53',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '114',
            'question_option_id' => '57',
            'language_code' => 'en',
            'option_text' => '2',
            'description' => null,
            'created_at' => '2026-02-04 01:49:53',
            'updated_at' => '2026-02-04 01:49:53',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '115',
            'question_option_id' => '58',
            'language_code' => 'id',
            'option_text' => '3',
            'description' => null,
            'created_at' => '2026-02-04 01:49:53',
            'updated_at' => '2026-02-04 01:49:53',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '116',
            'question_option_id' => '58',
            'language_code' => 'en',
            'option_text' => '3',
            'description' => null,
            'created_at' => '2026-02-04 01:49:53',
            'updated_at' => '2026-02-04 01:49:53',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '117',
            'question_option_id' => '59',
            'language_code' => 'id',
            'option_text' => '4',
            'description' => null,
            'created_at' => '2026-02-04 01:49:53',
            'updated_at' => '2026-02-04 01:49:53',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '118',
            'question_option_id' => '59',
            'language_code' => 'en',
            'option_text' => '4',
            'description' => null,
            'created_at' => '2026-02-04 01:49:53',
            'updated_at' => '2026-02-04 01:49:53',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '119',
            'question_option_id' => '60',
            'language_code' => 'id',
            'option_text' => '1',
            'description' => null,
            'created_at' => '2026-02-04 01:50:25',
            'updated_at' => '2026-02-04 01:50:25',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '120',
            'question_option_id' => '60',
            'language_code' => 'en',
            'option_text' => '1',
            'description' => null,
            'created_at' => '2026-02-04 01:50:25',
            'updated_at' => '2026-02-04 01:50:25',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '121',
            'question_option_id' => '61',
            'language_code' => 'id',
            'option_text' => '2',
            'description' => null,
            'created_at' => '2026-02-04 01:50:25',
            'updated_at' => '2026-02-04 01:50:25',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '122',
            'question_option_id' => '61',
            'language_code' => 'en',
            'option_text' => '2',
            'description' => null,
            'created_at' => '2026-02-04 01:50:25',
            'updated_at' => '2026-02-04 01:50:25',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '123',
            'question_option_id' => '62',
            'language_code' => 'id',
            'option_text' => '3',
            'description' => null,
            'created_at' => '2026-02-04 01:50:25',
            'updated_at' => '2026-02-04 01:50:25',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '124',
            'question_option_id' => '62',
            'language_code' => 'en',
            'option_text' => '3',
            'description' => null,
            'created_at' => '2026-02-04 01:50:25',
            'updated_at' => '2026-02-04 01:50:25',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '125',
            'question_option_id' => '63',
            'language_code' => 'id',
            'option_text' => '1',
            'description' => null,
            'created_at' => '2026-02-04 01:50:51',
            'updated_at' => '2026-02-04 01:50:51',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '126',
            'question_option_id' => '63',
            'language_code' => 'en',
            'option_text' => '1',
            'description' => null,
            'created_at' => '2026-02-04 01:50:51',
            'updated_at' => '2026-02-04 01:50:51',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '127',
            'question_option_id' => '64',
            'language_code' => 'id',
            'option_text' => '2',
            'description' => null,
            'created_at' => '2026-02-04 01:50:51',
            'updated_at' => '2026-02-04 01:50:51',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '128',
            'question_option_id' => '64',
            'language_code' => 'en',
            'option_text' => '2',
            'description' => null,
            'created_at' => '2026-02-04 01:50:51',
            'updated_at' => '2026-02-04 01:50:51',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '129',
            'question_option_id' => '65',
            'language_code' => 'id',
            'option_text' => '3',
            'description' => null,
            'created_at' => '2026-02-04 01:50:51',
            'updated_at' => '2026-02-04 01:50:51',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '130',
            'question_option_id' => '65',
            'language_code' => 'en',
            'option_text' => '3',
            'description' => null,
            'created_at' => '2026-02-04 01:50:51',
            'updated_at' => '2026-02-04 01:50:51',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '131',
            'question_option_id' => '63',
            'language_code' => 'JP',
            'option_text' => null,
            'description' => null,
            'created_at' => '2026-02-04 02:50:36',
            'updated_at' => '2026-02-04 02:50:36',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '132',
            'question_option_id' => '64',
            'language_code' => 'JP',
            'option_text' => null,
            'description' => null,
            'created_at' => '2026-02-04 02:50:36',
            'updated_at' => '2026-02-04 02:50:36',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '133',
            'question_option_id' => '65',
            'language_code' => 'JP',
            'option_text' => null,
            'description' => null,
            'created_at' => '2026-02-04 02:50:36',
            'updated_at' => '2026-02-04 02:50:36',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '134',
            'question_option_id' => '60',
            'language_code' => 'JP',
            'option_text' => null,
            'description' => null,
            'created_at' => '2026-02-04 02:51:15',
            'updated_at' => '2026-02-04 02:51:15',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '135',
            'question_option_id' => '61',
            'language_code' => 'JP',
            'option_text' => null,
            'description' => null,
            'created_at' => '2026-02-04 02:51:15',
            'updated_at' => '2026-02-04 02:51:15',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '136',
            'question_option_id' => '62',
            'language_code' => 'JP',
            'option_text' => null,
            'description' => null,
            'created_at' => '2026-02-04 02:51:15',
            'updated_at' => '2026-02-04 02:51:15',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '137',
            'question_option_id' => '56',
            'language_code' => 'JP',
            'option_text' => null,
            'description' => null,
            'created_at' => '2026-02-04 02:55:53',
            'updated_at' => '2026-02-04 02:55:53',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '138',
            'question_option_id' => '57',
            'language_code' => 'JP',
            'option_text' => null,
            'description' => null,
            'created_at' => '2026-02-04 02:55:53',
            'updated_at' => '2026-02-04 02:55:53',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '139',
            'question_option_id' => '58',
            'language_code' => 'JP',
            'option_text' => null,
            'description' => null,
            'created_at' => '2026-02-04 02:55:53',
            'updated_at' => '2026-02-04 02:55:53',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '140',
            'question_option_id' => '59',
            'language_code' => 'JP',
            'option_text' => null,
            'description' => null,
            'created_at' => '2026-02-04 02:55:53',
            'updated_at' => '2026-02-04 02:55:53',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '141',
            'question_option_id' => '66',
            'language_code' => 'id',
            'option_text' => 'aaa',
            'description' => 'aaa',
            'created_at' => '2026-02-04 03:06:18',
            'updated_at' => '2026-02-04 03:06:18',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '142',
            'question_option_id' => '66',
            'language_code' => 'en',
            'option_text' => 'aa',
            'description' => 'aa',
            'created_at' => '2026-02-04 03:06:18',
            'updated_at' => '2026-02-04 03:06:18',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '143',
            'question_option_id' => '67',
            'language_code' => 'id',
            'option_text' => 'bbbb',
            'description' => 'bbb',
            'created_at' => '2026-02-04 03:06:18',
            'updated_at' => '2026-02-04 03:06:18',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '144',
            'question_option_id' => '67',
            'language_code' => 'en',
            'option_text' => 'bb',
            'description' => 'bb',
            'created_at' => '2026-02-04 03:06:18',
            'updated_at' => '2026-02-04 03:06:18',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '145',
            'question_option_id' => '66',
            'language_code' => 'JP',
            'option_text' => null,
            'description' => null,
            'created_at' => '2026-02-04 03:19:14',
            'updated_at' => '2026-02-04 03:19:14',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '146',
            'question_option_id' => '67',
            'language_code' => 'JP',
            'option_text' => null,
            'description' => null,
            'created_at' => '2026-02-04 03:19:14',
            'updated_at' => '2026-02-04 03:19:14',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '147',
            'question_option_id' => '68',
            'language_code' => 'id',
            'option_text' => 'cc',
            'description' => null,
            'created_at' => '2026-02-04 03:19:31',
            'updated_at' => '2026-02-04 03:19:31',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '148',
            'question_option_id' => '68',
            'language_code' => 'en',
            'option_text' => 'cc',
            'description' => null,
            'created_at' => '2026-02-04 03:19:31',
            'updated_at' => '2026-02-04 03:19:31',
        ]);
        DB::table('question_option_translations')->insert([
            'id' => '149',
            'question_option_id' => '68',
            'language_code' => 'JP',
            'option_text' => null,
            'description' => null,
            'created_at' => '2026-02-04 03:19:31',
            'updated_at' => '2026-02-04 03:19:31',
        ]);

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
