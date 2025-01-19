<?php

namespace Tests\Feature;

use App\Models\Questions;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_validate_a_question()
    {
        $admin = User::factory()->create(['role' => 'admin']); // Create an admin user
        $this->actingAs($admin); // Authenticate as admin

        $question = Questions::factory()->create(['is_validated' => false]);

        $response = $this->put(route('admin.questions.validate', $question));

        $this->assertTrue($question->fresh()->is_validated);
        $response->assertRedirect(route('questions.index'));
        $response->assertSessionHas('success', 'Question validated successfully!');
    }

    /** @test */
    public function user_cannot_award_points_if_question_not_validated()
    {
        $user = User::factory()->create(); // Create a regular user
        $this->actingAs($user); // Authenticate as user

        $question = Questions::factory()->create(['is_validated' => false]);

        $response = $this->post(route('user.page.question.answer', $question), [
            'answer' => 'Some answer',
        ]);

        $response->assertSessionHasErrors('validation');
    }
}
