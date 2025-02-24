<script lang="ts" setup>
import { ref, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';
import { fetchPage } from '../api';
import TreeView from '../components/TreeView.vue';

const route = useRoute();
const page = ref(null);
const loading = ref(true);

const fetchPageData = async () => {
  loading.value = true;
  try {
    const { data } = await fetchPage(route.params.slug as string);
    page.value = data;
  } catch (error) {
    console.error('Page not found', error);
  } finally {
    loading.value = false;
  }
};

onMounted(fetchPageData);
watch(() => route.params.slug, fetchPageData);
</script>

<template>
  <div v-if="loading" class="text-center text-gray-500">Loading...</div>

  <div v-else-if="page" class="p-6 bg-white shadow-lg rounded-md">
    <h1 class="text-2xl font-bold text-blue-600">{{ page.title }}</h1>
    <p class="mt-4 text-gray-700">{{ page.content }}</p>

    <div v-if="page.children?.length" class="mt-6">
      <h2 class="text-xl font-semibold">Subpages:</h2>
      <TreeView :pages="page.children" :parentPath="'/' + page.slug" />
    </div>
  </div>

  <div v-else class="text-red-600">Page not found.</div>
</template>
