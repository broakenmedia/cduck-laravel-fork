<?php

namespace Tests\Feature\Livewire;

use App\Livewire\SalesForm;
use App\Livewire\SalesHistory;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CoffeeSalesHistoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
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

        $user = User::factory()->create();
        Sale::factory()->count(15)->create(['sales_agent_id' => $user->id]);

        $this->actingAs($user);

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

    /** @test */
    public function resets_filters_correctly()
    {
        User::factory(2)->create();
        Livewire::test(SalesHistory::class)
            ->set('productType', 1)
            ->set('agent', 2)
            ->call('resetFilters')
            ->assertSet('productType', null)
            ->assertSet('agent', null);
    }

    /** @test */
    public function shows_empty_message_for_zero_sales()
    {
        Livewire::test(SalesHistory::class)
            ->assertViewHas('sales', function (LengthAwarePaginator $pages) {
                return $pages->total() === 0;
            })->assertSee('No Sales Available');
    }
}
