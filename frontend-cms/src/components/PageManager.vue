<script setup lang="ts">
import { ref, inject } from 'vue';
import { createPage } from '../api';

const updatePages = inject('updatePages');

const newPage = ref({ title: '', slug: '', content: '', parent_id: null });
const isFormVisible = ref(true);

const addPage = async () => {
  try {
    await createPage(newPage.value);
    newPage.value = { title: '', slug: '', content: '', parent_id: null };
    isFormVisible.value = false;
    await updatePages(); // Update the tree view immediately
  } catch (error) {
    console.error("Error creating page", error);
  }
};

const generateSlug = () => {
  newPage.value.slug = newPage.value.title
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, '-')
    .replace(/(^-|-$)/g, '');
};
</script>

<template>
  <div class="min-h-screen bg-white">
    <div class="max-w-4xl mx-auto">
      <div class="bg-white/80 backdrop-blur-xl rounded-3xl p-8 border border-white/20">
        <div class="flex justify-between items-center mb-8">
          <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
            Page Manager
          </h2>
          <button
            @click="isFormVisible = !isFormVisible"
            class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl
                   hover:from-indigo-600 hover:to-purple-700 transform hover:-translate-y-0.5 transition-all duration-300
                   shadow-lg hover:shadow-xl"
          >
            {{ isFormVisible ? 'Close Page' : 'Create Page' }}
          </button>
        </div>

        <!-- Create Page Form -->
        <div
          v-if="isFormVisible"
          class="mb-8 transform transition-all duration-500"
          :class="isFormVisible ? 'opacity-100 translate-y-0' : 'opacity-0 -translate-y-4'"
        >
          <form @submit.prevent="addPage" class="space-y-6 bg-white/50 p-6 rounded-2xl border border-indigo-100">
            <div class="space-y-2">
              <label class="block text-sm font-medium text-gray-700 text-start">Title</label>
              <input
                v-model="newPage.title"
                @input="generateSlug"
                placeholder="Enter page title"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2
                       focus:ring-indigo-200 transition-all duration-300 outline-none"
              >
            </div>

            <div class="space-y-2">
              <label class="block text-sm font-medium text-gray-700 text-start">Slug</label>
              <input
                v-model="newPage.slug"
                placeholder="page-slug"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2
                       focus:ring-indigo-200 transition-all duration-300 outline-none bg-gray-50"
                readonly
              >
            </div>

            <div class="space-y-2">
              <label class="block text-sm font-medium text-gray-700 text-start">Parent ID (Optional)</label>
              <input
                v-model="newPage.parent_id"
                type="number"
                placeholder="Enter parent page ID"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2
                       focus:ring-indigo-200 transition-all duration-300 outline-none"
              >
            </div>

            <div class="space-y-2">
              <label class="block text-sm font-medium text-gray-700 text-start">Content</label>
              <textarea
                v-model="newPage.content"
                placeholder="Enter page content"
                rows="4"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2
                       focus:ring-indigo-200 transition-all duration-300 outline-none resize-none"
              ></textarea>
            </div>

            <div class="flex justify-end">
              <button
                type="submit"
                class="px-8 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-xl
                       hover:from-emerald-600 hover:to-teal-700 transform hover:-translate-y-0.5 transition-all
                       duration-300 shadow-lg hover:shadow-xl"
              >
                Create Page
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>