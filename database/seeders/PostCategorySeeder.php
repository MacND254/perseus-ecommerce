<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PostCategory;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Cybersecurity', 'slug' => 'cybersecurity'],
            ['name' => 'Network Security', 'slug' => 'network-security'],
            ['name' => 'Information Security', 'slug' => 'information-security'],
            ['name' => 'Cloud Security', 'slug' => 'cloud-security'],
            ['name' => 'Data Privacy', 'slug' => 'data-privacy'],
            ['name' => 'Penetration Testing', 'slug' => 'penetration-testing'],
            ['name' => 'Incident Response', 'slug' => 'incident-response'],
            ['name' => 'Ethical Hacking', 'slug' => 'ethical-hacking'],
            ['name' => 'Malware Analysis', 'slug' => 'malware-analysis'],
            ['name' => 'IT Infrastructure', 'slug' => 'it-infrastructure'],
            ['name' => 'Cloud Computing', 'slug' => 'cloud-computing'],
            ['name' => 'DevOps', 'slug' => 'devops'],
            ['name' => 'Software Development', 'slug' => 'software-development'],
            ['name' => 'Artificial Intelligence', 'slug' => 'artificial-intelligence'],
            ['name' => 'Machine Learning', 'slug' => 'machine-learning'],
            ['name' => 'Blockchain Technology', 'slug' => 'blockchain-technology'],
            ['name' => 'Internet of Things (IoT)', 'slug' => 'internet-of-things'],
            ['name' => 'Digital Forensics', 'slug' => 'digital-forensics'],
            ['name' => 'Cryptography', 'slug' => 'cryptography'],
            ['name' => 'Security Compliance', 'slug' => 'security-compliance'],
        ];

        foreach ($categories as $category) {
            PostCategory::create($category);
        }
    }
}
