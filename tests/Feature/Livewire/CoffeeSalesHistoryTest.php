<?php

namespace Tests\Feature\Livewire;

use App\Livewire\CreatePost;
use App\Livewire\SalesForm;
use App\Livewire\SalesHistory;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator as PaginationLengthAwarePaginator;
use Livewire\Livewire;
use Tests\TestCase;

class CoffeeSalesHistoryTest extends TestCase
{
	use RefreshDatabase;

	protected function setUp(): void
	{
		parent::setUp();
		Product::create(['name' => 'Gold', 'profit_margin' => 0.25]);
	}

	/** @test */
	public function renders_history_table_successfully()
	{
		Livewire::test(SalesHistory::class)
			->assertStatus(200);

		$user = User::factory()->create();

		$this->actingAs($user)->get(route('coffee.sales'))
			->assertSeeLivewire(SalesHistory::class);
	}

	/** @test */
	public function paginates_sales_correctly()
	{
		Sale::factory()->count(15)->create();

		Livewire::test(SalesHistory::class)->assertViewHas('sales', function (LengthAwarePaginator $pages) {
			return $pages->total() === 15 && $pages->count() === 10;
		});
	}

	/** @test */
	public function updates_rows_after_event()
	{
		Sale::factory()->count(15)->create();

		Livewire::test(SalesHistory::class)->assertViewHas('sales', function (LengthAwarePaginator $pages) {
			return $pages->total() === 15 && $pages->count() === 10;
		});

		Livewire::test(SalesForm::class)
			->set('quantity', 1)
			->set('unitCost', 10)
			->call('save');

		Livewire::test(SalesHistory::class)->assertViewHas('sales', function (LengthAwarePaginator $pages) {
			return $pages->total() === 16 && $pages->count() === 10;
		});
	}
}
