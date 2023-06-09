<?php

namespace Tests\Unit\Controllers;

use App\Models\Report;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Call this template method before each test method is run.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loginAsAministrator();
    }

    public function test_can_render_index_page()
    {
        $reports = Report::factory()->count(5)->create();

        $response = $this->get(route('reports.index'));

        $response
            ->assertOk()
            ->assertViewIs('reports.index');

        foreach ($reports as $report) {
            $response
                ->assertSee($report->title);
        }
    }

    public function test_can_create_an_report()
    {
        $body = [
            'title' => 'Dummy title',
            'type' => Report::SALE_REPORT,
            'schedule' =>  Report::SCHEDULE_DAILY,
            'notify_to' => 'nghuuquyen@gmail.com',
        ];

        $response = $this->post(route('reports.store'), $body);

        $response->assertRedirect();

        $this->assertDatabaseHas('reports', $body);
    }

    public function test_can_render_show_page()
    {
        $report = Report::factory()->create();

        $response = $this->get(route('reports.show', ['report' => $report->id]));

        $response
            ->assertOk()
            ->assertViewIs('reports.show')
            ->assertViewHas('report', $report)
            ->assertSee($report->title);
    }

    public function test_can_render_edit_page()
    {
        $report = Report::factory()->create();

        $response = $this->get(route('reports.edit', ['report' => $report->id]));

        $response
            ->assertViewIs('reports.edit')
            ->assertViewHas('report', $report)
            ->assertOk();
    }

    public function test_can_update_an_report()
    {
        $report = Report::factory()->create();

        $body = [
            'title' => 'Updated title',
            'type' => Report::SALE_REPORT,
            'schedule' =>  Report::SCHEDULE_DAILY,
            'notify_to' => 'nghuuquyen@gmail.com',
        ];

        $response = $this->put(route('reports.update', ['report' => $report->id]), $body);

        $response->assertRedirectToRoute('reports.show', ['report' => $report->id]);

        $report->refresh();

        $this->assertSame($report->title, $body['title']);

        $this->assertSame($report->type, $body['type']);

        $this->assertSame($report->schedule, $body['schedule']);

        $this->assertSame($report->notify_to, $body['notify_to']);
    }

    public function test_should_got_validation_error()
    {
        $report = Report::factory()->create();

        $body = [];

        $response = $this->put(route('reports.update', ['report' => $report->id]), $body);

        $response->assertInvalid(['title', 'type', 'schedule', 'notify_to']);
    }

    public function test_can_delete_an_report()
    {
        $report = Report::factory()->create();

        $response = $this->delete(route('reports.destroy', ['report' => $report->id]));

        $response->assertRedirectToRoute('reports.index');

        $this->assertNull(Report::find($report->id));
    }
}
