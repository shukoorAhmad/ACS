<?php

namespace Tests\Feature\Controllers;

use App\Models\Acs\Employee as AcsEmployee;
use Tests\TestCase;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_employee_index_view()
    {
        $response = $this->get('/employees');
        $response->assertStatus(200);
        $response->assertViewIs('acs.employee.index');
    }

    /** @test */
    public function it_creates_an_employee()
    {
        $employeeData = [
            'name' => 'John Doe',
            'father_name' => 'Mike Doe',
            'special_id' => 123456,
            'photo' => 'path_to_photo.jpg',
            'created_by' => 1,
            // Add more attributes as needed
        ];

        $employee = AcsEmployee::create($employeeData);

        // Assert that the employee was created successfully
        $this->assertDatabaseHas('acs_employees', $employeeData);
    }
}
