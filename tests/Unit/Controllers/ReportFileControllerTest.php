<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Report;
use App\Models\CartItem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportFileControllerTest extends TestCase
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

    public function test_able_to_generate_sale_report_file()
    {
        Storage::fake(Report::REPORT_FILE_DISK);

        Order::factory()
            ->state([
                'cart_id' => Cart::factory()->has(CartItem::factory()->count(3), 'items'),
            ])
            ->count(3)->create();

        $report = Report::factory()
            ->state([
                'type' => Report::SALE_REPORT,
            ])
            ->create();

        $response = $this->post(route('reports.report-files.store', ['report' => $report->id]))->assertRedirect();

        $report->refresh();

        $report_file_name = $report->reportFiles()->first()->filename;

        $this->assertNotNull($report_file_name);

        Storage::disk(Report::REPORT_FILE_DISK)->assertExists($report_file_name);
    }

    public function test_able_to_generate_product_peformance_report_file()
    {
        Storage::fake(Report::REPORT_FILE_DISK);

        Order::factory()
            ->state([
                'cart_id' => Cart::factory()->has(CartItem::factory()->count(3), 'items'),
            ])
            ->count(3)->create();

        $report = Report::factory()
            ->state([
                'type' => Report::PRODUCT_PERFORMANCE_REPORT,
            ])
            ->create();

        $response = $this->post(route('reports.report-files.store', ['report' => $report->id]))->assertRedirect();

        $report->refresh();

        $report_file_name = $report->reportFiles()->first()->filename;

        $this->assertNotNull($report_file_name);

        Storage::disk(Report::REPORT_FILE_DISK)->assertExists($report_file_name);
    }

    public function test_able_to_generate_customer_report_file()
    {
        Storage::fake(Report::REPORT_FILE_DISK);

        Order::factory()
            ->state([
                'cart_id' => Cart::factory()->has(CartItem::factory()->count(3), 'items'),
            ])
            ->count(3)->create();

        $report = Report::factory()
            ->state([
                'type' => Report::CUSTOMER_REPORT,
            ])
            ->create();

        $response = $this->post(route('reports.report-files.store', ['report' => $report->id]))->assertRedirect();

        $report->refresh();

        $report_file_name = $report->reportFiles()->first()->filename;

        $this->assertNotNull($report_file_name);

        Storage::disk(Report::REPORT_FILE_DISK)->assertExists($report_file_name);
    }
}
