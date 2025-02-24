<script setup lang="ts">
import { defineProps, ref, inject } from 'vue';
import { RouterLink } from 'vue-router';
import { updatePage, deletePage } from '../api';

const props = defineProps(['pages', 'parentPath']);
const expanded = ref({});
const editingPage = ref(null);

// Inject the update method
const updatePages = inject('updatePages');

const getFullPath = (page) => {
  return props.parentPath ? `${props.parentPath}/${page.slug}` : `/${page.slug}`;
};

const toggleExpand = (id) => {
  expanded.value[id] = !expanded.value[id];
};

const savePage = async () => {
  if (editingPage.value) {
    try {
      await updatePage(editingPage.value.id, {
        title: editingPage.value.title,
        slug: editingPage.value.slug,
        content: editingPage.value.content
      });
      editingPage.value = null;
      await updatePages(); // Update the tree view immediately
    } catch (error) {
      console.error("Error updating page", error);
    }
  }
};

const removePage = async (id) => {
  try {
    await deletePage(id);
    await updatePages(); // Update the tree view immediately
  } catch (error) {
    console.error("Error deleting page", error);
  }
};
</script>

<template>
  <ul class="ml-2 space-y-4">
    <li v-for="page in pages"
        :key="page.id"
        class="relative group">
      <div class="flex items-center gap-4 p-3 rounded-xl bg-white/30 backdrop-blur-sm border border-white/20 shadow-lg hover:shadow-xl transition-all duration-300 hover:bg-white/40">
        <button
          v-if="page.children?.length"
          @click="toggleExpand(page.id)"
          class="w-8 h-8 flex items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-white hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 shadow-md"
        >
          <span
            class="transform transition-transform duration-300 text-xl"
            :class="{ 'rotate-90': expanded[page.id] }"
          >
            ›
          </span>
        </button>

        <div v-else class="w-8"></div>

        <div class="flex-1 flex items-center gap-4">
          <template v-if="editingPage?.id === page.id">
            <input
              v-model="editingPage.title"
              class="flex-1 px-4 py-2 bg-white/50 backdrop-blur-sm border border-indigo-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all duration-300"
              placeholder="Page title"
            />
            <button
              @click="savePage"
              class="px-6 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-lg hover:from-emerald-600 hover:to-teal-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
            >
              Save
            </button>
          </template>

          <RouterLink
            v-else
            :to="getFullPath(page)"
            class="flex-1 text-lg font-medium text-gray-700 hover:text-indigo-600 transition-colors duration-300"
          >
            {{ page.title }}
          </RouterLink>

          <div class="flex items-center gap-3 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-4 group-hover:translate-x-0">
            <button
              @click="editingPage = { ...page }"
              class="px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white rounded-lg hover:from-amber-600 hover:to-orange-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
            >
              Edit
            </button>
            <button
              @click="removePage(page.id)"
              class="px-4 py-2 bg-gradient-to-r from-rose-500 to-pink-600 text-white rounded-lg hover:from-rose-600 hover:to-pink-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
            >
              Delete
            </button>
          </div>
        </div>
      </div>

      <div
        v-if="page.children?.length"
        class="overflow-hidden transition-all duration-300 ease-in-out mb-2"
        :class="expanded[page.id] ? 'max-h-[2000px] opacity-100 mt-4' : 'max-h-0 opacity-0'"
      >
        <TreeView :pages="page.children" :parentPath="getFullPath(page)" />
      </div>
    </li>
  </ul>
</template>