<?php
namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewCategoriesTest extends TestCase
{

    /**
     * @test
     * create a fake category from factory and show them on the view file
     * assert as success in tests
     */
    public function it_can_display_all_categories()
    {
        $category = factory('App\Category')->create();
        $this->get('/categories')
                ->assertSee($category->name)
                ->assertSee($category->alias);
    }
}
