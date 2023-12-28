<?php

namespace Tests\Feature;

use App\Models\Course;
use Tests\TestCase;
use Tests\Traits\TestTrait;

class CourseTest extends TestCase
{
    use TestTrait;

    public function test_user_unauthenticated(){
        $response = $this->getJson('/api/courses');
        $response->assertStatus(401);
    }

    public function test_get_all_courses(){
        $response = $this->getJson('/api/courses', $this->defaultHeader());
        $response->assertStatus(200);
    }

    public function test_get_quantity_courses(){
        $courses = Course::factory()->count(10)->create();

        $response = $this->getJson('/api/courses', $this->defaultHeader());
        $response->assertStatus(200)->assertJsonCount(count($courses), 'data');
    }

    public function test_get_single_course_user_unauthenticated(){
        $response = $this->getJson('/api/courses/{fakeId}');
        $response->assertStatus(401);
    }

    public function test_get_course_not_found(){
        $response = $this->getJson('/api/courses/{fakeId}', $this->defaultHeader());
        $response->assertStatus(404);
    }

    public function test_get_single_course(){
        $course = Course::factory()->create();

        $response = $this->getJson("/api/courses/{$course->id}", $this->defaultHeader());
        $response->assertStatus(200);
    }
}
