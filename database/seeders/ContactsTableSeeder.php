<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $contacts = [
            ['department' => 'Human Resources', 'email' => 'hr@company.com', 'phone_number' => '123-456-7890'],
            ['department' => 'Marketing', 'email' => 'marketing@company.com', 'phone_number' => '123-456-7891'],
            ['department' => 'Sales', 'email' => 'sales@company.com', 'phone_number' => '123-456-7892'],
            ['department' => 'IT Support', 'email' => 'support@company.com', 'phone_number' => '123-456-7893'],
            ['department' => 'Finance', 'email' => 'finance@company.com', 'phone_number' => '123-456-7894'],
            ['department' => 'Customer Service', 'email' => 'customerservice@company.com', 'phone_number' => '123-456-7895'],
            ['department' => 'Operations', 'email' => 'operations@company.com', 'phone_number' => '123-456-7896'],
            ['department' => 'Legal', 'email' => 'legal@company.com', 'phone_number' => '123-456-7897'],
            ['department' => 'Administration', 'email' => 'admin@company.com', 'phone_number' => '123-456-7898'],
            ['department' => 'Public Relations', 'email' => 'pr@company.com', 'phone_number' => '123-456-7899'],
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
