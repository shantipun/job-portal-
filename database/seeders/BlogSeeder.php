<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        Blog::create([
            'title' => 'Tips for a Perfect Resume',
            'slug' => 'tips-for-perfect-resume',
            'image' => 'images/blog/resume-tips.jpg',
            'excerpt' => 'Learn how to create a resume that stands out to employers.',
            'content' => 'Full content of resume tips goes here...'
        ]);

        Blog::create([
            'title' => 'Top 10 Remote Jobs in 2026',
            'slug' => 'top-10-remote-jobs-2026',
            'image' => 'images/blog/remote-jobs.jpg',
            'excerpt' => 'Explore the most in-demand remote jobs this year.',
            'content' => 'Full content of remote jobs goes here...'
        ]);

        Blog::create([
            'title' => 'Interview Tips to Impress Employers',
            'slug' => 'interview-tips-to-impress-employers',
            'image' => 'images/blog/interview-tips.jpg',
            'excerpt' => 'Learn strategies to excel in your next job interview.',
            'content' => 'Full content of interview tips goes here...'
        ]);
    }
}
