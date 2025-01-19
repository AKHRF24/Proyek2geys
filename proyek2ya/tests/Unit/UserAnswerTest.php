<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Questions;
use App\Models\UserAnswer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserAnswerTest extends TestCase
{
    use RefreshDatabase;  // Reset database setelah setiap pengujian

    /** @test */
    public function it_can_create_user_answer()
    {
        // Persiapkan data pengguna dan pertanyaan
        $user = User::factory()->create();
        $question = Questions::factory()->create();

        // Buat jawaban pengguna
        $userAnswer = UserAnswer::create([
            'user_id' => $user->id,
            'question_id' => $question->id,
            'answer' => 'A',
            'is_correct' => true,
            'status' => 'approved',
        ]);

        // Periksa apakah jawaban pengguna berhasil disimpan
        $this->assertDatabaseHas('user_answers', [
            'user_id' => $user->id,
            'question_id' => $question->id,
            'answer' => 'A',
            'is_correct' => true,
            'status' => 'approved',
        ]);
    }

    /** @test */
    public function it_has_a_user_relationship()
    {
        // Persiapkan data pengguna dan jawaban pengguna
        $user = User::factory()->create();
        $userAnswer = UserAnswer::factory()->create([
            'user_id' => $user->id,
        ]);

        // Verifikasi apakah relasi pengguna dapat diakses dengan benar
        $this->assertInstanceOf(User::class, $userAnswer->user);
        $this->assertEquals($user->id, $userAnswer->user->id);
    }

    /** @test */
    public function it_has_a_question_relationship()
    {
        // Persiapkan data pertanyaan dan jawaban pengguna
        $question = Questions::factory()->create();
        $userAnswer = UserAnswer::factory()->create([
            'question_id' => $question->id,
        ]);

        // Verifikasi apakah relasi pertanyaan dapat diakses dengan benar
        $this->assertInstanceOf(Questions::class, $userAnswer->question);
        $this->assertEquals($question->id, $userAnswer->question->id);
    }

    /** @test */
    public function it_requires_a_valid_answer()
    {
        // Validasi jika jawaban tidak boleh kosong
        $this->expectException(\Illuminate\Database\QueryException::class);

        UserAnswer::create([
            'user_id' => 1,
            'question_id' => 1,
            'answer' => '',
            'is_correct' => true,
            'status' => 'approved',
        ]);
    }

    /** @test */
    public function it_requires_a_valid_status()
    {
        // Validasi jika status harus salah satu dari nilai yang valid
        $this->expectException(\Illuminate\Database\QueryException::class);

        UserAnswer::create([
            'user_id' => 1,
            'question_id' => 1,
            'answer' => 'A',
            'is_correct' => true,
            'status' => 'invalid_status', // Status yang tidak valid
        ]);
    }

}
