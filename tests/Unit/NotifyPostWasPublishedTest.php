<?php


namespace DissanayakeG\pack\Tests\Unit;

use DissanayajeG\pack\Models\Post;
use DissanayajeG\pack\Notifications\PostWasPublishedNotification;
use DissanayakeG\pack\Tests\TestCase;
use DissanayakeG\pack\Tests\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;


class NotifyPostWasPublishedTest extends TestCase
{

    /** @test */
    public function it_can_notify_a_user_that_a_post_was_published()
    {
        Notification::fake();

        $post = Post::factory()->create();

        // the User model has the 'Notifiable' trait
        $user = User::factory()->create();

        Notification::assertNothingSent();


        $user->notify(new PostWasPublishedNotification($post));

        Notification::assertSentTo(
            $user,
            PostWasPublishedNotification::class,
            function ($notification) use ($post) {
                return $notification->post->id === $post->id;
            }
        );
    }
}