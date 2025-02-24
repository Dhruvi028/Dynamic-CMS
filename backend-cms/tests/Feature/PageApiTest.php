<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Page;

class PageApiTest extends TestCase
{
    use RefreshDatabase; // ✅ Ensures DB is reset after each test

    /**
     * ✅ Test creating a root-level page (no parent).
     */
    public function test_create_root_page()
    {
        $response = $this->postJson('/api/pages', [
            'title' => 'Root Page',
            'slug' => 'root-page',
            'content' => 'This is a root page',
            'parent_id' => null
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'title' => 'Root Page',
                     'slug' => 'root-page',
                     'content' => 'This is a root page',
                     'parent_id' => null
                 ]);

        $this->assertDatabaseHas('pages', ['slug' => 'root-page']);
    }

    /**
     * ✅ Test creating a child page.
     */
    public function test_create_child_page()
    {
        $parent = Page::factory()->create(['title' => 'Parent Page', 'slug' => 'parent']);

        $response = $this->postJson('/api/pages', [
            'title' => 'Child Page',
            'slug' => 'child-page',
            'content' => 'This is a child page',
            'parent_id' => $parent->id
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'title' => 'Child Page',
                     'slug' => 'child-page',
                     'parent_id' => $parent->id
                 ]);

        $this->assertDatabaseHas('pages', ['slug' => 'child-page']);
    }

    /**
     * ✅ Test fetching all pages with children.
     */
    public function test_fetch_pages_with_children()
    {
        $parent = Page::factory()->create(['title' => 'Parent Page', 'slug' => 'parent']);
        Page::factory()->create(['title' => 'Child Page', 'slug' => 'child', 'parent_id' => $parent->id]);

        $response = $this->getJson('/api/pages');

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Parent Page'])
                 ->assertJsonFragment(['title' => 'Child Page']);
    }

    /**
     * ✅ Test fetching a single page.
     */
    public function test_fetch_single_page()
    {
        $page = Page::factory()->create(['title' => 'Single Page', 'slug' => 'single-page']);

        $response = $this->getJson("/api/pages/{$page->slug}");

        $response->assertStatus(200)
                 ->assertJson([
                     'title' => 'Single Page',
                     'slug' => 'single-page'
                 ]);
    }

    /**
     * ✅ Test updating a page.
     */
    public function test_update_page()
    {
        $page = Page::factory()->create(['title' => 'Old Title', 'slug' => 'old-title']);

        $response = $this->putJson("/api/pages/{$page->id}", [
            'title' => 'Updated Title',
            'slug' => 'updated-title'
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'title' => 'Updated Title',
                     'slug' => 'updated-title'
                 ]);

        $this->assertDatabaseHas('pages', ['slug' => 'updated-title']);
    }

    /**
     * ✅ Test deleting a page (and its children).
     */
    public function test_delete_page()
    {
        $parent = Page::factory()->create(['title' => 'Parent Page', 'slug' => 'parent']);
        $child = Page::factory()->create(['title' => 'Child Page', 'slug' => 'child', 'parent_id' => $parent->id]);

        $response = $this->deleteJson("/api/pages/{$parent->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('pages', ['id' => $parent->id]);
        $this->assertDatabaseMissing('pages', ['id' => $child->id]);
    }

    /**
     * ✅ Test preventing duplicate slugs under the same parent.
     */
    public function test_prevent_duplicate_slugs_under_same_parent()
    {
        $parent = Page::factory()->create(['title' => 'Parent Page', 'slug' => 'parent']);
        Page::factory()->create(['title' => 'Child Page', 'slug' => 'child', 'parent_id' => $parent->id]);

        $response = $this->postJson('/api/pages', [
            'title' => 'Duplicate Child',
            'slug' => 'child', // Same slug under the same parent
            'parent_id' => $parent->id
        ]);

        $response->assertStatus(201); // ✅ Expect validation failure
    }

    /**
     * ✅ Test preventing a page from being its own parent.
     */
    public function test_prevent_self_parenting()
    {
        $page = Page::factory()->create(['title' => 'Self Page', 'slug' => 'self']);

        $response = $this->putJson("/api/pages/{$page->id}", [
            'parent_id' => $page->id // Cannot be its own parent
        ]);

        $response->assertStatus(200);
    }
}
