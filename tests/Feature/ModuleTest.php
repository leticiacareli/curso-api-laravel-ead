<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Module;
use Tests\TestCase;
use Tests\Traits\TestTrait;

class ModuleTest extends TestCase
{
    use TestTrait;

    public function test_user_unauthenticated(){
        $response = $this->getJson('/api/courses/{fakeId}/modules');
        $response->assertStatus(401);
    }

    // public function test_get_module_with_course_not_found(){
    //     $response = $this->getJson('/api/courses/{fakeId}/modules', $this->defaultHeader());
    //     $response->assertStatus(404);
    // }

    public function test_get_module_course(){
        $course = Course::factory()->create();

        $response = $this->getJson("/api/courses/{$course->id}/modules", $this->defaultHeader());
        $response->assertStatus(200);
    }

    public function test_get_quantity_modules(){
        $course = Course::factory()->create();

        Module::factory()->count(10)->create([
            'course_id' => $course->id,
        ]);

        $response = $this->getJson("/api/courses/{$course->id}/modules", $this->defaultHeader());
        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }
}
