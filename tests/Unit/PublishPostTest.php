<?php


namespace DissanayakeG\pack\Tests\Unit;

use DissanayajeG\pack\Jobs\PublishPost;
use DissanayajeG\pack\Models\Post;
use DissanayakeG\pack\Tests\TestCase;
use Illuminate\Support\Facades\Bus;


class PublishPostTest extends TestCase
{
    /** @test */
    public function it_publishes_a_post()
    {
        Bus::fake();

        $post = Post::factory()->create();

        $this->assertNull($post->published_at);

        PublishPost::dispatch($post);

        Bus::assertDispatched(PublishPost::class, function ($job) use ($post) {
            return $job->post->id === $post->id;
        });
    }
}