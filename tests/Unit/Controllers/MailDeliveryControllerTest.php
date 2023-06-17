<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\Product;
use App\Models\MailDelivery;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MailDeliveryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_render_index_page()
    {
        $mail_deliveries = MailDelivery::factory()->count(5)->create();

        $response = $this->get(route('mail-deliveries.index'));

        $response
            ->assertOk()
            ->assertViewIs('mail-deliveries.index');

        foreach ($mail_deliveries as $mail_delivery) {
            $response
                ->assertSee($mail_delivery->title);
        }
    }

    public function test_can_create_an_mail_delivery()
    {
        $body = [
            'title' => 'Dummy title',
        ];

        $response = $this->post(route('mail-deliveries.store'), $body);

        $response->assertRedirect();

        $this->assertDatabaseHas('mail_deliveries', $body);
    }

    public function test_can_render_show_page()
    {
        $mail_delivery = MailDelivery::factory()->create();

        $response = $this->get(route('mail-deliveries.show', [ 'mail_delivery' => $mail_delivery->id ]));

        $response
            ->assertOk()
            ->assertViewIs('mail-deliveries.show')
            ->assertViewHas('mail_delivery', $mail_delivery)
            ->assertSee($mail_delivery->title);
    }

    public function test_can_render_edit_page()
    {
        $mail_delivery = MailDelivery::factory()->create();

        $response = $this->get(route('mail-deliveries.edit', [ 'mail_delivery' => $mail_delivery->id ]));

        $response
            ->assertViewIs('mail-deliveries.edit')
            ->assertViewHas('mail_delivery', $mail_delivery)
            ->assertOk();
    }

    public function test_can_update_an_mail_delivery()
    {
        $mail_delivery = MailDelivery::factory()->create();

        $body = [
            'title' => 'Updated title'
        ];

        $response = $this->put(route('mail-deliveries.update', [ 'mail_delivery' => $mail_delivery->id ]), $body);

        $response->assertRedirectToRoute('mail-deliveries.show', [ 'mail_delivery' => $mail_delivery->id ]);

        $mail_delivery->refresh();

        $this->assertSame($mail_delivery->title, $body['title']);
    }

    public function test_should_got_validation_error()
    {
        $mail_delivery = MailDelivery::factory()->create();

        $body = [];

        $response = $this->put(route('mail-deliveries.update', [ 'mail_delivery' => $mail_delivery->id ]), $body);

        $response->assertInvalid(['title']);
    }

    public function test_can_delete_an_mail_delivery()
    {
        $mail_delivery = MailDelivery::factory()->create();

        $response = $this->delete(route('mail-deliveries.destroy', [ 'mail_delivery' => $mail_delivery->id ]));

        $response->assertRedirectToRoute('mail-deliveries.index');

        $this->assertNull( MailDelivery::find($mail_delivery->id) );
    }
}
