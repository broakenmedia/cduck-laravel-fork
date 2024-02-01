<?php

namespace Tests\Feature\Livewire;

use App\Livewire\CreatePost;
use App\Livewire\SalesForm;
use App\Livewire\SalesHistory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CoffeeSalesFormTest extends TestCase
{
	use RefreshDatabase;

	protected function setUp(): void
	{
		parent::setUp();
		Product::create(['name' => 'Gold', 'profit_margin' => 0.25]);
	}

	/** @test */
	public function renders_form_successfully()
	{
		Livewire::test(SalesForm::class)
			->assertStatus(200);

		$user = User::factory()->create();

		$this->actingAs($user)->get(route('coffee.sales'))
			->assertSeeLivewire(SalesForm::class);
	}

	/** @test */
	public function calculates_selling_price_correctly()
	{
		Livewire::test(SalesForm::class)
			->set('quantity', 1)
			->set('unitCost', 10)
			->assertSet('sellingPrice', '£23.33');
	}

	/** @test */
	public function saves_sale_correctly()
	{
		Livewire::test(SalesForm::class)
			->set('quantity', 1)
			->set('unitCost', 10)
			->call('save');

		$this->assertDatabaseHas('sales', [
			'product_id' => 1,
			'quantity' => 1,
			'unit_cost' => 10,
			'sale_price' => 23.33
		]);
	}

	/** @test */
	public function resets_quantity_and_unitCost_after_saving()
	{
		Livewire::test(SalesForm::class)
			->set('quantity', 1)
			->set('unitCost', 10)
			->call('save')
			->assertSet('quantity', null)
			->assertSet('unitCost', null);
	}

	/** @test */
	public function does_not_allow_negative_values()
	{
		Livewire::test(SalesForm::class)
			->set('quantity', -1)
			->set('unitCost', -1.00)
			->call('save')
			->assertHasErrors(['quantity' => ['gt:0'], 'unitCost' => ['gt:0']]);
	}

	/** @test */
	public function does_not_allow_empty_values()
	{
		Livewire::test(SalesForm::class)
			->call('save')
			->assertHasErrors(['quantity' => ['required'], 'unitCost' => ['required']]);
	}
}
