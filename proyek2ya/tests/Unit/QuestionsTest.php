<?php

namespace Tests\Feature;

use App\Models\Questions;
use App\Models\User;
use App\Models\UserAnswer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_question()
    {
        $user = User::factory()->create();

        $question = Questions::factory()->create([
            'question' => 'What is the capital of France?',
            'option_a' => 'Berlin',
            'option_b' => 'Madrid',
            'option_c' => 'Paris',
            'option_d' => 'Rome',
            'correct_answer' => 'C',
            'points' => 10,
            'is_validated' => true,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('questions', [
            'question' => 'What is the capital of France?',
            'correct_answer' => 'C',
            'points' => 10,
            'is_validated' => true,
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function it_can_access_user_relationship()
    {
        $user = User::factory()->create();
        $question = Questions::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $question->user);
        $this->assertEquals($user->id, $question->user->id);
    }

    /** @test */
    public function it_can_access_user_answers_relationship()
    {
        $question = Questions::factory()->create();
        $userAnswers = UserAnswer::factory()->count(3)->create(['question_id' => $question->id]);

        $this->assertCount(3, $question->userAnswers);
        $this->assertInstanceOf(UserAnswer::class, $question->userAnswers->first());
    }

    /** @test */
    public function it_validates_correct_answer_format()
    {
        $question = Questions::factory()->create(['correct_answer' => 'A']);

        $this->assertContains($question->correct_answer, ['A', 'B', 'C', 'D']);
    }

    /** @test */
    public function it_checks_if_question_is_validated()
    {
        $question = Questions::factory()->create(['is_validated' => true]);

        $this->assertTrue($question->is_validated);
    }

    /** @test */
    public function it_can_assign_points_to_question()
    {
        $question = Questions::factory()->create(['points' => 50]);

        $this->assertEquals(50, $question->points);
    }

    /** @test */
    public function it_handles_no_user_answers()
    {
        $question = Questions::factory()->create();

        $this->assertCount(0, $question->userAnswers);
    }
}
