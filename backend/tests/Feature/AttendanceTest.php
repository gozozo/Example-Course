<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\Attendance;

class AttendanceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_when_an_instructor_creates_an_assistance_he_can_delete_it_and_return_a_json_if_it_was_successful()
    {
        //Create all entities
        $course=Course::factory()->hasAttached(
            Student::factory()
        )->create();


        //Get entity relationships
        $course->load(['students']);

        //Test that the course resource is available
        $response = $this->get('/api/v1/course/'.$course->id);
        $response->assertStatus(200);

        //Insert assistance by API to the student
        $response = $this->post('/api/v1/attendance',['course_id' => $course->id,'student_id' => $course->students->first()->id]);
        $response->assertStatus(201);

        //We get assistance from the response
        $attendance = Attendance::find($response['data']['id']);

        //Remove attendance and check that the answer is correct
        $response = $this->delete('/api/v1/attendance/'.$attendance->id);
        $response->assertStatus(200)->assertJson(['data' => ['result'=> 'ok']]);
    }

}
