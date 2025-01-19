<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Questions;
use App\Models\UserAnswer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionControllerTest extends TestCase
{
    use RefreshDatabase;

    // Test listing all questions for admin
    public function test_admin_can_view_questions_list()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->get(route('questions.index'));
        $response->assertStatus(200);
        $response->assertViewHas('questions');
    }

    // Test for showing the create question form
    public function test_admin_can_view_create_question_form()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->get(route('questions.create'));
        $response->assertStatus(200);
    }

    // Test for storing a new question
    public function test_admin_can_store_new_question()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $data = [
            'question' => 'What is 2+2?',
            'option_a' => '3',
            'option_b' => '4',
            'option_c' => '5',
            'option_d' => '6',
            'correct_answer' => 'B',
            'points' => 10
        ];

        $response = $this->post(route('questions.store'), $data);
        $response->assertRedirect(route('questions.index'));
        $this->assertDatabaseHas('questions', [
            'question' => 'What is 2+2?',
            'correct_answer' => 'B'
        ]);
    }

    // Test for showing a specific question for admin to verify answers
    public function test_admin_can_view_question_to_verify_answer()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $question = Questions::factory()->create();

        $response = $this->get(route('questions.show', $question->id));
        $response->assertStatus(200);
        $response->assertViewHas('question');
    }

    // Test for verifying an answer as admin
    public function test_admin_can_verify_answer()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $user = User::factory()->create();
        $question = Questions::factory()->create(['correct_answer' => 'B']);
        $userAnswer = UserAnswer::factory()->create([
            'user_id' => $user->id,
            'question_id' => $question->id,
            'answer' => 'B',
            'status_question' => 'pending'
        ]);

        $data = [
            'is_correct' => true,
            'status_question' => 'approved'
        ];

        $response = $this->post(route('user.page.answer', $userAnswer->id), $data);
        $response->assertRedirect(route('questions.show', $question->id));
        $this->assertDatabaseHas('user_answers', [
            'status_question' => 'approved',
            'is_correct' => true
        ]);
        $user->refresh();
        $this->assertEquals(10, $user->points); // User gets points for correct answer
    }

    // Test for editing a question
    public function test_admin_can_view_edit_question_form()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $question = Questions::factory()->create();

        $response = $this->get(route('questions.edit', $question->id));
        $response->assertStatus(200);
        $response->assertViewHas('question');
    }

    // Test for updating a question
    public function test_admin_can_update_question()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $question = Questions::factory()->create();

        $data = [
            'question' => 'What is 3+3?',
            'option_a' => '5',
            'option_b' => '6',
            'option_c' => '7',
            'option_d' => '8',
            'correct_answer' => 'B',
            'points' => 5
        ];

        $response = $this->put(route('questions.update', $question->id), $data);
        $response->assertRedirect(route('questions.index'));
        $this->assertDatabaseHas('questions', ['question' => 'What is 3+3?']);
    }

    // Test for deleting a question
    public function test_admin_can_delete_question()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $question = Questions::factory()->create();

        $response = $this->delete(route('questions.destroy', $question->id));
        $response->assertRedirect(route('questions.index'));
        // Replacing assertDeleted with assertDatabaseMissing
        $this->assertDatabaseMissing('questions', ['id' => $question->id]);
    }

    // Test for showing the user answer form
    public function test_user_can_view_answer_form()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $question = Questions::factory()->create();

        $response = $this->get(route('user.page.answer', $question->id));
        $response->assertStatus(200);
    }

    // Test for submitting an answer as a user
    public function test_user_can_submit_answer()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $question = Questions::factory()->create(['correct_answer' => 'A']);

        $data = [
            'answer' => 'A'
        ];

        $response = $this->post(route('user.page.submit', $question), $data);
        $response->assertRedirect(route('user.page.index'));
        $this->assertDatabaseHas('user_answers', [
            'user_id' => $user->id,
            'question_id' => $question->id,
            'answer' => 'A',
            'is_correct' => true
        ]);
    }
}
