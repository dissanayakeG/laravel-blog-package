<?php


namespace DissanayakeG\pack\Tests\Unit;


use DissanayajeG\pack\Mail\WelcomeMail;
use DissanayajeG\pack\Models\Post;
use DissanayakeG\pack\Tests\TestCase;
use Illuminate\Support\Facades\Mail;

class WelcomeMailTest extends TestCase
{
    /** @test */
    public function it_sends_a_welcome_email()
    {
        Mail::fake();

        $post = Post::factory()->create(['title' => 'Fake Title']);

        Mail::assertNothingSent();

        Mail::to('test@example.com')->send(new WelcomeMail($post));

        Mail::assertSent(WelcomeMail::class, function ($mail) use ($post) {
            return $mail->post->id === $post->id
                && $mail->post->title === 'Fake Title';
        });
    }
}