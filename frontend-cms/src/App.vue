<script setup>
import TreeView from './components/TreeView.vue';
import PageManager from './components/PageManager.vue';
import { ref, provide, onMounted } from 'vue';
import { fetchPages } from './api';

const pages = ref([]);

const loadPages = async () => {
  try {
    const { data } = await fetchPages();
    pages.value = data;

  } catch (error) {
    console.error("Error fetching pages", error);
  }
};

// Provide these methods to all child components
provide('pages', pages);
provide('updatePages', loadPages);

onMounted(loadPages);
</script>

<template>
  <div class="p-6 max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold text-center mb-6">Dynamic CMS</h1>
    <router-view class="mb-6" />

    <div class="grid grid-cols-2 gap-6">
      <div class="bg-white p-4 shadow rounded-lg">
        <h2 class="text-xl font-semibold">Page Structure</h2>
        <TreeView v-if="pages.length > 0" :pages="pages" />
        <p v-else class="text-gray-500">No pages found.</p>
      </div>

      <PageManager />
    </div>
  </div>
</template>