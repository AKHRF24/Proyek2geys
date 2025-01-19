<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Questions;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_default_points_attribute()
    {
        $user = User::factory()->create();

        $this->assertEquals(0, $user->points);
    }

    /** @test */
    public function it_can_decrement_points()
    {
        $user = User::factory()->create(['points' => 50]);

        $user->decrementPoints(20);

        $this->assertEquals(30, $user->points);
    }

    /** @test */
    public function it_has_many_transactions()
    {
        $user = User::factory()->create();
        $transactions = Transaction::factory()->count(3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->transaction);
        $this->assertInstanceOf(Transaction::class, $user->transaction->first());
    }

    /** @test */
    public function it_has_many_questions()
    {
        $user = User::factory()->create();
        $questions = Questions::factory()->count(5)->create(['user_id' => $user->id]);

        $this->assertCount(5, $user->questions);
        $this->assertInstanceOf(Questions::class, $user->questions->first());
    }

    /** @test */
    public function it_has_many_products()
    {
        $user = User::factory()->create();
        $products = Product::factory()->count(4)->create(['user_id' => $user->id]);

        $this->assertCount(4, $user->products);
        $this->assertInstanceOf(Product::class, $user->products->first());
    }
}
