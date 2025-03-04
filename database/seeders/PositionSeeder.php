<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::create([
            'title' => 'Software Developer',
            'description' => 'We are looking for a passionate software developer to join our team.',
            'roles_responsibilities' => 'Develop, test, and maintain software applications.',
            'requirements' => 'Bachelor\'s degree in Computer Science, experience in JavaScript, PHP, and frameworks.',
            'apply_button_text' => 'Apply Now',
        ]);

        Position::create([
            'title' => 'Project Manager',
            'description' => 'Manage project timelines and ensure successful delivery.',
            'roles_responsibilities' => 'Coordinate with teams, clients, and stakeholders to ensure deadlines are met.',
            'requirements' => 'Experience in project management, strong leadership skills, and communication.',
            'apply_button_text' => 'Apply Now',
        ]);

        Position::create([
            'title' => 'UX/UI Designer',
            'description' => 'Design user-friendly interfaces for web and mobile applications.',
            'roles_responsibilities' => 'Collaborate with developers to implement design solutions for improved user experience.',
            'requirements' => 'Experience with design tools (Adobe XD, Figma), understanding of user behavior and design principles.',
            'apply_button_text' => 'Apply Now',
        ]);

        Position::create([
            'title' => 'Digital Marketing Specialist',
            'description' => 'Drive online marketing strategies and increase brand awareness.',
            'roles_responsibilities' => 'Plan and execute digital marketing campaigns, manage social media accounts, and analyze campaign results.',
            'requirements' => 'Experience with SEO, PPC, and content marketing, knowledge of Google Analytics and Ads.',
            'apply_button_text' => 'Apply Now',
        ]);

        Position::create([
            'title' => 'Cybersecurity Analyst',
            'description' => 'Monitor and protect the organization\'s IT infrastructure from cyber threats.',
            'roles_responsibilities' => 'Identify vulnerabilities, implement security measures, and respond to security incidents.',
            'requirements' => 'Experience with firewalls, intrusion detection systems, and knowledge of security protocols.',
            'apply_button_text' => 'Apply Now',
        ]);
    }
}
