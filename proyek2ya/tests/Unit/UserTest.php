<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Questions;
use App\Models\UserAnswer;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserHasManyTransactions()
    {
        $user = User::factory()->create();
        $transactions = Transaction::factory(3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->transaction);
        $this->assertInstanceOf(Transaction::class, $user->transaction->first());
    }

    public function testUserHasManyQuestions()
    {
        $user = User::factory()->create();
        $questions = Questions::factory(2)->create(['user_id' => $user->id]);

        $this->assertCount(2, $user->questions);
        $this->assertInstanceOf(Questions::class, $user->questions->first());
    }

    public function testUserHasManyUserAnswers()
    {
        $user = User::factory()->create();
        $answers = UserAnswer::factory(5)->create(['user_id' => $user->id]);

        $this->assertCount(5, $user->userAnswers);
        $this->assertInstanceOf(UserAnswer::class, $user->userAnswers->first());
    }

    public function testUserHasManyProducts()
    {
        $user = User::factory()->create();
        $products = Product::factory(4)->create(['user_id' => $user->id]);

        $this->assertCount(4, $user->products);
        $this->assertInstanceOf(Product::class, $user->products->first());
    }

    public function testDecrementPointsMethod()
    {
        $user = User::factory()->create(['points' => 100]);

        $user->decrementPoints(30);

        $this->assertEquals(70, $user->fresh()->points);
    }
}
