<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Questions;
use App\Models\UserAnswer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAnswerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the fillable attributes of the model.
     *
     * @return void
     */
    public function testFillableAttributes()
    {
        $data = [
            'user_id' => 1,
            'question_id' => 2,
            'answer' => 'A',
            'is_correct' => true,
            'status' => 'completed',
        ];

        $userAnswer = UserAnswer::create($data);

        $this->assertInstanceOf(UserAnswer::class, $userAnswer);
        $this->assertEquals($data['user_id'], $userAnswer->user_id);
        $this->assertEquals($data['question_id'], $userAnswer->question_id);
        $this->assertEquals($data['answer'], $userAnswer->answer);
        $this->assertEquals($data['is_correct'], $userAnswer->is_correct);
        $this->assertEquals($data['status'], $userAnswer->status);
    }

    /**
     * Test the user relationship.
     *
     * @return void
     */
    public function testUserRelationship()
    {
        $user = User::factory()->create();
        $userAnswer = UserAnswer::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $userAnswer->user);
        $this->assertEquals($user->id, $userAnswer->user->id);
    }

    /**
     * Test the question relationship.
     *
     * @return void
     */
    public function testQuestionRelationship()
    {
        $question = Questions::factory()->create();
        $userAnswer = UserAnswer::factory()->create(['question_id' => $question->id]);

        $this->assertInstanceOf(Questions::class, $userAnswer->question);
        $this->assertEquals($question->id, $userAnswer->question->id);
    }
}
